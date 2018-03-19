<?php
//
//class Users extends Model
//{
//    public function user_by_name(string $name)
//    {
//        $result = $this->db->query("SELECT * FROM `users` WHERE `name` = ?", [$name]);
//
//        return array_pop($result);
//    }
//
//    public function users_by_limit(int $limit = 1000)
//    {
//        return $this->db->query("SELECT * FROM `users` LIMIT $limit");
//    }
//
//    public function add_user(string $name, string $pass, int $access)
//    {
//        $this->db->query("INSERT INTO `users` (`name`, `password`, `access`) VALUES (?, ?, ?)", [$name, $pass, $access]);
//    }
//}
