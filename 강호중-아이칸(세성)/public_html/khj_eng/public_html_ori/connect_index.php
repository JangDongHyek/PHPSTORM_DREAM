<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "khj_eng";
$Admin = "khj_eng";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "khj";
$root_dir = "/home/khj_eng/public_html"; //���� ���� ���
$home_dir = "http://eng.wickhan.com"; //���� ���� ���
?>
