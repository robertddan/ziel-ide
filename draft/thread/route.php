<?php

namespace Ziel\Thread;

class Route {
    
    public function router_init()
    {
        global $aRouter, $aRequest;
        if ($_SERVER['REQUEST_URI'] == '/') $this->router_redirect();
        if (empty($_GET))
        $aRequest = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
        else
        $aRequest = array_values(array_filter(explode('?', $_SERVER['REQUEST_URI'])));
        
        print '<pre>';    
        var_dump([
            'router_init',
            $aRequest
        ]);
        print '</pre>';
        
        switch ($aRequest[0]) {
            case '/index.php':
                $this->router_get();
            break;
            case 'script':
                $this->router_uri();
            break;
        }
        
        return true;
    }
    
    public function router_get()
    {
        global $aRouter, $aRequest;
        $aRouter = array_merge($aRouter, $_GET);
        
        print '<pre>';    
        var_dump([
            'router_get',
            $aRequest[0]
        ]);
        print '</pre>';
        
        return true;
    }
    
    public function router_uri()
    {
        global $aRouter, $aRequest;
        $aRouter['uri'] = $aRequest;
        
        print '<pre>';    
        var_dump([
            'router_uri',
            $aRequest[0]
        ]);
        print '</pre>';
        
        return true;
    }
    
    public function router_redirect()
    {
        global $aRouter;
        if (empty($aRouter['page'])) $aRouter['page'] = 'home';
        if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
        header('Location: /index.php?'. http_build_query($aRouter));
        exit();
    }
    
}

?>