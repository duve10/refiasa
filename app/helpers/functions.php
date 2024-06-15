<?php

function convertirFechaBd($fecha) {
    // Crear un objeto DateTime a partir de la fecha en formato DD-MM-YYYY
    $date = DateTime::createFromFormat('d-m-Y', $fecha);

    // Convertir el objeto DateTime a formato YYYY-MM-DD
    return $date->format('Y-m-d');
}

function convertirFechaHtml($fecha) {
    $date = DateTime::createFromFormat('Y-m-d', $fecha);
    return $date->format('d-m-Y');
}

function verificarSesion() {
    if (isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "/dashboard");
        exit();
    }
}