<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_usuarios extends Model
{

    //Configuración esencial
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_usuario',
        'nombre_usuario',
        'ap_paterno_usuario',
        'ap_materno_usuario',
        'sexo_usuario',
        'email_usuario',
        'password_usuario',
        'imagen_usuario',
        'id_rol'
    ];

    //====FUNCIONES ESPECIFICAS ====
    public function validar_usuario($email = null, $password = null)
    {
        return $this->select('usuarios.nombre_usuario, 
                                    usuarios.id_usuario,
                                usuarios.ap_paterno_usuario, 
                                usuarios.ap_materno_usuario, 
                                usuarios.email_usuario,
                                usuarios.imagen_usuario, 
                                usuarios.sexo_usuario, 
                                usuarios.estatus_usuario,
                                usuarios.id_rol, roles.rol')
            ->join('roles', 'usuarios.id_rol = roles.id_rol')
            ->where('usuarios.email_usuario', $email)
            ->where('usuarios.password_usuario', $password)
            ->first();
    } //end validar_usuario

    public function existe_usuario($email = null)
    {
        //Generamos la consulta SQL
        $resultado = $this
            ->select('email_usuario')
            ->where('email_usuario', $email)
            ->first();

        $opcion = FALSE;

        if ($resultado != NULL) {
            $opcion = TRUE;
        } //end if existe registro

        return $opcion;
    } //end encontrar_usuario

    public function data_table_usuarios($id_usuario_sesion = 0, $rol = 0)
    {
        $resultado = $this
            ->select('
                            id_usuario, estatus_usuario, nombre_usuario, ap_paterno_usuario, 
                            ap_materno_usuario, sexo_usuario, imagen_usuario, 
                            email_usuario, roles.rol
                        ')
            ->join('roles', 'roles.id_rol = usuarios.id_rol')
            ->where('usuarios.id_usuario !=', $id_usuario_sesion)
            // ->where('roles.id_rol !=', $rol)
            ->orderBy('ap_paterno_usuario', 'ASC')
            ->findAll();
        return $resultado;
    } //end data_table_usuarios

    public function obtener_usuario($id_usuario = 0)
    {
        // $resultado = $this
        return $this
            ->select('id_usuario, nombre_usuario, ap_paterno_usuario, ap_materno_usuario,
                                  sexo_usuario, email_usuario, imagen_usuario, id_rol')
            ->where('id_usuario', $id_usuario)
            ->first();
        // return $resultado;
    } //end obtener_usuario

}//end Tabla_usuarios