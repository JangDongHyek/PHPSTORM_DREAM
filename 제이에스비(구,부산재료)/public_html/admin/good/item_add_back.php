<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//ī�װ� ���� ��ġ
$cur_category_name = category_navi($category_num);

$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_zoom_module = $ary["item_zoom_module"];
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary["if_gnt_item"];
	$if_customer_price = $ary["if_customer_price"];
}
?>
<?

//echo $item_explain;
//exit;
if(!isset($flag)||$flag==""){
	$reg_date = date(Y)."-".date(m)."-".date(d);
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){
		alert("\n��ǰ�̸��� �Է��ϼ���.");
		frm.item_name.focus();
		return false;
	}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	

	var Digit = '1234567890'

	if (frm.z_price.value==""){
		alert("�ǸŰ��� �Է��ϼ���");
		frm.z_price.focus();
		return false;
	}

	/*if (frm.member_price.value==""){
		alert("���ް��� �Է��ϼ���");
		frm.member_price.focus();
		return false;
	}*/

	//if (frm.bonus.value==""){
	//	alert("����Ʈ�� �Է��ϼ���");
	//	frm.bonus.focus();
	//	return false;
	//}
	
	//if(frm.jaego_use[0].checked){
	//	if (frm.jaego.value==""){
	//		alert("����� �Է��ϼ���");
	//		frm.jaego.focus();
	//		return false;		
	//	}
	//}
	<?
	if($if_gnt_item == 1){
	?>
	if(frm.if_provide_item[0].checked){
		
		if (frm.provide_price.value==""){
			alert("���ް��� �Է��ϼ���");
			frm.provide_price.focus();
			return false;
		}
		else{
			var len =frm.provide_price.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){
			    var ch = frm.provide_price.value.substring(i,i+1);
			
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				
				if (!ret){
						
						alert("���ڸ� �Է� �ϼ���");
						frm.provide_price.focus();
						return false;
				}
				ret = false;
			}	
		
		}
	}
	<?
	}
	?>

	//checkform1();
	if(frm.use_opt1_chk.checked) frm.use_opt1.value = 't';
	else frm.use_opt1.value = 'f';
	
	//if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	//else frm.use_opt23.value = 'f';
	
	
	if (frm.op_name1.value ==""){
	}else{
		for(i=1;i<frm.opt1.options.length ;i++){
				Tmp1 = Tmp1 + "!" + frm.opt1.options[i].value;
		}
        if (Tmp1==""){
            frm.op1.value =Tmp1;
        }
        else{
			frm.op1.value =frm.op_name1.value + Tmp1;
        }

    }
	/*
	if (frm.op_name2.value==""){
	}else{	
	
		for(i=1;i<frm.opt2.options.length ;i++){
				Tmp2 = Tmp2 + "!" + frm.opt2.options[i].value;
		}
        if (Tmp2==""){
            frm.op2.value =Tmp2;
        }
        else{
			frm.op2.value =frm.op_name2.value + Tmp2;
        }

   }

	if (frm.op_name3.value==""){
	}else{	
	
		for(i=1;i<frm.opt3.options.length ;i++){
				Tmp3 = Tmp3 + "!" + frm.opt3.options[i].value;
		}
        if (Tmp3==""){
            frm.op3.value =Tmp3;
        }
        else{
			frm.op3.value =frm.op_name3.value + Tmp3;
		}	
    }
	*/

	if(!editor_wr_ok())
	{
		return false;
	}

	return true;
}

function pro_del1(frm){



	for(i=1;i<frm.opt1.options.length ;i++){
		if ( frm.opt1.options[i].selected){
			document.all.opt1.options[i] = null;
			return true;
		}
	}
	
	alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
}
	
function pro_del2(frm){
	
	for(i=1;i<frm.opt2.options.length ;i++){
		if ( frm.opt2.options[i].selected){
			document.all.opt2.options[i] = null;
			return true;
		}
	}
	
	alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
}

function pro_del3(frm){
	
	for(i=1;i<frm.opt3.options.length ;i++){
		if ( frm.opt3.options[i].selected){
			document.all.opt3.options[i] = null;
			return true;
		}
	}
	
	alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
}




