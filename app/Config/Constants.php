<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);
define('RECURSO_USUARIO_CSS', 'recursos_panel/panel/css/');
define('RECURSO_USUARIO_JS', 'recursos_panel/panel/js/');
define('RECURSO_USUARIO_VENDOR', 'recursos_panel/panel/plugins/');
define('RECURSO_SB2_IMG', 'recursos_panel/panel/img/');
define('RECURSO_SB2_IMG_BOOK', 'recursos/img/libros/');
define('RECURSO_SB2_IMG_AUTOR', 'recursos/img/autores/');
define('RECURSO_SB2_IMG_EDITORIAL', 'recursos/img/editoriales/');
define('RECURSO_SB2_GLOBALES', 'recursos_panel/panel/js/globales/');


//=======================================================
//CONSTANTES DEL SISTEMA
//=======================================================
define("ALERT_SUCCESS", 1);
define("ALERT_DANGER", 2);
define("ALERT_WARNING", 3);
define("ALERT_INFO", 4);

//COnstantes para el sexo del usuario
define("SEXO_MASCULINO", array('clave' => '1', 'sexo' => 'masculino'));
define("SEXO_FEMENINO", array('clave' => '2', 'sexo' => 'femenino'));

//CONSTANTES PARA LOS ESTATUS
define("ESTATUS_HABILITADO", 1);
define("ESTATUS_DESHABILITADO", 2);

//CONSTANTES PARA LOS NOMBRES DE LOS AUTORES
define("NOMBRE_AUTOR", array('clave' => '1', 'autor' => 'J.R.R. Tolkien'));
define("NOMBRE_AUTOR2", array('clave' => '2', 'autor' => 'Jk Rollings'));
define("NOMBRE_AUTOR3", array('clave' => '3', 'autor' => 'Robert C. Martin'));
define("NOMBRE_AUTOR4", array('clave' => '4', 'autor' => 'Frank Miller'));
define("AUTORES", array(
    NOMBRE_AUTOR['clave'] => NOMBRE_AUTOR['autor'],
    NOMBRE_AUTOR2['clave'] => NOMBRE_AUTOR2['autor'],
    NOMBRE_AUTOR3['clave'] => NOMBRE_AUTOR3['autor'],
    NOMBRE_AUTOR4['clave'] => NOMBRE_AUTOR4['autor']
));

//CONSTANTES PARA LOS NOMBRES DE LAS EDITORIALES
define("NOMBRE_EDITORIAL", array('clave' => '1', 'editorial' => 'Salvat'));
define("NOMBRE_EDITORIAL2", array('clave' => '2', 'editorial' => 'Santillam'));
define("EDITORIALES", array(
    NOMBRE_EDITORIAL['clave'] => NOMBRE_EDITORIAL['editorial'],
    NOMBRE_EDITORIAL2['clave'] => NOMBRE_EDITORIAL2['editorial']
));

//Constantes para el rol del usuario
define("ROL_ADMINISTRADOR", array('clave' => 795, 'rol' => 'Administrador'));
define("ROL_OPERADOR", array('clave' => 888, 'rol' => 'operador'));

define("ROLES", array(
    ROL_ADMINISTRADOR['clave'] => ROL_ADMINISTRADOR['rol'],
    ROL_OPERADOR["clave"] => ROL_OPERADOR["rol"]
));

//=======================================================
//CONSTANTES PARA LAS TAREAS - ADMINISTRATIVAS
//=======================================================
define("TAREA_DASHBOARD", 'tarea_actual');
define("TAREA_PERFIL", 'tarea_perfil');

define("TAREA_USUARIOS", 'tarea_usuarios');
define("TAREA_USUARIO_NUEVO", 'tarea_usuario_nuevo');
define("TAREA_DETALLES_USUARIO", 'tarea_detalles_usuario');

define("TAREA_LIBROS", 'tarea_libros');
define("TAREA_LIBRO_NUEVO", 'tarea_libro_nuevo');
define("TAREA_DETALLES_LIBRO", 'tarea_detalles_libro');

define("TAREA_AUTORES", 'tarea_autores');
define("TAREA_AUTOR_NUEVO", 'tarea_autor_nuevo');
define("TAREA_DETALLES_AUTOR", 'tarea_detalles_autor');

define("TAREA_EDITORIALES", 'tarea_editoriales');
define("TAREA_EDITORIAL_NUEVO", 'tarea_editorial_nuevo');
define("TAREA_DETALLES_EDITORIAL", 'tarea_detalles_editorial');

//CONSTANTES PARA EL ACCESO AL SISTEMA
define("ACCESO_ADMINISTRADOR", array(
    TAREA_DASHBOARD,
    TAREA_USUARIOS,
    TAREA_USUARIO_NUEVO,
    TAREA_DETALLES_USUARIO,
    TAREA_PERFIL,
    TAREA_LIBROS,
    TAREA_LIBRO_NUEVO,
    TAREA_DETALLES_LIBRO,
    TAREA_AUTORES,
    TAREA_AUTOR_NUEVO,
    TAREA_DETALLES_AUTOR,
    TAREA_EDITORIALES,
    TAREA_EDITORIAL_NUEVO,
    TAREA_DETALLES_EDITORIAL
));

define("ACCESO_OPERADOR", array(
    TAREA_DASHBOARD,
    TAREA_PERFIL,
    TAREA_LIBROS,
    TAREA_LIBRO_NUEVO,
    TAREA_DETALLES_LIBRO
));
