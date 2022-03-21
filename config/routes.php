<?php

use Controllers\ExchangeController;

checkRoute('GET', '/\/calculate/', function() {
    ExchangeController::index();
});

function checkRoute($method, $pattern, $callback){
    if($method !== $_SERVER['REQUEST_METHOD']){
        return 0;
    }
    if(preg_match_all($pattern, $_SERVER['REQUEST_URI'], $matches)){
        $callback($matches);
    }
}