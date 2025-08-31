<?php
namespace Illuminate\Router;

use Illuminate\Router\Traits\methods;

class Route extends Router
{
    use methods;

    public function middleware(string | array $middleware): route
    {
        $middle = array_key_last(parent::$allRoutes);

        if (is_string($middleware)) {

            if (isset(parent::$allRoutes[$middle]['middleware'])) {

                parent::$allRoutes[$middle]['middleware'] = [parent::$allRoutes[$middle]['middleware'], $middleware];

            }
        } else {

            parent::$allRoutes[$middle]['middleware'] = $middleware;
        }

        return new static;
    }

    public static function middlewareGroup(string | array $middleware): route
    {
        static::$middleware[] = $middleware;

        return new static;
    }
}
