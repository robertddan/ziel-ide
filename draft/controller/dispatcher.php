<?php


#call dispatch
#-router // get uri parameter for request
#-setup frontend // update database
#-model init // setup models
#-call view // setup html document
#-call widget.php function to form the content // refere data
#end dispatcher // build


function dispatcher_dispatch()
{
	if (!session_init()) error_throw('session_init()');
	#if (!router_init()) error_throw('router_init()');
	
	#if (!frontend_init()) error_throw('frontend_init()');
	#if (!model_init()) error_throw('model_init()');	
	
	#if (!view_setup()) error_throw('view_render()');
	#if (!widget_init()) error_throw('widget_init()');
	
	return true;
}

function session_init()
{
	if (isset($_SESSION['draft'])) return true;
	else session_start();
	return true;
}

?>