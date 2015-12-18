<?php
adm_header();
$up = prihod_total();
?>
<div class="col-lg-10">
    <div class="row">
        <div class="col-lg-12">
        <h2 class="adm-title">STATISTIKA</h2>
        <div class="col-lg-12 adm-stat">
            <h3>PREGLED OSTVARENOG PRIHODA<span class="pull-right"><i class="fa fa-chevron-down show-data"></i></span></h3>
            <div hidden=""><div class="col-lg-12">
                <div class="col-lg-8">
                    <table class="table table-bordered table-stripped">
                        <tr>
                            <th>UKUPAN PRIHOD</th>
                            <td id="sum-tot"><?=$up['ukupno']?></td>
                            <th>PRIHOD BEZ POSTARINE</th>
                            <td id="sum-net"><?=$up['neto']?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <form action="" id="sum-date" class="form-inline">
                        <select id="sum-month" class="form-control" required="">
                            <option value="">mesec</option>
                            <?php for($i=1;$i<=12;$i++){
                                $i<10 ? $m='0'.$i : $m=$i;
                                echo '<option value="'.$m.'">'.$m.'</option>';                                
                            } ?>
                        </select>
                        <select id="sum-year"class="form-control">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                        </select>
                        <button type="submit" class="btn btn-default" title="Pogledajte prihod">
                            <i class="fa fa-question"></i>
                        </button>
                    </form>
                </div>
            </div>
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
            </div></div>
        <div class="col-lg-12 adm-stat">
            <h3>PREGLED OSTVARENE PRODAJE<span class="pull-right"><i class="fa fa-chevron-down show-data"></i></span></h3>
            <div hidden=""><div class="row">
            <div class="col-lg-6">
                <div class="charts">
                    <div class="chart-header"></div>
                    <div class="chart-area" id="chart-grupe-kom"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1>A</h1>
            </div>
            </div><div class="row">
            <div class="col-lg-6">
                <div class="charts">
                    <div class="chart-header"></div>
                    <div class="chart-area" id="chart-marke-kom"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1>A</h1>
            </div>
            </div></div> 
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
        $('#sum-date').on('submit',function(e){
            e.preventDefault();
            var d = $('#sum-year').val()+'-'+$('#sum-month').val();
            $.ajax({
                url:'/ajax-sumbydate',
                type:'post',
                data:{date:d},
                dataType:'json',
                beforeSend:function(){
                   $('#sum-tot').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('#sum-net').html('<i class="fa fa-spin fa-spinner"></i>'); 
                },
                success:function(data){
                    $('#sum-tot').html(data.ukupno);
                    $('#sum-net').html(data.neto);
                }
            });
        });
        $('.show-data').click(function(){
            $(this).parents('h3').siblings().animate({height:'toggle'});
        });
    });
</script>
<?php 
adm_footer();

