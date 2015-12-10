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

}
