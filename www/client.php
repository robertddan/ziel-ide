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

global $aUri;
$aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);

var_dump('style');

/**/
/*
$data = array("param1" => "value1");
$ch = curl_init('http://site.com/page_that_inserts_something_in_a_db.php');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);
if(!$response) {
    return false;
}
        
        
$sUrl = "$this->sUrlStream/accounts/$this->sAcc/pricing/stream";
$sUrl = sprintf("%s?%s", $sUrl, http_build_query($sParameters));

//if (empty($aCallback)) exit('stream');
$this->aCallback = array(new $aCallback[0], $aCallback[1]);
$this->rStream = fopen(__DIR__ . '/stream.txt', 'w');

$aDefaults = array(
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HEADER => true,
CURLOPT_HTTPHEADER => $this->aHeaders,
CURLOPT_URL => $sUrl,

CURLOPT_FILE => $this->rStream,
CURLOPT_WRITEFUNCTION => array($this, 'stream_handler'),
CURLOPT_CONNECTTIMEOUT => 20,
#CURLOPT_COOKIESESSION => true,
#CURLOPT_COOKIE => "App\Suiteziel",
#CURLOPT_COOKIELIST => "",
#CURLOPT_VERBOSE => true,
#CURLOPT_STDERR => $this->rVerbose,
CURLOPT_SSL_VERIFYPEER => false,
#CURLOPT_TIMEOUT => 5,
CURLOPT_BUFFERSIZE => 256,
);

$ch = curl_init();
curl_setopt_array($ch, $aDefaults); 
curl_exec($ch);

//var_dump('stream_api');

if (curl_errno($ch) !== 0)
{
sleep(2);
var_dump(curl_errno($ch));
call_user_func_array(array($this->aCallback[0], 'configure'), array(false, true));
}

curl_close($ch);
fclose($this->rStream);
*/
/**/

switch ($aUri['host']) {
    case 'favicon.ico':
        header('Content-Type: text/x-icon');
        print file_get_contents(ROOT .'www'. DS .'favicon.ico');
        exit();
    break;
    case 'style':
$ch = curl_init('http://127.0.0.1:8005/style/water.css');
$data = file_get_contents(ROOT .'www'. DS .'favicon.ico');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);
var_dump($response);

        #header('Content-Type: text/css; charset=utf-8');
        #print file_get_contents(DRAFT .'static'. DS .$aUri['path']);
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
$aWidget['html'] .= '<html class="" lang="'. $aRouter['lang'] .'">';

$aWidget['html'] .= '<!--- head -->';
$aWidget['html'] .= '<head>';
$aWidget['html'] .= '<meta charset="utf-8">';
$aWidget['html'] .= '<title>'. $aPage['title'] .'</title>';

$aWidget['html'] .= '<link rel="stylesheet" type="text/css" href="/style/water.css">';
$aWidget['html'] .= '<script type="text/javascript" src="/script/home.js"></script>';
$aWidget['html'] .= '</head>';
$aWidget['html'] .= '<!--- /head -->';

$aWidget['html'] .= '<!--- body -->';
$aWidget['html'] .= '<body>';
#$aWidget['html'] .= $aWidget['nav'];

#$aWidget['html'] .= '<main>';
#$aWidget['html'] .= $aWidget['events'];
$aWidget['html'] .= $aPage['content'];
#$aWidget['html'] .= '</main>';

$aWidget['html'] .= '</body>';
$aWidget['html'] .= '<!--- /body -->';

$aWidget['html'] .= '<!--- /html -->';
$aWidget['html'] .= '</html>';

print $aWidget['html'];
?>

<script>
function getStyleSheet() {
  for (const sheet of document.styleSheets) {
    console.log(sheet.href);
  }
}
getStyleSheet();
const sheet = document.styleSheets[0];
console.log(sheet);

var host = 'ws://127.0.0.1:44321/websockets.php';
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