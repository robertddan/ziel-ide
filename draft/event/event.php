<?php

class Event {
    public static function error_throw($sMsg = 'Error: (empty message)')
    {
        return die('Error: '. $sMsg);
    }
    
    public static function user_init()
    {
        return true;
    }    
}
