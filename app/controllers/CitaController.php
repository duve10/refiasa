<?php
require_once '../app/models/Cita.php';
require_once '../app/models/Hora.php';
require_once '../app/models/Servicio.php';
require_once '../app/models/CitaServicio.php';
require_once '../app/helpers/functions.php';

class CitaController
{

    public function index()
    {

        require_once '../app/views/citas/index.php';
    }

    public function registro()
    {

        $servicios = Servicio::getAllServicios(true);
        $horas = Horas::obtenerListaHorasPorFecha(date("Y-m-d"));
        require_once '../app/views/citas/registro.php';
    }


    public function apiGetCitas()
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

            $totalRecords = Cita::getTotal();
            $citas = Cita::getAll($filters);

            $data = [];
            foreach ($citas as $cita) {

                $citaHtml = '';
                $clienteName = $cita['cliente'] . " " . $cita['apellido_paterno'];

                if ($cita['id_estadocita'] == 2) {
                    $htmlEstadoCita = '<a class="text-warning " href="#"><span class="badge bg-success"><i class="align-middle fas fa-fw fa-calendar-check"></i></span></a>';
                } else {
                    $htmlEstadoCita = '<a class="text-warning modalServicio" data-idmascota="' . $cita['id_mascota'] . '" data-id="' . $cita['id'] . '"  href="#"><span class="badge bg-warning"><i class="align-middle fas fa-fw fa-file-medical"></i></span></a>';
                }

                $data[] = [
                    'id' => $cita['id'],
                    'descripcion' => $cita['descripcion'],
                    'estadocitaId' => $cita['id_estadocita'],
                    'atencion' => $htmlEstadoCita,
                    'fecha' => convertirFechaHtml($cita['fecha']),
                    'mascota' => $cita['mascota'],
                    'edad' => $cita['edad'],
                    'nombreCliente' => $clienteName,
                    'telefono' => $cita['telefono'],
                    'correo' => $cita['correo'],
                    'username' => $cita['username'],
                    'tipocita' => '<span class="badge ' . $cita['claseCita'] . ' fw-bold">' . $cita['tipocita'] . '</span>',
                    'especie' => $cita['especie'],
                    'hora' => $cita['hora'],
                    'estadocita' => '<span class="badge ' . $cita['estadocitacolor'] . ' text-dark">' . $cita['estadocita'] . '</span>',
                    'acciones' => '<a class="text-warning"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a data-nombre = "' . $clienteName . '" data-id = "' . $cita['id'] . '" class="text-danger ms-3 deleteCita"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
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


            $id_mascota = ($_POST['id_mascota']) ?? null;
            $creado_por = $_SESSION['user_id'];
            $id_hora = trim($_POST['id_hora']);
            $fecha = convertirFechaBd($_POST['fecha']);
            $descripcion = trim($_POST['descripcion']);
            $servicios = $_POST['id_servicio'] ?? [];
            $estado = 1;
            $id_estadocita = /**$_POST['id_estadocita'] ?? */1;
            $comentario = trim($_POST['comentario']);

            $verificarTipo = Horas::verificarHoraOcupada($fecha, $id_hora);
            if ($verificarTipo > 0) {
                $id_tipocita = 2;
            } else {
                $id_tipocita = 1;
            }



            if (!$id_mascota || !$id_hora || !$descripcion || !$comentario || empty($servicios)) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }

            $cita = new Cita(null, $id_mascota, $creado_por, $id_hora, $fecha, $descripcion, $estado, null, $id_estadocita, $comentario, $id_tipocita);

            if ($cita->guardar()) {

                foreach ($servicios as $id_servicio) {
                    CitaServicio::asignarServicioACita($cita->getId(), $id_servicio);
                }

                $response['error'] = false;
                $response['message'] = 'Cita registrada correctamente.';
            } else {
                $response['message'] = 'Error al registrar la cita.';
            }
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }

    public function getApiListaHorasPorFecha()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $fechaSelected = $_GET['fechaSelected'];
            $fechaSelectedFormat = convertirFechaBd($fechaSelected);
            $horas = Horas::obtenerListaHorasPorFecha($fechaSelectedFormat);

            $data = [];

            foreach ($horas as $hora) {
                $data[] = [
                    'id' => $hora['id'],
                    'hora' => $hora['hora'],
                    'idCita' => $hora['idCita']
                ];
            }

            $response = [
                'data' => $data
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
            $id_cita = $_POST['id'];

            $eliminar = Cita::eliminar($id_cita, $actualizado_por);

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

    public function getServiciosCita()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cita = $_GET['id'];

            
            $citaServicios = CitaServicio::getAllServiciosByCita($id_cita);
            
            $data = $citaServicios;


            $response = [
                'data' => $data,
                'error' => false
            ];

            header('Content-Type: application/json');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }

    public function apiUpdateEstadoCita () {
        header('Content-Type: application/json');

        $response = [
            'error' => true,
            'message' => 'Error desconocido.'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $actualizado_por = $_SESSION['user_id'];
            $id_cita = $_POST['id'];
            $id_estadocita = $_POST['id_estadocita'];

            $eliminar = Cita::updateEstado($id_cita,$id_estadocita, $actualizado_por);

            if ($eliminar) {
                $response['message'] = 'Registrado Correctamente';
                $response['error'] = false;
            } else {
                $response['message'] = 'No se actualizo Error!';
            }
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }
}
