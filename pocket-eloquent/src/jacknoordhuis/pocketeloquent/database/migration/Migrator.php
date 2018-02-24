<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database\migration;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Connection;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\ConnectionInterface;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\ConnectionResolverInterface;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Migrations\DatabaseMigrationRepository;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Grammars\Grammar;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Arr;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Collection;

class Migrator {

	/** @var MigrationManager */
	private $manager;

	/** @var DatabaseMigrationRepository */
	private $repository;

	/** @var ConnectionResolverInterface */
	private $resolver;

	/** @var string|null */
	protected $connection;

	/** @var string[] */
	private $notes = [];

	public function __construct(MigrationManager $manager, DatabaseMigrationRepository $repository, ConnectionResolverInterface $resolver) {
		$this->manager = $manager;
		$this->repository = $repository;
		$this->resolver = $resolver;
	}

	/**
	 * Run the pending migrations
	 *
	 * @return Migration[]
	 */
	public function run() : array {
		$this->notes = [];

		// We'll grab all of the registered migrations, then we'll compare them
		// against the migrations that have already run and then run each of the
		// outstanding migrations against the database connection.
		$migrations = $this->manager->getMigrations();

		// Filter out migrations that have already run.
		$migrations = $this->resolvePendingMigrations($migrations, $this->repository->getRan());

		$this->runPending($migrations);

		return $migrations;

	}

	/**
	 * Filter out migrations that have already been executed
	 *
	 * @param Migration[] $migrations
	 * @param string[] $ran
	 *
	 * @return Migration[]
	 */
	protected function resolvePendingMigrations(array $migrations, array $ran) : array {
		return Collection::make($migrations)
			->reject(function($migration) use ($ran) {
			return in_array($this->getMigrationName($migration), $ran);
		})->values()->all();
	}

	/**
	 * Run an array of migrations
	 *
	 * @param Migration[] $migrations
	 */
	public function runPending(array $migrations) : void {
		// First, make sure there are migrations to run.
		if(empty($migrations)) {
			$this->note("Nothing to migrate.");
			return;
		}

		// Get the next batch number for the migrations so we can insert
		// the correct batch number in the database migrations repository.
		$batch = $this->repository->getNextBatchNumber();

		// Loop over the migrations and run them "up" so the changes are made
		// to the database. We'll then log that the migration was run so we
		// don't repeat it next time we execute.
		foreach($migrations as $migration) {
			$this->runUp($migration, $batch);
		}
	}

	/**
	 * Run "up" a migration instance
	 *
	 * @param Migration $migration
	 * @param int       $batch
	 */
	protected function runUp(Migration $migration, int $batch) {
		// Resolve the migration name
		$name = $this->getMigrationName($migration);

		$this->note("Migrating: {$name}");

		$this->runMigration($migration, "up");

		// Once the migration has run we'll log it so that we don't try to
		// run it again next time we do a migration.
		$this->repository->log($name, $batch);

		$this->note("Migrated: {$name}");
	}

	/**
	 * Rollback the last migration operation
	 *
	 * @return Migration[]
	 */
	public function rollback() : array {
		$this->notes = [];

		// We want to pull in the last batch of migrations that ran on the previous
		// migration operation. We'll then reverse those migrations and run each
		// of them "down" to reverse the last migration "operation" which ran.
		$migrations = $this->getMigrationsForRollback();

		if(empty($migrations)) {
			$this->note("Nothing to rollback.");
			return [];
		}

		return $this->rollbackMigrations($migrations);
	}

	/**
	 * Get the migrations for a rollback operation
	 *
	 * @return array
	 */
	protected function getMigrationsForRollback() : array {
		return $this->repository->getLast();
	}

	/**
	 * Rollback the given migrations
	 *
	 * @param array $rows
	 *
	 * @return array
	 */
	protected function rollbackMigrations(array $rows) {
		$rolledBack = [];

		$resolved = $this->getMigrations($rows, $this->manager->getMigrations());

		// Loop through all the migrations and call the "down" method which will
		// reverse each migration in order. This getLast method on the repository
		// already returns these migrations's names in reverse order.
		foreach($rows as $row) {
			$row = (object) $row;

			if(!$migration = Arr::get($resolved, $row->migration)) {
				$this->note("Migration not found: {$row->migration}");
				continue;
			}

			$rolledBack[] = $migration;

			$this->runDown($migration);
		}

		return $rolledBack;
	}

