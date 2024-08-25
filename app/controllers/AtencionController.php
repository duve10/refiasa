<?php
require_once '../app/models/Atencion.php';
require_once '../app/models/Producto.php';
require_once '../app/models/Servicio.php';
require_once '../app/models/AtencionServicio.php';
require_once '../app/models/AtencionProducto.php';
require_once '../app/helpers/functions.php';

class AtencionController
{
    public function index()
    {

        require_once '../app/views/atenciones/index.php';
    }

    public function rtAtenciones()
    {

        require_once '../app/views/atenciones/rtatenciones.php';
    }


    public function registro()
    {

        $servicios = Servicio::getAllServicios();
        require_once '../app/views/atenciones/registro.php';
    }

    public function apiGetAtenciones()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'id_cliente' => $_POST['id_cliente'] ?? '',
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? '',
                'fecha_desde' => convertirFechaBd($_POST['fecha_desde']) ?? '',
                'fecha_hasta' => convertirFechaBd($_POST['fecha_hasta']) ?? ''

            ];

            $totalRecords = Atencion::getTotal();
            $atenciones = Atencion::getAll($filters);

            $data = [];
            foreach ($atenciones as $atencion) {
                $clienteName = $atencion['cliente'] . " " . $atencion['apellido_paterno'];

                $id_estadoatencion = $atencion['id_estadoatencion'];
                $btnView = '';
                if ($id_estadoatencion == '3') {
                    $btnView = '  <a data-id="' . $atencion['id'] . '"  class="text-info viewAtt" href="#">
                        <i class="align-middle me-2 fas fa-fw fa-eye"></i>
                    </a>';
                }

                $data[] = [
                    'id' => $atencion['id'],
                    'descripcion' => $atencion['descripcion'],
                    'fecha' => $atencion['fecha'],
                    'observaciones' => $atencion['observaciones'],
                    'diagnosticos' => $atencion['diagnosticos'],
                    'tratamiento' => $atencion['tratamiento'],
                    'id_cita' => $atencion['id_cita'],
                    'mascota' => $atencion['mascota'],
                    'edad' => $atencion['edad'],
                    'nombreCliente' => $clienteName,
                    'telefono' => $atencion['telefono'],
                    'correo' => $atencion['correo'],
                    'username' => $atencion['username'],
                    'especie' => $atencion['especie'],
                    'veterinario' => $atencion['veterinarionombre'] . " " . $atencion['veterinarioapellido'],
                    'estadoatencion' => '<span class="badge ' . $atencion['estadoatencioncolor'] . ' text-dark">' . $atencion['estadoatencion'] . '</span>',
                    'acciones' => $btnView . '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a data-nombre = "' . $clienteName . '" data-id = "' . $atencion['id'] . '" class="text-danger deleteAtencion ms-1"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                   ',
                ];
            }

            $response = [
                'data' => $data,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords
            ];

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }


    public function apiRegistrar()
    {

        header('Content-Type: application/json');

        $response = [
            'error' => true,
            'message' => 'Error desconocido.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $fechaSet =  $_POST['fecha'] ?? '';
            if ($fechaSet != '') {
                $dateTime = DateTime::createFromFormat('d-m-Y H:i', $_POST['fecha']);

                $fecha_hora_mysql = $dateTime->format('Y-m-d H:i');
            } else {
                $fecha_hora_mysql = date('Y-m-d H:i');
            }

            $id_cita =  null;
            $id_mascota = ($_POST['id_mascota']) ?? null;
            $descripcion = trim($_POST['descripcion']);

            $observacion = $_POST['observacion'] ?? '';
            $diagnosticos = $_POST['diagnosticos'] ?? '';
            $tratamiento = $_POST['tratamiento'] ?? '';

            $fecha = $fecha_hora_mysql;
            $creado_por = $_SESSION['user_id'];
            $estado = 1;
            $servicios = $_POST['id_servicio'] ?? [];
            $id_estadoatencion = $_POST['id_estadoatencion'] ?? 2;
            $veterinario = isset($_POST['veterinario']) ? $_POST['veterinario'] : '';


            if (!$veterinario || !$id_mascota || !$descripcion || empty($servicios)) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }


            $atencion = new Atencion(null, $id_cita, $id_mascota, $descripcion, $observacion, $diagnosticos, $tratamiento, $fecha, $creado_por, null, $estado, $id_estadoatencion, $veterinario);

            if ($atencion->guardar()) {

                foreach ($servicios as $id_servicio) {
                    AtencionServicio::asignarServicioAAtencion($atencion->getId(), $id_servicio);
                }


                $response['error'] = false;
                $response['message'] = 'Atencion registrada correctamente.';
            } else {
                $response['message'] = 'Error al registrar la atencion.';
            }
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function apiActualizarRT()
    {
        header('Content-Type: application/json');

        $response = [
            'error' => true,
            'message' => 'Error desconocido.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_atencion = trim($_POST['id_atencion']);
            $id_cita = trim($_POST['id_cita']);
            $id_mascota = trim($_POST['id_mascota']);
            $descripcion = trim($_POST['descripcion']);
            $peso = trim($_POST['peso']);
            $altura = trim($_POST['altura']);
            $observaciones = trim($_POST['observaciones']);
            $diagnosticos = trim($_POST['diagnosticos']);
            $tratamiento = trim($_POST['tratamiento']);
            $actualizado_por = $_SESSION['user_id'];
            $servicios = $_POST['id_servicio'] ?? [];
            $productos = $_POST['id_producto'] ?? [];


            $estado = 1;
            $id_estadoatencion = 3;

            if (!$tratamiento || !$diagnosticos || !$descripcion || !$observaciones || empty($servicios)) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }



            $atencion = new Atencion($id_atencion, $id_cita, $id_mascota, $descripcion, $observaciones, $diagnosticos, $tratamiento, NULL, NULL, $actualizado_por, $estado, $id_estadoatencion, NULL);


            if ($atencion->actualizarRT()) {

                foreach ($productos as $id_producto) {
                    AtencionProducto::asignarProductoAAtencion($id_atencion, $id_producto);
                }

                $response['error'] = false;
                $response['message'] = 'Atencion registrada correctamente.';
            } else {
                $response['message'] = 'Error al registrar la atencion.';
            }
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function apiGetTodayAtenciones()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $fecha = $_GET['fecha'];

            $viewVet = false;
            $idVet = $_SESSION['user_id'];
            if ($_SESSION['user_profile_id'] == 2) {
                $viewVet = true;
            }

            $filters = [
                'start' => convertirFechaBd($fecha) . ' 00:00:00',
                'end' => convertirFechaBd($fecha) . ' 23:59:59',
                'viewVet' => $viewVet,
                'idVet' => $idVet,
            ];




            $atenciones = Atencion::getAllAttencionesByDateAll($filters);
            $productos = Producto::getAllProductos();
            $data = [];
            $listId = [];
            foreach ($atenciones as $atencion) {
                $listId[] =  $atencion['id'];

                $servicios = AtencionServicio::getAllServiciosByAtencion($atencion['id']);

                $fechaNacimiento = new DateTime($atencion['fecha_nac']); // Crear un objeto DateTime con la fecha de nacimiento
                $hoy = new DateTime(); // Objeto DateTime para la fecha actual

                // Calcular la diferencia de años
                $diferencia = $hoy->diff($fechaNacimiento);

                $edadAnios = $diferencia->y; // Obtener los años completos
                $edadMeses = $diferencia->m; // Obtener los meses
                $edadDias = $diferencia->d; // Obtener los meses

                $edad = '';
                if ($edadAnios != 0) {
                    $edad = $edadAnios . ' años';
                } else {
                    if ($edadMeses != 0) {
                        $edad = $edadMeses . ' meses';
                    } else {
                        $edad = $edadDias . ' dias';
                    }
                }


                $data[] = [
                    'id' => $atencion['id'],
                    'descripcion' => $atencion['descripcion'],
                    'fecha' => convertirFechaHoraHtml($atencion['fecha']),
                    'observaciones' => $atencion['observaciones'],
                    'diagnosticos' => $atencion['diagnosticos'],
                    'id_mascota' => $atencion['id_mascota'],
                    'tratamiento' => $atencion['tratamiento'],
                    'id_cita' => $atencion['id_cita'],
                    'mascota' => $atencion['mascota'],
                    'peso' => $atencion['peso'],
                    'altura' => $atencion['altura'],
                    'servicios' => $servicios,
                    'edad' => $edad,
                    'nombreCliente' => $atencion['cliente'] . " " . $atencion['apellido_paterno'],
                    'telefono' => $atencion['telefono'],
                    'correo' => $atencion['correo'],
                    'username' => $atencion['username'],
                    'especie' => $atencion['especie'],
                    'veterinario' => $atencion['veterinarionombre'] . " " . $atencion['veterinarioapellido'],
                    'estadoatencion' => '<span class="badge ' . $atencion['estadoatencioncolor'] . ' text-dark">' . $atencion['estadoatencion'] . '</span>',
                    'acciones' => '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
                ];
            }

            $response = [
                'data' => $data,
                'listId' => $listId,
                'productos' => $productos
            ];

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }

    public function apiEliminar()
    {
        header('Content-Type: application/json');

        $response = [
            'error' => true,
            'message' => 'Error desconocido.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $actualizado_por = $_SESSION['user_id'];
            $id_atencion = $_POST['id'];

            $eliminar = Atencion::eliminar($id_atencion, $actualizado_por);

            if ($eliminar) {
                $response['message'] = 'Eliminado Correctamente';
                $response['error'] = false;
            } else {
                $response['message'] = 'No se Elimino Error!';
            }
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function getServicioProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $idAtt = $_GET['id'];
            $dataArray = [];
            $datos  = Atencion::getServicioProducto($idAtt);

            foreach ($datos as $dato) {

                $data['id'] = $dato['id'];
                $data['nombre'] = $dato['nombre'];
                $data['precio'] = $dato['precio'];
                $data['tipo'] = $dato['tipo'];
                $rutaP = 'img/productos/';
                $rutaS = 'img/servicios/';
                if ($dato['tipo'] == 'producto') {
                    $data['foto'] = $rutaP. $dato['foto'];
                } else {
                    $data['foto'] = $rutaS. $dato['foto'];
                }
                

                array_push($dataArray, $data);
            }

            echo json_encode($dataArray, JSON_UNESCAPED_UNICODE);
        }
    }

    public function apiMes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {


            $atenciones = Atencion::getPorMes();
            $data = [];
            foreach ($atenciones as $atencion) {
                $data[] =  $atencion['total_atenciones'] ;
            }

            $response = [
                "series" => $data
             ] ;

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}
