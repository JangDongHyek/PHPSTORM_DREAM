<?php
$sub_id = "mypage";
include_once('./_common.php');

// 로그인 확인
if(!$is_member){
    alert("회원만 사용가능한 페이지입니다.\\n로그인 후 다시 이용해주세요.", G5_BBS_URL . '/login.php');
}

$is_mypage = "mypage";
$g5['title'] = '마이페이지';
include_once('./_head.php');

$sql = " select * from {$g5['member_table']} where mb_no = '{$member['mb_no']}' ";
$mb = sql_fetch($sql);

// 성별에 따라 폰트 색상 및 디폴트 이미지 변경
if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
if($mb['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';

// 직업
$sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
$job = sql_fetch($sql)['co_main_code_value'];

// 프로필 이미지 (첫번째 사진 한장)
$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx limit 1";
$file = sql_fetch($sql);

// 생년월일로 나이 계산
$birthyear = substr($mb['mb_birth'],0,4);
$nowyear = date("Y");
$age = '';
if(!empty($birthyear)) {
    $age = $nowyear - $birthyear + 1;
}

// 이름 첫글자 제외 O처리 -- 마이페이지에서는 필요 x
$name = $mb['mb_name'];
//$name = iconv_substr($mb['mb_name'], 0, 1, "utf-8");
//for ($i = 0; $i < (mb_strlen($mb['mb_name'], "utf-8") -1); $i++) {
//    $name .= 'O';
//}

// 읽지 않은 메세지 있을 경우 class = "new" 표시 (삭제 메세지 제외)
$sql = " select count(*) as count from g5_message as me
         left join g5_member as mb on mb.mb_no = me.send_mb_no 
         where receive_mb_no = {$member['mb_no']} and (message_state is null or message_state = '') and receive_delete_yn = 'N' and mb.mb_level != 1 ";
$no_read_count = sql_fetch($sql)['count'];

// 수락/거절하지 않은 데이트 신청 있을 경우 class = "new" 표시 (삭제 데이트 제외)
$sql = " select count(*) as count from g5_propose as pr
         left join g5_member as mb on mb.mb_no = pr.send_mb_no 
         where receive_mb_no = {$member['mb_no']} and (propose_state is null or propose_state = '') and receive_delete_yn = 'N' and mb.mb_level != 1 ";
$no_confirm_count = sql_fetch($sql)['count'];

include_once($member_skin_path.'/mypage.skin.php');
include_once('./_tail.php');
?>