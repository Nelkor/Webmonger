<?php

class Users extends Model
{
    public function user_by_name(string $name)
    {
        $result = $this->db->query("SELECT * FROM `users` WHERE `name` = ?", [$name]);

        return array_pop($result);
    }

    public function user_by_email(string $email)
    {
        $result = $this->db->query("SELECT * FROM `users` WHERE `email` = ?", [$email]);

        return array_pop($result);
    }

    public function add_user(string $name, string $gmail, string $pass, string $salt, int $status)
    {
        $this->db->query("INSERT INTO `users` (`name`, `email`, `password`, `salt`, `status`) VALUES (?, ?, ?, ?, ?)", [$name, $gmail, $pass, $salt, $status]);

        return $this->db->last_insert_id();
    }
}
