<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<link href="<?= base_url(RECURSO_USUARIO_VENDOR . "datatables/dataTables.bootstrap4.min.css") ?>" rel="stylesheet">
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
                    <a href='<?= route_to('editorial_nuevo') ?>' class="btn btn-secondary btn-sm">Agregar Nueva Editorial</a><br><br>
                    <div class="card">
                        <div class="card-header">
                            <center>
                                <h3 class="card-title">Lista de Editoriales</h3>
                            </center>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-editorial" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Nombre Editorial</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($editoriales)) {
                                        $html = '';
                                        $numero = 0;
                                        foreach ($editoriales as $editorial) {
                                            $foto_editorial = (!is_null($editorial->imagen_editorial)) ? base_url(RECURSO_SB2_IMG_EDITORIAL . "/" . $editorial->imagen_editorial) : base_url(RECURSO_SB2_IMG_EDITORIAL . "logo.png");
                                            $html .= '
                                                <tr>
                                                    <td>' . ++$numero . '</td>
                                                    <td><img class="" width="50px" src="' . $foto_editorial . '"></td>
                                                    <td>' . $editorial->nombre_editorial . '</td>
                                                    <td>' . $editorial->direccion_editorial . '</td>
                                                    <td>';
                                            if ($editorial->estatus_editorial == ESTATUS_DESHABILITADO) {
                                                $html .= '<button href="" class="btn btn-success estatus" id="' . $editorial->id_editorial . '_' . ESTATUS_HABILITADO . '"><i class="fas fa-universal-access"></i> Habilitar</button>';
                                            } //end if 
                                            else {
                                                $html .= '<button href="" class="btn btn-dark estatus" id="' . $editorial->id_editorial . '_' . ESTATUS_DESHABILITADO . '"><i class="fas fa-low-vision"></i> Deshabilitar</button>';
                                            } //end else
                                            $html .= '
                                                        <a href="' . route_to("editorial_detalles", $editorial->id_editorial) . '" class="btn btn-warning text-white"><i class="fas fa-info-circle"></i> Detalles</a>
                                                        <button class="btn btn-danger eliminar" id="' . $editorial->id_editorial . '"><i class="fas fa-times-circle"></i> Eliminar</button>
                                                    </td>
                                                </tr>
                                                ';
                                        } //end foreach autor
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


<!-- js epecifico para cada vista -->
<?= $this->section('js') ?>
<script>
    //Colocar la ruta definida
    /**
     * https://localhost:8080/ 
     * https://localhost:8080/estatus_usuario/primaryKey/estatus 
     * https://localhost:8080/eliminar_usuario/primaryKey 
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/editorial.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<?= $this->endSection(); ?>