<?php

namespace Ziel\View;

class Home {

    public static function home_init()
    {
        global $aPage, $aRouter;
        $aPage = array();
        $aPage['content'] = $aPage['script'] = $aPage['projekt'] = '';
        $aPage['title'] = '🔆 Home';
        $aPage['projekt'] = '<br/>🩹Projekt: Ziel-IDE';
        $aPage['content'] .= <<<EOD
<style>
* {
    box-sizing: border-box;
    font-family: 'Calibri', sans-serif;
    margin: 0;
    padding: 0;
}

body {
    margin: 0;
    padding: 0;
    max-width: initial;
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -20px;
    margin-top: -20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.hidden {
    display: none;
}

.article {
    display: flex;
    flex-flow: column nowrap;
    height: 100%;
}

.row {  
    display: flex;
    height: inherit;
}

.side {
    flex: 20%;
    background-color: #f1f1f1;
    padding: 20px;
}

.main {
    flex: 80%;
    background-color: white;
    padding: 20px;
    textarea {
        height: 100%;
        resize: none;
    }
}
    
.footer {
    padding: 5px;
    text-align: center;
    background: #ddd;
}

/* menu */

.menu {
    display: flex;
    background-color: #303030;
    color: white;
}

.menu ul
{
    display: flex;
    justify-content: space-evenly;
    align-items: flex-start;
    list-style-type: none;
    padding: 7px 10px;
}

.menu ul li
{

}

.menu ul li a
{
    padding: 7px 10px;
    text-decoration: none;
    text-align: center;
    color: #808080;
}

.menu ul li a:hover
{
    color: white;
}

.menu ul li ul
{
    display: none;
}

.menu ul li:hover ul
{
    display: flex;
    position: absolute;
    flex-direction: column;
    background-color: #303030;
}


</style>

<div class="article">

<div class="menu">

    <ul>
        <li>
            <a href="#">Files</a>
            <ul>
                <li><a id="ide-files-new" href="#new">New</a></li>
                <li><a href="#save">Save</a></li>
                <li><a href="#">Save all</a></li>
                <li><a href="#">Open file</a></li>
                <li><a href="#">Open project</a></li>
                <li><a href="#">Toggle read-only</a></li>
                <li><a href="#">Toggle read-only all</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Edit</a>
        </li>
        <li>
            <a href="#">View</a>
        </li>
        <li>
            <a href="#">Editor</a>
        </li>
        <li>
            <a href="#">Help</a>
        </li>
    </ul>
    
</div>
<div class="row">
    <div class="side">
        <h3>More Text</h3>
        <div id="root"></div>
    </div>
    <div class="main">
        <textarea></textarea>
    </div>
</div>

<div class="footer">
    <span>d</span>
</div>

</div>

EOD;

        return true;
    }

}

?>