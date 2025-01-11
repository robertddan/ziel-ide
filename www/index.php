<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DS . '..' . DS);
define("CONFIG", ROOT . DS . "config" . DS);
define("DRAFT", ROOT . DS . "draft" . DS);
define("VENDOR", ROOT . DS . "vendor" . DS);

include(CONFIG . DS . 'bootstrap.php');

if (!Dispatcher::threads()) die('dispatcher_threads()');

?>