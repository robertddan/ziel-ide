<?php

namespace Ziel\Controller;

# get uri wiev/widget name
# set html document tags
# spread stylesheets tags into HTML document
# spread javascript script tags
# call {widget_name}.on.load() function inside js tags
# 

class View {
    
    public $aRouter;
    public $aPage;
    public $aWidget;
    public $aEvent;
    
    public function widget_init()
    {
        
        global $aRouter, $aPage, $aWidget, $aEvent;
        
        $this->aRouter = $aRouter;
        $this->aPage = $aPage;
        $this->aWidget = $aWidget;
        $this->aEvent = $aEvent;
        if (!$this->widget_setup()) die('widget_setup()');
        return true;
    }
    

    public function widget_setup()
    {
        #if (!$this->widget_js()) die('widget_js()');
        #if (!$this->widget_css()) die('widget_css()');
        #if (!$this->widget_nav()) die('widget_nav()');
        #if (!$this->widget_event()) die('widget_event()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        return true;
    }
    
    public function widget_render()
    {
        if (!headers_sent()) {
            header('Content-Type: text/html; charset=utf-8');
            print PHP_EOL;
            print $this->aWidget['html'];
            exit;
        }
        else {
            print $this->aWidget['html'];
            exit;
        }
    }
    
    public function widget_js()
    {
        if (file_exists(DRAFT .'static' . DS . $this->aRouter['page'] .'.js')) {
            $sScript = file_get_contents(DRAFT .'static/'. $this->aRouter['page'] .'.js');
            $sScriptCall = $this->aRouter['page'] .'.on.load();';
        }
        else {
            $sScript = $sScriptCall = '';
        }
        
        if (isset($aPage['script'])) {
            $sScriptPage = $this->aPage['script'];
        }
        else {
            $sScriptPage = '';
        }
        
        $aWidget['script'][] = '<script>'.PHP_EOL.
            $sScript .PHP_EOL.
            $sScriptPage .PHP_EOL.
            $sScriptCall .PHP_EOL.
            '</script>';
            
        return true;
    }
    
    public function widget_css()
    {
        if (file_exists(DRAFT .'static/'. $this->aRouter['page'] .'.css'))
            $aWidget['style'][] = '<style>'. file_get_contents(DRAFT .'static/'. $this->aRouter['page'] .'.css') .'</style>';
        if ($aRouter['theme'] == 'light') {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/water.css">';
        }
        else {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/dark.css">';
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/layer.css">';
        }
        return true;
    }
    
    /*
    5 P 	2. Navigation: Erstellen Sie eine dynamische Navigation 
    über mehrere Unterseiten 
    */
    public function widget_nav()
    {
        if (!$this->widget_nav_menu()) die('widget_nav_menu()');
        if (!$this->widget_nav_theme()) die('widget_nav_theme()');
        $aWidget['nav'] = '';
        
        $aWidget['nav'] .= '<nav class="shadow">
            <div class="container">
                <a href="/">
                    <img alt="Suiteziel" id="logo" src="public/suiteziel_ug.svg">
                    <h2>Suite & Ziel <small>Terminplaner</small></h2>
                </a>
            <ul>'. implode(PHP_EOL, $this->aWidget['nav_menu']).'</ul>
            </div>
        </nav>';
        return true;
    }
    
    private function widget_nav_menu()
    {
        $this->aWidget['nav_menu'] = array();
        
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
        foreach ($aRouterNav as $sLink => $sName) {
            if ($this->aRouter['page'] == $sLink) $sSelected = 'selected';
            else $sSelected = '';
            if (isset($_SESSION['user']) && $sLink == 'login') continue;
            if (isset($_SESSION['user']) && $sLink == 'register') continue;
            if (!isset($_SESSION['user']) && $sLink == 'logout') continue;
            if (!isset($_SESSION['user']) && $sLink == 'dashboard') continue;
            if (isset($_SESSION['user']) && $sLink == 'home') continue;
            $aLinks = $aRouter;
            $aLinks['page'] = $sLink;
            $sLink = '<li><a class="'. $sSelected .'" href="?'. http_build_query($aLinks) .'">'. $sName .'</a></li>';
            array_push($this->aWidget['nav_menu'], $sLink);
        }
        return true;
    }
    
