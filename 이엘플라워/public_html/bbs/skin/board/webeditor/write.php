<?
        $tmp = rg_str_inword($bbs[bbs_deny_word],$rg_content);
?>
<script src="../bbs/editor/easyEditor.js"></script>
<script>
        function chkForm(f)
        {

                var rg_content = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
                if(rg_content=="")
                {
                        alert("내용을 적어주세요!");
                        ed.focus();
                        return false;
                }
                //금지 단어 방지 스크립트
                var obj_Deny=document.getElementById("bbs_deny_word").value;
                var obj_Title=document.getElementById("rg_title").value;
                var obj_Content=document.getElementById("rg_content").innerHTML;
                var obj_DenyArr=obj_Deny.split(",");
		if(obj_Deny){
                for(var i=0;i<obj_DenyArr.length;i++){
                        var chk1=obj_Title.match(obj_DenyArr[i].toString());
                        var chk2=obj_Content.match(obj_DenyArr[i].toString());

                        if(chk1==obj_DenyArr[i]){
                                alert("제목에 "+chk1+"는(은) 사용할 수 없는 단어입니다.");
                                return false;
                                break;
                        }
                        if(chk2==obj_DenyArr[i]){
                                alert("내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.");
                                return false;
                                break;
                        }
                }
		}

        }
</script>

<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chkForm(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="bbs_deny_word" id="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
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
			<TD height=30 align=middle><B>새글작성</B> (*)표시가 있는 부분은 필수항목입니다.</TD>
		</TR>
		<TR> 
			<TD bgColor=#e7e7e7 height=1></TD>
		</TR>
		<TR> 
			<TD>
                <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                   <TR> 
	                    <TD width=131 align=right bgColor=#fafafa class="bbs">글종류<B> 
                          &nbsp; </B></TD>
	                    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_notice_begin?>
                          <input name=rg_notice type=checkbox id="rg_notice" value='1' <?=$checked_notice?>>공지사항&nbsp;
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
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
	                    <TD width=131 align=right bgColor=#fafafa class="bbs">* 작성자<B> &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"> 
                          <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='작성자' style=width:90%;height:22; class=b_input>
                        </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_name_end?>

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

				
<?=$show_home_url_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">홈페이지 &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_home_url' type=text style=width:90%;height:22; class=b_input id="rg_home_url"  value='<?=$rg_home_url?>' itemname='홈페이지'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_home_url_end?>

<?=$show_category_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* 분류 &nbsp;</TD>
					    <TD bgcolor="#fafafa"> <select name=rg_cat_num id="rg_cat_num" required itemname='분류'>
														<option value=''>선택하세요.</option>
														<?=$category_list_option?>
													   </select></TD>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">html 사용 &nbsp; </TD>
					    <TD class="bbs" bgcolor="#fafafa"> <input type="radio" name="rg_html_use" value="0" <?=$checked_html_use0?>> 일반글 <input type="radio" name="rg_html_use" value="1" <?=$checked_html_use1?>> HTML <input type="radio" name="rg_html_use" value="2" <?=$checked_html_use2?>> HTML+&lt;br&gt; </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_html_end?>
<?=$show_html_begin?>
<input type=hidden name="rg_html_use" checked value="1" <?=$checked_html_use2?>>
<?=$show_html_end?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* 제목<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_title' type=text style=width:90%;height:22; class=b_input id="rg_title"  value='<?=$rg_title?>' required itemname='제목'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50">
				<TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* 내용 ▼<B>&nbsp;</B></TD>
						<TD align=left height="100" bgcolor="#fafafa"> 
						<textarea name="rg_content" id="rg_content"><?=$rg_content?></textarea>
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
						<TD width=131 align=right bgColor=#fafafa class="bbs">링크 #1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link1_url' type=text style=width:90%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='링크 #1'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>																						
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
                        <TD width=131 align=right bgColor=#fafafa class="bbs">링크 #2<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_link2_url' type=text style=width:90%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='링크 #2'>
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
                        <TD width=131 align=right valign=top bgColor=#fafafa class="bbs">첨부화일 #1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input name='rg_file1' type=file style=width:90%;height:22; class=b_input id="rg_file1"  itemname='파일 #1'> 
						<?=$show_file1_delete_begin?>
						<br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          삭제 ( <?=$rg_file1_name?> ) 
                        <?=$show_file1_delete_end?>

                        <?=$show_file1_size_begin?>
                        <br> ※ <?=$upload_file1_size?> 이하만 업로드 가능 
                        <?=$show_file1_size_end?>

                        <?=$show_file1_ext_begin?>
                        <br> ※ 확장자 <?=$upload_file1_ext?> 업로드 <?=($upload_file1_able)?'가능':'불가능'?>
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
					    <TD width=131 align=right valign=top bgColor=#fafafa class="bbs">첨부화일 #2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file2' type=file style=width:90%;height:22; class=b_input id="rg_file2"  itemname='파일 #2'>
                          <?=$show_file2_delete_begin?>
                          <br> <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          삭제 ( <?=$rg_file2_name?> ) 
                          <?=$show_file2_delete_end?>

                          <?=$show_file2_size_begin?>
                          <br> ※ <?=$upload_file2_size?> 이하만 업로드 가능
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  <br> ※ 확장자 <?=$upload_file2_ext?> 업로드 <?=($upload_file2_able)?'가능':'불가능'?>
						  <?=$show_file2_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>

<?
//스팸방지(관리자모드->게시판관리->해당게시판 기능설정에 있음
if($bbs_cfg[$C_USE_REMOTE_WRITE] == 1 && !$ss_mb_id){
?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs">스팸방지<B> &nbsp;</B></TD>
						<TD align=left valign=top bgcolor="#fafafa">						
						<img src="code_img.php">&nbsp;&nbsp;<input type="text" name="user_scode" required itemname="스팸방지번호" size="8" style="border-width:1; border-color:#CCCCCC; border-style:solid;"> ※앞의 숫자 3자리를 빈칸에 입력해주세요.</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?
}
?>


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
<script>
		var ed = new easyEditor("rg_content"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
</script>
</form>
</TABLE>
<br>
<br>
