<?php
require_once '../app/models/Mascota.php';

class MascotaController {
    public function index() {
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
                $response['message'] = 'Ocurrio un Error';
            }

            echo json_encode($response);
            return;
        }  else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}
