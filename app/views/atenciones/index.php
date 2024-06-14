<?php
$active = "6";
$title = "Atenciones | Refiasa";

include "../app/views/includes/header.php";
?>

<body>
    <div class='wrapper'>
        <?php include "../app/views/includes/sidebar.php";?>
        <div class='main'>
            <?php include "../app/views/includes/navBar.php";?>
            <main class='content'>
                <div class='container-fluid p-0'>
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-sm-block">
                            <h1 class="h3 mb-3"><strong>Atenciones</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <a class="btn btn-primary btnColorGeneral" href="incidentForm.cfm">
                                + Agregar Atencion
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                       
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