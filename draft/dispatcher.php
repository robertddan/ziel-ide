<?php

#-view
#--session
#-router
#--event
#--user
#--model
#----

#OOP not static
#$GLOBALS variable

/*
The Dispatcher maintains a prioritized queue of work items for a specific thread. 
When a Dispatcher is created on a thread, it becomes the only Dispatcher that can 
be associated with the thread, even if the Dispatcher is shut down.

Dispatchers define the context in which a coroutine runs. They control the 
threading and scheduling of coroutines, allowing you to run tasks on different 
threads based on the type of work being done. This enables efficient handling 
of I/O-intensive, CPU-intensive tasks and tasks that run on the main UI thread.
*/

use Ziel\Controller\Event;
use Ziel\Controller\Model;
use Ziel\Controller\Route;
use Ziel\Controller\Session;
use Ziel\Controller\User;
use Ziel\Controller\View;

class Dispatcher {
    
    public static $oEvent;
    public static $oModel;
    public static $oRoute;
    public static $oSession;
    public static $oUser;
    public static $oView;

    public static function threads()
    {
        self::$oEvent = new Event();
        self::$oModel = new Model();
        self::$oRoute = new Route();
        self::$oSession = new Session();
        self::$oUser = new User();
        self::$oView = new View();
        
        self::dispatch();
        
        return true;
    }
    
    public static function dispatch()
    {
        if (!self::$oSession->session_init()) self::$oEvent->error_throw('session_init()');
        if (!self::$oEvent->event_init()) self::$oEvent->error_throw('event_init()');
        
        if (!self::$oRoute->router_init()) self::$oEvent->error_throw('router_init()');
        #if (!self::$oUser::user_init()) self::$oEvent->error_throw('user_init()');
        
        #if (!self::$oModel::model_init()) self::$oEvent->error_throw('model_init()');
        if (!self::$oView->view_render()) self::$oEvent->error_throw('view_render()');
        
        return true;
    }

}

?>