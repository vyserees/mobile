<?php
mvc_header();
?>

<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="user-forms">
        <form action="/processreg" method="post">
            <h2>REGISTRUJTE SE</h2>
            <?php if($data!==''){ echo '<p class="msg-error">Korisnik vec postoji!<br>Pokusajte sa drugom e-mail adresom ili iskoristite mogucnost reseta lozinke ako ste je zaboravili.</p>';}?>
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
                <input type="password" id="password" class="form-control" required="">
            </div>
            <label>Ponovite lozinku</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-lock fa-lg"></i>
                </span>
                <input type="password" name="password" class="form-control" required="">
            </div>
            <label>Ime i prezime</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user fa-lg"></i>
                </span>
                <input type="text" name="ime" class="form-control" required="">
            </div>
            <label>Adresa</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-home fa-lg"></i>
                </span> 
                <input type="text" name="adresa" class="form-control" required="">
            </div>
            <label>Grad</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-university fa-lg"></i>
                </span> 
                <input type="text" name="grad" class="form-control" required="">
            </div>
            <label>Postanski broj</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope fa-lg"></i>
                </span>
                <input type="text" name="posta" class="form-control" required="">
            </div>
            <label>Telefon</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone fa-lg"></i>
                </span>
                <input type="text" name="telefon" class="form-control" required="">
            </div>
            <hr>
            <input type="submit" value="POTVRDITE" class="btn btn-primary">
        </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('[name="password"]').focusout(function(){
        var p1 = $(this);
        var p2 = $('#password');
        if(p2.val()!==p1.val()){
            p1.val('');
            p2.val('');
            alert('Lozinke se ne poklapaju! Pokusajte ponovo.');
            p2.focus();
        }
    });
    $('#password').focusout(function(){
        var p1 = $(this);
        var p2 = $('[name="password"]');
        if(p2.val()!==p1.val()&&p2.val()!==''){
            p1.val('');
            p2.val('');
            alert('Lozinke se ne poklapaju! Pokusajte ponovo.');
            p1.focus();
        }
    });
});
</script>
<?php 
mvc_footer();