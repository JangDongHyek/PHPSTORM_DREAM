<?ob_start();?>
<?
//================== DB ���� ������ �ҷ��� ===============================================
include "connect_index.php";

$url = str_replace("www.", "", $HTTP_HOST);

$SQL = "select * from domain_forward where if_confirm = '1'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "���� ���� ����!";
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$mart_id = mysql_result($dbresult, 0, "mart_id");
	$title = mysql_result($dbresult, 0, "title");
	$keywords = mysql_result($dbresult, 0, "keywords");
	$description = mysql_result($dbresult, 0, "description");
	$info_meta1 = mysql_result($dbresult, 0, "info_meta1");
}
if( $mart_id == "" ){
	$frame_src = "/";
}else{
	$frame_src = "$home_dir/market/main/";
}
?>
<?
//======================= ���� �������� ���� �������� �״�� ǥ�� ========================
//$LastModified = gmdate("D d M Y H:i:s", filemtime($HTTP_SERVER_VARS[SCRIPT_FILENAME])); 
//header("Last-Modified: $LastModified GMT"); 
//header("ETag: '$LastModified'"); 
?>
<?
$path = "admin/log";
$counter = "daylife";
include "$path/nalog.php";
?>
<html>
<head>
<title><?=$title?></title>

<script type="text/javascript">
location.href="../market/main/";
</script>



<meta name="naver-site-verification" content="896feb7bb2c7bd14edabec8141395a64b98abdb7"/>
<meta property="og:type" content="website">
<meta property="og:title" content="ž����">
<meta property="og:description" content="�̿�, �̹߻� ���, �̹߱ⱸ, �̿����, ������, ������ ȭ��ǰ, ������������ ��ǰ ���.">
<meta property="og:image" content="http://www.topline.kr/market/images/main_2.gif">
<meta property="og:url" content="http://www.topline.kr/">
<link rel="canonical" href="http://www.topline.kr"/> 
<?php exit;?>




<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content='<?=$description?>'>
<meta name='keywords' content='<?=$keywords?>'>
<!-- #endif -->
<?=$info_meta1?>
</head>


<frameset rows='0,*' border=0 framespacing=0 frameborder=0>
<frame name='blank' src='blank.html' marginwidth='0' marginheight='0' scrolling='no' frameborder='no'>
<frame name='content1' src='<?=$frame_src?>'  marginwidth='0' marginheight='0' scrolling='auto' frameborder='no'>
</frameset><noframes></noframes>
</html>
<?
mysql_close($dbconn);
?>
