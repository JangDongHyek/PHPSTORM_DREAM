<?php

//wr 최대 변수 지정
$wr_cnt = 50;

// 가변 변수로 $wr_11 .. $wr_cnt 까지 만든다.
for ($i=11; $i<=$wr_cnt; $i++) {
	$vvar = "wr_".$i;
	$$vvar = $write['wr_'.$i];
}

if(!$wr_lat) $wr_lat = $write['wr_lat'];				// 경도
if(!$wr_lng) $wr_lng = $write['wr_lng'];				// 위도
if(!$wr_lat) $wr_lat = "35.179700928421915";
if(!$wr_lng) $wr_lng = "129.07516214077822";

?>

