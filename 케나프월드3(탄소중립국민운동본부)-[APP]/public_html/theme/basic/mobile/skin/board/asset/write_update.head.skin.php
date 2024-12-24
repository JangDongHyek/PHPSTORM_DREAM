<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//wr 추가변수
$wr_cnt = 10;

//변수 배열지정
$var_array = array();
//wr 변수 $wr_cnt 까지 늘림
for($i=11; $i<=$wr_cnt; $i++){
	array_push($var_array, "wr_{$i}");
}

//특수 변수 추가
array_push($var_array, "wr_main");

//lets080 관리자 및 게시판 첫글이 없을 경우, 디비 쿼리문 추가
if($member['mb_id']=="lets080"){
	for($i=0; $i<count($var_array); $i++){
		$row = sql_fetch("SELECT table_name, column_name from information_schema.columns WHERE column_name = '".$var_array[$i]."' AND TABLE_NAME LIKE '{$write_table}'");
		if(!$row){ 
			sql_query("ALTER TABLE {$write_table} ADD ".$var_array[$i]." VARCHAR( 255 ) NOT NULL DEFAULT ''");
		}
	}
}

//property 추가 변수
for($i=0; $i<count($var_array); $i++){
	$var = $var_array[$i];
	$$var = "";

	if (isset($_POST[$var_array[$i]]) && settype($_POST[$var_array[$i]], 'string')) {
		$$var = trim($_POST[$var_array[$i]]);
	}
	
	$sql_common .= ", {$var} = '{$$var}' ";
}
if($ca_name == "판매"){ 
	
	if($w == "u")
		$sql_search .= " and wr_id != '{$wr_id}' ";

	$sql = "select sum(wr_subject) as wr_subject from {$write_table} where wr_1 = '' and mb_id = '{$member['mb_id']}' and ca_name = '{$ca_name}' {$sql_search}";
	$row = sql_fetch($sql);
	$sum = $row['wr_subject'];

	$asset = $wr_subject;
	$my_asset = $member['mb_asset'];
	$tr_asset = $sum + $asset;
	
	$row = sql_fetch("select sum(wr_content) as wr_content from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = '1'");
	$mx_asset = $row['wr_content'];

	if($my_asset < $asset){
		alert("보유 에셋보다 많은 에셋을 팔 수 없습니다.");
		exit;
	}

	if($my_asset < $tr_asset){
		alert("이미 거래중인 에셋의 합계가 판매하려는 에셋보다 많습니다. 확인 후 다시 시도해주세요");
		exit;
	}
	
	if($asset < $mx_asset){
		alert("적어도 ".$mx_asset." 에셋보다 많은 에셋을 입력하셔야합니다.");
		exit;
	}
}
?>