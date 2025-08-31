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
        $routeLastKey = array_key_last(static::$allRoutes);

        $middleware != '' ? static::$allRoutes[$routeLastKey]['middleware'] = $middleware : '';

    }

    public function dispatch(string $url, string $method)
    {
        // var_dump(static::$allRoutes);
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
        if (isset(parse_url($_SERVER['REQUEST_URI'])['query'])) {

            parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $params);
        } else {
            $params = [];
        }
        foreach (static::$allRoutes as $routes) {

            if ((isset($routes['method'])) && $routes['method'] == $method) {
                $pettern = preg_replace("/\{([a-zA-Z0-9_]+)\}/", "(?P<$1>[a-zA-Z0-9_]+)", $routes['route']);

                if (explode('/', $pettern)[0] == $url) {
                    if (is_array($routes['controller'])) {
                        if (isset($routes['middleware'])) {

                            Middleware::middlewareHandler($url, $routes['middleware'],

                                static::controllerHandler($routes['controller'][0], $routes['controller'][1], $params)
                            );

                        } else {

                            call_user_func(static::controllerHandler($routes['controller'][0], $routes['controller'][1], $params));

                        }

                    } elseif (is_callable($routes['controller'])) {

                        if (isset($routes['middleware'])) {

                            $controller = $routes['controller'];

                            $functions = function () use ($controller, $params) {
                                echo call_user_func_array($controller, $params);
                            };

                            Middleware::middlewareHandler($url, $routes['middleware'], $functions);

                        } else {

                            static::controllerHandler($routes['controller'], null, $params);

                        }

                    } elseif (is_object(new $routes['controller'])) {

                        if (isset($routes['middleware'])) {

                            Middleware::middlewareHandler($url, $routes['middleware'],
                                static::controllerHandler($routes['controller'], $conroller_method, $params)
                            );

                        } else {
                            call_user_func(static::controllerHandler($routes['controller'], $conroller_method, $params));
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

    protected static function controllerHandler(string | callable $controller, string | null $method = null, array $params = [])
    {

        if (! is_null($method)) {
            return function () use ($controller, $method, $params) {
                echo call_user_func_array([new $controller, $method], $params);
            };
        } else {
            echo call_user_func_array($controller, $params);

        }

    }

}
