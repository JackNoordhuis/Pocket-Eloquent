<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Broadcasting\Factory as BroadcastingFactoryContract;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Broadcasting\Factory
 */
class Broadcast extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BroadcastingFactoryContract::class;
    }
}
