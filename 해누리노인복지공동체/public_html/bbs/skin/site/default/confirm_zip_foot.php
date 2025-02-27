</table>
<?=$list_end?>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
	function use(zip_code,address)
	{	
		opener.<?=$frm_name?>.<?=$frm_zip1?>.value=zip_code;
		opener.<?=$frm_name?>.<?=$frm_addr1?>.value=address;
		opener.<?=$frm_name?>.<?=$frm_addr2?>.focus();
		self.close();
	}
</script>