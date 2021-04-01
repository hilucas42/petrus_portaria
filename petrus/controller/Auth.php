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

        if (!isset($_SESSION) || !isset($_SESSION['userid'])) {
            return 'GUEST';
        }
        return 'ADMIN';
        //return $usercontroller.getUser($_SESSION['userid']).getRole();
    }

    private static function login() {
        // We received some credentials, let's chech it
        if ($_POST['username'] && $_POST['password']) {
            if ($_POST['password'] == $_POST['username'].'123') {
                $_SESSION['userid'] = hash('md5', $_POST['username']);
            } else {
                \view\View::render('login', [badlogin => true]);
                return;
            }
        }

        # User logged in, redirects to main page
        if ($_SESSION && $_SESSION['userid']) {
            header("Location: .");
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
        header("Location: login");
    }

    public static function handle($route) {
        session_start();
        Auth::$route();
    }
}
