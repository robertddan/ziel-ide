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
#if (!Dispatcher::threads()) throw_exception('dispatcher_threads()');


global $aUri, $aRouter;
$aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);

#var_dump($aUri);
if (isset($aUri['host']))
switch ($aUri['host']) {
    case 'favicon.ico':
        header('Content-Type: text/x-icon');
        print file_get_contents(ROOT .'www'. DS .'favicon.ico');
        exit();
    break;
    case 'style':
        header('Content-Type: text/css; charset=utf-8');
        print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
        exit();
    break;
    case 'script':
        header('Content-Type: text/javascript; charset=utf-8');
        print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
        exit();
    break;
    case 'index':
        return true;
    break;
}

$aWidget['html'] = '';
#$aWidget['html'] .= '<!--- doctype -->';
#$aWidget['html'] .= '<!doctype html>';
$aWidget['html'] .= '<!--- html -->';
$aWidget['html'] .= '<html class="">';

$aWidget['html'] .= '<!--- head -->';
$aWidget['html'] .= '<head>';
$aWidget['html'] .= '<meta charset="utf-8">';
#$aWidget['html'] .= '<title>'. $aPage['title'] .'</title>';

$aWidget['html'] .= '<link rel="stylesheet" type="text/css" href="/style/water.css">';
$aWidget['html'] .= '<script type="text/javascript" src="/script/home.js"></script>';

$aWidget['html'] .= '<style>
.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -20px;
    margin-top: -20px;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.hidden {
    display: none;
}
</style>';

$aWidget['html'] .= '</head>';
$aWidget['html'] .= '<!--- /head -->';

$aWidget['html'] .= '<!--- body -->';
$aWidget['html'] .= '<body>';
#$aWidget['html'] .= $aWidget['nav'];

#$aWidget['html'] .= '<main>';

$aWidget['html'] .= '<img>';
$aWidget['html'] .= '<div id="loader" class="loader"></div>';

$aWidget['html'] .= '<div id="root"></div>';
#$aWidget['html'] .= $aWidget['events'];
#$aWidget['html'] .= $aPage['content'];
#$aWidget['html'] .= '</main>';

$aWidget['html'] .= '</body>';
$aWidget['html'] .= '<!--- /body -->';

$aWidget['html'] .= '<!--- /html -->';
$aWidget['html'] .= '</html>';

print $aWidget['html'];

var_dump(getcwd());
?>

<script>
var host = 'ws://127.0.0.1:44321/www/agent.php';
var socket = new WebSocket(host);

socket.addEventListener("message", (event) => {
    document.getElementById('root').innerHTML = "Message from server "+ event.data;
});

socket.addEventListener("open", (event) => {
    var message = {'a':'a1','b':'b2'};
    socket.send(JSON.stringify(message));
    document.getElementById('root').innerHTML = JSON.stringify(message);
});

socket.addEventListener("error", (event) => {
    console.log("WebSocket error: ", event);
});
</script>



<script>

document.onreadystatechange = () => {
    switch (document.readyState) {
        case "loading":
            // The document is loading.
            console.log('loading');
        break;
        case "interactive": {
            console.log('interactive');
            // The document has finished loading and we can access DOM elements.
            // Sub-resources such as scripts, images, stylesheets and frames are still loading.
            //const span = document.createElement("span");
            //span.textContent = "A <span> element.";
            //document.body.appendChild(span);
        break;
        }
        case "complete":
            console.log('complete');
            document.getElementById('loader').classList.add("hidden");
        break;
    }
};

</script>


