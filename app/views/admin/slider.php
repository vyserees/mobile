<?php
adm_header();
?>
<div class="col-lg-10">
    <h2 class="adm-title">SLAJDER</h2>
    <div class="row">
        <div class="asld-new">
            <button class="btn btn-primary addslide">DODAJTE NOVI SLAJD</button>
            
        </div>
        <div class="asld-layer">
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        drawSlider();
        $('#slajd').fileinput({
            showUpload: false,
            maxFileCount: 1,
            allowedFileExtensions: ["jpg"]
            //maxFileSize: 800
        });
    });
</script>
<?php 
adm_footer();

