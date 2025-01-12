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
.container {
    display: flex;
    background-color: DodgerBlue;
    align-items: stretch
    gap: 20px 20px;
    flex-wrap: wrap;
    flex-direction: column;
}

.container > div {
    align-items: stretch
    flex-direction: row;
}

.ide {
    align-items: stretch
    flex-direction: row;
}

.ide > div {
    align-items: stretch
    flex-direction: row;
}

.menu {
    background-color: #f1f1f1;
    width: 100px;
    margin: 10px;
    text-align: center;
    line-height: 75px;
    font-size: 30px;
}

.menu > div {
    background-color: #f1f1f1;
    width: 100px;
    margin: 10px;
    text-align: center;
    line-height: 75px;
    font-size: 30px;
}

.menu > div, .ide > div {
    background-color: #f1f1f1;
    width: 100px;
    margin: 10px;
    text-align: center;
    line-height: 75px;
    font-size: 30px;
}
</style>

<div class="container">
  <div class="menu">
    <div>1</div>
    <div>2</div>
  </div>
  <div class="ide">
    <div>4</div>
    <div>5</div>
  </div>
</div>



    align-items: stretch
EOD;

        return true;
    }

}

?>