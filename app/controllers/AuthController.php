<?php
require_once '../app/models/AuthModel.php';

class AuthController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    public function login() {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->authModel->checkLogin($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;

                // Set a cookie for persistent login
                setcookie('user', $username, time() + (86400 * 30), '/', '', false, true); // 30 days, secure & HttpOnly

                header('Location: ' . BASE_URL . '/');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }
        require_once '../app/views/auth/login.php';
    }

    public function register() {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if ($this->authModel->registerUser($name, $email, $username, $password)) {
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            } else {
                $error = 'Registration failed. Username or email might already exist.';
            }
        }
        require_once '../app/views/auth/register.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        session_destroy();

        // Clear the cookie
        setcookie('user', '', time() - 3600, '/', '', false, true);

        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}
