<?php

/**
 * Las siguientes líneas no se deben 
 * de editar y ni manipular 
 * porque no va a funcionar su módulo 
 * y van a llorar después :) :V :( :* <3
 */

namespace App\Models;

use CodeIgniter\Model;

class Tabla_libros extends Model
{

    //Configuración esencial
    protected $table = 'libros';
    protected $primaryKey = 'id_libro';
    protected $returnType = 'object';
    protected $allowedFields = [
        'estatus_libro',
        'nombre_libro',
        'calificacion',
        'paginas',
        'lanzamiento',
        'sipnosis',
        'imagen_libro',
        'id_autor',
        'id_editorial'
    ];


    public function data_table_libros($id_libro_sesion = 0)
    {
        $resultado = $this
            ->select('
                            id_libro, estatus_libro, nombre_libro, calificacion, 
                            paginas, lanzamiento, sipnosis, imagen_libro, 
                            autores.firma_autor, editorial.nombre_editorial
                        ')
            ->join('autores', 'autores.id_autor = libros.id_autor')
            ->join('editorial', 'editorial.id_editorial = libros.id_editorial')
            ->where('libros.id_libro !=', $id_libro_sesion)
            // ->where('roles.id_rol !=', $rol)
            ->orderBy('nombre_libro', 'ASC')
            ->findAll();
        return $resultado;
    } //end data_table_usuarios

    public function obtener_libro($id_libro = 0)
    {
        // $resultado = $this
        return $this
            ->select('id_libro, estatus_libro, nombre_libro, calificacion, 
                                 paginas, lanzamiento, sipnosis, imagen_libro, id_autor, id_editorial')
            ->where('id_libro', $id_libro)
            ->first();
        // return $resultado;
    } //end obtener_usuario

}//end Tabla_usuarios