<?php
mvc_header();
?>
<div class="row">
    <div class="col-lg-3">
        <div class="left-sidebar">
            <?php self::view('kupovina/korpaside'); ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="main-layer">
            <div class="row">
                <div class="col-lg-12">
                    <h1>KORPA</h1>
                    <div class="sc-layer">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.hed-cart').hide();
        drawShoppingCart();
        $(document).on('click','.cart-confirm',function(){
            var emptyness = false;
            $('.korisnik :text').each(function(){
                if($(this).val()===''){
                    $(this).css('border','3px solid #ff0000');
                    emptyness = true;
                }else{
                    $(this).css('border','1px solid #7bae23');
                }
            });
            if(emptyness){
                $('#cart-emptyform').show();
            }else{
                $('#confirm-order').submit();
            }
        });
        $('#confirm-order').on('submit',function(e){
            e.preventDefault();
            
            localStorage.setItem('shoppingcart','');
            
            $.ajax({
                url:'/ajax-insertorder',
                type:'post',
                data: new FormData(this),
                contentType: false, 
                cache: false,
                processData:false,
                success:function(data){
                    var oid = data;
                    var lista = [];
                    $('.cart-list').each(function(){
                        var temp = {oid:oid,pid:$(this).attr('data-prid'),kolicina:$(this).children().find('.quant').val()};
                        lista.push(temp);
                    });
                    
                    $.ajax({
                        url:'/ajax-insertorderlist',
                        type:'post',
                        data:{lista:lista},
                        success:function(data){
                            location.assign('/potvrdakupovine/'+data);
                        }
                    });
                }
            });
        });
    });
</script>

<?php mvc_footer();
