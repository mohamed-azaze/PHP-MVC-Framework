<?php
define("DIR_PATH", __DIR__);

define('ROOT_DIR', '/new-MVC-project/public/');

require_once __DIR__ . "/../vendor/autoload.php";

include "../resources/views/dashboard.blade.php";

// var_dump(route('users.update'));
echo "<pre>";
// // var_dump($_SERVER);
// session_start();

// $_SESSION['TOKEN'] = true;
// $_SESSION['PASS']  = true;
// // session_destroy();

(new Illuminate\Application)->start();
