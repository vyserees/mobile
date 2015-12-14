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

}
