<?php
namespace controller;

class Visitors {
    public static function get() {
        $v = \model\Visitor::readAll();
        \view\View::render($view = 'visitors', $args = ['visitors' => $v]);
    }
}
