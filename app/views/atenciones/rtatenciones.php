<?php
$active = "12";
$title = "RT Atenciones | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>RT Atenciones</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1 d-none">
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
                                            <div class="col-md-4 mb-2">
                                                <label for="fecha" class="fw-bold">Desde:</label>
                                                <div class="d-flex">
                                                    <input readonly type="text" class="form-control flatpickr-input fecha" id="fecha" name="fecha" value="<?= date("d-m-Y")  ?>">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="listaAtenciones">
                        <div class="col-12">
                            <div class="accordion" id="accordionAtencion">
                                

                            </div>
                        </div>



                    </div>


                </div>
            </main>
        </div>
    </div>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="<?= BASE_URL ?>/js/app.js"></script>
    <script src="<?= BASE_URL ?>/js/atenciones/rtatenciones.js"></script>
</body>