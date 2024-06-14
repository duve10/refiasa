<?php
require_once '../app/config.php';
require_once '../app/models/Cita.php';  // Modelo de Citas
require_once '../app/models/Atencion.php';  // Modelo de Atenciones

class CalendarioController {
    public function index() {
        require_once '../app/views/calendario/index.php';
    }
}
?>
