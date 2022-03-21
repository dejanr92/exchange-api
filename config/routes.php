<?php

use Controllers\ExchangeController;
use Controllers\PostsApiController;
use Controllers\PostsController;

checkRoute('GET', '/^\/calculate$/', function() {
    ExchangeController::index();
});
checkRoute('GET', '/^\/api\/posts\/(\d+)$/', function($id) {
    PostsApiController::show($id[1]);
});
checkRoute('GET', '/^\/api\/posts$/', function() {
    PostsApiController::index();
});
checkRoute('POST', '/^\/api\/posts$/', function() {
    PostsApiController::create();
});
checkRoute('POST', '/^\/api\/posts\/edit\/(\d+)$/', function($id) {
    PostsApiController::edit($id[1]);
});
checkRoute('GET', '/^\/posts$/', function() {
    PostsController::getPosts();
});
checkRoute('GET', '/^\/posts\/create$/', function() {
    PostsController::createPost();
});

function checkRoute($method, $pattern, $callback){
    if($method !== $_SERVER['REQUEST_METHOD']){
        return 0;
    }
    if(preg_match_all($pattern, explode('?', $_SERVER['REQUEST_URI'])[0], $matches)){
        $callback($matches);
    }
}
