<?php

function exception_handler (Throwable $exception) {
    print PHP_EOL. $exception->getMessage() .PHP_EOL.
    'On file: '.$exception->getFile() .PHP_EOL.
    'On line: '. $exception->getLine() .PHP_EOL.
    $exception->getTraceAsString() .PHP_EOL;
}

function throw_exception ($sException) {
    throw new Exception($sException);
}

set_exception_handler('exception_handler');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS);
define('CONFIG', ROOT . DS . 'config' . DS);
define('VENDOR', ROOT . DS . 'vendor' . DS);

require(CONFIG . DS . 'bootstrap.php');

use Ziel\System\Event;

##extrisic to multithreads with pipes

#from cron
#use Ziel\Framework\Console; //cron > http/dns// start/stop

#to intrinsic 
#use Ziel\Framework\Pipes;

#from extrisic
#use Ziel\Framework\Console; //console http server read lo
#use Ziel\Framework\Event; //index

#write logs
#use Ziel\Framework\Logs; //reports in var

#call dispatch
#use Ziel\Framework\Dispatcher; //call from extrisic /bin /public

//#-- end vendor
//#read logs
//#use Ziel\Draft\Logs; //call from extrisic /bin /public

#multithreads
#use Ziel\Draft\Threads;
#dispatch > threads > task > return

#--
#to intrinsic > intrincis #view
#for Dashboard //dispatch > thread > view > render

$event = new Event();
$event->call();

?>