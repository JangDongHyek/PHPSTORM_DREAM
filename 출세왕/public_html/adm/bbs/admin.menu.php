<?php
switch ($_GET['bo_table']) {
	case "qna" : $sub_menu = "300100"; break;
	case "notice" : $sub_menu = "300200"; break;
	case "faq" : $sub_menu = "300300"; break;
	default : $sub_menu = "300100";
}
?>