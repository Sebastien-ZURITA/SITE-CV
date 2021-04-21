<hr class="separator_3">
<h5 class="text-center">Pages</h5>
<hr class="separator_3">
<div class="d-flex align-items-center justify-content-center">
    <form class=" forms col-6" method="POST" action="<?php echo Router::url('admin/pages/form/') ?>">
        <div class="form-group">
            <div class="form-row">
                <?php echo $pages['pagesId'];?>
            </div>
            <div class="form-row">
                <?php echo $pages['action'];?>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $pages['pagesTitle'];?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo $pages['pagesSlug'];?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <?php echo $pages['pagesOnline']?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>



