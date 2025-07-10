<?php
namespace Illuminate\Router\Traits;

use Illuminate\Router\Router;

trait methods
{
    public static function get(string $route, $controller)
    {
        Router::add("GET", $route, $controller);
        return new static;
    }

    public static function post(string $route, $controller)
    {
        Router::add("POST", $route, $controller);
        return new static;
    }

}
