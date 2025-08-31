<?php
namespace Illuminate\Middleware;

class Middleware
{
    public static function middlewareHandler(string $request, string | array $middleware, callable $controller)
    {
        if (is_array($middleware)) {
            $middlewareChain = array_reduce(array_reverse($middleware), function ($next, $middlewareClass) {
                return function ($request) use ($middlewareClass, $next) {
                    return (new $middlewareClass)->handle($request, $next);
                };
            },
                fn($req) => call_user_func($controller, $req),
            );
            return $middlewareChain($request);
        }

        $next = function ($request) use ($controller, $middleware) {

            return (new $middleware)->handle($request, $controller);

        };

        return $next($request);
    }
}
