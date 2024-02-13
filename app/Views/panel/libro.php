<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "datatables/dataTables.bootstrap4.css") ?>" rel="stylesheet">
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "datatables/responsive.bootstrap4.min.css") ?>" rel="stylesheet">
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "datatables/buttons.bootstrap4.min.css") ?>" rel="stylesheet">
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "icheck-bootstrap/icheck-bootstrap.min.css") ?>" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<?= $this->endSection(); ?>

<!-- Contenido epecifico para cada vista -->
<?= $this->section('contenido') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href='<?= route_to('libro_nuevo') ?>' class="btn btn-secondary btn-sm">Agregar Nuevo Libro</a><br><br>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <center>
                        <h3 class="card-title">Lista de Libros</h3>
                    </center>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-libro" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>#</th>
                                        <th>Portada</th>
                                        <th>Nombre</th>
                                        <th>Publicación</th>
                                        <th>Autor</th>
                                        <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- <tr>
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td> 4</td>
                                    <td>X</td>
                                </tr> -->
                                <?php
                                if (!empty($libros)) {
                                    $html = '';
                                    $numero = 0;
                                    foreach ($libros as $libro) {
                                        $foto_libro = (!is_null($libro->imagen_libro)) ? base_url(RECURSO_SB2_IMG_BOOK . "/" . $libro->imagen_libro) : base_url(RECURSO_SB2_IMG_BOOK . "book.png");
                                        $html .= '
                                            <tr>
                                                <td>' . ++$numero . '</td>
                                                <td><img class="" width="50px" src="' . $foto_libro . '"></td>
                                                <td>' . $libro->nombre_libro . '</td>
                                                <td>' . $libro->lanzamiento . '</td>
                                                <td>' . $libro->firma_autor . '</td>
                                                <td>';
                                        if ($libro->estatus_libro == ESTATUS_DESHABILITADO) {
                                            $html .= '<button href="" class="btn btn-success estatus" id="' . $libro->id_libro . '_' . ESTATUS_HABILITADO . '"><i class="fas fa-universal-access"></i> Habilitar</button>';
                                        } //end if 
                                        else {
                                            $html .= '<button href="" class="btn btn-dark estatus" id="' . $libro->id_libro . '_' . ESTATUS_DESHABILITADO . '"><i class="fas fa-low-vision"></i> Deshabilitar</button>';
                                        } //end else
                                        $html .= '
                                                    <a href="' . route_to("libro_detalles", $libro->id_libro) . '" class="btn btn-warning text-white"><i class="fas fa-info-circle"></i> Detalles</a>
                                                    <button class="btn btn-danger eliminar" id="' . $libro->id_libro . '"><i class="fas fa-times-circle"></i> Eliminar</button>
                                                </td>
                                            </tr>
                                            ';
                                    } //end foreach usuarios
                                    echo $html;
                                } //end if empty
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js') ?>
<!-- js epecifico para cada vista -->
<script>
    //Colocar la ruta definida
    /**
     * https://localhost:8080/ 
     * https://localhost:8080/estatus_libro/primaryKey/estatus 
     * https://localhost:8080/eliminar_libro/primaryKey 
     */
    let path = '<?= base_url(""); ?>';
</script>
<!-- DataTable -->
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_VENDOR . 'datatables/responsive.bootstrap4.min.js') ?>"></script>

<!-- -->
<script src="<?= base_url(RECURSO_SB2_GLOBALES . 'funciones.js') ?>"></script>
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/libro.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<?= $this->endSection(); ?>