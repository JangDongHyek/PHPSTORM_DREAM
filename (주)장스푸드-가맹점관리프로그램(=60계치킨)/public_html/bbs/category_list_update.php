<?php
include_once('./_common.php');

// 190128 물품쇼핑몰 추가, 190213 포인트몰 추가
$table_name = "g5_category";
$return_page = G5_BBS_URL."/content.php?co_id=category";

if($shop_type == "point"){
	$table_name = "g5_point_category";
	$return_page = G5_BBS_URL."/content.php?co_id=point_category";

} else if ($shop_type == "pointMall") {
	$table_name = "g5_ptmall_category";
	$return_page = G5_BBS_URL."/content.php?co_id=ptmall_category";
}

if($mode == 'edit'){
	if(count($ca_chk) > 0){
		for($i=0; $i<count($ca_chk); $i++){
			$k = $ca_chk[$i];

			$sql = " update {$table_name} set ca_name='{$ca_name[$k]}' where ca_idx='{$ca_idx[$k]}' ";
			sql_query($sql);
		}
	}
}

if($mode == 'del'){
	if(count($ca_chk) > 0){
		for($i=0; $i<count($ca_chk); $i++){
			$k = $ca_chk[$i];

			$sql = " delete from {$table_name} where ca_idx='{$ca_idx[$k]}' ";
			sql_query($sql);
		}
	}
}

goto_url($return_page);
?>
