<?php
$sub_id = "user_cart";
include_once('./_common.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}
//
//if ($member['mb_approval_request'] == 'Y' && $member['mb_approval'] == 'N') { // 프로필 승인 여부 확인
//    alert("프로필 심사 중입니다.\\n심사 완료 시 모든 컨텐츠 이용이 가능합니다.");
//}
//else if($member['mb_approval_request'] == 'N') { // 프로필 미작성 시 회원가입완료 페이지로 이동
//    alert("프로필을 작성해주세요.\\n작성 후 심사 완료 시 모든 컨텐츠 이용이 가능합니다.");
//}
//
//// 비공개 회원 체크
//if($member['show_yn'] == 'N' && $member['mb_id'] != 'hong') {
//    alert('비공개 회원으로 컨텐츠를 이용할 수 없습니다.');
//}

$is_mypage = "user_cart";
$g5['title'] = '결제후회원';
include_once('./_head.php');

$mb_no = $member['mb_no'];

/**
 * 앱 심사용 - 신고한 사용자 숨김
 * mem_new.php, user_cart.php, ajax.change_option.php
 */
//if($member['mb_id'] == 'hong') {
//    if(!empty(blockUser($member['mb_id']))) {
//        $block = blockUser($member['mb_id']);
//        $sql_add .= " and mb.mb_id not in ({$block}) ";
//    }
//}
$sql_add .= " and mi.cart_mb_no != '91' "; // 테스트아이디

$count = sql_fetch(" select count(*) as count from g5_member_cart as mi where mi.mb_no = '{$mb_no}' {$sql_add} ")['count'];

$sql = " select date_format(mi.wr_datetime, '%Y/%m/%d %H:%i') as wr_datetime, mi.cart_mb_no as cart_mb_no, mb.* from g5_member_cart as mi
         left join g5_member mb on mi.cart_mb_no = mb.mb_no 
         where mi.mb_no = '{$mb_no}' {$sql_add} and mb.show_yn = 'Y'
         order by mi.wr_datetime desc ";
$result = sql_query($sql);

include_once($member_skin_path.'/user_cart.skin.php');

include_once('./_tail.php');
?>
