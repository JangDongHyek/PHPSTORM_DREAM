<?php
include_once("../common.php");
/*
if($member['mb_level'] < 10){
    return;
}
*/



//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


$mb_name = $_POST['mb_name'];
$cs_hp = $_POST['mb_hp'];
$template_code = $_POST['templateCode'];

//$cs_hp = "01026074128";
//$mb_name = "고명우";

$params = array("mb_name" => $mb_name, "tab" => "class");
$re = sendAlimTalk($template_code, $params, $cs_hp);

//echo $re;

//var_dump($re);
//echo json_encode($re);