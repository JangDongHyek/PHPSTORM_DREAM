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

<SCRIPT LANGUAGE="JavaScript">
<!--
	
	function check(){
		
		if(document.form_write.rg_name.value == ""){
			alert("�̸��� �����ּ���");
			document.form_write.rg_name.focus();
			return false;
		}else if(document.form_write.rg_phone.value == ""){
			alert("�ڵ����� �ʼ��Է»����Դϴ�.");
			document.form_write.rg_phone.focus();
			return false;
		}

		var denyArr=Array(",","-","/","=","~","|","?","!");
		for(var i=0;i<=denyArr.length;i++){
		//���� �ܾ� ���� ��ũ��Ʈ
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		
		return true;
	}


	function denyText(gubun){
		var obj_Deny=document.getElementById("bbs_deny_word").value;

		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(gubun);
		var obj_DenyArr=obj_Deny.split(",");

		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}

		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk2==obj_DenyArr[i]){
					return "���뿡 "+chk2+"��(��) ����� �� ���� �ܾ��Դϴ�.";
					break;
				}
			}
		}
		return "";
	}
	
	/*
	function popup_zip(frm_name, dir, frm_zip1, frm_zip2, frm_addr1, frm_addr2)
	{
			url = dir+'<?=$skin_board_url?>confirm_zip.php?frm_name='+frm_name+'&frm_zip1='+frm_zip1+'&frm_zip2='+frm_zip2+'&frm_addr1='+frm_addr1+'&frm_addr2='+frm_addr2;
			opt = 'scrollbars=yes,width=500,height=300';
			window.open(url, "mbzip", opt);
	}
	*/
/*
function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
*/
//-->
</SCRIPT>




<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onsubmit="return check()">
<input type=hidden name=act value='ok'>
<input type="hidden" name="bbs_deny_word" id="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<TR>
	<TD bgcolor=#999999 height=2></TD>
