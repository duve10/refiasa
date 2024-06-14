<?php
$active = "8";
$title = "Calendario | Refiasa";

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
                            <h1 class="h3 m-0"><strong>Calendario</strong></h1>
                            <h4 class="mb-3 text-muted fw-bold"><strong>Citas || Atenciones</strong></h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-12 bg-white content d-flex justify-content-center">
                                        <div id="calendarAll" class="w-100 alturaCalendarioGeneral">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </main>
            <?php

            include "../app/views/includes/footer.php";

            ?>
        </div>
    </div>
    <div class="loading d-none">Loading&#8230;</div>
    <script src="<?= BASE_URL ?>/js/app.js"></script>
    <script src="<?= BASE_URL ?>/js/calendario/calendario.js"></script>
</body>