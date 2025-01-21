<?php

namespace Ziel\Thread;

class Session {

    public function session_init()
    {
        
        
$fiveMBs = 5 * 1024 * 1024;
$fp = fopen("php://temp/maxmemory:$fiveMBs", 'r+');

fputs($fp, "hello\n");

// Read what we have written.
rewind($fp);
echo stream_get_contents($fp);
        
        #if (!$this->session_globals()) return false;
        return true;
    }
    
    public function session_globals()
    {
        #if (!session_start()) die('session_globals()');
        #$_SESSION['draft'] = $GLOBALS;
        #return true;
    }
}

?>