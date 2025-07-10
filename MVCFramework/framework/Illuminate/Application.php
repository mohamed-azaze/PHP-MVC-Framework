<?php
namespace Illuminate;

use Illuminate\Router\Router;

class Application
{
    protected $router;

    public function start()
    {
        $this->router = new Router;

        $this->webRoute();

        // var_dump($this->router->getRoutes());
    }

    public function __destruct()
    {
        $this->router->dispatch($_SERVER['REDIRECT_URL'], $_SERVER['REQUEST_METHOD']);
    }

    function webRoute()
    {
        include route_path("web");
    }

}
