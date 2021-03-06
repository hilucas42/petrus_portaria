<?php
namespace controller;

use Exception;

class User {
    public static function get($username, $query) {
        if (Auth::getUserRole() != 'ADMIN' && $username != Auth::getUsername()) {
            return;
        }
        \model\Picture::flush();
        $v = new \model\User();
        $v->readOne($username);
        if ($username == '') {
            \view\View::render($view = 'user');
        } else {
            \view\View::render($view = 'user', $args = [
                'user' => $v,
                'put' => true,
                'message' => isset($query['message']) ? $query['message'] : ''
            ]);
        }
    }

    public static function post() {
        if (Auth::getUserRole() != 'ADMIN') {
            return;
        }
        try {
            $v = new \model\User(
                $username   = $_POST['username'],
                $password   = $_POST['password'],
                $fullname   = $_POST['fullname'],
                $email      = $_POST['email'],
                $phone      = $_POST['phone'],
                $isadm      = isset($_POST['isadm']) ? true : false
            );
            $v->create();
            header('Location: /users');
        } catch (Exception $e) {
            list($err) = explode(':', $e->getMessage());
            \view\View::render($view = 'user', $args = [
                'user' => $v,
                 $err => true
            ]);
        }
    }

    public static function put($username) {
        if (Auth::getUserRole() != 'ADMIN' && $_POST['username'] != Auth::getUsername()) {
            return;
        }
        try {
            $v = new \model\User(
                $username   = $_POST['username'],
                $password   = $_POST['password'],
                $fullname   = $_POST['fullname'],
                $email      = $_POST['email'],
                $phone      = $_POST['phone'],
                $isadm      = isset($_POST['isadm']) ? true : false
            );
            $v->update();
            if (Auth::getUserRole() == 'ADMIN') {
                header('Location: /users');
            } else {
                header('Location: /user/' . $v->username . '?message=success');
            }
        } catch (Exception $e) {
            list($err) = explode(':', $e->getMessage());
            \view\View::render($view = 'user', $args = [
                'user' => $v,
                $err => true,
                'put' => true,
                'message' => 'warning'
            ]);
        }
    }

    public static function delete($username) {
        if (Auth::getUserRole() != 'ADMIN') {
            return;
        }
        try {
            \model\User::delete($username);
            header('Location: /users');
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}
