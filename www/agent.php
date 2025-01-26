<?php

namespace Ziel;
#self signed certificate
class Agent {
    
    public static $sock;
    
    public static function agent_init()
    {
        self::agent_native();
        #self::agent_basic();
        return true;
    }
    
    public static function agent_native()
    {

$address = '127.0.0.1';
$port = 44321;
$null = NULL;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($sock, $address, $port);
socket_listen($sock);
$members = [];
$connections = [];
$connections[] = $sock;

echo "Listening for new connections on port $port: " . "\n";

while(true) {

    $reads = $writes = $exceptions = $connections;
    socket_select($reads, $writes, $exceptions, 0);

    if(in_array($sock, $reads)) {
/*
var_dump(array(
    $sock,
    $reads,
    $writes,
    $exceptions,
    $connections
));
*/
        $new_connection = socket_accept($sock);
        $header = socket_read($new_connection, 1024);
        self::handshake($header, $new_connection, $address, $port);
        $connections[] = $new_connection;
        $reply = [
            "type" => "join",
            "sender" => "Server",
            #"text" => "enter name to join... \n"
            "text" => date("Y-m-d H:i:s")
        ];
        $reply = self::pack_data(json_encode($reply));
        socket_write($new_connection, $reply, strlen($reply));
        
        $firstIndex = array_search($sock, $reads);
        unset($reads[$firstIndex]);
    }

    foreach ($reads as $key => $value) {
        $data = socket_read($value, 1024);
        
        if(!empty($data)) {
            $message = self::unmask($data);
            #var_dump(['$message', $message]);
            $decoded_message = json_decode($message, true);
            
            $decoded_message["text"] = date("Y-m-d H:i:s");
            $decoded_message["type"] = 'join';
            
            $message = json_encode($decoded_message);
            if ($decoded_message) {
                if(isset($decoded_message['text'])){
                    if($decoded_message['type'] === 'join') {
                        $members[$key] = [
                            'name' => 'sender', #$decoded_message['sender'],
                            'connection' => $value
                        ];
                    }
                    var_dump($message);
                    $maskedMessage = self::pack_data($message);
                    foreach ($members as $mkey => $mvalue) {
                        socket_write($mvalue['connection'], $maskedMessage, strlen($maskedMessage));
                    }
                }
            }
        }
        else if($data === '')  {
            echo "disconnected " . $key . " \n";
            unset($connections[$key]);
            if(array_key_exists($key, $members)) {
                $message = [
                    "type" => "left",
                    "sender" => "Server",
                    "text" => $members[$key]['name'] . " left the chat \n"
                ];
                $maskedMessage = self::pack_data(json_encode($message));
                unset($members[$key]);
                foreach ($members as $mkey => $mvalue) {
                    socket_write($mvalue['connection'], $maskedMessage, strlen($maskedMessage));
                }
            }
            socket_close($value);
        }
    }
}

socket_close($sock);

        
    }
    
public static function unmask($text) {
    $length = ord($text[1]) & 127;
    if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8); 
	}
    elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14); 
	}
    else {
		$masks = substr($text, 2, 4);
		$data = substr($text, 6); 
	}
    $text = "";
    for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i % 4];    
	}
    return $text;
}

public static function pack_data($text) {
    $b1 = 0x80 | (0x1 & 0x0f);
    $length = strlen($text);

    if($length <= 125) {
		$header = pack('CC', $b1, $length);
	}
        
    elseif($length > 125 && $length < 65536) {
		$header = pack('CCn', $b1, 126, $length);
	}
        
    elseif($length >= 65536) {
		$header = pack('CCNN', $b1, 127, $length);
	}
        
    return $header.$text;
}

public static function handshake($request_header,$sock, $host_name, $port) {
	$headers = array();
	$lines = preg_split("/\r\n/", $request_header);
	foreach($lines as $line)
	{
		$line = chop($line);
		if(preg_match('/\A(\S+): (.*)\z/', $line, $matches)){
			$headers[$matches[1]] = $matches[2];
		}
	}

	$sec_key = $headers['Sec-WebSocket-Key'];
	$sec_accept = base64_encode(pack('H*', sha1($sec_key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	$response_header  = "HTTP/1.1 101 Switching Protocols\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"Sec-WebSocket-Accept:$sec_accept\r\n\r\n";
	socket_write($sock, $response_header,strlen($response_header));
}


    public static function agent_basic()
    {
        global $oProcess, $client, $server;
        
$address = '127.0.0.1';
$port = 44321;
// Create WebSocket.
$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);
if(!socket_bind($server, $address, $port) ) {
    var_dump('-socket_bind-23-');
    socket_close($server);
    socket_close($client);
    sleep(1);
    self::agent_init();
    #return true;
}
socket_listen($server);
$client = socket_accept($server);
print('wait');

// Send WebSocket handshake headers.
$request = socket_read($client, 5000);
var_dump($request);
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

$request = socket_read($client, 5000);

$message = self::unmask($request);
var_dump($message);
#print(implode(',', ['$request', $request, 'socket_recv', socket_recv($client, $buf, 2048, MSG_WAITALL)]));
/*
$buf = 'This is my buffer.';
if (false !== ($bytes = socket_recv($client, $buf, 2048, MSG_WAITALL))) {
    echo "Read $bytes bytes from socket_recv()...";
} else {
    echo "socket_recv() failed; reason: " . socket_strerror(socket_last_error($socket)) . "\n";
}
*/

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
    sleep(5);
    #$content = 'Now: '. $i .' '. $request.' '. time();
    $content = json_encode(array('1','2','3','4', date("H:i:s",time()) ));
    $response = chr(129) . chr(strlen($content)) . $content;
    #var_dump(socket_get_status());
    #var_dump($response);
    
    if(!socket_write($client, $response)) {
        var_dump('-socket_write-71-');
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
