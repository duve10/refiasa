<?php
require_once '../app/models/Cliente.php';
require_once '../app/helpers/functions.php';

class ClienteController {
    public function index() {
        
        require_once '../app/views/clientes/index.php';
    }

    public function apiGetClientes() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? ''
                
            ];

            $totalRecords = Cliente::getTotal();
            $clientes = Cliente::getAll($filters);

            $data = [];
            foreach ($clientes as $cliente) {

                $encrypted_id = encrypt($cliente['id'], KEY, IV);
                $data[] = [
                    'id' => $cliente['id'],
                    'nombre' => $cliente['nombre'],
                    'encrypted_id' => $encrypted_id,
                    'urlMascota' => '<a class="viewUrl" data-url="'.BASE_URL.'/mimascota?id='.$encrypted_id.'"><i class="align-middle me-2 fas fa-fw fa-external-link-alt"></i></a>',
                    'apellido_paterno' => $cliente['apellido_paterno'],
                    'apellido_materno' => $cliente['apellido_materno'],
                    'direccion' => $cliente['direccion'],
                    'telefono' => $cliente['telefono'],
                    'documento' => $cliente['documento'],
                    'tipoDoc' => $cliente['tipoDoc'],
                    'username' => $cliente['username'],
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

    public function apiGetClientesSelect() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $nameDoc = $_GET['q'];
            $clienteData = [];
            $filterClientes  = Cliente::getClienteByNameDoc($nameDoc);
            
            foreach ($filterClientes as $filterCliente) {

                $data['id'] = $filterCliente['id'];  
                $data['text'] = $filterCliente['nombre'].' '.$filterCliente['apellido_paterno']; 
                array_push($clienteData, $data);  
                
            }
            
            echo json_encode($clienteData, JSON_UNESCAPED_UNICODE); 
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

          
            $creado_por = $_SESSION['user_id'];
            $razon = trim($_POST['razon']) ?? null;
            $nombre = trim($_POST['nombre']) ?? null;
            $apellido_paterno = trim($_POST['apellido_paterno']) ?? null;
            $apellido_materno = trim($_POST['apellido_materno']) ?? null;
            $tipo_documento_id = trim($_POST['tipo_documento_id']) ?? null;
            $documento = trim($_POST['documento']) ?? null;
            $direccion = trim($_POST['direccion']) ?? null;
            $telefono = trim($_POST['telefono']) ?? null;
            $correo = trim($_POST['correo']) ?? null;
            $fecha_nac = convertirFechaBd($_POST['fecha_nac']);
            $sexo = trim($_POST['sexo']);
            $estado = 1;
       
        

            if (!$nombre || !$apellido_paterno || !$apellido_materno || !$tipo_documento_id || !$documento) {
                $response['message'] = 'Todos los campos son obligatorios.';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                return;
            }



            $cliente = new Cliente(null, $razon, $nombre, $apellido_paterno, $apellido_materno, $direccion, $telefono, $correo, $creado_por, NULL, $documento, $tipo_documento_id,$estado, $fecha_nac, $sexo);

            if ($cliente->guardar()) {
               
                $response['error'] = false;
                $response['message'] = 'Cliente registrado correctamente.';
            } else {
                $response['message'] = 'Error al registrar cliente.';
            }
        } else {
            $response['message'] = 'Método no permitido.';
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;
    }
}
