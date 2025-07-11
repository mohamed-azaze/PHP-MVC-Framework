<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Illuminate\Router\Route;

Route::get("posts", function () {
    echo "posts from function";

})->middleware([AuthMiddleware::class, UsersMiddleware::class]);

// Route::get("user", [PostsController::class, "index"]);
// Route::get("users", PostsController::class)->middleware(AuthMiddleware::class);

// Route::post("post", function () {
//     echo "users";
// });

Route::get("post2", function () {
    echo "post2 from function";
});

// Route::middlewareGroup(AuthMiddleware::class)->group(function () {
//     Route::get("post3", function () {
//         echo "post3 from Group";
//     });

//     Route::get("new", [PostsController::class, "new"])->middleware(UsersMiddleware::class);
// });

// Route::middlewareGroup(UsersMiddleware::class)->group(function () {
//     Route::get("users", function () {
//         echo "post3 from Group";
//     });

//     Route::get("user", [PostsController::class, "new"])->middleware(AuthMiddleware::class);
// });
