<?php

namespace Ziel;

class Autoload {

    public static $sJsonName = "ziel.json";
    public static $aClasses = array();
    
    public static function autoload_custom()
    {
        spl_autoload_register(__CLASS__ ."::". __FUNCTION__);
        foreach(self::$aClasses as $sClass) 
        if(!require($sClass)) throw_exception('autoload_custom()');
        return true;
    } 

    public static function autoload_files()
    {
        $sComposer = file_get_contents(ROOT . self::$sJsonName);
        $aComposer = json_decode($sComposer);
        foreach($aComposer->autoload->files as $sFile) self::autoload_vendors(ROOT . trim($sFile));    
        return true;
    }
    
    public static function autoload_vendors($sVendors = null)
    {
        if($sVendors == null) $sVendors = __DIR__;
        $aVendors = array_diff(scandir($sVendors), array('.', '..', 'autoload.php'));
        foreach($aVendors as $sVendor)
        {
            $sClassPath = $sVendors . DS . $sVendor;
            if (is_dir($sClassPath)) {
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

if (!Autoload::autoload_files()) throw_exception('autoload_files()');
if (!Autoload::autoload_vendors()) throw_exception('autoload_vendors()');
if (!Autoload::autoload_custom()) throw_exception('autoload_custom()');

?>