<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "yensan";
$Admin = "yensan";
$AdminPass = "fpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "yensan";
$root_dir = "/home/yensan/public_html"; //���� ���� ���
$home_dir = "http://www.renemall.co.kr"; //���� ���� ���
?>
