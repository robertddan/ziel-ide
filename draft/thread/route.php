<?php

namespace Ziel\Thread;

class Route {
    
    public function router_init()
    {
        global $aUri;
        $aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);
        
        switch ($aUri["host"]) {
            case 'index':
                $this->router_get();
            break;
            case 'script':
                $this->router_uri();
            break;
            case 'ide':
                $this->router_post();
            break;
            default:
                if (empty($_GET)) $this->router_redirect();
            break;
        }
        
        return true;
    }
    
    public function router_post()
    {
        global $aRouter;
        $aRouter = array_merge($aRouter, $_POST);
        return true;
    }
    
    public function router_get()
    {
        global $aRouter;
        $aRouter = array_merge($aRouter, $_GET);
        return true;
    }
    
    public function router_uri()
    {
        global $aUri;
        $aUri['path'] = trim($aUri['path'], '/');
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