<?php

namespace Ziel\Controller;

class View {

    #global $aView;
    #$aView = array();
    
    public static function view_render()
    {
        return true;
    }
    
    public static function view_setup()
    {
        if (!view_page()) error_throw('view_page()');
        return true;
    }
    
    public static function view_page()
    {
        global $aRouter;
        if (!file_exists(DRAFT .'view/'. $aRouter['page'] .'.php')) {
            $aRouter['page'] = 'home';
            return router_redirect();
        }
        else {
            include(DRAFT .'view/'. $aRouter['page'] .'.php');
            call_user_func($aRouter['page'] .'_init');
        }
        
        return true;
    }

}

?>