<?php

if (! function_exists("base_path")) {
    function base_path(string $file = null): string
    {
        $file = rtrim(ltrim($file, "/"), "/");
        return DIR_PATH . "/../$file/";
    }
}

if (! function_exists("config")) {
    function config(string $file = null) //: string
    {
        $seprate = explode(".", $file);

        if ((! empty($seprate) && count($seprate) > 1) && ! is_null($file)) {

            $file = include base_path("config") . "$seprate[0].php";

            return isset($file[$seprate[1]]) ? $file[$seprate[1]] : $file;
        }
        return $file;
    }
}

if (! function_exists("route_path")) {
    function route_path(string $path): string
    {
        $path = ltrim($path, "/");
        return config("route.path") . "$path.php";
    }
}

if (! function_exists("route")) {
    function route(string $url)
    {
        // $spreate = explode('.', $url);
        // if (count($spreate) > 1) {
        //     $_SERVER['REDIRECT_URL']   = $spreate[0];
        //     Router::$controller_method = $spreate[1];
        //     echo $spreate[0];
        // }
        //  else {

        //     echo $url;
        // }

    }
}
