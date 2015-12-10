<?php


function mvc_header(){
    include_once MVC_PATH.'/app/inc/header.php';
}
function mvc_footer(){
    include_once MVC_PATH.'/app/inc/footer.php';
}
function adm_header(){
    include_once MVC_PATH.'/app/inc/aheader.php';
}
function adm_footer(){
    include_once MVC_PATH.'/app/inc/afooter.php';
}
//----helpers------//
function selection($table,$where=null,$order=null,$ascdesc=null,$limit=null,$between=null){
    $q = new Query();
    $q->table = $table;
    if(null!==$where){$q->where = $where;}
    if(null!==$order){$q->order = $order;}
    if(null!==$ascdesc){$q->ascdesc = $ascdesc;}
    if(null!==$limit){$q->limit = $limit;}
    if(null!==$between){$q->between = $between;}
    $res = $q->read();
    return $res;
}
function updating($table,$where,$updatearray){
    $q = new Query();
    $q->table = $table;
    if(null!==$where){$q->where = $where;}
    $q->updatearray = $updatearray;
    $q->change();
}
function inserting($table,$insertarray){
    $q = new Query();
    $q->table = $table;
    $q->insertarray = $insertarray;
    $q->insert();
    return $q->lastInsertId();
}
function deleting($table,$where){
    $q = new Query();
    $q->table = $table;
    $q->where = $where;
    $q->delete();
}
function email($to,$from,$subject,$message,$attachment=null){
    $e = new Email();
    $e->to_email = $to;
    $e->from_email = $from;
    $e->subject_str = $subject;
    $e->message_str = $message;
    if(null!==$attachment){$e->attachment = $attachment;}
    $e->sendmail();
}
function imageResize($file,$newWidth,$newHeight,$savePath,$option=null,$quality=null){
    $r = new Resize($file);
    $r->resizeImage($newWidth, $newHeight, $option);
    $r->saveImage($savePath, $quality);
}
function translation($lang,$str){
    $t = new Translate($lang);
    $res = $t->trans($str);
    return $res;
}
//----other----//
function q_custom($str){
    $q = new Model();
    $r = $q->prepare($str);
    $r->execute();
    return $r->fetchAll();
}
function run_session(){
    $s = new Sessions('mvc');
    return $s;
}
function slugging($str){
    $s = strtolower($str);
    $unwanted = array(' ','+','?','.',',',';',':','"','&','%','š','Š','đ','Đ','ž','Ž','č','Č','ć','Ć');
    $wanted = array('-','-',' ','','','-','-','','i',' posto','s','s','d','d','z','z','c','c','c','c');
    return str_replace($unwanted, $wanted, $s);
}
