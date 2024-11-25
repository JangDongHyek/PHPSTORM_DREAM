<?
/******************************************************************
 ★ 파일설명 ★ 
코멘트상단

 ★ 스킨 제작을 위한 변수 설명 ★ 
<?=$cmt_reg_ip?>			코멘트 아이피
<?=$cmt_num?>					코멘트 번호(물리적인)
<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디
<?=$mb_id?>						회원글이라면 회원아이디
<?=$cmt_name?>				작성자명
<?=$cmt_email?>				작성자 이메일
<?=$mb_homepage?>			회원글이라면 회원홈페이지
<?=$rg_mb_icon?>			등록자가 회원이라면 회원아이콘
<?=$mb_open_info?>		회원글이라면 정보공개여부(회원정보)
<?=$cmt_reg_date?>		코멘트 등록일
<?=$cmt_comment?>			코멘트 내용

<?=$a_comment_delete?>	삭제링크

<?=$show_comment_delete_begin?>
코멘트삭제
<?=$show_comment_delete_end?>

******************************************************************/
?>
		<a name='c<?=$cmt_num?>'></a>
		<tr bgcolor=#FFFFFF>
			<td class=bbs>
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
			  <tr>
				<td width="80" valign="top"><span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$cmt_name?>', '<?=$cmt_email?>', '<?=$mb_homepage?>', '<?=$mb_open_info?>')" style='cursor:hand;'><?=$cmt_mb_icon?><?=$cmt_name?></span></td>
				<td valign="top">
				  <?=$cmt_comment?>
				  &nbsp;
				  <?=$show_comment_delete_begin?>
				  <?=$a_comment_delete?>
				  <img src="<?=$skin_board_url?>images/del.gif" border=0></a>
				  <?=$show_comment_delete_end?>
				  <br>
				  <font color="#999999">[
				  <?=$cmt_reg_date?>
				  ]</font></td>
			  </tr>
			  <TR bgcolor=#e7e7e7> 
				<TD height="1" colspan="2"></TD>
			  </TR>
			</table> 
			</td>
		</tr>