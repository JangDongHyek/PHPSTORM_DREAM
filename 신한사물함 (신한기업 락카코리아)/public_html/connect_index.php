<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "rakca";
$Admin = "rakca";
$AdminPass = "wjsghk!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "rakca";
$root_dir = "/home/rakca/public_html"; //���� ���� ���
$home_dir = "http://www.���ѻ繰��.kr"; //���� ���� ���
?>
