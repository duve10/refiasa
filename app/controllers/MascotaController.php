<?php
require_once '../app/models/Mascota.php';
require_once '../app/models/Especie.php';
require_once '../app/models/Raza.php';
require_once '../app/models/Peso.php';
require_once '../app/models/Altura.php';
require_once '../app/helpers/functions.php';

class MascotaController {
    public function index() {
        $especies = Especie::getEspecies();
        require_once '../app/views/mascotas/index.php';
    }

    public function apiGetMascotas() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? '',
                'filtroEspecie' => $_POST['filtroEspecie'] ?? ''
                
            ];

            $totalRecords = Mascota::getTotal();
            $mascotas = Mascota::getAll($filters);

            $data = [];
            foreach ($mascotas as $mascota) {

                $fechaNacimiento = new DateTime($mascota['fecha_nac']); // Crear un objeto DateTime con la fecha de nacimiento
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
                    'id' => $mascota['id'],
                    'nombre' => $mascota['nombre'],
                    'especie' => $mascota['especie'],
                    'raza' => $mascota['raza'],
                    'edad' => $edad,
                    'peso' => $mascota['peso'],
                    'altura' => $mascota['altura'],
                    'nombreCliente' => $mascota['nombreCliente'] . " " . $mascota['apellido_paterno'],
                    'apellido_paterno' => $mascota['apellido_paterno'],
                    'username' => $mascota['username'],
                    'acciones' => '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3 deleteMascota" data-nombre="'.$mascota['nombre'].'" data-id="'.$mascota['id'].'"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
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

    public function apiGetMascotasByCliente() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCliente = $_POST['idCliente'] ?? '';

            $response = [
                'error' => true,
                'message' => 'Error desconocido.',
                'data' => []
            ];

            $mascotas = Mascota::getMascotasByCliente($idCliente);
            
            if ($mascotas) {

                $response['error'] = false;

                foreach ($mascotas as $mascota) {
                    $response['data'][] = [
                        'id' => $mascota['id'],
                        'nombre' => $mascota['nombre'],
                        'peso' => $mascota['peso'],
                        'edad' => $mascota['edad'],
                    ];
                }
            } else {
                $response['error'] = false;
                $response['message'] = 'Ocurrio un Error';
            }

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            return;
        }  else {
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

            $uploadDir = '../public/img/mascotas/';

            $nombre = trim($_POST['nombre']) ?? null;
            $creado_por = $_SESSION['user_id'];
            $id_cliente = trim($_POST['id_cliente']);
            $fecha_nac = convertirFechaBd($_POST['fecha_nac']);
            $sexo = trim($_POST['sexo']);
            $id_raza = $_POST['raza'];
            $estado = 1;
            $imagen = $_FILES['foto'] ?? null;
            $peso =  number_format((float)$_POST['peso'], 2, '.', '');
            $altura = $_POST['altura'];
            $comentario = trim($_POST['comentario'])??'';

            $pathFoto = '';
        

            if (!$nombre || !$id_cliente || !$fecha_nac || !$sexo || !$id_raza) {
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

            

            $mascota = new Mascota(null, $nombre, $id_cliente, $creado_por, null, $estado, $fecha_nac, $sexo, $id_raza, $comentario, $pathFoto);

            if ($mascota->guardar()) {

                $peso = new Peso(null,$mascota->getId(),$peso,$creado_por);
                $peso->guardar();
                $altura = new Altura(null,$mascota->getId(), $altura, $creado_por);
                $altura->guardar();
               

                $response['error'] = false;
                $response['message'] = 'Mascota registrada correctamente.';
            } else {
                $response['message'] = 'Error al registrar mascota.';
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
            $id_mascota = $_POST['id'];

            $eliminar = Mascota::eliminar($id_mascota,$actualizado_por);

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
