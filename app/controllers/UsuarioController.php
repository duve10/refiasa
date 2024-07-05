<?php
require_once '../app/models/Usuario.php';
require_once '../app/models/Cliente.php';

class UsuarioController {
    public function index() {
        
        require_once '../app/views/usuarios/index.php';
    }

    public function apiGetUsuarios() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? ''
                
            ];

            $totalRecords = Usuario::getTotal();
            $usuarios = Usuario::getAll($filters);

            $data = [];
            foreach ($usuarios as $usuario) {
                $statusTag = '<span class="badge bg-success rounded-pill">activo</span>';
                if ($usuario['status'] == 0) {
                    $statusTag = '<span class="badge bg-danger rounded-pill">inactivo</span>';
                }
                $data[] = [
                    'id' => $usuario['id'],
                    'username' => $usuario['username'],
                    'password' => $usuario['password'],
                    'status' => $statusTag,
                    'name' => $usuario['name'],
                    'lastname' => $usuario['lastname'],
                    'phone' => $usuario['phone'],
                    'mail' => $usuario['mail'],
                    'imagen' => '<img src="'.BASE_URL.'/'.$usuario['imagen'].'" width="48" height="48" class="rounded-circle me-2" alt="Avatar">',
                    'perfil' => $usuario['perfil'],
                    'acciones' => '
                    <a class="text-info" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle me-2"><path d="M1     12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                    <a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3 deleteUser" data-user="'.$usuario['username'].'" data-id="'.$usuario['id'].'"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
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

            $uploadDir = '../public/img/usuarios/';

            $usuario = trim($_POST['usuario']) ?? null;
            $contrasena = trim($_POST['contrasena'])??'';
            $password = password_hash($contrasena, PASSWORD_BCRYPT); 
            $name = trim($_POST['name']);
            $lastname = trim($_POST['lastname']);
            $creado_por = $_SESSION['user_id'];
            $phone = trim($_POST['phone']);
            $mail = trim($_POST['mail']);
            $type_doc = trim($_POST['type_doc']);
            $document = trim($_POST['document']);
            $id_perfil = trim($_POST['id_perfil']);
            $estado = 1;
            $imagen = $_FILES['foto'] ?? null;
            $pathFoto = 'general.png';
            
            if (!$usuario || !$contrasena || !$id_perfil) {
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

     
            $usuario = new Usuario(null, $usuario, $password, $estado, $name, $lastname, $phone, $mail, $document, $type_doc, $id_perfil, $pathFoto, $creado_por, null );

            if ($usuario->guardar()) {


                $response['error'] = false;
                $response['message'] = 'Usuario registrado correctamente.';
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
            $id_user = $_POST['id'];

            $eliminar = Usuario::eliminar($id_user,$actualizado_por);

            if ($eliminar) {
                $response['message'] = 'Desactivado Correctamente';
                $response['error'] = false;
            } else {
                $response['message'] = 'No se Elimino Error!';
            }
            
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        return;

    }

    public function apiGetVetSelect() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $nameDoc = $_GET['q'];
            $vetData = [];
            $filterVets  = Cliente::getVetByNameDoc($nameDoc);
            
            foreach ($filterVets as $filterVet) {

                $data['id'] = $filterVet['id'];  
                $data['text'] = $filterVet['username'].' ( '.$filterVet['name'].' )' ; 
                array_push($vetData, $data);  
                
            }
            
            echo json_encode($vetData, JSON_UNESCAPED_UNICODE); 
        }
    }
}
