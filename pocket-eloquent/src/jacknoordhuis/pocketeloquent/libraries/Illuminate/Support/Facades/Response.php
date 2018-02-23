<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Routing\ResponseFactory as ResponseFactoryContract;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Routing\ResponseFactory
 */
class Response extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ResponseFactoryContract::class;
    }
}
