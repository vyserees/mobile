<?php

$grupe = selection('grupe');
?>
<div class="menu">
    <ul>
        <li><a href="/">POCETNA</a></li>
        <?php foreach($grupe as $g){ ?>
        <li class="drop">
            <a href="/proizvodi/<?=$g['gru_slug']?>" class="grups" data-grid="<?=$g['gru_id']?>">
                <?=strtoupper($g['gru_naziv'])?>
            </a>
            <?php $ks = self::model('data')->getKats($g['gru_id']);
            if(count($ks)>0){
                echo '<div class="submenu" hidden=""><ul>';
                foreach($ks as $k){?>
                <li><a href="/proizvodi/<?=$g['gru_slug']?>" class="kategs" data-grid="<?=$g['gru_id']?>" data-kaid="<?=$k['kat_id']?>"><?=strtoupper($k['kat_naziv'])?></a></li>
            <?php }
                echo '</ul></div>';
            }?>
        </li>
        <?php }?>
        <!--
        <li class="drop"><a href="">Telefoni</a>
            <div class="submenu sfirst" hidden="">
                <ul class="col-lg-3">
                    <li><a href="">Telefon1</a></li>
                    <li><a href="">Telefon2</a></li>
                    <li><a href="">telefon3</a></li>
                </ul>
                <div class="col-lg-9">
                    <h2>OSTALE STVARI SA SLIKAMA</h2>
                </div>
            </div>
        </li>
        <li class="drop"><a href="">Tableti</a>
            <div class="submenu ssecond" hidden="">
                <ul class="col-lg-3">
                    <li><a href="">Telefon1</a></li>
                    <li><a href="">Telefon2</a></li>
                    <li><a href="">telefon3</a></li>
                </ul>
                <div class="col-lg-9">
                    <h2>OSTALE STVARI SA SLIKAMA</h2>
                </div>
            </div>
        </li>
        <li><a href="">Dodatna oprema</a></li>
        <li><a href="">Akcija</a></li>
        <li><a href="">Najzanimljivije</a></li>
        -->
        <li class="meni-search pull-right">
            <form class="form-inline" id="search">
            <input type="text" name="search" class="form-control" placeholder="pretrazi proizvode...">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
            </form>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function(){
        $('.grups').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            var grid = $(this).attr('data-grid');
            localStorage.setItem('grupa',grid);
            localStorage.setItem('kategorija','');
            localStorage.setItem('marka','');
            localStorage.setItem('model','');
            location.assign(url);
        });
        $('.kategs').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            var kaid = $(this).attr('data-kaid');
            var grid = $(this).attr('data-grid');
            localStorage.setItem('grupa',grid);
            localStorage.setItem('kategorija',kaid);
            localStorage.setItem('marka','');
            localStorage.setItem('model','');
            location.assign(url);
        });
    });
</script>