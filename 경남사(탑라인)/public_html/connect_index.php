<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "kns";
$Admin = "kns";
$AdminPass = "ffpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "kns";
$root_dir = "/home/kns/public_html"; //���� ���� ���
$home_dir = "http://www.topline.kr"; //���� ���� ���
?>
