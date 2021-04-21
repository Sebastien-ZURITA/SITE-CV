<?php
class Controllers{
    public $request;
    public $vars =array();

    function __construct($params){
        $this->request = $params;
    }
    /**
     * LECTURE D'UNE VUE
     */
    public function render($view){
        if(isset($this->request->prefix)){
            $layout = $this->request->prefix;
        }else{
            $layout='default';
        }
        
        $content_for_layout ='';
        extract($this->vars);
        $view = VIEWS.DS.$this->request->folderCtls.DS.$view.'.php';
        if(!is_file($view)){
            $this->e404('La page demande n\'existe pas.');
            die();
        }
        !isset($navbar)?$navbar='':'';
        ob_start();
        require $view;

        $content_for_layout = ob_get_clean();
        require VIEWS.DS.'layout'.DS.$layout.'.php';

    }

    /**
     * ENVOI DE VALEUR DANS LA VUE
     **/
    public function set($key,$value=null){
        if(is_array($key)){
            $this->vars+=$key;
        }else{
            $this->vars[$key]=$value;
        }

    }

    /**
     * CHARGER UN MODEL
     */
    public function loadModel($name){
        $file = MODELS.DS.$name.'.php';
       
        require_once $file;
        if(!isset($this->name)){
            $this->$name = new $name;
        }
    }

    /**
     * Peremt de gérer les erreurs 404
     */
    function e404 ($message){
        header("HTTP/1.0 404 Not Found");
        $this->request->folderCtls='errors';
        $this->set('message',$message);
        $this->render('e404');
    }

    /**
     * PERMET D'APPELLER UN CONTROLLER DEPUIS MA VUE
     */
    function request($controller,$action){
        $controller.='Ctls';
        die($controller);

    }

    /**
     * REDIRECTION D'UNE URL
     */
    function redirect($url,$code=null){
        
        if($code == 301){
            header("HTTP/1.1 301 Moved Permanently");
        }
               
        header("Location: ".ROUTER::url($url));


    }
    
    /**
     * RETOURNE LES ELEMENTS DU FORMULAIRE
     */
    function forms($data,$action,$model=false){
        $d=array();
      
        $_FORM = new form($action);
        if($model==false){
            $model = strtolower (str_replace('Ctls','',get_class($this)));
        }
        $this->loadModel($model);
        $struc = $this->{$model}->infoStruct();
        foreach($data as $k=>$v){
            foreach($struc as $q=>$w){
                if($k==$q){
                    $label = $w['LABEL'];
                    if($w['KEY']==='PRI'){
                        $form = $_FORM->hidden($q,$v);
                    }else{
                        switch ($w['TYPE']) {

                            case 'text':
                                $form = $_FORM->textarea($q,$label,$v);
                                break;
                            case 'tinyint':
                                $form = $_FORM->checkbox($q,$label,$v);
                                break;
                            case 'varchar' :
                                $form = $_FORM->imput($q,$label,$v);
                                break;
                            
                            default:
                                $form = $_FORM->imput($q,$label,$v);
                        }
                    }
                    $d[$k]= $form;
                }
            }
        }
        $d['action']=$_FORM->hidden('action',$action);
    return $d;
    }


}