<?
$SQL = "select * from $Domain_forwardTable where mart_id='$mart_id' and if_confirm = '1'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$mart_id = mysql_result($dbresult, 0, "mart_id");
	$page_title = mysql_result($dbresult, 0, "title");
	$keywords = mysql_result($dbresult, 0, "keywords");
	$description = mysql_result($dbresult, 0, "description");
	$info_meta1 = mysql_result($dbresult, 0, "info_meta1");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<meta http-equiv="imagetoolbar" content="no">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content='<?=$description?>'>
<meta name='keywords' content='<?=$keywords?>'>
<!-- #endif -->
<?
if( $Mall_Admin_ID ){
?>
<script language="javascript" src="../js/common_login.js" type="text/javascript"></script>
<?
}else{
?>
<script language="javascript" src="../js/common.js" type="text/javascript"></script>
<?
}
?>
<script language=javascript src='../js/menu_select.js' type="text/javascript"></script>
<script language='JavaScript' src='../js/printEmbed.js'></script>
<script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../js/jquery.slides.min.js"></script><!--메인슬라이드-->
<script type="text/javascript" src="../js/ui.js"></script><!--공통-->
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>