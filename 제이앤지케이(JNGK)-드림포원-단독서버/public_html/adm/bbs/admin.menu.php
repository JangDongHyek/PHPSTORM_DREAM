<?php
switch ($_GET['bo_table']) {
	case "event" : $sub_menu = "300100"; break;
	case "video" : $sub_menu = "300200"; break;
	default : $sub_menu = "300100";
}

/*add_stylesheet('<link rel="stylesheet" href="'.$g5_url.'/css/board.css">', 0);*/
?>