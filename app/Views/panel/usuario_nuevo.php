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
                    <h3 class="card-title">Formulario de usuario nuevo</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart("registrar_usuario", ['id' => 'form-usuario']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="<?= base_url(RECURSO_SB2_IMG . 'add-user.png'); ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
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
                                    <input class="form-check-input" type="radio" name="sexo" value="2">
                                    <label class="form-check-label">Femenino</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" value="1">
                                    <label class="form-check-label">Masculino</label>
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
                                echo form_dropdown("rol", ["" => "Selecciona un rol"] + ROLES, array(), $parametros);
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
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Registrar</button>
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
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/additional-methods.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/register.js') ?>"></script>
<?= $this->endSection(); ?>