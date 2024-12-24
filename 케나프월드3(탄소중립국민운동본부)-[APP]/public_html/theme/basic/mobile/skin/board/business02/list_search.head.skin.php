<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if($stx){
	$sql_search .= " or ( wr_search1 like '%{$stx}%' or wr_search2 like '%$stx%' or wr_search3 like '%$stx%' or wr_search4 like '%$stx%' ) ";
}
?>