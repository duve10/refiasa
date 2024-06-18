<?php
require_once '../app/models/Raza.php';

class RazaController
{
    public function apiGetRaza()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_especie'])) {
            $id_especie = $_GET['id_especie'];
            $razas = Raza::getRazaByEspecie($id_especie);

            $response = [
                'error' => true,
                'message' => 'Error desconocido.',
                'data' => []
            ];

            if ($razas) {

                $response['error'] = false;
                $response['message'] = 'Encontrado';

                foreach ($razas as $raza) {
                    $response['data'][] = [
                        'id' => $raza['id'],
                        'nombre' => $raza['nombre']
                    ];
                }
            } else {
                $response['error'] = false;
                $response['message'] = 'Ocurrio un Error';
            }

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Bad Request'], JSON_UNESCAPED_UNICODE);
        }
    }
}
