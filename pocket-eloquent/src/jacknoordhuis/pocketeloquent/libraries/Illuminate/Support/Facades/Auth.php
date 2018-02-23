<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @method static mixed guard(string|null $name = null)
 * @method static void shouldUse(string $name);
 * @method static bool check()
 * @method static bool guest()
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static int|null id()
 * @method static bool validate(array $credentials = [])
 * @method static void setUser(\jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Authenticatable $user)
 * @method static bool attempt(array $credentials = [], bool $remember = false)
 * @method static bool once(array $credentials = [])
 * @method static void login(\jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Authenticatable $user, bool $remember = false)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Authenticatable loginUsingId(mixed $id, bool $remember = false)
 * @method static bool onceUsingId(mixed $id)
 * @method static bool viaRemember()
 * @method static void logout()
 *
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Auth\AuthManager
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Factory
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\Guard
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Contracts\Auth\StatefulGuard
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @return void
     */
    public static function routes()
    {
        static::$app->make('router')->auth();
    }
}
