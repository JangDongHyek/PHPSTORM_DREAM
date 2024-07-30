<?php
$sub_id = "my_car_part";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/
$cdt = $_REQUEST['cdt'];

if($member['mb_1'] != 'Y'){
    alert("승인된 회원만 이용가능합니다.",G5_URL,'error');
}

if (empty($cdt) || $cdt > 5 || $cdt == 0){

    alert("올바른 방법으로 접근해주세요.",G5_URL,'error');

}

$url_param = "cdt=".$cdt."&cs=";

$is_mypage = "my_car_part";
$g5['title'] = '세차차량 선택';
include_once('./_head.php');

include_once($member_skin_path.'/my_car_part.skin.php');

include_once('./_tail.php');
?>
