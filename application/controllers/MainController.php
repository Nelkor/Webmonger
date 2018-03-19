<?php

class MainController extends Controller
{
    public function mainAction()
    {
        $page = View::render('main');

        $this->respond($page);
    }
}
