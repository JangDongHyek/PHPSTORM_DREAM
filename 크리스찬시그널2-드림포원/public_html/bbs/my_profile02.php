<?php
$sub_id = "my_profile02";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$mb_id = "";
if($_GET['mb_id'] == "") {
    $mb_id = $_SESSION['ss_mb_id'];
} else {
    $mb_id = $_GET['mb_id'];
}



/*for($i=2; $i<=5; $i++) {
    $hide_class.''.$i = 'hide';

    if($mi['interview'.$i.'_text1'] == '직접기재') { $hide_class.''.$i = ''; }
}*/


$sql = "select * from new_member_interview where mb_id = '{$mb_id}' ";
$mi = sql_fetch($sql);

$is_mypage = "my_profile02";
$g5['title'] = '인터뷰';
include_once('./_head.php');

include_once($member_skin_path.'/my_profile02.skin.php');

include_once('./_tail.php');
?>
