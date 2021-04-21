<?php
    class Dispatcher{
        /**
         * RECUPERE L'URL POUR SAVOIR CE QUI DOIT ETRE FAIT
         */
        var $request;

        function __construct(){
            $this->request = new Request();
            Router::parse( $this->request->url,$this->request);
         
            $controller = $this->loadController();
            if($controller ===false){
                return false;
            }else{

                /** CONTROL DE DROIT D'ACCEES **/
                if(!( $controller->session->isLogged())and isset($this->request->prefix)){
                    $controller->session->write('goTo',$this->request->url);
                    $controller ->redirect('users/login');
                }

                if(in_array($this->request->actions,array_diff(get_class_methods($controller),get_class_methods(get_parent_class($controller))))){
                    call_user_func_array(array($controller,$this->request->actions),array());
                }else{

                    $this->error('Le controller "'.$this->request->nameCtls.'"  n\'a pas de méthode "'.$this->request->actions.'".');
                }
            }
        }

        /**
         * Permet de générer des une pages d'erreur en cas de problème au niveau du routing (page inexitante)
         */
        function error($message){
            $controller=new Controllers($this->request);
            $controller->e404($message);
            die();
        }

        /**
         * FONCTION PERMETTANT D'INITIALISER UN CONTROLEUR
         */
        function loadController(){    
            
           
            if(file_exists($this->request->fileCtls)){
        
                require $this->request->fileCtls;
                $controller = new $this->request->nameCtls($this->request);
                $controller->session = new Session();
                $controller->session->write('goTo','');

            }else{
                $this->error('Le controller "'.$this->request->nameCtls.'"  n\'existe pas.');
                return false;
            }

            return $controller;

        }

    }
?>