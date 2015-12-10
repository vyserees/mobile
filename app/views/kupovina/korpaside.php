<?php

?>
<h4 style="margin-top: 20px;">KORISNIK</h4>
<article>
    <input type="text" required="" name="ime" class="cart-input form-control" placeholder="ime i prezime">
    <input type="text" required="" name="adresa" class="cart-input form-control" placeholder="adresa isporuke">
    <input type="text" required="" name="grad" class="cart-input form-control" placeholder="mesto">
    <input type="text" required="" name="posta" class="cart-input form-control" placeholder="postanski broj">
    <input type="text" required="" name="telefon" class="cart-input form-control" placeholder="kontakt telefon">
</article>
<h4>NACIN PLACANJA</h4>
<article>
    <div class="radio">
        <label>
            <input type="radio" name="nacinplacanja" value="P" checked="">
            Pouzecem
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="nacinplacanja" value="U">
            Uplatnicom
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="nacinplacanja" value="P">
            Virmanom (samo za pravna lica)
        </label>
    </div>        
</article>

