<!---------------------HEAD 시작-------------------------->
<?
/******************************************************************
★ 파일설명 
★ 목록상단
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
?>
<style type="text/css">
<!--
.t11 {
	font-family: "돋움";
	font-size: 11px;
	color: #929292;
}
-->
</style>

<table width="<?=$width?>" cellpadding=0 cellspacing=0 border=0>
<tr>
<form name=fcategory>
	<td width=50%> 
    
    </td>
</form>
	<td width=50% align="right" class="t11"><?=$page?>/<?=$total_page?>, 총 게시물 : <?=$total_doc_count?></td>
</tr>
</table>


<TABLE cellSpacing=0 cellPadding=0 border=0>

<TR> 
	<TD>
	<TABLE width="100%" height="33" border=0 cellPadding=0 cellSpacing=0 style="table-layout:fixed">
	<form name=form_list method='post' action=''>
	<input type=hidden name=bbs_id value='<?=$bbs_id?>'>
	<input type=hidden name=page value='<?=$page?>'>
	<TR height=33 >
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="6" align="center"><img src="<?=$skin_board_url?>images/left_line.gif" height="33"></td>
            <td align="center"><img src="<?=$skin_board_url?>images/list_01.gif"  /></td>
          </tr>
        </table></TD>
	
		<?=$show_category_begin?>
		<TD width=60 align=center background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><img src="<?=$skin_board_url?>images/list_02.gif" /></TD>
		<?=$show_category_end?>
		
		<TD align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/list_04.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><img src="<?=$skin_board_url?>images/list_03.gif" /></td>
            </tr>
          </table></TD>
		<TD width=80 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_05.gif" /></font></td>
            </tr>
          </table></TD>
		
		<?=$show_download_begin?>
		<TD width=50 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_07.gif"/></font></td>
          </tr>
        </table></TD>
		<?=$show_download_end?>
		
		<TD width=50 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><font color="#000000"><img src="<?=$skin_board_url?>images/list_06.gif" /></font></td>
              <td width="7" align="center"><img src="<?=$skin_board_url?>images/right_line.gif" height="33" /></td>
            </tr>
          </table></TD>
		
		<?=$show_vote_yes_begin?>
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><FONT color=#000000>추천</FONT></TD>
		<?=$show_vote_yes_end?>
		
		
		<?=$show_vote_no_begin?>
		<TD width=40 align=middle background="<?=$skin_board_url?>images/list_box01.gif" class="bbs"><FONT color=#000000>비추천</FONT></TD>
		<?=$show_vote_no_end?>

	</TR>
	
<!---------------------HEAD 끝-------------------------->






