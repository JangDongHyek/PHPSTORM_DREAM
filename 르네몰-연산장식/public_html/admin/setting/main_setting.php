<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$ary = mysql_fetch_array($dbresult);
	$shopname = $ary["shopname"];
	$name = $ary["name"];
	$passport = $ary["passport"];
	$tel1 = $ary["tel1"];
	$tel2 = $ary["tel2"];
	$email = $ary["email"];
	$place = $ary["place"];
}

$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	$ary = mysql_fetch_array($dbresult);
	$shop_logo = $ary[logo];
	$shopuser = $ary[shopuser];
	$bonus_ok = $ary[bonus_ok];
	$init_bonus = $ary[init_bonus];
	$welcome = $ary[welcome];
	$copyright = htmlspecialchars($ary[copyright], ENT_QUOTES);
	$card_yes = $ary[card_yes];
	$card_url = $ary[card_url];
	$freight_date = $ary[freight_date];
	$freight_limit = $ary[freight_limit];
	$freight_cost = $ary[freight_cost];
	$shopback_limit = $ary[shopback_limit];
	$shopback_cost = $ary[shopback_cost];
	$union_freight_limit = $ary[union_freight_limit];
	$union_freight_cost = $ary[union_freight_cost];
	$pur_limit = $ary[pur_limit];
	$card_limit = $ary[card_limit];
	$event_width = $ary[event_width];
	$event_height = $ary[event_height];
	$width = $ary[width];
	$titlecolor = $ary[titlecolor];
	$titletxtcolor = $ary[titletxtcolor];
	$listcolor = $ary[listcolor];
	$listtxtcolor = $ary[listtxtcolor];
	$color = $ary[color];
	$user_words = $ary[user_words];
	$if_union = $ary[if_union];
	$intro = $ary[intro];
	$if_notice = $ary[if_notice];
	$if_chuchon = $ary[if_chuchon];
	$if_event = $ary[if_event];
	$if_coupon = $ary[if_coupon];
	$if_receipt = $ary[if_receipt];
	$if_community = $ary[if_community];
	$page_title = $ary[page_title];
	$member_confirm = $ary[member_confirm];
	$if_poll = $ary[if_poll];
	$if_quiz = $ary[if_quiz];
	$account_yes = $ary[account_yes];
	$bonus_limit = $ary[bonus_limit];
	//$if_gnt_item = $ary[if_gnt_item];
	$if_mem_use_pass = $ary[if_mem_use_pass];
	$if_nomem_use_pass = $ary[if_nomem_use_pass];
	$if_use_bottom_img = $ary[if_use_bottom_img];
	$if_member_price = $ary[if_member_price];
	$member_price_percent = $ary[member_price_percent];
	$if_customer_price = $ary[if_customer_price];

	if( $shop_logo ){
		$upload = "../../up/$mart_id/";
		$target = "$upload"."$shop_logo";
		//==================== �̹��� ����� ���� ==========================================
		$img_size = @GetImageSize("$target"); 
		$img_width = $img_size[0]; //�̹����� ���̸� �� �� ���� 
		$img_height = $img_size[1]; //�̹����� ���̸� �� �� ����
	}
}
?>
<?
include "../admin_head.php";
?>

