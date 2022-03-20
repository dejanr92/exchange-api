<?php

use Bramus\Router\Router;
use Controllers\ExchangeController;
use Controllers\PostsController;

$router = new Router();

$router->get('/exchange', function() {
    ExchangeController::index();
});
$router->get('/api/posts/(\d+)', function($id) {
    PostsController::show($id);
});
$router->get('/api/posts', function() {
    PostsController::index();
});
$router->post('/api/posts', function() {
    PostsController::create();
});
$router->post('/api/posts/edit/(\d+)', function($id) {
    PostsController::edit($id);
});
$router->get('', function() {
    PostsController::loadHtml();
});


$router->run();