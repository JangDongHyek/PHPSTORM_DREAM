<?

$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
mysql_select_db("emma");
$mart_id = "khj"; //계정명

$rand_number = rand(111111,999999); 

$tran_phone1;//받는 사람 번호
$tran_callback1 = "010-8228-7535";//보내는 사람 번호
$send_date = date("YmdHis");
$tran_msg1 = "[W.I.C KHAN]회원님의 인증번호는 ".$rand_number."입니다.";
$sms_tf = 1;

$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
mysql_query($sms_query,$conn_db);

//전체기록남기기
$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
mysql_query($all_query,$conn_db);

echo $rand_number;
?>