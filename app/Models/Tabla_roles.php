<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabla_roles extends Model
{

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $returnType = 'object';
    protected $allowedFileds = ['estatus_rol', 'rol'];
}//end class