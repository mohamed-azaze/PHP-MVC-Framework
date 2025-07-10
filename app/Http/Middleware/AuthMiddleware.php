<?php
namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (! isset($request['posts'])) {
            return null;
        }
        return $request;

    }
}
