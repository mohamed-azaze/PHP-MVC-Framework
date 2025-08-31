<?php

use App\Http\Controllers\PostsController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UsersMiddleware;
use Illuminate\Router\Route;

// Route::get("posts/{id}/{name}", function ($id, $name) {

//     echo "posts from function id = $id and name = $name";

// })->middleware([AuthMiddleware::class, UsersMiddleware::class]);

// Route::get("user/{id}/{name}", [PostsController::class, "index"])->middleware([AuthMiddleware::class, UsersMiddleware::class]);
// Route::get("users/{id}/{name}", PostsController::class)->middleware(AuthMiddleware::class);

// Route::post("post", function () {
//     echo "users";
// });

// Route::get("post2/{id}/{name}", function ($id, $name) {
//     echo "post2 from function name $name and id $id";
// })->middleware(AuthMiddleware::class);

Route::middlewareGroup(AuthMiddleware::class)->group(function () {
    // Route::get("post3", function () {
    //     echo "post3 from Group";
    // });

    Route::get("new/{id}/{code}", [PostsController::class, "new"])->middleware(UsersMiddleware::class);
});

Route::middlewareGroup(UsersMiddleware::class)->group(function () {
    Route::get("users/{id}/{name}", function ($id, $name) {
        echo "post3 from Group";
    });

    Route::get("user/{id}/{name}", [PostsController::class, "index"])->middleware(AuthMiddleware::class);
});
