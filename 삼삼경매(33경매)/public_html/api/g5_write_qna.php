<?php
include_once('../common.php');
include_once(G5_PATH."/model/model.php");

$response = array( "message" => "" );
$_method = $_POST["_method"];

$model = new Model("g5_write_qna","wr_id");
try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $data = $model->get(array(
                "wr_id" => $_POST['wr_id']
            ));

            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "post":

            
        {
            $obj = str_replace('\\','',$_POST['obj']);
            $obj = json_decode($obj,true);

            foreach($obj as $key => $value) {
                if(is_array($obj[$key])) $obj[$key] = json_encode($obj[$key],JSON_UNESCAPED_UNICODE);
            }
            $model->post($obj);
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