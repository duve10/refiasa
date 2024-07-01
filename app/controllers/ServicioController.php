<?php
require_once '../app/models/Servicio.php';
require_once '../app/helpers/functions.php';

class ServicioController {
    
    public function index() {
        
        require_once '../app/views/servicios/index.php';
    }

    public function apiGetServicios() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? '',
                'filtroCita' => $_POST['filtroCita'] ?? ''
                
            ];
            
            $totalRecords = Servicio::getTotal();
            $servicios = Servicio::getAll($filters);

            $data = [];
            foreach ($servicios as $servicio) {
                $data[] = [
                    'id' => $servicio['id'],
                    'nombre' => $servicio['nombre'],
                    'foto' => '<img src="img/servicios/'.$servicio['foto'].'" class="avatar img-fluid rounded me-1" alt="name">',
                    'descripcion' => $servicio['descripcion'],
                    'precio' => $servicio['precio'],
                    'username' => $servicio['username'],
                    'acciones' => '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3 deleteServicio"  data-nombre="'.$servicio['nombre'].'" data-id="'.$servicio['id'].'"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
                ];
            }

            $response = [
                'data' => $data,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
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

            $uploadDir = '../public/img/servicios/';

            $nombre = trim($_POST['nombre']) ?? null;
            $descripcion = trim($_POST['descripcion'])??'';
            $precio = trim($_POST['precio']);
            $citas = isset($_POST['citas']) ?? 0;
            $creado_por = $_SESSION['user_id'];
            $estado = 1;
            $imagen = $_FILES['foto'] ?? null;
            $pathFoto = 'servicio.jpg';
            
            if (!$nombre || !$descripcion || !$precio) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }

            if ($imagen["tmp_name"] != '') {
                $uploadResult = handleFileUpload($imagen, $uploadDir);
                if ($uploadResult['error']) {
                    $response['message'] = $uploadResult['message'];
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    return;
                }

                $pathFoto = $uploadResult['filePath'];
            }

      

            $servicio = new Servicio(null, $nombre, $descripcion, $precio, $citas, $creado_por,NULL, $estado, $pathFoto);

            if ($servicio->guardar()) {

              

                $response['error'] = false;
                $response['message'] = 'Servicio registrado correctamente.';
            } else {
                $response['message'] = 'Error al registrar Servicio.';
            }
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function apiEliminar() {
        header('Content-Type: application/json');

        $response = [
            'error' => true,
            'message' => 'Error desconocido.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $actualizado_por = $_SESSION['user_id'];
            $id_servicio = $_POST['id'];

            $eliminar = Servicio::eliminar($id_servicio,$actualizado_por);

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
}
