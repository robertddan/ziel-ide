<?php

class Autoload {

    public static $sJsonName = "ziel.json";
    public static $aDirectories = array();
    public static $aClasses = array();
    public static $aComposer = array();
    
    
    public static $i = 0;
    
    public static function autoload_custom()
    {
        
        #return var_dump(self::$aClasses);
        
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
        self::$aComposer = json_decode($sComposer, true);
        
        #for json require
        #$aComposer['autoload']['psr-4']
        #if (!isset())
        /*
        echo '<pre>';
        var_dump([
            self::$aDirectories
        ]);
        */
        
        foreach(self::$aComposer['autoload']['psr-4'] as $sNamespace => $aDirectory)
        {
            if (!is_array($aDirectory)) 
            $aDirectory = (array) $aDirectory;
            foreach($aDirectory as $sDirectory) 
            {
                if (!is_dir(ROOT . trim($sDirectory))) continue;
                self::$aDirectories[] = array('namespace' => $sNamespace, 
                    'directory' => $sDirectory, 
                    'path' => ROOT. trim($sDirectory) .DS);
            }
        }
        return true;
    }
    
    public static function autoload_namespaces($aaVendors = array())
    {
        #$aDirectories = array_push($aDirectories, __DIR__);
        #self::$aDirectories
echo '<pre>';
        #var_dump(self::$aDirectories);
        
        if (empty($aaVendors)) 
        {
            $aaVendors = self::$aDirectories;
            if (empty($aaVendors)) return true;
        } 
        
        #var_dump(['foreach($aaVendors as $aVendor)', $aaVendors]);
        
        foreach($aaVendors as $aVendor)
        {
            #var_dump([scandir($aVendor[1]), $aVendor, $aaVendors]);
            #var_dump($aVendor);
            $aPaths = array_diff(scandir($aVendor['path']), array('.', '..', 'autoload.php'));
            
            #var_dump([$aPaths ,$aVendor]);
            
            foreach ($aPaths as $sPath) {
                
                if(is_dir($aVendor[1] . $sPath)) {
                    #var_dump([
                        #$aVendor[1].$sPath, 
                        #is_dir($aVendor[1] . $sPath),
                        #array($aVendor[0], $aVendor[1] .$sPath)
                    #]);
                    self::$i++;
                    $aaVendor = array(array($aVendor['namespace'], $aVendor['path'] .$sPath. DS));
                    self::autoload_namespaces($aaVendor);
                }
                else {
                    if(!in_array(pathinfo($aVendor['path'] .$sPath)['extension'], array('php'))) continue;
                    #expllode($aVendor[1]);
                    #var_dump(self::$aComposer);
                    $sVendorPath = $aVendor['path'] .$sPath. DS;
                    $sNameSpace = explode('draft',$sVendorPath);
                    
                    #var_dump(self::$aComposer);
                    
                    $aClass = array($aVendor['namespace'], ucfirst(array_shift(explode('.',$sPath))), $aVendor['path'] .$sPath. DS);
                    if(!array_push(self::$aClasses, $aClass)) continue;
                    #var_dump($aVendor[1] .$sPath);
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