<?php
namespace App\Http\Middleware;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (! isset($_SESSION['TOKEN'])) {
            return false;
        }

        return $next($request);

    }
}
