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
body {
	font-family: 'Calibri', sans-serif;
	display: flex;
	flex-direction: column;
	min-height: 100vh;
	margin: 0;
	padding: 0;
}
header {
	flex: 0 0 0;
	background-color: #C14F4F;
}
main {
	flex: 1;
	display: flex;
	background-color: #699EBD;
    height: 86%;
}
footer {
	flex: 0 0 40px;
	background-color: #C14F4F;
	text-align: center;
}
.left,
.right {
	flex: 0 2 25%;
	background-color: #C28282;
    height: 100%;
    overflow: hidden;
}
.middle {
	flex: 1 1 75%;
	padding-left: 50px;
}
.loader {
	border: 16px solid #f3f3f3;
	border-top: 16px solid #3498db;
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
	0% {
		transform: rotate(0deg);
	}

	100% {
		transform: rotate(360deg);
	}

}
.hidden {
	display: none;
}
textarea {
    height: 100%;
	width: 100%;
	resize: none;
	border: none;
}
textarea:focus {
    outline: none;
    border: none;
}
.menu {
	display: flex;
	background-color: #303030;
	color: white;
}
.menu ul {
	display: flex;
	justify-content: space-evenly;
	align-items: flex-start;
	list-style-type: none;
	padding: 0;
	margin: 5px;
}
.menu ul li {}
.menu ul li a {
	padding: 7px 10px;
	text-decoration: none;
	text-align: center;
	color: #808080;
}
.menu ul li a:hover {
	color: white;
}
.menu ul li ul {
	display: none;
}
.menu ul li:hover ul {
	display: flex;
	position: absolute;
	flex-direction: column;
	background-color: #303030;
}
/*
#file-explorer {
    overflow: scroll;
    height: 100%;
    scrollbar-color: red orange;
    scrollbar-width: thin;
}
#file-explorer a {
	padding: 7px 10px;
	text-decoration: none;
	color: #303030;
}
#file-explorer a:hover {
	color: #808080;
}
#file-explorer > ul {
    margin: 0px;
    padding: 0px;
    padding-bottom: 250px;
}
#file-explorer li:nth-child(n) {
    margin: 4px 0px;
    padding: 10px 15px;
    background-color: lightyellow;
}
#file-explorer li {
	list-style-type: none;
	cursor: pointer;
}
#file-explorer li:hover {
    background-color: aliceblue;
}
li.file-explorer-directory {
}
li.file-explorer-file {
	margin: 7px 10px;
}
*/


#file-explorer > div {
    padding-bottom: 220px;
}

#file-explorer {
    overflow: scroll;
    height: 100%;
    scrollbar-color: red orange;
    scrollbar-width: thin;
}

#file-explorer div {
    display: flex;
    flex-direction: column;
}
#file-explorer li {
	list-style-type: none;
	
}

#file-explorer a {
	text-decoration: none;
	color: #303030;
}
#file-explorer a:hover {
}

#file-explorer span {
    background-color: lightyellow;
	cursor: pointer;
}
#file-explorer span:hover {
    background-color: aliceblue;
}

.file-explorer-directory {
    margin: 10px;
    padding: 15px;
}
.file-explorer-file {
    margin: 10px;
    padding: 15px;
}

.file-explorer-directory + div {
    margin-left: 20px;
}

</style>

<header>
<div class="menu">
    <ul>
        <li>
            <a href="#">Files</a>
            <ul>
                <li><a id="ide-files-new" href="#new">New</a></li>
                <li><a href="#save">Save</a></li>
                <li><a href="#">Save all</a></li>
                <li><a href="#">Open file</a></li>
                <li><a href="#">Open project</a></li>
                <li><a href="#">Toggle read-only</a></li>
                <li><a href="#">Toggle read-only all</a></li>
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
<main>
    <div class="left">
        <h3>Draft directory name</h3>
        <div id="root"></div>
        <div id="open">open</div>
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
            dafa
            s
            adfs
            dfsf
        </textarea>
    </div>
</main>
<footer>ziel--ide</footer>
EOD;

$aWidget['html'] .= '<div id="loader-wrapper"><div id="loader" class="loader"></div></div>';
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



let sockets = {
    socket: {},
	host: 'ws://127.0.0.1:44321/www/agent.php',
	oninit: function() {
        this.socket = new WebSocket(this.host);
        this.socket.addEventListener('readystatechange', this.state);
        this.socket.addEventListener('open', this.open);
        this.socket.addEventListener('message', this.message);
        this.socket.addEventListener('close', this.close);
        this.socket.addEventListener('error', this.error);
    },
    close: function(event) {
        console.log("WebSocket close: ", event);
        document.getElementById('loader').classList.remove("hidden");
        //setInterval(1000);
        //sockets.oninit();
    },
    error: function(error) {
        console.log("WebSocket error: ", event);
        document.getElementById('loader').classList.remove("hidden");
        //setInterval(1000);
        //sockets.oninit();
    },
    message: function(event) {
        console.log('WebSocket onmessage: ', event);
        document.getElementById('root').innerHTML = "Message from server "+ event.data;
    },
    open: function(event) {
        console.log("WebSocket open: ", event);
        var message = '{"a":1101,"b":22}';
        document.getElementById('loader').classList.add("hidden");
        document.getElementById('open').innerHTML = JSON.stringify(event.data);
        
        setInterval(function() {
            if (event.currentTarget['bufferedAmount'] == 0)
            sockets.socket.send(message);
            console.log(message);
        }, 10000);
/*        
var data = new ArrayBuffer(10000000);
sockets.socket.send(data);
if (event.currentTarget['bufferedAmount'] === 0) {
console.log('the data sent');
}
else {
console.log('the data did not send');
}
*/
    },
    state: function(state) {
        // this.socket.readyState
        console.log("WebSocket state: ", state);
    }
}


window.addEventListener("beforeunload", (event) => {
    document.getElementById('loader').classList.remove("hidden");
});

document.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('loader').classList.remove("hidden");
    sockets.oninit();
    //console.log(sockets.socket.readyState);
});

</script>


