<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder create(string $table, \Closure $callback)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder drop(string $table)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder dropIfExists(string $table)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder table(string $table, \Closure $callback)
 *
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder
 */
class Schema extends Facade
{
    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder
     */
    public static function connection($name)
    {
        return static::$app['db']->connection($name)->getSchemaBuilder();
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::$app['db']->connection()->getSchemaBuilder();
    }
}
