<?php
$db = array();
//----conection-------
$db['DB_HOST'] = 'localhost';
$db['DB_NAME'] = 'mobile';
$db['DB_USER'] = 'root';
$db['DB_PASS'] = '123test';
//-----details------
$db['DB_TYPE'] = 'PDO';
$db['DB_CHARSET'] = 'utf8';
$db['DB_ENGINE'] = 'InnoDB';

foreach ($db as $constant => $value) {
    
    define($constant, $value);
    
}