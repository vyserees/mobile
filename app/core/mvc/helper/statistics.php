<?php

class Statistics{
    public function getTotalPrihod($date=null){        
        $res = selection('orders',array('ord_paid'=>'C'));
        $c=0;$p=0;$sum = array();
        foreach($res as $o){
            if((null===$date)||(null!==$date&&date('Y-m',strtotime($o['ord_date']))===$date)){
                $c++;
                $p+=$o['ord_vrednost'];
            }
        }
        $sum['ukupno'] = $p;
        $sum['neto'] = $p-($c*200);
        $sum['put'] = $c*200;
        return $sum;
    }
    public function getKeyPrihod($type,$key,$date=null){
        if($key==='grupa'){
            $keys = selection('grupe');
            $ret = array();
        
            foreach($keys as $k){                
                $res = selection('proizvodi',array('pro_grupa_id'=>$k['gru_id']));
                $p = $this->calcVals($type,$res,$date);
                $ret[ucfirst($k['gru_naziv'])] = $p;
            }
         
            return $ret;
        }
        if($key==='marka'){
            $keys = selection('marke');
            $ret = array();
        
            foreach($keys as $k){                
                $res = selection('proizvodi',array('pro_marka_id'=>$k['mar_id']));
                $p = $this->calcVals($type,$res,$date);
                $ret[ucfirst($k['mar_naziv'])] = $p;
            }
         
            return $ret;
        }
        if($key==='kat'){
            $keys = selection('kategorije');
            $ret = array();
        
            foreach($keys as $k){                
                $res = selection('proizvodi',array('pro_kat_id'=>$k['kat_id']));
                $p = $this->calcVals($type,$res,$date);
                $ret[ucfirst($k['kat_naziv'])] = $p;
            }
         
            return $ret;
        }
    }
    private function calcVals($type,$vals,$date=null){
        $p = 0;
        foreach($vals as $v){
            $res2 = q_custom("SELECT oli_proizvod_id,oli_order_id,SUM(oli_kolicina),ord_date,ord_paid FROM orderlist "
                . "INNER JOIN orders ON oli_order_id=ord_id "
                . "AND oli_proizvod_id=".$v['pro_id']." AND ord_paid='C'");
            if((null===$date)||(null!==$date&&date('Y-m',strtotime($res2[0]['ord_date']))===$date)){
                if($type==='sum'){
                    $p += $v['pro_cena']*$res2[0][2];
                }elseif($type==='kom'){
                    $p += $res2[0][2];
                }
            }
        }
        return $p;
    }
    
}