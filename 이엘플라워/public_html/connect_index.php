<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "elfower";
$Admin = "elfower";
$AdminPass = "&nvyu*p6";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "elfower";
$root_dir = "/home/elfower/public_html"; //���� ���� ���
$home_dir = "http://www.letsit.kr/~elfower"; //���� ���� ���
?>
