<?php

use Bramus\Router\Router;
use Controllers\ExchangeController;

$router = new Router();

$router->get('', ExchangeController::index());

