<?php

namespace Ziel\System;

class Route {
    
    public function router_init()
    {
        if (isset($_GET)) $this->router_get_init();
        elseif (isset($_POST)) $this->router_post_init();
        else $this->router_redirect();
        return true;
    }
    
    public function router_get_init()
    {
        global $aUri;
        $aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);
        switch ($aUri["host"]) {
            case 'index':
                $this->router_get();
            break;
            case 'style':
            case 'script':
            case 'favicon.ico':
                $this->router_uri();
            break;
            default:
                if (empty($_GET)) $this->router_redirect();
            break;
        }
        return true;
    }
    
    public function router_post_init()
    {
        global $aUri;
        $aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);
        switch ($aUri["host"]) {
            case 'index':
                $this->router_get();
            break;
            default:
                if (empty($_GET)) $this->router_redirect();
            break;
        }
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