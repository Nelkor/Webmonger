<?php

class DB
{
    private static $pdo;

    public function __construct()
    {
        if ( ! self::$pdo) {
            $db = require 'application/config/db.php';

            self::$pdo = new PDO('mysql:host=localhost;dbname=' . $db['name'], $db['user'], $db['password']);
        }
    }

    public function query(string $query, array $args = [])
    {
        if ($args) {
            $result = self::$pdo->prepare($query);

            $result->execute($args);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return self::$pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function last_insert_id()
    {
        return self::$pdo->lastInsertId();
    }
}
