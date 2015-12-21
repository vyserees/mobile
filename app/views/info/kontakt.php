<?php mvc_header();
if($data!=='s'){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="info-layer">
            <h1 class="inf-title">KONTAKT</h1>
            <div class="row">
            <div class="col-lg-6 cont-form">
                <form action="/proceskontakt" method="">
                    <p style="font-size: 22px;">Ako imate nekih pitanja, pošaljite nam e-mail :</p>
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" required="">
                    <label>Ime i prezime</label>
                    <input type="text" name="ime" class="form-control" required="">
                    <label>Tema</label>
                    <input type="text" name="subject" class="form-control"required="">
                    <label>Tekst poruke</label>
                    <textarea rows="10" name="msg" class="form-control" required=""></textarea>
                    <hr>
                    <input type="submit" value="POŠALJITE" class="btn btn-success">
                </form>
            </div>
            <div class="col-lg-6">
                
            </div>
            </div>
        </div>
    </div>
</div>
<?php mvc_footer();}else{?>
<div class="row">
    <div class="col-lg-12">
        <div class="info-layer">
            <h1 class="inf-title">KONTAKT</h1>
            <div class="row">
                <div class="col-lg-12">
                <h2>USPEŠNO STE POSLALI PORUKU!</h2>
                <h3>Potrudićemo se da Vam odgovorimo u najkraćem mogućem roku!</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php mvc_footer;} 
