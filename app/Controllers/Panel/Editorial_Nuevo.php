<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Editorial_Nuevo extends BaseController
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
        if (comprobar_acceso(TAREA_EDITORIAL_NUEVO)) {
            $this->session->tarea_actual = TAREA_EDITORIAL_NUEVO;
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
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);

        $datos['nombre_pagina'] = 'Nueva Editorial';
        $datos['tarea'] = 'Nueva Editorial';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Editorial',
                'href' => route_to('editorial')
            ),
            array(
                'tarea' => 'Nueva Editorial',
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
            return $this->crear_vista('panel/editorial_nuevo', $this->cargar_datos());
        } //end else
        else {
            mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
            return redirect()->to(route_to('acceso'));
        } //end else
    } //end index

    // =====================================
    // Funcion agregar imagen
    // =====================================

    private function subir_archivo($path = NULL, $file = NULL)
    {
        $file_name = $file->getRandomName();
        $file->move($path, $file_name);
        return $file_name;
    } //end subir_archivo


    /**
     * Funciones externas 
    */

    public function registrar()
    {
        //Instancia del Modelo
        $tabla_editoriales = new \App\Models\Tabla_editoriales;

        //Se declara el arreglo para almacenar todo los datos
        $editorial = array();
        $editorial['estatus_editorial'] = ESTATUS_HABILITADO;
        $editorial['nombre_editorial'] = $this->request->getPost("nombre");
        $editorial['direccion_editorial'] = $this->request->getPost("direccion");

        if (!empty($this->request->getFile('foto_editorial')) && $this->request->getFile('foto_editorial')->getSize() > 0) {
            $editorial['imagen_editorial'] = $this->subir_archivo(RECURSO_SB2_IMG_EDITORIAL, $this->request->getFile('foto_editorial'));
        } //end if existe imagen

        if ($tabla_editoriales->insert($editorial) > 0) {
            mensaje("La Editorial ha sido registrada exitosamente.", ALERT_SUCCESS, "¡Registro exitoso!");
            return redirect()->to(route_to('editorial'));
        } //end if inserta el autor
        else {
            mensaje("Hubo un error al registrar a la editorial. Intente nuevamente, por favor", ALERT_DANGER, "¡Error al registrar!");
            return $this->index();
        } //end else inserta el usuario
    } //end registrar

}