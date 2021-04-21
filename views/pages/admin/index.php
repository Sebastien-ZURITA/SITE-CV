<div class="col-4">
    <hr class="separator_3">
    <h3 class="text-center">Editer une page</h3>
    <hr class="separator_3">

</div>
<div>
    <a href="<?php echo Router::url('admin/pages/form/insert');?>">
        <button type="button" class="btn  btn-outline-primary btn-sm col-1">
                <i class="far fa-plus-square"></i>
        </button>
    </a>
</div>


<div class="table-responsive-lg">
    <table class="table table-hover col-4">        
        <thead class="thead-light">
            <tr>
                <th scope="col" class="col-1">ID</th>
                <th scope="col">TITRE</th>
                <th scope="col" class="col-1">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pages as $k=>$v):?>

                    <tr>
                        <th scope="row" class = " <?php echo $v['pagesOnline']=='1'?  'table-success':'table-default'?> align-middle">
                            <?php echo $v['pagesId'];?>
                        </td>
                        <td class="align-middle">
                            <?php echo $v['pagesTitle'];?>
                        </td>
                        <td>
                            <div class=" d-flex align-items-center justify-content-center" style="font-size: 1em">

                                    <a href="<?php echo Router::url('admin/pages/form/'.$v['pagesId'])?>" class="pr-2">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <a onclick="return confirm('Voulez-vous vraiment supprimer ce contenu !')"  href="<?php echo Router::url('admin/pages/delete/'.$v['pagesId'])?>" class="pr-2">
                                        <i class="far fa-trash-alt"></i>
                                    </a>

                            </div>
                        </td>
                    </tr>
            <?php endforeach?>

        </tbody>
    </table>
    <nav aria-label="Page navigation ">
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
</div>


