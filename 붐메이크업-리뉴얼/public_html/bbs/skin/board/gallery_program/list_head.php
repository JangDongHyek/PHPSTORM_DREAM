<?
/******************************************************************
 ★ 파일설명 ★ 
목록상단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
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
<TABLE width="<?=$width?>" height="30" border=0 cellPadding=0 cellSpacing=0>
	<TR>
	  <TD height=2 colspan="7" align="center" bgcolor=32A3C2></TD>
  </TR>
	<TR>
	  <TD width="30" align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_01.gif"  /></TD>
	  <TD height=29 width="1" align="center" bgcolor=#9CD5E2 background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD align="center" bgcolor=E3F3F7 height=29><img src="<?=$skin_board_url?>images/list_04.gif"  /></TD>
	  <TD width="1" align="center" background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD width="50" height=29 align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_06.gif"  /></TD>
	  <TD  align="center" width="1" background="<?=$skin_board_url?>images/list_line.gif"></TD>
	  <TD width="80" height=29 align="center" bgcolor=E3F3F7><img src="<?=$skin_board_url?>images/list_05.gif"  /></TD>
  </TR>
	<TR>
		<TD height=1 colspan="7" align="center" bgcolor=32A3C2></TD>
	</TR>
</table>

<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>" border=0>
<tr><td height="10"></td></tr>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>