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
                        <input type="text" id="pobroju" class="form-control" placeholder="po broju">
                        <span class="input-group-addon"><i class="fa fa-search fa-lg ord-search" title="Pretrazite porudzbine po broju"></i></span>
                    </div>
                </div>
                <div class="col-lg-3">
                        <label>Po imenu</label>
                    <div class="input-group">
                        <input type="text" id="poimenu" class="form-control" placeholder="po imenu">
                        <span class="input-group-addon"><i class="fa fa-search fa-lg ord-search" title="Pretrazite porudzbine po imenu"></i></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>Po statusu</label>
                    <select name="postatusu" class="form-control">
                        <option value="">izaberite status porudzbine</option>
                        <option value="C-C">Placene i realizovane</option>
                        <option value="C-P">Placene a nerealizovane</option>
                        <option value="P-P">Neplacene i nerealizovane</option>
                    </select>
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
                    <table class="table table-bordered col-lg-6">
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
                        <tr>
                            <td><strong>Nacin placanja</strong></td>
                            <td><?php switch($data['orders'][$i]['ord_placanje']){
                                case 'U':
                                    echo 'Uplatnicom';
                                    break;
                                case 'V':
                                    echo 'Virmanom';
                                    break;
                                default:
                                    echo 'Pouzecem';
                            }?></td>
                        </tr>
                    </table>
                    <table class="table table-bordered col-lg-6">
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
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <?php if($data['orders'][$i]['ord_paid']==='P'){?>
                            <button data-oid="<?=$data['orders'][$i]['ord_id']?>" class="btn btn-primary confpay">POTVRDITE PLACANJE</button>
                            <?php }else{echo '<p style="padding:7px 12px;background:#5cb85c;color:#fff;margin:0;text-align:center;">UPLATA POTVRDJENA</p>';}?>
                        </div>
                        <div class="col-lg-4">
                            <?php if($data['orders'][$i]['ord_status']==='P'){?>
                            <button data-oid="<?=$data['orders'][$i]['ord_id']?>" class="btn btn-primary confsent">POTVRDITE REALIZACIJU</button>
                            <?php }else{echo '<p style="padding:7px 12px;background:#5cb85c;color:#fff;margin:0;text-align:center;">REALIZACIJA POTVRDJENA</p>';}?>
                        </div>
                        <div class="col-lg-4"><button data-oid="<?=$data['orders'][$i]['ord_id']?>" class="btn btn-danger delorder">OBRISITE PORUDZBINU</button></div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.ord-number h4').click(function(){
        $(this).parent().children('.ord-tables').animate({height:'toggle'});
        $(this).parent().siblings().children('.ord-tables').hide();
    });
    $('.ord-search').click(function(){
        var key = $(this).parent().siblings().attr('id');
        var val = $(this).parent().siblings().val();
        var text = key+'='+val;
        location.assign('/admin-porudzbine/'+text);
    });
    $('[name="postatusu"]').change(function(){
        var key = $(this).attr('name');
        var val = $(this).val();
        var text = key+'='+val;
        location.assign('/admin-porudzbine/'+text);
    });
    $(document).on('click','.confpay',function(){
        var elem = $(this);
        var oid = elem.attr('data-oid');
        $.ajax({
            url:'/ajax-updateorder',
            type:'post',
            data:{key:'paid',val:oid},
            beforeSend:function(){
                elem.html('obrada u toku...');
            },
            success:function(data){
                elem.parent().empty().html(data);
                elem.parents('.ord-tables').show();
            }
        });
    });
    $(document).on('click','.confsent',function(){
        var elem = $(this);
        var oid = elem.attr('data-oid');
        $.ajax({
            url:'/ajax-updateorder',
            type:'post',
            data:{key:'status',val:oid},
            beforeSend:function(){
                elem.html('obrada u toku...');
            },
            success:function(data){
                elem.parent().empty().html(data);
                elem.parents('.ord-tables').show();
            }
        });
    });
    $(document).on('click','.delorder',function(){
        var elem = $(this);
        var oid = elem.attr('data-oid');
        $.ajax({
            url:'/ajax-updateorder',
            type:'post',
            data:{key:'delete',val:oid},
            beforeSend:function(){
                elem.html('obrada u toku...');
            },
            success:function(data){
                location.reload();
            }
        });
    });
});
</script>

<?php adm_footer();