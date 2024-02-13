<?php

// =======================
// B R E A D   C R U M B
// =======================
function breadcrumb($tarea = '', $breadcrumb = array())
{
    $html = '';
    if (sizeof($breadcrumb) > 0) {
        $html .= '
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">' . $tarea . '</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . route_to("dashboard") . '">Inicio</a></li>';
        foreach ($breadcrumb as $nav) {
            if (isset($nav['href'])) {
                if ($nav["href"] != '#') {
                    $html .= '<li class="breadcrumb-item active"><a href="' . $nav["href"] . '">' . $nav["tarea"] . '</a></li>';
                } //end nav
                else {
                    $html .= '<li class="breadcrumb-item text-black">' . $nav["tarea"] . '</li>';
                } //end else
            } //end if isset
        } //end foreach
        $html .= '</ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            ';
    } //end if sizeof
    return $html;
} //end breadcrumb

// ===========================
// Crear Mensaje
// ===========================
function mensaje($texto = "", $tipo = 5, $tiempo = 1000)
{
    $mensaje = array();
    $mensaje['texto'] = $texto;
    $mensaje['tipo'] = $tipo;
    $mensaje['tiempo'] = $tiempo;
    session()->set('mensaje', $mensaje);
}

// ===========================
// Mostrar Mensaje
// ===========================
function mostrar_mensaje()
{
    $html = '';
    $session = session();
    $mensaje = $session->get("mensaje");
    $session->set("mensaje", null);

    if ($mensaje == null) {
        return "";
    }

    switch ($mensaje['tipo']) {
        case ALERT_SUCCESS:
            //satifactoriamente
            $tipoMensaje = "success";
            $titulo = "¡Correcto!";
            break;
        case ALERT_DANGER:
            //Error
            $tipoMensaje = "error";
            $titulo = "¡Error!";
            break;
        case ALERT_WARNING:
            //Atencion
            $tipoMensaje = "warning";
            $titulo = "¡Atención!";
            break;

        default:
            $tipoMensaje = "info";
            $titulo = "¡Bienvenido!";
            break;
    }
    $html = '
    toastr["' . $tipoMensaje . '"]("' . $mensaje["texto"] . '", "' . $titulo . '", {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "showDuration": "' . $mensaje["tiempo"] . '",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut" 
    })
    ';

    return $html;
}
