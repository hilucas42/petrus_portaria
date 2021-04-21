<?php
namespace controller;

class Reports {
    public static function get() {
        \view\View::render($view = 'reports');
    }
}
