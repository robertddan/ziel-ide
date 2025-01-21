<?php

namespace Ziel\Thread;

class Swap {
    
    public function router_init()
    {
        return true;
    }
    
    public function router_get_init()
    {
        global $aUri;
        $aUri = parse_url('/'. $_SERVER["REQUEST_URI"]);
        switch ($aUri["host"]) {
            case 'index':
                $this->router_get();
            break;
            case 'style':
            case 'script':
                $this->router_uri();
            break;
            case 'favicon.ico':
            break;
            default:
                if (empty($_GET)) $this->router_redirect();
            break;
        }
        return true;
    }
    
    public function swap_curl()
    {
        $sJsonData = array();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		
		curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3001/". $sUri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $sJsonData);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
    }
    
    public function router_post()
    {
        global $aRouter;
        $aRouter = array_merge($aRouter, $_POST);
        return true;
    }
    
    public function router_get()
    {
        global $aRouter;
        $aRouter = array_merge($aRouter, $_GET);
        return true;
    }
    
    public function router_uri()
    {
        global $aUri;
        $aUri['path'] = trim($aUri['path'], '/');
        return true;
    }
    
    public function router_redirect()
    {
        global $aRouter;
        if (empty($aRouter['page'])) $aRouter['page'] = 'home';
        if (empty($aRouter['lang'])) $aRouter['lang'] = 'en';
        header('Location: /index?'. http_build_query($aRouter));
        exit();
    }
    
}

?>