<?php
namespace Illuminate\Middleware\Contract;

interface Middleware
{
    public function handle($request, $next);
}
