<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Editorial extends BaseController
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
        if (comprobar_acceso(TAREA_EDITORIALES)) {
            $this->session->tarea_actual = TAREA_EDITORIALES;
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

        $datos['nombre_pagina'] = 'Editorial';
        $datos['tarea'] = 'Editorial';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Editorial',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $tabla_editoriales = new \App\Models\Tabla_editoriales;
        $datos['editoriales'] = $tabla_editoriales->data_table_editoriales(ROL_ADMINISTRADOR['clave']);

        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/editorial', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    public function estatus($id_editorial = 0, $estatus = 0)
    {
        //Modelo
        $tabla_editoriales = new \App\Models\Tabla_editoriales;
        $editorial = $tabla_editoriales->obtener_editorial($id_editorial);

        //Verificamos si no esta vacio
        if (is_null($editorial)) {
            mensaje('No se encuentra al editorial propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('editorial'));
        } //end if 
        else {
            if ($tabla_editoriales->update($id_editorial, ['estatus_editorial' => $estatus]) > 0) {
                mensaje("El estatus de la editorial ha sido actualizado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al actualizar el estatus de esta editorial. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el autor
            return redirect()->to(route_to('editorial'));
        } //end estatus
    } //end else rol

    public function eliminar($id_editorial = 0)
    {
        $tabla_editoriales = new \App\Models\Tabla_editoriales;
        $editorial = $tabla_editoriales->obtener_editorial($id_editorial);
        //Verificamos si no esta vacio
        if (is_null($editorial)) {
            mensaje('No se encuentra al editorial propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('editorial'));
        } //end if 
        else {
            if ($tabla_editoriales->delete($id_editorial) > 0) {
                mensaje("La editorial ha sido eliminado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el editorial
            else {
                mensaje("Hubo un error al eliminar esta editorial. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el autor

            // return redirect()->to(route_to('editorial'));
            return $this->index();
        } //end estatus
    } //end eliminar

}