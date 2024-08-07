<?php
include_once('./_common.php');

if(!$bo_table)
	alert("해당하는 카테고리가 없습니다.", G5_URL);

$is_category = "category";
$g5['title'] = '카테고리';

$sca = $_GET['sca'];

if(!$sca)
	$sca = 10;

$ca = sql_fetch("select * from g5_category where ca_code = '{$sca}'");
$result = sql_query("select * from g5_category where char_length(ca_code) = '2' order by ca_order asc");

for($i=0; $i<$row = sql_fetch_array($result); $i++){
	$ca_list[$i] = $row;
	if($ca['ca_code'] == $row['ca_code'])
		$ca_idx = $i;
}

include_once(G5_BBS_PATH.'/_head.php');

include_once($category_skin_path.'/list.skin.php');

include_once(G5_BBS_PATH.'/_tail.php');
?>
