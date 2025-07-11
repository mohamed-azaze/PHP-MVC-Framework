<?php
namespace Illuminate\Middleware;

class Middleware
{
    public static function middlewareHandler(string $request, string | array $middleware, callable $controller)
    {
        if (is_array($middleware)) {

            foreach ($middleware as $middle) {
                $next = function ($request) use ($controller, $middle) {

                    return (new $middle)->handle($request, $controller);

                };

            }
        } else {
            $next = function ($request) use ($controller, $middleware) {

                return (new $middleware)->handle($request, $controller);

            };

        }
        return $next($request);
        // $next = function ($request) use ($controller, $middleware) {

        //     return (new $middleware)->handle($request, $controller);

        // };

        // return $next($request);
    }
}
