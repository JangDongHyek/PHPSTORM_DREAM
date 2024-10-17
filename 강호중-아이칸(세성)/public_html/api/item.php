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

        $item_idx = iconv('UTF-8','EUC-KR',$_POST['idx']);
        $item_pw = iconv('UTF-8','EUC-KR',$_POST['item_pw']);
        $co_num = iconv('UTF-8','EUC-KR',$_POST['co_num']);
        $tel = iconv('UTF-8','EUC-KR',$_POST['tel']);
        $email = iconv('UTF-8','EUC-KR',$_POST['email']);
        $address = iconv('UTF-8','EUC-KR',$_POST['address']);
        $zip = iconv('UTF-8','EUC-KR',$_POST['zip']);
        $my_bank_account = iconv('UTF-8','EUC-KR',$_POST['my_bank_account']);
        $my_bank_master = iconv('UTF-8','EUC-KR',$_POST['my_bank_master']);
        $sea_area = iconv('UTF-8','EUC-KR',$_POST['sea_area']);
        $sung_area = iconv('UTF-8','EUC-KR',$_POST['sung_area']);
        $khan_area = iconv('UTF-8','EUC-KR',$_POST['khan_area']);
        $my_bank_name = iconv('UTF-8','EUC-KR',$_POST['my_bank_name']);
        $insert_date = iconv('UTF-8','EUC-KR',$_POST['insert_date']);

        $arrays = array(
            "item_idx" => $item_idx,
            "co_num" => $co_num,
            "tel" => $tel,
            "email" => $email,
            "address" => $address,
            "zip" => $zip,
            "my_bank_account" => $my_bank_account,
            "my_bank_master" => $my_bank_master,
            "sea_area" => $sea_area,
            "sung_area" => $sung_area,
            "khan_area" => $khan_area,
            "my_bank_name" => $my_bank_name,
        );

        $sql = arrayToInsert("item_request",$arrays,true);

        //$sql = "insert into item_request
        //        (item_idx,co_num,tel,email,address,zip,my_bank_account,my_bank_master,sea_area,sung_area,khan_area,my_bank_name,insert_date)
        //        values
        //       ('$item_idx','$co_num','$tel','$email','$address','$zip','$my_bank_account','$my_bank_master','$sea_area','$sung_area','$khan_area','$my_bank_name',now())";

        mysql_query($sql, $dbconn);
        if(mysql_error()) echo mysql_error();
        else echo "true";

        break;

    case "delete" :
        $item_idx = iconv('UTF-8','EUC-KR',$_POST['idx']);
        $primary = $_SESSION['item_no'];

        if(!$primary) {
            echo "잘못된 접근입니다.";
            die();
        }

        $sql = "select * from item where item_no = '$primary' ";
        $result = mysql_query( $sql, $dbconn );
        $row_total = mysql_num_rows( $result );

        if(!$row_total) {
            echo "잘못된 접근입니다.";
            die();
        }

        $row = mysql_fetch_assoc( $result );

        $sql = arrayToInsert("item_log",$row,true);
        $result = mysql_query( $sql, $dbconn );

        if(mysql_error()) {
            echo mysql_error();
            die();
        }

        $sql = "delete from item where item_no = '$primary'";
        $result = mysql_query( $sql, $dbconn );

        if(mysql_error()) {
            echo mysql_error();
            die();
        }

        echo "true";
        break;
}


?>