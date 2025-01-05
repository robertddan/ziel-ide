<?php
include(__DIR__ .'/config/bootstrap.php');


function error_throw($sMsg = 'Error: (empty message)')
{
    return die('Error: '. $sMsg);
}

if (!dispatcher_dispatch()) error_throw('dispatcher_dispatch()');
?>