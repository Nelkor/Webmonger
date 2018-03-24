<?php

class Cache
{
    private static $memcached;

    public static function handle()
    {
        if ( ! self::$memcached) {
            self::$memcached = new Memcached();
            self::$memcached->addServer('localhost', 11211);
        }

        return self::$memcached;
    }
}
