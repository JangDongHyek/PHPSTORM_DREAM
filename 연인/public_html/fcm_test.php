<?
include_once('./_common.php');
$tokens2=array("dStQPIqURByZrdkZv3GnVN:APA91bFvvK7usUNMdqri1WbKVNdM5QLCCDXs1NKWJzTlHz88dFLu-gB1iMoJ2CxdgIzY4yhX7mt_v6QpjhudCJnONvs6L1Cs_ygUFoe87Pc-N3OvqLbAnOQQYdf58ATGsUViSMIZ0RZz");
// $message=array(
//     "message"=>$member[mb_name]."님이 대리요청에 수락하였습니다.",
//     "subject"=>"T대리-대리요청수락",
//     "goUrl"=>G5_BBS_URL."/board.php?bo_table=$bo_table",
//     "viewUrl"=>G5_BBS_URL."/board.php?bo_table=$bo_table",
//     "gubun"=>"success"
// );
$message = array(
    "message" => "연인에서 새로운 공지사항이 있습니다.",
    "subject" => "연인에서 새로운 공지사항이 있습니다.",
    "goUrl" => G5_URL . "/bbs/board.php?bo_table=b_notice&wr_id=541",
);

$fcm=sendFcm($tokens2,$message);
echo $fcm;
