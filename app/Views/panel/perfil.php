<!-- Heredar todo el contendido especifico de mi plantilla base -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS especificos para cada vista -->
<?= $this->section("css") ?>

<?= $this->endSection(); ?>

<!-- CONTENIDO especifico de cada vista-->
<?= $this->section("contenido") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?= $foto_usuario ?>" alt="User profile picture" id="imag-preview">
                    </div>
                    <h3 class="profile-username text-center"><?= $nombre_usuario ?></h3>
                    <p class="text-muted text-center"><?= $rol ?></p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#datos" data-toggle="tab">Datos</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Contraseña</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="datos">
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Mi perfil</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <?= form_open_multipart("actualizar_mi_perfil", ['id' => 'form-mi-perfil']) ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <img src="<?= $foto_usuario ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                                                    <?php
                                                    $data = array(
                                                        'type' => 'hidden',
                                                        'name' => 'foto_anterior',
                                                        'class' => 'form-control',
                                                        'value' =>  $informacion->imagen_usuario
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </center>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nombre(s)</label>
                                                    <?php
                                                    $data = array(
                                                        'type' => 'text',
                                                        'name' => 'nombre',
                                                        'class' => 'form-control',
                                                        'id' => 'nombre',
                                                        'placeholder' => 'Nombre(s)',
                                                        'value' =>  $informacion->nombre_usuario
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Apellido Paterno</label>
                                                    <?php
                                                    $data = array(
                                                        'type' => 'text',
                                                        'name' => 'apellido_paterno',
                                                        'class' => 'form-control',
                                                        'id' => 'apellido_paterno',
                                                        'placeholder' => 'Apellido Paterno',
                                                        'value' =>  $informacion->ap_paterno_usuario
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Apellido Materno</label>
                                                    <?php
                                                    $data = array(
                                                        'type' => 'text',
                                                        'name' => 'apellido_materno',
                                                        'class' => 'form-control',
                                                        'id' => 'apellido_materno',
                                                        'placeholder' => 'Apellido Materno',
                                                        'value' =>  $informacion->ap_materno_usuario
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sexo</label>
                                                    <div class="form-check">
                                                        <?php
                                                        $data = array(
                                                            'name' => 'sexo',
                                                            'class' => 'form-check-input',
                                                        );
                                                        echo form_radio($data, SEXO_MASCULINO["clave"], ($informacion->sexo_usuario == SEXO_MASCULINO["clave"]  ? TRUE : FALSE));

                                                        echo form_label('Masculino', 'masculino', ['class' => 'form-check-label']);
                                                        ?>
                                                    </div>
                                                    <div class="form-check">
                                                        <?php
                                                        $data = array(
                                                            'name' => 'sexo',
                                                            'class' => 'form-check-input',
                                                        );
                                                        echo form_radio($data, SEXO_FEMENINO["clave"], ($informacion->sexo_usuario == SEXO_FEMENINO["clave"]  ? TRUE : FALSE));

                                                        echo form_label('Femenino', 'femenino', ['class' => 'form-check-label']);;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Correo electrónico</label>
                                                    <?php
                                                    $data = array(
                                                        'type' => 'email',
                                                        'name' => 'email',
                                                        'class' => 'form-control',
                                                        'id' => 'email',
                                                        'placeholder' => 'Correo electrónico',
                                                        'value' =>  $informacion->email_usuario
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="exampleInputEmail1">Foto perfil</label>
                                                <?php
                                                $data = array(
                                                    'type' => 'file',
                                                    'name' => 'foto_perfil',
                                                    'class' => 'form-control',
                                                    'id' => 'foto_perfil',
                                                    'placeholder' => '',
                                                );
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="password">
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Mi perfil</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <?= form_open_multipart("actualizar_password", ['id' => 'form-password']) ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contraseña</label>
                                                    <?php
                                                    $data = array(
                                                        'name' => 'password',
                                                        'class' => 'form-control',
                                                        'id' => 'password',
                                                        'placeholder' => '*********',
                                                    );
                                                    echo form_password($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Repetir contraseña</label>
                                                    <?php
                                                    $data = array(
                                                        'name' => 'confirm_password',
                                                        'class' => 'form-control',
                                                        'id' => 'password',
                                                        'placeholder' => '*********',
                                                    );
                                                    echo form_password($data);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
<br><br>
<?= $this->endSection(); ?>

<!-- JS especificos para cada vista -->
<?= $this->section("js") ?>
<!-- jquery-validation -->
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/additional-methods.min.js') ?>"></script>

<!--  -->
<script src="<?= base_url(RECURSO_SB2_GLOBALES . 'funciones.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/perfil.js') ?>"></script>
<?= $this->endSection(); ?>