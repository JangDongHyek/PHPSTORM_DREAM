<?php
$sub_id = "msg_view";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$idx = $_GET['idx'];
$mode = $_GET['mode'];

if($mode == 'receive') {
    $sql_common = 'me.send_mb_no'; // 받은 메세지에서 보낸 사람을 확인
    $link = 'msg_from.php';

    // 받은 메세지 상세 페이지 접근 시 수신 확인 처리
    $sql = " update g5_message set message_state = '읽음', state_date = now() where idx = {$idx} ";
    sql_query($sql);
}
else {
    $sql_common = 'me.receive_mb_no'; // 보낸 메세지에서 받는 사람을 확인
    $link = 'msg_to.php';
}

// 메세지 상세
$sql = " select me.*, date_format(me.message_date, '%Y-%m-%d %H:%i') as message_date, mb.mb_nick, mb.mb_sex, mb.mb_no, mb.mb_level, mb.secret_member, mb.propose
         from g5_message as me 
         left join g5_member as mb on mb.mb_no = {$sql_common}
         where idx = {$idx} ";
$me = sql_fetch($sql);

// 프로필 기본이미지
if($me['mb_sex'] == '여')  $default_img = 'noimg.jpg'; else $default_img = 'noimg_male.jpg';


// ======== 이전메세지/다음메세지 ==============================================================
// ***** 받은메세지 ***** -- 최신순으로 정렬, 정렬 순서 변경 시 쿼리 수정 필요!
// 받은메세지함의 처음 메세지
$min_receive_idx = sql_fetch(" select min(idx) as idx from g5_message where receive_mb_no = {$member['mb_no']} and receive_delete_yn = 'N' ")['idx'];
// 받은메세지함의 마지막 메세지
$max_receive_idx = sql_fetch(" select max(idx) as idx from g5_message where receive_mb_no = {$member['mb_no']} and receive_delete_yn = 'N' ")['idx'];
// 현재 보고 있는 받은메세지의 이전 메세지
$prev_receive_idx = sql_fetch(" select idx from g5_message where receive_mb_no = {$member['mb_no']} and receive_delete_yn = 'N' and idx > {$me['idx']} order by idx limit 1 ")['idx'];
// 현재 보고 있는 받은메세지의 다음 메세지
$next_receive_idx = sql_fetch(" select idx from g5_message where receive_mb_no = {$member['mb_no']} and receive_delete_yn = 'N' and idx < {$me['idx']} order by idx desc limit 1 ")['idx'];
// ***** 받은메세지 *****

// ***** 보낸메세지 ***** -- 오래된순으로 정렬, 정렬 순서 변경 시 쿼리 수정 필요!
// 보낸메세지함의 처음 메세지
$min_send_idx = sql_fetch(" select min(idx) as idx from g5_message where send_mb_no = {$member['mb_no']} and send_delete_yn = 'N' order by idx ")['idx'];
// 보낸메세지함의 마지막 메세지
$max_send_idx = sql_fetch(" select max(idx) as idx from g5_message where send_mb_no = {$member['mb_no']} and send_delete_yn = 'N' order by idx ")['idx'];
// 현재 보고 있는 보낸메세지의 이전 메세지
$prev_send_idx = sql_fetch(" select idx from g5_message where send_mb_no = {$member['mb_no']} and send_delete_yn = 'N' and idx < {$me['idx']} order by idx desc limit 1 ")['idx'];
// 현재 보고 있는 보낸메세지의 다음 메세지
$next_send_idx = sql_fetch(" select idx from g5_message where send_mb_no = {$member['mb_no']} and send_delete_yn = 'N' and idx > {$me['idx']} order by idx limit 1 ")['idx'];
// ***** 보낸메세지 *****
// ======== 이전메세지/다음메세지 ==============================================================

$is_mypage = "msg_view";
$g5['title'] = '내 메세지함';
include_once('./_head.php');

include_once($member_skin_path.'/msg_view.skin.php');

include_once('./_tail.php');
?>