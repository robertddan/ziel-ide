<?php

global $aPage;
$aPage = array();
$aPage['content'] = $aPage['script'] = $aPage['projekt'] = '';
$aPage['title'] = '🔆 Dashboard';
$aPage['projekt'] = <<<END
    <br/>🩹Projekt: Terminplaner
END;

$aPage['content'] .= '
	<div id="sidebar">
	</div>
	<div id="content">
		<h3>🔆 Dashboard</h3>
		<hr></br>
		'. $aPage['projekt'] .'
	</div>
';

function dashboard_init()
{
	global $aRouter;
	return true;
}


?>