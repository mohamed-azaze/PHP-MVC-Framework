<?php

use App\Http\Middleware\AuthMiddleware;
use Illuminate\Router\Route;

// Route::get("posts", function () {
//     echo "posts from function";
// })->middleware(AuthMiddleware::class);

// Route::get("user", [PostsController::class, "index"])->middleware(AuthMiddleware::class);
// Route::get("users", PostsController::class)->middleware(AuthMiddleware::class);

// Route::post("post", function () {
//     echo "users";
// });

// Route::get("post", function () {
//     echo "post from function";
// });

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get("post", function () {
        echo "post from function";
    });
});
