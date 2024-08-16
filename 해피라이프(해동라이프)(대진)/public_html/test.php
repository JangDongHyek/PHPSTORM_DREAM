<?
include('./common.php');

error_reporting(E_ALL);
ini_set("display_errors", 1);

//$img_src = G5_DATA_PATH."/sms/1584945048_IZA5.jpg";
// echo goMMS("01026120220", SMS_SEND_NUM, '테스트 발송', 4);


// $conn_db=mysqli_connect("14.48.175.170","mms_com","sbtpsxja!@#","mms_com");

// 원격 서버의 정보 
$ftp_server = "14.48.175.170";
$ftp_server_id = "mms_com";
$ftp_server_password = "sbtpsxja!@#";


if ($fc = ftp_connect($ftp_server)) echo "연결성공";
else echo "연결실패";

if ($ftp_login = ftp_login($fc, $ftp_server_id, $ftp_server_password)) echo "로그인성공";
else echo "로그인실패";

/*
$directory ="/home/mms_com/image/happylife/";
$file_name = "txt.php";
$file_pointer = fopen($directory.$filename, "r");
*/

?>