<?php
include_once('./_common.php');

header('Content-Type: application/json'); // JSON 응답을 위한 헤더

// POST 요청을 통해 데이터를 받습니다.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stockId = $_POST['stockId'];
    $status = $_POST['status'];

    if ($status === '수락') {
        $status = 'Y';
    } else if ($status === '거절') {
        $status = 'F';
    } else if ($status === '취소') {
        $status = 'C';
    }

    if (updateStockStatus($stockId, $status)) {
        // 성공 응답을 JSON 형식으로 전송
        echo json_encode(['status' => 'success', 'message' => '상태수정 성공!']);
    } else {
        // 실패 응답을 JSON 형식으로 전송
        echo json_encode(['status' => 'error', 'message' => '상태수정 실패!']);
    }
}

?>