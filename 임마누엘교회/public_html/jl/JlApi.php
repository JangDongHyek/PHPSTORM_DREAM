<?php
include_once("../jl/JlConfig.php");

if(is_dir($jl->ROOT.'/data/session')) { // 해당 폴더가있다면 세션 공유를 위해
    ini_set("session.save_path", $jl->ROOT."/data/session"); // 그누보드 세션 경로 적용
    session_start();
}

$service = new JlService($_POST,$_FILES,$_SESSION);
$method = $_POST['_method'];

$response = array(
    "success" => false,
    "message" => "_method가 존재하지않습니다."
);

echo $service->jsonEncode($service->method());
?>