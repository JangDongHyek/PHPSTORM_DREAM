<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "jsbusan";
$Admin = "jsbusan";
$AdminPass = "ffpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "jsbusan";
$root_dir = "/home/jsbusan/public_html"; //���� ���� ���
$home_dir = "http://jsbusan.com"; //���� ���� ���
?>
