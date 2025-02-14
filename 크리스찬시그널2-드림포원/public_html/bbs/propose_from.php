<?php
$sub_id = "propose_from";
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

$sql_search = ' and mb.mb_level != 1 ';

// 데이트 수신
$sql = " select pr.*, date_format(pr.propose_date, '%Y-%m-%d %H:%i') as propose_date, mb.mb_nick, mb.mb_sex, mb.mb_no
         from g5_propose as pr
         left join g5_member as mb on mb.mb_no = pr.send_mb_no 
         where pr.receive_mb_no = {$member['mb_no']} and receive_delete_yn = 'N' {$sql_search} order by idx desc ";
$result = sql_query($sql);

$is_mypage = "propose_from";
$g5['title'] = '내 데이트함';
include_once('./_head.php');

include_once($member_skin_path.'/propose_from.skin.php');

include_once('./_tail.php');
?>
