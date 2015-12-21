<?php
mvc_header();
?>
<?php if($data[0]==='U'){?>
<script>$(document).ready(function(){$('.hed-cart').hide();});</script>
<div class="col-lg-6 col-lg-offset-3">
    <div class="cf-order">
        <h2>Uspešno ste izvršili naručivanje!</h2>
        <p>Izabrali ste način plaćanja : UPLATNICOM.</p>
        <p>Na sledeći način :</p>
        <article>
            <p><strong>Uplatilac : </strong><?=$data[1]['ord_name'].', '.$data[1]['ord_address'].', '.$data[1]['ord_city']?></p>
            <p><strong>Svrha uplate : </strong>Uplata za narudžbinu</p>
            <p><strong>Primalac : </strong>Mobile.dev</p>
            <p><strong>Vrednost : </strong><?=$data[1]['ord_vrednost'].',00'?></p>
            <p><strong>Račun : </strong>260-111222333-44</p>
            <p><strong>Poziv na broj : </strong><?=$data[1]['ord_number']?></p>
        </article>
    </div>
</div>
    
<?php mvc_footer; }elseif($data[0]==='P'){?>
<script>$(document).ready(function(){$('.hed-cart').hide();});</script>
<div class="col-lg-6 col-lg-offset-3">
    <div class="cf-order">
        <h2>Uspešno ste izvršili naručivanje!</h2>
        <p>Izabrali ste način plaćanja : POUZEĆEM.</p>
        <p>Pozvaćemo Vas telefonom, kako bi potvrdili kupovinu, a zatim, u roku od 2/3 radna dana, pošiljka će Vam stići na navedenu adresu, kada ćete izvršiti i plaćanje porudžbine.</p>
    </div>
</div>

    
<?php mvc_footer; }elseif($data[0]==='V'){?>
<div class="col-lg-6 col-lg-offset-3">
    <div class="cf-order">
        <h2>Uspešno ste izvršili naručivanje!</h2>
        <p>Izabrali ste način plaćanja : VIRMANOM.</p>
        <p>Na sledeći način :</p>
        <article>
            <p><strong>Uplatilac : </strong><?=$data[1]['ord_name'].', '.$data[1]['ord_address'].', '.$data[1]['ord_city']?></p>
            <p><strong>Svrha uplate : </strong>Uplata za narudžbinu</p>
            <p><strong>Primalac : </strong>Mobile.dev</p>
            <p><strong>Vrednost : </strong><?=$data[1]['ord_vrednost'].',00'?></p>
            <p><strong>Račun : </strong>260-111222333-44</p>
            <p><strong>Poziv na broj : </strong><?=$data[1]['ord_number']?></p>
        </article>
    </div>
</div>
    
<?php mvc_footer; }else{
    header('Location: /error');
}