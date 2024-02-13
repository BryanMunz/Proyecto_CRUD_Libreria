<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Libro extends BaseController
{
    private $session;
    private $permitido = TRUE;

    //Constructor
    public function __construct()
    {
        //Se intancia el Acceso helper
        helper('permisos_helper');

        //instancia de la sesion
        $this->session = session();

        //Verifica si el usuario logeado cuenta con los permiso de esta area
        if (comprobar_acceso(TAREA_LIBROS)) {
            $this->session->tarea_actual = TAREA_LIBROS;
        } //end if 
        else {
            $this->permitido = FALSE;
            $this->session->modulo_permitido = FALSE;
        } //end else
    } //end constructor

    //generar y mandar a llamar la vista especifica
    private function crear_vista($nombre_vista = '', $datos = array())
    {
        $datos['menu'] = crear_menu_panel();
        return view($nombre_vista, $datos);
    } //end crear_vista

    private function cargar_datos()
    {
        $datos = array();

        //======================================
        // Datos fundamentales para la plantilla
        //======================================
        $datos['nombre_usuario'] = $this->session->get('usuario_completo');
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG  . $this->session->imagen_usuario);

        $datos['nombre_pagina'] = 'Libros';
        $datos['tarea'] = 'Libros';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Libros',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $tabla_libros = new \App\Models\Tabla_libros;
        $datos['libros'] = $tabla_libros->data_table_libros(ROL_ADMINISTRADOR['clave']);

        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/libro', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    public function estatus($id_libro = 0, $estatus = 0)
    {
        //Modelo
        $tabla_libros = new \App\Models\Tabla_libros;
        $libro = $tabla_libros->obtener_libro($id_libro);

        //Verificamos si no esta vacio
        if (is_null($libro)) {
            mensaje('No se encuentra el libro propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('libro'));
        } //end if 
        else {
            if ($tabla_libros->update($id_libro, ['estatus_libro' => $estatus]) > 0) {
                mensaje("El estatus del libro ha sido actualizado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al actualizar el estatus de este libro. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el usuario
            return redirect()->to(route_to('libro'));
        } //end estatus
    } //end else


    public function eliminar($id_libro = 0)
    {
        $tabla_libros = new \App\Models\Tabla_libros;
        $libro = $tabla_libros->obtener_libro($id_libro);
        //Verificamos si no esta vacio
        if (is_null($libro)) {
            mensaje('No se encuentra al libro propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('libro'));
        } //end if 
        else {
            if ($tabla_libros->delete($id_libro) > 0) {
                mensaje("El libro ha sido eliminado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al eliminar este libro. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el usuario

            // return redirect()->to(route_to('usuarios'));
            return $this->index();
        } //end estatus
}
}