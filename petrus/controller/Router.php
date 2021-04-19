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
            header('Location: /login');
            return;
        }

        // Delegates routes to the corresponding controller

        if (is_null($route) || $route == '' or $route == 'index') {
            \view\View::render();
            return;
        }
        
        try {
            $ctl = '\\controller\\' . ucfirst($route);
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $ctl::get();
                    break;
                case 'POST':
                    $ctl::post();
                case 'PUT':
                    $ctl::post();
                case 'DELETE':
                    $ctl::post();
                default:
                    throw new \Exception('Unknown method');
            }
        } catch (\Exception $e) {
            \view\View::render();
        }
    }
}

