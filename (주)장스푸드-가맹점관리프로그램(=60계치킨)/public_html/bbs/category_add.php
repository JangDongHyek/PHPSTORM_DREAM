<?php
include_once('./_common.php');

if(!$ca_id){
	// ca_id 빈값일때 Fail
	echo 'id_fail';
	exit;
}

if(!$ca_name){
	// ca_name(분류명) 빈값일때 Fail
	echo 'name_fail';
	exit;
}

// 190128 물품쇼핑몰 추가, 190213 포인트몰 추가
$table_name = "g5_category";
//$return_page = G5_BBS_URL."/content.php?co_id=category";

if($shop_type == "point"){
	$table_name = "g5_point_category";
	//$return_page = G5_BBS_URL."/content.php?co_id=point_category";

} else if ($shop_type == "pointMall") {
	$table_name = "g5_ptmall_category";
}


$chk_sql = " select count(*) as cnt from {$table_name} where ca_id = '{$ca_id}' ";
$chk_row = sql_fetch($chk_sql);
if($chk_row['cnt'] > 0){
	// ca_id 이미 사용중일때 Fail
	echo 'used_fail';
	exit;
}

$sql = " insert into {$table_name} set ca_id='{$ca_id}', ca_name='{$ca_name}', ca_order='0' ";
if(sql_query($sql)){
	echo 'success';
	exit;
}else{
	echo 'fail';
	exit;
}
?>
