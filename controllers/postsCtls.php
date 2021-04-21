<?php
class PostsCtls extends Controllers{

    /*function index(){
        $this->render('index');
    }*/

    function view(){

        $namePage = 'view';
        $id = $this->request->params[0];
        $slug = $this->request->params[1];
        $this->loadModel('posts');
        $d['post']=$this->posts->find(
           array(
                'list'=>'postsId,postsSlug,postsContent,postsTitle',
                'conditions'=> array(
                    "postsId={$id}",
                    "postsOnline = 1"
                )
            )
        );
        $d +=array(
            'navbar' => $this->getNavBar()
        );
        if(empty($d['post'])){
            $this->e404('La page demandé n\'est pas présente');
        }
        if($slug!= $d['post']['postsSlug']){
            //$this->redirect("posts/view/postsId:$id/postsSlug:{$d['post']['postsSlug']}",301);
            $this->e404('La pages demandé n\'est pas disponible');
        }

        $this->set($d);
        $this->render($namePage);
        
    }

    /**
     * AFFICHE LA LISTE DES ARTICLES
     */
    function index(){
        $namePage = 'index';
        $perPage=3;
        $condition = array(
                "postsOnline = 1"
            );

        $this->loadModel('posts');
        
        //NB DE POST
        $nbPosts = $this->posts->findCount(
            $condition
        );
        $d['page'] = $this->request->page;

        //RECUPERATION DES POSTS
        $d['posts']=$this->posts->get(
                array(
                    'conditions'=> $condition,
                    'limit' => (($d['page']-1)*$perPage).','.$perPage
                ) 
            );
        $d['navbar'] = $this->getNavBar();

        $d['nbPages'] = ceil($nbPosts/$perPage);

        $this->set($d);
        $this->render($namePage);
        
    }

    
        /**
     * RENVOI LA BARRE DE NAVIGATION
     */
    function getNavBar(){
        $request = new stdClass();
        $request->fileCtls = CTLS.DS.'pagesctls.php';
        require_once $request->fileCtls;
        $pagesPost = new PagesCtls($request);
        return $pagesPost->getNavBar();
    }
/********************************************** ADMINISTRATION ************************************************/
    function admin_index(){
        $namePage = 'index';
        $perPage=5;
        $condition = array(
                
            );

        $this->loadModel('posts');
        
        //NB DE POST
        $nbPosts = $this->posts->findCount(
            $condition
        );
        $d['total'] = $nbPosts;
        $d['page'] = !isset($this->request->page)?1:$this->request->page;

        //RECUPERATION DES POSTS
        $d['posts']=$this->posts->get(
                array(
                    'list' => 'postsId,postsTitle,postsOnline',
                    'conditions'=> $condition,
                    'limit' => (($d['page']-1)*$perPage).','.$perPage
                ) 
            );
        $d['navbar'] = '';

        $d['nbPages'] = ceil($nbPosts/$perPage);

        $this->set($d);
        $this->render($namePage);
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
    /**
     * Permet de supprimer un article
     */

    function admin_delete(){
        if(count($this->request->params)<>1){
            $this->redirect('admin/posts');
            return false;
        }else{
            $id = $this->request->params[0];
        }
        $this->loadModel('posts');
        $this->posts->delete($id);
        $this->session->setFlash('Le contenu a bien été supprimé.');
        $this->redirect('admin/posts');
    }

}




