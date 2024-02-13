<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Autor_Nuevo extends BaseController
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
        if (comprobar_acceso(TAREA_AUTOR_NUEVO)) {
            $this->session->tarea_actual = TAREA_AUTOR_NUEVO;
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

        $datos['nombre_pagina'] = 'Nuevo Autor';
        $datos['tarea'] = 'Nuevo Autor';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Autor',
                'href' => route_to('autor')
            ),
            array(
                'tarea' => 'Nuevo Autor',
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
            return $this->crear_vista('panel/autor_nuevo', $this->cargar_datos());
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
        $tabla_autores = new \App\Models\Tabla_autores;

        //Se declara el arreglo para almacenar todo los datos
        $autor = array();
        $autor['estatus_autor'] = ESTATUS_HABILITADO;
        $autor['nombre_autor'] = $this->request->getPost("nombre");
        $autor['ap_paterno_autor'] = $this->request->getPost("apellido_paterno");
        $autor['ap_materno_autor'] = $this->request->getPost("apellido_materno");
        $autor['sexo_autor'] = $this->request->getPost("sexo");
        $autor['nacionalidad_autor'] = $this->request->getPost("nation");
        $autor['firma_autor'] = $this->request->getPost("firma");
        $autor['nacimiento_autor'] = $this->request->getPost("date");
        $autor['biografia_autor'] = $this->request->getPost("biografia");

        if (!empty($this->request->getFile('foto_autor')) && $this->request->getFile('foto_autor')->getSize() > 0) {
            $autor['imagen_autor'] = $this->subir_archivo(RECURSO_SB2_IMG_AUTOR, $this->request->getFile('foto_autor'));
        } //end if existe imagen

        if ($tabla_autores->insert($autor) > 0) {
            mensaje("El autor ha sido registrado exitosamente.", ALERT_SUCCESS, "¡Registro exitoso!");
            return redirect()->to(route_to('autor'));
        } //end if inserta el usuario
        else {
            mensaje("Hubo un error al registrar al autor. Intente nuevamente, por favor", ALERT_DANGER, "¡Error al registrar!");
            return $this->index();
        } //end else inserta el usuario
    } //end registrar

}
