<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Autor extends BaseController
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
        if (comprobar_acceso(TAREA_AUTORES)) {
            $this->session->tarea_actual = TAREA_AUTORES;
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

        // ------VARIABLES DE SESSION --------
        $datos['nombre_usuario'] = $this->session->get('usuario_completo');
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG  . $this->session->imagen_usuario);

        $datos['nombre_pagina'] = 'Autor';
        $datos['tarea'] = 'Autor';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Autor',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $tabla_autores = new \App\Models\Tabla_autores;
        $datos['autores'] = $tabla_autores->data_table_autores(ROL_ADMINISTRADOR['clave']);

        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/autor', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    public function estatus($id_autor = 0, $estatus = 0)
    {
        //Modelo
        $tabla_autores = new \App\Models\Tabla_autores;
        $autor = $tabla_autores->obtener_autor($id_autor);

        //Verificamos si no esta vacio
        if (is_null($autor)) {
            mensaje('No se encuentra al autor propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('autor'));
        } //end if 
        else {
            if ($tabla_autores->update($id_autor, ['estatus_autor' => $estatus]) > 0) {
                mensaje("El estatus del autor ha sido actualizado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al actualizar el estatus de este autor. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el autor
            return redirect()->to(route_to('autor'));
        } //end estatus
    } //end else rol

    public function eliminar($id_autor = 0)
    {
        $tabla_autores = new \App\Models\Tabla_autores;
        $autor = $tabla_autores->obtener_autor($id_autor);
        //Verificamos si no esta vacio
        if (is_null($autor)) {
            mensaje('No se encuentra al autor propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('autor'));
        } //end if 
        else {
            if ($tabla_autores->delete($id_autor) > 0) {
                mensaje("El autor ha sido eliminado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al eliminar este autor. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el usuario

            // return redirect()->to(route_to('autor'));
            return $this->index();
        } //end estatus
    } //end eliminar

}
