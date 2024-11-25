<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' <? if($mode == 'edit') {?>OnSubmit='javascript:return ContentCheck()'<?}?> enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
		<TR> 
			<TD height=30><B>&nbsp; </B><IMG 
                        src="<?=$skin_board_url?>images/arrow_1.gif" border=0 align=absmiddle> <b><?=date('Y년 n월 j일',$book);?> 업무계획 <? if($mode == 'edit') {?>수정<?} else {?>작성<?}?></b><div align=right>(<font color=red>*</font>)표시가 있는 부분은 필수항목입니다.<B> 
                          &nbsp; </B></div></TD>
		</TR>
		<TR> 
			<TD bgColor=#cccccc height=1></TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=80 align=right bgColor=#fafafa class="bbs">옵션<B> 
                          &nbsp; </B></TD>
	                    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_notice_begin?>
                          <input name=rg_notice type=checkbox id="rg_notice" value='1' <?=$checked_notice?>> 주요일정으로 등록&nbsp;
						  <?=$show_notice_end?>
						  <?=$show_secret_begin?>
						  <input name=rg_secret type=checkbox id="rg_secret" value='1' <?=$checked_secret?>>비밀글&nbsp; 
						  <?=$show_secret_end?>
						  <?=$show_reply_mail_begin?>
						  <input name=rg_reply_mail type=checkbox id="rg_reply_mail" value='1' <?=$checked_reply_mail?>>
                          답변 메일받기&nbsp; 
                          <?=$show_reply_mail_end?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>

<?=$show_name_begin?>
<? if($mb[mb_level]) { ?>
		<input name='rg_name' type=hidden id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름'>
<?
	} else {	
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> 이름<B> &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"> 
                          <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름' style=width:100%;height:22; class=b_input>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<? } ?>
<?=$show_name_end?>

<?=$show_password_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> 비밀번호<B> 
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:100%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='암호'>
                          &nbsp;</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_password_end?>

				
<?=$show_email_begin?>
<? if($mb[mb_level]) { ?>
		<input name='rg_email' type=hidden id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail'>
<?
} else {	
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs">이메일 &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_email' type=text style=width:100%;height:22; class=b_input id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<? } ?>
<?=$show_email_end?>
<?=$show_home_url_begin?>
<? if($mb[mb_level]) { ?>
		<input name='rg_home_url' type=hidden id="rg_home_url"  value='<?=$rg_home_url?>' itemname='홈페이지'>
<?
} else {	
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs">홈페이지 &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_home_url' type=text style=width:100%;height:22; class=b_input id="rg_home_url"  value='<?=$rg_home_url?>' itemname='홈페이지'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<? } ?>
<?=$show_home_url_end?>

<?=$show_category_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" 	border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> 
                          분류 &nbsp;</TD>
					    <TD bgcolor="#fafafa"> <select style="behavior: url('addon/etc/selectbox.htc');" name=rg_cat_num id="rg_cat_num" required itemname='분류'>
							<option value=''>선택하세요.</option>
							<?=$category_list_option?>
							</select>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_category_end?>

<?=$show_html_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs">html 사용 &nbsp; </TD>
					    <TD align=left bgcolor="#fafafa">
                          <input type="radio" name="rg_html_use" value="0" <?=$checked_html_use0?>> 일반글 
						  <input type="radio" name="rg_html_use" value="1" <?=$checked_html_use1?>> HTML 
						  <input type="radio" name="rg_html_use" value="2" <?=$checked_html_use2?>> HTML+&lt;br&gt;
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_html_end?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs"><font color=red>*</font> 제목<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_title' type=text style=width:100%;height:22; class=b_input id="rg_title"  value='<?=$rg_title?>' required itemname='제목'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50"  nowrap>
				 <TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand><font color=red>*</font> 내용  ▼<B>&nbsp;</B></TD>
					    <TD align=left height="100"> <textarea name="rg_content" id="rg_content"  cols=60  rows=18 style="width:100%;word-break:break-all;" class="textarea required" itemname='내용'><?=$rg_content?></textarea>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_link_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 					
                        <TD width=80 align=right bgColor=#fafafa class="bbs">링크 1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_link1_url' type=text style=width:100%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='링크 #1'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>																						
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
                        <TD width=80 align=right bgColor=#fafafa class="bbs">링크 2<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link2_url' type=text style=width:100%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='링크 #2'>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_link_end?>
<?=$show_upload_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 					
                        <TD width=80 align=right bgColor=#fafafa class="bbs">첨부파일 1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file11' type='text' style=width:85%;height:22; class=b_input id="rg_file1"  itemname='파일 #1'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file1' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file11.value=this.value'></span>
						
						  <?=$show_file1_delete_begin?>
						  <br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          삭제 (
                          <?=$rg_file1_name?>
                          ) 
                          <?=$show_file1_delete_end?>
                          <?=$show_file1_size_begin?>

                          ※  파일크기 <?=$upload_file1_size?>이하,
                          <?=$show_file1_size_end?>
                          <?=$show_file1_ext_begin?>
                          확장자 <?=$upload_file1_ext?> 첨부 <?=($upload_file1_able)?'가능':'불가능'?>
                          <?=$show_file1_ext_end?>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=80 align=right bgColor=#fafafa class="bbs">첨부화일 2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file22' type='text' style=width:85%;height:22; class=b_input id="rg_file2"  itemname='파일 #2'> 
						  <span style="overflow:hidden; width:80; height:22; background-image:url(<?=$skin_board_url?>images/search_file.gif);"> 
						  <input  name='rg_file2' type='file' style="width:0;height:22;filter:alpha(opacity=0);" onchange='rg_file22.value=this.value'></span>
                          <?=$show_file2_delete_begin?>
                          <br>
                           <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          삭제 (
                          <?=$rg_file2_name?>
                          ) 
                          <?=$show_file2_delete_end?>
                          <?=$show_file2_size_begin?>
                   				※ 파일크기 <?=$upload_file2_size?> 이하, 
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  확장자 <?=$upload_file2_ext?> 첨부 <?=($upload_file2_able)?'가능':'불가능'?>
						  <?=$show_file2_ext_end?>

						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>
<?=$show_ext1_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><B><?=$show_ext1_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext1_input?>
                        </TD>
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
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext2_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext2_input?>
                        </TD>
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
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext3_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext3_input?>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext3_end?>
<?=$show_ext5_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=80 align=right bgColor=#fafafa class="bbs"><b><?=$show_ext5_title?></b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_ext5_input?>
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_ext5_end?>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD bgcolor=#cccccc height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> 
		<INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
<? if($mode == 'edit') {?>
<input type=hidden name=rg_ext5 value='<?=$rg_ext5?>'>
<?} else {?>
<input type=hidden name=rg_ext5 value='<?=$book?>'>
<?}?>
</form>
</TABLE>
<br>
<br>