<?php
$active = "6";
$title = "Atenciones | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Atenciones</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <a class="btn btn-primary btnColorGeneral" href="/atenciones/registro">
                                + Agregar Atencion
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 row">
                                            <div class="col-md-4 mb-2">
                                                <label for="dateFrom" class="fw-bold">Desde:</label>
                                                <div class="fecha_desde d-flex">
                                                    <input readonly type="text" class="form-control flatpickr-input" id="fecha_desde" name="fecha_desde" value="<?= date("d-m-Y")  ?>">
                                                    <a class="input-button btn btn-outline-secondary" title="toggle" data-toggle="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle">
                                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="dateFrom" class="fw-bold">Hasta:</label>
                                                <div class="fecha_hasta d-flex">
                                                    <input readonly type="text" class="form-control flatpickr-input" id="fecha_hasta" name="fecha_hasta" value="<?= date("d-m-Y")  ?>">
                                                    <a class="input-button btn btn-outline-secondary" title="toggle" data-toggle="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle">
                                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <a class="btn btn-primary btnColorGeneral btnBuscar" id="btnBuscar" href="##">
                                                    Buscar
                                                </a>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card table-responsive viewZoom">
                                <div class="card-body">
                                    <table id="tableAtenciones" class="table table-bordered table-hover w-100">
                                        <thead class="tableHead">
                                            <tr class="rounded-top">
                                                <th>Fecha</th>
                                                <th>Mascota</th>
                                                <th>Especie</th>
                                                <th>Descripcion</th>
                                                <th>Cliente</th>
                                                <th>Estado</th>
                                                <th>Veterinario</th>
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
    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/atenciones/atenciones.js"></script>
</body>