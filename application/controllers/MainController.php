<?php

class MainController extends Controller
{
    private function columns(string $first)
    {
        $login_name = $this->session->get_str('login_name');

        if ($login_name) {
            $auth = Output::html('auth/leave', ['name' => $login_name]);
        } else {
            $auth = Output::html('auth/enter');
        }

        $page = Output::html('columns', ['first' => $first, 'auth' => $auth]);

        $this->respond($page);
    }

    public function mainAction()
    {
        $page = Output::html('main');

        $this->columns($page);
    }

    public function downloadsAction()
    {
        $page = Output::html('downloads');

        $this->columns($page);
    }

    public function guidesAction()
    {
        $page = Output::html('guides');

        $this->columns($page);
    }

    public function contactsAction()
    {
        $page = Output::html('contacts');

        $this->columns($page);
    }
}