function pro_add1(frm,pro,price,bonus,mem_price,op_name1_2,color){
	var e1=document.createElement("OPTION")

	if (pro=="" ){
		alert ("�ɼ��׸��� �Է��ϼ���.");
		frm.pro_value1.focus ();
		return false;
	}else{	

			
					var Digit = '1234567890'
					var len = price.length;
					var ret;
					ret =false;		
					for(var i=0;i<len;i++){
						var ch = price.substring(i,i+1);
					
						for (var k=0;k<=Digit.length;k++){				
							
							if(Digit.substring(k,k+1) == ch)
							{					
								

										for(k=1;k<frm.opt1.options.length ;k++){
											if (e1.value == frm.opt1.options[k].value){
												alert ("�����ϴ� �ɼ��׸��Դϴ�.�ٽ� �Է��ϼ���.");
												frm.pro_value1.value ="";
												frm.pro_value1.focus();
												return false;
											}
										}

								ret = true;
								break;					
							}
						}	
						
						if (!ret){
								
								alert("������ ���ݱ��Կ��� ���ڸ� �����մϴ�.");
								frm.pro_price1.focus();
								return false;
						}
						ret = false;
					}
					
					e1.value = pro + "^" + price;
					e1.text= pro + "(" + price +"��)" ;
					
					if (bonus!="" ){
					
						var len = bonus.length;
						var ret;
						ret =false;		
						for(var i=0;i<len;i++){
							var ch = bonus.substring(i,i+1);
						
							for (var k=0;k<=Digit.length;k++){				
								
								if(Digit.substring(k,k+1) == ch)
								{					
									ret = true;
									break;					
								}
							}	
							
							if (!ret){
									
									alert("����Ʈ���� ���ڸ� �����մϴ�.");
									frm.pro_bonus1.focus();
									return false;
							}
							ret = false;
						}
					}
					e1.value = e1.value + "^" + bonus;
					e1.text= e1.text + "M:" + bonus +"��" ;

									
					/*
					if (mem_price!="" ){
					
						var len = mem_price.length;
						var ret;
						ret =false;		
						for(var i=0;i<len;i++){
							var ch = mem_price.substring(i,i+1);
						
							for (var k=0;k<=Digit.length;k++){				
								
								if(Digit.substring(k,k+1) == ch)
								{					
									
									ret = true;
									break;					
								}
							}	
							
							if (!ret){
									
									alert("ȸ�������� ���ڸ� �����մϴ�.");
									frm.mem_price.focus();
									return false;
							}
							ret = false;
						}
					}
					*/
					e1.value = e1.value + "^" + mem_price + "^" + op_name1_2 + "^" + color;
					e1.text= e1.text + op_name1_2 + ":" + color + "�ڵ�:" + mem_price;
		
				
	}

	document.all.opt1.add(e1);
	frm.pro_value1.value ="";		
	frm.pro_price1.value ="";
	frm.pro_bonus1.value ="";
	frm.pro_mem_price1.value ="";			
	frm.pro_color.value ="";			
	frm.pro_value1.focus ();
}

function pro_add2(frm,pro){
	var e1=document.createElement("OPTION")

	if (pro=="" ){
		alert ("�ɼ��׸��� �Է��ϼ���.");
		frm.pro_value2.focus ();
		return false;
	}else{	

		e1.value = pro;
		e1.text= pro  ;

				for(k=1;k<frm.opt2.options.length ;k++){
					if (e1.value == frm.opt2.options[k].value){
						alert ("�����ϴ� �ɼ��׸��Դϴ�.�ٽ� �Է��ϼ���.");
						frm.pro_value2.value ="";
						frm.pro_value2.focus();
						return false;
					}
				}
	document.all.opt2.add(e1);
	frm.pro_value2.value =""		
	frm.pro_value2.focus (); 		
	}
}


function pro_add3(frm,pro){
	var e1=document.createElement("OPTION")

	if (pro=="" ){
		alert ("�ɼ��׸��� �Է��ϼ���.");
		frm.pro_value3.focus ();
		return false;}
		
	else{	
		e1.value = pro;
		e1.text= pro ;

				for(k=1;k<frm.opt3.options.length ;k++){
					if (e1.value == frm.opt3.options[k].value){
						alert ("�����ϴ� �ɼ��׸��Դϴ�.�ٽ� �Է��ϼ���.");
						frm.pro_value3.value ="";
						frm.pro_value3.focus();
						return false;
					}
				}

	
	document.all.opt3.add(e1);
	frm.pro_value3.value =""		
	frm.pro_value3.focus (); 		
	}
}


