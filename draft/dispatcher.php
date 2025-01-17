<?php

use Ziel\System\Event;
use Ziel\System\Route;
use Ziel\System\Model;

#use Ziel\Thread\Route;
#use Ziel\Thread\Model;

class Dispatcher {
    
    public static $oEvent;
    public static $oRoute;
    public static $oModel;
    
    public static function threads()
    {
        self::$oEvent = new Event();
        self::$oRoute = new Route();
        self::$oModel = new Model();
        self::dispatch();
        return true;
    }
    
    public static function dispatch()
    {
        if (!self::$oEvent->event_init()) throw_exception('event_init()');
        if (!self::$oRoute->router_init()) throw_exception('router_init()');
        if (!self::$oModel->model_init()) throw_exception('model_init()');
        return true;
    }
    
    public static function processes()
    {
        #if (!self::$oEvent->event_init()) die('event_init()');
        #if (!self::$oRoute->router_init()) die('router_init()');
        #if (!self::$oModel->model_init()) die('model_init()');
        #return true;
    }
    
}

?>