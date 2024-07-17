<?php
include_once('./_common.php');


$hid = $_POST['option']['hid'];
$g5['title'] = $_POST['option']['subject'];

if (!$hid) {
   exit;
}

// 받아온 데이터 자르기
$getData = $_POST['option']['datas'];
// 받아온 데이터 짜르기
$datas = explode(",", $getData);
$data = array();
for($i=0; $i<count($datas); $i++){
	$datat = explode(":", $datas[$i]);
	$data[$datat[0]] = $datat[1];
}

$temp = explode("_", $hid);

//hash일땐 basic으로 경로 이동
if($temp[0] == "hash")	
	$folder = "basic";
else	
	$folder = $temp[0];

$hash_url		= G5_PLUGIN_PATH.'/hash';

//url 설정
$file_name		= $temp[1].'.php';

$hash_skin_path = $hash_url."/".$folder;
$hash_skin_url  = $hash_url."/".$folder;

if($g5['title'])
	@include_once($hash_url."/hash_header.php");

include_once($hash_skin_path."/".$file_name);

if($g5['title'])
	@include_once($hash_url."/hash_tail.php");
	

?>