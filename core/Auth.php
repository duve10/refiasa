<?php

class Auth {
    public static function check() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'public/login.php');
            exit();
        }
    }

    public static function login($user_id) {
        $_SESSION['user_id'] = $user_id;
    }

    public static function logout() {
        session_destroy();
    }
}
