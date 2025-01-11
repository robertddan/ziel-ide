<?php

namespace Ziel\Thread;

class View {
    
    public function widget_init()
    {
        global $aWidget, $aRouter, $aPage;
        $sNamespace = 'Ziel\\View\\'. $aRouter['page'];
        call_user_func(array($sNamespace, $aRouter['page'] .'_init'));
        
        $this->aRouter = $aRouter;
        $this->aPage = $aPage;
        $this->aWidget = $aWidget;
        
        if (!$this->widget_css()) die('widget_css()');
        if (!$this->widget_html()) die('widget_html()');
        
        if (!$this->debug()) die('debug()');
        if (!$this->widget_render()) die('widget_render()');
        
        return true;
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
        if (file_exists(DRAFT .'static'. DS . $this->aRouter['page'] .'.css'))
        $this->aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/static' . DS . $this->aRouter['page'] .'.css">';
        $this->aWidget['style'][] = '<link rel="stylesheet" type="text/css" href="/static' . DS .'water.css">';
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
