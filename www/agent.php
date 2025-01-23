<?php

namespace Ziel;

class Agent {
    
    public static function agent_init()
    {
        self::agent_socket();
        return true;
        
        $iProcess = pcntl_fork();
        #pcntl_waitpid($iProcess, $status);
        var_dump($iProcess);
        if ($iProcess == -1) {
            die('could not fork');
        } else if ($iProcess) {
            var_dump('we are the parent');
            #if (!self::agent_socket()) posix_kill(getmypid(), SIGTERM);
            self::agent_socket();
            Agent::agent_init();
            // we are the parent
        } else {
            var_dump('we are the child');
            #if (!self::agent_socket()) posix_kill(getmypid(), SIGTERM);
            #posix_kill(getmypid(), SIGTERM);
            #Agent::agent_init();
            // we are the child
        }
        self::agent_socket();
        return true;
    }
    
    public static function agent_socket()
    {
        global $oProcess;

$address = '127.0.0.1';
$port = 44321;
// Create WebSocket.
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($server, $address, $port);
socket_listen($server);
$client = socket_accept($server);
var_dump('wait conn');

// Send WebSocket handshake headers.
$request = socket_read($client, 5000);
preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $request, $matches);
$key = base64_encode(pack(
    'H*',
    sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
));
$headers = "HTTP/1.1 101 Switching Protocols\r\n";
$headers .= "Upgrade: websocket\r\n";
$headers .= "Connection: Upgrade\r\n";
$headers .= "Sec-WebSocket-Version: 13\r\n";
$headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
socket_write($client, $headers, strlen($headers));

// Send messages into WebSocket in a loop.
$i = 0;
while (true) {
    $i++;
    if ($i == 11) #proc_close($oProcess);
    {
        socket_close($server);
        break;
        #posix_kill(getmypid(), SIGTERM);
        #exit();
        #exec("kill $(ps aux | grep '[p]hp' | awk '{print $2}') | sh _serve.sh &");
        #exec("kill $(ps aux | grep '[p]hp' | awk '{print $2}')");
        #exit();
        #echo ("Start process:\n");
    }
    sleep(1);
    #var_dump($client);
    #$content = 'Now: '. $i .' '. $request.' '. time();
    $content = json_encode(array('1','2','3','4', date("H:i:s",time()) ));
    $response = chr(129) . chr(strlen($content)) . $content;
    $write = socket_write($client, $response);
    if($write === false) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "$errorcode : $errormsg";
        socket_close($server);
        break;
    }
    else {
        echo "Message Sent : ". chr(129);
    }
    #socket_write($client, $response)
    #if the server has a client
    #if is a client restart server 
    #else close
}
echo "return agent_init())";
self::agent_init();
return true;

    }
}

if (php_sapi_name() == 'cli') return Agent::agent_init();


?>
