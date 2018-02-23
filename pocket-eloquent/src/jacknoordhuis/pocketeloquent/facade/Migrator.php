<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\facade;

/**
 * @method static \jacknoordhuis\pocketeloquent\database\migration\Migration[] run()
 * @method static \jacknoordhuis\pocketeloquent\database\migration\Migration[] rollback()
 * @method static \jacknoordhuis\pocketeloquent\database\migration\Migration[] reset()
 *
 * @see \jacknoordhuis\pocketeloquent\database\migration\Migrator
 */
class Migrator extends Facade {

	/**
	 * Get the migrator instance.
	 *
	 * @return \jacknoordhuis\pocketeloquent\database\migration\Migrator
	 */
	protected static function getFacadeAccessor() {
		return static::$pocketEloquent->getDatabaseManager()->getMigrationManager()->getMigrator();
	}

}