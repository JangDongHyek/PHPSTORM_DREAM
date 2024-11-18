<?php
include_once('./_common.php');


$response = array( "message" => "" );
$_method = $_POST["_method"];

try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            if($_SESSION['bbs_num_code'] != $_POST["num"]) {
                throw new Exception("인증번호를 다시 확인해주세요.");
            }
            
            if(time() - $_SESSION["code_time"] > 600) {
                throw new Exception("인증시간이 지났습니다.");
            }
            $response['test'] = time() - $_SESSION["code_time"];
            $response['success'] = true;
            break;
        }

        case "post":
        {
//          혹시모를 보안 대비
            if(!$_SESSION["secu_code"]) {
                throw new Exception("보안정책에 위반되는 접근입니다.");
            }
            if(!$_POST["secu_code"]) {
                throw new Exception("보안정책에 위반되는 접근입니다.");
            }
            if($_SESSION["secu_code"] != $_POST["secu_code"]) {
                throw new Exception("보안정책에 위반되는 접근입니다.");
            }
            //보안키
            $secu="A2N9c8sSqQSzaaA";

            //난수생성
            $num = sprintf("%06d",rand(000000,999999));
            $_SESSION['bbs_num_code'] = $num;
            $_SESSION['code_time'] = time();
            $curl = curl_init();
            $mb_hp = $_POST["mb_hp"];
            $url = "http://erp.60chicken.com/bbs/cert_ajax.php?mb_hp=$mb_hp&num=$num&secu=$secu";

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',

            ));
            $response = curl_exec($curl);
            curl_close($curl);
//            $response['result'] = $url;
            $response['success'] = true;
            break;
        }
        case "put":
        {
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $response['success'] = true;
            break;
        }
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>