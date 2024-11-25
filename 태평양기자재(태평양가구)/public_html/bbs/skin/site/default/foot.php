<? 
	if ($group[gr_footer_file] && file_exists("$group[gr_footer_file]")) 
    include "$group[gr_footer_file]";
	echo $group[gr_footer_tag];
?>
</div>
</body>
</html>
<script src="<?=$skin_site_url?>script.js"></script>