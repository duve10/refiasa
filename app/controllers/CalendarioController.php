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

            $viewVet = false;
            $idVet = $_SESSION['user_id'];
            if ($_SESSION['user_profile_id'] == 2) {
                $viewVet = true;
            }


            $filters = [
                'start' => $start ?? null,
                'end' => $end ?? null,
                'viewVet' => $viewVet ?? null,
                'idVet' => $idVet ?? null,
            ];
            
            
            $citas = [];
            
            if (!$viewVet) {
                $citas = Cita::getAllCitasByDate($filters);
            }

            $atenciones = Atencion::getAllAttencionesByDate($filters);

            $eventos = array_merge($citas, $atenciones);

            $data = [];
            foreach ($eventos as $evento) {

                $color = $evento['color'];
                $subTitle = '';
                if ($evento['tipo'] == 2) {
                    /*$color = '#6C757D';*/
                    $subTitle = '<strong>En Espera</strong><br>';
                } else {
                    $subTitle = '<strong>Agendada</strong><br>';
                }
                $fecha = $evento['fecha'];
                $datetime = new DateTime($fecha);
                $formattedDate = $datetime->format('Y-m-d');
                $data[] = [
                    'id' => $evento['id'],
                    'start' => $formattedDate,
                    'end' => $formattedDate,
                    'title' => $evento['type'],
                    'descripcion' => $subTitle.$evento['descripcion'],
                    'type' => $evento['type'],
                    'color' => $color
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
