<?
	ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_board_url?>style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
try {
	top.document.title='<?=addslashes($html_title)?>'
} catch (Exception) {
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link href="../css/style.css" rel="stylesheet" type="text/css">
<title><?=$html_title?></title>

<script src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script src="../js/jquery.slideshow.banner.js"></script>
<script src="../js/common.js"></script>
<script src="../js/s_img.js"></script>
</head>

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