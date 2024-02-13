<!-- Heredar todo el contendido especifico de mi plantilla base -->
<?= $this->extend("base/panel_base") ?>

<!-- CSS especificos para cada vista -->
<?= $this->section("css") ?>

<?= $this->endSection(); ?>

<!-- CONTENIDO especifico de cada vista-->
<?= $this->section("contenido") ?>

<!-- 401 Error Text -->
<div class="container-fluid">

    <!-- 401 Error Text -->
    <div class="text-center">
        <h1 class="headline text-warning"> 401</h1>
        <p class="lead text-gray-800 mb-5"><i class="fas fa-exclamation-triangle text-warning text-center"></i> ¡Oops! Acceso denegado</p>
        <p class="text-gray-500 mb-0"> No cuentas con los permisos apropiados para acceder a este módulo.
        <p class="text-gray-500">Para ello, te sugerimos que regreses al Dasboard y/o contactes al administrador.</p>
        </p>
        <a class="btn btn-warning" href="<?= route_to('dashboard') ?>"> Dashboard</a>
    </div>
    <!-- /.error-content -->

</div>
<!-- /.error-page -->
<?= $this->endSection(); ?>

<!-- JS especificos para cada vista -->
<?= $this->section("js") ?>

<?= $this->endSection(); ?>