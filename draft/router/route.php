<?php

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

function router_init()
{
	global $aRouter;
	if (empty($_GET)) return router_redirect();
	if (!router_setup()) error_throw('router_setup()');
	$aRouter = array_merge($aRouter, $_GET);
	return true;
}

function router_redirect()
{
	global $aRouter;
	if (!router_setup()) error_throw('router_setup()');
	header('Location: /?'. http_build_query($aRouter));
	exit();
}

function router_setup()
{
	global $aRouter;
	if (empty($aRouter['page'])) $aRouter['page'] = 'home';
	if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
	if (empty($aRouter['theme'])) $aRouter['theme'] = 'light';
	$aRouter = array_merge($aRouter, $_GET);
	return true;
}

?>