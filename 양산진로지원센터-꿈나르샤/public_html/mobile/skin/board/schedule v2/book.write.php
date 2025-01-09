<?php
include_once("../../../../common.php");
if(empty($_POST)){
	alert("정상적인 방법으로 접근하십시오");
	exit;
}
$sql = " INSERT INTO `g5_write_counsel_book`( b_wr_id, b_name, b_school, b_class, b_tel, b_email,b_parent_name,b_parent_tel,b_request) VALUES ('{$b_wr_id}', '{$b_name}', '{$b_school}', '{$b_class}', '{$b_tel}', '{$b_email}','{$b_parent_name}','{$b_parent_tel}','{$b_request}') ";
if(sql_query($sql)){
	$sql_count = " select count(*) as cnt from `g5_write_counsel_book` where b_wr_id = '".$b_wr_id."' ";
	$row = sql_fetch($sql_count);
	$total_count = $row['cnt'];

	$sql_count2 = " select * from `g5_write_counsel` where wr_id = '".$b_wr_id."' ";
	$row2 = sql_fetch($sql_count2);
	$total_count2 = $row2['wr_2'];

	if(!$total_count2){
		$total_count2 = 1;
	}

	if($total_count >= $total_count2){
		$sql = "UPDATE `g5_write_counsel` SET wr_10 = '예약완료' where wr_id = '".$b_wr_id."' ";
		sql_query($sql);
	}
	goSms($_POST[b_tel], "0557850151", $_POST['b_name']."님 진로상담 신청이 접수되었습니다.");
	goSms($m_hp1, "0557850151", $_POST['b_name']."님 진로상담 신청이 접수되었습니다.");
	goSms($m_hp2, "0557850151", $_POST['b_name']."님 진로상담 신청이 접수되었습니다.");
	/*$sql = "UPDATE `g5_write_counsel` SET wr_10 = '예약완료' where wr_id = '".$b_wr_id."' ";
	sql_query($sql);*/

	echo "<script>
	alert('상담 예약이 신청되었습니다.');
	location.replace('../../../../bbs/board.php?bo_table=counsel');
	</script>";
	exit;
}else{
	echo "<script>
	alert('상담 예약 신청에 실패하였습니다.');
	location.replace('../../../../bbs/board.php?bo_table=counsel');
	</script>";
	exit;
}
?>