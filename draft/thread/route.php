<?php

namespace Ziel\Thread;

class Route {
    
    public function router_init()
    {
        global $aRouter, $aRequest;
        if (!empty($_GET) or !empty($_POST)) $aRequest = array_values(array_filter(explode('?', $_SERVER['REQUEST_URI'])));
        else $aRequest = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
        if (empty($aRequest)) $this->router_redirect();
        
        switch ($aRequest[0]) {
            case '/index':
                $this->router_get();
            break;
            case '/ide':
                $this->router_ide();
            break;
            default:
                $this->router_uri();
            break;
            #default:
                #$this->router_default();
        }
        
        return true;
    }
    
    public function router_ide()
    {
        global $aRouter, $aRequest;
        $aRouter = array_merge($aRouter, $_POST);
        return true;
    }
    
    public function router_get()
    {
        global $aRouter, $aRequest;
        $aRouter = array_merge($aRouter, $_GET);
        return true;
    }
    
    public function router_uri()
    {
        global $aRouter, $aRequest;
        $aRouter['uri'] = $aRequest;
        return true;
    }
    
    public function router_redirect()
    {
        global $aRouter;
        if (empty($aRouter['page'])) $aRouter['page'] = 'home';
        if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
        header('Location: /index?'. http_build_query($aRouter));
        exit();
    }
    
}

?>