<script>
function frm_val(f){
	if(f.name.value==""){
		alert("������ �Է��ϼ���");
		f.name.focus();
		return false;
	}
	if(f.shopname.value==""){
		alert("���θ��̸��� �Է��ϼ���");
		f.shopname.focus();
		return false;
	}
	if(f.email.value==""){
		alert("�̸����ּҸ� �Է��ϼ���");
		f.email.focus();
		return false;
	}
	if(f.tel1.value==""){
		alert("��ȭ��ȣ�� �Է��ϼ���");
		f.tel1.focus();
		return false;
	}
	if(f.place.value==""){
		alert("�ּҸ� �Է��ϼ���");
		f.place.focus();
		return false;
	}
	/*if(f.if_member_price.checked){
		if(f.member_price_percent.value==""){
			alert("�ۼ�Ʈ�� �Է��ϼ���");
			f.member_price_percent.focus();
			return false;
		}	
	}*/
	if(f.pur_limit.value==""){
		alert("�ּ� ���ž��� �Է��ϼ���");
		f.pur_limit.focus();
		return false;
	}
	if(f.card_limit.value==""){
		alert("�ּ� ī��������� �Է��ϼ���");
		f.card_limit.focus();
		return false;
	}
	if(f.init_bonus.value==""){
		alert("ȸ�����Խ� ����Ʈ�� �Է��ϼ���");
		f.init_bonus.focus();
		return false;
	}

	// #####################################################################
	// ###  Ȩ�������ּ�,��Ʈ��ȣ,�̹������ε�,���,�뷮,���ε�������  ###
	// ###  ����Ǵ� �̹����� ���� �κ�									 ###
	// #####################################################################
	/*var base = document.f;
	if (base.copyright_txt.UploadLocalImg("<?=$urlx?>", <?=$port?>, "<?=$upload_php?>", "<?=$upload?>", 0, "<?=$homeup_url?>") < 0){
		alert(base.copyright_txt.UploadImgError);
		return false;
	}
	base.copyright.value = base.copyright_txt.Body;*/
	//=======================================================================

	return true;
	
}
function find_zip(){
			var Sel = window.open ( 'find_zip_etrans.php', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}	
</script>
<script language="JavaScript">
<!--

/*function exp(f) {
	if (f.if_member_price.checked) {
		member_price_table.style.display="block";
	}
	else {
		member_price_table.style.display="none";
	}
}*/
//-->
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>���θ��⺻����</b></td>
			</table>

			<!--���� START~~--><br>

<form name='f' method='post' onsubmit="return frm_val(this)" action='regist.php' enctype="multipart/form-data">
<input type="hidden" name="flag" value="update" >
<input type='hidden' name='shop_logo' value='<?=$shop_logo?>'>

		<table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">����</td>
						<td width="25%">
							<input name="name" size="30" value='<?echo $name?>' class="input_03"></td>
						<td width="25%">���θ��̸�</td>
						<td width="25%">
							<input name="shopname" size="30" value='<?echo $shopname?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">���θ� �ΰ�</td>
						<td colspan='3'>
						<input type='file' size='30' maxlength='100' name='shoplogo' class="input_03"> (������ ��� �ΰ�. 200 X 60)<br>
<?
if( $shop_logo ){
	if( $img_width > 500 ){
?>
						<�̸�����><br><img src='<?=$target?>' width='500'>
<?
	}else{
?>
						<�̸�����><br><img src='<?=$target?>'>
<?
	}
}else{
}
?>
					</td>
					</tr>
					<tr>
						<td width="25%">������ Ÿ��Ʋ</td>
						<td colspan='3'>
						<input name="page_title" size="70" value='<?=$page_title?>' class="input_03">
					</td>
					</tr>
					<tr>
						<td width="25%">�̸���</td>
						<td width="25%">
							<input name="email" size="30" value='<?echo $email?>' class="input_03"></td>
						<td width="25%">����ڵ�Ϲ�ȣ</td>
						<td width="25%">
							<input name="passport" size="30" value='<?echo $passport?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">��ȭ��ȣ</td>
						<td width="25%">
							<input name="tel1" size="30" value='<?echo $tel1?>' class="input_03"></td>
						<td width="25%">�ѽ���ȣ</td>
						<td width="25%">
							<input name="tel2" size="30" value='<?echo $tel2?>' class="input_03"></td>
					</tr>
					<tr>
						<td width="25%">�ּ�</td>
						<td width="75%" colspan='3'>
							<input name="place" size="70" value='<?echo $place?>' class="input_03"></td>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">�ù�� ����</td>
						<td width="75%">
							<input name="freight_limit" size="20" value='<?echo $freight_limit?>' class="input_03"> 
							���̸�&nbsp; �ù�� 
							<input name="freight_cost" size="20" value='<?echo $freight_cost?>' class="input_03"> 
							��</td>
					</tr>
					<tr>
						<td width="25%">�ù�� ����(���ι�)</td>
						<td width="75%">
							<input name="shopback_limit" size="20" value='<?echo $shopback_limit?>' class="input_03"> 
							���̸�&nbsp; �ù�� 
							<input name="shopback_cost" size="20" value='<?echo $shopback_cost?>' class="input_03"> 
							��</td>
					</tr>
					<!-- <tr>
						<td width="25%">�������� �ù�� ����</td>
						<td width="75%">
							<input name="union_freight_limit" size="20" value='<?echo $union_freight_limit?>' class="input_03"> 
							���̸�&nbsp; �ù�� 
							<input name="union_freight_cost" size="20" value='<?echo $union_freight_cost?>' class="input_03"> 
							��</td>
					</tr> -->
					<!-- <tr>
						<td width="25%">ȸ���� ��뿩��</td>
						<td width="75%">
						<input type='checkbox' name='if_member_price' onclick="exp(this.form)" value='1'
						<?
						if($if_member_price == '1') echo " checked";
						?>
						>ȸ���� ��� 
						
						<div id='member_price_table' style='display:none'>
						<table width='80%' border='0'>
						  <tr>
							<td>
							<span>��ü��ǰ�� ��ȸ������ <input name='member_price_percent' size='3' value='<?echo $member_price_percent?>' style='BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid'> %�� å���մϴ�. 
							</td>
						  </tr>
						</table>
						</div>
						</td>
					</tr> -->
					<tr>
						<td width="25%">�Һ��ڰ� ��뿩��</td>
						<td width="75%">
						<input type='checkbox' name='if_customer_price' value='1'
						<?
						if($if_customer_price == '1') echo " checked";
						?>
						>�Һ��ڰ� ��� 
						</td>
					</tr>
					<tr>
						<td>��������</td>
						<td><span class="bb">
							<input type='checkbox' checked disabled>�������Ա�
							<input name='account_yes' type='checkbox' value='t'
							<?
							if($account_yes == 't') echo " checked";
							?>
							>������ü
							<input name='card_yes' type='checkbox' value='t'
							<?
							if($card_yes == 't') echo " checked";
							?>
							>�ſ�ī��
							
						</td>
					</tr>
					<tr>
						<td>ȸ����å</td>
						<td><span class="bb">
							<select name="shopuser" size="1" style="height: 18px; border: 1px solid black">
							<option value="0"<?if($shopuser=='0') echo " selected"?>>ȸ���� ��ȸ������ �Բ� �</option>
							<option value="1"<?if($shopuser=='1') echo " selected"?>>ȸ���� ��ȸ������ �Բ� �(���θ�)</option>
							<option value="2"<?if($shopuser=='2') echo " selected"?>>ȸ���� ���Ű���</option>
							<option value="3"<?if($shopuser=='3') echo " selected"?>>ȸ���� �������԰���(B2B)</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>ȸ������ ó�����</td>
						<td>
							<input name="member_confirm" type="radio" value="0"<?if($member_confirm==0) echo " checked"?>>��û ��� ����
							&nbsp; 
							<input name="member_confirm" type="radio" value="1"<?if($member_confirm==1) echo " checked"?>>������ ������ ����
						</td>
					</tr>
					<tr>
						<td>�ּ� ���ž�</td>
						<td>
							<input name="pur_limit" size="20" value='<?echo $pur_limit?>' class="input_03"> 
							�� (��: 10,000���̸��� �ֹ������� �ȵ˴ϴ�)
						</td>
					</tr>
					<tr>
						<td>�ּ� ī�������</td>
						<td>
							<input name="card_limit" size="20" value='<?echo $card_limit?>' class="input_03"> 
							�� (��: 10,000���̸��� ī������� �ȵ˴ϴ�)
						</td>
					</tr>
					<tr>
						<td>����Ʈ �̿뿩��</td>
						<td>
							<input name="bonus_ok" type="radio" value="t"<?if($bonus_ok=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="bonus_ok" type="radio" value="f"<?if($bonus_ok=='f') echo " checked"?>>No
						</td>
					</tr>
					<tr>
						<td>�ּ� ����Ʈ ������</td>
						<td>
							<input name="bonus_limit" size="20" value='<?echo $bonus_limit?>' class="input_03"> 
							�� (��: ����Ʈ�� 10,000�� �̻��� ��쿡�� ����ó�� ��밡���մϴ�.)</td>
					</tr>
					<tr>
						<td width="25%">ȸ�����Խ� ����Ʈ</td>
						<td width="75%">
							<input name="init_bonus" size="20" value='<?echo $init_bonus?>' class="input_03"> 
						</td>
					</tr>
					<tr>
						<td>��ǰ�ı���</td>
						<td>
							<input name="user_words" type="radio" value="t"<?if($user_words=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="user_words" type="radio" value="f"<?if($user_words=='f') echo " checked"?>>No
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			  <td width="100%" bgcolor="#6084D5" height="1"></td>
			</tr>

			<tr>
			  <td width="100%" bgcolor="#FFFFFF">
			  
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				 <tr>
					<td width="100%" colspan="2">�ֹ����ۼ��� �ֹε�Ϲ�ȣ �׸� 
					����</td>
				 </tr>
				 <tr>
					<td width="22%"></td>
					<td width="78%"></td>
				 </tr>
				 <tr>
					<td width="22%">ȸ��</td>
					<td width="78%">
					<select tabIndex="5" size="1" name="if_mem_use_pass">
					  <option value="1"
					  <?
					  if($if_mem_use_pass == '1') echo " selected";
					  ?>
					  >�ֹι�ȣ �׸� ���</option>
					  <option value="0"
					  <?
					  if($if_mem_use_pass == '0') echo " selected";
					  ?>
					  >�ֹι�ȣ �׸� ������� ����</option>
					</select></td>
				 </tr>
				 <tr>
					<td>��ȸ��</td>
					<td>
						<select tabIndex="5" size="1" name="if_nomem_use_pass">
						<option value="1"
						<?
						if($if_nomem_use_pass == '1') echo " selected";
						?>
						>�ֹι�ȣ �׸� ���</option>
						<option value="0"
						<?
						if($if_nomem_use_pass == '0') echo " selected";
						?>
						>�ֹι�ȣ �׸� ������� ����</option>
						</select>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#FFFFFF" height="0" valign="top">
				<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%" valign="top">�Աݰ���</td>
						<td width="75%">
							<select name="Bankcodename" tabIndex="5" selectedindex="0" size="1" disabled='ok'>
							<option value="">���༱��</option>
						</select>&nbsp; 
							<input size="17" class="input_03" value="���¹�ȣ�Է�" disabled='ok'>&nbsp; 
							<input size="14" class="input_03" value="�������Է�" disabled='ok'><br>
							
							<?
						$SQL = "select * from $BankTable where mart_id='$mart_id' order by account_no";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						for ($i=0; $i<$numRows; $i++) {
							mysql_data_seek($dbresult,$i);
							$ary = mysql_fetch_array($dbresult);
							$account_no = $ary["account_no"];
							$bank_name = $ary["bank_name"];
							$bank_number = $ary["bank_number"];
							$owner_name = $ary["owner_name"];
							
							echo ("				
						<select name='bank_name[]' tabIndex='5' selectedindex='0' size='1'>
							<option value=''
								");
								if($bank_name == '') echo " selected";
								echo ("
							>========</option>
							<option value='�λ�����'
								");
								if($bank_name == '�λ�����') echo " selected";
								echo ("
							>�λ�����</option>
						<option value='�泲����'
							");
								if($bank_name == '�泲����') echo " selected";
								echo ("
							>�泲����</option>
						 <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='�������'
							");
								if($bank_name == '�������') echo " selected";
								echo ("
							>�������</option>
						  <option value='�� ��'
							");
								if($bank_name == '�� ��') echo " selected";
								echo ("
							>�� ��</option>
						  <option value='�뱸����'
							");
								if($bank_name == '�뱸����') echo " selected";
								echo ("
							>�뱸����</option>
						  <option value='�� �� ġ'
							");
								if($bank_name == '�� �� ġ') echo " selected";
								echo ("
							>�� �� ġ</option>
						  <option value='�������'
							");
								if($bank_name == '�������') echo " selected";
								echo ("
							>�������</option>
						  <option value='�������'
							");
								if($bank_name == '�������') echo " selected";
								echo ("
							>�������</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='�� ��'
							");
								if($bank_name == '�� ��') echo " selected";
								echo ("
							>�� ��</option>
						  <option value='��Ƽ����'
							");
								if($bank_name == '��Ƽ����') echo " selected";
								echo ("
							>��Ƽ����</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='�Ϸ�����'
							");
								if($bank_name == '�Ϸ�����') echo " selected";
								echo ("
							>�Ϸ�����</option>
						  <option value='��ȯ����'
							");
								if($bank_name == '��ȯ����') echo " selected";
								echo ("
							>��ȯ����</option>
						  <option value='�츮����'
							");
								if($bank_name == '�츮����') echo " selected";
								echo ("
							>�츮����</option>
						  <option value='�� ü ��'
							");
								if($bank_name == '�� ü ��') echo " selected";
								echo ("
							>�� ü ��</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='��������'
							");
								if($bank_name == '��������') echo " selected";
								echo ("
							>��������</option>
						  <option value='�ϳ�����'
							");
								if($bank_name == '�ϳ�����') echo " selected";
								echo ("
							>�ϳ�����</option>
						  <option value='�ѹ�����'
							");
								if($bank_name == '�ѹ�����') echo " selected";
								echo ("
							>�ѹ�����</option>
							<option value='�������ݰ�'
							");
							if($bank_name=="�������ݰ�") echo " selected";
							echo ("
							>�������ݰ�</option>
						  <option value='ȫ������'
							");
								if($bank_name == 'ȫ������') echo " selected";
								echo ("
							>ȫ������</option>
							</select><span>&nbsp; 
							<input name='bank_number[]' size='17' class='input_03' value='$bank_number'>&nbsp; 
							<input name='owner_name[]' size='14' class='input_03' value='$owner_name'><br>
								");
						}
						?>
						</td>
					</tr>
				</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1" valign="top"><span class="cc"></td>
			</tr>

			<!-- <tr>
			<td width="100%" bgcolor="#FFFFFF" height="2" valign="top">
				 <table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
						<td width="25%">�������� �̿뿩��</td>
						<td width="25%">
							<input name="if_union" type="radio" value="t"<?if($if_union=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_union" type="radio" value="f"<?if($if_union=='f') echo " checked"?>>No</td>
						<td width="25%">�������� �̿뿩��</td>
						<td width="25%">
							<input name="if_notice" type="radio" value="t"<?if($if_notice=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_notice" type="radio" value="f"<?if($if_notice=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">������õ �̿뿩��</td>
						<td width="25%">
							<input name="if_chuchon" type="radio" value="t"<?if($if_chuchon=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_chuchon" type="radio" value="f"<?if($if_chuchon=='f') echo " checked"?>>No</td>
						<td width="25%">�������� �̿뿩��</td>
						<td width="25%">
							<input name="if_coupon" type="radio" value="t"<?if($if_coupon=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_coupon" type="radio" value="f"<?if($if_coupon=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">��������� �̿뿩��</td>
						<td width="25%">
							<input name="if_receipt" type="radio" value="t"<?if($if_receipt=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_receipt" type="radio" value="f"<?if($if_receipt=='f') echo " checked"?>>No</td>
						<td width="25%">�̺�Ʈ �̿뿩��</td>
						<td width="25%">
							<input name="if_event" type="radio" value="t"<?if($if_event=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_event" type="radio" value="f"<?if($if_event=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">��ǰ�ı��� �̿뿩��</td>
						<td width="25%">
							<input name="user_words" type="radio" value="t"<?if($user_words=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="user_words" type="radio" value="f"<?if($user_words=='f') echo " checked"?>>No</td>
						<td width="25%">Ŀ�´�Ƽ �̿뿩��</td>
						<td width="25%">
							<input name="if_community" type="radio" value="t"<?if($if_community=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_community" type="radio" value="f"<?if($if_community=='f') echo " checked"?>>No</td>
					</tr>
					<tr>
						<td width="25%">���������� �̿뿩��</td>
						<td width="25%">
							<input name="if_poll" type="radio" value="t"<?if($if_poll=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_poll" type="radio" value="f"<?if($if_poll =='f') echo " checked"?>>No</td>
						<td width="25%">���� �̿뿩��</td>
						<td width="25%">
							<input name="if_quiz" type="radio" value="t"<?if($if_quiz=='t') echo " checked"?>>Yes 
							&nbsp; 
							<input name="if_quiz" type="radio" value="f"<?if($if_quiz=='f') echo " checked"?>>No</td>
					</tr>
					</table>
			</td>
			</tr>

			<tr>
			<td width="100%" bgcolor="#6084D5" height="1"></td>
			</tr> -->

			<!-- <tr>
		    <td width="100%" bgcolor="#FFFFFF">
		  
		  	<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			 
			 <tr>
				<td vAlign="top" width="25%">�������ϴ� ī�Ƕ���Ʈ</td>
				<td width="75%">
					<object id="copyright_txt" codebase="<?=$edit_url?>GsWebEdit.cab#version=1,0,0,62" height="350" width="100%" classid="CLSID:8B844CB2-4E1B-4707-B3D5-31C00D717398">
						<param name="AhrefAutoTargetUse" value="true">
						<param name="AhrefAutoTarget" value="__blank">
						<param name="CurMoveFirst" value="true">
						<param name="Metacontent" value="<?=$url?>">
						<param name="CharSet" value="ks_c_5601-1987">
						<param name="BorderColor" value="#FFFFFF">
						<param name="InsertHtml" value="<?=$copyright?>">
						<param name="FontSize" VALUE="">
						<param name="LimitAttachFileSize" value="0">
						<param name="LimitAttachFileTotalSize" value="0">
						<param name="LimitAttachFileCount" value="0">
						<param name="CSSUrl" value="<?=$style_url?>style.css">
						<param name="TableBorder" value="1">
						<param name="TableCellSpacing" value="2">
						<param name="TableCellPadding" value="1">
						<param name="ShowProgressBar" value="true">
						<param name="ToolBarStyleUrl" value="<?=$style_url?>style.txt">
						<param name="UseBR" value="true">
						<param name="UseStyle" value="true">
						<param name="ToolBarImagePath" value="">
						<param name="ToolBarHotImagePath" value="">
						<param name="ToolBarDisableImagePath" value="">
						<param name="TabPosition" value="bottom">
					</object>
					<textarea style='display:none' name="copyright"></textarea>
				</td>
			 </tr>
		  </table>
		  </td>
		</tr> -->

		<tr>
		<td width="100%" bgcolor="#6084D5" height="1"></td>
		</tr>

		<tr>
		  <td width="100%" bgcolor="#FFFFFF" height="10">
			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			 <tr>
				<td width="100%"></td>
			 </tr>
			 <tr>
				<td align="center" height="35">
					<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="�Ϸ�">&nbsp; <input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="���Է�">
				</td>
			 </tr>
		  </table>
		  </td>
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
<script>
//exp(document.f);
</script>
<?
if( $dbresult ){
	mysql_free_result( $dbresult );
}
mysql_close($dbconn);
?>