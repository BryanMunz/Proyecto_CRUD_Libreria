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
                    <h3 class="card-title">Formulario de autor - Detalles</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart("editar_autor", ['id' => 'form-autor']) ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <?php
                                $foto_autor = (!is_null($autor->imagen_autor)) ? base_url(RECURSO_SB2_IMG_AUTOR . "/" . $autor->imagen_autor) : (
                                    ($autor->sexo_autor == SEXO_MASCULINO['clave']) ? base_url(RECURSO_SB2_IMG . "male.png")
                                    : base_url(RECURSO_SB2_IMG . "female.png"));
                                ?>
                                <img src="<?= $foto_autor; ?>" class="img-rounded" alt="" id="img-preview" width="15%" style="margin-bottom: 10px;">
                                <?php
                                //Capturamos el id_usuario que vamos a editar
                                $data = array(
                                    'type' => 'hidden',
                                    'name' => 'id_autor',
                                    'class' => 'form-control',
                                    'id' => 'id_autor',
                                    'value' => $autor->id_autor
                                );
                                echo form_input($data);

                                if (!is_null($autor->imagen_autor)) {
                                    $data = array(
                                        'type' => 'hidden',
                                        'name' => 'foto_anterior',
                                        'class' => 'form-control',
                                        'id' => 'foto_anterior',
                                        'value' => $autor->imagen_autor
                                    );
                                    echo form_input($data);
                                }
                                ?>
                            </center>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre(s)</label>
                                <?php
                                $data = [
                                    'name'      => 'nombre',
                                    'id'        => 'nombre',
                                    'value'    => $autor->nombre_autor,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Nombre(s)',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Apellido Paterno</label>
                                <?php
                                $data = [
                                    'name'      => 'apellido_paterno',
                                    'id'        => 'apellido_paterno',
                                    'value'    => $autor->ap_paterno_autor,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Apelldio Paterno',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Apellido Materno</label>
                                <?php
                                $data = [
                                    'name'      => 'apellido_materno',
                                    'id'        => 'apellido_materno',
                                    'value'    => $autor->ap_materno_autor,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Apelldio Materno',
                                ];
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
                                    echo form_radio($data, SEXO_MASCULINO["clave"], ($autor->sexo_autor == SEXO_MASCULINO["clave"]  ? TRUE : FALSE));

                                    echo form_label('Masculino', 'masculino', ['class' => 'form-check-label']);
                                    ?>
                                </div>
                                <div class="form-check">
                                    <?php
                                    $data = array(
                                        'name' => 'sexo',
                                        'class' => 'form-check-input',
                                    );
                                    echo form_radio($data, SEXO_FEMENINO["clave"], ($autor->sexo_autor == SEXO_FEMENINO["clave"]  ? TRUE : FALSE));

                                    echo form_label('Femenino', 'femenino', ['class' => 'form-check-label']);;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nacionalidad</label>
                                <?php
                                $data = [
                                    'name'      => 'nation',
                                    'id'        => 'nation',
                                    'value'    => $autor->nacionalidad_autor,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Nacionalidad del Autor',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Firma</label>
                                <?php
                                $data = [
                                    'name'      => 'firma',
                                    'id'        => 'firma',
                                    'value'    => $autor->firma_autor,
                                    'type'        => 'text',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Firma del Autor',
                                ];
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
                                $data = [
                                    'name'      => 'date',
                                    'id'        => 'date',
                                    'value'    => $autor->nacimiento_autor,
                                    'type'        => 'date',
                                    'class'     => 'form-control',
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Biografia</label>
                                <?php
                                $data = [
                                    'name'      => 'biografia',
                                    'id'        => 'biografia',
                                    'value'     => $autor->biografia_autor,
                                    'rows'      => '5',
                                    'class'     => 'form-control',
                                    'placeholder' => 'Ingresa la Sinopsis del libro aquí...',
                                    'style'     => 'resize: non;',
                                ];
                                echo form_textarea($data);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Foto del Autor</label>
                            <?php
                            $data = [
                                'name'      => 'foto_autor',
                                'id'        => 'foto_autor',
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
                    <a href='<?= route_to('autor') ?>' class="btn btn-danger">Cancelar</a>
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/autor_detalles.js') ?>"></script>
<?= $this->endSection(); ?>