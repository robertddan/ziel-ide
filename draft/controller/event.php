<?php

namespace Ziel\Controller;

class Event {
    
    public function error_throw($sMsg = 'Error: (empty message)')
    {
        return die('Error: '. $sMsg);
    }
    
    public function event_init()
    {
        global $aRouter, $aPage;
        $aRouter = $aPage = array();
        
        #$_SESSION['event']
        #print '<pre>';
        #var_dump($GLOBALS);
        #print '</pre>';
        return true;
    }

}
