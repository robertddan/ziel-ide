<?php

namespace Ziel\Thread;

class Worker {

    public static function event_init()
    {


$master = array();
$socket = stream_socket_server("tcp://0.0.0.0:9001", $errno, $errstr);
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
} else {
    $master[] = $socket;
    $read = $master;
    while (1) {
        $read = $master;
        $mod_fd = stream_select($read, $_w = NULL, $_e = NULL, 5);
        if ($mod_fd === FALSE) {
            break;
        }
        for ($i = 0; $i < $mod_fd; ++$i) {
            if ($read[$i] === $socket) {
                $conn = stream_socket_accept($socket);
                fwrite($conn, "Hello! The time is ".date("n/j/Y g:i a")."\n");
                $master[] = $conn;
            } else {
                $sock_data = fread($read[$i], 1024);
                var_dump($sock_data);
                if (strlen($sock_data) === 0) { // connection closed
                    $key_to_del = array_search($read[$i], $master, TRUE);
                    fclose($read[$i]);
                    unset($master[$key_to_del]);
                } else if ($sock_data === FALSE) {
                    echo "Something bad happened";
                    $key_to_del = array_search($read[$i], $master, TRUE);
                    unset($master[$key_to_del]);
                } else {
                    echo "The client has sent :"; var_dump($sock_data);
                    fwrite($read[$i], "You have sent :[".$sock_data."]\n");
                    fclose($read[$i]);
                     unset($master[array_search($read[$i], $master)]);
                }
            }
        }
    }
}

return true;

$keys=0;
function play_stop()
{
global $keys;
        $stdin_stat_arr=fstat(STDIN);
        var_dump(['stdin', $stdin_stat_arr[size]]);
        if($stdin_stat_arr[size]!=0)
        {
            $val_in=fread(STDIN,4096);
            switch($val_in)
            {
            case "start\n":
                echo "Started\n";
                return false;
            break;
            case "stop\n":
                echo "Stopped\n";
                $keys=0;
                return false;
            break;
            case "pause\n":
                echo "Paused\n";
                return false;
            break;
            case "get\n":
                echo ($keys."\n");
                return true;
            break;
            default:
                echo("Передан не верный параметр: ".$val_in."\n"); 
                return true;
                exit();
            }
        }else{return true;}
}
        while(true)
        {
            while(play_stop()){usleep(1000);}
            while(play_stop()){$keys++;usleep(10);}
        }

    }
    
}

if (php_sapi_name() == 'cli') return Worker::event_init();

var_dump([
    #php_sapi_name(),
    #__FILE__
]);

?>
