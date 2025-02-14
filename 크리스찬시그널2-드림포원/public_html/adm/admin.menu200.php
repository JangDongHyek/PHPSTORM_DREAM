<?php
$menu['menu200'] = array (
    array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
    array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php?user_type=basic', 'member'),
    array('200110', '회원관리(구)', G5_ADMIN_URL.'/member_list2.php?user_type=basic', 'member'),
    array('200100', '시크릿회원관리', G5_ADMIN_URL.'/member_list.php?user_type=secret', 'member'),
    array('200100', '장애인회원관리', G5_ADMIN_URL.'/member_list.php?user_type=no_basic', 'member'),
    array('200300', '신고회원관리', G5_ADMIN_URL.'/member_report_list.php', 'member_report'),
    array('200400', '탈퇴회원관리', G5_ADMIN_URL.'/member_out_list.php', 'member_out'),
    array('200500', '관리자추가', G5_ADMIN_URL.'/adm_member_list.php', 'adm_member'),
 /*
	array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
    array('200300', '회원메일발송', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),
    array('200800', '접속자집계', G5_ADMIN_URL.'/visit_list.php', 'mb_visit', 1),
    array('200810', '접속자검색', G5_ADMIN_URL.'/visit_search.php', 'mb_search', 1),
    array('200820', '접속자로그삭제', G5_ADMIN_URL.'/visit_delete.php', 'mb_delete', 1),
    array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
    array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll')
*/
);
?>