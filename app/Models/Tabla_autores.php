<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_autores extends Model
{

    //Configuración esencial
    protected $table = 'autores';
    protected $primaryKey = 'id_autor';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_autor',
        'nombre_autor',
        'ap_paterno_autor',
        'ap_materno_autor',
        'sexo_autor',
        'nacionalidad_autor',
        'firma_autor',
        'nacimiento_autor',
        'biografia_autor',
        'imagen_autor'
    ];


    public function data_table_autores($id_autor_sesion = 0)
    {
        $resultado = $this
            ->select('
                            id_autor, estatus_autor, nombre_autor, ap_paterno_autor, 
                            ap_materno_autor, sexo_autor, imagen_autor, nacionalidad_autor, 
                            firma_autor, nacimiento_autor, biografia_autor
                        ')
            ->where('autores.id_autor !=', $id_autor_sesion)
            // ->where('roles.id_rol !=', $rol)
            ->orderBy('ap_paterno_autor', 'ASC')
            ->findAll();
        return $resultado;
    } //end data_table_usuarios

    public function obtener_autor($id_autor = 0)
    {
        // $resultado = $this
        return $this
            ->select('id_autor, nombre_autor, ap_paterno_autor, ap_materno_autor,
                                  sexo_autor, nacionalidad_autor, firma_autor, 
                                  nacimiento_autor, biografia_autor, imagen_autor')
            ->where('id_autor', $id_autor)
            ->first();
        // return $resultado;
    } //end obtener_usuario

    public function obtener_nombre_autor()
    {
         $resultado = $this
            ->select('id_autor, nombre_autor, ap_paterno_autor, ap_materno_autor,
                                  sexo_autor, nacionalidad_autor, firma_autor, 
                                  nacimiento_autor, biografia_autor, imagen_autor')
            ->first();
         return $resultado->result_array();
    } //end obtener_usuario

    public function selectData(){
        $builder = $this->db->table($table);
        $builder->select("*");
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

}//end Tabla_usuarios