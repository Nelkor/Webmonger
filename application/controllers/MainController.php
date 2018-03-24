<?php

class MainController extends Controller
{
    public function mainAction()
    {
        $page = Output::html('main');

        $this->respond($page);
    }

    public function infoAction()
    {
        phpinfo();
    }
}
