<?php
if ($member['mb_level'] == "10") {
	$menu['menu260'] = array (
		array('260000', '전용계좌', G5_ADMIN_URL.'/banknum.php', 'banknum'),
		array('260100', '전용계좌목록', G5_ADMIN_URL.'/banknum.php', 'banknum_list'),
		array('260200', '계좌입금내역', G5_ADMIN_URL.'/point_charge.php', 'pt_cr'),
	);
}
?>