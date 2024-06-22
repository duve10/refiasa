<?php
$active = "5";
$title = "Mascotas | Refiasa";

include "../app/views/includes/header.php";
?>

<body>
    <div class='wrapper'>
        <?php include "../app/views/includes/sidebar.php"; ?>
        <div class='main'>
            <?php include "../app/views/includes/navBar.php"; ?>
            <main class='content'>
                <div class='container-fluid p-0'>
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-sm-block">
                            <h1 class="h3 mb-3"><strong>Mascotas</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">

                            <button id="addMascota" type="button" class="btn btn-primary btnColorGeneral" data-bs-toggle="modal" data-bs-target="#crearMascota">
                                + Agregar Mascota
                            </button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="dateFrom" class="fw-bold">Especie:</label>
                                            <div class="mt-1">
                                                <select id="filtroEspecie" name="filtroEspecie" class="form-select">
                                                    <option value="">Selecciona Especie</option>
                                                    <?php  foreach ($especies as $especie) {  ?>
                                                        <option value="<?= $especie['id'] ?>"><?= $especie['nombre'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card table-responsive viewZoom">
                                <div class="card-body">
                                    <table id="tableMascotas" class="table table-bordered table-hover w-100">
                                        <thead class="tableHead">
                                            <tr class="rounded-top">
                                                <th>Foto</th>
                                                <th>Nombre</th>
                                                <th>Especie</th>
                                                <th>Raza</th>
                                                <th>Edad</th>
                                                <th>Altura</th>
                                                <th>Peso</th>
                                                <th>Cliente</th>
                                                <th>Usuario Creador</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>


                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </main>
        </div>
    </div>

    <!----  MODAL PARA CREAR MASCOTA ---->
    <?php
    include "../app/views/mascotas/modalCrear.php";
    ?>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/mascotas/mascotas.js"></script>
</body>