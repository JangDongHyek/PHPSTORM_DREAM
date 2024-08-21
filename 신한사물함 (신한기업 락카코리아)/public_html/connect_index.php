<?
//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "rakca";
$Admin = "rakca";
$AdminPass = "wjsghk!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}

//========================== 마트아이디 정보 ===================================
$mart_id = "rakca";
$root_dir = "/home/rakca/public_html"; //서버 절대 경로
$home_dir = "http://www.신한사물함.kr"; //서버 절대 경로
?>
