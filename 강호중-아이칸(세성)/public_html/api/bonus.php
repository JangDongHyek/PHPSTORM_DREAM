<?php
header('Content-Type: application/json; charset=euc-kr');
include_once("../newlib.php");
$response = array("message" => "");
$_method = $_POST["_method"];

$HostName = "localhost";
$DbName = "khj";
$Admin = "khj";
$AdminPass = "tpsxja!@#";

$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
mysql_select_db($DbName, $dbconn);




switch ($_method) {
    case "post" :
        $userBonus = getTotalBonus();
        $board = getNewBoard("120");
        if($userBonus < (int)$board['price']) {
            echo "충전금이 부족합니다";
            die();
        }
        $boardUser = getID($board['username']);
        $loginUser = getID();
        $content = "{$loginUser}님이 구매요청 충전금 보냄";
        postBonus($board['price'],$content,$boardUser);

        $content = "{$boardUser}님께 구매요청 충전금 보냄";
        postBonus("-".$board['price'],$content);

        echo "true";
        break;
}


?>