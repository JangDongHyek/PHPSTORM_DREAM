<?php
$sub_id = "mem_view";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

// 비공개 회원 체크
if($member['show_yn'] == 'N' && $member['mb_id'] != 'hong') {
    alert('비공개 회원으로 컨텐츠를 이용할 수 없습니다.');
}

$mb_no = $_GET['mb_no'];

$sql = " select * from {$g5['member_table']} where mb_no = '{$mb_no}' ";
$mb = sql_fetch($sql);

// 성별에 따라 폰트 색상 및 디폴트 이미지 변경
if($mb['mb_sex'] == '여')  $bg = 'fe'; else $bg = 'male';
if($mb['mb_sex'] == '여')  $default_img = 'img_cover02.png'; else $default_img = 'img_cover01.png';

// 직업
//$sql = " select co_main_code_value from g5_code where co_code_name = '사회적 역할' and co_code = '{$mb['mb_social_role']}' ";
//$job = sql_fetch($sql)['co_main_code_value'];

// 프로필 이미지 (첫번째 사진 한장)
$sql = " select * from g5_member_img where mb_no = {$mb['mb_no']} order by thumb is null asc, idx limit 1";
$file = sql_fetch($sql);

// 생년월일로 나이 계산
$birthyear = substr($mb['mb_birth'],0,4);
$nowyear = date("Y");
$age = $nowyear - $birthyear + 1;

// 이름 첫글자 제외 O처리
$name = iconv_substr($mb['mb_name'], 0, 1, "utf-8");
for ($i = 0; $i < (mb_strlen($mb['mb_name'], "utf-8") -1); $i++) {
    if($i < 2) {
        $name .= 'O';
    }
}

// 본인은 관심있어요/대화신청 숨김
if($member['mb_no'] == $mb['mb_no']) { $hide = 'hide'; } else { $hide = ''; }

// 21.05.04 본인에게 메세지 보낸 사람은 블러 처리 하지 않음, 15만나 차감으로 프로필 사진 조회한 사람은 블러 처리 하지 않음
$blur = 'blur';
/*$blur2 = 'blur';*/
$message = sql_fetch(" select count(*) as count from g5_message where send_mb_no = {$mb['mb_no']} and receive_mb_no = {$member['mb_no']}; ")['count'];
$profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$mb['mb_id']}' and profile_name = '프로필사진' ; ")['count'];
if($message > 0 || $profile_view > 0 || $member['mb_no'] == $mb['mb_no']|| $ios_payment_test) {
//if( $member['mb_no'] == $mb['mb_no'] || $ios_payment_test) {
    $blur = 'noblur';
}
/*if($message > 0) { // 출석교회는 메세지 수신 시에만 블러 처리 하지 않음(? 확정 x)
    $blur2 = 'noblur';
}*/

// 탈퇴회원 체크
$leave = sql_fetch(" select mb_leave_date from g5_member where mb_no = {$mb_no} ")['mb_leave_date'];
if(!empty($leave)) { alert('탈퇴한 회원입니다.'); }

$sql = "select * from g5_member_hope where mb_id = '{$mb['mb_id']}' ";
$mh = sql_fetch($sql);
$mh_job = explode(",",$mh["mh_job"]);
$mh_height = explode(",",$mh["mh_height"]);
$mh_school = explode(",",$mh["mh_school"]);
$mh_salary = explode(",",$mh["mh_salary"]);
$mh_type = explode(",",$mh["mh_type"]);
$mh_marry_yn = explode(",",$mh["mh_marry_yn"]);

$sql = "select * from new_member_interview where mb_id = '{$mb['mb_id']}' ";
$mi = sql_fetch($sql);

$sql = "select count(*) cnt from g5_member_love where mb_no = '{$member["mb_no"]}' and love_mb_no = '{$mb['mb_no']}' ";
$zzim_cnt = sql_fetch($sql)["cnt"];
$zzim = ($zzim_cnt > 0) ? "co_zzim_on" : "co_zzim";
$zzim_text = ($zzim_cnt > 0) ? "관심<br>등록중" : "관심<br>있어요";

$is_mypage = "mem_view";
$g5['title'] = $mb['mb_nick'];
include_once('./_head.php');

include_once($member_skin_path.'/mem_view.skin.php');

include_once('./_tail.php');
?>
