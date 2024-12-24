<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(!$is_adm && !$sca){
	$sca = get_session("ss_sca")?get_session("ss_sca"):"10";
	goto_url(G5_BBS_URL."/category.php?bo_table=business&sca=".$sca);
}

if($ca_code){
	$sql_search .= " and ca_code like '{$ca_code}%' ";
}

if($wr_primeium)
	$sql_search .= " and wr_primeium = '{$wr_primeium}' ";

$qstr .= "&ca_code=".$ca_code."&wr_primeium=".$wr_primeium;
?>