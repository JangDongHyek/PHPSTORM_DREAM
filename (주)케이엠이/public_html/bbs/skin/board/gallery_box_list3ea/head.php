<link rel=stylesheet href='<?=$skin_board_url?>style.css'>

<SCRIPT LANGUAGE="JavaScript">
<!--
function img_new_window(name,title) {
	if(name=='')
		return;
	var x=screen.width/2-150/2; //창을 화면 중앙으로 위치 
	var y=(screen.height-30)/2-150/2;
	window.open('<?=$skin_board_url?>img_view.php?image='+name+'&title='+title,'','width=150,height=150,scrollbars=1,resizable=1,top='+y+',left='+x)
}
//-->
</SCRIPT>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
	<td align=right><!--
			<?=$a_login?><IMG src="<?=$skin_board_url?>images/head_img01.gif" border=0></a>
			<?=$a_logout?><IMG src="<?=$skin_board_url?>images/head_img06.gif" border=0></a>
			<!--<?=$a_member_join?><IMG src="<?=$skin_board_url?>images/head_img02.gif" border=0></a>
			<?=$a_member_password?><IMG src="<?=$skin_board_url?>images/head_img03.gif" border=0></a>
			<?=$a_member_modify?><IMG src="<?=$skin_board_url?>images/head_img04.gif" border=0></a>
			<?=$a_member_memo?><IMG src="<?=$skin_board_url?>images/head_img05.gif" border=0></a>
			<?=$a_member_leave?><IMG src="<?=$skin_board_url?>images/head_img07.gif" border=0></a>
			<?=$a_setup?><IMG src="<?=$skin_board_url?>images/head_img08.gif" border=0></a>
-->
	</td>
</tr>
</table>