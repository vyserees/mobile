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
        $data = array($np);
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

}
