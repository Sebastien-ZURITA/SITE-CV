<hr class="separator_3">
<h5 class="text-center">Article</h5>
<hr class="separator_3">
<div class="d-flex align-items-center justify-content-center">
    <form class=" forms col-6" method="POST" action="<?php echo Router::url('admin/posts/form/') ?>">
        <div class="form-group">
            <div class="form-row">
                <?php echo $post['postsId'];?>
            </div>
            <div class="form-row">
                <?php echo $post['action'];?>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo $post['postsTitle'];?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo $post['postsSlug'];?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $post['postsContent'];?>
        </div>
        <div class="form-group">
            <?php echo $post['postsComment'];?>
        </div>

        <div class="form-group">
            <div class="form-check">
                <?php echo $post['postsOnline']?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>



