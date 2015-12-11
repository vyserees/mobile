<?php

class Ajax extends Controller{
    public function index(){
        
    }
    
    public function drawProd(){
        $where = "";
        if(null!==filter_input_array(INPUT_POST)){
            $where .= "WHERE ";
            $post = filter_input_array(INPUT_POST);
            $keys = array_keys($post);
            foreach($keys as $key){
                if($key==='pro_naziv'&&$post[$key]!==''){
                    $where .= "proizvodi.pro_naziv LIKE '".$post[$key]."%' AND ";
                }elseif(null!==$post[$key]&&$post[$key]>0){
                    $where .= "proizvodi.".$key."=".$post[$key]." AND ";
                }
            }
            $where = substr($where, 0, -4);
        }
        $res = q_custom("SELECT * FROM proizvodi "
                . "LEFT JOIN grupe ON gru_id=pro_grupa_id "
                . "LEFT JOIN kategorije ON kat_id=pro_kat_id "
                . "LEFT JOIN potkategorije ON pot_id=pro_potkat_id "
                . "LEFT JOIN marke ON mar_id=pro_marka_id "
                . "LEFT JOIN modeli ON mod_id=pro_model_id ".$where);
        $data = $res;
        
        self::view('admin/products/drawproduct',$data);
        
        //var_dump($where);
    }
    public function setFilters(){
        $post = filter_input_array(INPUT_POST);
        $fid = json_decode($post['fid']);
        $poz = json_decode($post['poz']);
        
        $q = new Model();
        $ex = $q->prepare("UPDATE filteri SET fil_pozicija=0");
        $ex->execute();
        
        for($i=0;$i<count($fid);$i++){
            updating('filteri', array('fil_karakteristika_id'=>$fid[$i]), array('fil_karakteristika_id'=>$fid[$i],'fil_pozicija'=>$poz[$i]));
        }
        
        echo '<p class="filt-msg" style="color:#fff;background:#669900;">Uspešno ste izmenili postavku filtera!</p>';
    }
    public function editProd(){
        $post = filter_input_array(INPUT_POST);
        $prid = $post['prid'];
        $vred = $post['value'];
        $key = substr($post['key'],1);              
        
        if($key==='enaziv'){
            updating('proizvodi', array('pro_id'=>$prid), array('pro_id'=>$prid,'pro_naziv'=>$vred, 'pro_slug'=>slugging($vred)));
        }else{        
            updating('proizvodi', array('pro_id'=>$prid), array('pro_id'=>$prid,'pro_'.$key=>$vred));          
        }
      
        echo $vred;
    }
    public function reloadList(){
        echo self::view('admin/products/plist');
    }
    public function delImage(){
        $post = filter_input_array(INPUT_POST);
        deleting('slike', array('sli_url'=>$post['slid']));
        unlink('assets/images/products/'.$post['slid']);
        
        $res = selection('slike', array('sli_proizvod_id'=>$post['prid']), array('sli_id'), 'DESC');
        $str = '';
        foreach($res as $sl){
            $str .= '<div class="prod-slike-layer">
                    <img src="/assets/images/products/'.$sl['sli_url'].'" alt="Slika proizvoda" class="img-thumbnails"/>
                    <i class="fa fa-close fa-lg delimage" data-slid="'.$sl['sli_url'].'" data-prid="'.$post['prid'].'"></i>
                </div>';
        }
        
        echo $str;
    }
    public function addPics(){
        $post = filter_input_array(INPUT_POST);
        for($i=0; $i<count($_FILES["josslika"]["name"]); $i++){
            $file = date('dmY').rand(1111,9999).$_FILES["josslika"]["name"][$i];
            move_uploaded_file($_FILES["josslika"]["tmp_name"][$i], 'assets/images/products/'.$file);
            
            $slid = inserting('slike', array('sli_proizvod_id'=>$post['prid'],'sli_url'=>$file));
            $tgfile = 'assets/images/products/'.$file;
            imageResize($tgfile, '800', '600', $tgfile, 'crop', '100');
        }
        $res = selection('slike', array('sli_proizvod_id'=>$post['prid']), array('sli_id'), 'DESC');
        $str = '';
        foreach($res as $sl){
            $str .= '<div class="prod-slike-layer">
                    <img src="/assets/images/products/'.$sl['sli_url'].'" alt="Slika proizvoda" class="img-thumbnails"/>
                    <i class="fa fa-close fa-lg delimage" data-slid="'.$sl['sli_url'].'"></i>
                </div>';
        }
        
        echo $str;
    }
    /*-------------nove--------------*/
    public function getKat(){
        $grid = filter_input(INPUT_POST, 'grid');
        $res = selection('kategorije', array('kat_grupa_id'=>$grid), array('kat_naziv'));
        $str = '<div class="input-group" style="margin-bottom:10px;">'
                . '<input type="hidden" name="katgrid" value="'.$grid.'">'
                . '<input type="text" name="naziv" class="form-control" placeholder="dodajte novu kategoriju" required="">'
                . '<span class="input-group-addon"><i class="fa fa-save fa-lg addkat"></i></span>'
                . '</div>'
                ;
        foreach($res as $k){
            $str .= '<p class="kat-tab kat-kat" data-gkid="'.$grid.'" data-kid="'.$k['kat_id'].'">';
            $str .= ucfirst($k['kat_naziv']);
            $str .= '<span class="pull-right" title="Prikazi potkategorije"><i class="fa fa-chevron-right fa-lg getpots"></i></span>';
            $str .= '<span class="pull-right" title="Obrisite kategoriju"><i class="fa fa-minus fa-lg delkat" onclick="return confirm(\'Da li ste sigurni da zelite da obrisete ovu kategoriju?\');"></i></span>';
            $str .= '</p>';
        }
        
        echo $str;
    }
    public function addKat(){
        $post = filter_input_array(INPUT_POST);
        $katgrid = $post['katgrid'];
        $kslug = slugging($post['kname']);
        $a = inserting('kategorije', array(
            'kat_naziv'=>$post['kname'],
            'kat_slug'=>$kslug,
            'kat_grupa_id'=>$katgrid
        ));
        echo $katgrid;
    }
    public function delKat(){
        $post = filter_input_array(INPUT_POST);
        deleting('kategorije', array('kat_id'=>$post['kid']));
        echo $post['gkid'];
    }
    public function getPots(){
        $kaid = filter_input(INPUT_POST, 'kaid');
        $res = selection('potkategorije', array('pot_kat_id'=>$kaid), array('pot_naziv'));
        
        $str = '<div class="input-group" style="margin-bottom:10px;">'
                . '<input type="hidden" name="kpid" value="'.$kaid.'">'
                . '<input type="text" name="naziv" class="form-control" placeholder="dodajte novu potkategoriju" required="">'
                . '<span class="input-group-addon"><i class="fa fa-save fa-lg addpot"></i></span>'
                . '</div>'
                ;
        foreach($res as $p){
            $str .= '<p class="kat-tab kat-pot" data-kpot="'.$kaid.'" data-poid="'.$p['pot_id'].'">';
            $str .= ucfirst($p['pot_naziv']);
            $str .= '<span class="pull-right" title="Obrisite potkategoriju"><i class="fa fa-minus fa-lg delpot" onclick="return confirm(\'Da li ste sigurni da zelite da obrisete ovu potkategoriju?\');"></i></span>';
            $str .= '</p>';
        }
        
        echo $str;
    }
    public function addPot(){
        $post = filter_input_array(INPUT_POST);
        $kpid = $post['kpid'];
        $pslug = slugging($post['pname']);
        $a = inserting('potkategorije', array(
            'pot_naziv'=>$post['pname'],
            'pot_slug'=>$pslug,
            'pot_kat_id'=>$kpid
        ));
        echo $kpid;
    }
    public function delPot(){
        $post = filter_input_array(INPUT_POST);
        deleting('potkategorije', array('pot_id'=>$post['poid']));
        echo $post['kpot'];
    }
    