	/**
	 * Rolls all of the currently applied migrations back
	 *
	 * @return Migration[]
	 */
	public function reset() : array {
		$this->notes = [];

		// Reverse the migration list so we can run them back in the correct
		// order for resetting this database. This will allow us to get the
		// database back into its "empty" state.
		$rows = array_reverse($this->repository->getRan());

		if(empty($rows)) {
			$this->note("Nothing to rollback.");
			return [];
		}

		return $this->resetMigrations($rows);
	}

	/**
	 * Reset the given migrations
	 *
	 * @param array $rows
	 *
	 * @return Migration[]
	 */
	protected function resetMigrations(array $rows) : array {
		// Since the getRan method that retrieves the migration name just gives us the
		// migration name, we will format the names into objects with the name as a
		// property on the objects so we can pass it to the rollback method
		$rows = collect($rows)->map(function($m) {
			return (object) ["migration" => $m];
		})->all();

		return $this->rollbackMigrations($rows);
	}

	/**
	 * Run "down" a migration instance
	 *
	 * @param Migration $migration
	 */
	protected function runDown(Migration $migration) {
		// Resolve migration name
		$name = $this->getMigrationName($migration);

		$this->note("Rolling back: {$name}");

		$this->runMigration($migration, "down");

		// Once the migration has been run "down" we'll remove it from the migration
		// repository so it will be considered to have not been run.
		$this->repository->delete($migration);

		$this->note("Rolled back: {$name}");
	}

	/**
	 * Run a migration inside a transaction if the database supports it.
	 *
	 * @param Migration $migration
	 * @param string    $method
	 */
	protected function runMigration(Migration $migration, string $method) {
		$connection = $this->resolveConnection($migration->getConnection());

		$callback = function() use ($migration, $method) {
			if(method_exists($migration, $method)) {
				$migration->{$method}();
			}
		};

		if($this->getSchemaGrammar($connection)->supportsSchemaTransactions() and $migration->withinTransaction) {
			$connection->transaction($callback);
		} else {
			$callback();
		}
	}

	/**
	 * @param array $rows
	 * @param Migration[] $migrations
	 *
	 * @return Migration[]
	 */
	public function getMigrations(array $rows, array $migrations) : array {
		$return = [];
		foreach($rows as $row) {
			foreach($migrations as $migration) {
				if($this->getMigrationName($migration) === $row["migration"]) {
					$return[$row["migration"]] = $migration;
					continue;
				}
			}
		}

		return $return;
	}

	/**
	 * Get the name of a migration
	 *
	 * @param Migration $migration
	 *
	 * @return string
	 */
	public function getMigrationName(Migration $migration) : string {
		return (new \ReflectionObject($migration))->getShortName();
	}

	/**
	 * Set the default connection name
	 *
	 * @param null|string $name
	 */
	public function setConnection(?string $name) {
		if(is_null($name)) {
			$this->resolver->setDefaultConnection($name);
		}

		$this->repository->setSource($name);

		$this->connection = $name;
	}

	/**
	 * Resolve the database connection instance
	 *
	 * @param null|string $connection
	 *
	 * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Connection|ConnectionInterface
	 */
	public function resolveConnection(?string $connection) {
		return $this->resolver->connection($connection ?? $this->connection);
	}

	/**
	 * Get the schema grammar from a database connection
	 *
	 * @param Connection $connection
	 *
	 * @return Grammar
	 */
	protected function getSchemaGrammar(Connection $connection) : Grammar {
		if(is_null($grammar = $connection->getSchemaGrammar())) {
			$connection->useDefaultSchemaGrammar();
			$grammar = $connection->getSchemaGrammar();
		}

		return $grammar;
	}

	/**
	 * Get the migration repository instance
	 *
	 * @return DatabaseMigrationRepository
	 */
	public function getRepository() : DatabaseMigrationRepository {
		return $this->repository;
	}

	/**
	 * Determine if the migration repository exists
	 *
	 * @return bool
	 */
	public function repositoryExists() : bool {
		return $this->repository->repositoryExists();
	}

	/**
	 * Queue a note for the migrator
	 *
	 * @param string $message
	 */
	protected function note(string $message) : void {
		$this->notes[] = $message;
	}

	/**
	 * @return string[]
	 */
	public function getNotes() : array {
		return $this->notes;
	}

}