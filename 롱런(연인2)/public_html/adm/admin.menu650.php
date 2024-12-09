<?php
if ($member['mb_status'] == "관리자") {
	$menu['menu650'] = array (
        array('650000', '모바일관리', G5_ADMIN_URL.'/bbs/list.php?tbl=notice', 'mobile_manage'),
        array('650100', 'notice', G5_ADMIN_URL.'/bbs/list.php?tbl=notice', 'notice'),
		array('650200', '롱런칼럼', G5_ADMIN_URL.'/bbs/list.php?tbl=column', 'column'),
		array('650300', '이벤트', G5_ADMIN_URL.'/bbs/list.php?tbl=event', 'event'),
		array('650400', '롱런 Q&A', G5_ADMIN_URL.'/kakao_pf.php', 'kakao_pf'),
		array('650500', '커플후기', G5_ADMIN_URL.'/bbs/list.php?tbl=couple', 'couple'),
		array('650600', '가입경로', G5_ADMIN_URL.'/join_path.php', 'join_path'),
	);
}
?>