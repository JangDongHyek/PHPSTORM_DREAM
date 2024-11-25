<? 
//게시판 목록보기에서 제목 글자수 자르기 
//$rg_title = rg_cut_string($rg_title,15,'...'); 
?> 
<?
/******************************************************************
 ★ 파일설명 ★ 
일반 게시판 목록스킨

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디
<?=$mb_id?>						회원글이라면 회원아이디
<?=$mb_open_info?>		회원글이라면 정보공개여부(회원정보)

<?=$no?> 							논리적인 게시물번호(순서)
<?=$rg_doc_num?>			물리적인 게시물번호(디비상의 게시물번호)
<?=$rg_reply?>				응답글 깊이와 아이콘
<?=$rg_title?>				제목
<?=$rg_cmt_count?>		코멘트 갯수
<?=$rg_new_icon?>			새글 아이콘
<?=$rg_reg_date?>			글등록일
<?=$rg_name?>					등록자명
<?=$rg_email_enc?>		메일
<?=$rg_home_url?>			홈페이지
<?=$rg_mb_icon?>			등록자가 회원이라면 회원아이콘
<?=$rg_doc_hit?>			글조회수

<?=$a_list_view?>			글보기 링크


<?=$show_category_begin?>카테고리<?=$show_category_end?>
<?=$rg_cat_name?>			카테고리명
<?=$show_chk_begin?>카트사용(체크박스)<?=$show_chk_end?>
<?=$show_vote_yes_begin?>추천수<?=$show_vote_yes_end?>
<?=$rg_vote_yes?>			추천수
<?=$show_vote_no_begin?>비추천수<?=$show_vote_no_end?>
<?=$rg_vote_no?>			비추천수

******************************************************************/
?>
<?
//썸네일 가로세로 크기 설정 
	$thum_width = 30; 
	$thum_height = 30; 

	if($l_cols % $cols == 0) {
?>

<TR> 
	<TD align=middle bgColor=#ffffff colSpan='<?=$colspan?>' height=1>
	<IMG height=1 src="<?=$skin_board_url?>blank_.gif" width="100%" border=0></TD>
</TR>
<tr bgcolor="#FFFFFF">
<?
	}
	$l_cols++;

	if($l_cols == 1){
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
	change_image('<?=$rg_file1_url?>', '<?=$rg_file1_info[0]?>', '<?=$rg_title?>');
//-->
</SCRIPT>	
<?
	}
?>
     <td align="left" valign="top"> 
       
		<table cellspacing="0" cellpadding="0" border=0>
		  <tr>
			<td align="center" valign="bottom"> 
			  <table border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">
				<tr>
				  <td bgcolor="#FFFFFF"> 
					<img src="<?=$rg_file1_url?>" border="0" width="<?=$thum_width?>" height="<?=$thum_height?>" onerror="this.src='<?=$skin_board_url?>blank_.gif'" onclick="change_image('<?=$rg_file1_url?>','<?=$rg_file1_info[0]?>', '<?=$rg_title?>')" style="cursor:hand;" height="94" vspace="4" hspace="4"></td>
				</tr>
			  </table>
			</td>
		  </tr>
		  <tr>
			<td align="center" valign="top"> 
			  <?=$show_chk_begin?>
			  <input type=checkbox name=chk_rg_num[] value='<?=$rg_doc_num?>'>
			  <?=$show_chk_end?>
			  <!--  <span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$rg_name?>', '<?=$rg_email_enc?>', '<?=$rg_home_url?>', '<?=$mb_open_info?>','<?=$skin_board_url?>')" style='cursor:hand;'>
			  <?=$rg_mb_icon?> <?=$rg_name?>
			  </span> 
			  <?=$a_list_view?>
			  <?=$rg_title?></a>
			  <span style='font-size:8pt;'>
			  <?=$rg_cmt_count?>
			  </span> --> </td>
		  </tr>
		</table>
	</td>
<?
	if($l_cols%3==0){
?>
</tr>
<? 
	}
?>
