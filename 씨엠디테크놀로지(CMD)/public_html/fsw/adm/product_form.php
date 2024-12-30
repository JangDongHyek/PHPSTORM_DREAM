<?php
$sub_menu = "300100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');


$g5['title'] = $w == "u" ? "분류 수정" : "분류 등록";
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

include_once(G5_BBS_PATH."/admin_write.php");


include_once('./admin.tail.php');
?>
