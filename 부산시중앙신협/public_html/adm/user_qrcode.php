<?
include_once("./_common.php");
include_once(G5_PATH."/phpqrcode/qrlib.php");

ob_start("colback");
$codeText = "www.bcum.co.kr/bbs/use_point.php?type=sticker&mb_id=$mb_id&time=".time();
$debugLog = ob_get_contents();
ob_end_clean();
QRcode::png($codeText);

?>