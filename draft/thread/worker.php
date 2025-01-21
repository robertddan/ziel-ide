<?php

namespace Ziel\Thread;

class Worker {

    public static function event_init()
    {
        
$keys=0;
function play_stop()
{
global $keys;
        $stdin_stat_arr=fstat(STDIN);
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
