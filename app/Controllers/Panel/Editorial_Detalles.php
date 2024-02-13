<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Editorial_Detalles extends BaseController
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
        if (comprobar_acceso(TAREA_DETALLES_EDITORIAL)) {
            $this->session->tarea_actual = TAREA_DETALLES_EDITORIAL; 
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

    private function cargar_datos($info_editorial = array())
    {
        $datos = array();

        //======================================
        // Datos fundamentales para la plantilla
        //======================================

        // ------VARIABLES DE SESSION --------
        $datos['nombre_usuario'] = $this->session->usuario_completo;
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);

        $datos['nombre_pagina'] = 'Detalles Editorial';
        $datos['tarea'] = 'Detalles del Editorial';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'editorial',
                'href' => route_to('editorial')
            ),
            array(
                'tarea' => 'Detalles_Editorial',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $datos['editorial'] = $info_editorial;
        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index($id_editorial = 0)
    {
        $tabla_editoriales = new \App\Models\Tabla_editoriales;
        $editorial = $tabla_editoriales->obtener_editorial($id_editorial);

        //Verificamos si no esta vacio
        if (is_null($editorial)) {
            mensaje('No se encuentra la editorial propocionada.', ALERT_WARNING);
            return redirect()->to(route_to('editorial'));
        } //end if 
        else {
            if ($this->permitido) {
                return $this->crear_vista('panel/editorial_detalles', $this->cargar_datos($editorial));
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
        $tabla_editoriales = new \App\Models\Tabla_editoriales;

        //Usuario que se desea editar
        $id_editorial = $this->request->getPost("id_editorial");

        //Se declara el arreglo para almacenar todo los datos editorial
        $editorial = array();
        $editorial['nombre_editorial'] = $this->request->getPost("nombre");
        $editorial['direccion_editorial'] = $this->request->getPost("direccion");

        //Verificamos si el usuario desea cambiar la foto_perfil
        if (!empty($this->request->getFile('foto_editorial')) && $this->request->getFile('foto_editorial')->getSize() > 0) {
            //d($this->request->getPost('foto_anterior'));
            //dd(RECURSO_SB2_IMG);
            $this->eliminar_archivo(RECURSO_SB2_IMG_EDITORIAL, $this->request->getPost('foto_anterior'));
            $editorial['imagen_editorial'] = $this->subir_archivo(RECURSO_SB2_IMG_EDITORIAL, $this->request->getFile('foto_editorial'));
        } //end if existe imagen

        //dd('jk');
        if ($tabla_editoriales->update($id_editorial, $editorial) > 0) {
            mensaje("La editorial ha sido actualizada exitosamente.", ALERT_SUCCESS);
            return redirect()->to(route_to('editorial'));
        } //end if se actualiza el usuario
        else {
            mensaje("Hubo un error al actualizar a la editorial. Intente nuevamente, por favor", ALERT_DANGER);
            return $this->index($id_editorial);
        } //end else se inserta el autor

    } //end editar

}
