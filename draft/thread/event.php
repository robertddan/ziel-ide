<?php

namespace Ziel\Thread;

class Event {

    public function event_init()
    {
        global $aRouter, $aPage, $aRequest, $aUri;
        $aRouter = $aPage = $aRequest = $aUri = array();
        
        #var_dump();
        
        
        return true;
    }
    
}

?>
