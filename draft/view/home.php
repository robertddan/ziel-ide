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
<!--
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Calibri;
  margin: 0;
  padding: 0;
}

/* Style the top navigation bar */
.navbar {
  display: flex;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  color: white;
  padding: 7px 10px;
  text-decoration: none;
  text-align: center;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.row {  
  display: flex;
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  flex: 20%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {
  flex: 80%;
  background-color: white;
  padding: 20px;
  
  textarea {
      height: 100%;
  }
}

fimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

.footer {
  padding: 5px;
  text-align: center;
  background: #ddd;
}



/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row, .navbar {   
    flex-direction: column;
  }
}
</style>


<div class="article">

<div class="navbar">
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
</div>

<div class="row">
  <div class="side">
    <h3>More Text</h3>
    <p>Lorem ipsum dolor sit ame.</p>
    <div class="fimg" style="height:60px;">Image</div><br>
    <div class="fimg" style="height:60px;">Image</div><br>
    <div class="fimg" style="height:60px;">Image</div>
  </div>
  <div class="main">
    <textarea></textarea>
  </div>
</div>

<div class="footer">
  <span>Footer</span>
</div>

</div>
-->

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
                <li><a href="#">New</a></li>
                <li><a href="#">Save</a></li>
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
        <p>Lorem ipsum dolor sit ame.</p>
        
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