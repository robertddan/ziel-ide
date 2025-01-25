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

function router_redirect()
{
    global $aRouter;
    var_dump(['$aRouter', $aRouter]);
    if (empty($aRouter['page'])) $aRouter['page'] = 'home';
    if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
    header('Location: /index?'. http_build_query($aRouter));
    exit();
}

function static_response()
{
    $data = file_get_contents(DRAFT .'static'. DS .'home.css');
    return strlen($data);
}

global $aUri;
$aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);

#echo '<pre>';
#if(!empty($_GET)) var_dump(['$_GET', $_GET]);
#elseif(!empty($_POST)) var_dump(['$_POST', $_POST]);
#else router_redirect();

// TODO Route $_GET $_POST

if (isset($aUri['host']))
switch ($aUri['host']) {
    case 'favicon.ico':
        header('Content-Type: text/x-icon');
        print file_get_contents(ROOT .'www'. DS .'favicon.ico');
        exit();
    break;
    case 'style':
        var_dump(headers_sent());
        header('Content-Type: text/css; charset=utf-8');
        file_get_contents(DRAFT .'static'. DS .$aUri['path']);
        exit();
    break;
    case 'script':
        header('Content-Type: text/javascript; charset=utf-8');
        print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
        exit();
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
#$aWidget['html'] .= '<script type="text/javascript" src="/script/home.js"></script>';
$aWidget['html'] .= '<style>.loader { border: 16px solid #f3f3f3; /* Light grey */ border-top: 16px solid #3498db; /* Blue */ border-radius: 50%; width: 60px; height: 60px; animation: spin 2s linear infinite; position: absolute; top: 50%; left: 50%; margin-left: -20px; margin-top: -20px; } @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } } .hidden { display: none; }</style>';
$aWidget['html'] .= '</head>';
$aWidget['html'] .= '<!--- /head -->';
$aWidget['html'] .= '<!--- body -->';
$aWidget['html'] .= '<body>';
#$aWidget['html'] .= $aWidget['nav'];

#$aWidget['html'] .= '<main>';
$aWidget['html'] .= '<br /><button id="sendtext" type="submit">Click Me!</button>';
$aWidget['html'] .= '<div id="loader" class="loader"></div>';
$aWidget['html'] .= '<div id="root"></div>';
$aWidget['html'] .= '<div id="open"></div>';
#$aWidget['html'] .= $aWidget['events'];
#$aWidget['html'] .= $aPage['content'];
#$aWidget['html'] .= '</main>';

$aWidget['html'] .= '</body>';
$aWidget['html'] .= '<!--- /body -->';
$aWidget['html'] .= '<!--- /html -->';
$aWidget['html'] .= '</html>';

if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
    print PHP_EOL;
    print $aWidget['html'];
    #return true;
}
else {
    print $aWidget['html'];
    #return true;
    #exit();
}

?>

<script>

function sendText() {
    const msg = {
        type: "message",
        text: document.getElementById("root").value,
        date: Date.now(),
    };
    socket.send(JSON.stringify(msg));
    console.log(JSON.stringify(msg));
}

function web_socket(){
    var host = 'ws://127.0.0.1:44321/www/agent.php';
    var socket = new WebSocket(host);
    console.log("web_socket");

    socket.addEventListener("message", (event) => {
        //console.log("WebSocket message: ", event);
        document.getElementById('root').innerHTML = "Message from server "+ event.data;
    });
    
    socket.addEventListener("open", (event) => {
        console.log("WebSocket open: ", event);
        document.getElementById('loader').classList.add("hidden");
        var message = {'a':'a1','b':'b2'};
        socket.send(JSON.stringify(message));
        document.getElementById('root').innerHTML = JSON.stringify(message);
    });
    
    socket.addEventListener("close", (event) => {
        console.log("WebSocket close: ", event);
        document.getElementById('loader').classList.remove("hidden");
        setTimeout(1);
        web_socket();
    });
    
    socket.addEventListener("error", (event) => {
        console.log("WebSocket error: ", event);
        document.getElementById('loader').classList.remove("hidden");
        setTimeout(1);
        web_socket();
    });    
/*
    socket.onopen = function(event) {
        console.log("WebSocket open: ", event);
        document.getElementById('loader').classList.add("hidden");
        document.getElementById('open').innerHTML = JSON.stringify(event.data);
        var message = {'a':'a1','b':'b2'};
        socket.send(JSON.stringify(message));
    };
    
    socket.onmessage = function(event) {
        document.getElementById('root').innerHTML = "Message from server "+ event.data;
        var message = {'a':'a1','b':'b2'};
        socket.send(JSON.stringify(message));
    };
    
    socket.onclose = function(event) {
        console.log("WebSocket close: ", event);
        document.getElementById('loader').classList.remove("hidden");
        var message = {'a':'a1','b':'b2'};
        socket.send(JSON.stringify(message));
        setTimeout(2);
        web_socket();
    };
    
    socket.onerror = function(error) {
        console.log("WebSocket error: ", event);
        document.getElementById('loader').classList.remove("hidden");
        var message = {'a':'a1','b':'b2'};
        socket.send(JSON.stringify(message));
        setTimeout(2);
        web_socket();
    };
*/
}

web_socket();

window.addEventListener("beforeunload", (event) => {
    document.getElementById('loader').classList.remove("hidden");
});

document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('loader').classList.remove("hidden");
});

let loginForm = document.getElementById("sendtext");
loginForm.addEventListener("click", (event) => {
    event.preventDefault();
    sendText();
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
        break;
    }
};

</script>


