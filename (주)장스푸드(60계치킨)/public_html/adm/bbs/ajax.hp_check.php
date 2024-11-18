<?php
include_once('./_common.php');

$wr_1	= $_POST['wr_1'];//이벤트명
$mb_hp	= $_POST['mb_hp'];//신청자번호

$sql = "select count(*) as cnt from g5_write_event_join where wr_1 = '{$wr_1}' and wr_2 = '{$mb_hp}'";
$row = sql_fetch($sql);

if($row['cnt'] && $mb_hp != "010-2231-6545"){
	$datas['status'] = "false";
	echo json_encode($datas);
	exit;
}

$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
mysql_select_db("emma");
$user_id = "jangsfood"; //계정명

$rand		= rand(1000, 9999);
$wr_message = "[60계치킨] 인증번호 [".$rand."]를 입력해주세요.";
$send_content = iconv("UTF-8", "EUC-KR", $wr_message);
$send_date = date("YmdHis");

$send_back = "010-2720-6736";//보내는 사람 번호
$send_phone = $mb_hp;//받는 사람 번호 

$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";

mysql_query($sql, $conn_db);

//전체기록남기기
$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";

mysql_query($sql, $conn_db);

$row = sql_fetch("select max(wr_no) as wr_no from {$g5['sms5_write_table']}");

if ($row)
	$wr_no = $row['wr_no'] + 1;
else
	$wr_no = 1;

sql_query("insert into {$g5['sms5_write_table']} set wr_no='$wr_no', wr_renum=0, wr_reply='$wr_reply', wr_message='$wr_message', wr_booking='', wr_total='1', wr_datetime='".G5_TIME_YMDHIS."'");

$hs_code = G5_TIME_YMDHIS;
$hs_memo = $list[$i]['bk_hp']."로 전송했습니다.";
$wr_success++;
$hs_flag = 1;

$row = $list[$i];

sql_query("insert into {$g5['sms5_history_table']} set wr_no='$wr_no', wr_renum=0, bg_no='', mb_id='', bk_no='', hs_name='', hs_hp='{$send_phone}', hs_datetime='".G5_TIME_YMDHIS."', hs_flag='$hs_flag', hs_code='$hs_code', hs_memo='".addslashes($hs_memo)."', hs_log='".G5_TIME_YMDHIS."'", false);

sql_query("update {$g5['sms5_write_table']} set wr_success='$wr_success', wr_memo='' where wr_no='$wr_no' and wr_renum=0");

$datas['status'] = "seccess";
$datas['cret']	 = $rand;

echo json_encode($datas);
?>