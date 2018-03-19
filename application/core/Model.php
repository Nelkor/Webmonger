<?php

require_once 'application/classes/DB.php';

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }
}
