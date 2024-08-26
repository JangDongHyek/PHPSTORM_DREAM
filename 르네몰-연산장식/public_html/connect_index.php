<?
//========================== DB 접속 정보 ======================================
$HostName = "localhost";
$DbName = "yensan";
$Admin = "yensan";
$AdminPass = "fpcm080";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);

if ($dbconn == false) {
    echo "데이타베이스 연결 실패!";
}

//========================== 마트아이디 정보 ===================================
$mart_id = "yensan";
$root_dir = "/home/yensan/public_html"; //서버 절대 경로
$home_dir = "http://www.renemall.co.kr"; //서버 절대 경로
?>
