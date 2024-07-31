<?php
define('__HHGYU__',"hhgyu");
ob_start();
ob_implicit_flush(0);
session_cache_limiter('');
session_start();

$path = $_SERVER['SCRIPT_FILENAME'];
$tmp = explode("/",$_SERVER['SCRIPT_FILENAME']);
$path = str_replace($tmp[count($tmp)-1],"",$path);

$server_path = str_replace(basename(__FILE__), "", realpath(__FILE__));

define("__ROOT_PATH__", $server_path);
define("__INCLUDE_PATH__", __ROOT_PATH__ . "include/");
//$_SERVER[DOCUMENT_ROOT] = str_replace("themaweek", "jpub", $_SERVER[DOCUMENT_ROOT]);


require_once(__INCLUDE_PATH__ . 'config.php');
$config = &Config::getInstance();
require_once(__INCLUDE_PATH__ . 'include.php');
$mysql_query->connent();

$passkey="";
if(@$_POST['passkey']!='') {$passkey=$_POST['passkey'];}

/*
if($passkey == "" || $passkey!=$config->passkey_gen)
{
	$rows = array();
	$rows['error']['message']='passkey Null or Miss Match!\r\n' . mysql_error();
	$rows['error']['number']=0;
	echo json_encode($rows);
	return;
}*/


if(!$mysql_query->isConnected())
{
	$rows = array();
	$rows['error']['message']='DB에 접속할수 없습니다!\r\n';
	$rows['error']['number']=0;
	echo json_encode($rows);
	return;
}
$count = $mysql_query->max_count($config->db_info->user_db,"`ID`='$ID'");
if($count >= 1){ //이미 등록되었을때
	mysql_query(" update member_gcm set `delete`='$delete' where `ID`='$ID' ");
	$rows[$mode]['message']='성공했습니다!';
	$rows[$mode]['number']=1;
	echo json_encode($rows);
	return;
}
?>