</TR>
<TR> 
	<TD>

	
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="35">

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
					<strong><font color="#006699"><img src="" width="3" height="10" alt="" style="background-color: #006699" />&nbsp;
					�Ʒ��� ������û���� �ۼ��� �Ϸ��ư�� Ŭ���Ͻø� ������û�� �����˴ϴ�.</font></strong>
					</td>
					<!--
					<td align="right">
					<a href="javascript:;" onclick="MM_openBrWindow('<?=$skin_board_url?>form_print.html','','scrollbars=yes,width=645,height=650')"><img src="<?=$skin_board_url?>images/btn_print.gif" width="94" height="21" border="0" /></a>
					</td>
					-->
				</tr>
				</table>

				</td>
			</tr>

			<tr>
				<td height="124">

				<table width="100%" border="0" cellpadding="6" cellspacing="1" bgcolor="#D3CEC0">
					<tr>
						<td bgcolor="#FFFFFF">
				
						<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
						<tr>
							<td width="54"  rowspan="9" align="center" bgcolor="#E2DFDA" ><p> <strong><font color="#837867">��û��</font></strong> </p>
							</td>
							<td width="115" align="center" bgcolor="#F2F1EE"  ><p> ���� </p>
							</td>
							<td width="131" bgcolor="#FFFFFF">
							<input name='rg_name' type=text id="rg_name" maxlength=15 required itemname='����' style=height:22; size="15" class=b_input value="<?=$rg_name?>">
							</td>
							<!--------------------�ֹε�Ϲ�ȣ �����ؾ���!------------------------>
							<td align="center" bgcolor="#F2F1EE"  >�������
							</td>
							<td bgcolor="#FFFFFF"><input name="rg_jumin1" type="text" style=height:22; id="rg_jumin1" maxlength="8" size="8" class=b_input />
							 <!--
							  -
							  <input name="rg_jumin2" type="text" style=height:22; id="rg_jumin2" size="8" maxlength="7" class=b_input />
							 -->
							</td>
							<!-------------------------------------------------------------------->
					    </tr>
						<!--
					    <tr>
				
							<td rowspan="2" align="center" bgcolor="#F2F1EE"  ><p> �ּ� </p>
							</td>
							<td colspan="3" bgcolor="#FFFFFF"  ><input type="text" name='rg_post' style=height:22; size="8" maxlength="7" readonly="readonly" class=b_input />
								<img src="<?=$skin_board_url?>images/btn_zip.gif" width="57" height="18" align="absmiddle" onclick="popup_zip('form_write', './', 'rg_post', '', 'rg_address1', 'rg_address2');" style="cursor:hand;" />
							</td>
					    </tr>
						-->
					    <tr>
							<td align="center" bgcolor="#F2F1EE"  ><p> �ּ� </p>
							<td colspan="3" bgcolor="#FFFFFF"  ><!--<input name='rg_address1' type="text" id="rg_address1" style='width:40%' value='<?=$rg_address1?>' readonly="readonly" class=b_input />
							<br>-->
							<input name='rg_address2' type="text" id="rg_address2" value='<?=$rg_address2?>' size="35" class=b_input />
							</td>
					
					    </tr>
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> ��ȭ��ȣ </p>
						</td>
						<td bgcolor="#FFFFFF">
						<input name="rg_tel" type=text id="rg_tel" maxlength="30" style=height:22; size="20" class=b_input />
						</td>
						<td width="96" align="center" bgcolor="#F2F1EE"  >�޴���
						</td>
						<td width="146" bgcolor="#FFFFFF">
						<input name="rg_phone" type=text id="rg_phone" required itemname='�޴���' maxlength="30" style=height:22; size="20" class=b_input />
						</td>
					  </tr>
					  <!--
					  <tr>
						<td align="center" bgcolor="#F2F1EE"><p> �̸��� </p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<input name="rg_email" type=text id="rg_email" maxlength="50" style=height:22; size="40" class=b_input />
						</td>
					  </tr>
					  -->
					 <!--  <tr>
					  						<td height="44" align="center" bgcolor="#F2F1EE"><p> �������� </p>
					  						</td>
					  						<td colspan="3" bgcolor="#FFFFFF">
					  						<font color="#666666">
					  						<input name="rg_level1" type="radio" value="���" />���
					  						<input name="rg_level1" type="radio" value="����" />����
					  						</font>
					  						</td>
					  </tr> -->
					  <tr>
						<td height="70" align="center" bgcolor="#F2F1EE">������ ������<br/>�ڰ���</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="checkbox" name="rg_jakyuk1" value="��ȸ������" />&nbsp;��ȸ������
						  <input type="checkbox" name="rg_jakyuk2" value="��ȣ��" />&nbsp;��ȣ��
						  <input type="checkbox" name="rg_jakyuk3" value="��ȣ������" />&nbsp;��ȣ������<br>
						  <input type="checkbox" name="rg_jakyuk4" value="����ġ���" />&nbsp;����ġ���
						  <input type="checkbox" name="rg_jakyuk5" value="�۾�ġ���" />&nbsp;�۾�ġ��� 
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>�����з�</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="radio" name="rg_school" value="��������" />&nbsp;��������
						  <input type="radio" name="rg_school" value="����" />&nbsp;����
						  <input type="radio" name="rg_school" value="��������" />&nbsp;��������
						  <input type="radio" name="rg_school" value="���б���" />&nbsp;���б���
						  <input type="radio" name="rg_school" value="���п��̻�" />&nbsp;���п��̻� 
						</font>
						</td>
					  </tr>
					  <tr>
						<td height="44" align="center" bgcolor="#F2F1EE"><p>���Ϲ��ī��(����)</p>
						</td>
						<td colspan="3" bgcolor="#FFFFFF">
						<font color="#666666">
						  <input type="radio" name="rg_tommorow" value="���">���
						  <input type="radio" name="rg_tommorow" value="������">������
						</font>
						</td>
					  </tr>
					</table>
					<table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
							<tr>
							  <td></td>
							</tr>
						  </table>
					  <TABLE width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
							<TR>
			
							  <TD width="260" height="37" rowspan="2" align="center" bgcolor="#E2DFDA" align="center"><font color="#837867"><strong>��ȸ ��û ����</strong></font>
							  </TD>
							  <TD width="162" rowspan="2" bgcolor="#FFFFFF">
							  &nbsp;&nbsp;
							  <select name="rg_year">
								<?
								$year = date("Y");
								for($i=$year;$i <= $year+1;$i++){
								?>
									<option value="<?=$i?>"><?=$i?></option>
								<?
								}
								?>
							  </select>
							  ��<br />
								<br>
								&nbsp;&nbsp;
								<select name="rg_month">
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select>                    ��<br>
								&nbsp;&nbsp;
								<select name="rg_day">
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
								</select>                    �� 
								
							  ���� </TD>
			
							  <TD width="196" align="center" bgcolor="#F2F1EE">�����ð�<br>
							  </TD>
							  <td align="center" bgcolor="#F2F1EE">���μ��� �ڰ���</td>
							  
							  <TD width="115" rowspan="2" align="center" bgcolor="#FFFFFF">
							  <input name='rg_title' type=text style=height:22; size="3" maxlength="3" class=b_input id="rg_title" value="<?=$rg_title?>">&nbsp;��
							  </TD>
							</TR>
							<TR>
							  <TD bgcolor="#FFFFFF">
							  <font color="#666666">
								<input type="radio" name="rg_edu_ju" value="�ְ�(����)" />&nbsp;�ְ�(����)<br>
								<!--<input type="radio" name="rg_edu_ju" value="�ְ�(����)" />&nbsp;�ְ�(����)<br>
								<input type="radio" name="rg_edu_ju" value="�ְ�(����)" />&nbsp;�ְ�(����)<br>-->
								<input type="radio" name="rg_edu_ju" value="�߰�" />&nbsp;�߰�<br>
								<input type="radio" name="rg_edu_ju" value="��/��" />&nbsp;��/�� 
							  </font>
							  </TD>
							  <TD width="200"  bgcolor="#FFFFFF">
							  <font color="#666666">
								<input type="radio" name="rg_edu_time" value="�ű�" />&nbsp;�ű�<br>
