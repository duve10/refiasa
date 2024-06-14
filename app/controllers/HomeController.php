<?php

require_once '../app/models/Atencion.php'; 
require_once '../app/models/Cita.php'; 
require_once '../app/models/Mascota.php'; 
require_once '../app/models/Cliente.php'; 


class HomeController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }


        $totalAtenciones = Atencion::getTotal();
        $totalCitas = Cita::getTotal();
        $totalMascotas = Mascota::getTotal();
        $totalClientes = Cliente::getTotal();
        require_once '../app/views/dashboard.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }


        $totalAtenciones = Atencion::getTotal();
        $totalCitas = Cita::getTotal();
        $totalMascotas = Mascota::getTotal();
        $totalClientes = Cliente::getTotal();

        require_once '../app/views/dashboard.php';
    }
}
