<?php
    class Request{
        /**
         * CONVERTI L'URL EN UN TABLEAU DECOMPOSANT LA REQUETTE DE NAVIGATION
         */
        public $url;
        

        function __construct(){
            $this->data = new stdClass();
            /**
             * GESTION DE L'URL SI PAS DE PATH_INFO
             */
            if (isset($_SERVER['PATH_INFO'])){
                $this->url = $_SERVER['PATH_INFO'];
            }else{
                $this->url = 'pages/index/homepage';
            }

            /**
             * RECUPERATION DE LA VARIABLE PAGE
             */
            if(isset($_GET['page'])){
                if(is_numeric($_GET['page'])and $_GET['page']>0){
                    $this->page =$_GET['page'];
                }else{
                    $this->page = 1 ;
                }               
            }
            unset($_GET);


            /**
             * RECUPERATION DES VARIABLE POST
             */
            if(!empty($_POST)){
                
                foreach($_POST as $k=>$v){
                    $this->data->$k=$v;
                }
                unset($_POST);
            }
           


            
        }

    }
?>