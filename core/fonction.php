<?php
function debug($var){

    if(Conf::$debug>0){
        $debug = debug_backtrace();
    echo '<div class ="card card-sm">';
        echo '<a class="btn" data-toggle="collapse" href="#Collapse" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><strong>'.$debug[0]['file'].'</strong> l.'.$debug[0]['line'].'</a>';
        echo '<div class="collapse" id="Collapse">';
            echo '<div class="card-body">';
                echo '<ol>';
                    foreach($debug as $k=>$v){
                        if($k>0){
                            echo '<li><strong>'.$v['file'].'</strong> l.'.$v['line'].'</li>';
                        }
                    }
                
                echo '</ol>';
            echo '</div>';
        echo '</div>';
        echo '<pre>';
        print_r($var);
        echo '<pre>'; 
        echo '</div>';
    echo '</div>';
    } 

}