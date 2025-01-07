<?php
include(__DIR__ .'/config/bootstrap.php');

if (!Dispatcher::threads()) die('dispatcher_threads()');
        
var_dump([
    isset($_SESSION['draft'])
]);
?>