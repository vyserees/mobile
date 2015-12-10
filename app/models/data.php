<?php

class Data extends Model{
    public function getKats($g){
        return selection('kategorije', array('kat_grupa_id'=>$g));
    }
    public function getPots($k){
        return selection('potkategorije', array('pot_kat_id'=>$k));
    }
    public function getExtra(){
        $res = q_custom("SELECT * FROM proizvodi ORDER BY RAND() LIMIT 4");
        return $res;
    }
}