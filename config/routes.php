<?php

use Bramus\Router\Router;
use Controllers\ExchangeController;
use Controllers\PostsApiController;
use Controllers\PostsController;

$router = new Router();

$router->get('/exchange', function() {
    ExchangeController::index();
});
$router->get('/api/posts/(\d+)', function($id) {
    PostsApiController::show($id);
});
$router->get('/api/posts', function() {
    PostsApiController::index();
});
$router->post('/api/posts', function() {
    PostsApiController::create();
});
$router->post('/api/posts/edit/(\d+)', function($id) {
    PostsApiController::edit($id);
});
$router->get('/posts', function() {
    PostsController::getPosts();
});
$router->get('/posts/create', function() {
    PostsController::createPost();
});


$router->run();