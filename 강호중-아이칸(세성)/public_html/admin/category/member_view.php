<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($sea_num && $sung_num && $khan_num && $sudong_num){
	$add_query = " and sea_num='$sea_num' and sung_num='$sung_num' and khan_num='$khan_num' and sudong_num='$sudong_num' ";
}else{
	echo"<script>alert('ȸ����ȣ�� ��� �Է����� �����̽��ϴ�');history.go(-1);</script>";
}


$SQL = "select * from $ItemTable where mart_id='$mart_id' $add_query";



$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);

	$provider_id = $ary[provider_id];
	$category_num = $ary[category_num];
	$sea_num = $ary[sea_num];
	$sung_num = $ary[sung_num];
	$khan_num = $ary[khan_num];
	$sea_area = $ary[sea_area];
	$sung_area = $ary[sung_area];
	$khan_area = $ary[khan_area];
	$sudong_num = $ary[sudong_num];
	$item_name = $ary[item_name];

	$start_date = $ary[start_date];
	$end_date = $ary[end_date];

	$jumin1 = $ary[jumin1];
	$jumin2 = $ary[jumin2];
	$sex = $ary[sex];
	$co_name = $ary[co_name];
	$co_num = $ary[co_num];



	$tel = $ary[tel];
	$address2 = $ary[address2];
	$zip = $ary[zip];
	$g_margin = $ary[g_margin];
	$bonus = $ary[bonus];
	$use_bonus = $ary[use_bonus];
	$address = $ary[address];
	$img = $ary[img];
	$img_big = $ary[img_big];
	$img_big2 = $ary[img_big2];
	$img_big3 = $ary[img_big3];
	$img_big4 = $ary[img_big4];
	$img_big5 = $ary[img_big5];
	$opt = $ary[opt];
	$doctype = $ary[doctype];
	$item_explain = htmlspecialchars($ary[item_explain], ENT_QUOTES);
	$short_explain = $ary[short_explain];
	$reg_date = $ary[reg_date];
	$item_code = $ary[item_code];
	$item_id = $ary[item_id];
	$item_pw = $ary[item_pw];
	$mobile = $ary[mobile];
	$email = $ary[email];
	$if_strike = $ary[if_strike];
	$if_provide_item = $ary[if_provide_item];
	$provide_price = $ary[provide_price];
	$img_sml = $ary[img_sml];
	$flash_big_width = $ary[flash_big_width];
	$flash_big_height = $ary[flash_big_height];
	$img_high = $ary[img_high];
	$if_cash = $ary[if_cash];
	$fee = $ary[fee];
	$thumbnail = $ary[thumbnail];
	$job = $ary[job];
	$hobby = $ary[hobby];
	$com_bank_name = $ary[com_bank_name];
	$com_bank_account = $ary[com_bank_account];
	$my_bank_name = $ary[my_bank_name];
	$my_bank_account = $ary[my_bank_account];
	$com_bank_master = $ary[com_bank_master];
	$my_bank_master = $ary[my_bank_master];
}else{
	echo"<script>alert('��ġ�ϴ� ȸ����ȣ�� �����ϴ�.');history.go(-1);</script>";
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){


	var category_left = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
	if(category_left=="")
	{
			alert("������ �����ּ���!");
			ed.focus();
			return false;
	}

	return true;
}
</script>
<script src="../../editor/easyEditor.js"></script>

</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<?  include '../inc/menu2.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="310"></td>
        <td valign="top" ><div align="right">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span><span class="text_gray2_c">ȸ�������˻� </span> </div></td>
            </tr>
            <tr>
              <td height="28">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<form action='category_modify.php?category_num=<?=$category_num?>' name="up" method="post" onSubmit="return checkform(this)" enctype="multipart/form-data">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="category_img" value="<?=$category_img?>">
<input type="hidden" name="prev_category_num" value="<?=$prev_category_num?>">

