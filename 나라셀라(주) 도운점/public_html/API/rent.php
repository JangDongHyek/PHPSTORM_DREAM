<?php

/*

error_reporting(E_ALL);
ini_set('display_errors', '1');

*/

include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
    case 'sumbitRental':        
        $floor = $_POST['floor'];
        $rentDate = $_POST['rentDate'];
        $rentName = $_POST['rentName'];
        $rentTel = $_POST['rentTel'];
        $rentEmail = $_POST['rentEmail'];
        $rentTime = $_POST['rentTime'];
        $isSetting = $_POST['isSetting'];
        $isCleaning = $_POST['isCleaning'];
        $glassRental = $_POST['glassRental'];
        $person = $_POST['person'];
        $category = $_POST['category'];
        $detailSchedule = $_POST['detailSchedule'];
        $request = $_POST['request'];
        
        if(!$is_member){            
            $result['msg'] = '로그인 후 이용가능한 서비스입니다.';
            die(json_encode($result));    
        }
        
        $sql = "
                INSERT INTO 
                    rental_list
                SET
                    mb_id = '{$member['mb_id']}',
                    floor = '{$floor}',
                    rentDate = '{$rentDate}',
                    rentName = '{$rentName}',
                    rentTel = '{$rentTel}',
                    rentEmail = '{$rentEmail}',
                    rentTime = '{$rentTime}',
                    isSetting = '{$isSetting}',
                    isCleaning = '{$isCleaning}',
                    glassRental = '{$glassRental}',
                    person = '{$person}',
                    category = '{$category}',
                    detailSchedule = '{$detailSchedule}',
                    request = '{$request}';";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '대관신청 에러';
            echo json_encode($result);
            exit;
        }
    break;
        
    case 'changeStatus':
        $rental_idx = $_POST['rental_idx'];
        $status = $_POST['status'];
        
        $sql = "
                UPDATE
                    rental_list
                SET
                    status = '{$status}'
                WHERE
                    rental_idx = '{$rental_idx}';";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '상태변경 에러';
            die(json_encode($result));
        }
    break;
}

die(json_encode($result));

?>