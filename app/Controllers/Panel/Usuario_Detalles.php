<?php

namespace App\Controllers\panel;

use App\Controllers\baseController;

class Usuario_Detalles extends BaseController
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
        if (comprobar_acceso(TAREA_DETALLES_USUARIO)) {
            $this->session->tarea_actual = TAREA_DETALLES_USUARIO;
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

    private function cargar_datos($info_usuario = array())
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
        //Breadcrumb
        $breadcrumb = array(
            array(
                'tarea' => 'Usuarios',
                'href' => route_to('usuario')
            ),
            array(
                'tarea' => 'Usuario Detalles',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);

        //======================================
        // datos procesados
        //======================================
        $datos['usuario'] = $info_usuario;
        return $datos;
    } // end cargar_datos

    //Funcion principal
    public function index($id_usuario = 0)
    {
        //Instacia al modelo usuarios
        $tabla_usuarios = new \App\Models\Tabla_usuarios;
        $usuario = $tabla_usuarios->obtener_usuario($id_usuario);

        //Verificamos si no esta vacio
        if (is_null($usuario)) {
            mensaje('No se encuentra al usuario propocionado.', ALERT_WARNING);
            return redirect()->to(route_to('usuario'));
        } //end if 
        else {
            if ($this->permitido) {
                return $this->crear_vista('panel/usuario_detalles', $this->cargar_datos($usuario));
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
        $tabla_usuarios = new \App\Models\Tabla_usuarios;

        //Usuario que se desea editar
        $id_usuario = $this->request->getPost("id_usuario");

        //Se declara el arreglo para almacenar todo los datos
        $usuario = array();
        $usuario['nombre_usuario'] = $this->request->getPost("nombre");
        $usuario['ap_paterno_usuario'] = $this->request->getPost("apellido_paterno");
        $usuario['ap_materno_usuario'] = $this->request->getPost("apellido_materno");
        $usuario['sexo_usuario'] = $this->request->getPost("sexo");
        $usuario['email_usuario'] = $this->request->getPost("email");
        $usuario['id_rol'] = $this->request->getPost("rol");

        //Verificamos si la contraseña a repetir no está vacia
        if (!is_null($this->request->getPost('confirm_password'))) {
            $usuario['password_usuario'] = hash('sha256', $this->request->getPost('password'));
        } //end if

        //Verificamos si el usuario desea cambiar la foto_perfil
        if (!empty($this->request->getFile('foto_perfil')) && $this->request->getFile('foto_perfil')->getSize() > 0) {
            //d($this->request->getPost('foto_anterior'));
            //dd(RECURSO_SB2_IMG);
            $this->eliminar_archivo(RECURSO_SB2_IMG, $this->request->getPost('foto_anterior'));
            $usuario['imagen_usuario'] = $this->subir_archivo(RECURSO_SB2_IMG, $this->request->getFile('foto_perfil'));
        } //end if existe imagen

        //dd('jk');
        if ($tabla_usuarios->update($id_usuario, $usuario) > 0) {
            mensaje("El usuario ha sido actualizado exitosamente.", ALERT_SUCCESS);
            return redirect()->to(route_to('usuario'));
        } //end if se actualiza el usuario
        else {
            mensaje("Hubo un error al actualizar al usuario. Intente nuevamente, por favor", ALERT_DANGER);
            return $this->index($id_usuario);
        } //end else se inserta el usuario

    } //end editar

}
