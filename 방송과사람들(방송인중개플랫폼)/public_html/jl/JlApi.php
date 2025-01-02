<?php
include_once("../jl/JlConfig.php");

$service = new JlService($_POST,$_FILES);
$method = $_POST['_method'];

$response = array(
    "success" => false,
    "message" => "_method가 존재하지않습니다."
);

echo $service->jsonEncode($service->method());
?>