<?php

namespace Ziel\Controller;

class Session {

    public function session_init()
    {
        if (!$this->session_globals()) return false;
        return true;
    }
    
    public function session_globals()
    {
        if (!session_start()) die('session_globals()');
        $_SESSION['draft'] = $GLOBALS;
        return true;
    }
}
