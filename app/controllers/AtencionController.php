<?php
require_once '../app/models/Atencion.php';
require_once '../app/models/Servicio.php';
require_once '../app/models/AtencionServicio.php';
require_once '../app/helpers/functions.php';

class AtencionController {
    public function index() {
        
        require_once '../app/views/atenciones/index.php';
    }

    public function registro()
    {
        
        $servicios = Servicio::getAllServicios();
        require_once '../app/views/atenciones/registro.php';
    }

    public function apiGetAtenciones() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? ''
                
            ];

            $totalRecords = Atencion::getTotal();
            $atenciones = Atencion::getAll($filters);

            $data = [];
            foreach ($atenciones as $atencion) {
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
                    'nombreCliente' => $atencion['cliente'] . " " . $atencion['apellido_paterno'],
                    'telefono' => $atencion['telefono'],
                    'correo' => $atencion['correo'],
                    'username' => $atencion['username'],
                    'especie' => $atencion['especie'],
                    'veterinario' => $atencion['veterinarionombre'] . " " . $atencion['veterinarioapellido'],
                    'estadoatencion' => '<span class="badge '.$atencion['estadoatencioncolor'].' text-dark">'.$atencion['estadoatencion'].'</span>',
                    'acciones' => '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
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


            $id_mascota = isset($_POST['id_mascota']) ?? null;
            $creado_por = $_SESSION['user_id'];
            $id_cita = trim($_POST['id_cita']);
            $veterinario = trim($_POST['veterinario']);
            $fecha = convertirFechaBd($_POST['fecha']);
            $descripcion = trim($_POST['descripcion']);
            $servicios = $_POST['id_servicio'] ?? [];
            $estado = 1;
            $id_estadocita = $_POST['id_estadocita'] ?? 1;
            $comentario = trim($_POST['comentario']);


            


            if (!$id_mascota || !$descripcion || !$comentario || empty($servicios)) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }

            //$cita = new Cita(null, $id_mascota, $creado_por, $fecha, $descripcion, $estado, null, $id_estadocita, $comentario, $id_tipocita);

            /*if ($cita->guardar()) {

                foreach ($servicios as $id_servicio) {
                    CitaServicio::asignarServicioACita($cita->getId(), $id_servicio);
                }

                $response['error'] = false;
                $response['message'] = 'Cita registrada correctamente.';
            } else {
                $response['message'] = 'Error al registrar la cita.';
            }*/
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }
}
