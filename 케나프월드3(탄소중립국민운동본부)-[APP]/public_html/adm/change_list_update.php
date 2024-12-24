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
} else {
    alert('올바른 방법으로 이용해 주세요.');
}

for ($i=0; $i<count($_POST['chk']); $i++) {

	// 실제 번호를 넘김
	$k = $_POST['chk'][$i];

	sql_query(" update g5_change set ch_status = '{$status}' where ch_id = '{$ch_id[$k]}'");

	if($status == "수락"){
		$row = sql_fetch("select mb_id, ch_money from g5_change where ch_id = '{$ch_id[$k]}'");
		$mb_id = $row['mb_id'];
		$point = $row['ch_money'] * (-1);
		$po_id = insert_point($mb_id, $point, '포인트 환전', '@member', $mb_id, $ch_id[$k]);
		
		if($po_id > 0){
			sql_query(" update g5_change set po_id = '{$po_id}', po_datetime = '".G5_TIME_YMDHIS."' where ch_id = '{$ch_id[$k]}'");
		}
	}
}

goto_url(G5_ADMIN_URL."/change_list.php");
?>