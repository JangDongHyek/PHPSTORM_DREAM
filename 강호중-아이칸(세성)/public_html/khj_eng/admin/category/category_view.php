<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($sea_num && $sung_num && $khan_num){
	$add_query = " and sea_num='$sea_num' and sung_num='$sung_num' and khan_num='$khan_num' and category_degree='$category_degree'";
}
elseif($sea_num && $sung_num && !$khan_num){
	$add_query = " and sea_num='$sea_num' and sung_num='$sung_num' and category_degree='$category_degree'";
}
elseif($sea_num && !$sung_num && !$khan_num){
	$add_query = " and sea_num='$sea_num' and category_degree='$category_degree'";
}


$SQL = "select * from $CategoryTable where mart_id='$mart_id' $add_query";
$dbresult = mysql_query($SQL, $dbconn);
$row = mysql_fetch_array( $dbresult );
$row_count = mysql_num_rows( $dbresult );

if($row_count == 0){
	echo"<script>alert('��ġ�ϴ� ȸ����ȣ�� �����ϴ�.');history.go(-1);</script>";
}

$category_name = $row[category_name];
$category_date = $row[category_date];
$category_desc = $row[category_desc];
$category_img = $row[category_img];
$if_hide = $row[if_hide];
$category_limit_start = $row[category_limit_start];
$category_limit_end = $row[category_limit_end];
$g_id = $row[g_id];
$g_pw = $row[g_pw];
$com_bank_name = $row[com_bank_name];
$com_bank_account = $row[com_bank_account];
$com_bank_master = $row[com_bank_master];
$sea_num = $row[sea_num];
$sung_num = $row[sung_num];
$khan_num = $row[khan_num];
$sea_area = $row[sea_area];
$sung_area = $row[sung_area];
$khan_area = $row[khan_area];
$last_num = $row[last_num];
$category_degree = $row[category_degree];



$gr_name = $row[gr_name];
$gr_address = $row[gr_address];
$gr_zip = $row[gr_zip];
$gr_tel = $row[gr_tel];
$gr_mobile = $row[gr_mobile];
$gr_email = $row[gr_email];
$gr_conum = $row[gr_conum];
$com_bank_name2 = $row[com_bank_name2];
$com_bank_account2 = $row[com_bank_account2];
$com_bank_master2 = $row[com_bank_master2];
$com_bank_name3 = $row[com_bank_name3];
$com_bank_account3 = $row[com_bank_account3];
$com_bank_master3 = $row[com_bank_master3];
$com_bank_name4 = $row[com_bank_name4];
$com_bank_account4 = $row[com_bank_account4];
$com_bank_master4 = $row[com_bank_master4];

$end_date = $row[end_date];

$charge_price = $row[charge_price];
$charge_gigan = $row[charge_gigan];

if(!$charge_price){
	$charge_price = "0";
}
if(!$charge_gigan){
	$charge_gigan = "30";
}





$category_html = htmlspecialchars($row[category_html], ENT_QUOTES);
$category_left = htmlspecialchars($row[category_left], ENT_QUOTES);

