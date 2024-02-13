<?php

    //================================
    //Función para configurar el menú 
    //================================
    function configurar_menu_panel( $ro_actual = NULL){
        //INSTANCIA DE LA VARIABLE DE SESSION
        $session = session();

        $menu = array();
        $menu_item = array();
        $sub_menu_item = array();

        //Opción Dashboard
        $menu_item['is_active'] = FALSE;
        $menu_item['href'] = route_to('dashboard');
        $menu_item['icon'] = 'fas fa-home';
        $menu_item['text'] = 'Dashboard';
        $menu_item['submenu'] = array();
        $menu['dashboard'] = $menu_item;

        //Opción dashboard
        $menu_item['is_active'] =  FALSE;
        $menu_item['href'] = route_to('libro');
        $menu_item['icon'] = 'fa fa-book';
        $menu_item['text'] = 'Libros';
        $menu_item['submenu'] = array();
        $menu['libro'] = $menu_item;
        
        // d($session->rol_actual);
        // dd(ROL_ADMINISTRADOR["clave"]);
        if ($session->rol_actual == ROL_ADMINISTRADOR["clave"]) {
            //Opción Usuarios
            $menu_item['is_active'] = FALSE;
            $menu_item['href'] = route_to('usuario');
            $menu_item['icon'] = 'fas fa-users';
            $menu_item['text'] = 'Usuarios';
            $menu_item['submenu'] = array();
            $menu['usuarios'] = $menu_item;
            
    
    
            //Opción dashboard
            $menu_item['is_active'] =  FALSE;
            $menu_item['href'] = route_to('autor');
            $menu_item['icon'] = 'fa fa-pen';
            $menu_item['text'] = 'Autores';
            $menu_item['submenu'] = array();
            $menu['autores'] = $menu_item;

            
            //Opción dashboard
            $menu_item['is_active'] =  FALSE;
            $menu_item['href'] = route_to('editorial');
            $menu_item['icon'] = 'fa fa-table';
            $menu_item['text'] = 'Editoriales';
            $menu_item['submenu'] = array();
            $menu['editoriales'] = $menu_item;
        } //end if
        

        return $menu;
    }//end configurar_menu_panel

    //==========================================
    //Función para activar una opción del menú
    //==========================================
    function activar_menu_item_panel($menu = NULL, $tarea_actual = NULL){
        /*
            Example to active the option menu
    
            NORMAL LEVEL
            FORMULE:
                - Section
            EXAMPLE:
                case TAREA_SECTION:
                    $menu['section']['is_active'] = TRUE;
                break;
    
            ONE LEVEL
            FORMULE:
                - Section
                    - Subsection
            EXAMPLE:
                case TAREA_SECTION:
                    $menu['section']['is_active'] = TRUE;
                    $menu['section']['submenu']['subsection']['is_active'] = TRUE;
                break;
        */
        switch ($tarea_actual) {
            //SECCIÓN DASHBOARD
            case TAREA_DASHBOARD:
                $menu['dashboard']['is_active'] = TRUE;
            break;

            //SECCIÓN USUARIOS
            case TAREA_USUARIOS:
                $menu['usuarios']['is_active'] = TRUE;
            break;

            case TAREA_USUARIO_NUEVO:
                $menu['usuarios']['is_active'] = TRUE;
            break;

            case TAREA_DETALLES_USUARIO:
                $menu['usuarios']['is_active'] = TRUE;
            break;

            //SECCIÓN LIBROS
            case TAREA_LIBROS:
                $menu['libro']['is_active'] = TRUE;
            break;

            case TAREA_LIBRO_NUEVO:
                $menu['libro']['is_active'] = TRUE;
            break;

            case TAREA_DETALLES_LIBRO:
                $menu['libro']['is_active'] = TRUE;
            break;

            //SECCIÓN AUTORES
            case TAREA_AUTORES:
                $menu['autores']['is_active'] = TRUE;
            break;

            case TAREA_AUTOR_NUEVO:
                $menu['autores']['is_active'] = TRUE;
            break;

            case TAREA_DETALLES_AUTOR:
                $menu['autores']['is_active'] = TRUE;
            break;

            
            //SECCIÓN AUTORES
            case TAREA_EDITORIALES:
                $menu['editoriales']['is_active'] = TRUE;
            break;

            case TAREA_EDITORIAL_NUEVO:
                $menu['editoriales']['is_active'] = TRUE;
            break;

            case TAREA_DETALLES_EDITORIAL:
                $menu['editoriales']['is_active'] = TRUE;
            break;

            // case TAREA_USUARIO_NUEVO:
                //     $menu['usuarios']['is_active'] = TRUE;
                // break;
            // case TAREA_USUARIO_DETALLES:
            //     $menu['usuarios']['is_active'] = TRUE;
            // break;
            default:
            break;
        }//end switch tarea actual
        return $menu;
    }//end activar_menu_item_panel
    

    //================================
    //Función para crear el menú 
    //================================
    function crear_menu_panel(){
        //INSTANCIA DE LA VARIABLE DE SESSION
        $session = session();

        //Opcion para generar el arreglo de tomo mi menú
        $menu = configurar_menu_panel();

        //Opción para activar dicha opcion de cada módulo
        $menu = activar_menu_item_panel($menu, $session->tarea_actual);



    $html = '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
    foreach ($menu as $item) {
        if (isset($item['href'])) {
            if ($item['href'] != '#') {
                $html.= '
                    <li class="nav-item">
                        <a href="'.$item['href'].'"  class="nav-link '.($item["is_active"] ? 'active' : '').'">
                        <i class="'.$item['icon'].' nav-icon"></i>
                        <span>'.$item['text'].'</span>
                        </a>
                    </li>';
            } //end if href != # 
            else {
                if (sizeof($item['submenu']) > 0) {
                    $html.= '
                        <li class="nav-item '.($item["is_active"]?'menu-is-opening menu-open':'').'">
                            <a href="'.$item['href'].'" class="nav-link '.($item["is_active"]?'active':'').'">
                                <i class="nav-icon ' . $item['icon'] . '"></i>
                                <span>
                                    '.$item['text'].'
                                    <i class="right fa fa-sort-desc"></i>
                                </span>
                            </a>
                            <ul class="nav nav-treeview">';
                    foreach ($item['submenu'] as $item_sub_menu) {
                        // $html.='<li><a href="'.$item_sub_menu["href"].'">'.$item_sub_menu["text"].'</a></li>';
                        $html.= '
                                    <li class="nav-item">
                                        <a href="'.$item_sub_menu["href"].'"  class="nav-link '.($item_sub_menu["is_active"] ? 'active' : '') . '">
                                            <i class="'.$item_sub_menu['icon'].' nav-icon"></i>
                                            <p>'.$item_sub_menu["text"].'</p>
                                        </a>
                                    </li>
                                ';
                    } //end foreach
                    $html.= '</ul>
                        </li>
                        ';
                } //end else sizeof
            } //end else href != #
        }
    } //end foreach
    $html.= '</ul>';
    return $html;
}//end 