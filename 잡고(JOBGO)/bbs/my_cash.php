<?php
$sub_id = "my_cash";
include_once('./_common.php');

$g5['title'] = '캐쉬 충전';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

$mb = get_member($_SESSION['ss_mb_id']);

$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS));
include_once($member_skin_path.'/my_cash.skin.php');

include_once('./_tail.php');
?>