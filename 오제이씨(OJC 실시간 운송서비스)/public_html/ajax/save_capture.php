<?php
include_once('../common.php');

$uploadDir = G5_DATA_PATH.'/file/capture';

// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
@mkdir($uploadDir, G5_DIR_PERMISSION);
@chmod($uploadDir, G5_DIR_PERMISSION);

if (isset($_POST['image'])) {
    $data = $_POST['image'];
    // dataURL 형식에서 이미지 데이터 추출
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);

    // 접두사를 가진 파일이 이미 있는지 검사
    $exists = glob($uploadDir ."/". $idx."_". '*.png');

    if (!$exists) {
        // 이미지 파일 저장
        $imageName = $idx . "_" . get_uniqid() . '.png';
        $imagePath = $uploadDir."/".$imageName;
        file_put_contents($imagePath, $data);

        $responseUrl = G5_DATA_URL ."/file/capture/". $imageName;
    } else {
        // 이미 파일이 있으면 기존 파일의 경로를 사용
        $responseUrl = str_replace(G5_DATA_PATH, G5_DATA_URL, $exists[0]);
        //$responseUrl = G5_DATA_URL ."/file/capture/".  $exists[0];
    }



    // 저장된 이미지 URL을 클라이언트에 반환
    echo json_encode(['imageUrl' => $responseUrl, 'idx'=>$idx]);
}