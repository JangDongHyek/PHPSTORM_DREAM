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
            echo "�������� �����մϴ�";
            die();
        }
        $boardUser = getID($board['username']);
        $loginUser = getID();
        $content = "{$loginUser}���� ���ſ�û ������ ����";
        postBonus($board['price'],$content,$boardUser);

        $content = "{$boardUser}�Բ� ���ſ�û ������ ����";
        postBonus("-".$board['price'],$content);

        echo "true";
        break;
}


?>