    private function widget_nav_theme()
    {
        $this->aWidget['nav_theme'] = '';
        return true;
    }
    
    public function widget_event()
    {
        $this->aWidget['events'] = '';
        if (empty($aEvent)) return true;
        $this->aWidget['events'] = '<div class="'. $this->aEvent['type'] .'" id="event"><b>'. $this->aEvent['message'] .'</b></div>';
        #if (!event_clear()) die('event_clear()');
        return true;
    }
    
    public function widget_html()
    {
        
        global $aRouter, $aPage, $aWidget, $aEvent;
var_dump([
#$this->aPage,
#$this->aRouter,
#$aRouter, 
$aPage, 
$aWidget, 
$aEvent
]);
        
        $sNamespace = 'Ziel\\View\\'. $this->aRouter['page'];
        call_user_func(array($sNamespace, $this->aRouter['page'] .'_init'));
        
        $aWidget['html'] = '';
        
        $aWidget['html'] .= '<!--- doctype -->';
        $aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html class="" lang="'. $this->aRouter['lang'] .'">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>'. $this->aPage['title'] .'</title>';
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        $aWidget['html'] .= '<main><div class="container">';
        #$aWidget['html'] .= $aWidget['events'];
        $aWidget['html'] .= $this->aPage['content'];
        $aWidget['html'] .= '</div></main>';
        
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        return true;
    }

}

?>

?><?php

namespace Ziel\Controller;

# get uri wiev/widget name
# set html document tags
# spread stylesheets tags into HTML document
# spread javascript script tags
# call {widget_name}.on.load() function inside js tags
# 

class View {
    
    public function widget_init()
    {
        global $aWidget;
        #if (!$this->widget_js()) die('widget_js()');
        #if (!$this->widget_css()) die('widget_css()');
        #if (!$this->widget_nav()) die('widget_nav()');
        #if (!$this->widget_event()) die('widget_event()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        return true;
    }
    
    public function widget_render()
    {
        global $aWidget, $aRouter;
        if (!headers_sent()) {
            header('Content-Type: text/html; charset=utf-8');
            print PHP_EOL;
            print $aWidget['html'];
            exit;
        }
        else {
            print $aWidget['html'];
            exit;
        }
    }
    
    public function widget_js()
    {
        global $aRouter, $aPage, $aWidget;
        
        if (file_exists(DRAFT .'static' . DS . $aRouter['page'] .'.js')) {
            $sScript = file_get_contents(DRAFT .'static/'. $aRouter['page'] .'.js');
            $sScriptCall = $aRouter['page'] .'.on.load();';
        }
        else {
            $sScript = $sScriptCall = '';
        }
        
        if (isset($aPage['script'])) {
            $sScriptPage = $aPage['script'];
        }
        else {
            $sScriptPage = '';
        }
        
        $aWidget['script'][] = '<script>'.PHP_EOL.
            $sScript .PHP_EOL.
            $sScriptPage .PHP_EOL.
            $sScriptCall .PHP_EOL.
            '</script>';
            
        return true;
    }
    
    public function widget_css()
    {
        global $aRouter, $aWidget;
        if (file_exists(DRAFT .'static/'. $aRouter['page'] .'.css'))
            $aWidget['style'][] = '<style>'. file_get_contents(DRAFT .'static/'. $aRouter['page'] .'.css') .'</style>';
        if ($aRouter['theme'] == 'light') {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/water.css">';
        }
        else {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/dark.css">';
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/layer.css">';
        }
        return true;
    }
    
    /*
    5 P 	2. Navigation: Erstellen Sie eine dynamische Navigation 
    über mehrere Unterseiten 
    */
    public function widget_nav()
    {
        global $aRouter, $aWidget;
        if (!$this->widget_nav_menu()) die('widget_nav_menu()');
        if (!$this->widget_nav_theme()) die('widget_nav_theme()');
        $aWidget['nav'] = '';
        
        $aWidget['nav'] .= '<nav class="shadow">
            <div class="container">
                <a href="/">
                    <img alt="Suiteziel" id="logo" src="public/suiteziel_ug.svg">
                    <h2>Suite & Ziel <small>Terminplaner</small></h2>
                </a>
            <ul>'. implode(PHP_EOL, $aWidget['nav_menu']).'</ul>
            </div>
        </nav>';
        return true;
    }
    
