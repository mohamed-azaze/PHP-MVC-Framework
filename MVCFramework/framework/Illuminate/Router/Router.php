<?php
namespace Illuminate\Router;

use Illuminate\Middleware\Middleware;

class Router
{

    protected static array $allRoutes = [];

    public static array $middleware = [];

    public static function add(string $method, string $route, $controller)
    {
        echo "<pre>";
        $middleware = '';
        if (self::group()) {
            if (! empty(static::$middleware)) {

                $middleLastKey = array_key_last(static::$middleware);
                $middleware    = static::$middleware[$middleLastKey];
            }
        }

        static::$allRoutes[] = [
            "method"     => $method,
            "route"      => $route,
            "controller" => $controller,
        ];
        $middleware != '' ? static::$allRoutes['middleware'] = $middleware : '';

    }

    public function getRoutes()
    {
        return static::$allRoutes;
    }

    public function dispatch(string $url, string $method)
    {
        $url = str_replace("/new-MVC-project/public/", "", $url);

        $seprateUrl = explode('.', $url);

        $conroller_method = null;

        if (! is_null($seprateUrl) && count($seprateUrl) > 1) {

            $conroller_method = $seprateUrl[1];

            $url = $seprateUrl[0];

        } else {
            $url = $url;
        }

        $method = strtoupper($method);

        // var_dump(static::$allRoutes);

        foreach (static::$allRoutes as $routes) {

            if ((isset($routes['method'])) && $routes['method'] == $method) {

                foreach ($routes as $route) {

                    if ($route == $url) {
                        if (is_array($routes['controller'])) {

                            if (isset($routes['middleware'])) {

                                Middleware::middlewareHandler($url, $routes['middleware'],

                                    static::controllerHandler($routes['controller'][0], $routes['controller'][1]));

                            } else {

                                echo call_user_func([new $routes['controller'][0], $routes['controller'][1]]);
                            }

                        } elseif (is_callable($routes['controller'])) {

                            if (isset($routes['middleware'])) {

                                Middleware::middlewareHandler($url, $routes['middleware'], $routes['controller']);

                            } else {

                                echo call_user_func($routes['controller']);
                            }

                        } elseif (new $routes['controller']) {

                            if (isset($routes['middleware'])) {

                                Middleware::middlewareHandler($url, $routes['middleware'],
                                    static::controllerHandler($routes['controller'], $conroller_method)
                                );

                            } else {

                                echo call_user_func([new $routes['controller'], $conroller_method]);
                            }

                        }
                    }
                }
            }
        }
    }

    public static function group(callable $fun = null)
    {
        if (! is_null($fun)) {

            call_user_func($fun, new self);

        }
        return true;
    }

    protected static function controllerHandler(string | array $controller, string $method = null)
    {
        return function () use ($controller, $method) {
            if (! is_null($method)) {
                echo call_user_func([new $controller, $method]);
            } else {
                echo call_user_func([new $controller[0], $controller[1]]);
            }
        };
    }

}
