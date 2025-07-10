<?php
namespace Illuminate\Middleware;

class Middleware
{
    public static function middlewareHandler(string $request, string $middleware, callable $controller)
    {
        $next = function ($request) use ($controller, $middleware) {

            return (new $middleware)->handle($request, $controller);

        };

        return $next($request);
    }
}
