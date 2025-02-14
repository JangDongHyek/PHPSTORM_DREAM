<?php
$sub_id = "msg_adm";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

// 비공개 회원 체크
if($member['show_yn'] == 'N' && $member['mb_id'] != 'test') {
    alert('비공개 회원으로 컨텐츠를 이용할 수 없습니다.');
}

// 닉네임 검색 시
if(!empty($_GET['name_sch'])) {
    $search_name .= " and mb.mb_nick like '%{$_GET['name_sch']}%' ";
}

if($member['mb_level'] != 10) { // 관리자는 탈퇴 회원 메세지까지 다 보임
    $sql_search = ' and mb.mb_level != 1 ';
}
$sql_search = ' and mb.mb_level != 1 ';

//// 일반회원/관리자 구분
//if(empty($mode) || $mode == 2) {
//    $sql_search = ' and mb.mb_level = 2 ';
//} else {
//    $sql_search .= " and mb.mb_level = 10 ";
//}

//if($private) {
//    $member['mb_no'] = 1;
//}

// 페이징
$sql = " select count(*) as cnt
         from g5_message as me 
         left join g5_member as mb on mb.mb_no = me.receive_mb_no 
         where me.send_mb_no = {$member['mb_no']} and send_delete_yn = 'N' {$search_name} {$sql_search} ";
$row = sql_fetch($sql);

$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 보낸 메시지
$sql = " select me.*, date_format(me.message_date, '%Y-%m-%d %H:%i') as message_date, mb.mb_nick, mb.mb_sex, mb.mb_no, mb.mb_level, mb.secret_member, mb.propose
         from g5_message as me 
         left join g5_member as mb on mb.mb_id = me.send_mb_id 
         where me.send_mb_id = 'admin' and me.receive_mb_no = '{$member["mb_no"]}' and send_delete_yn = 'N' {$search_name} {$sql_search} order by idx desc limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$is_mypage = "msg_adm";
$g5['title'] = '내 메세지함';
include_once('./_head.php');

include_once($member_skin_path.'/msg_adm.skin.php');

include_once('./_tail.php');
?>
