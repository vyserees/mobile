<?php
adm_header();
?>

<div class="col-lg-10">
    <h2 class="adm-title">KATEGORIJE</h2>
    <div class="row">
        <div class="col-lg-4">
            <div class="kat-layout">
                <h4>GRUPE</h4>
                <div class="kat-layout-in kat-group-in">
                    <?php foreach($data as $g){?>
                    <p class="kat-tab kat-group" data-grid="<?=$g['gru_id']?>"><?=ucfirst($g['gru_naziv'])?>
                        <span class="pull-right"><i class="fa fa-chevron-right fa-lg" title="Prikazi kategorije"></i></span>
                    </p>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="kat-layout">
                <h4>KATEGORIJE</h4>
                <div class="kat-layout-in kat-kat-in">
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="kat-layout">
                <h4>POTKATEGORIJE</h4>
                <div class="kat-layout-in kat-pot-in">
                    
                </div>
            </div>
        </div>
    </div>        
</div>

<?php 
adm_footer();