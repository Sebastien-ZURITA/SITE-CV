<?php
class AchatCtls extends Controllers{
/*********************************** GESTION #erp# ***********************************/
    function erp_index(){

        $namePage = isset($this->request->params[0])?$this->request->params[0]:'index';






        $this->render($namePage);
    }
}
