<?php

include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
    
    /* 디바이스 토큰 저장 */
    case 'setDeviceToken':
        $deviceToken = $_POST['deviceToken'];
        
        $sql = "UPDATE
                    g5_member
                SET
                    device_token = '{$deviceToken}'
                WHERE
                    mb_id = '{$member['mb_id']}';";
        
        $result['deviceToken'] = $deviceToken;
        $result['result'] = sql_query($sql);
    break;
        
    /* 인수증 저장 */
    case 'saveSignPad':
        $dispatch_idx = $_POST['dispatch_idx'];
        $dataUrl = $_POST['dataUrl'];
        
         $sql = "
                INSERT INTO 
                    signpad_list
                SET
                    dispatch_idx = '{$dispatch_idx}',
                    data_url = '{$dataUrl}'
            ";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = "인수증 발급에 실패하였습니다.\n고객센터에 문의바랍니다.";
            die(json_encode($result));
        }
        
        $sql = "
                UPDATE
                    dispatch_list
                SET
                    status_code = '4',
                    complete_date = NOW()
                WHERE
                    idx = '{$dispatch_idx}'
            ";
        
        $result['result'] = sql_query($sql);
    break;
        
    /* 배송기사 배송현황 상태저장 */        
    case 'saveDeliveryStatus':
        $dispatch_idx = $_POST['dispatch_idx'];
        $dis_status = $_POST['dis_status'];
        $dis_status_text = $_POST['dis_status_text'];
        $delivery_time = $_POST['delivery_time'];
        
        $from_time = explode('/', $delivery_time)[0];
        $to_time = explode('/', $delivery_time)[1];
        
        $sql = "
                UPDATE
                    dispatch_list
                SET
                    dis_status_code = '{$dis_status}',
                    dis_status_text = '{$dis_status_text}',
                    from_time = '{$from_time}',
                    to_time = '{$to_time}'
                WHERE
                    idx = '{$dispatch_idx}'
            ";
        
        $result['result'] = sql_query($sql);
    break;
}

if(empty($result['result'])){
    $result['msg'] = $_POST['mode']." ERROR";
}

die(json_encode($result));
?>