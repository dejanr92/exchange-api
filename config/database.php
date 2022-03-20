<?php

define('DB_CONFIG', [
    'host'   => $_ENV['DB_HOST'],
    'password'   => $_ENV['DB_PASS'],
    'username'   => $_ENV['DB_USERNAME'],
    'database'   => $_ENV['DB_DATABASE'],
    'host'       => sprintf("mysql:host=%s;dbname=%s", $_ENV['DB_HOST'], $_ENV['DB_DATABASE']),
]);