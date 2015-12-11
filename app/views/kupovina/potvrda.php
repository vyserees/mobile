<?php
mvc_header();

if($data[0]==='U'){?>
<h1>USPESNA POTVRDA NARUDZBINE</h1>
<h3>PLACANJE PUTEM UPLATNICE</h3>
    
<?php mvc_footer; }elseif($data[0]==='P'){?>
<h1>USPESNA POTVRDA NARUDZBINE</h1>
<h3>PLACANJE POUZECEM</h3>
    
<?php mvc_footer; }elseif($data[0]==='V'){?>
<h1>USPESNA POTVRDA NARUDZBINE</h1>
<h3>PLACANJE PUTEM VIRMANA</h3>
    
<?php mvc_footer; }else{
    header('Location: /error');
}