$upload = "../../co_img/$mart_id/";
$target = "$upload"."$category_img";
if( $category_img ){
	$cate_target_img = "<img src='$target' border='0' width=100 height=120 align='absmiddle'>";
}else{
	$cate_target_img = "No Image";
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
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�׷� ���� </span> </div></td>
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
<input type="hidden" name="category_img_old" value="<?=$category_img?>">
<input type="hidden" name="prev_category_num" value="<?=$prev_category_num?>">
<input type="hidden" name="categoryimg_updateflag" value="ok">




<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�׷� ���� </b></td>
				</tr>
			</table>

			<!--���� START~~--><br>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function view_image(input)
	{
		var oImg = document.getElementById("upImage");
		oImg.src = input.value;
		oImg.style.display = "";
	}
//-->
</SCRIPT>


<?
if($_SESSION["MemberLevel"] != 10){
	$readonly = "readonly";
	$selectbox_readonly = "readonly style='background-color:#ababab' onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'";
}
?>


			<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white"  align="center">
      			<tr>
        			<td width="90%" bgcolor="#999999">
        				<table border="0" width="100%" cellspacing="1" cellpadding="3">
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								ȸ����ȣ 
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" name="category_limit_start" value='<?=$category_limit_start?>' size="10" <?=$readonly?>> ~ <input class="aa" name="category_limit_end" value='<?=$category_limit_end?>' size="10" <?=$readonly?>>			
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								������ȣ
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<?
								if($category_degree==0){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=4 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
								<?
								}elseif($category_degree==1){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="4" maxlength=3 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
									-
									<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6" readonly>
									<?}?>
								<?
								}elseif($category_degree==2){
								?>
									<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="4" maxlength=3 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sea_area" value='<?=$sea_area?>' size="6" readonly>
									<?}?>
									-
									<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="sung_area" value='<?=$sung_area?>' size="6"  readonly>
									<?}?>
									-
									<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2 readonly>
									<?if($_SESSION["MemberLevel"] == 10){?>
									<input class="aa" type="text" name="khan_area" value='<?=$khan_area?>' size="6"  readonly>
									<input class="aa" type="text" name="last_num" value='<?=$last_num?>' size="3" maxlength=2>

									<?}?>
								<?
								}
								?>
							</td>
          				</tr>



						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								�׷��� ���̵� 
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<b><?=$g_id?></b>
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								�׷��� ��й�ȣ
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" type="text" name="g_pw" value='<?=$g_pw?>' size="10">			
            				</td>
          				</tr>





          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								�̸�
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
            					<input class="aa" type="text" name="gr_name" value='<?=$gr_name?>' size="20" <?=$readonly?>>		
							</td>

          				</tr>


          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								�ּ�
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
            					<input class="aa" type="text" name="gr_address" value='<?=$gr_address?>' size="50" <?=$readonly?>>
								<?$addr = str_replace("�λ�� ����","�λ�� �λ�����",$gr_address);?>
								<font style='cursor:hand;' onclick="window.open('../../market/board_mem/map.php?address_pop=<?=$addr?>','','width=820,height=560,top=100,left=100,scrollbars=no')">[��ġȮ��]</font>	
							</td>

          				</tr>
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								��ȭ��ȣ
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
							<?
							$gr_tel_ex = explode("-",$gr_tel);
							?>
								  <select name="tel1" class=input_03>
                                    <option value='' <?if($gr_tel_ex[0] == ''){echo"selected";}?>>����</option>
                                    <option value='02' <?if($gr_tel_ex[0] == '02'){echo"selected";}?>>02</option>
                                    <option value='031' <?if($gr_tel_ex[0] == '031'){echo"selected";}?>>031</option>
                                    <option value='032' <?if($gr_tel_ex[0] == '032'){echo"selected";}?>>032</option>
                                    <option value='033' <?if($gr_tel_ex[0] == '033'){echo"selected";}?>>033</option>
                                    <option value='041' <?if($gr_tel_ex[0] == '041'){echo"selected";}?>>041</option>
                                    <option value='042' <?if($gr_tel_ex[0] == '042'){echo"selected";}?>>042</option>
                                    <option value='043' <?if($gr_tel_ex[0] == '043'){echo"selected";}?>>043</option>
                                    <option value='051' <?if($gr_tel_ex[0] == '051'){echo"selected";}?>>051</option>
                                    <option value='052' <?if($gr_tel_ex[0] == '052'){echo"selected";}?>>052</option>
                                    <option value='053' <?if($gr_tel_ex[0] == '053'){echo"selected";}?>>053</option>
                                    <option value='054' <?if($gr_tel_ex[0] == '054'){echo"selected";}?>>054</option>
                                    <option value='055' <?if($gr_tel_ex[0] == '055'){echo"selected";}?>>055</option>
                                    <option value='061' <?if($gr_tel_ex[0] == '061'){echo"selected";}?>>061</option>
                                    <option value='062' <?if($gr_tel_ex[0] == '062'){echo"selected";}?>>062</option>
                                    <option value='063' <?if($gr_tel_ex[0] == '063'){echo"selected";}?>>063</option>
                                    <option value='064' <?if($gr_tel_ex[0] == '064'){echo"selected";}?>>064</option>
                                    <option value='0502' <?if($gr_tel_ex[0] == '0502'){echo"selected";}?>>0502</option>
                                    <option value='0503' <?if($gr_tel_ex[0] == '0503'){echo"selected";}?>>0503</option>
                                    <option value='0504' <?if($gr_tel_ex[0] == '0504'){echo"selected";}?>>0504</option>
                                    <option value='0505' <?if($gr_tel_ex[0] == '0505'){echo"selected";}?>>0505</option>
                                    <option value='0506' <?if($gr_tel_ex[0] == '0506'){echo"selected";}?>>0506</option>
                                    <option value='0507' <?if($gr_tel_ex[0] == '0507'){echo"selected";}?>>0507</option>
                                    <option value='070' <?if($gr_tel_ex[0] == '070'){echo"selected";}?>>070</option>
                                 </select>
                                   -
                                    <input type=text class=input_03 name='tel2' size=5 maxlength=4 value='<?=$gr_tel_ex[1]?>'>
                                   -
                                    <input type=text class=input_03 name='tel3' size=5 maxlength=4 value='<?=$gr_tel_ex[2]?>'>
								</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								�޴���
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
							<?
							$gr_mobile_ex = explode("-",$gr_mobile);
							?>
									  <select name="mobile1" class=input_03>
										<option value='' <?if($gr_mobile_ex[0] == ''){echo"selected";}?>>����</option>
										<option value='010' <?if($gr_mobile_ex[0] == '010'){echo"selected";}?>>010</option>
										<option value='011' <?if($gr_mobile_ex[0] == '011'){echo"selected";}?>>011</option>
										<option value='016' <?if($gr_mobile_ex[0] == '016'){echo"selected";}?>>016</option>
										<option value='017' <?if($gr_mobile_ex[0] == '017'){echo"selected";}?>>017</option>
										<option value='018' <?if($gr_mobile_ex[0] == '018'){echo"selected";}?>>018</option>
										<option value='019' <?if($gr_mobile_ex[0] == '019'){echo"selected";}?>>019</option>
									  </select>
									   -
										<input type=text class=input_03 name='mobile2' size=5 maxlength=4 value='<?=$gr_mobile_ex[1]?>'>
									   -
										<input type=text class=input_03 name='mobile3' size=5 maxlength=4 value='<?=$gr_mobile_ex[2]?>'>
            				</td>
          				</tr>
          				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								�̸���
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
            					<input class="aa" type="text" name="gr_email" value='<?=$gr_email?>' size="50" <?=$readonly?>>	
							</td>
            				<td width="10%" bgcolor="#C8DFEC"  align="center">
								����ڹ�ȣ
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left">
            					<input class="aa" type="text" name="gr_conum" value='<?=$gr_conum?>' size="15" <?=$readonly?>>					
            				</td>
          				</tr>
   


          				<tr>
            				<td bgcolor="#C8DFEC" align="center">����÷��</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;<?=$cate_target_img?> <input type='file' size='30' maxlength='100' name='categoryimg' class="input_03" onChange="view_image(this);"><img src='' id="upImage" style="display:none;">
							<input type="checkbox" name="del_big" value="y">����
							</td>
          				</tr>  

