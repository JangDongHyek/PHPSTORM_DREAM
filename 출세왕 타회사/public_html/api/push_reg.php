<?php
define('_CHK_', true);
try{
    $device_uuid = $_POST['device_uuid'];
    $push_register_id = $_POST['push_register_id'];
    $device_platform = $_POST['device_platform'];


    $data = array();
    $data['app_id'] = "successking";
    $data['device_uuid'] = $_POST['device_uuid'];
    $data['push_register_id'] = $_POST['push_register_id'];
    $data['device_platform'] = $_POST['device_platform'];
    //$data['mem_id'] = $_POST['mem_id'];
    //$data['is_test'] = true;

    $url = "https://push.softwow.co.kr/api/device_reg.php";

    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt ($ch, CURLOPT_SSLVERSION,1);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt ($ch, CURLOPT_TIMEOUT, 300);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    $curl_result = curl_exec ($ch);

    echo $curl_result;
}catch(Exception $e){
    $result['state'] = "error";
    $result['msg'] = $e->getLine()." : ".$e->getMessage();
    echo json_encode($result);
    exit;
}

?>