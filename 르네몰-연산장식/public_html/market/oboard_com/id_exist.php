<?
function error1($msg) {
echo "<SCRIPT LNAGUAGE=JAVASCRIPT>
window.alert('$msg');
self.close();
</SCRIPT>";
exit;
}

if(!$value11) {
	$msg = "���̵� �Է��� �ּ���"; error1($msg);
}
if((strlen($value11) > 12) || (strlen($value11) < 4)) {
	$msg = "���̵�� 4~12�� ������ �������� ȥ������ �����Ǿ�� �մϴ�."; error1($msg);
}


include "../oboard/function.inc";
include("../oboard/util.php");
include "../../connect.php";

$DATA1 = mysql_query("SELECT id FROM reservation_com  WHERE value11='$value11'");
if ( @mysql_fetch_array($DATA1) ) {
$msg = "$value11 �� �̹� ������� ���̵��Դϴ�."; error1($msg);
}

$message="<font size=2pt>��밡���� ���̵� �Դϴ�.</font>";

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
<title>value11 üũ</title>
<body>
<form>
<input type=hidden name=action value=user_value11check>
<font size=1pt face=����><b>���̵�</b></font> 
<input type=text name=value11 value=\"$value11\" size=12> <input type=button value=\"����\" onClick=\"setting('$value11')\">
<hr size=0 wvalue11th=100%>
$message</form></body></html>";

exit;

?>