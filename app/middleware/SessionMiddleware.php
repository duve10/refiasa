<?php
// app/middleware/SessionMiddleware.php

class SessionMiddleware {
    public static function handle() {

        if (session_status() === PHP_SESSION_NONE && !self::isLoginPage()) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) && !self::isLoginPage()) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }

    private static function isLoginPage() {
        $currentPage = $_SERVER['REQUEST_URI'];
        return strpos($currentPage, '/login') !== false;
    }
}
