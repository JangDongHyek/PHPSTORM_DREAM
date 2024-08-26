<?
	if(!$group && ($gr_id || $site[st_default_group]))  {
		if($gr_id)
			$group = rg_get_group_cfg("$gr_id");
		else
			$group = rg_get_group_cfg("$site[st_default_group]");
		$group[gr_header_file] = 
			str_replace('{$site_path}',"$site_path",$group[gr_header_file]);
		$group[gr_footer_file] = 
			str_replace('{$site_path}',"$site_path",$group[gr_footer_file]);
	}
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" type="text/JavaScript">
try {
	top.document.title='<?=$html_title?>'
} catch (Exception) {
}
</script>
<body>
<div align="center">
<? 
	// 그룹 헤더처리
	if ($group[gr_header_file] && file_exists("$group[gr_header_file]")) 
    include("$group[gr_header_file]");
	echo $group[gr_header_tag];
?>
