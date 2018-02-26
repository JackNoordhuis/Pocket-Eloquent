<?php

declare(strict_types=1);

namespace jacknoordhuis\pocketeloquent\facade;

/**
 * @method static \Illuminate\Database\Schema\Builder create(string $table, \Closure $callback)
 * @method static \Illuminate\Database\Schema\Builder drop(string $table)
 * @method static \Illuminate\Database\Schema\Builder dropIfExists(string $table)
 * @method static \Illuminate\Database\Schema\Builder table(string $table, \Closure $callback)
 *
 * @see \Illuminate\Database\Schema\Builder
 */
class Schema extends Facade {

	/**
	 * Get a schema builder instance for a connection.
	 *
	 * @param  string  $name
	 * @return \Illuminate\Database\Schema\Builder
	 */
	public static function connection($name) {
		return static::$pocketEloquent->getDatabaseManager()->getDatabaseCapsule()->connection($name)->getSchemaBuilder();
	}

	/**
	 * Get a schema builder instance for the default connection.
	 *
	 * @return \Illuminate\Database\Schema\Builder
	 */
	protected static function getFacadeAccessor() {
		return static::$pocketEloquent->getDatabaseManager()->getDatabaseCapsule()->connection()->getSchemaBuilder();
	}

}