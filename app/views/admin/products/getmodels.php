<?php

$res = selection('marke', null, array('mar_naziv'));
$str = '<option value="0">izaberite marku</option>';
foreach ($res as $m){
    $str .= '<option value="'.$m['mar_id'].'">'.ucfirst($m['mar_naziv']).'</option>';
}
echo $str;
