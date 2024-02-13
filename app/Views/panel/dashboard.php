<!--  Header para todo el contenido especifico de la plantilla -->
<?= $this->extend('base/panel_base') ?>

<!-- CSS epecifico para cada vista -->
<?= $this->section('css') ?>
<?= $this->endSection(); ?>

<!-- Contenido epecifico para cada vista -->
<?= $this->section('contenido') ?>
<?php
$session = session();
if ($session->rol_actual == ROL_ADMINISTRADOR["clave"]) {
echo("Hola soy tu dashboard");
}

if ($session->rol_actual == ROL_OPERADOR["clave"]) {
    echo("Hola no soy tu dashboard");

    }
?>
<?= $this->endSection(); ?>

<!-- js epecifico para cada vista -->
<?= $this->section('js') ?>
<?= $this->endSection(); ?>