<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>ȸ�������˻� ��� </b></td>
				</tr>
			</table>








			<!--���� START~~-->   	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>


      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
               			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������ȣ
							</td>
                			<td width="35%" bgcolor="#FFFFFF" colspan=4>
								<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="4" maxlength=3 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
								<?}?>
								<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6" readonly>
								<?}?>
								<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2 readonly>
								<?if($_SESSION["MemberLevel"] == 10){?>
								<input class="aa" type="text" name="khan_area" value='<?=$khan_area?>' size="6" readonly>
								<?}?>
							    <input class="aa" type="text" name="sudong_num" value='<?=$sudong_num?>' size="5" maxlength=4 readonly>
							</td>

              			</tr>
						<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				����
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_name" value="<?=$item_name?>" size="14">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				ȸ����ȣ
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_code" value="<?=$item_code?>" size="16"> 
							</td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				���̵�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_id" value="<?=$item_id?>" size="14">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				��й�ȣ
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_pw" size="10" <?if($_SESSION["MemberLevel"] == 10){?> value="<?=$item_pw?>" <?}?>>
							</td>
              			</tr>
						<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ֹι�ȣ 
							</td>
			                <td bgColor="#ffffff">
								<input name="jumin1" class='input' value="<?=$jumin1?>" size="7" maxlength=6>-<input name="jumin2"  value="<?=$jumin2?>" class='input' size="8" maxlength=7>
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								����
							</td>
			                <td bgColor="#ffffff">
								<input type=radio name="sex" value="��" <?if($sex=="��"){echo"checked";}?>>�� <input type=radio name="sex" value="��" <?if($sex=="��"){echo"checked";}?>>��
							</td>
			              </tr>
						<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�������� 
							</td>
			                <td bgColor="#ffffff">
								<input name="co_name" class='input' value="<?=$co_name?>" size="24">
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								����ڹ�ȣ
							</td>
			                <td bgColor="#ffffff">
								<input name="co_num" class='input' value="<?=$co_num?>" size="24">
							</td>
			              </tr>						  
              			<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								��ȭ 
							</td>
			                <td bgColor="#ffffff">
								<input name="tel" class='input' value="<?=$tel?>" size="24">
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								�ڵ���
							</td>
			                <td bgColor="#ffffff">
								<input name="mobile" class='input' value="<?=$mobile?>" size="24">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�̸���
							</td>
			                <td bgColor="#ffffff">
								<input name="email" class='input' value="<?=$email?>" size="34">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								��û��ǰ
							</td>
			                <td bgColor="#ffffff">
								<input name="g_margin" class='input' value="<?=$g_margin?>" size="34">
							</td>
			              </tr>
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ּ�
							</td>
			                <td bgColor="#ffffff">
								<input name="address" class='input' value="<?=$address?>" size="28">
								<?$addr = str_replace("�λ�� ����","�λ�� �λ�����",$address);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[��ġȮ��]</font>	
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								�����ȣ
							</td>
			                <td bgColor="#ffffff">
								<input name="zip" class='input' value="<?=$zip?>" size="34">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ּ�2
							</td>
			                <td bgColor="#ffffff">
								<input name="address2" class='input' value="<?=$address2?>" size="28">
								<?$addr = str_replace("�λ�� ����","�λ�� �λ�����",$address2);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[��ġȮ��]</font>	
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								ĭī��
							</td>
			                <td bgColor="#ffffff">
								<?
								if($img_big != '' && file_exists("$Co_img_UP$mart_id/$img_big")){
									if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
												echo "
									<img src='../..$Co_img_DOWN$mart_id/$img_big' width='120'>
										";
									}
									if (strstr(strtolower(substr($img_big,-4)),'.swf')){
												echo "
									<embed src='../..$Co_img_DOWN$mart_id/$img_big' width='120'></embed>
										";
									}
								?>
								<input type="checkbox" name="del_big" value="y">����
								<?
								}
								?>
								<input type="file" name="img_big" class='input' size="30">
							</td>
			              </tr>
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								����
							</td>
			                <td bgColor="#ffffff">
								<input name="job" class='input' value="<?=$job?>" size="34">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								���
							</td>
			                <td bgColor="#ffffff">
								<input name="hobby" class='input' value="<?=$hobby?>" size="34">
							</td>
			              </tr>
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								ȸ�����
							</td>
			                <td bgColor="#ffffff" colSpan="4">
								<?
								echo ("				
								<select name='com_bank_name' tabIndex='5' selectedindex='0' size='1'>
								<option value=''
								");
								if($com_bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($com_bank_name == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($com_bank_name == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($com_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($com_bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($com_bank_name == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($com_bank_name == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($com_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($com_bank_name == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($com_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($com_bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($com_bank_name == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($com_bank_name == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($com_bank_name == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($com_bank_name == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($com_bank_name == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($com_bank_name == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($com_bank_name == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($com_bank_name == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="com_bank_account" class='input' value="<?=$com_bank_account?>" size="44">
								������:<input name="com_bank_master" class='input' value="<?=$com_bank_master?>" size="10">
							</td>
							</tr>
							<tr>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								���ΰ���
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<?
								echo ("				
								<select name='my_bank_name' tabIndex='5' selectedindex='0' size='1'>
								<option value=''
								");
								if($my_bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($my_bank_name == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($my_bank_name == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($my_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($my_bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($my_bank_name == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($my_bank_name == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($my_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($my_bank_name == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($my_bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($my_bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($my_bank_name == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($my_bank_name == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($my_bank_name == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($my_bank_name == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($my_bank_name == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($my_bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($my_bank_name == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($my_bank_name == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($my_bank_name == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="my_bank_account" class='input' value="<?=$my_bank_account?>" size="44">	
								������:<input name="my_bank_master" class='input' value="<?=$my_bank_master?>" size="10">
								</td>
			              </tr>
						  
						  <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								ȸ���Ⱓ
							</td>
			                <td bgColor="#ffffff" colspan=4>
								<input name="start_date" class='input' value="<?=$start_date?>" size="15"> ~ <input name="end_date" class='input' value="<?=$end_date?>" size="15">
							</td>			               
			              </tr>
</table>
<table border="0" width="100%" cellpadding=1 cellspacing=1>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				�� ��
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<textarea name="short_explain" rows='3' cols='108'><?=$short_explain?></textarea>
                			</td>
              			</tr>
		

              			<tr>
                		
              			<tr>
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">�����</td>
                			<td width="53%" bgcolor="#FFFFFF" colspan="3"><?=$reg_date?></td>
              			</tr>
              			
            			</table>
            		</td>
          		</tr>
        		</table>
        		</center></div>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>

						<input class="aa" onClick="javascript:history.go(-1);" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�ڷΰ���">

        	</td>
      	</tr>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--���� END~~-->













		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>