<?php
mvc_header();
?>

<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <form action="/loginauth" method="post">
            <h2>ULOGUJTE SE</h2>
            <?php if($data!==''){ echo '<p class="msg-error">Pogresan e-mail i/ili lozinka!</p>';}?>
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required="">
            <label>Lozinka</label>
            <input type="password" name="password" class="form-control" required="">
            <hr>
            <input type="submit" value="POTVRDITE" class="btn btn-primary">
        </form>
    </div>
</div>

<?php 
mvc_footer();