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

        // Verificar los permiso
        if (isset($_SESSION['user_id'])) {
            $userProfileId = $_SESSION['user_profile_id'];
            $requestUri = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);

             // Definir los módulos y rutas accesibles para cada perfil
             $accessibleModules = [
                1 => ['/' => true], // Perfil 1: Acceso a todo
                2 => [
                    '/dashboard' => true, // Perfil 2: Acceso al módulo clientes y sus rutas
                    '/logout' => true, // Perfil 2: Acceso al módulo clientes y sus rutas
                    '/atenciones/rtatenciones' => true,
                    '/atenciones/apiGetAtenciones' => true,
                    '/atenciones/apiGetTodayAtenciones' => true,
                    '/atenciones/apiRegistrar' => true,
                    '/atenciones/apiActualizarRT' => true,
                    '/atenciones/apiEliminar' => true,
                    '/calendario' => true,
                ]
                    // Verificar si el perfil tiene acceso al módulo actual
                   
            ];

            $hasAccess = false;
            foreach ($accessibleModules[$userProfileId] as $modulePath => $allowed) {
                if (strpos($requestUri, $modulePath) === 0) {
                    $hasAccess = true;
                    break;
                }
            }

            if (!$hasAccess) {
                http_response_code(403); // Acceso denegado
                require_once "../app/views/403.php";
                exit;
            }
        }
    }

    private static function isLoginPage() {
        $currentPage = $_SERVER['REQUEST_URI'];
        return strpos($currentPage, '/login') !== false;
    }
}