<!--								<input type="radio" name="rg_edu_time" value="�����" />&nbsp;�����<br>-->
								<input type="radio" name="rg_edu_time" value="��ȸ������" />&nbsp;��ȸ������<br>
								<input type="radio" name="rg_edu_time" value="��ȣ������" />&nbsp;��ȣ������<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����ġ���<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�۾�ġ���<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ȣ��<br/>
							  </font>
							  </TD>
							</TR>
						</TABLE>
					  <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
						<tr>
						  <td></td>
						</tr>
					  </table>
					  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#B5B4A6">
						<tr>
						  <td width="157" height="37" align="center" bgcolor="#E2DFDA"><font color="#837867"><strong>����������</strong></font>
						  </td>
						  <td align="center" bgcolor="#FFFFFF">
						  <textarea name="rg_content" id="rg_content"  rows="10"  cols="65" class="b_textarea"><?=$rg_content?></textarea>
						  </td>
						</tr>
					  </table></td>
				  </tr>
				</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="38"><strong><font color="#996600">�� �¶��� ������û ���ǻ���</font></strong></td>
                </tr>
                <tr>
                  <td height="40"><table width="100%" border="0" cellpadding="6" cellspacing="4" bgcolor="#D3CEC0">
                      <tr>
                        <td bgcolor="#FFFFFF"><!-- Document Start -->
                        <strong> 1. �ڰ��������ڹݸ� �¶��� ��û���� </strong><br>
                            &nbsp;&nbsp; - �ش��ڰ� : ��ȸ������/��ȣ������/����ġ���/�۾�ġ��� <br>
                             &nbsp;&nbsp; <span style="color:red">- ��ȣ�� : ��ȣ����������� �չ�, 50�ð� �̼�,�������� �Ұ�</span> <br /><br>
                             
					    <strong> 2. ��û�� Ȯ�εǸ� �п����� ���� �� ��ȭ�帲</strong><br>
                             &nbsp;&nbsp; - (���� �� �������� ������ ������ ������ �п������� ���ǹٶ�)<br /><br>

							 
					    <strong> 3. ���Ϲ��ī�� ����롯���� üũ�Ͻ� ��</strong><br>
                             &nbsp;&nbsp; - ���Ϲ��ī�� �̹߱��� : www.hrd.go.kr ���ؼ� ī�� ��û ���� <br />
                             &nbsp;&nbsp; - ���Ϲ��ī�� �߱��� : �п����� �������� hrd ����Ʈ �� ��� �� ���� ���� <br />
<br />
* ���Ϲ��ī�� ����� ���� �� �߱� ���� ���Ǵ� ���� ��뼾�ͷ� ���� �ٶ��ϴ�.
							 
							 
                   
                  </td>
                      </tr>
                    </table>
                      <BR>
                  </td>
                </tr>
              </table>
				  <table width="100%" height="5" border="0" cellpadding="0" cellspacing="0">
					  <tr>
						<td></td>
					  </tr>
					</table>
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="center">
						<? 
							session_start();
							if($_SESSION['ss_mb_level'] == 10){
						?>
						<?=$a_list?><IMG src="<?=$skin_board_url?>images/list_view.gif" border=0></a>&nbsp;
						<?
							}
						?>
						<INPUT type=image src="<?=$skin_board_url?>images/btn_ok.gif" width="95" height="44">&nbsp;
						<img src="<?=$skin_board_url?>images/btn_ce.gif" width="95" height="44" onclick="javascript:reset();" style="cursor:hand;">
						</td>
					  </tr>
					</table>
				  <p><br>
						<br>
				  </p></td>
			  </tr>
			</table>

	</TD>
</TR>
</form>
</TABLE>
<br>
<br>