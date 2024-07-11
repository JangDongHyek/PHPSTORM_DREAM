<?
/** //================== SMS DB 설정 파일 ====================================================
$HostName = "211.233.89.245";
$DbName = "emma";
$DBUser = "emma";
$DBPass = "emma11119";

$connect = mysql_connect($HostName, $DBUser, $DBPass);
mysql_select_db($DbName, $connect);

if ($connect == false) {
    echo "데이타베이스 연결 실패!";
}**/
?>