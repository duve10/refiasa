<?php
$active = "2";
$title = "Citas | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Registro Cita</strong></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-12 bg-white content">
                                        <form id="formCita">
                                            <div class="mb-3 row">
                                                <label for="id_cliente" class="col-md-3 col-xl-2 col-form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                                                <div class="col-md-9 col-xl-10">
                                                    <select class="form-control id_cliente" name="id_cliente" id="id_cliente"></select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary btnColorGeneral" id="crearCita" type="submit">Crear Cita</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </main>
        </div>
    </div>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="<?= BASE_URL ?>/js/app.js"></script>
    <script src="<?= BASE_URL ?>/js/citas/registro.js"></script>
</body>