<hr class="separator_3">
<h5 class="text-center">ZONE RESERVE</h5>
<hr class="separator_3">
<div class="d-flex align-items-center justify-content-center">
    <form class=" forms col-6" method="POST" action="<?php echo Router::url('users/login') ?>">
        <div class="form-group">
            <div class="form-row">

                <input type="text" class="form-control" name='Login' id='Login' placeholder='Compte'>
            </div>
            <div class="form-row">
                <input type="password" class="form-control" name='Password' id='Password' placeholder='Mot de Passe'>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>