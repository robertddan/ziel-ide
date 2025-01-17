<?php

namespace Ziel\Thread;

class View {
    
    public function widget_init()
    {
        if (!$this->widget_uri()) die('widget_uri()');
        if (!$this->widget_js()) die('widget_js()');
        if (!$this->widget_css()) die('widget_css()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        return true;
    }
        
    function widget_uri()
    {
        global $aUri;
        switch ($aUri['host']) {
            case 'favicon.ico':
                header('Content-Type: text/x-icon');
                print file_get_contents(ROOT .'www'. DS .'favicon.ico');
                exit();
            break;
            case 'style':
                header('Content-Type: text/css; charset=utf-8');
                print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
                exit();
            break;
            case 'script':
                header('Content-Type: text/javascript; charset=utf-8');
                print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
                exit();
            break;
            case 'index':
                return true;
            break;
        }
    }

    public function widget_render()
    {
        global $aWidget;
        if (!headers_sent()) {
            #header('Content-Type: text/html; charset=utf-8');
            #print PHP_EOL;
            print $aWidget['html'];
            exit();
        }
        else {
            print $aWidget['html'];
            exit();
        }
    }

    function widget_css()
    {
        global $aRouter, $aWidget;
        $aWidget['style'] = array();
        $aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS .'water.css">';
        if (file_exists(DRAFT .'static'. DS . $aRouter['page'] .'.css'))
        $aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS . $aRouter['page'] .'.css">';
        $aWidget['style'][] = '<link rel="icon" type="image/x-icon" href="/favicon.ico">';
        return true;
    }

    function widget_js()
    {
        global $aRouter, $aWidget;
        $aWidget['script'] = array();
        if (file_exists(DRAFT .'static'. DS . $aRouter['page'] .'.js'))
        $aWidget['script'][] = '<script type="text/javascript" src="/script'. DS . $aRouter['page'] .'.js"></script>';
        return true;
    }
    
    public function widget_html()
    {
        global $aWidget, $aRouter, $aPage;
        $sNamespace = 'Ziel\\View\\'. $aRouter['page'];
        call_user_func(array($sNamespace, $aRouter['page'] .'_init'));
        
        $aWidget['html'] = '';
        #$aWidget['html'] .= '<!--- doctype -->';
        #$aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html class="" lang="'. $aRouter['lang'] .'">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>'. $aPage['title'] .'</title>';
        $aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        #$aWidget['html'] .= '<main>';
        #$aWidget['html'] .= $aWidget['events'];
        $aWidget['html'] .= $aPage['content'];
        #$aWidget['html'] .= '</main>';
        
        $aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        return true;
    }

}

?>
