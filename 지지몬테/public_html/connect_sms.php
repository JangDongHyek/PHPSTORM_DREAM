<?
/** //================== SMS DB ���� ���� ====================================================*/
$HostName = "211.51.221.165";
$DbName = "emma";
$DBUser = "emma";
$DBPass = "wjsghk!@#";

$connect = mysql_connect($HostName, $DBUser, $DBPass);
mysql_select_db($DbName, $connect);

if ($connect == false) {
    echo "����Ÿ���̽� ���� ����!";
}
?>