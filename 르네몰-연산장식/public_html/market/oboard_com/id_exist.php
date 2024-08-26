<?
function error1($msg) {
echo "<SCRIPT LNAGUAGE=JAVASCRIPT>
window.alert('$msg');
self.close();
</SCRIPT>";
exit;
}

if(!$value11) {
	$msg = "아이디를 입력해 주세요"; error1($msg);
}
if((strlen($value11) > 12) || (strlen($value11) < 4)) {
	$msg = "아이디는 4~12자 사이의 영문숫자 혼합으로 구성되어야 합니다."; error1($msg);
}


include "../oboard/function.inc";
include("../oboard/util.php");
include "../../connect.php";

$DATA1 = mysql_query("SELECT id FROM reservation_com  WHERE value11='$value11'");
if ( @mysql_fetch_array($DATA1) ) {
$msg = "$value11 는 이미 사용중인 아이디입니다."; error1($msg);
}

$message="<font size=2pt>사용가능한 아이디 입니다.</font>";

echo "<html>
<script language=\"JavaScript\">
<!--
function setting(value11) {
opener.document.writeform.user_id_check.value = value11;
opener.document.writeform.value11.value = value11;
self.close();
}
-->
</script>
<title>value11 체크</title>
<body>
<form>
<input type=hidden name=action value=user_value11check>
<font size=1pt face=돋움><b>아이디</b></font> 
<input type=text name=value11 value=\"$value11\" size=12> <input type=button value=\"적용\" onClick=\"setting('$value11')\">
<hr size=0 wvalue11th=100%>
$message</form></body></html>";

exit;

?>