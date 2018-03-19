<?php

class Session
{
    private static $handle;

    private function __construct()
    {
        session_start();
    }

    public static function handle()
    {
        if ( ! self::$handle) {
            self::$handle = new self;
        }

        return self::$handle;
    }

    public function get_int(string $name)
    {
        return (int)($_SESSION[$name] ?? 0);
    }

    public function get_str(string $name)
    {
        return (string)($_SESSION[$name] ?? '');
    }

    public function set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }
}
