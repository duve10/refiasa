<?php

class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->model('User');
            $user_data = $user->getUserByUsernameAndPassword($username, $password);
            
            if ($user_data) {
                Auth::login($user_data['id']);
                header('Location: ' . BASE_URL . 'public/index.php');
                exit();
            } else {
                $this->view('login', ['error' => 'Invalid username or password']);
            }
        } else {
            $this->view('login');
        }
    }
}
