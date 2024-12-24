<?php
include_once('./_common.php');

// POST 요청을 통해 데이터를 받습니다.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stockId = $_POST['stockId'];
    $accountNumber = $_POST['accountNumber'];
    $accountOwner = $_POST['accountOwner'];
    $accountBank = $_POST['accountBank'];

    if (updateStockStatus($stockId, 'R')) {
        echo "업데이트 성공!";
    } else {
        echo "업데이트 실패!";
    }
}
?>
