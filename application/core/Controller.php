<?php

require_once 'application/classes/Session.php';
require_once 'application/classes/Cache.php';

abstract class Controller
{
    protected $session;
    protected $request; // а реквест не лишний, случайно? Проверить
    protected $cache;

    protected function loadModel(string $name)
    {
        $path = "application/models/$name.php";
        $result = file_exists($path);

        if ($result) {
            require_once 'application/core/Model.php';
            require_once $path;
        }

        return $result;
    }

    protected function respond(string $page)
    {
        if (filter_has_var(INPUT_GET, 'ajax')) {
            Output::json('ok', [
                'html' => $page,
                'url' => $this->request
            ]);
        }

        echo Output::html('wrapper', ['page' => $page]);
    }

    protected function redirect(string $path)
    {
        if (filter_has_var(INPUT_GET, 'ajax')) {
            $router = new Router;
            $router->run($path);
        } else {
            header("Location: /$path");
            exit;
        }
    }

    public function __construct()
    {
        $this->session = Session::handle();
        $this->cache = Cache::handle();
    }

    public function __invoke(string $action, int $access, string $request)
    {
        $rights = $this->session->get_int('login_rights');

        if ( ! $access || ($rights & $access)) {
            $this->request = $request;

            $this->$action();
        } else {
            Output::error('403');
        }
    }
}
