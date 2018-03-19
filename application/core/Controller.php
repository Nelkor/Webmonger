<?php

require_once 'application/classes/Session.php';

abstract class Controller
{
    protected $session;
    protected $request;

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
            View::response('ok', [
                'html' => $page,
                'url' => $this->request
            ]);
        }

        echo View::render('wrapper', ['page' => $page]);
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
    }

    public function __invoke(string $action, array $access, string $request)
    {
        $rights = explode(',', $this->session->get_str('login_rights'));

        if ( ! $access || array_intersect($rights, $access)) {
            $this->request = $request;

            $this->$action();
        } else {
            View::error('403');
        }
    }
}
