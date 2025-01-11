<?php

namespace Ziel\Thread;

class Event {

    public function event_init()
    {
        global $aRouter, $aPage, $aRequest;
        $aRouter = $aPage = $aRequest = array();
        return true;
    }
    
}

?>
