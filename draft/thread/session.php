<?php

namespace Ziel\Thread;
/*
-proc open
-proc fork
-crud
-
*/
declare(ticks=1);

class Session {

    public function session_init()
    {
        global $iProcess, $bProcess;
        
$iProcess = pcntl_fork();
#pcntl_waitpid($iProcess, $status);
$executed = 0;

if ($iProcess == -1) {
    die('could not fork');
} else if ($iProcess) {
    // we are the parent
    #pcntl_wait($status); //Protect against Zombie children
    #var_dump();
    
    if (!$bProcess)
    pcntl_exec('php -q "'.DRAFT. 'thread/worker.php"');
    $bProcess = true;
    return true;
} else {
    #var_dump(getcwd());
    // we are the child
}

return true;

#print '<pre>';
$descriptorspec = array(
   0 => array("pipe", "r"), 
   1 => array("pipe", "w"), 
   2 => array("pipe", "r")
);

$oProcess = proc_open('php -q "'.DRAFT. 'thread/worker.php"', $descriptorspec, $pipes, null, null);
#echo ("Start process:\n");

return true;
$descriptorspec = array(
   0 => array("pipe", "r"), 
   1 => array("pipe", "w"), 
   2 => array("pipe", "r")
);

$process = proc_open('php -f "'.DRAFT. 'thread/worker.php"', $descriptorspec, $pipes, null, null); //run test_gen.php
echo ("Start process:\n");

if (is_resource($process)) 
{
    
    fwrite($pipes[0], "start\n");    // send start
    echo ("\n\nStart ....".fgets($pipes[1],4096)); //get answer
    fwrite($pipes[0], "get\n");    // send get
    echo ("Get: ".fgets($pipes[1],4096));    //get answer
    fwrite($pipes[0], "stop\n");    //send stop
    echo ("\n\nStop ....".fgets($pipes[1],4096));  //get answer
    
    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $return_value = proc_close($process);  //stop test_gen.php
    
    var_dump(['##', $return_value]);
    echo ("Returned:".$return_value."\n");

}

return true;

echo "1posix_getpid()=".posix_getpid().", 
1posix_getppid()=".posix_getppid()."\n";

$pid = pcntl_fork();

if ($pid == -1) die("could not fork");
if ($pid) {
    echo "pid=".$pid.", 
    2posix_getpid()=".posix_getpid().", 
    2posix_getppid()=".posix_getppid()."\n";
} else {
    echo "pid=".$pid.", 
    3posix_getpid()=".posix_getpid().", 
    3posix_getppid()=".posix_getppid()."\n";
}

return true;


$outpipe = '/tmp/outpipe';
$inpipe = '/tmp/inpipe';
posix_mkfifo($inpipe, 0600);
posix_mkfifo($outpipe, 0600);

$pid = pcntl_fork();

//parent
if($pid) {
var_dump([11111,$pid]);

    $in = fopen($inpipe, 'w');
    fwrite($in, "A message for the inpipe reader\n");
    fclose($in);
    
    $out = fopen($outpipe, 'r');
    while(!feof($out)) {
        echo "From out pipe: " . fgets($out) . PHP_EOL;
    }
    fclose($out);

    pcntl_waitpid($pid, $status);
    
    if(pcntl_wifexited($status)) {
        echo "Reliable exit code: " . pcntl_wexitstatus($status) . PHP_EOL;
    }
    
    unlink($outpipe);
    unlink($inpipe);
}
//child
else {
var_dump([222222,$pid]);

    //parent
    if($pidx = pcntl_fork()) {
        pcntl_exec('/bin/sh', array('-c', "printf 'A message for the outpipe reader' > $outpipe 2>&1 && exit ".$pidx));
    }
    //child
    else {
        pcntl_exec('/bin/sh', array('-c', "printf 'From in pipe: '; cat $inpipe"));
    }    
}

return true;

for ($x = 1; $x < 5; $x++) {
   switch ($pid = pcntl_fork()) {
      case -1:
         // @fail
         die('Fork failed');
         break;

      case 0:
         // @child: Include() misbehaving code here
         print "FORK: Child #{$x} preparing to nuke...\n";
         generate_fatal_error(); // Undefined function
         break;

      default:
         // @parent
         print "FORK: Parent, letting the child run amok...\n";
         pcntl_waitpid($pid, $status);
         break;
   }
}

print "Done! :^)\n\n";


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