<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="<?= base_url(RECURSO_USUARIO_VENDOR . 'fontawesome-free/css/all.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">

    <link rel="stylesheet" href="<?= base_url(RECURSO_USUARIO_CSS . 'sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <!-- Toasrt -->
    <link rel="stylesheet" href="<?= base_url(RECURSO_USUARIO_VENDOR . 'toastr/toastr.min.css') ?>">

</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">


                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ingresa tus credenciales de acceso</h1>
                                    </div>
                                    <?= form_open('validar_credenciales', ['id' => 'form-login', 'class' => '']) ?>
                                    <form class="">

                                        <div class="form-group">
                                            <label class="label" for="exampleInputEmail1">Correo</label>
                                            <?php

                                            $data = [
                                                'name'      => 'email_usuario',
                                                'id'        => 'email_usuario',
                                                'type'        => 'email',
                                                'class'     => 'form-control',
                                                'placeholder' => 'example@email.com',
                                                'required' => true
                                            ];
                                            echo form_input($data);
                                            ?>
                                            <!--
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <div class="fas fa-envelope"></div>
                                                </div>
                                            </div>
                                        -->
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="exampleInputEmail1">Contraseña</label>
                                            <?php

                                            $data = [
                                                'name'      => 'password_usuario',
                                                'id'        => 'password_usuario',
                                                'class'     => 'form-control',
                                                'placeholder' => '********',
                                            ];
                                            echo form_password($data);
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <?= form_submit('ingresar', 'Iniciar Sesión', ['class' => 'btn btn-primary btn-user btn-block']); ?>
                                        </a>
                                        <hr>

                                        </a>
                                        <?= form_close(); ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Jquery -->
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery/jquery.min.js') ?>"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(RECURSO_USUARIO_JS . 'sb-admin-2.min.js') ?>"></script>

    <!-- Toasrt -->
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'toastr/toastr.min.js') ?>"></script>

    <script>
        // Se llama la funcion de mostrar el resultado
        <?= mostrar_mensaje(); ?>
    </script>

    <!-- JQUERY VALIDATION -->
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/additional-methods.min.js') ?>"></script>
    <!--  -->
    <script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/acceso.js') ?>"></script>
</body>

</html>