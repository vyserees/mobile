<?php

class Dashboard extends Model{
    public function adminAuth($post){
        $res = selection('users', array('use_email'=>$post['email'],'use_password'=>md5($post['password']),'use_role'=>'A'));
        if(count($res)>0){
            header('Location: /admin-pocetna');
        }else{
            return 'e';
        }
    }
    
    public function getProducts($pid){
        if(null===$pid){
            $s = '';
            $res = selection('proizvodi',null,array('pro_id'),'DESC');
        }elseif(null!==$pid&&$pid==='n'){
            $s = 'new';
        }else{
            $s = 'edit';
            $res = $pid;
        }
        return array($s, $res);
    }
    public function addProd($post){
        $lid = inserting('proizvodi', array(
            'pro_sifra'=>$post['sifra'],
            'pro_naziv'=>$post['naziv'],
            'pro_slug'=>  slugging($post['naziv']),
            'pro_cena'=>$post['cena'],
            'pro_grupa_id'=>$post['grupa'],
            'pro_kat_id'=>$post['kategorija'],
            'pro_potkat_id'=>$post['potkategorija'],
            'pro_marka_id'=>$post['marka'],
            'pro_model_id'=>$post['model'],
            'pro_opis'=>$post['opis'],
            'pro_metakeys'=>$post['metakeys'],
            'pro_metadesc'=>$post['metadesc']
        ));       
        
        for($i=0; $i<count($_FILES["slike"]["name"]); $i++){
            $file = date('dmY').rand(1111,9999).$_FILES["slike"]["name"][$i];
            move_uploaded_file($_FILES["slike"]["tmp_name"][$i], 'assets/images/products/'.$file);
            
            $slid = inserting('slike', array('sli_proizvod_id'=>$lid,'sli_url'=>$file));
            $tgfile = 'assets/images/products/'.$file;
            imageResize($tgfile, '800', '600', $tgfile, 'crop', '100');
        }
               
    }
    public function getGroups(){
        $res = selection('grupe', null, array('gru_naziv'));
        return $res;
    }
    public function delProd($prid){
        $sl = selection('slike', array('sli_proizvod_id'=>$prid));
        deleting('slike', array('sli_proizvod_id'=>$prid));
        foreach($sl as $s){
            unlink('assets/images/products/'.$s['sli_url']);
        }
        deleting('proizvodi', array('pro_id'=>$prid));
    }
    public function getAllOrders(){
        $res = array('orders'=>array(),'list'=>array());
        $res['orders'] = selection('orders',null,array('ord_id'),'DESC');
        foreach($res['orders'] as $o){
            $resol = q_custom("SELECT * FROM orderlist "
                    . "INNER JOIN proizvodi ON pro_id=oli_proizvod_id "
                    . "AND oli_order_id=".$o['ord_id']);
            array_push($res['list'], $resol);
        }
        return $res;
    }
    public function getFilteredOrders($s){
        $search = explode('=', $s);
        if($search[0]==='pobroju'){$where=" WHERE ord_number='".$search[1]."'";}
        if($search[0]==='poimenu'){$where=" WHERE ord_name='".$search[1]."'";}
        if($search[0]==='postatusu'){
            $s1 = explode('-', $search[1]);
            $where = " WHERE ord_paid='".$s1[0]."' AND ord_status='".$s1[1]."'";
        }
        $res = array('orders'=>array(),'list'=>array());
        $res['orders'] = q_custom("SELECT * FROM orders".$where." ORDER BY ord_id DESC");
        foreach($res['orders'] as $o){
            $resol = q_custom("SELECT * FROM orderlist "
                    . "INNER JOIN proizvodi ON pro_id=oli_proizvod_id "
                    . "AND oli_order_id=".$o['ord_id']);
            array_push($res['list'], $resol);
        }
        return $res;
    }
}
