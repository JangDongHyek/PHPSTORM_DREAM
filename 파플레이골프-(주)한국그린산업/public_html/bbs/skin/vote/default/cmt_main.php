<?
/******************************************************************
 ★ 파일설명 ★ 
코멘트상단

 ★ 스킨 제작을 위한 변수 설명 ★ 
<?=$vtc_reg_ip?>			코멘트 아이피
<?=$vtc_num?>					코멘트 번호(물리적인)
<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디
<?=$mb_id?>						회원글이라면 회원아이디
<?=$vtc_name?>				작성자명
<?=$vtc_email?>				작성자 이메일
<?=$mb_homepage?>			회원글이라면 회원홈페이지
<?=$rg_mb_icon?>			등록자가 회원이라면 회원아이콘
<?=$mb_open_info?>		회원글이라면 정보공개여부(회원정보)
<?=$vtc_reg_date?>		코멘트 등록일
<?=$vtc_comment?>			코멘트 내용

<?=$a_comment_delete?>	삭제링크

<?=$show_comment_delete_begin?>
코멘트삭제
<?=$show_comment_delete_end?>

******************************************************************/
?>
<a name='c<?=$vtc_num?>'></a>
<tr><td class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'>
			<span onClick="rg_layer('<?=$site_url?>', '<?=$bbs_id?>','<?=$mb_id?>', '<?=$vtc_name?>', '<?=$vtc_email?>', '<?=$mb_homepage?>', '<?=$mb_open_info?>','<?=$skin_site_url?>')" style='cursor:hand;'>
      <?=$vtc_mb_icon?>
      <?=$vtc_name?>
      </span> [<?=$vtc_reg_date?>] 
      <?=$show_comment_delete_begin?>
      - 
      <?=$a_comment_delete?>
      <img src="<?=$skin_vote_url?>del.gif" border=0></a> <br>
      <?=$show_comment_delete_end?>
      <img width=1 height=5><br>
      <?=$vtc_comment?>
      <Br>
      <img width=1 height=5><br>
    <div align="right">WRITE IP : 
      <?=$vtc_reg_ip?>
    </div></td></tr>
			<TD align=middle bgColor=#cdcdc colSpan=2 height=1><IMG 
									height=1 width="100%" 
									border=0></TD>
			</TR>