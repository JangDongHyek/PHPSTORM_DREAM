<?php
if ($member['mb_level'] == "10") {
	$menu['menu150'] = array (
		array('150000', '대리점관리', G5_ADMIN_URL.'/agency_list.php', 'agency'),
		array('150100', '대리점관리', G5_ADMIN_URL.'/agency_list.php', 'ag_list'),
	);
}
?>