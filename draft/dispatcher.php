<?php

#-view
#--session
#-router
#--event
#--user
#--model
#----

function dispatcher_dispatch()
{
	if (!session_init()) error_throw('session_init()');
	if (!router_init()) error_throw('router_init()');
	
	#if (!event_init()) error_throw('event_init()');
	if (!user_init()) error_throw('user_init()');
	
	if (!model_init()) error_throw('model_init()');
	#if (!view_render()) error_throw('view_render()');
	
	return true;
}


?>