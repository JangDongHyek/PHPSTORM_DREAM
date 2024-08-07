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
$wr_lat = $write['wr_lat'];
$wr_lng = $write['wr_lng'];

$wr_search1 = $write['wr_search1'];
$wr_search2 = $write['wr_search2'];
$wr_search3 = $write['wr_search3'];
$wr_search4 = $write['wr_search4'];
$wr_search5 = $write['wr_search5'];

if(!$wr_lat) $wr_lat = "35.18726943443006";
if(!$wr_lng) $wr_lng = "129.07910679391543";

?>