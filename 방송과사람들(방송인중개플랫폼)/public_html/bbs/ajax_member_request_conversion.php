<?php
include_once('./_common.php');
include_once(G5_PATH."/model/model.php");

global $g5;
global $config;
$link = $g5['connect_db'];

$response = array( "message" => "" );
$_method = $_POST["_method"];
//$obj = str_replace('\\','',$_POST['obj']);
//$obj = json_decode($obj);
$model = new Model("member_request_conversion");
$g5_member = new Model("g5_member","mb_no");
try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $response['success'] = true;
            break;
        }

        case "post":
        {
            if($_SESSION['ss_mb_id']) {
                $check = $model->get(array("member_idx" => $member["mb_no"]));

                if($check) {
                    if($check['permit'] == 'false') throw new Exception("이미 신청하였습니다.");

                    $member["mb_join_division"] = $_POST['level'];
                    $member["mb_level"] = $_POST['level'];

                    $g5_member->put($member);
                }
                else {
                    $data["member_idx"] = $member["mb_no"];
                    $data["permit"] = "false";

                    $_idx = $model->post($data);
                }

            }else {
                throw new Exception("잘못된 경로입니다. 로그인한 회원만 이용 가능합니다.");
            }

            $response["_idx"] = $_idx;
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