<?php
$active = "9";
$title = "Usuarios | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Usuarios</strong></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <button id="addUsuario"  type="button"  class="btn btn-primary btnColorGeneral" data-bs-toggle="modal" data-bs-target="#crearUsuario">
                                + Agregar Usuario
                            </button>

                           
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card table-responsive viewZoom">
                                <div class="card-body">
                                    <table id="tableUsuarios" class="table table-bordered table-hover w-100">
                                        <thead class="tableHead">
                                            <tr class="rounded-top">
                                                <th>Foto</th>
                                                <th>Usuario</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Celular</th>
                                                <th>Correo</th>
                                                <th>Perfil</th>
                                                <th>Estado</th>
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

    <!----  MODAL PARA CREAR USUARIO ---->
    <?php
        include "../app/views/usuarios/modalCrear.php";
    ?>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="js/app.js"></script>
    <script src="js/usuarios/usuarios.js"></script>
</body>