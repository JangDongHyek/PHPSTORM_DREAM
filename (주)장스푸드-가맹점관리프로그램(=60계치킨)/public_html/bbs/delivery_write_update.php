<?php
include_once('./_common.php');

$sql = " update g5_delivery set de_order='999999' ";
sql_query($sql);

if(count($de_idx) > 0){
	for($i=0; $i<count($de_idx); $i++){
		if($de_idx[$i] != ''){
			$sql = " update g5_delivery set de_name='{$de_name[$i]}', de_url='{$de_url[$i]}', de_order='0' where de_idx='{$de_idx[$i]}' ";
			sql_query($sql);
		}else{
			$sql = " insert into g5_delivery set de_name='{$de_name[$i]}', de_url='{$de_url[$i]}', de_order='0' ";
			sql_query($sql);
		}
	}
}

$sql = " delete from g5_delivery where de_order='999999' ";
sql_query($sql);

alert('저장되었습니다!',G5_BBS_URL.'/content.php?co_id=delivery');
?>
