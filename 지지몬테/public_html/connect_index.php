<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "zzmonte2r";
$Admin = "zzmonte2r";
$AdminPass = "jqql^yl5";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "zzmonte2r";
$root_dir = "/home/zzmonte2r/public_html"; //���� ���� ���
$home_dir = "http://www.letsit.kr/~zzmonte2r"; //���� ���� ���



?>
