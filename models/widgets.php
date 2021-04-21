<?php
class Widgets extends Models{

    /**
     * LISTE DES WIDGETS RATTACHER A UNE PAGE
     */
    function listWidgetPageId($_pageId){
        $data = $this->get(
            array(
                'conditions'=> array(
                " _pagesId={$_pageId}"
                )
            )
        );
        return $data;
    }

    

    
}