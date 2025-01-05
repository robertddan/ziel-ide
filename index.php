<?php
include(__DIR__ .'/config/bootstrap.php');

#if (!Autoload::autoload_files()) return print('autoload_files()');
if (!dispatcher_dispatch()) return Event::error_throw('dispatcher_dispatch()');

?>