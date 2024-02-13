<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<?= $this->endSection(); ?>

<!-- Contenido epecifico para cada vista -->
<?= $this->section("contenido") ?>
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de detalles de usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart("editar_usuario", ['id' => 'form-usuario']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <?php
                                $foto_perfil = (!is_null($usuario->imagen_usuario)) ? base_url(RECURSO_SB2_IMG . "/" . $usuario->imagen_usuario) : (
                                    ($usuario->sexo_usuario == SEXO_MASCULINO['clave']) ? base_url(RECURSO_SB2_IMG . "male.png")
                                    : base_url(RECURSO_SB2_IMG . "female.png"));
                                ?>
                                <img src="<?= $foto_perfil; ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                                <?php
                                //Capturamos el id_usuario que vamos a editar
                                $data = array(
                                    'type' => 'hidden',
                                    'name' => 'id_usuario',
                                    'class' => 'form-control',
                                    'id' => 'id_usuario',
                                    'value' => $usuario->id_usuario
                                );
                                echo form_input($data);

                                if (!is_null($usuario->imagen_usuario)) {
                                    $data = array(
                                        'type' => 'hidden',
                                        'name' => 'foto_anterior',
                                        'class' => 'form-control',
                                        'id' => 'foto_anterior',
                                        'value' => $usuario->imagen_usuario
                                    );
                                    echo form_input($data);
                                }
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
                                    'value' => $usuario->nombre_usuario
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
                                    'value' => $usuario->ap_paterno_usuario
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
                                    'value' => $usuario->ap_materno_usuario
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
                                    echo form_radio($data, SEXO_MASCULINO["clave"], ($usuario->sexo_usuario == SEXO_MASCULINO["clave"]  ? TRUE : FALSE));

                                    echo form_label('Masculino', 'masculino', ['class' => 'form-check-label']);
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    $data = array(
                                        'name' => 'sexo',
                                        'class' => 'form-check-input',
                                    );
                                    echo form_radio($data, SEXO_FEMENINO["clave"], ($usuario->sexo_usuario == SEXO_FEMENINO["clave"]  ? TRUE : FALSE));

                                    echo form_label('Femenino', 'femenino', ['class' => 'form-check-label']);;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rol</label>
                                <?php
                                $parametros = array(
                                    'class' => 'form-control',
                                    'id' => 'rol'
                                );
                                echo form_dropdown("rol", ["" => "Selecciona un rol"] + ROLES, $usuario->id_rol, $parametros);
                                ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo electrónico</label>
                                <?php
                                $data = array(
                                    'type' => 'email',
                                    'name' => 'email',
                                    'class' => 'form-control',
                                    'id' => 'email',
                                    'placeholder' => 'Correo electrónico',
                                    'value' => $usuario->email_usuario
                                );
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contraseña</label>
                                <?php
                                $data = array(
                                    'name' => 'password',
                                    'class' => 'form-control',
                                    'id' => 'password',
                                    'placeholder' => '**************',
                                );
                                echo form_password($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Repetir Contraseña</label>
                                <?php
                                $data = array(
                                    'name' => 'repassword',
                                    'class' => 'form-control',
                                    'id' => 'repassword',
                                    'placeholder' => '**************',
                                );
                                echo form_password($data);
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
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
                    <a href="<?= route_to("usuario") ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Cancelar</a>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
<?= $this->endSection(); ?>

<!-- js epecifico para cada vista -->
<?= $this->section('js') ?>
<script src="<?= base_url(RECURSO_SB2_GLOBALES . 'funciones.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/usuario_detalles.js') ?>"></script>
<?= $this->endSection(); ?>