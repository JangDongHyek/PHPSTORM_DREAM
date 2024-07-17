<?php
include_once('./_common.php');
global $g5;
global $config;
$link = $g5['connect_db'];

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
            $sql = "SELECT * FROM `g5_member` WHERE mb_nick = '{$_POST['mb_nick']}'";
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

            $filters = explode(",",$config["cf_filter"]);
            foreach ($filters as $filter) {
                if(strpos($_POST['mb_nick'],$filter) !== false) {
                    throw new Exception("욕설이 포함되어있는 닉네임은 불가능합니다.");
                    break;
                }
            }

            $response['data'] = $data;
            $response['config'] = $filters;
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