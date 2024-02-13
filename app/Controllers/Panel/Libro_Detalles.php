<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Libro_Detalles extends BaseController
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
        if (comprobar_acceso(TAREA_DETALLES_LIBRO)) {
            $this->session->tarea_actual = TAREA_DETALLES_LIBRO;
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

    private function cargar_datos($info_libro = array())
    {
        $datos = array();

        //======================================
        // Datos fundamentales para la plantilla
        //======================================

        // ------VARIABLES DE SESSION --------
        $datos['nombre_usuario'] = $this->session->usuario_completo;
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);
        $datos['nombre_pagina'] = 'Detalles Usuario';
        $datos['tarea'] = 'Detalles de Usuario';

        $datos['nombre_pagina'] = 'Libros Detalles';
        $datos['tarea'] = 'Libros Detalles';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Libros',
                'href' => route_to('libro')
            ),
            array(
                'tarea' => 'Libro Detalles',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        // $tabla_libros = new \App\Models\Tabla_libros;
        // $datos['libro'] = $tabla_libros->data_table_libros($this->session->id_libro);
        
        $datos['libro'] = $info_libro;
        return $datos;
    } // end cargar_datos

    //funcion principal
    public function index($id_libro = 0)
    {
        //Instacia al modelo libros
        $tabla_libros = new \App\Models\Tabla_libros;
        $libro = $tabla_libros->obtener_libro($id_libro);

                //Verificamos si no esta vacio
        if (is_null($libro)) {
            mensaje('No se encuentra el libro propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('libro'));
        } //end if 
        else {
            if ($this->permitido) {
                return $this->crear_vista('panel/libro_detalles', $this->cargar_datos($libro));
            } //end else
            else {
                mensaje("No tienes permiso para acceder a este módulo, contacte al administrador", ALERT_WARNING);
                return redirect()->to(route_to('acceso'));
            } //end else
        } 
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
        $tabla_libros = new \App\Models\Tabla_libros;

        //Usuario que se desea editar
        $id_libro = $this->request->getPost("id_libro");

        //Se declara el arreglo para almacenar todo los datos
        $libro = array();
        $libro['nombre_libro'] = $this->request->getPost("nombre");
        $libro['calificacion'] = $this->request->getPost("calificacion");
        $libro['paginas'] = $this->request->getPost("NoPaginas");
        $libro['lanzamiento'] = $this->request->getPost("fecha");
        $libro['sipnosis'] = $this->request->getPost("descripcion");
        $libro['id_autor'] = $this->request->getPost("autor");
        $libro['id_editorial'] = $this->request->getPost("editorial");


        //Verificamos si el usuario desea cambiar la foto_perfil
        if (!empty($this->request->getFile('foto_libro')) && $this->request->getFile('foto_libro')->getSize() > 0) {
            //d($this->request->getPost('foto_anterior'));
            //dd(RECURSO_SB2_IMG);
            $this->eliminar_archivo(RECURSO_SB2_IMG_BOOK, $this->request->getPost('foto_anterior'));
            $libro['imagen_libro'] = $this->subir_archivo(RECURSO_SB2_IMG_BOOK, $this->request->getFile('foto_libro'));
        } //end if existe imagen

        //dd('jk');
        if ($tabla_libros->update($id_libro, $libro) > 0) {
            mensaje("El libro ha sido actualizado exitosamente.", ALERT_SUCCESS);
            return redirect()->to(route_to('libro'));
        } //end if se actualiza el usuario
        else {
            mensaje("Hubo un error al actualizar al libro. Intente nuevamente, por favor", ALERT_DANGER);
            return $this->index($id_libro);
        } //end else se inserta el usuario

    } //end editar
}
