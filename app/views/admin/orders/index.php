<?php
adm_header();
?>
<div class="col-lg-10">
    <h2 class="adm-title">PORUDŽBINE</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="adm-orders-search">
                <div class="col-lg-3">
                        <label>Po broju</label>
                    <div class="input-group">
                        <input type="text" id="pobroju" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-search fa-lg ord-search" title="Pretrazite porudzbine po broju"></i></span>
                    </div>
                </div>
                <div class="col-lg-3">
                        <label>Po imenu</label>
                    <div class="input-group">
                        <input type="text" id="poimenu" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-search fa-lg ord-search" title="Pretrazite porudzbine po imenu"></i></span>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-12"><hr></div>
        <div class="col-lg-12">
            <?php $l = count($data['orders']);
            for($i=0;$i<$l;$i++){?>
            <div class="ord-number">
                <h4>BR. <?=$data['orders'][$i]['ord_number']?></h4>
                <div class="ord-tables row" hidden="">
                    <table class="table table-bordered table-striped col-lg-6">
                        <tr><th colspan="2">KUPAC</th></tr>
                        <tr>
                            <td><strong>Ime i prezime</strong></td>
                            <td><?=$data['orders'][$i]['ord_name']?></td>
                        </tr>
                        <tr>
                            <td><strong>Adresa</strong></td>
                            <td><?=$data['orders'][$i]['ord_address']?></td>
                        </tr>
                        <tr>
                            <td><strong>Poštanski broj</strong></td>
                            <td><?=$data['orders'][$i]['ord_postcode']?></td>
                        </tr>
                        <tr>
                            <td><strong>Grad</strong></td>
                            <td><?=$data['orders'][$i]['ord_city']?></td>
                        </tr>
                        <tr>
                            <td><strong>Telefon</strong></td>
                            <td><?=$data['orders'][$i]['ord_phone']?></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped col-lg-6">
                        <tr><th colspan="3">PROIZVODI</th></tr>
                        <tr>
                            <th>Sifra</th>
                            <th>Naziv</th>
                            <th>Kolicina</th>
                        </tr>
                        <?php foreach($data['list'][$i] as $o){ ?>
                        <tr>
                            <td><?=$o['pro_sifra']?></td>
                            <td><?=$o['pro_naziv']?></td>
                            <td><?=$o['oli_kolicina']?></td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.ord-number').click(function(){
        $(this).children('.ord-tables').animate({height:'toggle'});
        $(this).siblings().children('.ord-tables').hide();
    });
    $('.ord-search').click(function(){
        var key = $(this).parent().siblings().attr('id');
        var val = $(this).parent().siblings().val();
        var text = key+'='+val;
        location.assign('/admin-porudzbine/'+text);
    });
});
</script>

<?php adm_footer();