<?php

$routes = array(
	'pocetna' => array(
		'controller' => 'home',
		'method' => 'index'
		),
    'error'=>array('controller'=>'error','method'=>'index'),
    'admin'=>array('controller'=>'admin', 'method'=>'index'),
    'admin-login'=>array('controller'=>'admin','method'=>'adminLogin'),
    'admin-logout'=>array('controller'=>'admin','method'=>'adminLogout'),
    'admin-pocetna'=>array('controller'=>'admin','method'=>'main'),
    'admin-proizvodi'=>array('controller'=>'admin','method'=>'products'),
    'admin-noviproizvod'=>array('controller'=>'admin','method'=>'addNew'),
    'admin-kategorije'=>array('controller'=>'admin','method'=>'groups'),
    'admin-modeli'=>array('controller'=>'admin','method'=>'brands'),
    'admin-delprod'=>array('controller'=>'admin','method'=>'delprod'),
    'admin-slider'=>array('controller'=>'admin','method'=>'slider'),
    'proizvodi'=>array('controller'=>'home','method'=>'proizvodi'),
    'korpa'=>array('controller'=>'home','method'=>'korpa'),
    
    
    /*---ajax routes---*/
    'ajax-getkat'=>array('controller'=>'ajax','method'=>'getKat'),
    'ajax-addkat'=>array('controller'=>'ajax','method'=>'addKat'),
    'ajax-delkat'=>array('controller'=>'ajax','method'=>'delKat'),
    'ajax-showpots'=>array('controller'=>'ajax','method'=>'getPots'),
    'ajax-addpot'=>array('controller'=>'ajax','method'=>'addPot'),
    'ajax-delpot'=>array('controller'=>'ajax','method'=>'delPot'),
    'ajax-getbrands'=>array('controller'=>'ajax','method'=>'getBrands'),
    'ajax-getmodels'=>array('controller'=>'ajax','method'=>'getModels'),
    'ajax-addbrand'=>array('controller'=>'ajax','method'=>'addBrand'),
    'ajax-addmod'=>array('controller'=>'ajax','method'=>'addMod'),
    'ajax-delbrand'=>array('controller'=>'ajax','method'=>'delBrand'),
    'ajax-delmod'=>array('controller'=>'ajax','method'=>'delMod'),
    'ajax-getselforprod'=>array('controller'=>'ajax','method'=>'getSelectionForProducts'),
    'ajax-drawslider'=>array('controller'=>'ajax','method'=>'drawSlider'),
    'ajax-addslide'=>array('controller'=>'ajax','method'=>'addSlide'),
    'ajax-delslide'=>array('controller'=>'ajax','method'=>'delSlide'),
    'ajax-editslide'=>array('controller'=>'ajax','method'=>'editSlide'),
    'ajax-drawlist'=>array('controller'=>'ajax','method'=>'drawList'),
    'ajax-drawlistmarka'=>array('controller'=>'ajax','method'=>'drawListMarka'),
    'ajax-drawlistmodel'=>array('controller'=>'ajax','method'=>'drawListModel'),
    'ajax-drawbredkramb'=>array('controller'=>'ajax','method'=>'drawBredkramb'),
    'ajax-addtocart'=>array('controller'=>'ajax','method'=>'addToCart'),
    'ajax-drawshoppingcart'=>array('controller'=>'ajax','method'=>'drawShoppingCart'),
    
    'ajax-drawproduct'=>array('controller'=>'ajax','method'=>'drawProd'),
    'ajax-filteri'=>array('controller'=>'ajax','method'=>'setFilters'),
    'ajax-editprod'=>array('controller'=>'ajax','method'=>'editProd'),
    'ajax-reloadlist'=>array('controller'=>'ajax','method'=>'reloadList'),
    'ajax-delimage'=>array('controller'=>'ajax','method'=>'delImage'),
    'ajax-addpics'=>array('controller'=>'ajax','method'=>'addPics')
	);