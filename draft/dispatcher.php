<?php

use Ziel\System\Event;
use Ziel\System\Route;
use Ziel\System\Model;

use Ziel\Thread\Swap;
use Ziel\Thread\Stream;
use Ziel\Thread\Session;

class Dispatcher {
    
    public static $oEvent;
    public static $oRoute;
    public static $oModel;
    public static $oSwap;
    public static $oStream;
    public static $oSession;
    
    public static function threads()
    {
        self::$oEvent = new Event();
        self::$oRoute = new Route();
        self::$oModel = new Model();
        self::$oSwap = new Swap();
        self::$oStream = new Stream();
        self::$oSession = new Session();
        
        if(!self::dispatch()) throw_exception('dispatch()');
        if(!self::processes()) throw_exception('processes()');
        
        return true;
    }
    
    public static function dispatch()
    {
        if(!self::$oEvent->event_init()) throw_exception('event_init()');
        if(!self::$oRoute->router_init()) throw_exception('router_init()');
        if(!self::$oModel->model_init()) throw_exception('model_init()');
        return true;
    }
    
    public static function processes()
    {
        #if(!self::$oSession->session_init()) throw_exception('session_init()');
        
        var_dump([
            #readfile("php://stdin"),
            'stream_init'
        ]);
        
        #if(!self::$oStream->stream_init()) throw_exception('stream_init()');
        #if(!self::$oSwap->swap_init()) throw_exception('swap_init()');
        #if(!self::$oRoute->router_init()) die('router_init()');
        #if(!self::$oModel->model_init()) die('model_init()');
        
        return true;
    }
    
}

?>