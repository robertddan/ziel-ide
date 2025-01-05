<?php


function session_init()
{
    if (isset($_SESSION['draft'])) return true;
    else session_start();
    return true;
}