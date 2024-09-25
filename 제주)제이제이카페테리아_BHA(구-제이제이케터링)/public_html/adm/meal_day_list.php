<?php
include_once('./_common.php');
include_once("../jl/JlConfig.php");
$sub_menu = "400000";   // 게시판이 나타나야 하는 기본 메뉴
auth_check($auth[$sub_menu], 'r');	// 권한체크
$token = get_token();
if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');    // 관리자만 볼 수 있습니다.

include_once ('./admin.head.php');

include_once ('./meal_day.php');
?>


<? include_once ('./admin.tail.php'); ?>
