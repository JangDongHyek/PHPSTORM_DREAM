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
		var rg_spam1=document.getElementById("rg_spam1").value;
		if(rg_spam1){
			var rg_spam2=document.getElementById("rg_spam2").value;
			if(rg_spam1!=rg_spam2){
				alert("���Թ��� ��ȣ�� ���� �ʽ��ϴ�.");
				return false;
			}
		}
		/*var obj_Title_arr=document.getElementById("rg_title").value.split(",");
		var obj_titles="";
		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(",");
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
					alert("���� "+chk1+"��(��) ����� �� ���� �ܾ��Դϴ�.");
					return false;
					break;
				}
				if(chk2==obj_DenyArr[i]){
					alert("���뿡 "+chk2+"��(��) ����� �� ���� �ܾ��Դϴ�.");
					return false;
					break;
				}
			}
		}*/
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
<input type=hidden name="rg_title" value='�������� ��û��'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<TR>
	<TD bgcolor=#B6C232 height=2></TD>
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
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">* ����<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='�̸�' style=width:90%;height:22; class=b_input>                        </TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">�������<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="date" name="birth">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">* �ּ�<B>
                                                        &nbsp; </B></TD>
                                                <TD align=left class="bbs" bgcolor="#FFFFFF">
                                                    <input id="address1" name='address1' type="text" style=width:90%;height:22; class="b_input" readonly onclick="openPostCode()" placeholder="�ּ�"/>
                                                    <input name='address2' type="text" style=width:90%;height:22; class="b_input" placeholder="���ּ�"/>
                                                    <br>
                                                    <button onclick="openPostCode()">�ּ�ã��</button>
                                                    &nbsp;</TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">�Ҽ� �����<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="text" name="belong">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">�޴���<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="text" name="phone">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">�ٹ�����<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="radio" name="work_type" value="�湮���">�湮���
                                                    <input type="radio" name="work_type" value="�湮���">�湮���
                                                    <input type="radio" name="work_type" value="�ְ���ȣ����">�ְ���ȣ����
                                                    <input type="radio" name="work_type" value="���ü�">���ü�
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">��û ������<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="date" name="birth">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">�����ð�<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="radio" name="work_time" value="�ְ�(����)">�ְ�(����)
                                                    <input type="radio" name="work_time" value="��">��
                                                    <input type="radio" name="work_time" value="��">��
                                                    <input type="radio" name="work_time" value="����">����
                                                    <input type="radio" name="work_time" value="����">����
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD height="50">
                                        <TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* ���������� ��<B>&nbsp;</B></TD>
                                                <TD align=left height="100" bgcolor="#FFFFFF"> <textarea name="rg_content" id="rg_content"  rows=15  style=width:90%; class="b_textarea" required itemname='����'><?=$rg_content?></textarea> <img width="1" height="1"></TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

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

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
    function openPostCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById("address1").value = data.address;
            }
        }).open();
    }
</script>