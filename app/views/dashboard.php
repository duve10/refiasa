<?php
$active = "1";
$title = "Dashboard | Refiasa";

include "includes/header.php";
?>

<body>
    <div class='wrapper'>
        <?php include "includes/sidebar.php";?>
        <div class='main'>
            <?php include "includes/navBar.php";?>
            <main class='content'>
                <div class='container-fluid p-0'>
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h1 class="h3 mb-3"><strong>Bienvenido</strong> <?= $_SESSION['name'] ?>  <?= $_SESSION['lastname'] ?></h1>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <a class="btn btn-primary btnColorGeneral" href="atencion.php" >
                                + Crer Atención
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Citas</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="zap"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18"><?=  $totalCitas ?> cita(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 0 citas  </span>
										<span class="text-muted">desde el ultimo mes</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Atenciones</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="activity"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18"><?=  $totalAtenciones ?> atenciones</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 0 atenciones  </span>
										<span class="text-muted">desde el ultimo mes</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Clientes</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="smile"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18"><?=  $totalClientes ?> clientes</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 0 Clientes  </span>
										<span class="text-muted">el ultimo mes</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Mascotas</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="github"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18"><?=  $totalMascotas ?> mascota(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 0 mascotas  </span>
										<span class="text-muted">el ultimo mes</span>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="card h-100">
                                <div class="card-header text-center">
                                    
                                    <h2 class="fw-bold">Citas del Mes</h2>
                                </div>
                                <div class="card-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="card h-100">
                                <div class="card-body d-flex justify-content-center flex-column">
                                    <div id="chart"></div>
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
    <script src="js/dashboard/dashboard.js"></script>
</body>