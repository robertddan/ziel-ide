<?php

namespace Ziel\Thread;

class View {
    
    public function widget_init()
    {
        global $aWidget, $aRouter, $aPage;
        
        if (isset($aRouter['uri'])) return $this->widget_uri();
        
        $sNamespace = 'Ziel\\View\\'. $aRouter['page'];
        call_user_func(array($sNamespace, $aRouter['page'] .'_init'));
        
        $this->aRouter = $aRouter;
        $this->aPage = $aPage;
        $this->aWidget = $aWidget;
        
        if (!$this->widget_css()) die('widget_css()');
        if (!$this->debug()) die('debug()');
        if (!$this->widget_html()) die('widget_html()');
        if (!$this->widget_render()) die('widget_render()');
        
        return true;
    }
        
    function widget_uri()
    {
        global $aWidget, $aRouter, $aPage;
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
                if (!$this->widget_favicon()) die('widget_favicon()');
            break;
            case 'static':
                if (!$this->widget_js()) die('widget_js()');
            break;
            case 'style':
                if (!$this->widget_css()) die('widget_css()');
            break;
            default:
                $this->router_uri();
            break;
        }
    }
        
    function widget_favicon()
    {
		header('Content-Type: text/x-icon');
		print file_get_contents(ROOT .'www'. DS .'favicon.ico');
		exit();
    }
    
    function debug()
    {
        global $aWidget, $aRouter, $aPage;
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
        global $aWidget, $aRouter, $aPage;
        if (isset($aRouter['uri'])) {
            header('Content-Type: text/x-icon');
            print file_get_contents(DRAFT .'static'. DS .$aRouter['uri'][1]);
            exit();
        }
        
        if (file_exists(DRAFT .'static'. DS . $aRouter['page'] .'.css'))
        $this->aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS . $this->aRouter['page'] .'.css">';
        $this->aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/style' . DS .'water.css">';
        $this->aWidget['style'][] = '<link rel="icon" type="image/x-icon" href="/favicon.ico">';
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
    
    public function widget_html()
    {
        $aWidget['html'] = '';
        
        $aWidget['html'] .= '<!--- doctype -->';
        $aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html class="" lang="'. $this->aRouter['lang'] .'">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>'. $this->aPage['title'] .'</title>';
        $aWidget['html'] .= implode(PHP_EOL, $this->aWidget['style']);
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
        
        $this->aWidget = $aWidget;
        
        return true;
    }

}

?>
