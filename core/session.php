<?php
class Session{

    function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
    }
    /**
     * INITIALISATION DE FLASH
     */
    function setFlash($msg,$type='success'){
        $_SESSION['flash']=array(
            'message' => $msg,
            'type' => $type
        );
    }

    /**
     * EMTTEUR FLASH FLASH
     */
    function flash(){
        if(isset($_SESSION['flash']['message'])){
            $html = '<div class ="alert alert-'.$_SESSION['flash']['type'].'" role="alert"><p>'.$_SESSION['flash']['message'].'</p></div>';
            $_SESSION['flash'] =array();
 
            return $html;
        }

    }
    
    /**
     * CREATION D'UNE VALLEUR
     */
    public function write($key,$value){
        $_SESSION[$key]=$value;
    }

    /**
     * LECTURE D'UNE VALEUR
     */
    public function read($key = null){
        if($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
        }else{
            return $_SESSION;
        }
    }

    /**
     * VERIFICATION LOGGED
     */
    public function isLogged(){
        return isset($_SESSION['user']['usersId']);

    }
}