<?php
namespace view;

class View {

    public static function render($view = 'index', $args = []) {
        if (is_readable('view/' . $view . '.php')) {
            $viewpath = 'view/' . $view . '.php';
        } else {
            throw new \Exception("View $view not found!");
        }

        extract($args, EXTR_OVERWRITE);

        require $viewpath;
    }
}

