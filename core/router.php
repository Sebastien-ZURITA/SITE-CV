<?php
    class Router{

    static $routes =array();
    static $prefixes =array();
    static $spe  = false;
    

    /**
     * ENREGISTE LES VALEURS DAND LE TABLEAU PREFIXES
     */
    static function prefix($url,$prefix){
        self::$prefixes[$url] = $prefix;
    }

    /**
     * FUCNTION PERMETTANT LA RECUPARATION DU CONTROLLEUR, DE LA VUE ET DES PARAMETRES
     * @param $url URL à parser
     * @return $request Tableau contenant les paramétres
     */

    static function parse($url,$request){

        $suffixCtls = 'Ctls';
        $url = trim($url,'/');
        
        // ROUTTING ADRESSE SPECIFIQUE
        
        foreach(Router::$routes as $v){
            if(preg_match($v['catcher'],$url,$match)){
                $params[0] = $v['controller'];
                $params[1] = $v['action'];
                foreach($v['params'] as $k=>$w){
                    $params[] = $match[$k];
                }
                self::$spe = true;

            }
        }


//hook
        if(self::$spe === false){
            // ROUTTING ADRESSE STANDARD 
            $params = explode('/',$url);
            //TRAITEMENT DES PREFIXES URL (MODULES OU ADMIN)

            if(in_array($params[0],array_keys(self::$prefixes))){
                    $origURL = $params[0];
                    $request->prefix = self::$prefixes[$origURL];
                    $params = array_slice($params,1);                
            }

        }

        if (!isset($params[0])){
            $params[0]='pages';
        }
        if(isset($params[1])){
            $action = $params[1];
        }else{
            $action ='index';
        }    
                        
 
        if(isset($request->prefix)){
            /** ACTION SPE **/
            $action = $request->prefix.'_'.$action;
            /** BASE URL SPE **/
            $baseUrl = BASE_URL.'/'.$origURL;
            /** FOLDER VIEW **/
            $request->folderCtls = $params[0].DS.$request->prefix;
        }else{
            $baseUrl = BASE_URL;
            $request->folderCtls = $params[0];
        }

        define ('BASE_URL_SPE',$baseUrl);

        

        // GENERATION TABLEAU REQUEST       
        $request->nameCtls = ucfirst($params[0].$suffixCtls);
        
        $request->fileCtls = CTLS.DS.$params[0].$suffixCtls.'.php';

        $request->actions =  $action;
        
        if(count($params)>2){
            $request->params = array_slice($params,2);
        }else{
            $request->params = array();
        }
        return true;
       
    }

    /**
     * CONNECT
     */
    static function connect($redir,$url){
        $r =array();
        $r['params']=array();
        $r['redir'] = $redir;
        $r['origin'] = preg_replace('/([A-Z][a-z0-9]+):([^\/]+)/','${1}:(?P<${1}>${2})',$url);
        $r['origin'] = '/'.str_replace('/','\/',$r['origin']).'/';

        $transf1 = explode('/',$url);
        foreach($transf1 as $k=>$v){
            if(strpos($v,':')){
                $transf2 = explode(':',$v);
                $r['params'][$transf2 [0]] =$transf2 [1];
            }else{
                if($k==0){$r['controller'] =$v;}
                if($k==1){$r['action'] =$v;}
            }
        }
        $r['catcher']=$redir;

        foreach($r['params'] as $k=>$v){
            if(preg_match('([A-Z][a-z0-9]+)',$k,$match)){
                $r['catcher'] = str_replace(":$match[0]","(?P<$k>$v)",$r['catcher']);
 
            }
        }
        $r['catcher'] = '/'.str_replace('/','\/',$r['catcher']).'/';

        self::$routes[]=$r;
        
    }

    /** 
     * URL
    */
    static function url($url){
        foreach(self::$routes as $v){
            if(preg_match($v['origin'],$url,$match)){
                foreach($match as $k=>$w){
                    if(!is_numeric($k)){
                        $v['redir'] = str_replace(":$k",$w,$v['redir']);
                    }
                }
                return BASE_URL.'/'.$v['redir'];
            }
        }
        foreach(self::$prefixes as $k=>$v){
            if(strpos($url,$v)===0){
                $url = str_replace($v,$k,$url);

            }
        }
    
        return BASE_URL.'/'.$url;
    }




}