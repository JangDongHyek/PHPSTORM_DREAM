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
$user_model = new Model("g5_member","mb_no");
try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $sql = "";
            $data = array();

            if(function_exists('mysqli_query') && G5_MYSQLI_USE) {
                $result = @mysqli_query($link, $sql);
                if(!$result) throw new Exception(mysqli_error($link));
                while($row = mysqli_fetch_assoc($result)){
                    array_push($data, $row);
                }
            } else {
                $result = @mysql_query($sql, $link);
                if(!$result) throw new Exception(mysql_error());
                while($row = mysql_fetch_assoc($result)){
                    array_push($data, $row);
                }
            }

            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "post":
        {
            $response['success'] = true;
            break;
        }
        case "put":
        {
            $_idx = $_POST["_idx"];
            $data = $model->get(array("_idx" => $_idx));
            $user = $user_model->get(array("mb_no" => $data["member_idx"]));

            if($data["u_date"] != "0000-00-00 00:00:00") throw new Exception("이미 승인이 완료된 건입니다.");

            $user["mb_level"] = 3;
            $user["mb_join_division"] = 3;
            $user_model->put($user);

            $data["permit"] = "true";
            $model->put($data);

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