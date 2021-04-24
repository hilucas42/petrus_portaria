<?php
namespace controller;

class Router {

    private $query;
    private $route;
    private $arg;

    public function __construct($path, $query) {
        $this->query = $query;
        list($route, $arg) = explode('/', $path);
        $this->route = isset($route) ? $route : '/';
        $this->arg = isset($arg) ? $arg : '';
    }

    public function dispatch() {
        // Delegates authentication routes to the controller in charge
        if ($this->route === 'login' or $this->route === 'logout') {
            Auth::handle($this->route);
            return;
        }

        // Redirects unauthenticated users to login page
        if (!Auth::userLoggedIn()) {
            header('Location: /login');
            return;
        }

        // Delegates routes to the corresponding controller

        if ($this->route == '' or $this->route == 'index') {
            \view\View::render();
            return;
        }
        
        try {
            $ctl = '\\controller\\' . ucfirst($this->route);
            $method = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
            switch ($method) {
                case 'GET':
                    $ctl::get($this->arg);
                    break;
                case 'POST':
                    $ctl::post();
                    break;
                case 'PUT':
                    $ctl::put($this->arg);
                    break;
                case 'PATCH':
                    $ctl::patch($this->arg);
                    break;
                case 'DELETE':
                    $ctl::delete($this->arg);
                    break;
                default:
                    $ctl::post();
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            header('Location: /');
        }
    }
}
