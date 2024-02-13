<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Usuario extends BaseController
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
        if (comprobar_acceso(TAREA_USUARIOS)) {
            $this->session->tarea_actual = TAREA_USUARIOS;
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

        $datos['nombre_pagina'] = 'Usuarios';
        $datos['tarea'] = 'Usuarios';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Usuarios',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $datos['usuarios'] = $tabla_usuarios->data_table_usuarios($this->session->id_usuario);

        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/usuario', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    /**
     * Funciones externas 
     */
    public function estatus($id_usuario = 0, $estatus = 0)
    {
        //Modelo
        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $usuario = $tabla_usuarios->obtener_usuario($id_usuario);

        //Verificamos si no esta vacio
        if (is_null($usuario)) {
            mensaje('No se encuentra al usuario propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('usuario'));
        } //end if 
        else {
            if ($tabla_usuarios->update($id_usuario, ['estatus_usuario' => $estatus]) > 0) {
                mensaje("El estatus del usuario ha sido actualizado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al actualizar el estatus de este usuario. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el usuario
            return redirect()->to(route_to('usuario'));
        } //end estatus
    } //end else rol


    public function eliminar($id_usuario = 0)
    {
        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $usuario = $tabla_usuarios->obtener_usuario($id_usuario);
        //Verificamos si no esta vacio
        if (is_null($usuario)) {
            mensaje('No se encuentra al usuario propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('usuario'));
        } //end if 
        else {
            if ($tabla_usuarios->delete($id_usuario) > 0) {
                mensaje("El usuario ha sido eliminado exitosamente.", ALERT_SUCCESS);
            } //end if se actualiza el usuario
            else {
                mensaje("Hubo un error al eliminar este usuario. Intente nuevamente, por favor", ALERT_DANGER);
            } //end else se inserta el usuario

            // return redirect()->to(route_to('usuarios'));
            return $this->index();
        } //end estatus
    } //end eliminar
}
