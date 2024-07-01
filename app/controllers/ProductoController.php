<?php
require_once '../app/models/Producto.php';
require_once '../app/helpers/functions.php';

class ProductoController {
    
    public function index() {
        
        require_once '../app/views/productos/index.php';
    }

    public function apiGetProductos() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filters = [
                'drawn' => $_POST['drawn'] ?? '',
                'start' => $_POST['start'] ?? '0',
                'length' => $_POST['length'] ?? '10',
                'indexColumn' => $_POST['indexColumn'] ?? '',
                'orderName' => $_POST['orderName'] ?? '',
                'columnName' => $_POST['columnName'] ?? ''
                
            ];

            $totalRecords = Producto::getTotal();
            $productos = Producto::getAll($filters);

            $data = [];
            foreach ($productos as $producto) {
                $data[] = [
                    'id' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'descripcion' => $producto['descripcion'],
                    'foto' => '<img src="img/productos/'.$producto['foto'].'" class="avatar img-fluid rounded me-1" alt="name">',
                    'precio' => $producto['precio'],
                    'stock' => $producto['stock'],
                    'username' => $producto['username'],
                    'acciones' => '<a class="text-warning" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                    <a class="text-danger ms-3 deleteProducto" data-nombre="'.$producto['nombre'].'" data-id="'.$producto['id'].'"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
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

            $uploadDir = '../public/img/productos/';

            $nombre = trim($_POST['nombre']) ?? null;
            $descripcion = trim($_POST['descripcion'])??'';
            $precio = trim($_POST['precio']);
            $stock = trim($_POST['stock']);
            $creado_por = $_SESSION['user_id'];
            $estado = 1;
            $imagen = $_FILES['foto'] ?? null;
            $pathFoto = 'producto.jpg';
        

            if (!$nombre || !$descripcion || !$precio || !$stock) {
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


            $producto = new Producto(null, $nombre, $descripcion, $precio, $stock, $creado_por,NULL, $estado, $pathFoto);

            if ($producto->guardar()) {

              

                $response['error'] = false;
                $response['message'] = 'Producto registrado correctamente.';
            } else {
                $response['message'] = 'Error al registrar Producto.';
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
            $id_producto = $_POST['id'];

            $eliminar = Producto::eliminar($id_producto,$actualizado_por);

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
