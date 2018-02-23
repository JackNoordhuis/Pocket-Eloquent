<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\database;

use jacknoordhuis\pocketeloquent\database\migration\MigrationManager;
use jacknoordhuis\pocketeloquent\PocketEloquentCapsule;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Capsule\Manager as DatabaseCapsule;

class DatabaseManager {

	/** @var PocketEloquentCapsule */
	private $pocketEloquent;

	/** @var DatabaseCapsule */
	private $capsule;

	/** @var MigrationManager */
	private $migrationManager;

	const DEFAULT_CAPSULE_KEY = "default";

	public function __construct(PocketEloquentCapsule $pocketEloquent) {
		$this->pocketEloquent = $pocketEloquent;

		$this->bootEloquent($pocketEloquent->getDefaultDatabaseCredentials());

		$this->migrationManager = new MigrationManager($this);
	}

	/**
	 * Boot the eloquent database capsule
	 *
	 * @param DatabaseCredentials $credentials
	 */
	private function bootEloquent(DatabaseCredentials $credentials) : void {
		$this->capsule = new DatabaseCapsule();

		$this->capsule->addConnection($credentials->toArray());

		$this->capsule->setAsGlobal();  // Make static methods available globally
		$this->capsule->bootEloquent(); // Setup the eloquent ORM
	}

	/**
	 * @return PocketEloquentCapsule
	 */
	public function getPocketEloquent() : PocketEloquentCapsule {
		return $this->pocketEloquent;
	}

	/**
	 * @return DatabaseCapsule
	 */
	public function getDatabaseCapsule() : DatabaseCapsule {
		return $this->capsule;
	}

	/**
	 * @return MigrationManager
	 */
	public function getMigrationManager() : MigrationManager {
		return $this->migrationManager;
	}

}