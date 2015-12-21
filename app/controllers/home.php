<?php

class Home extends Controller {

    public function index() {
        $data = self::model('data')->getExtra();
        self::view('home/index',$data);
    }

    public function proizvodi($a=null){
        self::view('proizvodi/list');
    }
    public function korpa(){
        self::view('kupovina/korpa');
    }
    public function potvrdakupovine($np){
        $pl = explode('-', $np);
        $res = self::model('data')->getConfOrder($pl[1]);
        $data = array($pl[0],$res);
        self::view('kupovina/potvrda',$data);
    }
    public function proizvod($pid){
        self::view('kupovina/proizvod/index');
    }
    public function login($s=null){
        if(null!==$s){
            $data = $s;
        }else{
            $data = '';
        }
        self::view('korisnici/index',$data);
    }
    public function loginAuth(){
        $post = filter_input_array(INPUT_POST);
        self::model('data')->loginAuth($post);
    }
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
    }
    public function registracija($s=null){
        if(null!==$s){
            $data = $s;
        }else{
            $data = '';
        }
        self::view('korisnici/reg',$data);
    }
    public function processReg(){
        $post = filter_input_array(INPUT_POST);
        self::model('data')->processReg($post);
    }
    public function confirmReg(){
        self::view('korisnici/confirmreg');
    }
    public function info($page,$msg=null){
        if(null!==$msg){
            $data = $msg;
            self::view('info/'.$page,$data);
        }else{
            self::view('info/'.$page);
        }
    }
    public function procesKontakt(){
        $post = filter_input_array(INPUT_POST);
        $msg = '<h3>Poruka od '.$post['ime'].' :</h3><p>'.$post['msg'].'</p>';
        email('vyserees@gmail.com',$post['email'],$post['subject'],$msg);
        header('Location: /info/kontakt/s');
    }

}
