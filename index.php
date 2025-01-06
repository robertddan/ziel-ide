<?php
include(__DIR__ .'/config/bootstrap.php');

if (!Dispatcher::dispatch()) Event::error_throw('dispatcher_dispatch()');
var_dump([
    isset($_SESSION['draft'])
]);
?>