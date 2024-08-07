<?php
if($_SESSION['ss_mb_id']=="lets080"){
	$menu['menu200'] = array (
		array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
		array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
        array('200300', '회원메일발송', G5_ADMIN_URL.'/mail_list.php', 'mb_mail'),
		array('200800', '접속자집계', G5_ADMIN_URL.'/visit_list.php', 'mb_visit', 1),
		array('200810', '접속자검색', G5_ADMIN_URL.'/visit_search.php', 'mb_search', 1),
		array('200820', '접속자로그삭제', G5_ADMIN_URL.'/visit_delete.php', 'mb_delete', 1),
		array('200900', '투표관리', G5_ADMIN_URL.'/poll_list.php', 'mb_poll'),
		array('200200', '포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
		array('200220', '포인트충전 신청관리', G5_ADMIN_URL.'/wallet_list.php', 'wallet', 1),
		array('200230', '포인트환전 신청관리', G5_ADMIN_URL.'/change_list.php', 'change', 1),
		array('200240', '청원서 작성 내역', G5_ADMIN_URL.'/petition_list.php', 'change', 1),
        array('200250', '문자관리', G5_ADMIN_URL.'/send_sms.php', 'sms'),
        array('200120', '회원문자목록', G5_ADMIN_URL.'/sms_list.php', 'sms_list')
	);
}else{
	$menu['menu200'] = array (
		array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
		array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'mb_list'),
		array('200200', 'S포인트관리', G5_ADMIN_URL.'/point_list.php', 'mb_point'),
		array('200210', 'L포인트관리', G5_ADMIN_URL.'/point_l_list.php', 'mb_point'),
		array('200220', '포인트신청관리', G5_ADMIN_URL.'/wallet_list.php', 'wallet', 1),
		array('200230', '포인트환전신청관리', G5_ADMIN_URL.'/change_list.php', 'change', 1),
		array('200300', '동영상충전포인트관리', G5_ADMIN_URL.'/point_m_list.php', 'movie', 1),
        array('200400', '주식지급내역', G5_ADMIN_URL.'/stock_payment.php', 'stock_payment'),
        array('200500', '주식환전신청관리', G5_ADMIN_URL.'/stock_list.php', 'stocks'),
        array('200600', '청원서 작성 내역', G5_ADMIN_URL.'/petition_list.php', 'stocks'),
        array('200700', '문자관리', G5_ADMIN_URL.'/send_sms.php', 'sms'),
        array('200800', '청원서고객문자관리', G5_ADMIN_URL.'/send_petition_member_sms.php', 'sms'),
        array('200120', '회원문자목록', G5_ADMIN_URL.'/sms_list.php', 'sms_list')
	);
}
?>