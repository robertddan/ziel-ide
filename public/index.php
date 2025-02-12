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

#event //pipe
#backend

$event = new Event();
$event->call();

?>