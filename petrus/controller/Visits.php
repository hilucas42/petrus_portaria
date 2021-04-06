<?php
namespace controller;

class Visits {
    public static function get() {
        $v = \model\Visit::readAll();
        \view\View::render($view = 'visits', $args = ['visits' => $v]);
    }
}
