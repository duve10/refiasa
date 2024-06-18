<?php
require_once '../app/models/Mascota.php';
require_once '../app/models/Especie.php';
require_once '../app/models/Raza.php';

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
                'columnName' => $_POST['columnName'] ?? ''
                
            ];

            $totalRecords = Mascota::getTotal();
            $mascotas = Mascota::getAll($filters);

            $data = [];
            foreach ($mascotas as $mascota) {
                $data[] = [
                    'id' => $mascota['id'],
                    'nombre' => $mascota['nombre'],
                    'especie' => $mascota['especie'],
                    'raza' => $mascota['raza'],
                    'edad' => $mascota['edad'],
                    'peso' => $mascota['peso'],
                    'altura' => $mascota['altura'],
                    'nombreCliente' => $mascota['nombreCliente'] . " " . $mascota['apellido_paterno'],
                    'apellido_paterno' => $mascota['apellido_paterno'],
                    'username' => $mascota['username'],
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


            $nombre = trim($_POST['nombre']) ?? null;
            $creado_por = $_SESSION['user_id'];
            $id_cliente = trim($_POST['id_cliente']);
            $fecha_nac = convertirFechaBd($_POST['fecha_nac']);
            $sexo = trim($_POST['sexo']);
            $id_raza = $_POST['id_raza'];
            $estado = 1;
            $foto = $_POST['foto'];
            $peso = $_POST['peso'];
            $altura = $_POST['altura'];
            $comentario = trim($_POST['comentario']);



            if (!$nombre || !$id_cliente || !$fecha_nac || !$sexo || !$id_raza) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }

            $mascota = new Mascota(null, $nombre, $creado_por, $id_cliente, $creado_por, null, $estado, $fecha_nac, $sexo, $id_raza, $comentario, $foto);

            if ($mascota->guardar()) {

           
                MascotaPeso::registrarPeso($mascota->getId(), $peso, $creado_por);
                MascotaAltura::registrarAltura($mascota->getId(), $altura, $creado_por);
               

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

}
