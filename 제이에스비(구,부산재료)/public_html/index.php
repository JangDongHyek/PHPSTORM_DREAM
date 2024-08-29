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
	$title = mysql_result($dbresult, 0, "title");
	$keywords = mysql_result($dbresult, 0, "keywords");
	$description = mysql_result($dbresult, 0, "description");
	$info_meta1 = mysql_result($dbresult, 0, "info_meta1");
}
if( $mart_id == "" ){
	$frame_src = "/";
}else{
	$frame_src = "$home_dir/market/main/index.html";
}
?>
<?
//======================= 새로 고쳤을때 기존 페이지가 그대로 표시 ========================
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

<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"></script>
<script type="text/javascript"> 
 if (!wcs_add) var wcs_add={};
 wcs_add["wa"] = "s_3c28b0886335";
// 체크아웃 whitelist가 있을 경우
wcs.checkoutWhitelist = ["jsbusan.com", "www.jsbusan.com"]; 
// 유입 추적 함수 호출
wcs.inflow("jsbusan.com");
</script>
<script type="text/javascript"> 
wcs_do(); 
</script>

<script type="text/javascript">
var ua = window.navigator.userAgent.toLowerCase();
if ( /iphone/.test(ua) || /android/.test(ua) || /opera/.test(ua) || /bada/.test(ua) ) {
document.location.replace('https://jsbusan.com/mobile/');
}
</script>

<?
if($_SERVER['SERVER_NAME'] == "m.jsbusan.com"){
       echo "<script>location.href='http://jsbusan.com/mobile/';</script>";
}
?>



<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="refresh" content="0; url=./market/main/index.html">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content='<?=$description?>'>
<meta name='keywords' content='<?=$keywords?>'>
<!-- #endif -->
<?=$info_meta1?>
</head>
</html>
