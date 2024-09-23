<?php

/*

error_reporting(E_ALL);
ini_set('display_errors', '1');

*/

include_once('../common.php');

$result = array('result' => false, 'msg' => '');

switch($_POST['mode']){
    case 'deleteItem':
        $table = $_POST['table'];
        $key = $_POST['key'];
        $idx = $_POST['idx'];
        
        $sql = "
                UPDATE
                    $table
                SET
                    isUse = IF(isUse = 'Y', 'N', 'Y')
                WHERE
                    $key = '{$idx}';";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '변경 에러';
            echo json_encode($result);
            exit;
        }
    break;
        
    case 'sendSms':
        $msg = $_POST['msg'];
        $hpArr = $_POST['hpArr'];
        $sendHp = unHyphen($_POST['sendHp']);                
        $byte = $_POST['byte'];        
        $msgType = $byte > 90? 'LMS(장문)' : 'SMS(단문)';
        
        foreach($hpArr as $key=>$data){
            $mbHp = unHyphen($data);
            goMMS($mbHp, $sendHp, $msg);
        }
        
        $mbHpJson = json_encode($hpArr);
        
        $sql = "
            INSERT INTO 
                mms_log
            SET
                sendHp = '{$sendHp}',                
                mbHpJson = '{$mbHpJson}',
                msg = '{$msg}',
                byte = '{$byte}',
                msgType = '{$msgType}'";
        
        $result['result'] = sql_query($sql);
        
        if(empty($result['result'])){
            $result['msg'] = '문자 등록로그 실패';
            echo json_encode($result);
            exit;
        }
    break;

    case 'chkSendAlimTalk':
        $sendCode = $_POST['sendCode'];

        // 발송데이터 전문생성
        $api_server = WIDESHOT_SERVER . "/api/v1/message/result?sendcode=" . urlencode($sendCode); // query string으로 sendcode 추가
        $headers = array('sejongApiKey: ' . WIDESHOT_KEY);

        $opts = array(
            CURLOPT_URL => $api_server,
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_CUSTOMREQUEST => "GET", // 불필요하므로 제거
            //CURLOPT_POST => true,           // 불필요하므로 제거
            //CURLOPT_POSTFIELDS => http_build_query($post_body), // 불필요하므로 제거
            CURLOPT_TIMEOUT => 1000,  // sec
        );

        // 응답요청
        $curl_session = curl_init();
        curl_setopt_array($curl_session, $opts);
        $curl_data = curl_exec($curl_session);

        print_r(curl_getinfo($curl_session)); //모든정보
        print_r(curl_errno($curl_session)); //에러번호
        print_r(curl_error($curl_session)); //에러정보

        $resMessage = (curl_error($curl_session))? null : $curl_data;
        $res_data = array();

        if ($resMessage != null) {
            $header_size = curl_getinfo($curl_session, CURLINFO_HEADER_SIZE);
            //$header = substr($resMessage, 0, $header_size);
            $body = substr($resMessage, $header_size);			// {"code":"200","sendCode":"1615338658ORK18"}
            $body_de = json_decode($body, true);

            $res_data['code'] = $body_de['code'];
            $data1 = $body_de['data'];
            $resultCode = $data1['resultCode'];
            $res_data['sendCode'] = $resultCode;

        } else {
            $res_data['code'] = "-1";
            $res_data['sendCode'] = "통신실패";
        }

        curl_close($curl_session);

        $res_data['post_body'] = $post_body;

        return $res_data;

        // DB저장
        /*
        $sql = "INSERT INTO log_kakao_alim SET
                od_id = '{$od_id}',
                template = '{$post_body['templateCode']}',
                req_data = '".json_encode($post_body, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."',
                mb_no = '{$mb_no}',
                mb_hp = '{$mb_hp}',
                res_code = '{$res_data['code']}',
                res_sendCode = '{$res_data['sendCode']}'
                ";
        sql_query($sql);
        */


        break;
}

die(json_encode($result));

?>