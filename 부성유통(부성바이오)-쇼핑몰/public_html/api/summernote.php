<?php
// jl/JlApi.php

header('Content-Type: application/json');

//ROOT 위치 찾기
$root = __FILE__;
$position = strpos($root, "public_html");

if ($position !== false) {
    $ROOT = substr($root, 0, $position)."public_html";
}else {
    echo "Jl INIT() : ROOT 위치를 찾을 수 없습니다.";
}



// 업로드 경로 설정
$uploadDir = $ROOT.'/summernote/';

// 업로드 디렉토리가 없으면 생성
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755);
}

// 기본 응답 생성
$response = array(
    'status' => 'error',
    'message' => 'Unknown error occurred'
);

// POST 요청 확인
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 파일 데이터 확인
    if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['upfile']['tmp_name'];
        $fileName = basename($_FILES['upfile']['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // 새로운 파일 이름 생성
        $newFileName = uniqid('file_') . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        // 파일 이동
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $response['status'] = 'success';
            $response['file'] = array(
                'src' => '/summernote/' . $newFileName
            );
            $response['message'] = 'File uploaded successfully';
        } else {
            $response['message'] = 'Failed to move uploaded file';
        }
    } else {
        $response['message'] = 'No file uploaded or upload error';
    }
} else {
    $response['message'] = 'Invalid request method';
}

// 수동으로 JSON 응답 생성
echo '{';
echo '"status":"' . $response['status'] . '",';
echo '"message":"' . addslashes($response['message']) . '"';
if ($response['status'] == 'success') {
    echo ',"file":{"src":"' . addslashes($response['file']['src']) . '"}';
}
echo '}';
exit;
?>
