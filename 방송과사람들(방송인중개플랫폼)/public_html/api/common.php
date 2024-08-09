<?php
//include_once("../class/Model.php");
//include_once("../class/File.php");
include_once("../class/Lib.php");

$jl = new JL();

$response = array("message" => "");
$_method = $_POST["_method"];

try {
    switch (strtolower($_method)) {
        case "check_file":
        {
            $obj = $jl->jsonDecode($_POST['obj']);
            $response['result'] = file_exists($jl->ROOT.$obj['file']);
            $response['11'] = $jl->ROOT.$obj['file'];
            $response['obj'] = $obj;
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