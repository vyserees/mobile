
<table class="table table-bordered table-striped table-hover" style="margin-top:20px;">
    <tr>
        <th style="width: 45%; text-align: center;" colspan="2">Proizvod</th>
        <th style="width: 15%; text-align: center;">Cena</th>
        <th style="width: 15%; text-align: center;">Kolicina</th>
        <th style="width: 20%; text-align: center;">Vrednost</th>
        <th style="width: 5%; text-align: center;">Izbaci</th>
    </tr>
    <?php foreach($data as $s){?>
    <tr class="cart-list" data-prid="<?=$s['id']?>">
        <td style="width: 10%; text-align: center;"><img src="/assets/images/products/<?=$s['slika']?>" alt="Slika proizvoda" style="width:100px;height: 80px;" /></td>
        <td style="padding-top:30px;width: 35%; text-align: left;"><?=$s['naziv']?></td>
        <td style="padding-top:30px;width: 15%; text-align: center;" class="td-cena"><span class="sc-cena"><?=$s['cena']?></span> RSD</td>
        <td style="padding-top:30px;width: 15%; text-align: center;" class="td-quant"><input type="number" class="quant" min="1" value="1" style="width:50px;text-align: right;"></td>
        <td style="padding-top:30px;width: 20%; text-align: center;" class="td-vred"><span class="sc-vred"></span> RSD</td>
        <td style="padding-top:25px;width: 5%; text-align: center;"><i class="fa fa-trash-o fa-2x rem-from-shc" data-cid="<?=$s['id']?>"></i></td>
    </tr>
    <?php }?>
    
</table>
<hr>
<table class="table table-bordered">
    <tr>
        <th colspan="3">UKUPNO</th>
    </tr>
    <tr>
        <td rowspan="4" width="50%"></td>
        <td>Ukupno korpa:</td>
        <td style="text-align: right;"><span id="sc-total"></span> RSD</td>
    </tr>
    <tr>
        <td>Troskovi postarine:</td>
        <td style="text-align: right;">200 RSD</td>
    </tr>
    <tr style="font-size:20px;font-weight: 700;background: #e5e5e5;">
        <td style="font-size:20px;">Ukupno za placanje:</td>
        <td style="text-align: right;font-size:20px;"><span id="sc-uplata"></span> RSD</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right;">*PDV uracunat u cenu</td>
    </tr>
</table>
<hr>
<div class="row">
    <div class="col-lg-12">
        <button class="btn btn-success btn-lg pull-right cart-confirm" style="margin-left:20px;">POTVRDITE NARUDZBINU</button>
        <button class="btn btn-primary btn-lg pull-right back-to-shop">NASTAVITE KUPOVINU</button>
    </div>
</div>

<script>
    $(document).ready(function(){
        calculate();
        $('.quant').change(function(){
            calculate();
        });
        $('.rem-from-shc').click(function(){
            var id = $(this).attr('data-cid');
            var sc = JSON.parse(localStorage.shoppingcart);
            l = sc.length;
            for(var i=0;i<l;i++){
                if(sc[i].id===id){
                    var temp = sc[0];
                    sc[0] = sc[i];
                    sc[i] = temp;
                }
            }
            sc.shift();
            localStorage.setItem('shoppingcart',JSON.stringify(sc));
            $(this).parents('tr').remove();
            calculate();
        });
        $('.back-to-shop').click(function(){
            location.assign('/proizvodi');
        });
        
        
        function calculate(){
            var total = 0;
            $('.sc-cena').each(function(){
                var cena = parseInt($(this).text());
                var kol = parseInt($(this).parent().siblings('.td-quant').children('.quant').val());
                $(this).parent().siblings('.td-vred').children('.sc-vred').text(cena*kol);
                total += cena*kol;
            });
            $('#sc-total').html(total);
            $('#sc-uplata').html(total+200);
            $('[name="vrednost"]').val(total+200);
        }
    });
</script>