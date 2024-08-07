<?php
include_once('./_common.php');

if (!count($_POST['chk'])) {
    alert($_POST['btn_submit'].' 하실 항목을 하나 이상 선택하세요.');
}

if($_POST['btn_submit'] == '선택수락') {
	$status = "1";
} else if($_POST['btn_submit'] == '선택거절') {
	$status = "-1";
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
		sql_query(" update g5_movie_point set status = '{$status}' where idx = '{$idx[$k]}'");
	}else{
		sql_query("delete from g5_wallet where wl_id='{$wl_id[$k]}'");
	}
}

goto_url(G5_ADMIN_URL."/movie_point_list.php");
?>