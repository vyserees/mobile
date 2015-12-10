$(document).ready(function(){
    /*menu dropdown*/
    $('.drop').mouseenter(function(){
        $(this).children('.submenu').show();
    });
    $('.drop').mouseleave(function(){
        $(this).children('.submenu').hide();
    });
    /*cart dropdown*/
    $('.hed-cart').mouseenter(function(){
        $('.hed-cart-submenu').show();
    });
    $('.hed-cart').mouseleave(function(){
        $('.hed-cart-submenu').hide();
    });
    /*home slider*/
    $('#home-slider').owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 600,
        paginationSpeed : 5000,
        rewindSpeed: 5000,
        singleItem:true,
        autoPlay:true,
        pagination:false,
        transitionStyle:'fade'
    });
    
    /*add to cart*/
    
    /*filter za marke i modele*/
    $(document).on('click','.filbrand',function(){
        var mrid = $(this).attr('data-mrid');
        localStorage.setItem('marka',mrid);
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    
    });
    $(document).on('click','.filmodel',function(){
        var moid = $(this).attr('data-moid');
        var mrid = $(this).attr('data-mrid');
        localStorage.setItem('marka',mrid);
        localStorage.setItem('model',moid);
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    
    });
    
    /*removing breadcrumbs*/
    $(document).on('click','.rfkat',function(){
        localStorage.setItem('kategorija','');
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    
    });
    $(document).on('click','.rfmarka',function(){
        localStorage.setItem('marka','');
        localStorage.setItem('model','');
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    
    });
    $(document).on('click','.rfmodel',function(){
        localStorage.setItem('model','');
        localStorage.setItem('marka','');
        drawListMarka(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka);
        drawListModel(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    
    });
    
    /*sorting and pagination*/
    $(document).on('change','#list-sort',function(){
        var sort = $(this).val();
        localStorage.setItem('sort',sort);
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
    });
    
});
function drawList(grupa,kat,potkat,marka,model,sort,page){
    $.ajax({
        url:'/ajax-drawlist',
        type:'post',
        data:{grupa:grupa,kat:kat,potkat:potkat,marka:marka,model:model,sort:sort,page:page},
        beforeSend:function(){
                $('.featured').empty();
                $('.featured').html('<div class="spiner"><i class="fa fa-cog fa-spin fa-5x"></i></div>');
                },
        success:function(data){
            $('.featured').empty();
            $('.featured').html(data);
        }
    });
}
function drawListMarka(grupa,kat,potkat,marka){
    $.ajax({
        url:'/ajax-drawlistmarka',
        type:'post',
        data:{grupa:grupa,kat:kat,potkat:potkat,marka:marka},
        success:function(data){
            $('.list-brands').empty();
            $('.list-brands').html(data);
        }
    });
}
function drawListModel(grupa,kat,potkat,marka,model){
    $.ajax({
        url:'/ajax-drawlistmodel',
        type:'post',
        data:{grupa:grupa,kat:kat,potkat:potkat,marka:marka,model:model},
        success:function(data){
            $('.list-models').empty();
            $('.list-models').html(data);
        }
    });
}
function drawBredkramb(grupa,kat,potkat,marka,model){
    $.ajax({
        url:'/ajax-drawbredkramb',
        type:'post',
        data:{grupa:grupa,kat:kat,potkat:potkat,marka:marka,model:model},
        success:function(data){
            $('.bredkramb').empty();
            $('.bredkramb').html(data);
        }
    });
}
function addToCart(id){
    $.ajax({
        url:'/ajax-addtocart',
        type:'post',
        dataType:'json',
        data:{id:id},
        success:function(data){
            if(localStorage.shoppingcart){
                var olds = JSON.parse(localStorage.shoppingcart);
                olds.push({'id':id,'slika':data.sli_url,'naziv':data.pro_naziv,'cena':data.pro_cena,'kolicina':'1'});
                localStorage.setItem('shoppingcart',JSON.stringify(olds));
            } else{
                localStorage.setItem('shoppingcart',JSON.stringify([{'id':id,'slika':data.sli_url,'naziv':data.pro_naziv,'cena':data.pro_cena,'kolicina':'1'}]));
            }           
                      
            drawCart();
        }
    });
}
function drawCart(){
    if(localStorage.shoppingcart!==''){
    var sc = JSON.parse(localStorage.shoppingcart);
    var vl = 0;
    var pc = 0;
    var sub = '';
    var l = sc.length;
    
        for(var i=0;i<l;i++){
            vl += parseInt(sc[i].cena);
            pc++;
            sub += '<div class="hed-cart-item"><table class="table"><tr><td><img src="/assets/images/products/'+sc[i].slika+'" alt="Slika proizvoda" style="width:60px;height:40px;" /></td><td width="48%">'+sc[i].naziv+'</td><td width="28%">'+sc[i].cena+' RSD</td></tr></table></div>';
        }
        sub += '<table class="table"><tr><td width="50%"><a href="/korpa" class="btn btn-success btn-sm">KORPA</a></td><td width="50%"><button class="btn btn-danger btn-sm empty-cart">ISPRAZNITE</button></td></tr></table>';
        $('#cart-prods').empty().html(pc);
        $('#cart-value').empty().html(vl.toLocaleString());
        $('.hed-cart-submenu').html(sub);
    }else{
        $('#cart-prods').html('0');
        $('#cart-value').html('0');
        $('.hed-cart-submenu').html('<h3>Nema proizvoda</h3>');
    }
}
function drawShoppingCart(){
    var sc = JSON.parse(localStorage.shoppingcart);
    $.ajax({
        url:'/ajax-drawshoppingcart',
        type:'post',
        data:{sc:sc},
        success:function(data){
            $('.sc-layer').empty();
            $('.sc-layer').html(data);
        }
    });
}