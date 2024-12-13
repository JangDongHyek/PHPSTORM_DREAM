<?php
switch ($_GET['bo_table']) {
	case "map01" : $sub_menu = "280100"; break;		// 중고매매
	case "map02" : $sub_menu = "280200"; break;		// 폐차장
	case "map03" : $sub_menu = "280300"; break;		// 대리점
	default : $sub_menu = "400100";
}

?>