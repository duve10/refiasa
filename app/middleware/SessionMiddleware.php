<?php
// app/middleware/SessionMiddleware.php

class SessionMiddleware
{
    public static function handle()
    {

        if (session_status() === PHP_SESSION_NONE && !self::isLoginPage()) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) && !self::isLoginPage() && !self::isPublicRoute()) {
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
                    '/atenciones/apiMes' => true,
                    '/calendario' => true,
                ],
                3 => [
                    '/dashboard' => true, // Perfil 2: Acceso al módulo clientes y sus rutas
                    '/logout' => true,
                    '/citas' => true,
                    '/citas/registro' => true,
                    '/citas/registro' => true,
                    '/citas/apiGetCitas' => true,
                    '/citas/apiRegistrar' => true,
                    '/citas/getApiListaHorasPorFecha' => true,
                    '/citas/apiEliminar' => true,
                    '/citas/getServiciosCita' => true,
                    '/citas/apiUpdateEstadoCita' => true,


                    '/atenciones' => true,
                    '/atenciones/apiGetAtenciones' => true,
                    '/atenciones/apiGetTodayAtenciones' => true,
                    '/atenciones/apiRegistrar' => true,
                    '/atenciones/apiActualizarRT' => true,
                    '/atenciones/apiEliminar' => true,
                    '/atenciones/getServicioProducto' => true,
                    '/atenciones/apiMes' => true,

                    '/usuarios/apiGetVetSelect' => true,

                    '/calendario' => true,
                    '/calendario/apiGetCitasAtenciones' => true,

                    '/clientes' => true,
                    '/clientes/apiGetClientes' => true,
                    '/clientes/apiGetClientesSelect' => true,
                    '/clientes/apiRegistrar' => true,

                    '/mascotas' => true,
                    '/mascotas/apiGetMascotas' => true,
                    '/mascotas/apiGetMascotasByCliente' => true,
                    '/mascotas/apiRegistrar' => true,
                    '/mascotas/apiEliminar' => true,

                    '/servicios' => true,
                    '/servicios/apiGetServicios' => true,
                    '/servicios/apiRegistrar' => true,
                    '/servicios/apiEliminar' => true,

                    '/productos' => true,
                    '/productos/apiGetProductos' => true,
                    '/productos/apiRegistrar' => true,
                    '/productos/apiEliminar' => true,

                    '/razas/apiGetRaza' => true,
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

    private static function isLoginPage()
    {
        $currentPage = $_SERVER['REQUEST_URI'];
        return strpos($currentPage, '/login') !== false;
    }

    private static function isPublicRoute()
    {   
        $currentPage = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);
        $publicRoutes = ['/mimascota'];

        // Separar la ruta de los parámetros de consulta
        $path = parse_url($currentPage, PHP_URL_PATH);
        
        return in_array($path, $publicRoutes);
    }
}
