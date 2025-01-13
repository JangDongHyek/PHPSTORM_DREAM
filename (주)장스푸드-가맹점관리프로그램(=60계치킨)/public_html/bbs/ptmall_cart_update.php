<?php
include_once('./_common.php');

if($mode == 'del'){
	if(count($ct_chk) > 0){
		for($i=0; $i<count($ct_chk); $i++){
			$k = $ct_chk[$i];

			$sql = " delete from g5_ptmall_cart_opt where ct_idx='{$ct_chk[$i]}' ";
			sql_query($sql);

			$sql = " delete from g5_ptmall_cart where ct_idx='{$ct_chk[$i]}' ";
			sql_query($sql);
		}
	}
}

goto_url(G5_BBS_URL.'/content.php?co_id=ptmall_cart');
?>
