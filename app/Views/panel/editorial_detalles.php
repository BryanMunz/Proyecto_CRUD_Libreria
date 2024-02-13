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
                    <h3 class="card-title">Formulario Editorial - Detalles</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart("editar_editorial", ['id' => 'form-editorial']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <?php
                                $foto_editorial = (!is_null($editorial->imagen_editorial)) ? base_url(RECURSO_SB2_IMG_EDITORIAL . "/" . $editorial->imagen_editorial) : 
                                base_url(RECURSO_SB2_IMG_EDITORIAL . "logo.png");
                                ?>
                                <img src="<?= $foto_editorial; ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                                <?php
                                //Capturamos el id_usuario que vamos a editar
                                $data = array(
                                    'type' => 'hidden',
                                    'name' => 'id_editorial',
                                    'class' => 'form-control',
                                    'id' => 'id_editorial',
                                    'value' => $editorial->id_editorial
                                );
                                echo form_input($data);

                                if (!is_null($editorial->imagen_editorial)) {
                                    $data = array(
                                        'type' => 'hidden',
                                        'name' => 'foto_anterior',
                                        'class' => 'form-control',
                                        'id' => 'foto_anterior',
                                        'value' => $editorial->imagen_editorial
                                    );
                                    echo form_input($data);
                                }
                                ?>
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
                                    'value'    => $editorial->nombre_editorial,
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
                                    'value'    => $editorial->direccion_editorial,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Editorial',
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
                    <?= form_submit('Ingresar', 'Registrar', ['class' => 'btn btn-primary']); ?>
                    <a href='<?= route_to('editorial') ?>' class="btn btn-danger">Cancelar</a>
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/editorial_detalles.js') ?>"></script>
<?= $this->endSection(); ?>