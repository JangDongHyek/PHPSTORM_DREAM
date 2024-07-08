<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


// 지영 - 관리자페이지에서만 접근할수있는 게시판 (사용자에 노출X)
$admin_board = array("refund", "rematch", "report", "helper");
echo $bo_table;
if (in_array($bo_table, $admin_board)) {
	$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$move_url = str_replace(G5_URL, G5_ADMIN_URL, $current_url);
	goto_url($move_url);
}

// 게시판 관리의 상단 내용
if (G5_IS_MOBILE) {
    // 모바일의 경우 설정을 따르지 않는다.
    include_once(G5_BBS_PATH.'/_head.php');
    echo stripslashes($board['bo_mobile_content_head']);
} else {
    @include ($board['bo_include_head']);
    echo stripslashes($board['bo_content_head']);
}
?>