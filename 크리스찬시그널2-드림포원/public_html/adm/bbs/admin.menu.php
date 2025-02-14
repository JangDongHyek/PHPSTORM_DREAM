<?php
switch ($_GET['bo_table']) {
	case "memo" : $sub_menu = "300100"; break;
	case "notice" : $sub_menu = "300200"; break;
	case "use" : $sub_menu = "300300"; break;
    case "faq" : $sub_menu = "300400"; break;
    case "qna" : $sub_menu = "300500"; break;
    /*case "report" : $sub_menu = "300500"; break;*/
	default : $sub_menu = "300100";
}

/*add_stylesheet('<link rel="stylesheet" href="'.$g5_url.'/css/board.css">', 0);*/
?>