<?
include('./common.php');

//$reserv_phone, $send_phone, $content, $type, $img=""
//$img = G5_DATA_PATH."/sms/1584945048_IZA5.jpg";

$img = G5_DATA_PATH."/sms/1585023370_M5DD.jpg";

if (file_exists($img)) {
	echo $img;
}

// goMMS("01026120220", "18338881", "MMS 테스트 발송", 6, $img);

/*
$conn_db = mysqli_connect("14.48.175.170","mms_com","sbtpsxja!@#","mms_com");
$send_date = date("Y-m-d H:i:s");
$tran_id = 'happylife';
$subject = '(주)해피라이프';

//$img = $_FILES['sms_img']['tmp_name'];
$img = '/home/mms_com/public_html/image/happylife/00_01.jpg';
//$img = '/home/landerson/public_html/map.jpg';

$content=  "테스트 문자";
$send_phone = '01026120220';
$reserv_phone = SMS_SEND_NUM;


if ($img != '') {
$query = "Insert into em_tran_mms (file_cnt, mms_body, mms_subject, file_type1, file_name1, service_dep1) values 
		  ('2','$content','$subject','IMG','$img','ALL')";
} else {
$query = "Insert into em_tran_mms (file_cnt, mms_body, mms_subject) values 
		  ('2','$content','$subject')";
}
mysqli_query($conn_db,$query);

$tran_etc4=mysqli_insert_id($conn_db);

$mms_query = "Insert into em_tran (tran_pr,tran_id,tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type,tran_etc4) values 
		  (null,'$tran_id','$send_phone','$reserv_phone','1',sysdate(),'','6','$tran_etc4')";
$result=mysqli_query($conn_db,$mms_query);

$mms_query = "Insert into em_tran_log (tran_pr,tran_id,tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type,tran_etc4) values 
		  (null,'$tran_id','$send_phone','$reserv_phone','1',sysdate(),'','6','$tran_etc4')";
$result=mysqli_query($conn_db,$mms_query);

if(!$result){
echo "실패";
} 
exit;
*/