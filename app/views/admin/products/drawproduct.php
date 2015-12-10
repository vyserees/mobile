<table style="margin-bottom: 15px;width: 98%;font-family: 'opensans-light';">
    <tr>
        <th width="15%" style="text-align: center;">Sifra</th>
        <th width="35%"  style="text-align: center;">Naziv</th>
        <th width="15%" style="text-align: center;">Cena</th> 
        <th width="15%" style="text-align: center;">Grupa</th>
        <th width="5%" style="text-align: center;">Detalji</th>
    </tr>
</table>
    <?php foreach($data as $p){?>
<div class="prod-list-tab item-<?=$p['pro_id']?>">
    <input type="hidden" name="prid" value="<?=$p['pro_id']?>">
    <table class="table table-bordered">
        <tr>
            <td width="15%" style="text-align: center;">
                <div class="input-group">
                    <input type="text" name="esifra" value="<?=$p['pro_sifra']?>" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-save"></i></span>
                </div>
            
            </td>
            <td width="43%">
                <div class="input-group">
                    <input type="text" name="enaziv" value="<?=$p['pro_naziv']?>" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-save"></i></span>
                </div>
            
            </td>
            <td width="15%" style="text-align: right;">
                <div class="input-group">
                    <input type="text" name="ecena" value="<?=$p['pro_cena']?>" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-save"></i></span>
                </div>
            
            </td>
            <td width="15%" style="text-align: center;"><?=ucfirst($p['gru_naziv'])?></td>
            <td width="7%" style="text-align: center;"><i class="fa fa-chevron-down fa-lg showproddet" data-spid="<?=$p['pro_id']?>"></i></td>            
        </tr>
    </table>
    <div class="row item-det-<?=$p['pro_id']?>" hidden="">
        <div class="col-lg-12">
            <label>Slike</label>
            <div class="prod-slike-list">
                <?php 
                $s = selection('slike', array('sli_proizvod_id'=>$p['pro_id']));
                foreach($s as $sl){
                ?>
                <div class="prod-slike-layer">
                    <img src="/assets/images/products/<?=$sl['sli_url']?>" alt="Slika proizvoda" class="img-thumbnails"/>
                    <i class="fa fa-close fa-lg delimage" data-slid="<?=$sl['sli_url']?>" data-prid="<?=$p['pro_id']?>"></i>
                </div>
                <?php }?>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="addslike">
                <div class="col-lg-9">
                    <label>Dodajte jos slika</label>
                    <input type="file" name="josslika[]" class="file josslika" required="" multiple="">
                    <input type="hidden" name="prid" value="<?=$p['pro_id']?>">
                </div>
                <div class="col-lg-2 col-lg-offset-1">
                    <button class="btn btn-primary pull-right" type="submit" style="margin-top:30px;" data-psid="<?=$p['pro_id']?>">SNIMITE SLIKE</button>
                </div>
            </form>
        </div>
        <div class="col-lg-12"><hr></div>
        
        <div class="col-lg-6">
                <label>Opis</label>
            <div class="input-group">
                <textarea class="form-control" name="eopis" rows="6"><?=$p['pro_opis']?></textarea>
                <span class="input-group-addon"><i class="fa fa-save"></i></span>
            </div>
                <label>Meatadesc</label>        
            <div class="input-group">
                <textarea class="form-control" name="emetadesc" rows="6"><?=$p['pro_metadesc']?></textarea>
                <span class="input-group-addon"><i class="fa fa-save"></i></span>
            </div>
                <label>Metakeys</label>        
            <div class="input-group">
                <textarea class="form-control" name="emetakeys" rows="3"><?=$p['pro_metakeys']?></textarea>
                <span class="input-group-addon"><i class="fa fa-save"></i></span>
            </div>
        </div>
        <div class="col-lg-6">
            <label>Ostali podaci</label>
            <table class="table table-bordered">
                <tr>
                    <th>Kategorija</th>
                    <td><?php if(null!==$p['kat_naziv']){echo ucfirst($p['kat_naziv']);}else{echo 'Nema';}?></td>                    
                </tr>
                <tr>
                    <th>Potkategorija</th>
                    <td><?php if(null!==$p['pot_naziv']){echo ucfirst($p['pot_naziv']);}else{echo 'Nema';}?></td>
                </tr>
                <tr>
                    <th>Marka</th>
                    <td><?=ucfirst($p['mar_naziv'])?></td> 
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php if(null!==$p['mod_naziv']){echo ucfirst($p['mod_naziv']);}else{echo 'Nema';}?></td>
                </tr>
            </table>
            <label>Na zalihama?</label>
            <div class="input-group">
                <select name="ezaliha" class="form-control">
                    <option value="Y" <?php if($p['pro_zaliha']==='Y'){echo 'selected="selected"';} ?>>Da</option>
                    <option value="N" <?php if($p['pro_zaliha']==='N'){echo 'selected="selected"';} ?>>Ne</option>
                </select>
                <span class="input-group-addon"><i class="fa fa-save"></i></span>
            </div>
            <div class="well" style="margin-top:20px;text-align: center;">
                <a href="/admin-delprod/<?=$p['pro_id']?>" class="btn btn-danger delprod" onclick="return confirm('Da li ste sigurni da zelite da obrisete proizvod \: <?=$p['pro_naziv']?>?');">OBRISITE PROIZVOD</a>
            </div>
        </div>
        
    </div>
</div>
    <?php }?>
<script>
$(document).ready(function(){
    
    $('.josslika').fileinput({
	showUpload: false,
        maxFileCount: 10,
        allowedFileExtensions: ['jpg']
	//maxFileSize: 800
    });
    
});
</script>