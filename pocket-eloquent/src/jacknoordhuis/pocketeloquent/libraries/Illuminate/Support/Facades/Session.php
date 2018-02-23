<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Session\SessionManager
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Session\Store
 */
class Session extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'session';
    }
}
