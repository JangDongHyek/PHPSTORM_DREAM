<?
	if(realpath($_SERVER[SCRIPT_FILENAME]) == realpath(__FILE__)) exit;

	// 섬네일 함수
	include_once($site_path.'/include/lib_image_convert.php');

	// 응답글 아이콘
	$skin[icon_reply] = ''; 
	//기본값 <img src=\"{$skin_board_url}re.gif\">
	// 새글 아이콘 
	$skin[icon_new] = '';  
	//기본값 <img src=\"{$skin_board_url}new.gif\">
	// 응답글 깊이에 따른 앞의 공백 
	$skin[reply_space] = 10;  // 기본값은 10
	
	// 목록에서 제목 링크 
	$class[link_list_view] = ' class=bbs';
	// 헤더 링크 
	$class[link_header] = ' class=bbs';
	// 기타 링크 
	$class[link_bbs] = ' class=bbs';
	
	$cols = 3;				// 한줄에 보여질 이미지 개수 
	$img_width = 120; // 이미지 넓이
	$img_view_width_percent = 70; // 글보기시 이미지 크기 비율 (%)
	
	// 페이지당 목록 개수를 보정한다. 
	if(($bbs[bbs_list_count] % $cols) > 0) {
		$bbs[bbs_list_count] += $cols - ($bbs[bbs_list_count] % $cols);
	}
	
	$colspan = $cols;
	
?>