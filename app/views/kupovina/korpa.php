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
    });
</script>

<?php mvc_footer();
