<?php
mvc_header();
?>
<div class="row">
    <div class="col-lg-3">
        <div class="left-sidebar">
            <?php self::view('home/sidebar'); ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="main-layer">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme hsld-layer" id="home-slider">
                        <?php self::view('home/slider'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="featured list-list fet-home">
                        <div class="row">
                        <?php self::view('proizvodi/listsingl',$data); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    localStorage.setItem('grupa','');
    localStorage.setItem('kategorija','');
    localStorage.setItem('potkategorija','');
    localStorage.setItem('marka','');
    localStorage.setItem('model','');
    localStorage.setItem('proizvod','');
    localStorage.setItem('sort','new');
    localStorage.setItem('page','1');
    
    $('.fet-home .featured-image').append('<div class="featured-add"><strong>EXTRA</strong></div>');
});
</script>
<?php 
mvc_footer();


