<?php
$active = "7";
$title = "Registro Atenciones | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Registro Atencion</strong></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-12 bg-white content">
                                        <form id="formAtencion">

                                            <div class="mb-3 row">
                                                <label for="fecha" class="col-md-3 col-xl-2 col-form-label fw-bold">Fecha <span class="text-danger">*</span></label>
                                                <div class="col-md-6 col-xl-4">
                                                    <input type="text" class="form-control" name="fecha" id="fecha" value="<?= date("d-m-Y H:i")  ?>">
                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label for="id_cliente" class="col-md-3 col-xl-2 col-form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                                                <div class="col-md-9 col-xl-10">
                                                    <select class="form-control id_cliente" name="id_cliente" id="id_cliente"></select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="id_mascota" class="col-md-3 col-xl-2 col-form-label fw-bold">Mascota <span class="text-danger">*</span></label>
                                                <div id="divMascotas" class="col-md-9 col-xl-10">
                                                    <div class="w-100 h-100  d-flex align-items-center justify-content-center border border-dotted">
                                                        <h5 class="fw-bold m-0 text-muted p-2">Seleccionar Cliente</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="veterinario" class="col-md-3 col-xl-2 col-form-label fw-bold">Veterinario <span class="text-danger">*</span></label>
                                                <div class="col-md-9 col-xl-10">
                                                    <select class="form-control veterinario" name="veterinario" id="veterinario"></select>
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="servicios" class="col-md-3 col-xl-2 col-form-label fw-bold">Servicios <span class="text-danger">*</span></label>
                                                <div class="col-md-9 col-xl-10">
                                                    <select class="form-select form-control id_servicio" multiple name="id_servicio[]" id="id_servicio">
                                                        <option value="">Seleccion de Servicios</option>
                                                        <?php foreach ($servicios as $servicio) {  ?>
                                                            <option value="<?= $servicio['id'] ?>"><?= $servicio['nombre'] ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="descripcion" class="col-md-3 col-xl-2 col-form-label fw-bold">Descripcion <span class="text-danger">*</span></label>
                                                <div class="col-md-9 col-xl-10">
                                                    <textarea class="form-control validate" placeholder="Escribe una descripcion" id="descripcion" name="descripcion" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="observacion" class="col-md-3 col-xl-2 col-form-label fw-bold">Observaciones </label>
                                                <div class="col-md-9 col-xl-10">
                                                    <textarea class="form-control validate" placeholder="Escribe un observacion" id="observacion" name="observacion" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="diagnosticos" class="col-md-3 col-xl-2 col-form-label fw-bold">Diagnosticos </label>
                                                <div class="col-md-9 col-xl-10">
                                                    <textarea class="form-control validate" placeholder="Escribe Diagnosticos" id="diagnosticos" name="diagnosticos" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="tratamiento" class="col-md-3 col-xl-2 col-form-label fw-bold">Tratamiento </label>
                                                <div class="col-md-9 col-xl-10">
                                                    <textarea class="form-control validate" placeholder="Escribe Tratamiento" id="tratamiento" name="tratamiento" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary btnColorGeneral" id="crearCita" type="submit">Crear Atención</button>
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
    <script src="<?= BASE_URL ?>/js/atenciones/registro.js"></script>
</body>