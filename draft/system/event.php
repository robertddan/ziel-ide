<?php

namespace Ziel\System;

class Event {

    public function event_init()
    {
        global $aRouter, $aUri, $aWidget;
        $aRouter = $aUri = $aWidget = array();
        if (!$this->event_print()) throw_exception('event_print');
        return true;
    }

    public function event_print()
    {
        $aWidget['html'] = '';
        #$aWidget['html'] .= '<!--- doctype -->';
        #$aWidget['html'] .= '<!doctype html>';
        $aWidget['html'] .= '<!--- html -->';
        $aWidget['html'] .= '<html">';
        
        $aWidget['html'] .= '<!--- head -->';
        $aWidget['html'] .= '<head>';
        $aWidget['html'] .= '<meta charset="utf-8">';
        $aWidget['html'] .= '<title>Event</title>';
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['style']);
        $aWidget['html'] .= '</head>';
        $aWidget['html'] .= '<!--- /head -->';
        
        $aWidget['html'] .= '<!--- body -->';
        $aWidget['html'] .= '<body>';
        #$aWidget['html'] .= $aWidget['nav'];
        
        #$aWidget['html'] .= '<main>';
        #$aWidget['html'] .= $aWidget['events'];
        #$aWidget['html'] .= $aPage['content'];
        #$aWidget['html'] .= '</main>';
        
        #$aWidget['html'] .= implode(PHP_EOL, $aWidget['script']);
        $aWidget['html'] .= '</body>';
        $aWidget['html'] .= '<!--- /body -->';
        
        $aWidget['html'] .= '<!--- /html -->';
        $aWidget['html'] .= '</html>';
        
        #header('Content-Type: text/html; charset=utf-8');
        print PHP_EOL;
        print $aWidget['html'];
        print '<pre>';
        var_dump([$GLOBALS, getcwd()]);
        print '</pre>';
        exit();
    }
}

?>
