<?php
mvc_header();
?>
<div class="row">
    <div class="col-lg-9" style="margin-bottom: 50px;">
        <div class="single">
            <h1>Proizvod</h1>
            <div class="col-lg-6">
                <div class="single-img-layer">
                    <div class="single-img-in">
                        <img src="" alt="Slika proizvoda" class="img-responsive"/>
                    </div>
                </div>
                <div class="single-thumbs">
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-details">
                    <h2 class="single-title"></h2>
                    <p><span class="single-zalihe"></span></p>
                    <p><strong>Cena : </strong><span class="single-cena"></span></p>
                    <p><strong>Marka : </strong><span class="single-marka"></span></p>
                    <p><strong>Model : </strong><span class="single-model"></span></p>
                    <article>
                        <em class="single-opis"></em>
                    </article>
                    <div class="add-to-cart" data-itm="">
                        <button class="addtocart" data-prid="">DODAJTE U KORPU</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.add-to-cart').attr('data-itm',localStorage.proizvod);
    $('.addtocart').attr('data-prid',localStorage.proizvod);
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
    $.ajax({
        url:'/ajax-drawsingle',
        type:'post',
        dataType:'json',
        data:{prid:localStorage.proizvod},
        success:function(data){
            var sl = data.slike;
            $('.single-img-in img').attr('src','/assets/images/products/'+sl[0].sli_url);
            var l = sl.length;
            $('.single-thumbs').append('<div class="owl-carousel" id="single-carousel">');
            for(var i=0;i<l;i++){
                $('#single-carousel').append(
                    '<div><img src="/assets/images/products/'+sl[i].sli_url+'" alt="Male slike" class="single-thumbnails img-responsive" /></div>'    
                    );
            }
            $('.single-thumbs').append('<div>');
            $("#single-carousel").owlCarousel({
                items:5,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,2],
                itemsTabletSmall: false,
                itemsMobile : [479,1]
            });
            var pr = data.proizvod;
            $('.single-title').html(pr[0].pro_naziv);
            $('.single-cena').html(parseInt(pr[0].pro_cena).toLocaleString()+' RSD');
            $('.single-opis').html(pr[0].pro_opis);
        }    
    });
    
});
</script>

<?php mvc_footer();