<?php
mvc_header();
?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="user-forms">
        <form action="/loginauth" method="post">
            <h2>ULOGUJTE SE</h2>
            <?php if($data!==''){ echo '<p class="msg-error">Pogresan e-mail i/ili lozinka!</p>';}?>
            <label>E-mail</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope-o fa-lg"></i>
                </span>
                <input type="email" name="email" class="form-control" required="">
            </div>
            <label>Lozinka</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lock fa-lg"></i>
                </span>
                <input type="password" name="password" class="form-control" required="">
            </div>
            <hr>
            <input type="submit" value="POTVRDITE" class="btn btn-primary">
        </form>
        </div>
    </div>
</div>

<?php 
mvc_footer();