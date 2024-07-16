<?php
include_once('./_common.php');

$sql = " select * from g5_business information where p_idx = {$idx} "; // 2차 분류
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $sql = " delete from g5_business_information where p_idx = {$row['idx']} "; // 3차 분류 DB 삭제
    sql_query($sql);

    $sql = " delete from g5_business_information_img where bi_idx = {$row['idx']} "; // 2차 분류 이미지 DB 삭제
    sql_query($sql);

    unlink(G5_DATA_PATH . '/file/business/' . $row['bi_img_file']); // 2차 분류 이미지 파일 삭제 (서버)
}

$sql = " delete from g5_business_information where p_idx = {$idx} "; // 2차 분류 DB 삭제
sql_query($sql);

$sql = " delete from g5_business_information where idx = {$idx} "; // 1차 분류 DB 삭제
$result = sql_query($sql);

if($result) {
    die('success');
}
else {
    die('fail');
}
?>