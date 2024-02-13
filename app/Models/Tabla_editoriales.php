<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_editoriales extends Model
{

    //Configuración esencial
    protected $table = 'editorial';
    protected $primaryKey = 'id_editorial';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_editorial',
        'nombre_editorial',
        'direccion_editorial',
        'imagen_editorial'
    ];


    public function data_table_editoriales($id_editorial_sesion = 0)
    {
        $resultado = $this
            ->select('
                            id_editorial, estatus_editorial, nombre_editorial, direccion_editorial, imagen_editorial
                        ')
            ->where('editorial.id_editorial !=', $id_editorial_sesion)
            // ->where('roles.id_rol !=', $rol)
            ->orderBy('nombre_editorial', 'ASC')
            ->findAll();
        return $resultado;
    } //end data_table_usuarios

    public function obtener_editorial($id_editorial = 0)
    {
        // $resultado = $this
        return $this
            ->select('id_editorial, estatus_editorial, nombre_editorial, direccion_editorial, imagen_editorial')
            ->where('id_editorial', $id_editorial)
            ->first();
        // return $resultado;
    } //end obtener_usuario

}//end Tabla_usuarios