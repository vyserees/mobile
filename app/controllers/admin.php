<?php

class Admin extends Controller{
    public function index($s=null){
        if(null!==$s){
            $data = $s;
        }else{
            $data = '';
        }
        self::view('admin/index',$data);
    }
    public function adminLogin(){
        if(null!==  filter_input_array(INPUT_POST)){
            $post = filter_input_array(INPUT_POST);
            $s = self::model('dashboard')->adminAuth($post);
            if($s!=='e'){
                header('Location: /admin-pocetna');
            }else{
                header('Location: /admin/e');
            }
        }else{
            header('Location: /error');
        }
    }
    public function adminLogout(){
        header('Location: /admin');
    }

    public function main(){
        
        self::view('admin/main');
    }
    public function products($pid=null){
        $data = self::model('dashboard')->getProducts($pid);
        self::view('admin/products/index',$data);
    }
    public function addNew(){
        if(null!==  filter_input_array(INPUT_POST)){
            $post = filter_input_array(INPUT_POST);
            self::model('dashboard')->addProd($post);
            header('Location: /admin-proizvodi');
        }else{
            header('Location: /error');
        }
    }

    public function groups(){
        $data = self::model('dashboard')->getGroups();
        self::view('admin/options/index',$data);
    }
    public function brands(){
        self::view('admin/brands/index');
    }
    public function delprod($prid){
        self::model('dashboard')->delProd($prid);
        header('Location: /admin-proizvodi');
    }
    public function slider(){
        self::view('admin/slider');
    }
}

