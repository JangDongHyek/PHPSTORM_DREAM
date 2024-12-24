<?php 
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//wr 최대 변수 지정
$wr_cnt = 10;

// 가변 변수로 $wr_11 .. $wr_cnt 까지 만든다.
for ($i=11; $i<=$wr_cnt; $i++) {
	$vvar = "wr_".$i;
	$$vvar = $write['wr_'.$i];
}

$wr_main = $write['wr_main'];
?>