<?php
include_once("./_common.php");

$w = $_POST["w"];
$ip_id = $_POST['ip_id'];
$ip_code = $_POST['ip_code'];

if($w == ""){
	$sql = "select * from g5_ipconfig where ip_code = '{$ip_code}'";
	$row = sql_fetch($sql);
	
	if($row){
		alert("이미 등록한 아이피입니다");
		exit;
	}

	$sql = "insert into g5_ipconfig set ip_code = '{$ip_code}'";
	sql_query($sql);
}else if($w == "u"){
	for($i=0; $i<count($ip_id); $i++){
		$sql = "update g5_ipconfig set ip_code = '{$ip_code[$i]}' where ip_id = '{$ip_id[$i]}'";
		sql_query($sql);
	}
}else if($w == "d"){
	sql_query("delete from g5_ipconfig where ip_id = '{$ip_id}'");
	exit;
}

goto_url(G5_ADMIN_URL."/ipconfig.php");
?>