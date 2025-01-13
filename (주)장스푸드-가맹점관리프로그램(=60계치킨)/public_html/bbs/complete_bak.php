<?php
include_once('./_common.php');

$sql = " update g5_order set 
	trade_check = '발주완료' 
	where od_idx = '{$od_idx}'
";
sql_query($sql);

alert('발주완료를 하였습니다.',G5_BBS_URL.'/content.php?co_id='.$co_id.'&od_idx='.$od_idx.'&page='.$page);
?>
