<?php
mvc_header();
?>

<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <form action="/processreg" method="post">
            <h2>REGISTRUJTE SE</h2>
            <?php if($data!==''){ echo '<p class="msg-error">Korisnik vec postoji!<br>Pokusajte sa drugom e-mail adresom ili iskoristite mogucnost reseta lozinke ako ste je zaboravili.</p>';}?>
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required="">
            <label>Lozinka</label>
            <input type="password" name="password" class="form-control" required="">
            <label>Ime i prezime</label>
            <input type="text" name="ime" class="form-control" required="">
            <label>Adresa</label>
            <input type="text" name="adresa" class="form-control" required="">
            <label>Postanski broj</label>
            <input type="text" name="posta" class="form-control" required="">
            <label>Telefon</label>
            <input type="text" name="telefon" class="form-control" required="">
            <hr>
            <input type="submit" value="POTVRDITE" class="btn btn-primary">
        </form>
    </div>
</div>

<?php 
mvc_footer();