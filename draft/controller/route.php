<?php

namespace Ziel\Controller;

class Route {
    
    public function router_init()
    {
        global $aRouter;
        if (empty($_GET)) return $this->router_redirect();
        if (!$this->router_setup()) die('router_setup()');
        $aRouter = array_merge($aRouter, $_GET);
        return true;
    }
    
    public function router_redirect()
    {
        global $aRouter;
        if (!$this->router_setup()) die('router_setup()');
        header('Location: /index.php?'. http_build_query($aRouter));
        exit();
    }
    
    public function router_setup()
    {
        global $aRouter;
        if (empty($aRouter['page'])) $aRouter['page'] = 'home';
        if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
        if (empty($aRouter['theme'])) $aRouter['theme'] = 'light';
        $aRouter = array_merge($aRouter, $_GET);
        return true;
    }
}

/*
global $aRouter, $aEvent, $aRouterNav;
$aRouter = $aEvent = array();

$aRouterNav = array(
	'home' => 'Startseite',
	'dashboard' => 'Dashboard',
	'planer' => 'Planer',
	'login' => 'Login',
	'register' => 'Register',
	'suche' => 'Suche',
	'scheduler' => 'Scheduler',
	'logout' => 'Logout'
);
*/


?>