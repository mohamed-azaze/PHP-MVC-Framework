<?php
namespace App\Http\Middleware;

class UsersMiddleware
{
    public function handle($request, $next)
    {
        if (! isset($_SESSION['PASS'])) {
            return false;
        }

        return $next($request);

    }
}
