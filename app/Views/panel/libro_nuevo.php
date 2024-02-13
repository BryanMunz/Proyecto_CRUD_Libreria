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
                            <h3 class="card-title">Formulario de libro Nuevo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open_multipart("registrar_libro", ['id' => 'form-libro']) ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <center>
                                        <img src="<?= base_url(RECURSO_SB2_IMG_BOOK . 'book.png'); ?>" class="img-rounded" alt="" id="img-preview" width="85%" style="margin-bottom: 10px;">
                                        </center>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nombre del libro </label>
                                                    <?php
                                                    $data = array(
                                                        'name'      => 'nombre',
                                                        'id'        => 'nombre',
                                                        'type'        => 'text',
                                                        'class'     => 'form-control',
                                                        'placeholder' => 'Nombre del libro',
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Calificación </label>
                                                    <?php
                                                    $data = array(
                                                        'name'      => 'calificacion',
                                                        'id'        => 'calificacion',
                                                        'type'        => 'text',
                                                        'class'     => 'form-control',
                                                        'placeholder' => 'Calificacion del libro',
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No. Pagínas </label>
                                                    <?php
                                                    $data = array(
                                                        'name'      => 'NoPaginas',
                                                        'id'        => 'NoPaginas',
                                                        'type'        => 'text',
                                                        'class'     => 'form-control',
                                                        'placeholder' => 'Paginas del libro',
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Fecha lanzamiento </label>
                                                    <?php
                                                    $data = array(
                                                        'name'      => 'fecha',
                                                        'id'        => 'fecha',
                                                        'value'    => '10/01/2010',
                                                        'type'        => 'date',
                                                        'class'     => 'form-control',
                                                    );
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
                                                    // foreach($libros as $libro)
                                                    // {
                                                    //echo $autor['nombre_autor'];
                                                    //$n_autor = ['clave' =>  $autor->id_autor, 'autor' => $autor->nombre_autor];
                                                    //$autores = [$n_autor['clave'] => $n_autor['autor']];
                                                    $parametros = array(
                                                        'class' => 'form-control',
                                                        'id' => 'autor'
                                                     );//}
                                                    echo form_dropdown("autor", ["" => "Selecciona un autor"] + AUTORES, array(), $parametros);
                                                
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Editorial</label>
                                                    <?php
                                                    // foreach($libros as $libro)
                                                    // {
                                                    //echo $autor['nombre_autor'];
                                                    //$n_autor = ['clave' =>  $autor->id_autor, 'autor' => $autor->nombre_autor];
                                                    //$autores = [$n_autor['clave'] => $n_autor['autor']];
                                                    $parametros = array(
                                                        'class' => 'form-control',
                                                        'id' => 'editorial'
                                                     );//}
                                                    echo form_dropdown("editorial", ["" => "Selecciona una editorial"] + EDITORIALES, array(), $parametros);
                                                
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sinopsis </label>
                                                    <?php
                                                    $data = array(
                                                        'name'      => 'descripcion',
                                                        'id'        => 'descripcion',
                                                        'rows'      => '5',
                                                        'class'     => 'form-control',
                                                        'placeholder' => 'Ingresa la Sinopsis del libro aquí...',
                                                        'style'     => 'resize: none',
                                                    );
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
                                                    $data = array(
                                                        'name'      => 'foto_libro',
                                                        'id'        => 'foto_libro',
                                                        'type'        => 'file',
                                                        'class'     => 'form-control',
                                                        'placeholder' => '',
                                                    );
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
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Registrar</button>
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

<?= $this->endSection(); ?>

<!-- js epecifico para cada vista -->
<?= $this->section('js') ?>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'jquery-validation/additional-methods.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/register_book.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'summernote/summernote-bs4.min.js') ?>"></script>
<?= $this->endSection(); ?>