<?php
include_once('./_common.php');
//$response = 'a';/

$form = $_POST["data"];
//$_method = $form["_method"];
//array_push($response,$_method);
try{
    switch(strtolower($_method)){
        case "gets": {
            $response['success'] = true;
            break;
        }

        case "get": {
            $response['success'] = true;
            break;
        }

        case "post": {
            $response['success'] = true;
            break;
        }
        case "put": {
            $response['success'] = true;
            break;
        }
        case "delete": {
            $response['success'] = true;
            break;
        }
    }
}
catch(Exception $e){
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>