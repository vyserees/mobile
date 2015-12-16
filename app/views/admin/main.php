<?php
adm_header();
?>
<div class="col-lg-10">
    <div class="row">
        <div class="col-lg-12">
            <h3>PRODAJA</h3>
            <div class="col-lg-6">
                <div class="charts">
                    <div class="chart-header"></div>
                    <div class="chart-area" id="chart-grupe"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="charts">
                    <div class="chart-header"></div>
                    <div class="chart-area" id="chart-marke"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $.ajax({
            url:'/ajax-drawallcharts',
            dataType:'json',
            success:function(data){
                var l = data.length;
                for(var i=0;i<l;i++){
                    drawChart(data[i].title,data[i].tip,data[i].mesto,data[i].podaci);
                }
            }
        });
    });
</script>
<?php 
adm_footer();

