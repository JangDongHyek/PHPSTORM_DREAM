<?php
include_once('./_common.php');

$count = count($_POST['chk_wr_id']);

if(!$count) {
    alert($_POST['btn_submit'].' 하실 항목을 하나 이상 선택하세요.');
}

if($_POST['btn_submit'] == '선택삭제' || $_POST['btn_submit'] == 'Delete Selection') {
    include './delete_all.php';
} else if($_POST['btn_submit'] == '선택복사' || $_POST['btn_submit'] == 'Selective Copy') {
    $sw = 'copy';
    include './move.php';
} else if($_POST['btn_submit'] == '선택이동' || $_POST['btn_submit'] =='Selective Move') {
    $sw = 'move';
    include './move.php';
} else {
    alert('올바른 방법으로 이용해 주세요.');
}
?>