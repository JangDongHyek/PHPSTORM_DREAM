<?
//========================== DB ���� ���� ======================================
$HostName = "localhost";
$DbName = "buseong_r";
$Admin = "buseong_r";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "����Ÿ���̽� ���� ����!";
}

//========================== ��Ʈ���̵� ���� ===================================
$mart_id = "buseong_r";
$root_dir = "/home/buseong_r/public_html"; //���� ���� ���
$home_dir = "http://www.doubleshopping.co.kr"; //���� ���� ���
?>
