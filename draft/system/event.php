<?php

namespace Ziel\System;

class Event {

    public function event_init()
    {
        global $aRouter, $aUri, $aWidget;
        $aRouter = $aUri = $aWidget = array();
        return true;
    }
    
}

?>
