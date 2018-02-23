<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Testing\Fakes\BusFake;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Bus\Dispatcher as BusDispatcherContract;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Bus\Dispatcher
 */
class Bus extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return void
     */
    public static function fake()
    {
        static::swap(new BusFake);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BusDispatcherContract::class;
    }
}
