<?php
namespace controller;

/**
 * Auth - authentication and authorization functions
 * 
 * Author: Lucas
 */
class Auth {
    public static function getUserRole() {
        session_start();
        // We must check if user is logged in, and if it has admin privileges
        if (!isset($_SESSION) || !isset($_SESSION['userdata'])) {
            return 'GUEST';
        }
        return $_SESSION['userdata']['isadm'] ? 'ADMIN' : 'USER';
    }

    private static function login() {
        // We received some credentials, let's chech it
        if ($_POST['username'] && $_POST['password']) {
            $u = new \model\User($_POST['username'], $_POST['password']);
            if ($u->validateLogin()) {
                $_SESSION['userdata'] = [
                    'username' => $u->username,
                    'fullname' => $u->fullname,
                    'isadm' => $u->isadm,
                    'email' => $u->email,
                    'phone' => $u->phone
                ];
            } else {
                \view\View::render('login', ['badlogin' => true]);
                return;
            }
        }

        # User logged in, redirects to main page
        if (isset($_SESSION) && isset($_SESSION['userdata'])) {
            header('Location: /');
            return;
        }

        \view\View::render('login');
    }

    private static function logout() {
        # We can clear the session now
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: /login');
    }

    public static function handle($route) {
        session_start();
        Auth::$route();
    }
}
