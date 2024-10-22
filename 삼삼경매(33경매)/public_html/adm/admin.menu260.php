<?php
	if($_SESSION['ss_mb_id']=="admin"){
		$menu['menu260'] = array (
			array('260000', '삼삼CLASS', G5_ADMIN_URL.'/class_list.php', 'class'),
			array('260100', '강의관리', G5_ADMIN_URL.'/class_list.php', 'class'),
			array('260100', '신청자현황', G5_ADMIN_URL.'/class_register_list.php', 'class'),
		);
	}
?>