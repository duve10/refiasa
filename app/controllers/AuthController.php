<?php
require_once '../app/models/User.php';

class AuthController
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/dashboard");
            exit();
        }

        $response = "";
        $username = "";
        $password = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            

            if(trim($username) == '' || trim($password) == '') {
                $response = 'LLenar los campos';
                
            } else {

                $result = User::authenticate($username, $password);
    
    
                if ($result === User::USER_NOT_FOUND) {
                    $response = "Usuario no encontrado";
                } elseif ($result === User::WRONG_PASSWORD) {
                    $response = "Contraseña incorrecta";
                } elseif (is_string($result)) {
                    // Hubo un error en la autenticación
                    $response = $result;
                } else {
                    // Autenticación exitosa, redirigir al dashboard
                    $_SESSION['user_id'] = $result->id;
                    $_SESSION['name'] = $result->name;
                    $_SESSION['lastname'] = $result->lastname;
                    $_SESSION['imagen'] = $result->imagen;
                    $_SESSION['user_profile_id'] = $result->id_perfil;
                    header("Location: " . BASE_URL . "/dashboard");
                    exit();
                }
            }

        }
        require_once '../app/views/login.php';
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit();
    }
}
