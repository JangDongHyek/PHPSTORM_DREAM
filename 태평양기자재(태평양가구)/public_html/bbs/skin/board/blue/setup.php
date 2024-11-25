<?
	// 응답글 아이콘
	$skin[icon_reply] = "<img src={$skin_board_url}images/re.gif>";

	// 섬네일 함수
	include_once($site_path.'/include/lib_image_convert.php');
	
	// 새글 아이콘 
	$skin[icon_new] = "<img src={$skin_board_url}images/new.gif>";

	// 비밀글 아이콘 
	$skin[icon_secret] = "<img src={$skin_board_url}images/secret.gif>";  

	// 응답글 깊이에 따른 앞의 공백 
	$skin[reply_space] = 10;  // 기본값은 10
	
	// 목록에서 제목 링크 
	$class[link_list_view] = 'class=bbs';
	// 헤더 링크 
	$class[link_header] = 'class=bbs';
	// 기타 링크 
	$class[link_bbs] = 'class=bbs';
	
	// 목록보기에서 사용 
	$colspan = 5;
	$colspan = ($bbs_cfg[$C_USE_CATEGORY]=='1')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_VOTE_YES]!='N')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_VOTE_NO]!='N')?$colspan+1:$colspan;
	$colspan = ($bbs_cfg[$C_AUTH_DOWNLOAD]!='N')?$colspan+1:$colspan;
?>