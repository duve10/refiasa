<?php
$active = "11";
$title = "Servicios | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Servicios</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <button id="addServicio" type="button" class="btn btn-primary btnColorGeneral" data-bs-toggle="modal" data-bs-target="#crearServicio">
                                + Agregar Servicio
                            </button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="filtroCita" class="fw-bold">Tipo Servicio:</label>
                                            <div class="mt-1">
                                                <select id="filtroCita" name="filtroCita" class="form-select">
                                                    <option value="">Selecciona Tipo</option>
                                                    
                                                    <option value="0">No Citas</option>
                                                    <option value="1">Para Citas</option>
                                                    
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
                                    <table id="tableServicios" class="table table-bordered table-hover w-100">
                                        <thead class="tableHead">
                                            <tr class="rounded-top">
                                                <th>Fotos</th>
                                                <th>Servicio</th>
                                                <th>Descripcion</th>
                                                <th>Precio</th>
                                                <th>Creado Por</th>
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

    <!----  MODAL PARA CREAR SERVICIO ---->
    <?php
        include "../app/views/servicios/modalCrear.php";
    ?>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/servicios/servicios.js"></script>
</body>