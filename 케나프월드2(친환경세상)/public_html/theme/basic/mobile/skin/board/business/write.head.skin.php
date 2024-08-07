<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
$agent = getBrowser(); 

if($w==""){
	$sca = $_GET['sca'];

	if(!$sca)
		$sca = "10";

	$ca = sql_fetch("select * from g5_category where ca_code = '{$sca}'");
	$ca_code = $ca['ca_code'];
	$ca_id   = $sca;
	$ca_name = $ca['ca_name'];
}

if(!$wr_lat) $wr_lat = $write['wr_lat'];				// 경도
if(!$wr_lng) $wr_lng = $write['wr_lng'];				// 위도
if(!$wr_lat) $wr_lat = "37.56683321468002";
if(!$wr_lng) $wr_lng = "126.97866357530923";

if(!$wr_addr1) $wr_addr1 = $write['wr_addr1'];			
if(!$wr_addr2) $wr_addr2 = $write['wr_addr2'];			
if(!$wr_tel) $wr_tel = $write['wr_tel'];

if(!$ca_code) $ca_code = $write['ca_code'];			
if(!$ca_id) $ca_id = $write['ca_id'];		
?>