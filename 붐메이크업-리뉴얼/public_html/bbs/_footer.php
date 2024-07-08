<?
	// 에드온이라면 게시판 푸터 무시
	if(!eregi('addon.php$',$HTTP_SERVER_VARS["PHP_SELF"])) {
		if ($bbs[bbs_footer_file] && file_exists("$bbs[bbs_footer_file]")) 
			include "$bbs[bbs_footer_file]";
		echo $bbs[bbs_footer_tag];
	}
	
	if ($group[gr_footer_file] && file_exists("$group[gr_footer_file]")) 
    include "$group[gr_footer_file]";
	echo $group[gr_footer_tag];
?>
</div>
</body>
</html>
<script src="<?=$skin_board_url?>script.js"></script>
<?
	$html_contents = ob_get_contents(); 
	ob_end_clean();
	echo $html_contents;
?>