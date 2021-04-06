<?php
namespace controller;

class Router {

    protected $viewpath = 'dashboard.php';

    public function __construct($view = 'index') {
        $this->viewpath = $view;
    }

    public function dispatch($route) {
        error_log("Router: vai agora manipular a rota \"$route\"");

        // Delegates authentication routes to the controller in charge
        if ($route === 'login' or $route === 'logout') {
            error_log('Router: delega para Auth');
            Auth::handle($route);
            return;
        }

        // Identifies the user role
        $role = Auth::getUserRole();

        // Redirects unauthenticated users to login page
        if ($role === 'GUEST') {
            error_log('Router: redireciona para login');
            header("Location: login");
            return;
        }

        // Delegates routes to the corresponding controller
        
        
        \view\View::render();
    }
}

