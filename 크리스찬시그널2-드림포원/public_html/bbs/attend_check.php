<?php
$sub_id = "attend_check";
include_once('./_common.php');

$g5['title'] = '출석체크 이벤트';
include_once('./_head.php');

if (!$is_member){
    alert("로그인 후 이용해주세요.",G5_BBS_URL."/login.php?url=".G5_BBS_URL."/attend_check.php");
}

include_once($member_skin_path.'/attend_check.skin.php');

include_once('./_tail.php');
?>
