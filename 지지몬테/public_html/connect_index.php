<?
//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "zzmonte2r";
$Admin = "zzmonte2r";
$AdminPass = "jqql^yl5";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}

//========================== 마트아이디 정보 ===================================
$mart_id = "zzmonte2r";
$root_dir = "/home/zzmonte2r/public_html"; //서버 절대 경로
$home_dir = "http://www.letsit.kr/~zzmonte2r"; //서버 절대 경로



?>
