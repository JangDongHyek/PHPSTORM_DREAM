<?php
$menu['menu200'] = array (
    array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
    array('200100', '회원목록', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
	array('200200', '회원문자발송', G5_ADMIN_URL.'/send_sms.php', 'sms'),
	array('200300', '회원문자발송목록', G5_ADMIN_URL.'/sms_list.php', 'sms_list'),
	array('200400', '행사사진', G5_ADMIN_URL.'/bbs/board.php?bo_table=photo', 'photo'),
    array('200500', '상담리스트', G5_ADMIN_URL.'/consult.php', 'consult'),
    array('200600', '이용리스트', G5_ADMIN_URL.'/use.php', 'use'),
    array('200700', '캐쉬백신청리스트', G5_ADMIN_URL.'/sangjo.php', 'sangjo')
    

	/*
    array('200300', '회원메일발송', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),
    array('200800', '접속자집계', G5_ADMIN_URL.'/visit_list.php', 'mb_visit', 1),
    array('200810', '접속자검색', G5_ADMIN_URL.'/visit_search.php', 'mb_search', 1),
    array('200820', '접속자로그삭제', G5_ADMIN_URL.'/visit_delete.php', 'mb_delete', 1),
    array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
    array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll')
	*/
);


if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") {
	//$menu['menu200'][] = array('200400', '행사사진', G5_ADMIN_URL.'/bbs/board.php?bo_table=photo', 'photo');
}

?>