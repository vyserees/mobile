<div class="col-lg-12 owl-carousel fsld-layer" id="featured-owl">
<?php
foreach($data as $p){
    $sl = selection('slike', array('sli_proizvod_id'=>$p['pro_id']));
?>
<div class="with-owl">   
        <div class="featured-layer">
            <a href="/proizvod/<?=$p['pro_slug']?>" class="single" data-pid="<?=$p['pro_id']?>">
            <div class="featured-image">
                <div class="featured-price">
                    <strong><?=$p['pro_cena']?> RSD</strong>
                </div>
                <img src="/assets/images/products/<?=$sl[0]['sli_url']?>" alt="Slika proizvoda" class="img-responsive" />
            </div>
            <div class="featured-title">
                <p><?=$p['pro_naziv']?></p>
            </div>
            </a>
            <div class="add-to-cart" data-itm="<?=$p['pro_id']?>">
                <button class="addtocart" data-prid="<?=$p['pro_id']?>">DODAJTE U KORPU</button>
            </div>
        </div>
</div>
<?php }?>
</div>
<script>
    $(document).ready(function(){
        $('.with-owl').css('margin','0 5px');
        $('.single').click(function(e){
            e.preventDefault();
            var pid = $(this).attr('data-pid');
            var url = $(this).attr('href');
            localStorage.setItem('proizvod',pid);
            location.assign(url);
        });
        var sorted = localStorage.sort;
        $('[value="'+sorted+'"]').attr('selected','selected');
        
        $('.add-to-cart').each(function(){
            var elem = $(this);
            if(localStorage.shoppingcart){
                var sc = JSON.parse(localStorage.shoppingcart);
                var it = elem.attr('data-itm');
                var l = sc.length;
                for(var i=0;i<l;i++){
                    if(sc[i].id===it.toString()){
                       elem.empty().html(
                        '<a href="/korpa" class="btn btn-success" title="Idite do korpe"><i class="fa fa-shopping-cart fa-lg"></i></a>\n\
                         <button class="btn btn-danger rem-from-cart" data-prid="'+it+'" title="Izbacite proizvod iz korpe"><i class="fa fa-trash-o fa-lg"></i></button>'
                        );   
                    }
                }
            }
        });
        
});            
</script>


