<?php
include_once("../jl/JlConfig.php");

if(JL_SESSION_PATH) {
    if(is_dir($jl->ROOT.JL_SESSION_PATH)) { // 해당 폴더가있다면 세션 공유를 위해
        ini_set("session.save_path", $jl->ROOT.JL_SESSION_PATH); // 그누보드 세션 경로 적용
        session_start();
    }else {
        $jl->error("JlApi : SESSION_PATH 를 사용하지만 폴더가 존재하지않습니다.");
    }
}

$service = new JlService($_POST,$_FILES,$_SESSION);
$method = $_POST['_method'];

$response = array(
    "success" => false,
    "message" => "_method가 존재하지않습니다."
);

echo $service->jsonEncode($service->method());
?>