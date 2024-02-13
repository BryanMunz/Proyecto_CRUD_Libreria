<?php

namespace APP\Controllers\Usuario;

use App\Controllers\BaseController;

class Acceso extends BaseController
{

   private function crear_vista($nombre_vista = '')
   {
      return view($nombre_vista);
   }

   public function index()
   {
      //Cargamos la intancia de sesion
      $session = session();

      //Comprobamos si el valor ha sido instanciado
      if (isset($session->sesion_iniciada)) {

         if ($session->modulo_permitido == FALSE) {
            return redirect()->to(route_to('error_401'));
         }

         return redirect()->to(route_to('dashboard'));
      } //end if
      else {
         return $this->crear_vista('usuario/acceso');
      } //end else
   }

   public function validar()
   {
      $email = $this->request->getPost("email_usuario");
      $password = $this->request->getPost("password_usuario");

      //CARGAR UN MODELO
      $tabla_usuarios = new \App\Models\Tabla_usuarios;

      $usuario = $tabla_usuarios->validar_usuario($email, hash("sha256", $password));
      if ($usuario != NULL) {

         if ($usuario->estatus_usuario == ESTATUS_HABILITADO) {
            //Creación de la variable de sesion
            $session = session();
            $session->set("sesion_iniciada", TRUE);
            $session->set("modulo_permitido", TRUE);
            $session->set("id_usuario", $usuario->id_usuario);
            $session->set("nombre_usuario", $usuario->nombre_usuario);
            $session->set("usuario_completo", $usuario->nombre_usuario . ' ' . $usuario->ap_paterno_usuario . ' ' . $usuario->ap_materno_usuario);
            $session->set("sexo_usuario", $usuario->sexo_usuario);
            $session->set("email_usuario", $usuario->email_usuario);
            $session->set("imagen_usuario", (!is_null($usuario->imagen_usuario))
               ? $usuario->imagen_usuario : (($usuario->sexo_usuario == SEXO_MASCULINO['clave'])
                  ? "male.png" : "female.png"));
            $session->set("rol_actual", $usuario->id_rol);
            $session->set("tarea_actual", TAREA_DASHBOARD);

            mensaje("Bienvenido", ALERT_INFO, 2000);
            return redirect()->to(route_to('dashboard'));
         } //end if estatus habilitado
         else {
            mensaje("Error tu usuario está deshabiliado", ALERT_WARNING, 2000);
            return redirect()->to(route_to('acceso'));
         } //end else
      } //end if
      else {
         mensaje("Usuario y/o contraseña incorrectos", ALERT_DANGER, 2000);
         return redirect()->to(route_to('acceso'));
      } //end 

   } //end validar

} //end acceso 