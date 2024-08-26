<?
	ob_start();
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_board_url?>style.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" type="text/JavaScript">
try {
	top.document.title='<?=addslashes($html_title)?>'
} catch (Exception) {
}
</script>
<body
<?=$bbs[bbs_bg_image_tag]?>
<?=$bbs[bbs_bg_color_tag]?>
<?=$bbs[bbs_body_tag]?>
>
<div align="<?=$bbs[bbs_align]?>">
<?
	// 그룹 헤더처리
	if ($group[gr_header_file] && file_exists("$group[gr_header_file]")) 
	    include("$group[gr_header_file]");
	echo $group[gr_header_tag];

	// 에드온이라면 게시판 헤더 무시
	if(!$is_addon) {

		// 게시판 헤더처리
		if ($bbs[bbs_header_file] && file_exists("$bbs[bbs_header_file]")) 
			include("$bbs[bbs_header_file]");
		echo $bbs[bbs_header_tag];
	
		// 스킨 헤더 
		if (file_exists($skin_board_path."head.php")) 
			include($skin_board_path."head.php");
	}
?>	