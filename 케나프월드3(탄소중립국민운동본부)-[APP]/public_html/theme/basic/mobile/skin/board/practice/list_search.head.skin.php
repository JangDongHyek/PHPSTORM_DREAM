<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($si) $sql_search .= " and wr_2 like '%{$si}%' ";
if($gu) $sql_search .= " and wr_2 like '%{$gu}%' ";

for($i=0; $i<count($fop); $i++){
	if($fop[$i])
		$sql_search .= " and wr_".($i+25)." = '1' ";
}

for($i=0; $i<count($foc); $i++){
	if($foc[$i])
		$sql_search .= " and wr_".($i+33)." = '1' ";
}

if($ca_name) $sql_saerch .= " and ca_name = '{$ca_name}' ";

?>