<?php
define("DIR_PATH", __DIR__);

require_once __DIR__ . "/../vendor/autoload.php";
include "../resources/views/dashboard.blade.php";
(new Illuminate\Application)->start();
