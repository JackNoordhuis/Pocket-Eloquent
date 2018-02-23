<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

use jacknoordhuis\pocketeloquent\libraries\Psr\Log\LoggerInterface;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Log\Writer
 */
class Log extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LoggerInterface::class;
    }
}
