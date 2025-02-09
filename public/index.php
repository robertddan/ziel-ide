<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DS . '..' . DS);
define("CONFIG", ROOT . DS . "config" . DS);

require(CONFIG . DS . 'bootstrap.php');

use Ziel\System\Event;



#event //pipe
# backend

$event = new Event();
$event->call();

?>