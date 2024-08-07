<?php
include_once('./_common.php');

header('Content-Type: application/json'); // JSON 응답을 위한 헤더

// POST 요청을 통해 데이터를 받습니다.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stockId = $_POST['stockId'];

    if (updateStockStatus($stockId, 'R')) {
        // 성공 응답을 JSON 형식으로 전송
        echo json_encode(['status' => 'success', 'message' => '환전신청 성공!']);
    } else {
        // 실패 응답을 JSON 형식으로 전송
        echo json_encode(['status' => 'error', 'message' => '환전신청 실패!']);
    }
}

?>