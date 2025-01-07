<?php
include(__DIR__ .'/config/bootstrap.php');

if (!Dispatcher::threads()) die('dispatcher_threads()');

print '<pre>';
var_dump([
    isset($_SESSION['draft']),
    $_SESSION['draft']
]);
print '</pre>';
?>