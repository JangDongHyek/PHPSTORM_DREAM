<?
//================== DB 설정 파일을 불러옴 ===============================================
include "./connect.php";
?>

<?php
echo $_SESSION["UnameSess"];

$sql = "SELECT sum(bonus) as total_bonus FROM `bonus` WHERE 1 and id = '{$_SESSION["UnameSess"]}' group by id";
$result = mysql_query( $sql, $dbconn );
$row = mysql_fetch_array( $result );
$total_bonus = $row['total_bonus'];
if((int)$total_bonus < 600) {
    echo 1;
}
?>