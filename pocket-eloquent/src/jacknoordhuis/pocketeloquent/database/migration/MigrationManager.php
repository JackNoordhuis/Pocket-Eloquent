<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database\migration;

use jacknoordhuis\pocketeloquent\database\DatabaseManager;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Migrations\DatabaseMigrationRepository;

class MigrationManager {

	/** @var DatabaseManager */
	private $manager;

	/** @var Migrator */
	private $migrator;

	/** @var Migration[] */
	private $migrationPool;

	public function __construct(DatabaseManager $manager) {
		$this->manager = $manager;
		$this->migrator = new Migrator($this, new DatabaseMigrationRepository($manager->getDatabaseCapsule()->getDatabaseManager(), "migrations"), $this->manager->getDatabaseCapsule()->getDatabaseManager());

		if(!$this->migrator->repositoryExists()) {
			$this->migrator->getRepository()->createRepository();
		}
	}

	/**
	 * Get the migrator instance
	 *
	 * @return Migrator
	 */
	public function getMigrator() : Migrator {
		return $this->migrator;
	}

	/**
	 * Get the registered migration
	 *
	 * @return Migration[]
	 */
	public function getMigrations() : array {
		return $this->migrationPool;
	}

	/**
	 * Register an array of migrations
	 *
	 * @param Migration[] $migrations
	 */
	public function registerAll(array $migrations) {
		foreach($migrations as $migration) {
			$this->register($migration);
		}
	}

	/**
	 * Register a migration instance
	 *
	 * @param Migration $migration
	 */
	public function register(Migration $migration) : void {
		$migration->setManager($this);
		$this->migrationPool[$migration->getId()] = $migration;
	}

}