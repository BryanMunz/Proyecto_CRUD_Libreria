<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Autor_Detalles extends BaseController
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
        if (comprobar_acceso(TAREA_DETALLES_AUTOR)) {
            $this->session->tarea_actual = TAREA_DETALLES_AUTOR; 
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

    private function cargar_datos($info_autor = array())
    {
        $datos = array();

        //======================================
        // Datos fundamentales para la plantilla
        //======================================

        // ------VARIABLES DE SESSION --------
        $datos['nombre_usuario'] = $this->session->usuario_completo;
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);

        $datos['nombre_pagina'] = 'Detalles Autor';
        $datos['tarea'] = 'Detalles del Autor';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Autor',
                'href' => route_to('autor')
            ),
            array(
                'tarea' => 'Detalles_Autor',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $datos['autor'] = $info_autor;
        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index($id_autor = 0)
    {
        $tabla_autores = new \App\Models\Tabla_autores;
        $autor = $tabla_autores->obtener_autor($id_autor);

        //Verificamos si no esta vacio
        if (is_null($autor)) {
            mensaje('No se encuentra al autor propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('autor'));
        } //end if 
        else {
            if ($this->permitido) {
                return $this->crear_vista('panel/autor_detalles', $this->cargar_datos($autor));
            } //end else
            else {
                mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
                return redirect()->to(route_to('acceso'));
            } //end else
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

    // =====================================
    // Funcion eliminar imagen
    // =====================================

    private function eliminar_archivo($path = NULL, $file = NULL)
    {
        if (!empty($file)) {
            if (file_exists($path.$file)) {
                unlink($path.$file);
                return TRUE;
            } //end if
        } //end if is_null
        else {
            return FALSE;
        } //end else is_null
    } //end eliminar_archivo

    /**
     * Funciones externas 
     */

    public function editar()
    {
        //Instancia del Modelo
        $tabla_autores = new \App\Models\Tabla_autores;

        //Usuario que se desea editar
        $id_autor = $this->request->getPost("id_autor");

        //Se declara el arreglo para almacenar todo los datos usuario
        $autor = array();
        $autor['nombre_autor'] = $this->request->getPost("nombre");
        $autor['ap_paterno_autor'] = $this->request->getPost("apellido_paterno");
        $autor['ap_materno_autor'] = $this->request->getPost("apellido_materno");
        $autor['sexo_autor'] = $this->request->getPost("sexo");
        $autor['nacionalidad_autor'] = $this->request->getPost("nation");
        $autor['firma_autor'] = $this->request->getPost("firma");
        $autor['nacimiento_autor'] = $this->request->getPost("date");
        $autor['biografia_autor'] = $this->request->getPost("biografia");

        //Verificamos si el usuario desea cambiar la foto_perfil
        if (!empty($this->request->getFile('foto_autor')) && $this->request->getFile('foto_autor')->getSize() > 0) {
            //d($this->request->getPost('foto_anterior'));
            //dd(RECURSO_SB2_IMG);
            $this->eliminar_archivo(RECURSO_SB2_IMG_AUTOR, $this->request->getPost('foto_anterior'));
            $autor['imagen_autor'] = $this->subir_archivo(RECURSO_SB2_IMG_AUTOR, $this->request->getFile('foto_autor'));
        } //end if existe imagen

        //dd('jk');
        if ($tabla_autores->update($id_autor, $autor) > 0) {
            mensaje("El autor ha sido actualizado exitosamente.", ALERT_SUCCESS);
            return redirect()->to(route_to('autor'));
        } //end if se actualiza el usuario
        else {
            mensaje("Hubo un error al actualizar al autor. Intente nuevamente, por favor", ALERT_DANGER);
            return $this->index($id_autor);
        } //end else se inserta el usuario

    } //end editar

}
