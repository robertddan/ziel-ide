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
            <div id="container">
            <table style="width:100%">
                <tr>
                    <th style="width:22%">
                        🔆 Home
                    </th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="2">
                        File  
                        Edit  
                        View  
                        Editor  
                        Help  
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Tab 01----------------------------x--
                        Tab 02----------------------------x--
                        Tab 03----------------------------x--
                        Tab 04----------------------------x--
                        Tab 05----------------------------x--
                    </th>
                </tr>
                <tr style="height:100%">
                    <th>null</th>
                    <th>
                    <label for="canvas"></label>
                    <textarea id="canvas" name="canvas">

Lorem ipsum dolor sit amet, consectetur adipiscing elit.
Proin accumsan tortor non fringilla tempor.
Etiam vel ex consectetur, fermentum est et, ornare elit.

Donec cursus augue quis purus rutrum mattis.
Sed quis tellus facilisis sem euismod venenatis ac eu lacus.
Donec semper sem nec metus elementum, id rutrum purus ornare.

Aenean nec justo a orci consectetur commodo eget at urna.
Praesent egestas eros ac vehicula semper.
Nullam at ligula et mi fringilla venenatis eget vel tellus.

Nullam pellentesque turpis non est maximus ultricies.
Proin eget quam id mauris tristique faucibus vel eu dolor.

Suspendisse auctor odio cursus, lobortis arcu at, ornare magna.
Aenean et ipsum non erat placerat ultricies non ut tellus.
Quisque varius leo malesuada posuere euismod.
Nam tempor lacus eu turpis laoreet scelerisque.
Vestibulum malesuada nisi at vehicula cursus.

Morbi vitae elit pellentesque, porttitor enim sed, vehicula neque.
Aliquam fringilla massa id enim feugiat consequat.
In imperdiet nulla id justo pulvinar, ut dignissim enim tempus.
Etiam laoreet magna sed nunc vestibulum maximus.

Pellentesque quis lectus sed nisi interdum molestie.

Nullam dictum urna non lacus accumsan, id feugiat lorem malesuada.
Integer suscipit nibh quis mauris consectetur, sed ultrices quam auctor.
Suspendisse eu enim vel quam molestie viverra et eu mauris.
Duis fermentum enim sed finibus aliquam.

Sed tempor nibh eu massa viverra condimentum.
Mauris sit amet neque quis eros iaculis efficitur.

Nam nec justo non nisl ultrices varius pretium et ex.
Integer eu nisl eget eros luctus vehicula sit amet sodales nunc.
Sed eu leo sit amet libero maximus semper quis in massa.

Suspendisse sit amet odio id eros placerat dapibus.
Mauris sit amet urna a mauris finibus dignissim quis vel ex.

Quisque vitae erat maximus, accumsan ante in, facilisis eros.
Integer placerat lacus id molestie suscipit.
Proin lacinia enim at neque feugiat, id fermentum quam interdum.
Vivamus aliquet dolor sed pellentesque blandit.

Suspendisse eget felis suscipit, convallis elit ut, scelerisque urna.
In accumsan nisi convallis justo sollicitudin, id lobortis nisi tempor.

Sed interdum elit eu velit faucibus auctor in nec diam.
Nam sed neque quis augue pellentesque ullamcorper.
Proin nec tellus at dolor pretium lobortis.
Etiam sollicitudin nisl eu ultricies mollis.

Fusce non ligula porttitor, mollis eros vitae, pellentesque tellus.
Donec pretium augue vel dui sodales convallis.

                    </textarea>
                    </th>
                </tr>
            </table>
            </div>
EOD;

        return true;
    }

}

?>