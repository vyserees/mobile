<?php
mvc_header();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-title">Proizvod</h1>
    </div>
    <div class="col-lg-12" style="margin-bottom: 50px;">
        <div class="single">
            <div class="col-lg-5">
                <div class="single-img-layer">
                    <div class="single-img-in magnify">
                        <div class="large"></div>
                        <img src="" alt="Slika proizvoda" class="img-responsive small"/>
                        
                    </div>
                </div>
                <div class="single-thumbs">
                    
                </div>
            </div>
            <div class="col-lg-7">
                <div class="single-details">
                    <h2 class="single-title"></h2>
                    <p><span class="single-zalihe"></span></p>
                    <p class="single-cena-layer"><strong>Cena : </strong><span class="single-cena"></span></p>
                    <p><strong>Sifra : </strong><span class="single-sifra"></span></p>
                    <p><strong>Marka : </strong><span class="single-marka"></span></p>
                    <p><strong>Model : </strong><span class="single-model"></span></p>
                    <article>
                        <em class="single-opis"></em>
                    </article>
                    <div class="add-to-cart" data-itm="" style="text-align: left;">
                        <button class="addtocart" data-prid="">DODAJTE U KORPU</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="left-sidebar list-sidebar">
            <h4>SLICNI PROIZVODI</h4>
            <div class="col-lg-12">
                    <div class="featured list-list fet-home singl-similar">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    /*----events----*/
    $(document).on('click','.single-thumbnails',function(){
        var url = $(this).attr('src');
        $('.small').attr('src',url);
        $('.large').css('background','url("'+url+'") no-repeat');
    });
    /*----events----*/
    $.ajax({
        url:'/ajax-getsimilar',
        type:'post',
        data:{mid:localStorage.proizvodMarka,pid:localStorage.proizvod},
        success:function(data){
            $('.fet-home .row').html(data);
            $('#featured-owl').owlCarousel({
                items:5,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,2],
                itemsTabletSmall: false,
                itemsMobile : [479,1],
                pagination:false,
                navigation: true,
                navigationText: [
                    "<i class='fa fa-chevron-left fa-2x'></i>",
                    "<i class='fa fa-chevron-right fa-2x'></i>"
                ]
            });
        }
    });
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
            $('.small').attr('src','/assets/images/products/'+sl[0].sli_url);
            $('.large').css('background','url("/assets/images/products/'+sl[0].sli_url+'") no-repeat');
            var l = sl.length;
            $('.single-thumbs').append('<div class="owl-carousel" id="single-carousel">');
            for(var i=0;i<l;i++){
                $('#single-carousel').append(
                    '<div style="margin-right:10px;"><img src="/assets/images/products/'+sl[i].sli_url+'" alt="Male slike" class="single-thumbnails img-responsive" /></div>'    
                    );
            }
            $('.single-thumbs').append('<div>');
            $("#single-carousel").owlCarousel({
                items:5,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [980,3],
                itemsTablet: [768,3],
                itemsTabletSmall: false,
                itemsMobile : [479,3]
            });
            var pr = data.proizvod;
            $('.single-title').html(pr[0].pro_naziv);
            $('.single-cena').html(parseInt(pr[0].pro_cena).toLocaleString()+' RSD');
            $('.single-sifra').html(pr[0].pro_sifra);
            $('.single-marka').html(pr[0].mar_naziv);
            $('.single-model').html(pr[0].mod_naziv);
            $('.single-opis').html(pr[0].pro_opis);
        }    
    });
    
    
    /*------magnifier------*/
    
    var native_width = 0;
	var native_height = 0;

	//Now the mousemove function
	$(".magnify").mousemove(function(e){
		//When the user hovers on the image, the script will first calculate
		//the native dimensions if they don't exist. Only after the native dimensions
		//are available, the script will show the zoomed version.
		if(!native_width && !native_height)
		{
			//This will create a new image object with the same image as that in .small
			//We cannot directly get the dimensions from .small because of the 
			//width specified to 200px in the html. To get the actual dimensions we have
			//created this image object.
			var image_object = new Image();
			image_object.src = $(".small").attr("src");
			
			//This code is wrapped in the .load function which is important.
			//width and height of the object would return 0 if accessed before 
			//the image gets loaded.
			native_width = image_object.width;
			native_height = image_object.height;
		}
		else
		{
			//x/y coordinates of the mouse
			//This is the position of .magnify with respect to the document.
			var magnify_offset = $(this).offset();
			//We will deduct the positions of .magnify from the mouse positions with
			//respect to the document to get the mouse positions with respect to the 
			//container(.magnify)
			var mx = e.pageX - magnify_offset.left;
			var my = e.pageY - magnify_offset.top;
			
			//Finally the code to fade out the glass if the mouse is outside the container
			if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
			{
				$(".large").fadeIn(100);
			}
			else
			{
				$(".large").fadeOut(100);
			}
			if($(".large").is(":visible"))
			{
				//The background position of .large will be changed according to the position
				//of the mouse over the .small image. So we will get the ratio of the pixel
				//under the mouse pointer with respect to the image and use that to position the 
				//large image inside the magnifying glass
				var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
				var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
				var bgp = rx + "px " + ry + "px";
				
				//Time to move the magnifying glass with the mouse
				var px = mx - $(".large").width()/2;
				var py = my - $(".large").height()/2;
				//Now the glass moves with the mouse
				//The logic is to deduct half of the glass's width and height from the 
				//mouse coordinates to place it with its center at the mouse coordinates
                         $('.large').css({left:px,top:py,backgroundPosition:bgp});
                     }
                 }
             });
    
     /*------magnifier------*/   
    
});
</script>

<?php mvc_footer();