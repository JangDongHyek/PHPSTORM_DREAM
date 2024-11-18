<?php
$sub_menu = "500200";
include_once('./_common.php');

// 분류에 & 나 = 는 사용이 불가하므로 2바이트로 바꾼다.
$src_char = array('&', '=');
$dst_char = array('＆', '〓');
$bo_category_list = str_replace($src_char, $dst_char, $bo_category_list);

$sql = " update {$g5['board_table']}
			set bo_category_list    = '{$_POST['bo_category_list']}'
		  where bo_table = '{$bo_table}' ";
sql_query($sql);

$sql = " update {$g5['board_table']}
			set bo_category_list    = '{$_POST['bo_category_list']}'
		  where bo_table = 'store' ";
sql_query($sql);

delete_cache_latest($bo_table);

alert("수정되었습니다.", "./js_cctv_cate.php?w=u&bo_table=cctv");
?>
