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
<script src="../bbs/editor/easyEditor.js"></script>
<script>
	function chkForm(f)
	{
		var rg_content = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
		if(rg_content=="")
		{
			alert("������ �����ּ���!");
			ed.focus();
			return false;
		}
		//alert(rg_content); //��Ȯ��(�����)
		return true;
	}
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chkForm(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name=rg_files_count value='20'>
<input type=hidden name=old_password value='<?=$old_password?>'>
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
						  <input name=rg_secret type=checkbox id="rg_secret" value='1' <?=$checked_secret?>>��б�&nbsp; 
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
	                    <TD bgcolor="#fafafa"> 
                          <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�̸�' style=width:90%;height:22; class=b_input>
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
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* ��й�ȣ<B> 
                          &nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_password' type=password style=width:90%;height:22; class=b_input id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='��ȣ'>
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
						<TD align=left bgcolor="#fafafa"> <input name='rg_email' type=text style=width:90%;height:22; class=b_input id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail'></TD>
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
					    <TD align=left bgcolor="#fafafa"> <input name='rg_home_url' type=text style=width:90%;height:22; class=b_input id="rg_home_url"  value='<?=$rg_home_url?>' itemname='Ȩ������'></TD>
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
<?=$show_html_begin?>
<input type=hidden name="rg_html_use" checked value="1" <?=$checked_html_use2?>>
<?=$show_html_end?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">* ����<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_title' type=text style=width:90%;height:22; class=b_input id="rg_title"  value='<?=$rg_title?>' required itemname='����'></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD height="50">
				<TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* ���� ��<B>&nbsp;</B></TD>
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
						<TD width=131 align=right bgColor=#fafafa class="bbs">��ũ #1<B> &nbsp;</B></TD>
					    <TD align=left bgcolor="#fafafa"> <input name='rg_link1_url' type=text style=width:90%;height:22; class=b_input id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='��ũ #1'></TD>
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
                          <input name='rg_link2_url' type=text style=width:90%;height:22; class=b_input id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='��ũ #2'>
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
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input name='rg_file1' type=file style=width:90%;height:22; class=b_input id="rg_file1"  itemname='���� #1'> 
						<?=$show_file1_delete_begin?>
						<br> <input name='del_file1' type=checkbox id="del_file1" value='1'>
                          ���� ( <?=$rg_file1_name?> ) 
                        <?=$show_file1_delete_end?>
                        <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���

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
                          <input name='rg_file2' type=file style=width:90%;height:22; class=b_input id="rg_file2"  itemname='���� #2'>
                          <?=$show_file2_delete_begin?>
                          <br> <input name='del_file2' type=checkbox id="del_file2" value='1'>
                          ���� ( <?=$rg_file2_name?> ) 
                          <?=$show_file2_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
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
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #3<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file3' type=file style=width:90%;height:22; class=b_input id="rg_file3"  itemname='���� #3'>
                          <?=$show_file3_delete_begin?>
                          <br> <input name='del_file3' type=checkbox id="del_file3" value='1'>
                          ���� ( <?=$rg_file3_name?> ) 
                          <?=$show_file3_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file3_size_begin?>
                          <br> �� <?=$upload_file3_size?> ���ϸ� ���ε� ����
						  <?=$show_file3_size_end?>
						
						  <?=$show_file3_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file3_ext?> ���ε� <?=($upload_file3_able)?'����':'�Ұ���'?>
						  <?=$show_file3_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #4<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file4' type=file style=width:90%;height:22; class=b_input id="rg_file4"  itemname='���� #3'>
                          <?=$show_file4_delete_begin?>
                          <br> <input name='del_file4' type=checkbox id="del_file4" value='1'>
                          ���� ( <?=$rg_file4_name?> ) 
                          <?=$show_file4_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file4_size_begin?>
                          <br> �� <?=$upload_file4_size?> ���ϸ� ���ε� ����
						  <?=$show_file4_size_end?>
						
						  <?=$show_file4_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file4_ext?> ���ε� <?=($upload_file4_able)?'����':'�Ұ���'?>
						  <?=$show_file4_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #5<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file5' type=file style=width:90%;height:22; class=b_input id="rg_file5"  itemname='���� #3'>
                          <?=$show_file5_delete_begin?>
                          <br> <input name='del_file5' type=checkbox id="del_file5" value='1'>
                          ���� ( <?=$rg_file5_name?> ) 
                          <?=$show_file5_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file5_size_begin?>
                          <br> �� <?=$upload_file5_size?> ���ϸ� ���ε� ����
						  <?=$show_file5_size_end?>
						
						  <?=$show_file5_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file5_ext?> ���ε� <?=($upload_file5_able)?'����':'�Ұ���'?>
						  <?=$show_file5_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #6<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file6' type=file style=width:90%;height:22; class=b_input id="rg_file6"  itemname='���� #3'>
                          <?=$show_file6_delete_begin?>
                          <br> <input name='del_file6' type=checkbox id="del_file6" value='1'>
                          ���� ( <?=$rg_file6_name?> ) 
                          <?=$show_file6_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file6_size_begin?>
                          <br> �� <?=$upload_file6_size?> ���ϸ� ���ε� ����
						  <?=$show_file6_size_end?>
						
						  <?=$show_file6_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file6_ext?> ���ε� <?=($upload_file6_able)?'����':'�Ұ���'?>
						  <?=$show_file6_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #7<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file7' type=file style=width:90%;height:22; class=b_input id="rg_file7"  itemname='���� #3'>
                          <?=$show_file7_delete_begin?>
                          <br> <input name='del_file7' type=checkbox id="del_file7" value='1'>
                          ���� ( <?=$rg_file7_name?> ) 
                          <?=$show_file7_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file7_size_begin?>
                          <br> �� <?=$upload_file7_size?> ���ϸ� ���ε� ����
						  <?=$show_file7_size_end?>
						
						  <?=$show_file7_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file7_ext?> ���ε� <?=($upload_file7_able)?'����':'�Ұ���'?>
						  <?=$show_file7_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #8<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file8' type=file style=width:90%;height:22; class=b_input id="rg_file8"  itemname='���� #3'>
                          <?=$show_file8_delete_begin?>
                          <br> <input name='del_file8' type=checkbox id="del_file8" value='1'>
                          ���� ( <?=$rg_file8_name?> ) 
                          <?=$show_file8_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file8_size_begin?>
                          <br> �� <?=$upload_file8_size?> ���ϸ� ���ε� ����
						  <?=$show_file8_size_end?>
						
						  <?=$show_file8_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file8_ext?> ���ε� <?=($upload_file8_able)?'����':'�Ұ���'?>
						  <?=$show_file8_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #9<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file9' type=file style=width:90%;height:22; class=b_input id="rg_file9"  itemname='���� #3'>
                          <?=$show_file9_delete_begin?>
                          <br> <input name='del_file9' type=checkbox id="del_file9" value='1'>
                          ���� ( <?=$rg_file9_name?> ) 
                          <?=$show_file9_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file9_size_begin?>
                          <br> �� <?=$upload_file9_size?> ���ϸ� ���ε� ����
						  <?=$show_file9_size_end?>
						
						  <?=$show_file9_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file9_ext?> ���ε� <?=($upload_file9_able)?'����':'�Ұ���'?>
						  <?=$show_file9_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #10<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file10' type=file style=width:90%;height:22; class=b_input id="rg_file10"  itemname='���� #3'>
                          <?=$show_file10_delete_begin?>
                          <br> <input name='del_file10' type=checkbox id="del_file10" value='1'>
                          ���� ( <?=$rg_file10_name?> ) 
                          <?=$show_file10_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file10_size_begin?>
                          <br> �� <?=$upload_file10_size?> ���ϸ� ���ε� ����
						  <?=$show_file10_size_end?>
						
						  <?=$show_file10_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file10_ext?> ���ε� <?=($upload_file10_able)?'����':'�Ұ���'?>
						  <?=$show_file10_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #11<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file11' type=file style=width:90%;height:22; class=b_input id="rg_file11"  itemname='���� #3'>
                          <?=$show_file11_delete_begin?>
                          <br> <input name='del_file11' type=checkbox id="del_file11" value='1'>
                          ���� ( <?=$rg_file11_name?> ) 
                          <?=$show_file11_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file11_size_begin?>
                          <br> �� <?=$upload_file11_size?> ���ϸ� ���ε� ����
						  <?=$show_file11_size_end?>
						
						  <?=$show_file11_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file11_ext?> ���ε� <?=($upload_file11_able)?'����':'�Ұ���'?>
						  <?=$show_file11_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #12<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file12' type=file style=width:90%;height:22; class=b_input id="rg_file12"  itemname='���� #3'>
                          <?=$show_file12_delete_begin?>
                          <br> <input name='del_file12' type=checkbox id="del_file12" value='1'>
                          ���� ( <?=$rg_file12_name?> ) 
                          <?=$show_file12_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file12_size_begin?>
                          <br> �� <?=$upload_file12_size?> ���ϸ� ���ε� ����
						  <?=$show_file12_size_end?>
						
						  <?=$show_file12_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file12_ext?> ���ε� <?=($upload_file12_able)?'����':'�Ұ���'?>
						  <?=$show_file12_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #13<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file13' type=file style=width:90%;height:22; class=b_input id="rg_file13"  itemname='���� #3'>
                          <?=$show_file13_delete_begin?>
                          <br> <input name='del_file13' type=checkbox id="del_file13" value='1'>
                          ���� ( <?=$rg_file13_name?> ) 
                          <?=$show_file13_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file13_size_begin?>
                          <br> �� <?=$upload_file13_size?> ���ϸ� ���ε� ����
						  <?=$show_file13_size_end?>
						
						  <?=$show_file13_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file13_ext?> ���ε� <?=($upload_file13_able)?'����':'�Ұ���'?>
						  <?=$show_file13_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #14<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file14' type=file style=width:90%;height:22; class=b_input id="rg_file14"  itemname='���� #3'>
                          <?=$show_file14_delete_begin?>
                          <br> <input name='del_file14' type=checkbox id="del_file14" value='1'>
                          ���� ( <?=$rg_file14_name?> ) 
                          <?=$show_file14_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file14_size_begin?>
                          <br> �� <?=$upload_file14_size?> ���ϸ� ���ε� ����
						  <?=$show_file14_size_end?>
						
						  <?=$show_file14_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file14_ext?> ���ε� <?=($upload_file14_able)?'����':'�Ұ���'?>
						  <?=$show_file14_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #15<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file15' type=file style=width:90%;height:22; class=b_input id="rg_file15"  itemname='���� #3'>
                          <?=$show_file15_delete_begin?>
                          <br> <input name='del_file15' type=checkbox id="del_file15" value='1'>
                          ���� ( <?=$rg_file15_name?> ) 
                          <?=$show_file15_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file15_size_begin?>
                          <br> �� <?=$upload_file15_size?> ���ϸ� ���ε� ����
						  <?=$show_file15_size_end?>
						
						  <?=$show_file15_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file15_ext?> ���ε� <?=($upload_file15_able)?'����':'�Ұ���'?>
						  <?=$show_file15_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #16<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file16' type=file style=width:90%;height:22; class=b_input id="rg_file16"  itemname='���� #3'>
                          <?=$show_file16_delete_begin?>
                          <br> <input name='del_file16' type=checkbox id="del_file16" value='1'>
                          ���� ( <?=$rg_file16_name?> ) 
                          <?=$show_file16_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file16_size_begin?>
                          <br> �� <?=$upload_file16_size?> ���ϸ� ���ε� ����
						  <?=$show_file16_size_end?>
						
						  <?=$show_file16_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file16_ext?> ���ε� <?=($upload_file16_able)?'����':'�Ұ���'?>
						  <?=$show_file16_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #17<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file17' type=file style=width:90%;height:22; class=b_input id="rg_file17"  itemname='���� #3'>
                          <?=$show_file17_delete_begin?>
                          <br> <input name='del_file17' type=checkbox id="del_file17" value='1'>
                          ���� ( <?=$rg_file17_name?> ) 
                          <?=$show_file17_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file17_size_begin?>
                          <br> �� <?=$upload_file17_size?> ���ϸ� ���ε� ����
						  <?=$show_file17_size_end?>
						
						  <?=$show_file17_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file17_ext?> ���ε� <?=($upload_file17_able)?'����':'�Ұ���'?>
						  <?=$show_file17_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #18<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file18' type=file style=width:90%;height:22; class=b_input id="rg_file18"  itemname='���� #3'>
                          <?=$show_file18_delete_begin?>
                          <br> <input name='del_file18' type=checkbox id="del_file18" value='1'>
                          ���� ( <?=$rg_file18_name?> ) 
                          <?=$show_file18_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file18_size_begin?>
                          <br> �� <?=$upload_file18_size?> ���ϸ� ���ε� ����
						  <?=$show_file18_size_end?>
						
						  <?=$show_file18_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file18_ext?> ���ε� <?=($upload_file18_able)?'����':'�Ұ���'?>
						  <?=$show_file18_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #19<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file19' type=file style=width:90%;height:22; class=b_input id="rg_file19"  itemname='���� #3'>
                          <?=$show_file19_delete_begin?>
                          <br> <input name='del_file19' type=checkbox id="del_file19" value='1'>
                          ���� ( <?=$rg_file19_name?> ) 
                          <?=$show_file19_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file19_size_begin?>
                          <br> �� <?=$upload_file19_size?> ���ϸ� ���ε� ����
						  <?=$show_file19_size_end?>
						
						  <?=$show_file19_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file19_ext?> ���ε� <?=($upload_file19_able)?'����':'�Ұ���'?>
						  <?=$show_file19_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
				<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
					    <TD width=131 align=right bgColor=#fafafa class="bbs">÷��ȭ�� #20<B>&nbsp;&nbsp; </B></TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> 
                          <input name='rg_file20' type=file style=width:90%;height:22; class=b_input id="rg_file20"  itemname='���� #3'>
                          <?=$show_file20_delete_begin?>
                          <br> <input name='del_file20' type=checkbox id="del_file20" value='1'>
                          ���� ( <?=$rg_file20_name?> ) 
                          <?=$show_file20_delete_end?>
						  <br> �� 2000 x 2000�ȼ� ���ϸ� ���ε� �ϼ���
                         
						  <?=$show_file20_size_begin?>
                          <br> �� <?=$upload_file20_size?> ���ϸ� ���ε� ����
						  <?=$show_file20_size_end?>
						
						  <?=$show_file20_ext_begin?>
						  <br> �� Ȯ���� <?=$upload_file20_ext?> ���ε� <?=($upload_file20_able)?'����':'�Ұ���'?>
						  <?=$show_file20_ext_end?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
<?=$show_upload_end?>
		<?
	$bbs_id_substr = substr($bbs_id,0,3);
	if($bbs_id_substr == "pro"){ //������ �켱����
		?>
		<TR> 
			<TD>
				<TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
					<TR> 
						<TD width=131 align=right bgColor=#fafafa class="bbs"><B>�켱����</b>&nbsp;&nbsp; </TD>
					    <TD align=left class="bbs" bgcolor="#fafafa"> <input type="text" name="admin_orderby" value="<?=$admin_orderby?>"></TD>
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
		var ed = new easyEditor("rg_content"); //�ʱ�ȭ id�Ӽ���
		ed.init(); //�������� ����
</script>
</form>
</TABLE>
<br>
<br>