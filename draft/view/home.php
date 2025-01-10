<?php

namespace Ziel\View;

class Home {

    public static function home_init()
    {
        global $aPage, $aRouter;
        $aPage = array();
        $aRouter['page'] = 'dashboard';
        $aPage['content'] = $aPage['script'] = $aPage['projekt'] = '';
        $aPage['title'] = '🔆 Home';
        $aPage['projekt'] = '<br/>🩹Projekt: Ziel-IDE';
        $aPage['content'] .= '
            <label for="project">'. $aPage['projekt'] .'</label>
            <div id="sidebar">
            </div>
            <div id="content">
                <h3>🔆 Home</h3>
                <hr></br>
                <label for="w3review">Review of W3Schools:</label>
                <textarea id="w3review" name="w3review" rows="4" cols="50">
                    At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
                </textarea>
                </br>
            </div>
        ';
        
        #print '<pre>';
        #var_dump([
            #'home_init()',
            #$aPage
        #]);
        #print '</pre>';
        
        
        #print '<pre>';
        #var_dump([
        #    'home_init()',
        #    $aPage
        #]);
        #print '</pre>';
        
        return true;
    }

}


?>