<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

use jacknoordhuis\pocketeloquent\libraries\Illuminate\Notifications\ChannelManager;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Notifications\AnonymousNotifiable;
use jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Testing\Fakes\NotificationFake;

/**
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Notifications\ChannelManager
 */
class Notification extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Testing\Fakes\NotificationFake
     */
    public static function fake()
    {
        static::swap($fake = new NotificationFake);

        return $fake;
    }

    /**
     * Begin sending a notification to an anonymous notifiable.
     *
     * @param  string  $channel
     * @param  mixed  $route
     * @return \jacknoordhuis\pocketeloquent\libraries\Illuminate\Notifications\AnonymousNotifiable
     */
    public static function route($channel, $route)
    {
        return (new AnonymousNotifiable)->route($channel, $route);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ChannelManager::class;
    }
}
