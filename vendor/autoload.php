<?php

class Autoload {

    public static $sJsonName = "ziel.json";
    public static $aDirectories = array();
    public static $aClasses = array();
    
    public static function autoload_custom()
    {
        #spl_autoload_register(__CLASS__ ."::". __FUNCTION__);
        foreach(self::$aClasses as $sClass) 
        if(!require($sClass)) throw_exception('autoload_custom()');
        #print '<pre>';
        #var_dump(self::$aClasses);
        return true;
    } 

    public static function autoload_directories()
    {
        $sComposer = file_get_contents(ROOT . self::$sJsonName);
        $aComposer = json_decode($sComposer, true);
        
        #for json require
        #$aComposer['autoload']['psr-4']
        #if (!isset())
        /*
        echo '<pre>';
        var_dump([
            self::$aDirectories
        ]);
        */
        
        foreach($aComposer['autoload']['psr-4'] as $sNamespace => $aDirectory)
        {
            if (!is_array($aDirectory)) $aDirectory = (array) $aDirectory;
            
            foreach($aDirectory as $sDirectory) 
            {
                if (!is_dir(ROOT . trim($sDirectory))) continue;
                self::$aDirectories[$sNamespace][] = trim($sDirectory);
            }
        }
        
        
        return true;
    }
    
    public static function autoload_vendors($sVendors = null)
    {
        #$aDirectories = array_push($aDirectories, __DIR__);
        
        $aVendors = array_diff(scandir($sVendors), array('.', '..', 'autoload.php'));
        foreach($aVendors as $sVendor)
        {
            $sClassPath = $sVendors . DS . $sVendor;
            if(is_dir($sClassPath)) {
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
#if (!Autoload::autoload_custom()) throw_exception('autoload_custom()');

?>