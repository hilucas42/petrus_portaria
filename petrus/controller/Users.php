<?php
namespace controller;

class Users {
    public static function get() {
        if (Auth::getUserRole() != 'ADMIN') {
            return;
        }
        $v = \model\User::readAll();
        \view\View::render($view = 'users', $args = ['users' => $v]);
    }
}
