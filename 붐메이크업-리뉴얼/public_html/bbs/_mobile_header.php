<?
	ob_start();
?>
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_board_url?>style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
try {
	top.document.title='<?=addslashes($html_title)?>'
} catch (Exception) {
}
</script>
<link rel="stylesheet" href="../css/board.css"/>
<div align="<?=$bbs[bbs_align]?>">
<?
	// �׷� ���ó��
	if ($group[gr_header_file] && file_exists("$group[gr_header_file]")) 
	    include("$group[gr_header_file]");
	echo $group[gr_header_tag];

	// ������̶�� �Խ��� ��� ����
	if(!$is_addon) {
		
		// �Խ��� ���ó��
		if ($bbs[bbs_header_file] && file_exists("$bbs[bbs_header_file]")) {
			
			$bbs[bbs_header_file]=str_replace("main","mobile",$bbs[bbs_header_file]);
			include("$bbs[bbs_header_file]");
		}
		//echo $bbs[bbs_header_tag];

		// ��Ų ��� 
		
		/*if (file_exists($skin_board_path."mobile_head.php")) 
			include($skin_board_path."mobile_head.php");*/
	}
?>	