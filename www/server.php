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
    case 'fonts':
        header('Content-Type: font/ttf; charset=utf-8');
        print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
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
#$aWidget['html'] .= '<script type="text/javascript" src="/script/home.js"></script>';
$aWidget['html'] .= '<style>.loader { border: 16px solid #f3f3f3; /* Light grey */ border-top: 16px solid #3498db; /* Blue */ border-radius: 50%; width: 60px; height: 60px; animation: spin 2s linear infinite; position: absolute; top: 50%; left: 50%; margin-left: -20px; margin-top: -20px; } @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } } .hidden { display: none; }</style>';
$aWidget['html'] .= '</head>';
$aWidget['html'] .= '<!--- /head -->';
$aWidget['html'] .= '<!--- body -->';
$aWidget['html'] .= '<body>';
$aWidget['html'] .= <<<EOD
<style>
body { font-family: 'Calibri', sans-serif; display: flex; flex-direction: column; min-height: 100vh; margin: 0; padding: 0; } header { flex: 0 0 0; background-color: #C14F4F; } main { flex: 1; display: flex; background-color: #699EBD; height: 86%; } footer { flex: 0 0 40px; background-color: #C14F4F; text-align: center; } .left, .right { flex: 0 2 25%; background-color: #C28282; height: 100%; overflow: hidden; } .middle { flex: 1 1 75%; padding-left: 50px; } .loader { border: 16px solid #f3f3f3; border-top: 16px solid #3498db; border-radius: 50%; width: 60px; height: 60px; animation: spin 2s linear infinite; position: absolute; top: 50%; left: 50%; margin-left: -20px; margin-top: -20px; } @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } } .hidden { display: none; } @font-face { font-family: "Fira Code"; src: url("/fonts/FiraCode-Regular.ttf"); } textarea { font-family: "Fira Code"; font-size: 16px; height: 100%; width: 100%; resize: none; border: none; } textarea:focus { outline: none; border: none; }
.menu { display: flex; background-color: #303030; color: white; } .menu ul { display: flex; justify-content: space-evenly; align-items: flex-start; list-style-type: none; padding: 7px; margin: 5px; } .menu ul li { } .menu ul li a { padding: 7px 14px; text-decoration: none; text-align: center; color: #808080; } .menu ul li a:hover { color: white; } .menu ul li ul { display: none; } .menu ul li:hover ul { display: flex; position: absolute; flex-direction: column; background-color: #303030; padding-top: 7px; } .menu ul li:hover ul li{ padding: 7px 14px; }
#file-explorer > div { padding-bottom: 220px; } #file-explorer { overflow: scroll; height: 100%; scrollbar-width: thin; background-color: lightyellow; } #file-explorer div { display: flex; flex-direction: column; } #file-explorer li { list-style-type: none; } #file-explorer a { text-decoration: none; color: #303030; } #file-explorer a:hover { } #file-explorer span { background-color: lightyellow; cursor: pointer; border-top: 1px solid gray; } #file-explorer span:hover { background-color: aliceblue; } .file-explorer-directory { padding: 7px; } .file-explorer-directory:hover { } .file-explorer-file { padding: 7px; } .file-explorer-directory + div { margin-left: 14px; border-left: 1px solid gray; } .file-explorer-directory:hover { } .file-explorer div span:nth-last-child(){ border-bottom: 1px solid gray; }
nav { height: 40px; background-color: darkslategrey; }

</style>

<header>
<div class="menu">
    <ul>
        <li>
            <a href="#">Files</a>
            <ul>
                <li><a data-menu-files="new" href="#new">New</a></li>
                <li><a data-menu-files="save" href="#save">Save</a></li>
                <li><a data-menu-files="saveAll" href="#">Save all</a></li>
                <li><a data-menu-files="openFile" href="#">Open file</a></li>
                <li><a data-menu-files="openProject" href="#">Open project</a></li>
                <li><a data-menu-files="readOnly" href="#">Toggle read-only</a></li>
                <li><a data-menu-files="readOnlyAll" href="#">Toggle read-only all</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Edit</a>
        </li>
        <li>
            <a href="#">View</a>
        </li>
        <li>
            <a href="#">Editor</a>
        </li>
        <li>
            <a href="#">Help</a>
        </li>
    </ul>
</div>
</header>
<nav></nav>
<main>
    <div class="left">
        <div id="file-explorer" class="">
            <div>   
                <span class="file-explorer-directory">
                    <a href="#">Directory</a>
                </span>
                <div>
                    <span class="file-explorer-directory">
                        <a href="#">Directory</a>
                    </span>
                    <div>
                        <span class="file-explorer-directory">
                            <a href="#">Directory</a>
                        </span>
                        <div>
                            <span class="file-explorer-directory">
                                <a href="#">Directory</a>
                            </span>
                            <span class="file-explorer-file">
                                <a href="#">File file.php</a>
                            </span>
                        </div>
                    </div>
                    <span class="file-explorer-file">
                        <a href="#">File file.php</a>
                    </span>
                    <span class="file-explorer-file">
                        <a href="#">File file.php</a>
                    </span>
                </div>
                
                <span class="file-explorer-file">
                    <a href="#">File file.php</a>
                </span>
                <span class="file-explorer-file">
                    <a href="#">File file.php</a>
                </span>
                <span class="file-explorer-file">
                    <a href="#">File file.php</a>
                </span>
                
            </div>
        </div>
    </div>
    
    <div class="middle">
        <textarea>
        </textarea>
    </div>
</main>
<footer>
ziel--ide © [YEAR OF PUBLICATION] [WEBSITE NAME]. All rights reserved.
<br/>
<div id="root"></div>
</footer>
EOD;

$aWidget['html'] .= '<div id="loader-wrapper"><div id="loader" class="loader"></div></div>';
$aWidget['html'] .= '<button id="file-handle">button</button>';
#$aWidget['html'] .= '<div id="sse"><a href="javascript:WebSocketSend()">send WebSocket</a></div>';
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
/*
let socket = new WebSocket("ws://127.0.0.1:44321/www/agent.php");

var socketOpen = (e) => {
    console.log("connected to the socket");
    var joinMsg = {
        type: "join",
        sender: 'sender',
        text: 'joined the chat!'
    };
    socket.send(JSON.stringify(joinMsg));
}

var socketMessage = (e) => {
    console.log(`Message from socket server: ${e.data}`);
}

socket.addEventListener("open", socketOpen);
socket.addEventListener("message", socketMessage);
*/


let menu = {
    onInit: function() {
        let links = document.querySelectorAll('.menu a[data-menu-files]');
        links.forEach((link) => {
            var action = link.getAttribute('data-menu-files');
            //var action = link.getAttribute('data-menu-files');
            //console.log(link.getAttribute('data-menu-files'));
            link.addEventListener('click', (event) => {
                var message = '{"menu":"'+ action +'", "file":""}';
                socket.call(message);
            });
        });
    },
    filesNew: function() {
    },
    filesSave: function() {
    },
    filesSaveAll: function() {
    },
    filesOpen: function() {
    },
    filesOpenProject: function() {
    },
    filesReadOnly: function() {
    },
    filesReadOnlyAll: function() {
    }
}


let nav = {
    oninit: function() {
    }
}

let main = {
    oninit: function() {
    }
}

let aside = {
    oninit: function() {
        links.forEach((link) => {
            var action = link.getAttribute('data-menu-files');
            //var action = link.getAttribute('data-menu-files');
            //console.log(link.getAttribute('data-menu-files'));
            link.addEventListener('click', (event) => {
                var message = '{"menu":"'+ action +'", "file":""}';
                view.call(message);
            });
        });
    }
}

let footer = {
    oninit: function() {}
}

let socket = {
    peer: {},
	host: 'ws://127.0.0.1:44321/www/agent.php',
	onInit: function() {
        this.peer = new WebSocket(this.host);
        this.peer.addEventListener('readystatechange', this.onState);
        this.peer.addEventListener('open', this.onOpen);
        this.peer.addEventListener('message', this.onMessage);
        this.peer.addEventListener('close', this.onClose);
        this.peer.addEventListener('error', this.onError);
    },
    call: function(event) {
        console.log("WebSocket send: ", event);
        socket.peer.send(event);
    },
    onClose: function(event) {
        console.log("WebSocket close: ", event);
        document.getElementById('loader').classList.remove("hidden");
        //setInterval(1000);
        //socket.onInit();
    },
    onError: function(error) {
        console.log("WebSocket error: ", event);
        document.getElementById('loader').classList.remove("hidden");
        //setInterval(1000);
        //socket.onInit();
    },
    onMessage: function(event) {
        console.log('WebSocket onmessage: ', event);
        document.getElementById('root').innerHTML = "Message from server "+ event.data;
    },
    onOpen: function(event) {
        console.log("WebSocket open: ", event);
        document.getElementById('loader').classList.add("hidden");
/*
        var message = '{"a":1101,"b":22}';
        document.getElementById('open').innerHTML = JSON.stringify(event.data);
        
        setInterval(function() {
            if (event.currentTarget['bufferedAmount'] == 0)
            socket.peer.send(message);
            console.log(message);
        }, 10000);
        //var data = new ArrayBuffer(10000000);
*/
    },
    onState: function(state) {
        // this.socket.readyState
        console.log("WebSocket state: ", state);
    }
}

let layer = {
    onInit: function(state) {
        window.addEventListener("beforeunload", this.beforeunload);
        document.addEventListener("DOMContentLoaded", this.contentloaded);
    },
    beforeunload: function(event) {
        document.getElementById('loader').classList.remove("hidden");
    },
    contentloaded: function(event) {
        socket.onInit();
        document.getElementById('loader').classList.remove("hidden");
    }
}

menu.onInit()
layer.onInit();


let fileHandle;
let butOpenFile = document.getElementById('file-handle');
butOpenFile.addEventListener('click', async () => {
  // Destructure the one-element array.
  [fileHandle] = await window.showOpenFilePicker();
  // Do something with the file handle.
  console.log([fileHandle]);
});


</script>


