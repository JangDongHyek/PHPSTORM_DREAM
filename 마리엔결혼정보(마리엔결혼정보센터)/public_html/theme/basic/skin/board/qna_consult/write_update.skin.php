<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//alert('자녀결혼문의 신청이 접수되었습니다.', G5_URL);

$kakao_arr = array("member_name" => $wr_name);
for ($admin_i = 0; $admin_i < count($admin_tel); $admin_i++) {
    sendAlimTalk(4, $kakao_arr, $admin_tel[$admin_i]);
}

alert('곧 연락드리겠습니다.', G5_URL);
?>