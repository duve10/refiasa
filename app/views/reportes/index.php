<?php
$active = "14";
$title = "Reportes | Refiasa";

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
                            <h1 class="h3 mb-3"><strong>Reportes</strong></h1>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card table-responsive viewZoom">
                                <div class="card-body">
                                    <table id="tablePerfiles" class="table table-bordered table-hover w-100">
                                        <thead class="tableHead">
                                            <tr class="rounded-top">
                                                <th>Veterinario</th>
                                                <th class="text-center">Atenciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Vet1</td>
                                                <td>4</td>
                                            </tr>
                                            <tr>
                                                <td>Vet2</td>
                                                <td>2</td>
                                            </tr>
                                        </tbody>


                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card table-responsive viewZoom">
                                <div class="card-body">
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
    <script src="js/reportes/reportes.js"></script>
</body>