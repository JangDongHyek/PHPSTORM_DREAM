<?
//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "khj";
$Admin = "khj";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}

//========================== 마트아이디 정보 ===================================
$mart_id = "khj";
$root_dir = "/home/khj/public_html"; //서버 절대 경로
$home_dir = "http://www.itforu.co.kr/~khj"; //서버 절대 경로
?>
