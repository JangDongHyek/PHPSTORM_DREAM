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
<script>
	function chkForm(f)
	{

		var denyArr=Array(",","-","/","=","~","|","?");
		for(var i=0;i<=denyArr.length;i++){
		//금지 단어 방지 스크립트
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		//alert(rg_content); //값확인(디버깅)
		return true;
	}



	function denyText(gubun){
		var obj_Deny=document.getElementById("bbs_deny_word").value;
		var obj_Title_arr=document.getElementById("rg_title").value.split(gubun);
		var obj_titles="";
		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(gubun);
		var obj_DenyArr=obj_Deny.split(",");
		for(var j=0;j<obj_Title_arr.length;j++){
			obj_titles+=obj_Title_arr[j];
		}
		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}
		var obj_Title=obj_titles;
		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk1=obj_Title.match(obj_DenyArr[i].toString());
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk1==obj_DenyArr[i]){
					return "제목에 "+chk1+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
				if(chk2==obj_DenyArr[i]){
					return "내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
			}
		}
		return "";
	}
	
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chkForm(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<input name=rg_secret type=hidden id="rg_secret" value='1' checked>
<TR>
	<TD bgcolor=#0D2465 height=2></TD>
</TR>
<TR> 
	<TD>
	<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
    <TR> 
		<TD> 
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
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
						   <!-->비밀글&nbsp; -->
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
	                    <TD width=131 align=right bgColor=#fafafa class="bbs">* 이름<B> &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"><input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름' style=width:100%;height:22; class=b_input></TD>
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
                          <input name='rg_password' type=password style=width:100%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='암호'>
                          &nbsp;</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_password_end?>

				
<?=$show_email_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs">이메일 &nbsp;</TD>
						<TD align=left bgcolor="#fafafa"> <input name='rg_email' type=text style=width:100%;height:22; class=b_input id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_email_end?>
<?=$show_home_url_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">홈페이지 &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_home_url' type=text style=width:100%;height:22; class=b_input id="rg_home_url"  value='<?=$rg_home_url?>' itemname='홈페이지'></TD>
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
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* 제목<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_title' type=text style=width:100%;height:22; class=b_input id="rg_title"  value='<?=$rg_title?>' required itemname='제목'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50"> 
				<TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs" onClick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* 내용 ▼<B>&nbsp;</B></TD>					              
                        <TD align=left height="100" bgcolor="#fafafa"> <textarea name="rg_content" id="rg_content"  rows=15  style=width:100%; class="b_textarea" required itemname='내용'><?=$rg_content?></textarea> <img width="1" height="1"></TD>
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
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link1_url' type=text style=width:100%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='링크 #1'></TD>
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
                          <input name='rg_link2_url' type=text style=width:100%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='링크 #2'>
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
                        <TD width=131 align=right bgColor=#fafafa class="bbs">첨부화일 #1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input name='rg_file1' type=file style=width:100%;height:22; class=b_input id="rg_file1"  itemname='파일 #1'> 
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">첨부화일 #2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file2' type=file style=width:100%;height:22; class=b_input id="rg_file2"  itemname='파일 #2'>
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
		if($ss_mb_level!=10){
		if($bbs_id=="qnaa"){?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs">스팸방지<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa">
						<img src="<?=$skin_board_url?>code_img.php">
						<input type=hidden name="rg_spam1" id="rg_spam1" value="<?=$span_num?>">
						<input name='user_scode' id="user_scode" type=text style=width:10%;height:22; class=b_input required itemname='스팸방지 번호'> ※앞의 파란색 숫자를 빈칸에 입력해주세요.</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>	
		<? }}?>
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