<?
/*
?>

            				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 ĭ�����۱ݰ���1
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
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
								���¹�ȣ:<input name="com_bank_account" class='input' value="<?=$com_bank_account?>" size="44" <?=$readonly?>>
								������:<input name="com_bank_master" class='input' value="<?=$com_bank_master?>" size="10" <?=$readonly?>>
								</td>
								</tr>

						
	            				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 ĭ�����۱ݰ���2
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name2' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name2 == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($com_bank_name2 == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($com_bank_name2 == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($com_bank_name2 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($com_bank_name2 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($com_bank_name2 == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($com_bank_name2 == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($com_bank_name2 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($com_bank_name2 == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($com_bank_name2 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($com_bank_name2 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($com_bank_name2 == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($com_bank_name2 == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($com_bank_name2 == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($com_bank_name2 == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($com_bank_name2 == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name2 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($com_bank_name2 == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($com_bank_name2 == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($com_bank_name2 == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="com_bank_account2" class='input' value="<?=$com_bank_account2?>" size="44" <?=$readonly?>>
								������:<input name="com_bank_master2" class='input' value="<?=$com_bank_master2?>" size="10" <?=$readonly?>>
								</td>
								</tr>
					



    				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 ĭ�����۱ݰ���3
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name3' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name3 == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($com_bank_name3 == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($com_bank_name3 == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($com_bank_name3 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($com_bank_name3 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($com_bank_name3 == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($com_bank_name3 == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($com_bank_name3 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($com_bank_name3 == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($com_bank_name3 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($com_bank_name3 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($com_bank_name3 == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($com_bank_name3 == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($com_bank_name3 == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($com_bank_name3 == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($com_bank_name3 == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name3 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($com_bank_name3 == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($com_bank_name3 == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($com_bank_name3 == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="com_bank_account3" class='input' value="<?=$com_bank_account3?>" size="44" <?=$readonly?>>
								������:<input name="com_bank_master3" class='input' value="<?=$com_bank_master3?>" size="10" <?=$readonly?>>
								</td>
								</tr>
					
<?
*/
?>

    				<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								���ݰ���
            				</td>
            				<td width="40%" bgcolor="#FFFFFF" align="left" colspan=3>
