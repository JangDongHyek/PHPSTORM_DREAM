<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$u_action?>				글쓰기 URL
<?=$old_password?>		수정시 기존 암호
<?=$a_list?>					글목록 링크

<?=$show_notice_begin?>공지사항체크<?=$show_notice_end?>
<?=$checked_notice?>	공지사항체크여부

<?=$show_secret_begin?>비밀글체크<?=$show_secret_end?>
<?=$checked_secret?>	비밀글체크여부

<?=$show_reply_mail_begin?>응답글메일로받기여부<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	응답글체크여부

<?=$show_name_begin?>이름입력<?=$show_name_end?>
<?=$rg_name?>					이름

<?=$show_password_begin?>암호입력<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	글수정모드가 아니라면 필수입력

<?=$show_email_begin?>메일입력<?=$show_email_end?>
<?=$rg_email?>				메일

<?=$show_home_url_begin?>홈페이지입력<?=$show_home_url_end?>
<?=$rg_home_url?>			홈체이지

<?=$show_category_begin?>카테고리선택<?=$show_category_end?>
<?=$category_list_option?>	카테고리목록

<?=$show_html_begin?>	html 형태선택<?=$show_html_end?>
<?=$checked_html_use0?>	일반글체크
<?=$checked_html_use1?>	html체크
<?=$checked_html_use2?>	html+<br>체크

<?=$rg_title?>				제목
<?=$rg_content?>			내용
<?=$show_link_begin?>	링크입력폼<?=$show_link_end?>
<?=$rg_link1_url?>		링크#1
<?=$rg_link2_url?>		링크#2

<?=$show_upload_begin?>업로드폼<?=$show_upload_end?>

<?=$show_file1_delete_begin?>파일삭제<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		파일명
(1~2)

<?=$show_file1_size_begin?>최대업로드용량<?=$show_file1_size_end?>
<?=$upload_file1_size?>	최대업로드용량

<?=$show_file1_ext_begin?>업로드확장자<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	업로드확장자
<?=($upload_file1_able)?'가능':'불가능'?>	업로드 가능여부

<?=$show_ext1_begin?>추가항목1<?=$show_ext1_end?>
<?=$show_ext1_title?>	추가항목명
<?=$show_ext1_input?>	추가항목입력폼
(1~5)

******************************************************************/
?>
<?
include_once('./editor/func_editor.php');
$content = "$rg_content";
?>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return editor_wr_ok();">
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type=hidden name=rg_title value='ok'>
<input type=hidden name=rg_content value='ok'>
<input type=hidden name=rg_name value='<?=$rg_name?>'>
<input type=hidden name=flash value='ok'>
<TR>
	<TD bgcolor=#999999 height=2></TD>
</TR>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
		<TR> 
			<TD bgColor=#e7e7e7 height=1></TD>
		</TR>


<?=$show_password_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* 비밀번호<B> 
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:90%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='암호'>
                          &nbsp;</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_password_end?>


<?=$show_html_begin?>
<input type=hidden name="rg_html_use" checked value="0" <?=$checked_html_use2?>>
<?=$show_html_end?>

<?=$show_upload_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR>
                        <TD width=131 align=right bgColor=#fafafa class="bbs">작은이미지# <B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input name='rg_file1' type=file style=width:90%;height:22; class=b_input id="rg_file1" <?if($mode == "write"){?>required  itemname='작은이미지'<?}?>> 
						<?=$show_file1_delete_begin?>
						<br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          삭제 ( <?=$rg_file1_name?> ) 
                        <?=$show_file1_delete_end?>
						<br> ※ 80 x 31 픽셀로 올려주세요 
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">큰이미지#<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file2' type=file style=width:90%;height:22; class=b_input id="rg_file2"  <?if($mode == "write"){?>required itemname='큰이미지'<?}?>>
                          <?=$show_file2_delete_begin?>
                          <br> <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          삭제 ( <?=$rg_file2_name?> ) 
                          <?=$show_file2_delete_end?>
						 <br> ※ 540 x 519 픽셀로 올려주세요 
                          <?=$show_file2_size_begin?>
                          <br> ※ <?=$upload_file2_size?> 이하만 업로드 가능
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  <br> ※ 확장자 <?=$upload_file2_ext?> 업로드 <?=($upload_file2_able)?'가능':'불가능'?>
						  <br> ※ 총 100개 까지만 등록이 가능합니다
						  <?=$show_file2_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>
<?
/*
$sql = "select max(admin_orderby) from rg_".$bbs_id."_body";
$result = mysql_query($sql,$dbcon);
$max_orderby = mysql_result($result,0,0);

if(!$admin_orderby){
	$admin_orderby=$max_orderby+1;
}
if($admin_orderby == 0){
	$admin_orderby=1;
}
*/
?>
<?if($mode == "edit"){?>

		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><B>우선순위</b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"><input type="hidden" name="admin_orderby_old" value="<?=$admin_orderby?>"><input type="text" name="admin_orderby" value="<?=$admin_orderby?>"></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?}else{?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><B></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"><input type="hidden" name="admin_orderby" value="1"></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?}?>

<?=$show_ext1_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><B><?=$show_ext1_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <?=$show_ext1_input?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext1_end?>
<?=$show_ext2_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext2_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <?=$show_ext2_input?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext2_end?>
<?=$show_ext3_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext3_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <?=$show_ext3_input?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext3_end?>
<?=$show_ext4_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext4_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <?=$show_ext4_input?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext4_end?>
<?=$show_ext5_begin?>
		<TR> 
			<TD> 
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext5_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <?=$show_ext5_input?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext5_end?>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD bgcolor=#E7E7E7 height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> <INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</form>
</TABLE>
<br>
<br>