<?
include_once("./_common.php");


$sql = "select * from g5_fcm where mb_id = 'test'";
$row = sql_fetch($sql);

var_dump($row);

$tokens=array($row[token]);
$message=array(
	"subject"=>"예약신청",
	"message"=>"{$mb['mb_name']} 회원님의 {$_POST['reser_date']}/{$_POST['reser_time']} 예약신청이 있습니다.",
	//"goUrl"=>G5_ADMIN_URL."/lesson_reser.php?start_date={$reser_date}&end_date={$reser_date}",
	"goUrl"=>"",
);
$fcm=sendFcm($tokens, $message);

var_dump($fcm);

?>