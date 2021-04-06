<?php
    // Registers the class autoloader
    spl_autoload_register(function ($class) {
        $classfile = str_replace('\\','/',$class) . '.php';
        if (is_readable($classfile)) {
            include($classfile);
        }
    });

    // Extracts the route from the query params
    parse_str($_SERVER['QUERY_STRING'], $requestparam);

    if (isset($requestparam['p'])) {
        $requestpath = $requestparam['p'];
        unset($requestparam['p']);
    } else {
        $requestpath = '';
    }

    // Registers active routes
    $router = new controller\Router('constroi');

    // Delegates to the router
    $router->dispatch($requestpath);
?>
