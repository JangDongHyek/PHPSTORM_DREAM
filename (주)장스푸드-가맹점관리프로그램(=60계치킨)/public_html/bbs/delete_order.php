<?php
include_once('./_common.php');

$c_sql = " select * from g5_cart where od_idx='{$od_idx}' ";
$c_qry = sql_query($c_sql);
$c_num = sql_num_rows($c_qry);
if($c_num > 0){
	for($c=0; $c<$c_num; $c++){
		$c_row = sql_fetch_array($c_qry);

		$co_del_sql = " delete from g5_cart_opt where ct_idx='{$c_row['ct_idx']}' ";
		sql_query($co_del_sql);
	}
}

$c_del_sql = " delete from g5_cart where od_idx='{$od_idx}' ";
sql_query($c_del_sql);

$o_del_sql = " delete from g5_order where od_idx='{$od_idx}' ";
sql_query($o_del_sql);

goto_url(G5_BBS_URL.'/content.php?co_id=myorder&page='.$page);
?>