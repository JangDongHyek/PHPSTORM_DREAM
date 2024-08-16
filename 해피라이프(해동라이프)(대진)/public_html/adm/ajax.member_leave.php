<?
/*******************************************
회원탈퇴처리
*******************************************/
include_once('./_common.php');

$leave_date = date("Ymd", G5_SERVER_TIME);
//$sql = "UPDATE g5_member SET mb_leave_date = '{$leave_date}' WHERE mb_id = '{$_POST['mb_id']}'";
$sql = "DELETE FROM g5_member WHERE mb_id = '{$_POST['mb_id']}'";
echo (sql_query($sql))? "T" : "F";


?>