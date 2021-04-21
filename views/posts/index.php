<section class="container-fluid articles">
<div class="container">
    <h2> Liste des articles</h2>
<hr class="separator_2">

<?php
$html ='';
$base_url = BASE_URL;
$fleche = mb_convert_encoding('&#8594;', "UTF-8", "ASCII");
    foreach($posts as $k=>$v){
        $html .= '<h3>'.$v['postsTitle'].'</h3>';
        $html .= '<hr class="separator_3">';
        $html .= '<p>'.$v['postsContent'].'</p>';
        $html .= '<p><a href="';
        $html .= Router::url('posts/view/postsId:'.$v['postsId'].'/postsSlug:'.$v['postsSlug']);
        $html .= '">Lire la suite '.$fleche.'</a></p>';

    }
    echo $html;

?>
</div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php 
            $html ='';
            for ($i=1; $i <= $nbPages; $i++){
                $html .= '<li class="page-item ';
                if($page == $i){
                    $html .= 'active';
                }
                $html .='">';
                $html .='<a class="page-link" href="?page='.$i.'">'.$i;
                $html .='</a></li>';
            }
            echo $html;?>
        </ul>
    </nav>
</section>
