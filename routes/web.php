<?php

use App\Http\Controllers\PostsController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Illuminate\Router\Route;

Route::get("post", function () {
    echo "posts from function";
})->middleware(AuthMiddleware::class);
// Route::get("users", function () {
//     echo "users";
// });

Route::get("user", [PostsController::class, "index"]);
Route::get("users", PostsController::class)->middleware(UsersMiddleware::class);

// Route::post("post", function () {
//     echo "users";
// });
