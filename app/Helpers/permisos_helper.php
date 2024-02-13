<?php

/**
 * Archivo que se va a encargar de verificar si realmente
 * un usuario tiene los permisos adecuados para ingresar al 
 * sistema
 */
function comprobar_acceso($tarea_actual = '')
{
    $acceso = FALSE;

    //Intancias de la session
    $session = session();

    switch ($session->rol_actual) {
        case ROL_ADMINISTRADOR['clave']:
            $acceso = in_array($tarea_actual, ACCESO_ADMINISTRADOR);
            break;

        case ROL_OPERADOR['clave']:
            $acceso = in_array($tarea_actual, ACCESO_OPERADOR);
            break;

        default:
            $acceso = FALSE;
            break;
    } //end switch

    return $acceso;
}//end comprobar_acceso