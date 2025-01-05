<?php

class Autoload {

    public static $aClasses = array();
    
    public static function autoload_custom()
    {
        foreach (self::$aClasses as $sClass) if(!include($sClass)) continue;
        return true;
    }
    
    public static function autoload_files($sVendors = null)
    {
        if ($sVendors == null) $sVendors = __DIR__;
        $aVendors = array_diff(scandir($sVendors), array('.', '..', 'autoload.php'));
        
        foreach ($aVendors as $sVendor)
        {
            $sClassPath = $sVendors . DIRECTORY_SEPARATOR . $sVendor;
            if (is_dir($sClassPath))
            {
                self::autoload_files($sClassPath);
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
if (!Autoload::autoload_custom()) return print('autoload_custom()');
?>