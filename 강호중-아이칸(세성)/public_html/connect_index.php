<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "khj";
$Admin = "khj";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "khj";
$root_dir = "/home/khj/public_html"; //���� ���� ���
$home_dir = "http://www.itforu.co.kr/~khj"; //���� ���� ���
?>
