$(document).ready(function(){
   /*kategorije po grupama*/
   $('.kat-group i').click(function(){
       var grid = $(this).parent().parent().attr('data-grid');
       $(this).parent().parent().css('border','3px solid #aaa').siblings().css('border','1px solid #eee');

       drawKats(grid);
   });
   $(document).on('click','.addkat',function(){
       var katgrid = $('[name="katgrid"]').val();
       var kname = $(this).parent().siblings('[name="naziv"]').val();
       if(kname!==''){
            $.ajax({
                url:'/ajax-addkat',
                type:'post',
                data:{katgrid:katgrid,kname:kname},
                beforeSend:function(){
                $('.kat-kat-in').empty();
                $('.kat-kat-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
                },
                success:function(data){
                    drawKats(data);                    
                }
            });
        }else{
            alert('Unesite naziv kategorije!!!');
        }
   });
   $(document).on('click','.delkat',function(){
       var kid = $(this).parent().parent().attr('data-kid');
       var gkid = $(this).parent().parent().attr('data-gkid');
       $.ajax({
           url:'/ajax-delkat',
           type:'post',
           data:{kid:kid,gkid:gkid},
           beforeSend:function(){
                $('.kat-kat-in').empty();
                $('.kat-kat-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
            success:function(data){
                drawKats(data);
                
            }
       });
   });
   $(document).on('click','.getpots',function(){
       var kaid = $(this).parent().parent().attr('data-kid');
       $(this).parent().parent().css('border','3px solid #aaa').siblings().css('border','1px solid #eee');

       drawPots(kaid);
       
   });
   $(document).on('click','.addpot',function(){
       var kpid = $('[name="kpid"]').val();
       var pname = $(this).parent().siblings('[name="naziv"]').val();
       if(pname!==''){
            $.ajax({
                url:'/ajax-addpot',
                type:'post',
                data:{kpid:kpid,pname:pname},
                beforeSend:function(){
                $('.kat-pot-in').empty();
                $('.kat-pot-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
                },
                success:function(data){
                    drawPots(data);                    
                }
            });
        }else{
            alert('Unesite naziv potkategorije!!!');
        }
   });
   $(document).on('click','.delpot',function(){
       var poid = $(this).parent().parent().attr('data-poid');
       var kpot = $(this).parent().parent().attr('data-kpot');
       $.ajax({
           url:'/ajax-delpot',
           type:'post',
           data:{poid:poid,kpot:kpot},
           beforeSend:function(){
                $('.kat-pot-in').empty();
                $('.kat-pot-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
            success:function(data){
                drawPots(data);
                
            }
       });
   });
   
   /*marke i modeli*/
   $(document).on('click','.addbrand',function(){
       var bname = $(this).parent().siblings().val();
       if(bname!==''){
           $.ajax({
               url:'/ajax-addbrand',
               type:'post',
               data:{bname:bname},
               beforeSend:function(){
                $('.bra-bra-in').empty();
                $('.bra-bra-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
                },
                success:function(data){
                    drawBrands();
                }
           });
       }else{
           alert('Unesite naziv marke!!!');
       }
   });
   $(document).on('click','.getmod',function(){
       var bra = $(this).parent().parent().attr('data-bid');
       $(this).parent().parent().css('border','3px solid #aaa').siblings().css('border','1px solid #eee');
       drawModels(bra);
   });
   $(document).on('click','.addmod',function(){
       var mname = $(this).parent().siblings('[name="naziv"]').val();
       var bid = $('[name="bid"]').val();
       if(mname!==''){
           $.ajax({
               url:'/ajax-addmod',
               type:'post',
               data:{mname:mname,bid:bid},
               beforeSend:function(){
                $('.bra-mod-in').empty();
                $('.bra-mod-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
                },
                success:function(data){
                    drawModels(data);
                }
           });
       }else{
           alert('Unesite naziv marke!!!');
       }
   });
   $(document).on('click','.delbrand',function(){
       var bid = $(this).parent().parent().attr('data-bid');
       $.ajax({
           url:'/ajax-delbrand',
           type:'post',
           data:{bid:bid},
           beforeSend:function(){
                $('.bra-bra-in').empty();
                $('.bra-bra-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
            success:function(data){
                drawBrands();
            }
       });
   });
   $(document).on('click','.delmod',function(){
       var mid = $(this).parent().parent().attr('data-mid');
       var bid = $(this).parent().parent().attr('data-bid');
       $.ajax({
           url:'/ajax-delmod',
           type:'post',
           data:{mid:mid,bid:bid},
           beforeSend:function(){
                $('.bra-mod-in').empty();
                $('.bra-mod-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
            success:function(data){
                drawModels(data);
            }
       });
   });
   $('[name="grupa"]').change(function(){
       var sname = $(this).attr('name');
       var sid = $(this).val();
       
       if(sid!==''){
           $.ajax({
               url:'/ajax-getselforprod',
               type:'post',
               data:{sname:sname,sid:sid},
               success:function(data){
                   $('[name="kategorija"]').html(data);
               }
           });
       }else{
           $('[name="kategorija"]').empty();
           $('[name="potkategorija"]').empty();
       }
   });
   $('[name="kategorija"]').change(function(){
       var sname = $(this).attr('name');
       var sid = $(this).val();
       
       if(sid!==''){
           $.ajax({
               url:'/ajax-getselforprod',
               type:'post',
               data:{sname:sname,sid:sid},
               success:function(data){
                   $('[name="potkategorija"]').html(data);
               }
           });
       }else{
           $('[name="potkategorija"]').empty();
       }
   });
   $('[name="marka"]').change(function(){
       var sname = $(this).attr('name');
       var sid = $(this).val();
       
       if(sid!=='0'){
           $.ajax({
               url:'/ajax-getselforprod',
               type:'post',
               data:{sname:sname,sid:sid},
               success:function(data){
                   $('[name="model"]').html(data);
               }
           });
       }else{
           $('[name="model"]').empty();
       }
   });
   $(document).on('click','.showproddet',function(){
       var spid = $(this).attr('data-spid');
       $('.item-det-'+spid).animate({height:'toggle'});
       $(this).parents('.prod-list-tab').siblings().children('div').hide();
   });
   $(document).on('click','.fa-save',function(){
       var prid = $('[name="prid"]').val();
       var elem = $(this).parent().siblings();
       var key = elem.attr('name');
       var value = elem.val();
       $.ajax({
           url:'/ajax-editprod',
           type:'post',
           data:{key:key,value:value,prid:prid},
           beforeSend:function(){
                elem.val('obrada...');
            },
           success:function(data){
               
                elem.val(data);
           }
       });
   });
   $(document).on('click','.addpics',function(){
       var psid = $(this).attr('data-psid');
       $('#josslika-'+psid).submit();       
       
   });
   $(document).on('submit','.addslike',function(e){
       e.preventDefault();
       var elem = $(this).siblings('.prod-slike-list');
       $.ajax({
           url:'/ajax-addpics',
           type:'post',
           data: new FormData(this),
           contentType: false, 
           cache: false,
           processData:false,
           beforeSend:function(){
               elem.empty();
               elem.html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
           },
           success:function(data){
               elem.empty();
               elem.html(data);
           }
       });
   });
   $(document).on('click','.delimage',function(){
       var elem = $(this);
       var slid = $(this).attr('data-slid');
       var prid = $(this).attr('data-prid');
       
       $.ajax({
           url:'/ajax-delimage',
           type:'post',
           data:{slid:slid,prid:prid},
           beforeSend:function(){
               elem.parent().empty();
               elem.parent().html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
           },
           success:function(data){
               elem.parent().empty();
               elem.parent().html(data);
           }
       });
   });
   $('#filter').click(function(){
       var fname = $(this).siblings('[name="filname"]').val();
       var gru = $(this).siblings('[name="grupa"]').val();
       var kat = $(this).siblings('[name="kategorija"]').val();
       var pot = $(this).siblings('[name="potkategorija"]').val();
       var mar = $(this).siblings('[name="marka"]').val();
       var mod = $(this).siblings('[name="model"]').val();
       
       drawProduct({pro_naziv:fname,pro_grupa_id:gru,pro_kat_id:kat,pro_potkat_id:pot,pro_marka_id:mar,pro_model_id:mod});
       
   });
   
   /*slajder*/
   $('.addslide').click(function(){
       $('#addslide').animate({height:'toggle'},'fast');
   });
   $(document).on('submit','#addslide-form',function(e){
       e.preventDefault();
       $('#addslide').hide();
       
       $.ajax({
           url:'/ajax-addslide',
           type:'post',
           data: new FormData(this),
           contentType: false, 
           cache: false,
           processData:false,
           beforeSend:function(){
               $('.asld-layer').empty();
               $('.asld-layer').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
           },
           success:function(data){
               drawSlider();
           }
       });
   });
   $(document).on('click','.delslajd',function(){
       var slid = $(this).attr('data-slid');
       $.ajax({
           url:'/ajax-delslide',
           type:'post',
           data:{slid:slid},
           beforeSend:function(){
               $('.asld-layer').empty();
               $('.asld-layer').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
           },
           success:function(data){
               drawSlider();
           }
       });
   });
   $(document).on('click','.editslide',function(){
       var sid = $(this).attr('data-sid');
       var elem = $(this).parent().siblings('textarea');
       var key = elem.attr('name');
       var value = elem.val();
       
       $.ajax({
           url:'/ajax-editslide',
           type:'post',
           data:{sid:sid,key:key,value:value},
           beforeSend: function(){
               elem.val('obrada...');
           },
           success:function(data){
               elem.val(data);
           }
       });
   });
   
});
function drawKats(kat){
    $.ajax({
           url:'/ajax-getkat',
           type:'post',
           data:{grid:kat},
           beforeSend:function(){
                $('.kat-kat-in').empty();
                $('.kat-kat-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
           success:function(data){
               $('.kat-kat-in').empty();
               $('.kat-kat-in').html(data);
               $('.kat-pot-in').empty();
           }
       });
}
function drawPots(pot){
    $.ajax({
           url:'/ajax-showpots',
           type:'post',
           data:{kaid:pot},
           beforeSend:function(){
                $('.kat-pot-in').empty();
                $('.kat-pot-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
           success:function(data){
               $('.kat-pot-in').empty();
               $('.kat-pot-in').html(data);
               
           }
       });
}
function drawBrands(){
    $.ajax({
        url:'/ajax-getbrands',
        beforeSend:function(){
                $('.bra-bra-in').empty();
                $('.bra-bra-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
            },
        success:function(data){
            $('.bra-bra-in').empty();
                $('.bra-bra-in').html(data);
                $('.bra-mod-in').empty();
        }
    });
}
function drawModels(bra){
    $.ajax({
        url:'/ajax-getmodels',
        type:'post',
        data:{bra:bra},
        beforeSend:function(){
                $('.bra-mod-in').empty();
                $('.bra-mod-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
        },
        success:function(data){
            $('.bra-mod-in').empty();
            $('.bra-mod-in').html(data);
        }
    });
}
function drawProduct(pod){
    if(null!==pod){
      $.ajax({
        url:'/ajax-drawproduct',
        type:'post',
        data: pod,
        beforeSend:function(){
                $('.prod-list-in').empty();
                $('.prod-list-in').html('<div class="spiner"><i class="fa fa-spinner fa-spin fa-5x"></i></div>');
        },
        success:function(data){
            $('.prod-list-in').empty();
            $('.prod-list-in').html(data);
        }
    });  
    }   else{ 
    $.ajax({
        url:'/ajax-drawproduct',
        success:function(data){
            $('.prod-list-in').empty();
            $('.prod-list-in').html(data);
        }
    });
    }
}
function drawSlider(){
    $.ajax({
        url:'/ajax-drawslider',
        success:function(data){
            $('.asld-layer').empty();
            $('.asld-layer').html(data);
        }
    });
}
