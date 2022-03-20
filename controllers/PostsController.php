<?php

namespace Controllers;

class PostsController {


    public static function getPosts()
    {
        readfile("../views/posts.html");
    }
    public static function createPost()
    {
        readfile("../views/create.html");
    }
}