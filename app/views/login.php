<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Login | Refiasa</title>
    <link rel="icon" type="image/jpg" href="img/pata.ico"/>
    <link href="<?php echo BASE_URL; ?>/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&amp;display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100 m-0">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle p-2">

                        <div class="text-center mt-4">
                            <h1 class="h2">Refiasa</h1>
                            <p class="lead">
                                Clinica Veterinaria
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">

                                        <img src="img/pata.png" alt="logo" class="img-fluid" width="50" height="50">

                                    </div>

                                    <form method="POST" autocomplete="off" action="<?php echo BASE_URL; ?>/login" id="form" class="needs-validation <?=  (($response != ''))?  'was-validated':'' ?>" novalidate="" enctype="multipart/form-data" role="form">
                                        <div class="mb-3 d-none">
                                            <select class="form-select" aria-label="type" name="type_user">

                                                <option selected="" value="1">Student</option>

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Usuario</label>
                                            <input  class="form-control form-control-lg" type="text" name="username" value="<?= $username ?>" placeholder="Ingresa tu usuario">
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Contraseña</label>
                                            <input class="form-control form-control-lg passwordCss" autofocus="" value="<?= $password ?>" required="" type="password" name="password" autocomplete="new-password" placeholder="Ingresa tu contraseña">
                                            <div class="invalid-feedback <?= $response != ''? 'd-flex':'' ?>">
                                                <?php if (($response) != ''): ?>
                                                    <?php echo $response; ?>
                                                <?php endif; ?>
                                            </div>
                                            <small class="d-none">
                                                <a class="colorText2" href="password.cfm">¿Olvidaste tu contraseña?</a>
                                            </small>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary bgPrimary1 colorText1 btnColorGeneral">Sign in</button>
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                    </form>




                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo BASE_URL; ?>/js/app.js"></script>

</body>

</html>