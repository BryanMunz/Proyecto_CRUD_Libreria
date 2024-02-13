<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "select2/css/select2.min.css") ?>" rel="stylesheet">
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "select2-bootstrap4-theme/select2-bootstrap4.min.css") ?>" rel="stylesheet">
<?= $this->endSection(); ?>

<!-- Contenido epecifico para cada vista -->
<?= $this->section('contenido') ?>

<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de libro - Detalles</h3>
                        </div>
                        <!-- /.card-header usuario-->
                        <!-- form start -->
                        <?= form_open_multipart("editar_libro", ['id' => 'form-libro']) ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <center>
                                        <?php
                                        $foto_libro = (!is_null($libro->imagen_libro)) ? base_url(RECURSO_SB2_IMG_BOOK . "/" . $libro->imagen_libro) : base_url(RECURSO_SB2_IMG_BOOK . "book.png");
                                        ?>
                                        <img src="<?= $foto_libro; ?>" class="img-rounded" alt="" id="img-preview" width="85%" style="margin-bottom: 10px;">
                                        <?php
                                        //Capturamos el id_usuario que vamos a editar
                                        $data = array(
                                            'type' => 'hidden',
                                            'name' => 'id_libro',
                                            'class' => 'form-control',
                                            'id' => 'id_libro',
                                            'value' => $libro->id_libro
                                        );
                                        echo form_input($data);

                                        if (!is_null($libro->imagen_libro)) {
                                            $data = array(
                                                'type' => 'hidden',
                                                'name' => 'foto_anterior',
                                                'class' => 'form-control',
                                                'id' => 'foto_anterior',
                                                'value' => $libro->imagen_libro
                                            );
                                            echo form_input($data);
                                        }
                                        ?>
                                    </center>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre del libro </label>
                                                <?php
                                                $data = [
                                                    'name'      => 'nombre',
                                                    'id'        => 'nombre',
                                                    'value'    => $libro->nombre_libro,
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
                                                <label for="exampleInputEmail1">Calificación </label>
                                                <?php
                                                $data = [
                                                    'name'      => 'calificacion',
                                                    'id'        => 'calificacion',
                                                    'value'    => $libro->calificacion,
                                                    'type'        => 'text',
                                                    'class'     => 'form-control',
                                                    'placeholder' => 'Calificacion del libro',
                                                ];
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No. Pagínas </label>
                                                <?php
                                                $data = [
                                                    'name'      => 'NoPaginas',
                                                    'id'        => 'NoPaginas',
                                                    'value'    => $libro->paginas,
                                                    'type'        => 'text',
                                                    'class'     => 'form-control',
                                                    'placeholder' => 'Paginas del libro',
                                                ];
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Fecha lanzamiento </label>
                                                <?php
                                                $data = [
                                                    'name'      => 'fecha',
                                                    'id'        => 'fecha',
                                                    'value'    => $libro->lanzamiento,
                                                    'type'        => 'date',
                                                    'class'     => 'form-control',
                                                ];
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Autor</label>
                                                <?php
                                                $parametros = array(
                                                    'class' => 'form-control',
                                                    'id' => 'autor',
                                                );
                                                echo form_dropdown("autor", ["" => "Selecciona un autor"] + AUTORES, array('value' => $libro->id_autor), $parametros);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Editorial</label>
                                                <?php
                                                $parametros = array(
                                                    'class' => 'form-control',
                                                    'id' => 'editorial'
                                                 );
                                                echo form_dropdown("editorial", ["" => "Selecciona una editorial"] + EDITORIALES, array('value' => $libro->id_editorial), $parametros);
                                            
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sinopsis </label>
                                                <?php
                                                $data = [
                                                    'name'      => 'descripcion',
                                                    'id'        => 'descripcion',
                                                    'value'     => $libro->sipnosis,
                                                    'rows'      => '5',
                                                    'class'     => 'form-control',
                                                    'placeholder' => 'Ingresa la Sinopsis del libro aquí...',
                                                    'style'     => 'resize: none',
                                                ];
                                                echo form_textarea($data);
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Caratula libro</label>
                                                <?php
                                                $data = [
                                                    'name'      => 'foto_libro',
                                                    'id'        => 'foto_libro',
                                                    'type'        => 'file',
                                                    'class'     => 'form-control',
                                                    'placeholder' => '',
                                                ];
                                                echo form_input($data);
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</button>
                            <a href="<?= route_to("libro") ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Cancelar</a>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>
<?= $this->endSection(); ?>

<!-- js epecifico para cada vista -->
<?= $this->section('js') ?>
<script src="<?= base_url(RECURSO_SB2_GLOBALES . 'funciones.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/libro_detalles.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'select2/js/select2.full.min.js') ?>"></script>
<?= $this->endSection(); ?>