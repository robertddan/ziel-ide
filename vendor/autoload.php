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

    public static function autoload_json()
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
            if (!is_array($aDirectory)) 
            $aDirectory = (array) $aDirectory;
            foreach($aDirectory as $sDirectory) 
            {
                if (!is_dir(ROOT . trim($sDirectory))) continue;
                self::$aDirectories[] = array($sNamespace, ROOT. trim($sDirectory) .DS);
            }
        }
        
        
        return true;
    }
    
    public static function autoload_namespaces($aVendors = array())
    {
        #$aDirectories = array_push($aDirectories, __DIR__);
        #self::$aDirectories
echo '<pre>';
        
        if (empty($aVendors)) $aaVendors = self::$aDirectories;
        if (empty($aaVendors)) return true;
            
        foreach($aaVendors as $aVendor)
        {
            var_dump([$aaVendors ,$aVendor]);
            
            $aClasses = array_diff(scandir($aVendor[1]), array('.', '..', 'autoload.php'));
            

            foreach ($aClasses as $sClass) {
                var_dump($aVendor[1] . $sClass);
                if(is_dir($aVendor[1] . $sClass)) {
                    
                    self::autoload_namespaces(array($aVendor[0], $aVendor[1] .$sClass));
var_dump([
    is_dir($aVendor[1] . $sClass),
    
]);
                }
            }
            
            /*
            $sClassPath = $aVendor[1];
            
            else {
                if(!in_array(pathinfo($sClassPath)['extension'], array('php'))) continue;
                if(!array_push(self::$aClasses, $sClassPath)) continue;
            }
            */
            

            
        }
        
        return true;
    }
}

if (!Autoload::autoload_json()) throw_exception('autoload_json()');
if (!Autoload::autoload_namespaces()) throw_exception('autoload_namespaces()');
#if (!Autoload::autoload_custom()) throw_exception('autoload_custom()');

?>