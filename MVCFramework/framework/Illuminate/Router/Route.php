<?php
namespace Illuminate\Router;

use Illuminate\Router\Traits\methods;

class Route extends Router
{
    use methods;

    public static function middleware(string | array $middleware): route
    {
        $middle = array_key_last(parent::$allRoutes);

        parent::$allRoutes[$middle]['middleware'] = $middleware;

        return new static;

    }
}
