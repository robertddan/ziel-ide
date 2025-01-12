<?php

namespace Ziel\Thread;

class View {
    
    public function widget_init()
    {
        global $aRouter;
        
        if (isset($aRouter['uri'])) return $this->widget_uri();
        
        if (!$this->widget_js()) die('widget_js()');
        if (!$this->widget_css()) die('widget_css()');
        if (!$this->debug()) die('debug()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        
        return true;
    }
        
    function widget_uri()
    {
        global $aRouter;
/*
        print '<pre>';    
        var_dump([
            $aWidget,
            $aRouter,
            $aPage
        ]);
        print '</pre>';
*/      
        switch ($aRouter['uri'][0]) {
            case 'favicon.ico':
        		header('Content-Type: text/x-icon; charset=utf-8');
        		print file_get_contents(ROOT .'www'. DS .'favicon.ico');
        		exit();
            break;
            case 'script':
                header('Content-Type: text/css; charset=utf-8');
                print file_get_contents(DRAFT .'static'. DS .$aRouter['uri'][1]);
                exit();
            break;
            case 'style':
                header('Content-Type: text/javascript; charset=utf-8');
                print file_get_contents(DRAFT .'static'. DS .$aRouter['uri'][1]);
                exit();
            break;
            default:
                $this->router_uri();
            break;
        }
    }
    
    function debug()
    {
        global $aRouter, $aPage;
        print '<pre>';    
        var_dump([
            #$_SERVER,
            #$aRouter,
            $_SERVER['REQUEST_URI']
        ]);
        print '</pre>';
        return true;
        
        $aRequest = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        if (empty($aRequest)) return die($aRequest);
        
        $aWidget['uri'] = $aRequest;
        
        return true;
    }

    function widget_css()
    {
        global $aRouter, $aWidget;
        if (file_exists(DRAFT .'static'. DS . $aRouter['page'] .'.css'))
        $aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS . $aRouter['page'] .'.css">';
        $aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS .'water.css">';
        $aWidget['style'][] = '<link rel="icon" type="image/x-icon" href="/favicon.ico">';
        return true;
    }

    function widget_js()
    {
        global $aRouter, $aWidget;
        if (file_exists(DRAFT .'static'. DS . $aRouter['page'] .'.js'))
        $aWidget['script'][] = '<script type="text/javascript" src="/script'. DS . $aRouter['page'] .'.js"></script>';
        return true;
    }

    public function widget_render()
    {
        global $aWidget;
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
    
    public function widget_html()
    {
        global $aWidget, $aRouter, $aPage;
        
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
        $aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        $aWidget['html'] .= '<main><div class="container">';
        #$aWidget['html'] .= $aWidget['events'];
        $aWidget['html'] .= $aPage['content'];
        $aWidget['html'] .= '</div></main>';
        
        $aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        return true;
    }

}

?>
