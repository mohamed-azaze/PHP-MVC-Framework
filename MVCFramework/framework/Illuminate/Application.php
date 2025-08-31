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

    }

    public function __destruct()
    {
        $this->router->dispatch(parse_url($_SERVER['REQUEST_URI'])['path'], $_SERVER['REQUEST_METHOD']);
    }

    function webRoute()
    {
        include route_path("web");
    }

}
