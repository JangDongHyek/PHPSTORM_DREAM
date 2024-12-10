<?php
/************************************************
사인 업로드
************************************************/
include_once('./_common.php');

$json = array();
$json['result'] = "F";

// print_r($_POST);
$img = $_POST['sign'];

$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

if ($sign_type == "name") $_POST['page'] = $_POST['page']."_name";	// 이름서명시
$file_name = $_POST['page'] . '_' . time().getRandomString(4, "int") . '.png';

$file = G5_SIGN_PATH . '/' . $file_name;

$success = file_put_contents($file, $data);

if ($success) {
	$json['result'] = "T";
	$json['file'] = $file_name;
}

echo json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>
