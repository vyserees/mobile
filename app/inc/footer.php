</div>

    <footer class="footer">
      <div class="container">
          <p class="text-muted">Mobilni <?php echo date("Y"); ?></p>
      </div>
    </footer>

<script>
$(document).ready(function(){
    if(localStorage.shoppingcart){
        drawCart();
    }else{
        $('#cart-prods').html('0');
        $('#cart-value').html('0');
        $('.hed-cart-submenu').html('<h3>Nema proizvoda</h3>');
    }
    
    $(document).on('click','.addtocart',function(){
        var prid = $(this).attr('data-prid');
        $(this).parent().empty().html(
                    '<a href="/korpa" class="btn btn-success" title="Idite do korpe"><i class="fa fa-shopping-cart fa-lg"></i></a>\n\
                     <button class="btn btn-danger rem-from-cart" data-prid="'+prid+'" title="Izbacite proizvod iz korpe"><i class="fa fa-trash-o fa-lg"></i></button>'
                    );  
        addToCart(prid);
    });
    $(document).on('click','.empty-cart',function(){
        $('.hed-cart-submenu').hide();
        localStorage.setItem('shoppingcart','');
        drawCart();
        //drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
        location.reload();
    });
    $(document).on('click','.rem-from-cart',function(){
        var pid = $(this).attr('data-prid');
        var sc = JSON.parse(localStorage.shoppingcart);
        var l=sc.length;
        for(var i=0;i<l;i++){
            if(sc[i].id===pid.toString()){
                var temp = sc[0];
                sc[0] = sc[i];
                sc[i]= temp;
            }
        }
        sc.shift();
        var scnew = JSON.stringify(sc);
        localStorage.setItem('shoppingcart',scnew);
        drawCart();
        $(this).parent().empty().html('<button class="addtocart" data-prid="'+pid+'">DODAJTE U KORPU</button>');
    });
});
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