<?
								echo ("				
								<select name='com_bank_name4' tabIndex='5' selectedindex='0' size='1' $selectbox_readonly>
								<option value=''
								");
								if($com_bank_name4 == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($com_bank_name4 == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($com_bank_name4 == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($com_bank_name4 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($com_bank_name4 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($com_bank_name4 == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($com_bank_name4 == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($com_bank_name4 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($com_bank_name4 == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($com_bank_name4 == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($com_bank_name4 == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($com_bank_name4 == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($com_bank_name4 == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($com_bank_name4 == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($com_bank_name4 == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($com_bank_name4 == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($com_bank_name4 == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($com_bank_name4 == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($com_bank_name4 == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($com_bank_name4 == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="com_bank_account4" class='input' value="<?=$com_bank_account4?>" size="44" <?=$readonly?>>
								������:<input name="com_bank_master4" class='input' value="<?=$com_bank_master4?>" size="10" <?=$readonly?>>
								</td>
								</tr>
						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 ����Ⱓ
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='end_date' type=text size=15 class=b_input id="end_date"  value='<?=$end_date?>' title="YYYY-MM-DD" readonly required='required' itemname='����Ⱓ'  onclick="displayCalendarFor('end_date');">�ϱ���
							</td>
						</tr>

						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 �����ݾ׼���
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='charge_price' type=text size=15 class=b_input id="charge_price"  value='<?=$charge_price?>' required='required' itemname='�����ݾ׼���'>��
							</td>
						</tr>

						<tr>
            				<td width="10%" bgcolor="#C8DFEC" align="center">
								 ȸ���Ⱓ����
            				</td>
            				<td width="90%" bgcolor="#FFFFFF" align="left" colspan=3>
								<input name='charge_gigan' type=text size=15 class=b_input id="charge_gigan"  value='<?=$charge_gigan?>' required='required' itemname='ȸ���Ⱓ����'>��
							</td>
							</td>
						</tr>

						<!--
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�׷� �̹���</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;<?=$cate_target_img?> <input type='file' size='30' maxlength='100' name='categoryimg' class="input_03" onChange="view_image(this);"><img src='' id="upImage" style="display:none;"></td>
          				</tr>          				
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�׷� ����Ʈ ���</td>
							<td bgcolor="#FFFFFF" colspan='3'>								
								<textarea name="category_left" id="category_left"><?=$category_left?></textarea>	
 <script>
		var ed = new easyEditor("category_left"); //�ʱ�ȭ id�Ӽ���
		ed.init(); //�������� ����
</script>	
							</td>
          				</tr>
          				<tr>
							<td width="20%" bgcolor="#C8DFEC" align="center"><span class="aa">�����������</span></td>
							<td width="80%" bgcolor="#FFFFFF" colspan="3">
							&nbsp;&nbsp;&nbsp;&nbsp; 
							<input class="aa" type="radio" value="0" name="if_hide" <?if($if_hide == '0') echo "checked";?>> ������ �����
							<input class="aa" type="radio" value="1" name="if_hide" <?if($if_hide == '1') echo "checked";?>>������ ����������� <br>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							(����� ������, ������ ��µ����� �ʽ��ϴ�)
						</td>
              		</tr>
					-->
        				</table>
        			</td>
      			</tr>
   		   </table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
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