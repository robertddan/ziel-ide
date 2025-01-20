<?php

namespace Ziel\Thread;

class Stream {

    public function stream_init()
    {
        #if (!$this->session_globals()) return false;
        return true;
    }
    
    public function stream_globals()
    {
        #if (!session_start()) die('session_globals()');
        #$_SESSION['draft'] = $GLOBALS;
        #return true;
    }
}

?>