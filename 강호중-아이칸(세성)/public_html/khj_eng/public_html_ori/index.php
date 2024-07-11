<?ob_start();?> 
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "connect_index.php";

$url = str_replace("www.", "", $HTTP_HOST);

$SQL = "select * from domain_forward where if_confirm = '1'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$mart_id = mysql_result($dbresult, 0, "mart_id");
	$title = "강호중";
	$keywords = mysql_result($dbresult, 0, "keywords");
	$description = mysql_result($dbresult, 0, "description");
	$info_meta1 = mysql_result($dbresult, 0, "info_meta1");
}

?>
<html>
<head>
<title><?=$title?></title>
<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="refresh" content="0; url=./admin/intro.htm">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content='<?=$description?>'>
<meta name='keywords' content='<?=$keywords?>'>
<!-- #endif -->
<?=$info_meta1?>
</head>
</html>
