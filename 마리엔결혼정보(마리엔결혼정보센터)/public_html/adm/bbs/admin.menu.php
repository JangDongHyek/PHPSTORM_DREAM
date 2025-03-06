<?php
switch ($_GET['bo_table']) {
	case "qna" : $sub_menu = "300000"; break;
	case "qna" : $sub_menu = "300100"; break;
	case "fee" : $sub_menu = "750000"; break;
	case "fee" : $sub_menu = "750100"; break;
	case "free" : $sub_menu = "850000"; break;
	case "free" : $sub_menu = "850100"; break;
	case "qna02" : $sub_menu = "870000"; break;
	case "qna02" : $sub_menu = "870100"; break;
	case "lovetest" : $sub_menu = "800000"; break;
	case "lovetest" : $sub_menu = "800100"; break;
	case "notice" : $sub_menu = "300200"; break;
	case "faq" : $sub_menu = "300300"; break;
	default : $sub_menu = "300100";
}
?>