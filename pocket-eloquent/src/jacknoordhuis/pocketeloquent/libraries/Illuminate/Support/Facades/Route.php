<?php

namespace jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades;

/**
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route get(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route post(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route put(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route delete(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route patch(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route options(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route any(string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route match(array|string $methods, string $uri, \Closure|array|string|null $action = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route prefix(string  $prefix)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Routing\PendingResourceRegistration resource(string $name, string $controller, array $options = [])
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Routing\PendingResourceRegistration apiResource(string $name, string $controller, array $options = [])
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route middleware(array|string|null $middleware)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route substituteBindings(\jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route $route)
 * @method static void substituteImplicitBindings(\jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route $route)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route as(string $value)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route domain(string $value)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route name(string $value)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route namespace(string $value)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route where(array|string $name, string $expression = null)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Routing\Router group(\Closure|string|array $value)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route redirect(string $uri, string $destination, int $status = 301)
 * @method static \jacknoordhuis\pocketeloquent\libraries\Illuminate\Support\Facades\Route view(string $uri, string $view, array $data = [])
 *
 * @see \jacknoordhuis\pocketeloquent\libraries\Illuminate\Routing\Router
 */
class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
