<?php

namespace App\Controllers\errores;

use App\Controllers\baseController;

class Error_401 extends BaseController
{

    //Constructor
    private $session;
    private $permitido = TRUE;

    //Constructor
    public function __construct()
    {
        //Se intancia el Acceso helper
        helper('permisos_helper');

        //instancia de la sesion
        $this->session = session();


    } //end constructor

    //Generar y mandar a llamar la vista especifica
    private function crear_vista($nombre_vista = '', $datos = array())
    {
        $datos['menu'] = crear_menu_panel();
        return view($nombre_vista, $datos);
    } //end crear_vista

    private function cargar_datos()
    {
        $datos = array();
        // =====================================
        // Datos fundamentales para la plantilla
        // =====================================

        // ------VARIABLES DE SESSION --------
        $datos['nombre_usuario'] = $this->session->usuario_completo;
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);
        $datos['nombre_pagina'] = 'Error 401';
        $datos['tarea'] = '';
        //Breadcrumb
        $breadcrumb = array(
            array()
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);
        // =====================================
        // Datos prepocesados
        // =====================================
        return $datos;
    } //end cargar_datos

    //Funcion principal
    public function index()
    {
        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('errores/error_401', $this->cargar_datos());
        } //end else
        else {
            // mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    /**
     * Funciones externas 
     */
}//end Dashboard