    private function widget_nav_menu()
    {
        global $aRouter, $aWidget, $aRouterNav;
        $aWidget['nav_menu'] = array();
        
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
        foreach ($aRouterNav as $sLink => $sName) {
            if ($aRouter['page'] == $sLink) $sSelected = 'selected';
            else $sSelected = '';
            if (isset($_SESSION['user']) && $sLink == 'login') continue;
            if (isset($_SESSION['user']) && $sLink == 'register') continue;
            if (!isset($_SESSION['user']) && $sLink == 'logout') continue;
            if (!isset($_SESSION['user']) && $sLink == 'dashboard') continue;
            if (isset($_SESSION['user']) && $sLink == 'home') continue;
            #if (isset($_SESSION['user']) && $sLink == 'planer') continue;
            if (!isset($_SESSION['user']) && $sLink == 'calendar') continue;
            if (!isset($_SESSION['user']) && $sLink == 'scheduler') continue;
            if (!isset($_SESSION['user']) && $sLink == 'suche') continue;
            $aLinks = $aRouter;
            $aLinks['page'] = $sLink;
            $sLink = '<li><a class="'. $sSelected .'" href="?'. http_build_query($aLinks) .'">'. $sName .'</a></li>';
            array_push($aWidget['nav_menu'], $sLink);
        }
        return true;
    }
    
    private function widget_nav_theme()
    {
        global $aRouter, $aWidget;
        $aWidget['nav_theme'] = '';
        return true;
    }
    
    public function widget_event()
    {
        global $aRouter, $aEvent, $aWidget;
        $aWidget['events'] = '';
        if (empty($aEvent)) return true;
        $aWidget['events'] = '<div class="'. $aEvent['type'] .'" id="event"><b>'. $aEvent['message'] .'</b></div>';
        #if (!event_clear()) die('event_clear()');
        return true;
    }
    
    public function widget_html()
    {
        global $aRouter, $aPage, $aWidget;
        $sNamespace = 'Ziel\\View\\'. $aRouter['page'];
        call_user_func(array($sNamespace, $aRouter['page'] .'_init'));
        
        $aWidget['html'] = '';
        
        $aWidget['html'] .= '<!--- doctype -->';
        $aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html class="" lang="'. $aRouter['lang'] .'">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>'. $aPage['title'] .'</title>';
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        $aWidget['html'] .= '<main><div class="container">';
        #$aWidget['html'] .= $aWidget['events'];
        $aWidget['html'] .= $aPage['content'];
        $aWidget['html'] .= '</div></main>';
        
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        return true;
    }

}



namespace Ziel\Controller;

# get uri wiev/widget name
# set html document tags
# spread stylesheets tags into HTML document
# spread javascript script tags
# call {widget_name}.on.load() function inside js tags
# 

class Viewe {
    
    public function widget_init()
    {
        global $aWidget;
        #if (!$this->widget_js()) die('widget_js()');
        #if (!$this->widget_css()) die('widget_css()');
        #if (!$this->widget_nav()) die('widget_nav()');
        #if (!$this->widget_event()) die('widget_event()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        return true;
    }
    
    public function widget_render()
    {
        global $aWidget, $aRouter;
        if (!headers_sent()) {
            header('Content-Type: text/html; charset=utf-8');
            print PHP_EOL;
            print $aWidget['html'];
            exit;
        }
        else {
            print $aWidget['html'];
            exit;
        }
    }
    
    public function widget_js()
    {
        global $aRouter, $aPage, $aWidget;
        
        if (file_exists(DRAFT .'static' . DS . $aRouter['page'] .'.js')) {
            $sScript = file_get_contents(DRAFT .'static/'. $aRouter['page'] .'.js');
            $sScriptCall = $aRouter['page'] .'.on.load();';
        }
        else {
            $sScript = $sScriptCall = '';
        }
        
        if (isset($aPage['script'])) {
            $sScriptPage = $aPage['script'];
        }
        else {
            $sScriptPage = '';
        }
        
        $aWidget['script'][] = '<script>'.PHP_EOL.
            $sScript .PHP_EOL.
            $sScriptPage .PHP_EOL.
            $sScriptCall .PHP_EOL.
            '</script>';
            
        return true;
    }
    
