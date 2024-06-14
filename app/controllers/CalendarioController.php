<?php
require_once '../app/config.php';
require_once '../app/models/Cita.php';  // Modelo de Citas
require_once '../app/models/Atencion.php';  // Modelo de Atenciones

class CalendarioController
{
    public function index()
    {
        require_once '../app/views/calendario/index.php';
    }

    public function apiGetCitasAtenciones()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $start = $_GET['start'];
            $end = $_GET['end'];
            $filters = [
                'start' => $start ?? null,
                'end' => $end ?? null,
            ];
            $citas = Cita::getAllCitasByDate($filters);
            $atenciones = Atencion::getAllAttencionesByDate($filters);

            $eventos = array_merge($citas, $atenciones);

            $data = [];
            foreach ($eventos as $evento) {
                $fecha = $evento['fecha'];
                $datetime = new DateTime($fecha);
                $formattedDate = $datetime->format('Y-m-d');
                $data[] = [
                    'id' => $evento['id'],
                    'start' => $formattedDate,
                    'end' => $formattedDate,
                    'title' => $evento['type'],
                    'descripcion' => $evento['descripcion'],
                    'type' => $evento['type'],
                    'color' => $evento['color']
                ];
            }

            $response = [
                'data' => $data
            ];

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }
}
