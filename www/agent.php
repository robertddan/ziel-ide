<?php

namespace Ziel;

class Agent {
    
    public static function agent_init()
    {
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
if(!socket_bind($server, $address, $port) ) {
    socket_close($server);
    self::agent_init();
    #return true;
}
socket_listen($server);
$client = socket_accept($server);
print('wait');

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
#$i = 0;
while (true) {
    #$i++;
    #if ($i == 1111) #proc_close($oProcess);
    #{
        #socket_close($client);
        #socket_close($server);
        #break;
        #posix_kill(getmypid(), SIGTERM);
        #exit();
        #exec("kill $(ps aux | grep '[p]hp' | awk '{print $2}') | sh _serve.sh &");
        #exec("kill $(ps aux | grep '[p]hp' | awk '{print $2}')");
        #exit();
        #echo ("Start process:\n");
    #}
    sleep(1);
    #$content = 'Now: '. $i .' '. $request.' '. time();
    $content = json_encode(array('1','2','3','4', date("H:i:s",time()) ));
    $response = chr(129) . chr(strlen($content)) . $content;
    #var_dump(socket_get_status());
    if(!@socket_write($client, $response)) {
        socket_close($client);
        socket_close($server);
        break;
    }
    print ".";
    #socket_write($client, $response)
    #if the server has a client
    #if is a client restart server 
    #else close
}
print('endf');
self::agent_init();
return true;

    }
}

if (php_sapi_name() == 'cli') return Agent::agent_init();

?>
