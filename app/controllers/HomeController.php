<?php

require_once '../core/Auth.php';

class HomeController extends Controller {
    public function index() {
        Auth::check(); // Verificar si el usuario está autenticado
        $this->view('home');
    }
}
