<?php

// Отключите dev перед релизом
require_once 'application/lib/dev.php';

require_once 'application/core/Router.php';

$router = new Router;
$router->run(trim(explode('?', $_SERVER['REQUEST_URI'], 2)[0], '/'));
