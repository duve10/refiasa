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

function convertirFechaHoraHtml($fecha_hora_bd) {
    try {
        // Crear un objeto DateTime desde la fecha y hora recibida
        $date = new DateTime($fecha_hora_bd);

        // Formatear la fecha en dd-mm-yyyy HH:MM:SS
        $fecha_formateada = $date->format('d-m-Y H:i');

        return $fecha_formateada;

    } catch (Exception $e) {
        // Manejar la excepción si la fecha no es válida
        return "Error: " . $e->getMessage();
    }
}

function verificarSesion() {
    if (isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "/dashboard");
        exit();
    }
}


function handleFileUpload($file, $uploadDir) {
    // Verificar si se subió el archivo y no hubo errores
    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileMimeType = mime_content_type($fileTmpPath);

        // Tipos MIME permitidos
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        // Verificar el tipo MIME
        if (in_array($fileMimeType, $allowedMimeTypes)) {
            // Restricción de tamaño de archivo (5MB máximo)
            if ($fileSize < 5000000) { // 5MB máximo

                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        return [
                            'error' => true,
                            'message' => 'Error al crear la carpeta de destino.'
                        ];
                    }
                }
                // Generar un nombre de archivo único
                $fileNameNew = uniqid() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destPath = rtrim($uploadDir, '/') . '/' . $fileNameNew;

                // Mover el archivo a la ubicación de destino
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    return [
                        'error' => false,
                        'filePath' => $fileNameNew
                    ];
                } else {
                    return [
                        'error' => true,
                        'message' => 'Error al mover el archivo subido.'
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'message' => 'El tamaño del archivo es demasiado grande. Máximo 5MB.'
                ];
            }
        } else {
            return [
                'error' => true,
                'message' => 'Solo se permiten archivos JPG y PNG.'
            ];
        }
    } else {
        return [
            'error' => true,
            'message' => 'Error al subir el archivo.'
        ];
    }
}
