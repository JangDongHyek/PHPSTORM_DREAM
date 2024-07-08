<?php
if ($member['mb_status'] == "관리자") {
	$menu['menu650'] = array (
		array('650000', '모바일관리', G5_ADMIN_URL.'/bbs/board.php?bo_table=b_notice', 'mobile_manage'),
		array('650100', '공지사항', G5_ADMIN_URL.'/bbs/board.php?bo_table=b_notice', 'notice'),
		array('650200', '연애상담소', G5_ADMIN_URL.'/bbs/board.php?bo_table=b_counsel', 'counsel'),
		array('650300', '이벤트', G5_ADMIN_URL.'/bbs/board.php?bo_table=b_event', 'event'),
		array('650400', '카카오채널', G5_ADMIN_URL.'/kakao_pf.php', 'kakao_pf'),
		array('650500', '커플후기', G5_ADMIN_URL.'/bbs/board.php?bo_table=review', 'review'),
		array('650600', '가입경로', G5_ADMIN_URL.'/join_path', 'join_path'),
	);
}
?>