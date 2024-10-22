<?php
	if($_SESSION['ss_mb_id']=="admin"){
		$menu['menu250'] = array (
			array('250000', '온라인상담', G5_ADMIN_URL.'/request_list.php', 'board'),
			array('250100', '온라인상담', G5_ADMIN_URL.'/request_list.php', 'board'),
		);
	}
?>