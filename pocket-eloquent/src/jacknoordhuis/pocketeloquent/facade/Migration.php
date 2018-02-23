<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\facade;

/**
 * @method static register(\jacknoordhuis\pocketeloquent\database\migration\Migration $migration)
 * @method static registerAll(\jacknoordhuis\pocketeloquent\database\migration\Migration[] $migrations)
 *
 * @see \jacknoordhuis\pocketeloquent\database\migration\MigrationManager
 */
class Migration extends Facade {

	/**
	 * Get the migration manager instance.
	 *
	 * @return \jacknoordhuis\pocketeloquent\database\migration\MigrationManager
	 */
	protected static function getFacadeAccessor() {
		return static::$pocketEloquent->getDatabaseManager()->getMigrationManager();
	}

}