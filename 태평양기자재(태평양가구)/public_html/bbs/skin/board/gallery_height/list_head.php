<?
/******************************************************************
 ★ 파일설명 ★ 
목록상단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$img_width?>		이미지 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$total_doc_count?>	총 게시물수
<?=$page?>						현재페이지
<?=$total_page?>			총 페이지수

<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$u_category?>			카테고리 선택 URL
<?=$category_list_option?>	카테고리 option 리스트
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>

******************************************************************/
$l_cols = 0;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function change_image(src, width, title)
	{
		document.image_view.src = src;
		sText.innerHTML = title;

		if(width < <?=$image_width?>)
			document.image_view.width = width;
		else
			document.image_view.width = <?=$image_width?>;

		//document.image_view.height=600;
	}
//-->
</SCRIPT>
<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    <?=$show_category_begin?>
    <IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select>
    <?=$show_category_end?>
    </td>
</form>
	<td width=50% align="right" class="bbs"><?=$page?>/<?=$total_page?>, 총 게시물 : <?=$total_doc_count?></td>
</tr>
</table>
<TABLE WIDTH=640 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2>
			<IMG SRC="<?=$skin_board_url?>images/gallery_1.gif" WIDTH=93 HEIGHT=48 ALT=""></TD>
		<TD COLSPAN=3 background="<?=$skin_board_url?>images/gallery_2.gif"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20">&nbsp;</td>
          </tr>
          <tr>
            <td><nobr><p id="sText"></p></nobr></td>
          </tr>
        </table></TD>
	</TR>
	<TR>
		<TD COLSPAN=4>
			<IMG SRC="<?=$skin_board_url?>images/gallery_3.gif" WIDTH=489 HEIGHT=8 ALT=""></TD>
		<TD>
			<IMG SRC="<?=$skin_board_url?>images/gallery_4.gif" WIDTH=151 HEIGHT=8 ALT=""></TD>
	</TR>
	<TR>
		<TD background="<?=$skin_board_url?>images/gallery_5.gif" WIDTH=31 height=350></TD>
		<TD COLSPAN=2 align=center><img src="<?=$skin_board_url?>blank_.gif" border="0" name="image_view" onClick="img_new_window(this.src)" style="cursor:hand;"></TD>
		<TD background="<?=$skin_board_url?>images/gallery_7.gif" WIDTH=16 height=350></TD>
		<TD valign="top" background="<?=$skin_board_url?>images/gallery_8.gif"><table width="90%"  border="0" cellspacing="0" cellpadding="0">
		<form name=form_list method='post' action=''>
		<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
		<input type=hidden name=page value='<?=$page?>'>
