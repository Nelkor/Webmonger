<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($var, bool $exit = true) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';

    if ($exit) {
        exit;
    }
}

function dump($var, bool $exit = true) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';

    if ($exit) {
        exit;
    }
}
