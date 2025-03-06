<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$kakao_arr = array("member_name"=> $wr_name);
for($admin_i = 0; $admin_i<count($admin_tel); $admin_i++){
    sendAlimTalk(0,$kakao_arr,$admin_tel[$admin_i]);
}

alert('간편상담신청이 접수되었습니다.', G5_URL);
?>