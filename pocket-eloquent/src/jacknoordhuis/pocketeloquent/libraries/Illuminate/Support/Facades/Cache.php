<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Cache\CacheManager
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Cache\Repository
 */
class Cache extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cache';
    }
}
