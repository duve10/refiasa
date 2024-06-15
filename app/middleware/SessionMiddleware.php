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
        // Lógica para determinar si la solicitud está en la página de inicio de sesión
        // Por ejemplo, puedes verificar la URL actual, la ruta o cualquier otro criterio específico
        // Aquí un ejemplo simple:
        $currentPage = $_SERVER['REQUEST_URI'];
        return strpos($currentPage, '/login') !== false;
    }
}
