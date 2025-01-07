<?php

namespace Ziel\Controller;

class View {

    #global $aView;
    #$aView = array();
    
    public function view_render()
    {
        if (!$this->view_page()) error_throw('view_page()');
        return true;
    }
    
    public function view_page()
    {
        global $aRouter;
        
print '<pre>';
var_dump([
    $aRouter
    #file_exists(DRAFT .'view' . DS . $aRouter['page'] .'.php')
]);
print '</pre>';
        
        if (!file_exists(DRAFT .'view' . DS . $aRouter['page'] .'.php')) {
            $aRouter['page'] = 'home';
            #return router_redirect();
        }
        else {
            #include(DRAFT .'view' . DS . $aRouter['page'] .'.php');
            call_user_func($aRouter['page'] .'_init');
        }
        
print '<pre>';
var_dump([
    $aRouter
    #file_exists(DRAFT .'view' . DS . $aRouter['page'] .'.php')
]);
print '</pre>';

        return true;
    }

}

?>