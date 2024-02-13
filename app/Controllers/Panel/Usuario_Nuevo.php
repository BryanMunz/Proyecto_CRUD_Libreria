<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Usuario_Nuevo extends BaseController
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
        if (comprobar_acceso(TAREA_USUARIO_NUEVO)) {
            $this->session->tarea_actual = TAREA_USUARIO_NUEVO;
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

        $datos['nombre_pagina'] = 'Nuevo Usuario';
        $datos['tarea'] = 'Nuevo Usuario';
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Usuarios',
                'href' => route_to('usuario')
            ),
            array(
                'tarea' => 'Nuevo Usuario',
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
            return $this->crear_vista('panel/usuario_nuevo', $this->cargar_datos());
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
        $tabla_usuarios = new \App\Models\Tabla_usuarios;

        //Se declara el arreglo para almacenar todo los datos
        $usuario = array();
        $usuario['estatus_usuario'] = ESTATUS_HABILITADO;
        $usuario['nombre_usuario'] = $this->request->getPost("nombre");
        $usuario['ap_paterno_usuario'] = $this->request->getPost("apellido_paterno");
        $usuario['ap_materno_usuario'] = $this->request->getPost("apellido_materno");
        $usuario['sexo_usuario'] = $this->request->getPost("sexo");
        $usuario['email_usuario'] = $this->request->getPost("email");
        $usuario['password_usuario'] = hash('sha256', $this->request->getPost('password'));
        $usuario['id_rol'] = $this->request->getPost("rol");

        if (!empty($this->request->getFile('foto_perfil')) && $this->request->getFile('foto_perfil')->getSize() > 0) {
            $usuario['imagen_usuario'] = $this->subir_archivo(RECURSO_SB2_IMG, $this->request->getFile('foto_perfil'));
        } //end if existe imagen

        //Verificamos si existe un registro previo
        $encontro = $tabla_usuarios->existe_usuario($usuario['email_usuario']);

        //Verificamos si el usuario ya existe
        if ($encontro != FALSE) {
            mensaje("El correo " . $usuario['email_usuario'] . " ya existe, por favor ingrese un nuevo correo", ALERT_WARNING, "¡Error al registrar!");
            return $this->index();
        } //end encontro TRUE
        else {
            if ($tabla_usuarios->insert($usuario) > 0) {
                mensaje("El usuario ha sido registrado exitosamente.", ALERT_SUCCESS, "¡Registro exitoso!");
                return redirect()->to(route_to('usuario'));
            } //end if inserta el usuario
            else {
                mensaje("Hubo un error al registrar al usuario. Intente nuevamente, por favor", ALERT_DANGER, "¡Error al registrar!");
                return $this->index();
            } //end else inserta el usuario
        } //end else
    } //end registrar

}
