<?php


function obtenerDatosPorId($id) {
    // Configuración de la base de datos
    $host = 'localhost';      // Cambia esto si tu base de datos no está en localhost
    $user = 'root';    // Cambia esto por tu nombre de usuario de la base de datos
    $pass = ''; // Cambia esto por tu contraseña de la base de datos
    $dbname = 'refiasa'; // Cambia esto por el nombre de tu base de datos

    // Crear una conexión a la base de datos
    $mysqli = new mysqli($host, $user, $pass, $dbname);

    // Verificar si la conexión fue exitosa
    if ($mysqli->connect_error) {
        die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    // Definir la consulta SQL con un parámetro para el ID
    $query = 'SELECT t1.* FROM atencion t1
        left join mascota t2 on t2.id = t1.id_mascota
        left join cliente t3 on t3.id = t2.id_cliente WHERE t2.id = ?';

    // Preparar la consulta
    if ($stmt = $mysqli->prepare($query)) {
        // Vincular el parámetro
        $stmt->bind_param('i', $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Obtener todas las filas del resultado
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Liberar el resultado
        $result->free();

        // Cerrar la declaración
        $stmt->close();
    } else {
        // En caso de error al preparar la consulta
        echo 'Error al preparar la consulta: ' . $mysqli->error;
        $rows = [];
    }

    // Cerrar la conexión
    $mysqli->close();

    // Devolver el resultado
    return $rows;
}

?>

<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Mis Mascotas | Refiasa</title>
    <link rel="icon" type="image/jpg" href="img/pata.ico"/>
    <link href="<?php echo BASE_URL; ?>/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100 m-0">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle p-2">


                        <?php if(count($miMascotas) == 0) {?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        No tiene mascotas registradas
                                    </div>
                                </div>
                            </div>
                        <?php   }  else { ?>

                        <?php foreach ($miMascotas as $mascota) { ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="img/mascotas/general.jpg" class="w-25 img-fluid rounded me-1" alt="name">
                                        </div>
                                        <div class="col-12">
                                            <p class="m-0"><strong>Nombre: </strong><?= $mascota['nombre']; ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="m-0"><strong>Especie: </strong><?= $mascota['especie']; ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="m-0"><strong>Raza: </strong><?= $mascota['raza']; ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="m-0"><strong>Peso: </strong><?= $mascota['peso']; ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="m-0"><strong>Altura: </strong><?= $mascota['altura']; ?></p>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <?php  $arrayAtenciones = obtenerDatosPorId($mascota['id']); ?>

                                        <div class="col-12 mt-2">
                                            <h4 class="fw-bold">Atenciones</h4>
                                        </div>
                                        <?php if(count($arrayAtenciones) == 0) {?>
                                            <div class="col-12">
                                                    <p>No hay atenciones</p>
                                            </div>
                                        <?php   }  else { ?>
                                            <?php  foreach ($arrayAtenciones as $atencion) { ?>
                                                <div class="col-12">
                                                    <p>Fecha: <?= $atencion['fecha']; ?></p>
                                                </div>

                                            <?php   } ?>

                                        <?php   } ?>

                                 
                                    </div>
                                </div>
                            </div>

                        <?php   } 
                        
                        } ?>


                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo BASE_URL; ?>/js/app.js"></script>

</body>

</html>