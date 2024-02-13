<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

//rutas administrativas
$routes->get('/dashboard', 'panel\Dashboard::index', ['as' => 'dashboard']);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*Definir una nueva ruta
   $routes ->methodType('routeIdentifycationsURL),
         'Carpet/controllerName::functionName', 
           ['as' => identifierName]*/

$routes->get('/nueva-ruta', 'Home::newFunction');

$routes->get('/inicio', 'Home::inicio');

//** PERFIL */
$routes->get('/perfil', 'Panel\Perfil::index', ['as' => 'perfil']);
$routes->post('/actualizar_mi_perfil', 'Panel\Perfil::actualizar_perfil', ['as' => 'actualizar_mi_perfil']);
$routes->post('/actualizar_password', 'Panel\Perfil::actualizar_password', ['as' => 'actualizar_password']);

//RUTAS ADMINISTRATIVAS
$routes->get('/dashboard', 'panel\Dashboard::index', ['as' => 'dashboard']);

//ruta usuario
$routes->get('/usuario', 'panel\Usuario::index', ['as' => 'usuario']);
$routes->get('/usuario_nuevo', 'panel\Usuario_Nuevo::index', ['as' => 'usuario_nuevo']);
$routes->post('/registrar_usuario', 'panel\Usuario_Nuevo::registrar', ['as' => 'registrar_usuario']);
//Leer Datos a actualizar
// (:any)
$routes->get('/usuario_detalles/(:num)', 'Panel\Usuario_Detalles::index/$1', ['as' => 'usuario_detalles']);
//Actualizar usuario
$routes->post('/editar_usuario', 'Panel\Usuario_Detalles::editar', ['as' => 'editar_usuario']);
$routes->get('/estatus_usuario/(:num)/(:num)', 'panel\Usuario::estatus/$1/$2', ['as' => 'estatus_usuario']);
$routes->get('/eliminar_usuario/(:num)', 'panel\Usuario::eliminar/$1', ['as' => 'eliminar_usuario']);


//ruta libro
$routes->get('/libro', 'panel\Libro::index', ['as' => 'libro']);
$routes->get('/libro_nuevo', 'panel\Libro_Nuevo::index', ['as' => 'libro_nuevo']);
$routes->post('/registrar_libro', 'panel\Libro_Nuevo::registrar', ['as' => 'registrar_libro']);
//Leer Datos a actualizar
// (:any)
$routes->get('/libro_detalles/(:num)', 'Panel\Libro_Detalles::index/$1', ['as' => 'libro_detalles']);
//Actualizar libro
$routes->post('/editar_libro', 'Panel\Libro_Detalles::editar', ['as' => 'editar_libro']);
$routes->get('/estatus_libro/(:num)/(:num)', 'panel\Libro::estatus/$1/$2', ['as' => 'estatus_libro']);
$routes->get('/eliminar_libro/(:num)', 'panel\Libro::eliminar/$1', ['as' => 'eliminar_libro']);


//ruta autor
$routes->get('/autor', 'panel\Autor::index', ['as' => 'autor']);
$routes->get('/autor_nuevo', 'panel\Autor_Nuevo::index', ['as' => 'autor_nuevo']);
$routes->post('/registrar_autor', 'panel\Autor_Nuevo::registrar', ['as' => 'registrar_autor']);
//Leer Datos a actualizar
// (:any)
$routes->get('/autor_detalles/(:num)', 'Panel\Autor_Detalles::index/$1', ['as' => 'autor_detalles']);
//Actualizar autor
$routes->post('/editar_autor', 'Panel\Autor_Detalles::editar', ['as' => 'editar_autor']);
$routes->get('/estatus_autor/(:num)/(:num)', 'panel\Autor::estatus/$1/$2', ['as' => 'estatus_autor']);
$routes->get('/eliminar_autor/(:num)', 'panel\Autor::eliminar/$1', ['as' => 'eliminar_autor']);


//ruta editorial
$routes->get('/editorial', 'panel\Editorial::index', ['as' => 'editorial']);
$routes->get('/editorial_nuevo', 'panel\Editorial_Nuevo::index', ['as' => 'editorial_nuevo']);
$routes->post('/registrar_editorial', 'panel\Editorial_Nuevo::registrar', ['as' => 'registrar_editorial']);
//Leer Datos a actualizar
// (:any)
$routes->get('/editorial_detalles/(:num)', 'Panel\Editorial_Detalles::index/$1', ['as' => 'editorial_detalles']);
//Actualizar autor
$routes->post('/editar_editorial', 'Panel\Editorial_Detalles::editar', ['as' => 'editar_editorial']);
$routes->get('/estatus_editorial/(:num)/(:num)', 'panel\Editorial::estatus/$1/$2', ['as' => 'estatus_editorial']);
$routes->get('/eliminar_editorial/(:num)', 'panel\Editorial::eliminar/$1', ['as' => 'eliminar_editorial']);

/*
 * --------------------------------------------------------------------
 * Rutas para el login o acceso al sistema
 * --------------------------------------------------------------------
 */
$routes->get('/acceso', 'Usuario\Acceso::index');
$routes->post('/validar_credenciales', 'Usuario\Acceso::validar', ['as' => 'validar_credenciales']);
$routes->get('/cerrar', 'Usuario\Cerrar_acceso::index', ['as' => 'cerrar']);

//=======================================================
// RUTAS PARA LOS ERRORES DEL SISTEMA
//=======================================================
// $routes->get('/error_401', 'Errores\Error_401::index', ['as' => 'error_401']);
$routes->get('/error_401', 'Errores\Error_401::index', ['as' => 'error_401']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
