<?php

class Statistics{
    public function getPrihod($date=null,$gru=null,$cat=null,$brand=null){
        if(null!==$date){return $this->getPrihodByDate($date);}
        if(null!==$gru){return $this->getPrihodByGroup($gru);}
        if(null!==$cat){return $this->getPrihodByCat($cat);}
        if(null!==$brand){return $this->getPrihodByBrand($brand);}
        $res = selection('orders');
        $c=0;$p=0;$sum = array();
        foreach($res as $o){
            $c++;
            $p+=$o['ord_vrednost'];
        }
        $sum['ukupno'] = $p;
        $sum['neto'] = $p-($c*200);
        $sum['put'] = $c*200;
        return $sum;
    }
    private function getPrihodByDate($date){
        $res = selection('orders');
        $c=0;$p=0;$sum = array();
        foreach($res as $o){
            if(date('m-Y',strtotime($o['ord_date']))===$date){
                $c++;
                $p+=$o['ord_vrednost'];
            }
        }
        $sum['ukupno'] = $p;
        $sum['neto'] = $p-($c*200);
        $sum['put'] = $c*200;
        return $sum;
    }
    private function getPrihodByGroup($gru){
        $ret = array();
        $res1 = q_custom("SELECT * FROM proizvodi "
                . "INNER JOIN grupe ON pro_grupa_id=gru_id "
                . "AND pro_grupa_id=".$gru);
        foreach($res1 as $p){
            $res2 = q_custom("SELECT oli_proizvod_id,SUM(oli_kolicina) FROM orderlist WHERE oli_proizvod_id=".$p['pro_id']." GROUP BY oli_proizvod_id");
            array_push($ret,array('ime'=>$p['gru_naziv'],'prihod'=>($p['pro_cena']*$res2[0][1])));
        }
        foreach($ret as $r){
           $sum['ime'] = ucfirst($r['ime']);
           $sum['ukupno'] += $r['prihod']; 
        }
        return $sum;
    }
    private function getPrihodByCat($cat){
        $ret = array();
        $res1 = q_custom("SELECT * FROM proizvodi "
                . "INNER JOIN kategorije ON pro_kat_id=kat_id "
                . "AND pro_kat_id=".$cat);
        foreach($res1 as $p){
            $res2 = q_custom("SELECT oli_proizvod_id,SUM(oli_kolicina) FROM orderlist WHERE oli_proizvod_id=".$p['pro_id']." GROUP BY oli_proizvod_id");
            array_push($ret,array('ime'=>$p['kat_naziv'],'prihod'=>($p['pro_cena']*$res2[0][1])));
        }
        foreach($ret as $r){
            $sum['ime'] = ucfirst($r['ime']);
           $sum['ukupno'] += $r['prihod']; 
        }
        return $sum;
    }
    private function getPrihodByBrand($brand){
        $ret = array();
        $res1 = q_custom("SELECT * FROM proizvodi "
                . "INNER JOIN marke ON pro_marka_id=mar_id "
                . "AND pro_marka_id=".$brand);
        foreach($res1 as $p){
            $res2 = q_custom("SELECT oli_proizvod_id,SUM(oli_kolicina) FROM orderlist WHERE oli_proizvod_id=".$p['pro_id']." GROUP BY oli_proizvod_id");
            array_push($ret,array('ime'=>$p['mar_naziv'],'prihod'=>($p['pro_cena']*$res2[0][1])));
        }
        foreach($ret as $r){
            $sum['ime'] = ucfirst($r['ime']);
           $sum['ukupno'] += $r['prihod']; 
        }
        return $sum;
    }
}