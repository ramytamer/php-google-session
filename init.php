<?php 

session_start();

require_once 'app/db.php';
require_once 'app/app.php';


$app = new App;

function redirect($to = null){
	header('Location: '. (!is_null($to) ? $to : 'http://'.$_SERVER['SERVER_NAME'].'/demo/') );
	exit();
}

function strLimit($str,$limit = 100,$end = '...'){
	if(strlen($str) <= $limit ) return $str;

	return rtrim(substr($str, 0, $limit)).$end;
}

?>