<?
/** //================== SMS DB ���� ���� ====================================================
$HostName = "211.233.89.245";
$DbName = "emma";
$DBUser = "emma";
$DBPass = "emma11119";

$connect = mysql_connect($HostName, $DBUser, $DBPass);
mysql_select_db($DbName, $connect);

if ($connect == false) {
    echo "����Ÿ���̽� ���� ����!";
}**/
?>