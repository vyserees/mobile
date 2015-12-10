<?php
$sld = selection('slider');


foreach($sld as $s){
?>
<div class="item">
    <div class="hsld-image">
        <img src="<?='/assets/images/sliders/'.$s['sld_image']?>" alt="Slajd na pocetnoj" />
    </div>
    <div class="hsld-title"><h1><?=$s['sld_title']?></h1></div>
    <div class="hsld-subtitle"><h3><?=$s['sld_subtitle']?></h3></div>
    <div class="hsld-caption"><p><?=$s['sld_caption']?></p></div>
</div>
<?php }