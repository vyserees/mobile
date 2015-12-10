<?php
adm_header();
?>

<div class="col-lg-10">
    <h2 class="adm-title">PROIZVODI</h2>
    <div class="row">
        <div class="col-lg-12">            
            <?php if($data[0]===''){ ?>
            <div class="col-lg-9">
                <div class="prod-list">
                    <a href="/admin-proizvodi/n" class="btn btn-primary btn-lg">NOVI PROIZVOD</a>
                    <hr>
                    <div class="prod-list-in"></div>
                </div>
            </div>
            <div class="col-lg-3 prod-filters">
                <h4>PRETRAGA</h4>
                <div class="prod-filters-in">
                    <label>Po imenu</label>
                    <input type="text" name="filname" class="form-control" placeholder="unesite ime proizvoda">
                    <label>Po grupi</label>
                    <select name="grupa" class="form-control">
                            <option value="0">izaberite grupu</option>
                            <option value="1">Dodatna oprema</option>
                            <option value="2">Futrole</option>
                            <option value="3">Folije</option>
                            <option value="4">Nakit za mobilni</option>
                            <option value="5">Elektronika</option>
                    </select>
                    <label>Po kategoriji</label>
                    <select name="kategorija" class="form-control">                        
                    </select>
                    <label>Po potkategoriji</label>
                    <select name="potkategorija" class="form-control"></select>
                    <label>Po marki</label>
                    <select name="marka" class="form-control">
                        <?php self::view('admin/products/getmodels');?>
                    </select>
                    <label>Po modelu</label>
                    <select name="model" class="form-control"></select>
                    <hr>
                    <button class="btn btn-primary" id="filter">PRETRAŽI</button>
                </div>
            </div>
            <?php }elseif($data[0]==='new'){?>
            <form action="/admin-noviproizvod" method="post" enctype="multipart/form-data">
                <div class="col-lg-7" style="border-right: 1px solid #eee;">
                <div class="col-lg-8">
                    <label>Naziv proizvoda</label>
                    <input type="text" name="naziv" class="form-control" required="">                    
                </div><div class="col-lg-4">
                    <label>Šifra proizvoda</label>
                    <input type="text" name="sifra" class="form-control" required="">
                </div><div class="col-lg-8">
                    <label>Cena</label>
                    <input type="text" name="cena" class="form-control" required="">
                </div><div class="col-lg-4">
                    <label>Na zalihama</label>
                    <select name="zalihe" class="form-control">
                        <option value="Y">Da</option>
                        <option value="N">Ne</option>
                    </select>
                </div>
                    <div class="col-lg-12"><hr></div>
                    <div class="col-lg-6" style="border-right: 1px solid #eee;">
                        <label>Grupa proizvoda</label>
                        <select name="grupa" class="form-control">
                            <option value="0">izaberite grupu</option>
                            <option value="1">Dodatna oprema</option>
                            <option value="2">Futrole</option>
                            <option value="3">Folije</option>
                            <option value="4">Nakit za mobilni</option>
                            <option value="5">Elektronika</option>
                        </select>
                        <label>Kategorija</label>
                        <select name="kategorija" class="form-control"></select>
                        <label>Potkategorija</label>
                        <select name="potkategorija" class="form-control"></select>
                    </div>
                    <div class="col-lg-6">
                        <label>Marka telefona</label>
                        <select name="marka" class="form-control"><?php self::view('admin/products/getmodels'); ?></select>
                        <label>Model marke telefona</label>
                        <select name="model" class="form-control"></select>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <label>Slike - možete dodati više slika odjednom</label>
                        <input type="file" name="slike[]" id="slike" class="file" multiple="" required="">
                    </div>
                
            </div>
            <div class="col-lg-5" style="padding: 0px 30px;">
                <label>Opis</label>
                <textarea name="opis" rows="6" class="form-control" required=""></textarea>            
                <label>Meta keywords</label>
                <textarea name="metakeys" rows="3" class="form-control" required=""></textarea>
                <label>Meta description</label>
                <textarea name="metadesc" rows="6" class="form-control" required=""></textarea>
            </div>
                <div class="col-lg-12" style="text-align: center;"> 
                    <hr>
                    <input type="submit" value="SNIMI NOVI PROIZVOD" class="btn btn-primary">
                </div>
            </form>
            <?php }?>
        </div>
        
    </div>
</div>
<script>
$(document).ready(function(){
    drawProduct(null);
    $('#slike').fileinput({
	showUpload: false,
        maxFileCount: 10,
        allowedFileExtensions: ['jpg']
	//maxFileSize: 800
    });
    $('.josslika').fileinput({
	showUpload: false,
        maxFileCount: 10,
        allowedFileExtensions: ['jpg']
	//maxFileSize: 800
    });
    
});
</script>
<?php
adm_footer();
