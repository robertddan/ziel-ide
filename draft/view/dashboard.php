<?php

namespace Ziel\View;

class Dashboard {
    
    #global $aWidget;
    #public $aWidget = array();
    
    public static function dashboard_init()
    {
        global $aPage, $aRouter;
        $aPage = array();
        #var_dump($aPage);
        $aRouter['page'] = 'dashboard';
        
        $aPage['content'] = $aPage['script'] = $aPage['projekt'] = '';
        $aPage['title'] = '🔆 Dashboard';
        $aPage['projekt'] = '<br/>🩹Projekt: Terminplaner';
        $aPage['content'] .= '
        	<div id="sidebar">
        	</div>
        	<div id="content">
        		<h3>🔆 Dashboard</h3>
        		<hr></br>
        		'. $aPage['projekt'] .'
        	</div>
        ';
    }
}







?>