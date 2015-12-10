
<?php
mvc_header();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="bredkramb">
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="left-sidebar list-sidebar">
            <?php self::view('proizvodi/sidebar'); ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="main-layer">
            <div class="row">
            <div class="col-lg-12">
                <div class="list-adv-search">
                    <select id="list-sort">            
                        <option value="new">prvo najnovije</option>
                        <option value="old">prvo najstarije</option>
                        <option value="cena+">prvo najskuplje</option>
                        <option value="cena-">prvo najjeftinije</option>
                    </select>
                    <div class="pull-right paging">
                        <ul>
                            <li><i class="fa fa-backward"></i></li>
                            <li data-page="1">1</li>
                            <li data-page="2">2</li>
                            <li data-page="3">3</li>
                            <li data-page="4">4</li>
                            <li><i class="fa fa-forward"></i></li>
                        </ul>
                    </div>
                </div>
            </div>   
            </div>
            <div class="row">
                    <div class="featured list-list">
                        
                    </div>
             
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        drawList(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model,localStorage.sort,localStorage.page);
        drawBredkramb(localStorage.grupa,localStorage.kategorija,localStorage.potkategorija,localStorage.marka,localStorage.model);
    });
</script>
<?php
mvc_footer();