</script>
<script language="javascript">
<!--
function opensub2(x)
{	
	var child;
	window.open(x,'x' ,'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,width=800,height=200,left=0,top=0');
}
// -->
</script>
<script language="javascript">

//*************************** ���� ���ε� â ******************************

function fileup(formname,imagename, title){
// formname : form �� name
// mart_id : ���� mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename+"&title="+title
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** ���� ���ε� â *********************************
</script>
<script>
/*
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}

function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.item_explain.value;
	f.editBox.focus();
	f.editBox.setFocus();
}

function checkform1(){
	var f = document.writeform;
	f.editBox.editmode = "html";
	f.item_explain.value = f.editBox.html;
	return true;
}*/
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
<script language="javascript">
//�޸� �ֱ�(������ �ش�) 
function comma(val){ 
	val = get_number(val); 
	if(val.length <= 3) return val; 

	var loop = Math.ceil(val.length / 3); 
	var offset = val.length % 3; 
	if(offset==0) offset = 3; 
	var ret = val.substring(0, offset); 
	for(i=1;i<loop;i++) { 
	ret += "," + val.substring(offset, offset+3); 
	offset += 3; } return ret; 
} 

//���ڿ����� ���ڸ� �������� 
function get_number(str){ 
	var val = str; 
	var temp = ""; 
	var num = ""; 

	for(i=0; i<val.length; i++){ 
		temp = val.charAt(i); 
		if(temp >= "0" && temp <= "9") num += temp; 
	} 
	return num; 
}
//���ڸ� �Է��ϱ� 
function checkNumber(){
	var objEv = event.srcElement;
	var num ="0123456789,";
	event.returnValue = true;
	 
	for (var i=0;i<objEv.value.length;i++){
		if(-1 == num.indexOf(objEv.value.charAt(i)))
		event.returnValue = false;
	}
	 
	if (!event.returnValue)
	objEv.value="";
}
//���� ����ϱ�
function cal(){
	var here = document.writeform;
	var pr = eval(here.member_price.value);
	var gr = eval(here.g_margin.value);
	var tot = Math.ceil( ( pr * (100+ gr) ) / 100 );
	here.z_price.value=tot;
	here.bonus.focus();
}
</script>
</head>
<?
include_once('../../editor/func_editor.php');
$content = $item_explain;
?>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="600" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>����ī�װ� : <?=$cur_category_name?></b></td>
				</tr>
			</table>

			<!--���� START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[��ǰ ���]</b> ���ο� ��ǰ�� ����մϴ�.<font color="#CE285A"> �� �̹��� ���ϸ��� �ݵ�� �������� �ϼ���.</font><br><br>
				</td>
			</tr>

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
          		<form action='item_add.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
				<input type="hidden" name="pu" value="<?=$pu?>">
				<input type="hidden" name="first_no" value="<?=$first_no?>">
				<input type="hidden" name="second_no" value="<?=$second_no?>">
				<input type="hidden" name="thirdno" value="<?=$thirdno?>">
				<input type="hidden" name="category_num" value="<?=$category_num?>">
				<input type="hidden" name="img_sml_updateflag" value=''>
				<input type="hidden" name="img_updateflag" value=''>
				<input type="hidden" name="img_big_updateflag" value=''>
				<input type="hidden" name="img_big2_updateflag" value=''>
				<input type="hidden" name="img_big3_updateflag" value=''>
				<input type="hidden" name="img_big4_updateflag" value=''>
				<input type="hidden" name="img_big5_updateflag" value=''>
				<input type="hidden" name="img_high_updateflag" value=''>
				<input type="hidden" name="op1" value="">
				<input type="hidden" name="op2" value="">
				<input type="hidden" name="op3" value="">
				<input type="hidden" name="doctype" value="0">
				<input type="hidden" name="opt">
				<input type="hidden" name="use_opt1">
				<input type="hidden" name="use_opt23">
				<input type="hidden" name="reg_date" value='<?=$reg_date?>'>
				<input type="hidden" name="provider_id" value="<?=$Mall_Admin_ID?>">
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				��ǰ��
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_name" size="25">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_company" size="25">
							</td>
              			</tr>
              			<!-- <tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
                				���޻�(������)
							</td>
                			<td bgcolor="#FFFFFF" colspan="4">
								<select name="provider_id" class='input'>
									<option value="">���޻� ���þ���</option>
<?
$sql5 = "select * from $MemberTable where perms='3' order by name asc";
$res5 = mysql_query( $sql5, $dbconn );
$tot5 = mysql_num_rows( $res5 );
if( !$tot5 ){
?>
									<option value="">��ϵ� ���޻� �� �����ϴ�.</option>
<?
}else{
?>
<?
	while( $row5 = mysql_fetch_array( $res5 ) ){
?>
									<option value="<?=$row5[username] ?>" <?if($row5[username]==$provider_id){echo ("selected");}?>><?=$row5[name]?></option>
<?
	}
}
if( $res5 ){
	mysql_free_result( $res5 );
}
?>
								</select>
							</td>
              			</tr> -->
              			<tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								��ǰ�԰�
							</td>
			                <td bgColor="#ffffff">
								<input name="item_kyukyuk" class='input' size="14">
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								��ǰ�ڵ�
							</td>
			                <td bgColor="#ffffff">
								<input name="item_code" class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								������
							</td>
			                <td bgColor="#ffffff">
								<input class="aa" type="radio" value="1" name="jaego_use">��� �� 
								<input class="aa" type="radio" CHECKED value="0" name="jaego_use">��� ���� ����
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								���
							</td>
			                <td bgColor="#ffffff">
								<input name="jaego" class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								���ް�
							</td>
			                <td bgColor="#ffffff">
								<input name="member_price" value="<?=$member_price?>"  class='input' size="14" onKeyDown="checkNumber()">
							</td>	
			                <td bgColor="#c8dfec" colspan="2" align="center">
								�� ��
							</td>
			                <td bgColor="#ffffff">
								<input name="g_margin" value='<?=$g_margin?>' class='input' size="5" onChange='cal()' onKeyDown="checkNumber()"> %
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ǸŰ�
							</td>
			                <td bgColor="#ffffff">
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()">
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								����Ʈ
							</td>
			                <td bgColor="#ffffff">
								<input name="bonus" value="<?=$bonus?>"  class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								�Һ��ڰ� <input type="checkbox" value="1" name="if_strike" <?
						if($if_customer_price != '1') echo " disabled";
						if($if_strike == "1") echo " checked";
						?>>
							</td>
			                <td bgColor="#ffffff">
								<input name="price" class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�������
							</td>
			                <td bgColor="#ffffff">
								<input type="radio" value="������" name="fee">������ <input type="radio" value="����" name="fee" >���� <input type="radio" value="" name="fee" checked>����
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ּұ��ż���
							</td>
			                <td bgColor="#ffffff" colSpan="4">
								<input name="min_buy" value="1" class='input' size="14">
							</td>							
			              </tr>
			              <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								�������
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="checkbox" value="1" name="if_cash">�����������<br>
								<font color="#C00000"> (�������� ��������Դϴ�. Ÿ ��ǰ�� ���� ���Ž�, ���ݰ����� �����մϴ�.)</font><br>
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="100%" bgColor="#ffffff" colSpan="6">
								<br><font color="#0000ff">�Һ��ڰ��� ������ ��µ��� �ʽ��ϴ�.<br>
								�ǸŰ�, ����Ʈ�� ���ڸ� �Է��Ͻð�, ����Ʈ�� �������� ���� ��� &quot;0&quot;�� �Է��ϼ���.<br>
</font><br><br>
			                </td>
			              </tr>
<?
if($if_gnt_item == 1){
?>
              			<tr>
                			<td align='center' bgColor="#c8dfec" colspan="2">
                				���޿���
							</td>
                			<td bgColor="#ffffff">
                				<input type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>���� 
                				<input type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>�Ұ���
							</td>
                			<td align="center" bgcolor="#c8dfec" colspan="2">
                				���ް�
							</td>
                			<td bgcolor="#ffffff">
                				<input class='input' size="14" name="provide_price">
							</td>
              			</tr>
<?
}
?>
              			<tr>
			                <td align='center' width="8%" bgColor="#c8dfec" rowspan="4">
								��ǰ<br>�̹���
							</td>
			                <td align='center' width="7%" bgColor="#E8F1F7">
								����Ʈ
							</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_sml" class='input' size="25"> 
								<input onclick="javascript:fileup('writeform','img_sml', '����Ʈ');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_sml" border="0"> -->
			                </td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								��
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img', '��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img" border="0"> -->
			                </td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								Ȯ��
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_big" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img_big', 'Ȯ��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_big" border="0"> --><br>
								&nbsp;<input name="img_big2" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img_big2', 'Ȯ��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_big2" border="0"> --><br>
								&nbsp;<input name="img_big3" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img_big3', 'Ȯ��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_big3" border="0"> --><br>
								&nbsp;<input name="img_big4" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img_big4', 'Ȯ��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_big4" border="0"> --><br>
								&nbsp;<input name="img_big5" class='input' size="25">
								<input onclick="javascript:fileup('writeform','img_big5', 'Ȯ��');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><!--  <img src="./blank_.gif" name="view_img_big5" border="0"> --><br>
								
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								����
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_high" style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; width: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></span> 
								<input onclick="javascript:fileup('writeform','img_high', '����');" class="aa" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'> <img src="./blank_.gif" name="view_img_high" border="0"> 
							</td>
						  </tr>
			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6">
								<img height="15" src="../images/tip.gif" width="30"> <font color="#0000ff"> �̹����� jpg,gif,swf�� �����մϴ�.<br>
								����Ʈ ȭ���� ������� 120*120 px �����Դϴ�.<br>
								�󼼼��� �������� ������� 240*240 px �����Դϴ�.<br>
								Ȯ���̹����� ���������� 500*500 px�̰�, ���Ǵ�� ���������� 
								�����մϴ�.</font>
							</td>
			              </tr>
			              <tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
								������ ����
							</td>
                			<td bgcolor="#FFFFFF" align="left" colspan="4">
                				<input name="icon_no" type="radio" value="0" checked><font color="#0000FF">������</font>&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="1"><img src="../images/hot.gif" width="22" height="13">&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="2"><img src="../images/new.gif" width="22" height="13">&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="3"><img src="../images/sale.gif" width="22" height="13">&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="4"><img src="../images/reserv.gif" width="53" height="12"><br>
                				<font color="#0000FF">�Ż�ǰ�̳� ��õ��ǰ �� �����ϰ� ���� ��ǰ��
                				�������� �����ϼ���.<br>
                				��� ��ǰ�� �� ���� ��� ��ĩ �길���� ���� ������ �� �ʿ���
                				��ǰ���� <br>
                				�����ϼ���.</font>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				���� ����
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<textarea name="short_explain" rows='3' cols='108'></textarea>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				��ǰ ����
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">								
								<?=myEditor(1,'../../editor','writeform','item_explain','100%','450');?>                				
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				�ɼǻ��
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk" checked> �������� �ɼǻ��
							</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14">
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="8">
                				<select name="opt1" size="8" style="width:330">
          						<option>-------------------------------------</option>
        						</select>
        						<br>
	            				<span class="aa">M: ����Ʈ							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�����Է�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_price1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				����Ʈ�Է�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_bonus1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1_2" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_color" size="36">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ڵ��Է�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_mem_price1" size="36">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add1(this.form,document.all.pro_value1.value,document.all.pro_price1.value,document.all.pro_bonus1.value,document.all.pro_mem_price1.value,document.all.op_name1_2.value,document.all.pro_color.value)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="pro_del1(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
						<!--
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt23_chk" checked> ���ݵ��� �ɼǻ��
                			</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ����� 1
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name2" size="14">
							</td>
                			<td width="50%" bgcolor="#FFFFFF" colspan="3" rowspan="3" align="center">
                				<select name="opt2" size="4" style="width: 250;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
          						<option>------------------</option>
        						</select>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸� 1
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value2" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add2(this.form,document.all.pro_value2.value)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="pro_del2(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
							</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ����� 2
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name3" size="14">
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="3">
                				<select name="opt3" size="4" style="width: 250;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
          						<option>------------------</option>
        						</select>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸� 2
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value3" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add3(this.form,document.all.pro_value3.value)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="pro_del3(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
						-->
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">�ɼ� ���� ��� ����</font>
									</td>
                  				</tr>
                  				<tr>
                    				<td width="100%">
                    					1. �������� �ɼǻ��<br>
                    					��)����� ���� ������ ���� ���� ������ �Է����� ���ð� ������ �ٸ� ��� ������ �Է��ϼž� �մϴ�.<br>
                    					�ɼ�����: ������<BR>
										�ɼ��׸�: 123*456<BR>
										�����Է� : 1000 �Ǵ� ����<BR>
										�ɼ�����2 : ����<BR>
										�ɼ��׸�2 : ����,�Ķ�,�ʷ�(�ɼ��׸�2�� ","�� ���е˴ϴ�)<br>
										�ڵ��Է� : T1,T2,T3(�������  ���� ���� �ڵ��Է� ����)<BR><BR>

										�ػ���� ���� �ڵ��Է��� �׳� �׻���� �´� �ڵ尪�� �Է��Ͻø� �ǰ� ������� ���� ���� �ڵ尪�� �ɼ��׸�2�� ������ ���� ���缭 ","�� �����ϼż� �Է��Ͻø� �˴ϴ�.								
                    					<br><br>
                    					<!--
										2. ���ݵ��� �ɼǻ���� ���<br>
                    					��)������ �����ϵ� ������ �� ������ �ٸ� ���,<br>
                    					�ɼ����� 1: ������, �ɼ��׸� 1: <font color="#FF0000">55,66</font> |
                    					�ɼ����� 2 : ����, �ɼ��׸� 2 : <font color="#FF0000">����, ��</font><br>
                    					����ȭ�鿡 �Է��� �׸��� ��µ˴ϴ�.<br>
                    					�ɼ��׸��� 55, 66/ ����, ���� ���� ���� �Է��ϼž� �մϴ�.-->
                    				</td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
                				�����
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3"><?=$reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
								�����������
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input type="radio" name="if_hide" value="0" checked> ������ �����<br>
                				<input type="radio" value="1" name="if_hide"> ������ �����������<br>&nbsp;(����� ������, ������ ��µ����� �ʽ��ϴ�)</td>
              			</tr>
            			</table>
            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
<?
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}		
$SQL = "select * from $ItemTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($service_name == 'base'&& $numRows > 2000){
	echo "
	 <script>
	 function check_ver(){
		alert(\"��ǰ������ 2000���� �Ѿ� �� �̻��� ��ǰ�� ����� �� �����ϴ�.\");
		return false;
	}
	</script>
	";
}
else if($service_name == 'indi_base'&& $numRows > 2000){
	echo "
	 <script>
	 function check_ver(category_num,prevno){
		alert(\"��ǰ������ 2000���� �Ѿ� ���̻��� ��ǰ�� ����� �� �����ϴ�.\");
		return false;
	}
	</script>	
	";
}
else if($service_name == 'free_base'&& $numRows > 150){
	echo "
	<script>
	 function check_ver(){
		alert(\"��ǰ������ 150���� �Ѿ� �� �̻��� ��ǰ�� ����� �� �����ϴ�.\");
		return false;
	}
	</script>	
	"	;
}
else{
	echo "
	<script>
	 function check_ver(){
		return true;
	}
	</script>
	";
}
?>
				<input onclick='return check_ver()' class='butt_none' style='width:60' type="submit" value="�� ��" style='cursor:hand'>
        		<input class='butt_none' style='width:60' type="reset" value="���Է�">
        		<input  onclick="location.href='item_list.php?prevno=<?=$prevno?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>'" class='butt_none' style='width:60' type="button" style='cursor:hand' value="����Ʈ">
        	</td>
      	</tr>
      	
      	</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
?>
<?
//================== ��ǰ�� ����� =======================================================
if($flag == "add"){
	if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
	}
	
	if(isset($op1)&&$op1!=""){
		$opt = $op1;
		if(isset($op2)&&$op2!=""){
			$opt = $opt."=".$op2;
			if(isset($op3)&&$op3!=""){
				$opt = $opt."=".$op3;
			}
		}
	}
	else $opt = "";
	
	$opt = $op1."=".$op2."=".$op3;
	
	$SQL = "select max(item_no), count(*) from $ItemTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxItem_no = mysql_result($dbresult, 0, 0);
	else
		$maxItem_no = 0;
	$maxItem_no_1 = $maxItem_no+1;
		
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		$img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml;
	}
	if($img_updateflag=="ok" && $img != ""){
		$img_new = "item_".$maxItem_no_1."_".$img;
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		$img_big_new = "item_big_".$maxItem_no_1."_".$img_big;
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		$img_big2_new = "item_big2_".$maxItem_no_1."_".$img_big2;
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		$img_big3_new = "item_big3_".$maxItem_no_1."_".$img_big3;
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		$img_big4_new = "item_big4_".$maxItem_no_1."_".$img_big4;
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		$img_big5_new = "item_big5_".$maxItem_no_1."_".$img_big5;
	}

	if($img_high_updateflag=="ok" && $img_high != ""){
		$img_high_new = "item_high_".$maxItem_no_1."_".$img_high;
	}

	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	$item_order = "9999";//��ǰ ��� ����

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee, item_kyukyuk,min_buy) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee', '$item_kyukyuk', '$min_buy')";

	$dbresult = mysql_query($SQL, $dbconn);
	
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml"))
			copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//���ε� ���� ����
	}
	if($img_updateflag=="ok" && $img != ""){
		if(file_exists("$Co_img_UP$mart_id/$img"))
			copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����

			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_new, $watermark_path, 50, 100); //���͸�ũó��

	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big"))
			copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big_new, $watermark_path, 50, 100); //���͸�ũó��

	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2"))
			copy ("$Co_img_UP$mart_id/$img_big2","$Co_img_UP$mart_id/$img_big2_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big2_new, $watermark_path, 50, 100); //���͸�ũó��
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3"))
			copy ("$Co_img_UP$mart_id/$img_big3","$Co_img_UP$mart_id/$img_big3_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big3_new, $watermark_path, 50, 100); //���͸�ũó��
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4"))
			copy ("$Co_img_UP$mart_id/$img_big4","$Co_img_UP$mart_id/$img_big4_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big4_new, $watermark_path, 50, 100); //���͸�ũó��
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5"))
			copy ("$Co_img_UP$mart_id/$img_big5","$Co_img_UP$mart_id/$img_big5_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_big5_new, $watermark_path, 50, 100); //���͸�ũó��
	}
	
	if($img_high_updateflag=="ok" && $img_high != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_high"))
			copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//���ε� ���� ����
			$watermark_path ="$Co_img_UP$mart_id/logo.png"; //���͸�ũ���
			$arr_result = waterMarkImage("$Co_img_UP$mart_id/".$img_high_new, $watermark_path, 50, 100); //���͸�ũó��
	}
	
	//�ӽ�ȭ�� ����
	if($img_sml_updateflag=="ok" && $img_sml != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml"))
			unlink("$Co_img_UP$mart_id/$img_sml");
	}
	if($img_updateflag=="ok" && $img != ""){
		if(file_exists("$Co_img_UP$mart_id/$img"))
			unlink("$Co_img_UP$mart_id/$img");
	}
	if($img_big_updateflag=="ok" && $img_big != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big"))
			unlink("$Co_img_UP$mart_id/$img_big");
	}
	if($img_big2_updateflag=="ok" && $img_big2 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2"))
			unlink("$Co_img_UP$mart_id/$img_big2");
	}
	if($img_big3_updateflag=="ok" && $img_big3 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3"))
			unlink("$Co_img_UP$mart_id/$img_big3");
	}
	if($img_big4_updateflag=="ok" && $img_big4 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4"))
			unlink("$Co_img_UP$mart_id/$img_big4");
	}
	if($img_big5_updateflag=="ok" && $img_big5 != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5"))
			unlink("$Co_img_UP$mart_id/$img_big5");
	}

	if($img_high_updateflag=="ok" && $img_high != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_high"))
			unlink("$Co_img_UP$mart_id/$img_high");
	}

	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>