<?php
include_once('./_common.php');

if (!count($_POST['chk'])) {
    alert($_POST['btn_submit'].' 하실 항목을 하나 이상 선택하세요.');
}

if($_POST['btn_submit'] == '선택수락') {
	$status = "수락";
} else if($_POST['btn_submit'] == '선택거절') {
	$status = "거절";
} else if($_POST['btn_submit'] == '선택취소') {
	$status = "취소";
} else if($_POST['btn_submit'] == "선택삭제"){
  $status = "삭제";
} else{
	alert('올바른 방법으로 이용해 주세요.');
}

for ($i=0; $i<count($_POST['chk']); $i++) {
	// 실제 번호를 넘김
		$k = $_POST['chk'][$i];
	if($status!="삭제"){
		

		sql_query(" update g5_wallet set wl_status = '{$status}' where wl_id = '{$wl_id[$k]}'");

		if($status == "수락"){
			$row = sql_fetch("select mb_id, wl_money from g5_wallet where wl_id = '{$wl_id[$k]}'");
			$mb_id = $row['mb_id'];
			$point = $row['wl_money'];
			$po_id = insert_point($mb_id, $point, '포인트 충전', '@member', $mb_id, $wl_id[$k]);
			
			if($po_id > 0){
				sql_query(" update g5_wallet set po_id = '{$po_id}', po_datetime = '".G5_TIME_YMDHIS."' where wl_id = '{$wl_id[$k]}'");
			}
		}
	}else{
		sql_query("delete from g5_wallet where wl_id='{$wl_id[$k]}'");
	}
}

goto_url(G5_ADMIN_URL."/wallet_list.php");
?>