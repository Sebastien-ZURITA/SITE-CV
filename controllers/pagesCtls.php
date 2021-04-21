<?php
class PagesCtls extends Controllers{
    
    function index(){

        $namePage = isset($this->request->params[0])?$this->request->params[0]:'homepage';
        $this->loadModel('pages');
        $pages=$this->pages->find(
            array(
                'list'=>array(
                    "pagesId"
                ),
                'conditions'=> array(
                    "pagesSlug ='{$namePage}'",
                    "pagesOnline = 1",
                    "pagesDom = 'WEB'"
                )
            )
        );
        if($namePage=='homepage'){
            $this->loadModel('widgets');
            $listWidget=$this->widgets->listWidgetPageId($pages['pagesId']);
            $nbWidget = count($listWidget);
            $content =array(
                'navbar'        =>  $this->getNavBar($listWidget)
            );
            For ($i=0;$i<$nbWidget;$i++){

                $content += array(
                    $listWidget[$i]['widgetsSlug'] => str_replace('{BASE_URL}',BASE_URL,$listWidget[$i]['widgetsContent'])
                );

            };
            $this->set($content);
        }
        $this->render($namePage,);
        
    }
    
    /**
     * RENVOI LA BARRE DE NAVIGATION
     */
    function getNavBar(){

        $this->loadModel('pages');
        $menu=$this->pages->get(
            array(

                'conditions'=> array(
                    "pagesOnline = 1"
                )
            )
        );
        $nbMenu = count($menu);

        $html = '
        <nav class="navbar navbar-expand-lg navbar-light menu">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="'.BASE_URL.'" >Accueil</a>
                        </li>
        ';
        //LISTE DES ENTETES DE MENU
        for ($i=1; $i < $nbMenu; $i++) {
            $html .= '<li class="nav-item">';
            $html .= '<a href="'.BASE_URL.'/#'.$menu[$i]['pagesSlug'].'" >'.$menu[$i]['pagesTitle'].'</a>';
            $html .= '</li>';
        }
        
        /*$html .= '
            <li class="nav-item">
                <a href="'.BASE_URL.'/posts?page=1" >Actualité</a>
            </li>
        ';
*/
        /*$html .= '
        <li class="nav-item">
            <a href="'.BASE_URL.'/cokpite/posts" >Cokpite</a>
        </li>
    ';*/

        $html .= '
                       <li class="nav-item">
                            <a href="'.BASE_URL.'/#contact" >Contact</a>
                        </li>';
        $html .= '
                        <li class="nav-item">
                             <a href="'.BASE_URL.'/users/login" >Connexion</a>
                         </li>';


        $html .= '
                      </ul>
                    </div>
                </nav>
        ';

        return $html;
    }

/*********************************** ADMINISTRATION #admin# ***********************************/
    function admin_index(){

        $namePage = isset($this->request->params[0])?$this->request->params[0]:'dashbord';


        if ($namePage =='index'){
            $perPage=5;
            $condition = array(
                    
                );

            $this->loadModel('pages');
            
            //NB DE POST
            $nbPages = $this->pages->findCount(
                $condition
            );
            $d['total'] = $nbPages;
            $d['page'] = !isset($this->request->page)?1:$this->request->page;

            //RECUPERATION DES POSTS
            $d['pages']=$this->pages->get(
                    array(
                        'list' => 'pagesId,pagesTitle,pagesOnline',
                        'conditions'=> $condition,
                        'limit' => (($d['page']-1)*$perPage).','.$perPage
                    ) 
                );
            $d['navbar'] = '';

            $d['nbPages'] = ceil($nbPages/$perPage);

            $this->set($d);
        }

        $this->render($namePage);
    }
/**
 * FORMULAIRE
 */
    function admin_form(){
        $namePage = 'form';
        $this->loadModel('pages');
        if(count($this->request->params)==1){
            if(is_numeric($this->request->params[0])){
                $action = 'update';
                $cond =array(
                    'conditions'    => array(
                        "pagesId = {$this->request->params[0]}",
                        "pagesDom = 'WEB'"
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
                    $this->pages->insert($this->request->data);
                }elseif($this->request->data->action == 'update'){
                    unset($this->request->data->action);
                    $this->pages->update($this->request->data);
                }
            }
            $this->redirect('/cokpite/pages/index/index');
            return true;
        }
        $d['pages']=$this->pages->find(
           $cond
        );

        $d['pages'] = $this->forms($d['pages'],$action);
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
        $this->loadModel('pages');
        $this->pages->delete($id);
        $this->session->setFlash('Le contenu a bien été supprimé.');
        $this->redirect('admin/pages/index/index');
    }

/*********************************** GESTION #erp# ***********************************/
    function erp_index(){

        $namePage = isset($this->request->params[0])?$this->request->params[0]:'erp';

        $this->render($namePage);
    }
}
