<?php

class Data extends Model{
    public function getKats($g){
        return selection('kategorije', array('kat_grupa_id'=>$g));
    }
    public function getPots($k){
        return selection('potkategorije', array('pot_kat_id'=>$k));
    }
    public function getExtra(){
        $res = q_custom("SELECT * FROM proizvodi ORDER BY RAND() LIMIT 6");
        return $res;
    }
    public function loginAuth($post){
        $res = selection('users',array('use_email'=>$post['email'],'use_password'=>md5($post['password']),'use_role'=>'U'));
        if(count($res)>0){
            session_start();
            session_regenerate_id();
            $_SESSION['USER_ID'] = $res[0]['use_id'];
            $_SESSION['USER_NAME'] = $res[0]['use_ime'];
            $_SESSION['USER_ROLE'] = $res[0]['use_role'];
            header('Location: /korpa');
        }else{
            header('Location: /login/e');
        }
    }
}