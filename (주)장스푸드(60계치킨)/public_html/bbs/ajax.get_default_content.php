<?php
include_once("./_common.php");

$ca_name = $_POST['ca_name'];

$row = sql_fetch("SELECT * FROM g5_board WHERE bo_table = 'cs'");

// 기본 내용 설정
$default_content = '';
if ($ca_name == '칭찬') {
    $default_content = $row['bo_1'];
} else if ($ca_name == '제안') {
    $default_content = $row['bo_2'];
} else if ($ca_name == '불만') {
    $default_content = $row['bo_3'];
} else if ($ca_name == '기타문의') {
    $default_content = $row['bo_4'];
} else if ($ca_name == '신고') {
    $default_content = $row['bo_5'];
} else if ($ca_name == '공지') {
    $default_content = $row['bo_6'];
}


// 결과 배열을 JSON 형식으로 변환하여 출력
echo json_encode($default_content);

?>