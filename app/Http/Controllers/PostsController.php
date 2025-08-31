<?php
namespace App\Http\Controllers;

class PostsController
{
    public function index($id, $name)
    {
        return "index from controller id = $id and name = $name";
    }

    public function update($id, $name)
    {
        return "update from controller id = $id and name = $name";
    }

    public function new ($id, $code)
    {
        return "new from controller id = $id and code = $code";
    }
}
