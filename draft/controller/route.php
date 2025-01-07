<?php

namespace Ziel\Controller;

class Route {
    
    public static $aRouter = array();
    
    public static function router_init()
    {
        if (empty($_GET)) return self::router_redirect();
        if (!self::router_setup()) Event::error_throw('router_setup()');
        self::$aRouter = array_merge(self::$aRouter, $_GET);
        return true;
    }
    
    public static function router_redirect()
    {
        if (!self::router_setup()) Event::error_throw('router_setup()');
        header('Location: /index.php?'. http_build_query(self::$aRouter));
        exit();
    }
    
    public static function router_setup()
    {
        if (empty(self::$aRouter['page'])) self::$aRouter['page'] = 'home';
        if (empty(self::$aRouter['lang'])) self::$aRouter['lang'] = 'en';
        if (empty(self::$aRouter['theme'])) self::$aRouter['theme'] = 'light';
        self::$aRouter = array_merge(self::$aRouter, $_GET);
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