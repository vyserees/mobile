<?php
adm_header();
?>
<div class="col-lg-10">
    <div class="row">
        <div class="col-lg-12">
            <h3>PRODAJA</h3>
            <p>UKUPNO - <?php $up=prihod_total();echo $up['ukupno']; ?></p>
            <p>ZA DECEMBAR - <?php $upm = prihod_total('12-2015');echo $upm['ukupno'];?></p>
            <p>MARKE : <?php var_dump(prihod_by('marka')); ?></p>
            <p>MARKE ZA DEC : <?php var_dump(prihod_by('marka','12-2015')); ?></p>
            <p>GRUPE : <?php var_dump(prihod_by('grupa')); ?></p>
            <p>KATEGORIJE : <?php var_dump(prihod_by('kat')); ?></p>
        </div>
    </div>
</div>
<?php 
adm_footer();

