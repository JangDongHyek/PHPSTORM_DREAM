<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	// 섬네일 함수
	include_once($site_path.'/include/lib_image_convert.php');
	
	// 새글 아이콘 
	$skin_icon_new = "";  
	//기본값 <img src=\"{$skin_board_url}new.gif\">
	$img_width = 150; // 이미지 넓이
	$img_height = 150; // 이미지 넓이
	
	$skin_date_format = '%Y-%m-%d'; // 리스트표시형식
	$class[link_title] = ' class=lastest';
	$class[link_list] = ' class=lastest';
?>