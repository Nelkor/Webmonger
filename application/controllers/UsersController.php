<?php

class UsersController extends Controller
{
    private function saveUser($id, $name, $rights)
    {
        $this->session->set('login_id', $id);
        $this->session->set('login_name', $name);
        $this->session->set('login_rights', $rights);
    }

    public function checkNameAction()
    {
        $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);

        if (strlen($name) > 20 || ! preg_match('/^[a-z][a-z0-9]+$/is', $name)) {
            Output::json('ok', ['good_name' => false, 'reason' => 'unfit']);
        }

        if ( ! $this->loadModel('Users')) {
            Output::json('error', ['reason' => 'model']);
        }

        $db_users = new Users;

        $existing = $db_users->user_by_name($name);

        if ($existing) {
            Output::json('ok', ['good_name' => false, 'reason' => 'taken']);
        }

        Output::json('ok', ['good_name' => true]);
    }

    public function checkEmailAction()
    {
        $gmail = filter_input(INPUT_GET, 'gmail', FILTER_VALIDATE_EMAIL);

        if ($gmail) {
            $address = explode('@', $gmail, 2);

            if (count($address) < 2 || $address[1] != 'gmail.com') {
                $gmail = '';
            }
        }

        if ( ! $gmail) {
            Output::json('ok', ['good_email' => false, 'reason' => 'unfit']);
        }

        if ( ! $this->loadModel('Users')) {
            Output::json('error', ['reason' => 'model']);
        }

        $db_users = new Users;

        $existing = $db_users->user_by_email($gmail);

        if ($existing) {
            Output::json('ok', ['good_email' => false, 'reason' => 'taken']);
        }

        Output::json('ok', ['good_email' => true]);
    }

    public function regAction()
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);

        if (strlen($name) > 20 || ! preg_match('/^[a-z][a-z0-9]+$/is', $name)) {
            $name = '';
        }

        if (strlen($pass) < 6) {
            $pass = '';
        }

        if ($gmail) {
            $address = explode('@', $gmail, 2);

            if (count($address) < 2 || $address[1] != 'gmail.com') {
                $gmail = '';
            }
        }

        if ( ! $this->loadModel('Users')) {
            Output::json('error', ['reason' => 'model']);
        }

        $db_users = new Users;

        $existing_name = $db_users->user_by_name($name);
        $existing_gmail = $db_users->user_by_email($gmail);

        if ($existing_name || $existing_gmail) {
            $name = '';
        }

        if ( ! $name || ! $pass || ! $gmail) {
            Output::json('ok', ['success' => false, 'reason' => 'bad data']);
        }

        $salt = md5(time() . rand(-1000000, 1000000));
        $hash = hash('sha256', $salt . $pass);

        $login_id = $db_users->add_user($name, $gmail, $hash, $salt, 1);

        if ( ! $login_id) {
            Output::json('error', ['reason' => 'insert']);
        }

        $this->saveUser($login_id, $name, 1);

        Output::json('ok', ['success' => true, 'html' => Output::html('auth/leave', ['name' => $name])]);
    }

    public function authAction()
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        $brut = $this->cache->get($name);

        if ($brut) {
            Output::json('ok', ['success' => false, 'reason' => 'frequency']);
        }

        $this->cache->set($name, true, 1);

        if ( ! $this->loadModel('Users')) {
            Output::json('error', ['reason' => 'model']);
        }

        $db_users = new Users;

        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            $user = $db_users->user_by_email($name);
        } else {
            $user = $db_users->user_by_name($name);
        }

        if ( ! $user) {
            Output::json('ok', ['success' => false, 'reason' => 'name']);
        }

        $hash = hash('sha256', $user['salt'] . $pass);

        if ($hash != $user['password']) {
            Output::json('ok', ['success' => false, 'reason' => 'password']);
        }

        $this->saveUser($user['id'], $user['name'], $user['status']);

        Output::json('ok', ['success' => true, 'html' => Output::html('auth/leave', ['name' => $user['name']])]);
    }

    public function leaveAction()
    {
        $this->saveUser(null, null, null);

        Output::json('ok', ['html' => Output::html('auth/enter')]);
    }
}
