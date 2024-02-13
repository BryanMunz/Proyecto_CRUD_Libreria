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
                    <h3 class="card-title">Formulario Editorial | Nuevo</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart("registrar_editorial", ['id' => 'form-editorial']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="<?= base_url(RECURSO_SB2_IMG_EDITORIAL . 'logo.png'); ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                            </center>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre(s)</label>
                                <?php
                                $data = [
                                    'name'      => 'nombre',
                                    'id'        => 'nombre',
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Nombre(s)',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dirección</label>
                                <?php
                                $data = [
                                    'name'      => 'direccion',
                                    'id'        => 'direccion',
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Dirección',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Logo de la Editorial</label>
                            <?php
                            $data = [
                                'name'      => 'foto_editorial',
                                'id'        => 'foto_editorial',
                                'type'        => 'file',
                                'class'     => 'form-control',
                                'placeholder' => '',
                            ];
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Registrar</button>
                    <a href="<?= route_to("editorial") ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Cancelar</a>
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/register_editorial.js') ?>"></script>
<?= $this->endSection(); ?>