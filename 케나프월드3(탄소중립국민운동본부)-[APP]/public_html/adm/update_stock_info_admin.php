<?php
include_once('./_common.php');

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if (!count($_POST['chk'])) {
    alert($_POST['btn_submit'] . ' 하실 항목을 하나 이상 선택하세요.');
}

$status = "";
if ($_POST['btn_submit'] == '선택수락') {
    $status = "수락";
} else if ($_POST['btn_submit'] == '선택거절') {
    $status = "거절";
} else if ($_POST['btn_submit'] == '선택취소') {
    $status = "취소";
} else if($_POST['btn_submit'] == '선택삭제') {
    $status = "삭제";
} else {
    alert('올바른 방법으로 이용해 주세요.');
}

for ($i = 0; $i < count($_POST['chk']); $i++) {

    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];
    $stockId = $stock_id[$k];

    //echo 'stockId >>> '.$stockId;
    //echo 'chk >>> '.$k;

    if ($status === '수락') {
        $status = 'Y';
    } else if ($status === '거절') {
        $status = 'F';
    } else if ($status === '취소') {
        $status = 'C';
    } elseif ($status === '삭제') {
        $status = 'D';
    }

    if (updateStockStatus($stockId, $status)) {
        //echo '성공 >>> ';
    } else {
        //echo '실패 >>> ';
        //롤백처리 필요
        alert('업데이트에 실패했습니다' ,G5_ADMIN_URL . "/stock_list.php");
    }
}

if($status === 'D'){
    $page = $_POST['page'];
    alert('업데이트에 성공했습니다' ,G5_ADMIN_URL . "/stock_payment.php?sst=&sod=&sfl=&stx=&page={$page}");
}else{
    alert('업데이트에 성공했습니다' ,G5_ADMIN_URL . "/stock_list.php");
}

?>