    public function getBrands(){
        $res = selection('marke', null, array('mar_naziv'));
        $str = '<div class="input-group" style="margin-bottom:10px;">'
                . '<input type="text" name="naziv" class="form-control" placeholder="dodajte novu marku" required="">'
                . '<span class="input-group-addon"><i class="fa fa-save fa-lg addbrand"></i></span>'
                . '</div>'
                ;
                foreach ($res as $b){
                    $str .= '<p class="kat-tab bra-bra" data-bid="'.$b['mar_id'].'">';
                    $str .= ucfirst($b['mar_naziv']);
                    $str .= '<span class="pull-right" title="Prikazi modele"><i class="fa fa-chevron-right fa-lg getmod"></i></span>';
                    $str .= '<span class="pull-right" title="Obrisite marku"><i class="fa fa-minus fa-lg delbrand" onclick="return confirm(\'Da li ste sigurni da zelite da obrisete ovu marku?\');"></i></span>';
                    $str .= '</p>'; 
                }
                echo $str;
    }
    public function getModels(){
        $bid = filter_input(INPUT_POST, 'bra');
        $res = selection('modeli', array('mod_marka_id'=>$bid), array('mod_naziv'));
        
        $str = '<div class="input-group" style="margin-bottom:10px;">'
                . '<input type="hidden" name="bid" value="'.$bid.'">'
                . '<input type="text" name="naziv" class="form-control" placeholder="dodajte novi model" required="">'
                . '<span class="input-group-addon"><i class="fa fa-save fa-lg addmod"></i></span>'
                . '</div>'
                ;
                foreach ($res as $m){
                    $str .= '<p class="kat-tab bra-mod" data-bid="'.$m['mod_marka_id'].'" data-mid="'.$m['mod_id'].'">';
                    $str .= ucfirst($m['mod_naziv']);
                    $str .= '<span class="pull-right" title="Obrisite marku"><i class="fa fa-minus fa-lg delmod" onclick="return confirm(\'Da li ste sigurni da zelite da obrisete ovaj model?\');"></i></span>';
                    $str .= '</p>'; 
                }
                echo $str;
    }
    public function addBrand(){
        $bname = filter_input(INPUT_POST, 'bname');
        $bslug = slugging($bname);
        $bid = inserting('marke', array('mar_naziv'=>$bname,'mar_slug'=>$bslug));
        echo $bid;
    }
    public function addMod(){
        $post = filter_input_array(INPUT_POST);
        $lbid = inserting('modeli', array(
            'mod_naziv'=>$post['mname'],
            'mod_slug'=>  slugging($post['mname']),
            'mod_marka_id'=>$post['bid']
        ));
        echo $post['bid'];
        
    }
    public function delBrand(){
        $bid = filter_input(INPUT_POST, 'bid');
        deleting('marke', array('mar_id'=>$bid));
        deleting('modeli', array('mod_marka_id'=>$bid));
        echo '';
    }
    public function delMod(){
        $post = filter_input_array(INPUT_POST);
        deleting('modeli', array('mod_id'=>$post['mid']));
        echo $post['bid'];
    }
    public function getSelectionForProducts(){
        $name = filter_input(INPUT_POST, 'sname');
        $id = filter_input(INPUT_POST, 'sid');
        
        if($name==='grupa'){
            $res = selection('kategorije', array('kat_grupa_id'=>$id), array('kat_naziv'));
            $str = '<option value="0">izaberite kategoriju</option>';
            foreach ($res as $k){
                $str .= '<option value="'.$k['kat_id'].'">'.ucfirst($k['kat_naziv']).'</option>';
            }
        }
        if($name==='kategorija'){
            $res = selection('potkategorije', array('pot_kat_id'=>$id), array('pot_naziv'));
            $str = '<option value="0">izaberite potkategoriju</option>';
            foreach ($res as $k){
                $str .= '<option value="'.$k['pot_id'].'">'.ucfirst($k['pot_naziv']).'</option>';
            }
        }
        if($name==='marka'){
            $res = selection('modeli', array('mod_marka_id'=>$id), array('mod_naziv'));
            $str = '<option value="0">izaberite model</option>';
            foreach ($res as $k){
                $str .= '<option value="'.$k['mod_id'].'">'.ucfirst($k['mod_naziv']).'</option>';
            }
        }
        
        echo $str;
    }
    public function deleteProd(){
        $prid = filter_input(INPUT_POST, 'prid');
        $sl = selection('slike', array('sli_proizvod_id'=>$prid));
        deleting('slike', array('sli_proizvod_id'=>$prid));
        foreach($sl as $s){
            unlink('assets/images/products/'+$s['sli_url']);
        }
        deleting('proizvodi', array('pro_id'=>$prid));
        header('Location: /admin-prizvodi');
     }
     public function drawSlider(){
         $str = '<div id="addslide" hidden="">
                <form action="" id="addslide-form" enctype="multipart/form-data">
                    <label>Slika</label>
                    <input type="file" name="image" class="file" id="slajd" required="">
                    <label>Naslov</label>
                    <textarea class="form-control" name="title" rows="4"></textarea>
                    <label>Podnaslov</label>
                    <textarea class="form-control" name="subtitle" rows="4"></textarea>
                    <label>Opis</label>
                    <textarea class="form-control" name="caption" rows="4"></textarea>
                    <hr>
                    <input type="submit" value="SNIMITE SLAJD" class="btn btn-primary">
                </form>
                <script>
    $(document).ready(function(){
        $("#slajd").fileinput({
            showUpload: false,
            maxFileCount: 1,
            allowedFileExtensions: ["jpg"]
            //maxFileSize: 800
        });
    });
</script>
            </div>';
         $sl = selection('slider');
         foreach($sl as $s){
             $str .= '<div class="prod-list-tab">'
                     . '<table class="table table-bordered">'
                     . '<tr>'
                     . '<td width="15%"><img src="/assets/images/sliders/'.$s['sld_image'].'" alt="Slajd" style="width:125px;height:100px" /></td>'
                     . '<td width="25%"><label>Naslov</label><div class="input-group"><textarea class="form-control" name="title" rows="3">'.$s['sld_title'].'</textarea><span class="input-group-addon"><i class="fa fa-edit editslide" data-sid="'.$s['sld_id'].'"></i></span></div></td>'
                     . '<td width="25%"><label>Podnaslov</label><div class="input-group"><textarea class="form-control" name="subtitle" rows="3">'.$s['sld_subtitle'].'</textarea><span class="input-group-addon"><i class="fa fa-edit editslide" data-sid="'.$s['sld_id'].'"></i></span></div></td>'
                     . '<td width="25%"><label>Opis</label><div class="input-group"><textarea class="form-control" name="caption" rows="3">'.$s['sld_caption'].'</textarea><span class="input-group-addon"><i class="fa fa-edit editslide" data-sid="'.$s['sld_id'].'"></i></span></div></td>'
                     . '<td width="10%"><button onclick="return confirm(\'Da li ste sigurni da zelite da obrisete ovaj slajd?\');" class="btn btn-danger btn-lg delslajd" data-slid="'.$s['sld_image'].'"><i class="fa fa-trash-o fa-lg"></i></button></td>'
                     . '</tr>'
                     . '</table>'
                     . '</div>';
         }
         echo $str;
     }
     public function addSlide(){
        $post = filter_input_array(INPUT_POST);
         
        $file = rand(1111,9999).$_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], 'assets/images/sliders/'.$file);
        
        $tgfile = 'assets/images/sliders/'.$file;
        imageResize($tgfile, '800', '400', $tgfile, 'crop', '100');
        
        $a = inserting('slider', array(
            'sld_naziv'=>'slajder',
            'sld_title'=>$post['title'],
            'sld_subtitle'=>$post['subtitle'],
            'sld_caption'=>$post['caption'],
            'sld_image'=>$file
        ));
        
     }
     public function delSlide(){
         $slid = filter_input(INPUT_POST, 'slid');
         deleting('slider', array('sld_image'=>$slid));
         unlink('assets/images/sliders/'.$slid);
    }
    public function editSlide(){
        $post = filter_input_array(INPUT_POST);
        
        updating('slider', array('sld_id'=>$post['sid']), array('sld_id'=>$post['sid'],'sld_'.$post['key']=>$post['value']));
        echo $post['value'];
    }
    public function drawList(){
        $post = filter_input_array(INPUT_POST);
        $where = array();
        switch($post['sort']){
            case 'cena+':
                $order = array('pro_cena');
                $ad = 'DESC';
                break;
            case 'cena-':
                $order = array('pro_cena');
                $ad = 'ASC';
                break;
            case 'old':
                $order = array('pro_id');
                $ad = 'ASC';
                break;
            default :
                $order = array('pro_id');
                $ad = 'DESC';
        }
        if($post['grupa']!==''){$where['pro_grupa_id']=$post['grupa'];}
        if($post['kat']!==''){$where['pro_kat_id']=$post['kat'];}
        if($post['potkat']!==''){$where['pro_potkat_id']=$post['potkat'];}
        if($post['marka']!==''){$where['pro_marka_id']=$post['marka'];}
        if($post['model']!==''){$where['pro_model_id']=$post['model'];}
        $data = selection('proizvodi', $where, $order, $ad);
        self::view('proizvodi/listsingl',$data); 
        
    }
    public function drawListMarka(){
        $post = filter_input_array(INPUT_POST);
        $where = array();
        $mar = array();
        $str = '<ul>';
        if($post['grupa']!==''){$where['pro_grupa_id']=$post['grupa'];}
        if($post['kat']!==''){$where['pro_kat_id']=$post['kat'];}
        if($post['potkat']!==''){$where['pro_potkat_id']=$post['potkat'];}
        if($post['marka']!==''){$where['pro_marka_id']=$post['marka'];}
        
        $resm = selection('proizvodi', $where);
        foreach ($resm as $m){
            array_push($mar, $m['pro_marka_id']);
        }
        $marks = array_unique($mar);
        foreach($marks as $ma){            
            $where['pro_marka_id']=$ma;
            $q = new Query();
            $q->where = $where;
            $resp = $q->inner_join('proizvodi', 'marke', array('pro_marka_id','mar_id'));
            $mc = count($resp);
            $str .= '<li class="filbrand" data-mrid="'.$resp[0]['mar_id'].'">'.ucfirst($resp[0]['mar_naziv']).' ('.$mc.')</li>';
        }
        $str .= '</ul>';
        
        //var_dump($marks);
        echo $str;
    }
    public function drawListModel(){
        $post = filter_input_array(INPUT_POST);
        $where = array();
        $mod = array();
        $str = '<ul>';
        if($post['grupa']!==''){$where['pro_grupa_id']=$post['grupa'];}
        if($post['kat']!==''){$where['pro_kat_id']=$post['kat'];}
        if($post['potkat']!==''){$where['pro_potkat_id']=$post['potkat'];}
        if($post['marka']!==''){$where['pro_marka_id']=$post['marka'];}
        if($post['model']!==''){$where['pro_model_id']=$post['model'];}
        
        $resm = selection('proizvodi', $where);
        foreach ($resm as $m){
            array_push($mod, $m['pro_model_id']);
        }
        $mods = array_unique($mod);
        foreach($mods as $ma){            
            $where['pro_model_id']=$ma;
            $q = new Query();
            $q->where = $where;
            $resp = $q->inner_join('proizvodi', 'modeli', array('pro_model_id','mod_id'));
            $mc = count($resp);
            $str .= '<li class="filmodel" data-mrid="'.$resp[0]['mod_marka_id'].'" data-moid="'.$resp[0]['mod_id'].'">'.ucfirst($resp[0]['mod_naziv']).' ('.$mc.')</li>';
        }
        $str .= '</ul>';
        
        //var_dump($marks);
        echo $str;
    }
    public function drawBredkramb(){
        $post = filter_input_array(INPUT_POST);
        $str = '<ul>';
        if($post['grupa']!==''){
            $gru = selection('grupe', array('gru_id'=>$post['grupa']));
            $str .= '<li>'.ucfirst($gru[0]['gru_naziv']).'</li>';
        }
        if($post['kat']!==''){
            $kat = selection('kategorije', array('kat_id'=>$post['kat']));
            $str .= '<li>'.ucfirst($kat[0]['kat_naziv']).''
                    . '<span class="rfkat"><i class="fa fa-power-off" title="Uklonite filter"></i></span></li>';
        }
        if($post['potkat']!==''){
            $pot = selection('potkategorije', array('pot_id'=>$post['potkat']));
            
        }
        if($post['marka']!==''){
            $mar = selection('marke', array('mar_id'=>$post['marka']));
            $str .= '<li>'.ucfirst($mar[0]['mar_naziv']).''
                    . '<span class="rfmarka"><i class="fa fa-power-off" title="Uklonite filter"></i></span></li>';
        }
        if($post['model']!==''){
            $mod = selection('modeli', array('mod_id'=>$post['model']));
            $str .= '<li>'.ucfirst($mod[0]['mod_naziv']).''
                    . '<span class="rfmodel"><i class="fa fa-power-off" title="Uklonite filter"></i></span></li>';
        }
        $str .= '</ul>';
        
        echo $str;
        
    }
    public function addToCart(){
        $id = filter_input(INPUT_POST, 'id');
        $res = q_custom("SELECT * FROM proizvodi INNER JOIN slike ON sli_proizvod_id=pro_id AND pro_id=".$id);
        echo json_encode($res[0]);
    }
    public function drawShoppingCart(){
        $post = filter_input_array(INPUT_POST);
        $data = $post['sc'];
        self::view('kupovina/drawcart',$data);
    }
    public function insertOrder(){
        $post = filter_input_array(INPUT_POST);
        $lid = inserting('orders',array(
            'ord_number'=>$post['number'],
            'ord_name'=>$post['ime'],
            'ord_address'=>$post['adresa'],
            'ord_city'=>$post['grad'],
            'ord_postcode'=>$post['posta'],
            'ord_phone'=>$post['telefon'],
            'ord_placanje'=>$post['nacinplacanja'],
            'ord_vrednost'=>$post['vrednost']
        ));
        echo $lid;
    }
    public function insertOrderList(){
        $post = filter_input_array(INPUT_POST);
        $data = $post['lista'];
        foreach($data as $d){
            $a = inserting('orderlist',array(
                'oli_order_id'=>$d['oid'],
                'oli_proizvod_id'=>$d['pid'],
                'oli_kolicina'=>$d['kolicina']
            ));
        }
        
    }
}
