<?php

#-view
#--session
#-router
#--event
#--user
#--model
#----
class Dispatcher {
    function _dispatch()
    {
        if (!Session::session_init()) Event::error_throw('session_init()');
        if (!Route::router_init()) Event::error_throw('router_init()');
        
        #if (!event_init()) error_throw('event_init()');
        if (!User::user_init()) Event::error_throw('user_init()');
        
        if (!Model::model_init()) Event::error_throw('model_init()');
        if (!View::view_render()) Event::error_throw('view_render()');
        
        return true;
    }
    
}

?>