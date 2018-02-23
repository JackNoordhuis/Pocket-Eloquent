<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\DatabaseManager
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Database\Connection
 */
class DB extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'db';
    }
}
