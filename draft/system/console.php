<?php

namespace Ziel\System;

#todo a flag, already rendered
class Console {
    
    public function event_init()
    {
        global $aRouter, $aEvents, $aUri, $aWidget, $bProcess;
        $aRouter = $aEvents = $aUri = $aWidget = array();
        $bProcess = false;
        #if (!$this->event_print()) throw_exception('event_print');
        return true;
    }
    
}

?>
