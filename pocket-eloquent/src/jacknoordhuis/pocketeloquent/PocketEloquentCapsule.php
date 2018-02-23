<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent;

use jacknoordhuis\pocketeloquent\database\DatabaseCredentials;
use jacknoordhuis\pocketeloquent\database\DatabaseManager;

interface PocketEloquentCapsule {

	/**
	 * Get the default database connection credentials
	 *
	 * @return DatabaseCredentials
	 */
	public function getDefaultDatabaseCredentials() : DatabaseCredentials;

	/**
	 * Get the database manager
	 *
	 * @return DatabaseManager
	 */
	public function getDatabaseManager() : DatabaseManager;

}