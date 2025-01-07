<?php
if($_SESSION['ss_mb_id']=="lets080"){
	$menu['menu500'] = array (
		array('500000', 'JSON_API', ''.G5_ADMIN_URL.'/json_api.php?url=member_join&title=JSON_API&sub_menu=500000', 'bbs_poplist', 1),
		array('500100', '회원가입api', ''.G5_ADMIN_URL.'/json_api.php?url=member_join&title=회원가입API&sub_menu=500100', 'bbs_poplist', 2),
		array('500200', '메뉴보기', ''.G5_ADMIN_URL.'/json_api.php?url=menu&title=메뉴보기&sub_menu=500200', 'bbs_poplist', 2)
	);
}
?>