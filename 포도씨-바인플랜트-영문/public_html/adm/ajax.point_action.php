<?php
include_once('./_common.php');

/** 관리자페이지-회원관리-포인트관리 포인트 적립/차감 이벤트 (ajax) **/

$mb = get_member($reg_mb_id); // 회원 정보
$input_point = str_replace(',', '', $input_point); // 콤마 제거

if($input_mode == '차감') {
    if($mb['point'] < $input_point) { // 회원이 보유한 포인트보다 차감할 포인트가 더 많으면
        die('fail');
    }
}

// 등급포인트 (대상아이디, 구분(적립/차감), 적립기준, 포인트, 내용, 연관아이디, 연관테이블, 연관idx)
$result = gradePointInsert($reg_mb_id, $input_mode, '관리자', $input_point, $input_content, 'admin');

if($result) {
    die('success');
}
?>