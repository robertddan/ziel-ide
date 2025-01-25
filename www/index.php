<?php

function exception_handler (Throwable $exception) {
    print $exception->getMessage() .PHP_EOL;
}

function throw_exception ($sException) {
    throw new Exception($sException);
}

set_exception_handler('exception_handler');

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DS . '..' . DS);
define("CONFIG", ROOT . DS . "config" . DS);
define("DRAFT", ROOT . DS . "draft" . DS);
define("VENDOR", ROOT . DS . "vendor" . DS);

include(CONFIG . DS . 'bootstrap.php');


$aWidget['html'] = '';
#$aWidget['html'] .= '<!--- doctype -->';
#$aWidget['html'] .= '<!doctype html>';
$aWidget['html'] .= '<!--- html -->';
$aWidget['html'] .= '<html class="">';

$aWidget['html'] .= '<!--- head -->';
$aWidget['html'] .= '<head>';
$aWidget['html'] .= '<meta charset="utf-8">';
$aWidget['html'] .= '<title></title>';
$aWidget['html'] .= '</head>';
$aWidget['html'] .= '<!--- /head -->';

$aWidget['html'] .= '<!--- body -->';
$aWidget['html'] .= '<body>';
#$aWidget['html'] .= $aWidget['nav'];

#$aWidget['html'] .= '<main>';
$aWidget['html'] .= '<div id="list"></div>';
#$aWidget['html'] .= $aWidget['events'];
#$aWidget['html'] .= $aPage['content'];
#$aWidget['html'] .= '</main>';

$aWidget['html'] .= '</body>';
$aWidget['html'] .= '<!--- /body -->';

$aWidget['html'] .= '<!--- /html -->';
$aWidget['html'] .= '</html>';

print $aWidget['html'];
?>

<script>
const evtSource = new EventSource("http://127.0.0.1:44321/www/client.php");

evtSource.addEventListener("ping", (event) => {
    const newElement = document.createElement("li");
    const eventList = document.getElementById("list");
    const time = JSON.parse(event.data).time;
    newElement.textContent = `ping at ${time}`;
    eventList.appendChild(newElement);
});

evtSource.onmessage = (event) => {
    const newElement = document.createElement("li");
    const eventList = document.getElementById("list");
    newElement.textContent = `message: ${event.data}`;
    eventList.appendChild(newElement);
};
</script>



