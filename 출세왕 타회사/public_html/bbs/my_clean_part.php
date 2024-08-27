<?php
$sub_id = "my_clean_part";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/
if($member['mb_1'] != 'Y'){
    alert("승인된 회원만 이용가능합니다.",G5_URL,'error');
}
$is_mypage = "my_clean_part";
$g5['title'] = '건물유형 선택';
include_once('./_head.php');

include_once($member_skin_path.'/my_clean_part.skin.php');

include_once('./_tail.php');
?>
