<?php
define("DIR_PATH", __DIR__);

require_once __DIR__ . "/../vendor/autoload.php";
include "../resources/views/dashboard.blade.php";

session_start();

$_SESSION['TOKEN'] = true;
// session_destroy();

(new Illuminate\Application)->start();
