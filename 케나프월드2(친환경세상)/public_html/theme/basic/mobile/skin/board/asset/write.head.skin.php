<?php 
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//wr 최대 변수 지정
$wr_cnt = 10;

// 가변 변수로 $wr_11 .. $wr_cnt 까지 만든다.
for ($i=11; $i<=$wr_cnt; $i++) {
	$vvar = "wr_".$i;
	$$vvar = $write['wr_'.$i];
}

$wr_1 = $write['wr_1'];

if($wr_id)
	$sql_search .= " and wr_id != '{$wr_id}' ";
$sql = "select sum(wr_subject) as wr_subject from {$write_table} where wr_1 = '' and mb_id = '{$member['mb_id']}' and ca_name = '{$ca_name}' {$sql_search}";
$row = sql_fetch($sql);
$sum = $row['wr_subject'];
?>