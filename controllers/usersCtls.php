<?php
class USersCtls extends Controllers{

    /*function index(){
        $this->render('index');
    }*/

    function view(){

        
    }

    /**
     * AFFICHE LA LISTE DES ARTICLES
     */
    function index(){
    $namePage = 'index';

    $this->render($namePage,);
        
    }

    
    /**
     * RENVOI LA BARRE DE NAVIGATION
     */
    function getNavBar(){
        $request = new stdClass();
        $request->fileCtls = CTLS.DS.'pagesCtls.php';
        require_once $request->fileCtls;
        $pagesPost = new PagesCtls($request);
        return $pagesPost->getNavBar();
    }


    /**
     * PERMET DE SE CONNECTER
     */
    function login(){

        $namePage = 'login';
        $this->loadModel('users');

        //CONTROL DATA POST
        if(!empty($this->request->data)){
            $data = $this->request->data;
            if(!empty($data->Login)){

                $cond = array(
                    'conditions'=>  array( "usersLogin = '".$data->Login."'","usersPassword = '".sha1($data->Password)."'"),
                    'limit' => 1
                );
                $users=$this->users->find(
                    $cond
                 );
                 
                 $this->request->data->Password = '';
                 unset($data->Password);

                if (!empty($users)){
                    $this->session->write('user',$users);                   
                   
                    
                    if($this->session->isLogged()){
                        $this->redirect($_SESSION['goTo']);
                    }
                }

            }else{
                unset($this->request->data);
            }
        }

        //PARAMERTES

        $d['navbar'] = $this->getNavBar();

        $this->set($d);

        //APPEL PAGE
        $this->render($namePage,);
    }

    /**
     * PERMET DE SE DECONNECTER
     */
    function logout(){
        unset($_SESSION['user']);
        $this->session->setFlash('Vous êtes maintenant déconnecté.');

        $this->redirect('');
    }

   /**
     * FORMULAIRE 
     */

    function admin_form(){
        $namePage = 'form';
        $this->loadModel('posts');
        if(count($this->request->params)==1){
            if(is_numeric($this->request->params[0])){
                $action = 'update';
                $cond =array(
                    'conditions'    => array(
                        "postsId = {$this->request->params[0]}"
                    )
                );

            }else{
                $action = 'insert';
                $cond = array(
                    'limit'      => '1'
                );
            }
        }else{

            if(!empty($this->request->data)){
                if($this->request->data->action == 'insert'){
                    unset($this->request->data->action);
                    $this->posts->insert($this->request->data);
                }elseif($this->request->data->action == 'update'){
                    unset($this->request->data->action);
                    $this->posts->update($this->request->data);
                }
            }
            $this->redirect('/cokpite/posts');
            return true;
        }
        $d['post']=$this->posts->find(
           $cond
        );  

        $d['post'] = $this->forms($d['post'],$action);

        $this->set($d);
        $this->render($namePage);
    }

}







