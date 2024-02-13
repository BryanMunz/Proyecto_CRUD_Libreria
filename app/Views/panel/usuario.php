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
            <a href='<?= route_to('usuario_nuevo') ?>' class="btn btn-secondary btn-sm">Agregar Nuevo Usuario</a><br><br>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <center>
                        <h3 class="card-title">Lista de Usuarios</h3>
                    </center>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-usuarios" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Perfil</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
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
                                if (!empty($usuarios)) {
                                    $html = '';
                                    $numero = 0;
                                    foreach ($usuarios as $usuario) {
                                        $foto_perfil = (!is_null($usuario->imagen_usuario)) ? base_url(RECURSO_SB2_IMG . "/" . $usuario->imagen_usuario) : (
                                            ($usuario->sexo_usuario == SEXO_MASCULINO['clave']) ? base_url(RECURSO_SB2_IMG . "male.png")
                                            : base_url(RECURSO_SB2_IMG . "female.png"));
                                        $html .= '
                                            <tr>
                                                <td>' . ++$numero . '</td>
                                                <td><img class="" width="50px" src="' . $foto_perfil . '"></td>
                                                <td>' . $usuario->nombre_usuario . ' ' . $usuario->ap_paterno_usuario . ' ' . $usuario->ap_materno_usuario . '</td>
                                                <td>' . $usuario->rol . '</td>
                                                <td>';
                                        if ($usuario->estatus_usuario == ESTATUS_DESHABILITADO) {
                                            $html .= '<button href="" class="btn btn-success estatus" id="' . $usuario->id_usuario . '_' . ESTATUS_HABILITADO . '"><i class="fas fa-universal-access"></i> Habilitar</button>';
                                        } //end if 
                                        else {
                                            $html .= '<button href="" class="btn btn-dark estatus" id="' . $usuario->id_usuario . '_' . ESTATUS_DESHABILITADO . '"><i class="fas fa-low-vision"></i> Deshabilitar</button>';
                                        } //end else
                                        $html .= '
                                                    <a href="' . route_to("usuario_detalles", $usuario->id_usuario) . '" class="btn btn-warning text-white"><i class="fas fa-info-circle"></i> Detalles</a>
                                                    <button class="btn btn-danger eliminar" id="' . $usuario->id_usuario . '"><i class="fas fa-times-circle"></i> Eliminar</button>
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
<script src="<?= base_url(RECURSO_USUARIO_JS . 'especificos/usuarios.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

<?= $this->endSection(); ?>