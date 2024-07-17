<?php
include_once('../common.php');
include_once(G5_PATH."/model/model.php");

$response = array( "message" => "" );
$_method = $_POST["_method"];

$model = new Model("new_category2","_idx",false);
try {
    switch (strtolower($_method)) {
        case "gets":
        {
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $data = $model->get(array());
            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "post":
        {
            $obj = str_replace("\\","",$_POST['obj']);
            $model->post(array(
                "datas" => $obj
            ));
            $response['og'] = $_POST['obj'];
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