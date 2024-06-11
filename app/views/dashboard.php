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
                                            <h5 class='card-title'>Total Events</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="alert-octagon"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">100 event(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 50 events  </span>
										<span class="text-muted">Since last month</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Events</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="alert-octagon"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">100 event(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 50 events  </span>
										<span class="text-muted">Since last month</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Events</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="alert-octagon"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">100 event(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 50 events  </span>
										<span class="text-muted">Since last month</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card borderCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class='card-title'>Total Events</h5>
                                        </div>
                                        <div class='col-auto'>
                                            <div class="stat text-primary">
                        		                <i class="align-middle" data-feather="alert-octagon"></i>
											</div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3 font18">100 event(s)</h1>
                                    <div class="mb-0">
										<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> + 50 events  </span>
										<span class="text-muted">Since last month</span>
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
    <script src="js/app.js"></script>
</body>