    public function widget_css()
    {
        global $aRouter, $aWidget;
        if (file_exists(DRAFT .'static/'. $aRouter['page'] .'.css'))
            $aWidget['style'][] = '<style>'. file_get_contents(DRAFT .'static/'. $aRouter['page'] .'.css') .'</style>';
        if ($aRouter['theme'] == 'light') {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/water.css">';
        }
        else {
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/dark.css">';
            $aWidget['style'][] = '<link rel="stylesheet" href="/draft/static/layer.css">';
        }
        return true;
    }
    
    /*
    5 P 	2. Navigation: Erstellen Sie eine dynamische Navigation 
    über mehrere Unterseiten 
    */
    public function widget_nav()
    {
        global $aRouter, $aWidget;
        if (!$this->widget_nav_menu()) die('widget_nav_menu()');
        if (!$this->widget_nav_theme()) die('widget_nav_theme()');
        $aWidget['nav'] = '';
        
        $aWidget['nav'] .= '<nav class="shadow">
            <div class="container">
                <a href="/">
                    <img alt="Suiteziel" id="logo" src="public/suiteziel_ug.svg">
                    <h2>Suite & Ziel <small>Terminplaner</small></h2>
                </a>
            <ul>'. implode(PHP_EOL, $aWidget['nav_menu']).'</ul>
            </div>
        </nav>';
        return true;
    }
    
    private function widget_nav_menu()
    {
        global $aRouter, $aWidget, $aRouterNav;
        $aWidget['nav_menu'] = array();
        
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
        foreach ($aRouterNav as $sLink => $sName) {
            if ($aRouter['page'] == $sLink) $sSelected = 'selected';
            else $sSelected = '';
            if (isset($_SESSION['user']) && $sLink == 'login') continue;
            if (isset($_SESSION['user']) && $sLink == 'register') continue;
            if (!isset($_SESSION['user']) && $sLink == 'logout') continue;
            if (!isset($_SESSION['user']) && $sLink == 'dashboard') continue;
            if (isset($_SESSION['user']) && $sLink == 'home') continue;
            #if (isset($_SESSION['user']) && $sLink == 'planer') continue;
            if (!isset($_SESSION['user']) && $sLink == 'calendar') continue;
            if (!isset($_SESSION['user']) && $sLink == 'scheduler') continue;
            if (!isset($_SESSION['user']) && $sLink == 'suche') continue;
            $aLinks = $aRouter;
            $aLinks['page'] = $sLink;
            $sLink = '<li><a class="'. $sSelected .'" href="?'. http_build_query($aLinks) .'">'. $sName .'</a></li>';
            array_push($aWidget['nav_menu'], $sLink);
        }
        return true;
    }
    
    private function widget_nav_theme()
    {
        global $aRouter, $aWidget;
        $aWidget['nav_theme'] = '';
        return true;
    }
    
    public function widget_event()
    {
        global $aRouter, $aEvent, $aWidget;
        $aWidget['events'] = '';
        if (empty($aEvent)) return true;
        $aWidget['events'] = '<div class="'. $aEvent['type'] .'" id="event"><b>'. $aEvent['message'] .'</b></div>';
        #if (!event_clear()) die('event_clear()');
        return true;
    }
    
    public function widget_html()
    {
        global $aRouter, $aPage, $aWidget;
        $sNamespace = 'Ziel\\View\\'. $aRouter['page'];
        call_user_func(array($sNamespace, $aRouter['page'] .'_init'));
        #Ziel\View\Home
        
        #if (!file_exists(DRAFT .'view' . DS . $aRouter['page'] .'.php')) {
            #$aRouter['page'] = 'home';
            #return router_redirect();
        #}
        #else {
            #include(DRAFT .'view' . DS . $aRouter['page'] .'.php');
            #call_user_func($aRouter['page'] .'_init');
        #}
        
        $aWidget['html'] = '';
        
        $aWidget['html'] .= '<!--- doctype -->';
        $aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html class="" lang="'. $aRouter['lang'] .'">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>'. $aPage['title'] .'</title>';
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        $aWidget['html'] .= '<main><div class="container">';
        #$aWidget['html'] .= $aWidget['events'];
        $aWidget['html'] .= $aPage['content'];
        $aWidget['html'] .= '</div></main>';
        
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        return true;
    }

}

?>