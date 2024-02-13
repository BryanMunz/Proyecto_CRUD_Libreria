<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Dashboard extends BaseController
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
        if (comprobar_acceso(TAREA_DASHBOARD)) {
            $this->session->tarea_actual = TAREA_DASHBOARD;
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
        $datos['nombre_usuario'] = $this->session->usuario_completo;
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);
        $datos['nombre_pagina'] = 'Dashboard';
        $datos['tarea'] = 'Dashboard';

        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Dashboard',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================

        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/dashboard', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index


}
