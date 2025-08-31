<?php
namespace App\Http\Middleware;

use Illuminate\Middleware\Contract\Middleware;

class AuthMiddleware implements Middleware
{
    public function handle($request, $next)
    {
        if (! isset($_SESSION['TOKEN'])) {
            return header("location:" . ROOT_DIR . "resources/views/dashboard.blade.php");
        }

        return $next($request);

    }
}
