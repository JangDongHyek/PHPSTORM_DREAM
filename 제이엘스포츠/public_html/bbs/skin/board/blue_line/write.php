<?
/******************************************************************
 �� ���ϼ��� �� 
����ϴ�

 �� ��Ų ������ ���� ���� ���� �� 

<?=$width?> 					���̺��� ����
<?=$skin_board_url?>	��Ų URL
<?=$site_url?>				����Ʈ URL
<?=$bbs_id?>					�Խ��� ���̵�

<?=$u_action?>				�۾��� URL
<?=$old_password?>		������ ���� ��ȣ
<?=$a_list?>					�۸�� ��ũ

<?=$show_notice_begin?>��������üũ<?=$show_notice_end?>
<?=$checked_notice?>	��������üũ����

<?=$show_secret_begin?>��б�üũ<?=$show_secret_end?>
<?=$checked_secret?>	��б�üũ����

<?=$show_reply_mail_begin?>����۸��Ϸιޱ⿩��<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	�����üũ����

<?=$show_name_begin?>�̸��Է�<?=$show_name_end?>
<?=$rg_name?>					�̸�

<?=$show_password_begin?>��ȣ�Է�<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	�ۼ�����尡 �ƴ϶�� �ʼ��Է�

<?=$show_email_begin?>�����Է�<?=$show_email_end?>
<?=$rg_email?>				����

<?=$show_home_url_begin?>Ȩ�������Է�<?=$show_home_url_end?>
<?=$rg_home_url?>			Ȩü����

<?=$show_category_begin?>ī�װ�����<?=$show_category_end?>
<?=$category_list_option?>	ī�װ����

<?=$show_html_begin?>	html ���¼���<?=$show_html_end?>
<?=$checked_html_use0?>	�Ϲݱ�üũ
<?=$checked_html_use1?>	htmlüũ
<?=$checked_html_use2?>	html+<br>üũ

<?=$rg_title?>				����
<?=$rg_content?>			����
<?=$show_link_begin?>	��ũ�Է���<?=$show_link_end?>
<?=$rg_link1_url?>		��ũ#1
<?=$rg_link2_url?>		��ũ#2

<?=$show_upload_begin?>���ε���<?=$show_upload_end?>

<?=$show_file1_delete_begin?>���ϻ���<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		���ϸ�
(1~2)

<?=$show_file1_size_begin?>�ִ���ε�뷮<?=$show_file1_size_end?>
<?=$upload_file1_size?>	�ִ���ε�뷮

<?=$show_file1_ext_begin?>���ε�Ȯ����<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	���ε�Ȯ����
<?=($upload_file1_able)?'����':'�Ұ���'?>	���ε� ���ɿ���

<?=$show_ext1_begin?>�߰��׸�1<?=$show_ext1_end?>
<?=$show_ext1_title?>	�߰��׸��
<?=$show_ext1_input?>	�߰��׸��Է���
(1~5)

******************************************************************/
?>
<script>
	function chkForm(f)
	{

		var denyArr=Array(",","-","/","=","~","|","?");
		for(var i=0;i<=denyArr.length;i++){
		//���� �ܾ� ���� ��ũ��Ʈ
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		//alert(rg_content); //��Ȯ��(�����)
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
					return "���� "+chk1+"��(��) ����� �� ���� �ܾ��Դϴ�.";
					break;
				}
				if(chk2==obj_DenyArr[i]){
					return "���뿡 "+chk2+"��(��) ����� �� ���� �ܾ��Դϴ�.";
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
			<TD height=30 align=middle><B>�����ۼ�</B> (*)ǥ�ð� �ִ� �κ��� �ʼ��׸��Դϴ�.</TD>
		</TR>
		<TR> 
			<TD bgColor=#e7e7e7 height=1></TD>
		</TR>
		<TR> 
			<TD>
                <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                   <TR> 
	                    <TD width=131 align=right bgColor=#fafafa class="bbs">������<B> 
                          &nbsp; </B></TD>
	                    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <?=$show_notice_begin?>
                          <input name=rg_notice type=checkbox id="rg_notice" value='1' <?=$checked_notice?>>��������&nbsp;
						  <?=$show_notice_end?>

						  <?=$show_secret_begin?>
						   <!-->��б�&nbsp; -->
						  <?=$show_secret_end?>
						  
						  <?=$show_reply_mail_begin?>
					 	  <input name=rg_reply_mail type=checkbox id="rg_reply_mail" value='1' <?=$checked_reply_mail?>>
                          �亯 ���Ϲޱ�&nbsp; 
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
	                    <TD width=131 align=right bgColor=#fafafa class="bbs">* �̸�<B> &nbsp; </B></TD>
	                    <TD bgcolor="#fafafa"><input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�̸�' style=width:100%;height:22; class=b_input></TD>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* ��й�ȣ<B> 
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:100%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='��ȣ'>
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
						<TD width=131 align=right bgColor=#fafafa class="bbs">�̸��� &nbsp;</TD>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">Ȩ������ &nbsp;</TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_home_url' type=text style=width:100%;height:22; class=b_input id="rg_home_url"  value='<?=$rg_home_url?>' itemname='Ȩ������'></TD>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* �з� &nbsp;</TD>
					    <TD bgcolor="#fafafa"> <select name=rg_cat_num id="rg_cat_num" required itemname='�з�'>
														<option value=''>�����ϼ���.</option>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">html ��� &nbsp; </TD>
					    <TD class="bbs" bgcolor="#fafafa"> <input type="radio" name="rg_html_use" value="0" <?=$checked_html_use0?>> �Ϲݱ� <input type="radio" name="rg_html_use" value="1" <?=$checked_html_use1?>> HTML <input type="radio" name="rg_html_use" value="2" <?=$checked_html_use2?>> HTML+&lt;br&gt; </TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_html_end?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* ����<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_title' type=text style=width:100%;height:22; class=b_input id="rg_title"  value='<?=$rg_title?>' required itemname='����'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50"> 
				<TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs" onClick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* ���� ��<B>&nbsp;</B></TD>					              
                        <TD align=left height="100" bgcolor="#fafafa"> <textarea name="rg_content" id="rg_content"  rows=15  style=width:100%; class="b_textarea" required itemname='����'><?=$rg_content?></textarea> <img width="1" height="1"></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_link_begin?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs">��ũ #1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link1_url' type=text style=width:100%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='��ũ #1'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>																						
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
                        <TD width=131 align=right bgColor=#fafafa class="bbs">��ũ #2<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> 
                          <input name='rg_link2_url' type=text style=width:100%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='��ũ #2'>
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
                        <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #1<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input name='rg_file1' type=file style=width:100%;height:22; class=b_input id="rg_file1"  itemname='���� #1'> 
						<?=$show_file1_delete_begin?>
						<br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          ���� ( <?=$rg_file1_name?> ) 
                        <?=$show_file1_delete_end?>

                        <?=$show_file1_size_begin?>
                        <br> �� <?=$upload_file1_size?> ���ϸ� ���ε� ���� 
                        <?=$show_file1_size_end?>

                        <?=$show_file1_ext_begin?>
                        <br> �� Ȯ���� <?=$upload_file1_ext?> ���ε� <?=($upload_file1_able)?'����':'�Ұ���'?>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #2<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file2' type=file style=width:100%;height:22; class=b_input id="rg_file2"  itemname='���� #2'>
                          <?=$show_file2_delete_begin?>
                          <br> <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          ���� ( <?=$rg_file2_name?> ) 
                          <?=$show_file2_delete_end?>

                          <?=$show_file2_size_begin?>
                          <br> �� <?=$upload_file2_size?> ���ϸ� ���ε� ����
						  <?=$show_file2_size_end?>
						
						  <?=$show_file2_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file2_ext?> ���ε� <?=($upload_file2_able)?'����':'�Ұ���'?>
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
						<TD width=131 align=right bgColor=#fafafa class="bbs">���Թ���<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa">
						<img src="<?=$skin_board_url?>code_img.php">
						<input type=hidden name="rg_spam1" id="rg_spam1" value="<?=$span_num?>">
						<input name='user_scode' id="user_scode" type=text style=width:10%;height:22; class=b_input required itemname='���Թ��� ��ȣ'> �ؾ��� �Ķ��� ���ڸ� ��ĭ�� �Է����ּ���.</TD>
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