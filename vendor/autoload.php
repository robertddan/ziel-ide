<?php

class Autoload {

    public static $sJsonName = "ziel.json";
    public static $aClasses = array();
    
    public static function autoload_custom()
    {
        foreach (self::$aClasses as $sClass) if(!include($sClass)) continue;
        return true;
    }

    public static function autoload_files()
    {
        define("ROOT", __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
        $sComposer = file_get_contents(ROOT . self::$sJsonName);
        $aComposer = json_decode($sComposer);
        foreach($aComposer->autoload->files as $sFile) self::autoload_vendors(ROOT . trim($sFile));    
        return true;
    }
    
    public static function autoload_vendors($sVendors = null)
    {
        if ($sVendors == null) $sVendors = __DIR__;
        $aVendors = array_diff(scandir($sVendors), array('.', '..', 'autoload.php'));
        foreach ($aVendors as $sVendor)
        {
            $sClassPath = $sVendors . DIRECTORY_SEPARATOR . $sVendor;
            if (is_dir($sClassPath))
            {
                self::autoload_vendors($sClassPath);
            }
            else {
                if(!in_array(pathinfo($sClassPath)['extension'], array('php'))) continue;
                if(!array_push(self::$aClasses, $sClassPath)) continue;
            }
        }
        return true;
    }
}

if (!Autoload::autoload_files()) return print('autoload_files()');
if (!Autoload::autoload_vendors()) return print('autoload_vendors()');
if (!Autoload::autoload_custom()) return print('autoload_custom()');

?>