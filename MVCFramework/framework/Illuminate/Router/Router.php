<?php
namespace Illuminate\Router;

class Router
{

    protected static array $allRoutes = [];
    public static $middleware;

    public static function add(string $method, string $route, $controller)
    {
        echo "<pre>";

        static::$allRoutes[] = [
            "method"     => $method,
            "route"      => $route,
            "controller" => $controller,
        ];

    }

    public function getRoutes()
    {
        return static::$allRoutes;
    }

    public function dispatch(string $url, string $method)
    {
        $url              = str_replace("/new-MVC-project/public/", "", $url);
        $seprateUrl       = explode('.', $url);
        $conroller_method = null;
        if (! is_null($seprateUrl) && count($seprateUrl) > 1) {
            $conroller_method = $seprateUrl[1];
            $url              = $seprateUrl[0];
        } else {
            $url = $url;
        }

        $method = strtoupper($method);

        foreach (static::$allRoutes as $routes) {
            if ($routes['method'] == $method) {

                foreach ($routes as $route) {
                    if ($route == $url) {

                        if (is_array($routes['controller'])) {

                            echo call_user_func([new $routes['controller'][0], $routes['controller'][1]]);
                        } elseif (is_callable($routes['controller'])) {
                            (new $routes['middleware'])->handle($url, call_user_func($routes['controller']));
                            // echo call_user_func($routes['controller']);
                        } elseif (new $routes['controller']) {
                            echo call_user_func([new $routes['controller'], $conroller_method]);
                        }
                    }
                }
            }
        }
        // var_dump($method);
    }

    public function middleware(string $middleware)
    {
        $middle = array_key_last(static::$allRoutes);

        static::$allRoutes[$middle]['middleware'] = $middleware;

        return $this;

    }
}
