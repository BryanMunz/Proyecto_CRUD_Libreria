<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<?= $this->endSection(); ?>

<!-- Contenido epecifico para cada vista -->
<?= $this->section('contenido') ?>

        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de autor nuevo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open_multipart("registrar_autor", ['id' => 'form-autor']) ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                        <img src="<?= base_url(RECURSO_SB2_IMG . 'add-user.png'); ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                                        </center>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre(s)</label>
                                            <?php
                                            $data = array(
                                                'name'      => 'nombre',
                                                'id'        => 'nombre',
                                                'type'        => 'text',
                                                'class'     => 'form-control',
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
                                                'name'      => 'apellido_paterno',
                                                'id'        => 'apellido_paterno',
                                                'type'        => 'text',
                                                'class'     => 'form-control',
                                                'placeholder' => 'Apelldio Paterno',
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
                                                'name'      => 'apellido_materno',
                                                'id'        => 'apellido_materno',
                                                'type'        => 'text',
                                                'class'     => 'form-control',
                                                'placeholder' => 'Apelldio Materno',
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
                                                $data = [
                                                    'name'      => 'sexo',
                                                    'value'        => '2',
                                                    'type'        => 'radio',
                                                    'class'     => 'form-check-input',
                                                ];
                                                echo form_input($data);
                                                ?>
                                                <label class="form-check-label">Femenino</label>
                                            </div>
                                            <div class="form-check">
                                                <?php
                                                $data = [
                                                    'name'      => 'sexo',
                                                    'value'        => '1',
                                                    'type'        => 'radio',
                                                    'class'     => 'form-check-input',
                                                ];
                                                echo form_input($data);
                                                ?>
                                                <label class="form-check-label">Masculino</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nacionalidad</label>
                                            <?php
                                            $data = array(
                                                'name'      => 'nation',
                                                'id'        => 'nation',
                                                'type'        => 'text',
                                                'class'     => 'form-control',
                                                'placeholder' => 'Nacionalidad del Autor',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Firma</label>
                                            <?php
                                            $data = array(
                                                'name'      => 'firma',
                                                'id'        => 'firma',
                                                'type'        => 'text',
                                                'class'     => 'form-control',
                                                'placeholder' => 'Firma del Autor',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                                            <?php
                                            $data = array(
                                                'name'      => 'date',
                                                'id'        => 'date',
                                                'type'        => 'date',
                                                'class'     => 'form-control',
                                            );
                                            echo form_input($data);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biografia</label>
                                            <?php
                                            $data = array(
                                                'name'      => 'biografia',
                                                'id'        => 'biografia',
                                                'rows'      => '5',
                                                'class'     => 'form-control',
                                                'placeholder' => 'Ingresa la Biografia del libro aquí...',
                                                'style'     => 'resize: none'
                                            );
                                            echo form_textarea($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Foto del Autor</label>
                                        <?php
                                        $data = array(
                                            'name'      => 'foto_autor',
                                            'id'        => 'foto_autor',
                                            'type'        => 'file',
                                            'class'     => 'form-control',
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
                                <a href="<?= route_to("autor") ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Cancelar</a>
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/register_autor.js') ?>"></script>
<?= $this->endSection(); ?>