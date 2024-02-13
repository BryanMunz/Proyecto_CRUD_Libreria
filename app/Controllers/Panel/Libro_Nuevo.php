<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Libro_Nuevo extends BaseController
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
        if (comprobar_acceso(TAREA_LIBRO_NUEVO)) {
            $this->session->tarea_actual = TAREA_LIBRO_NUEVO;
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
        $datos['nombre_usuario'] = $this->session->get('usuario_completo');
        $datos['foto_usuario'] =  base_url(RECURSO_SB2_IMG . $this->session->imagen_usuario);
    
        $datos['nombre_pagina'] = 'Libro Nuevo';
        $datos['tarea'] = 'Libro Nuevo';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Libros',
                'href' => route_to('libro')
            ),
            array(
                'tarea' => 'Libro Usuario',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        // $tabla_libros = new \App\Models\Tabla_libros;
        // $datos['libro'] = $tabla_libros->data_table_libros($this->session->id_libro);

        //$tabla_autores['obtener_nombre_autor'] = $this->Tabla_autores->obtener_nombre_autor();

        // $tabla_autores = new \App\Models\Tabla_autores;
        // $datos['autores'] = $tabla_autores->data_table_autores($this->session->id_autor);
        

        return $datos;
    } // end cargar_datos

    
    //funcion principal
    public function index()
    {

        //Se verifica si la bandera es true
        if ($this->permitido) {
            return $this->crear_vista('panel/libro_nuevo', $this->cargar_datos());
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
    }

    public function registrar()
    {
        //Instancia del Modelo
        $tabla_libros = new \App\Models\Tabla_libros;

        //Se declara el arreglo para almacenar todo los datos
        $libro = array();
        $libro['estatus_libro'] = ESTATUS_HABILITADO;
        $libro['nombre_libro'] = $this->request->getPost("nombre");
        $libro['calificacion'] = $this->request->getPost("calificacion");
        $libro['paginas'] = $this->request->getPost("NoPaginas");
        $libro['lanzamiento'] = $this->request->getPost("fecha");
        $libro['sipnosis'] = $this->request->getPost("descripcion");
        $libro['id_autor'] = $this->request->getPost("autor");
        $libro['id_editorial'] = $this->request->getPost("editorial");

        if (!empty($this->request->getFile('foto_libro')) && $this->request->getFile('foto_libro')->getSize() > 0) {
            $libro['imagen_libro'] = $this->subir_archivo(RECURSO_SB2_IMG_BOOK, $this->request->getFile('foto_libro'));
        } //end if existe imagen

        else {
            if ($tabla_libros->insert($libro) > 0) {
                mensaje("El libro ha sido registrado exitosamente.", ALERT_SUCCESS, "¡Registro exitoso!");
                return redirect()->to(route_to('libro'));
            } //end if inserta el usuario
            else {
                mensaje("Hubo un error al registrar al libro. Intente nuevamente, por favor", ALERT_DANGER, "¡Error al registrar!");
                return $this->index();
            } //end else inserta el usuario
        } //end else
    } //end registrar

}
