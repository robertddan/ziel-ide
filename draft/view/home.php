<?php

namespace Ziel\View;

#set html content variable
#set data variable for javascript if needed
#

class Home {

    public static function home_init()
    {
        global $aPage;
        $aPage = array();
        $aPage['content'] = $aPage['projekt'] = '';
        $aPage['title'] = 'Home';
/*
        $aPage['projekt'] = <<<END
END;
*/
        $aPage['content'] .= '
            <div id="sidebar">
            </div>
            <div id="content">
                <h3>🔆 Home</h3>
                <hr></br>
                '. $aPage['projekt'] .'
            </div>
            <label for="w3review">Review of W3Schools:</label>
            
            <textarea id="w3review" name="w3review" rows="4" cols="50">
                At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
            </textarea>
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