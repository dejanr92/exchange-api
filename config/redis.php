<?php

define('REDIS_CONFIG', [
    'scheme' => 'tcp',
    'host'   => $_ENV['REDIS_HOST'],
    'port'   => $_ENV['REDIS_PORT'],
    'ttl'   => $_ENV['REDIS_DEFAULT_TTL']
]);