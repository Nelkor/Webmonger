<?php

require_once 'application/core/Output.php';

class Router
{
    public function run($request)
    {
        $routes = require 'application/config/routes.php';

        if (array_key_exists($request, $routes)) {
            $route = $routes[$request];

            $controller = ucfirst($route['controller']) . 'Controller'; // если правильно писать контроллеры в путях, ucfirst не нужен
            $action = $route['action'] . 'Action';

            $path = "application/controllers/$controller.php";

            if (file_exists($path) && ( ! $route['ajax-only'] || filter_has_var(INPUT_GET, 'ajax'))) {
                require_once 'application/core/Controller.php';
                require_once $path;

                if (method_exists($controller, $action)) {
                    $object = new $controller;
                    $object($action, $route['access'], $request);

                    return;
                }
            }
        }

        Output::error('404');
    }
}
