<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
$SQL = "select * from $Union_ItemTable where item_no = $item_no and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_no = $ary["item_no"];
	$item_name = $ary["item_name"];
	$price = $ary["price"];
	$number1_from = $ary["number1_from"];
	$number1_to = $ary["number1_to"];
	$number2_from = $ary["number2_from"];
	$number2_to = $ary["number2_to"];
	$number3_from = $ary["number3_from"];
	$price1 = $ary["price1"];
	$price2 = $ary["price2"];
	$price3 = $ary["price3"];
	$img = $ary["img"];
	$item_explain = $ary["item_explain"];
	$item_company = $ary["item_company"];
	$item_code = $ary["item_code"];
	$icon_no = $ary["icon_no"];
	$reg_date = $ary["reg_date"];
	$opt = $ary["opt"];
	$use_opt23 = $ary["use_opt23"];	
	$if_cash = $ary["if_cash"];	
}
$opts = explode("=", $opt);

	include "../admin_head.php";
?>
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){
		alert("\n��ǰ���� �Է��ϼ���.");
		frm.item_name.focus();
		return false;
	}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	var Digit = '1234567890'
	
	if (frm.number1_from.value==""){
		alert("���ڸ� �Է��ϼ���");
		frm.number1_from.focus();
		return false;
	}else{
		var len =frm.number1_from.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.number1_from.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.number1_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.number1_to.value==""){
		alert("���ڸ� �Է��ϼ���");
		frm.number1_to.focus();
		return false;
	}
	else{
		var len =frm.number1_to.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.number1_to.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.number1_to.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.price1.value==""){
		alert("������ �Է��ϼ���");
		frm.price1.focus();
		return false;
	}
	else{
		var len =frm.price1.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.price1.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.price1.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.number2_from.value==""){
		alert("���ڸ� �Է��ϼ���");
		frm.number2_from.focus();
		return false;
	}
	else{
		var len =frm.number2_from.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.number2_from.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.number2_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.number2_to.value==""){
		alert("���ڸ� �Է��ϼ���");
		frm.number2_to.focus();
		return false;
	}
	else{
		var len =frm.number2_to.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.number2_to.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.number2_to.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.price2.value==""){
		alert("������ �Է��ϼ���");
		frm.price2.focus();
		return false;
	}
	else{
		var len =frm.price2.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.price2.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.price2.focus();
					return false;
			} 
			ret = false;
		}	
	}

if (frm.number3_from.value==""){
		alert("���ڸ� �Է��ϼ���");
		frm.number3_from.focus();
		return false;
	}
	else{
		var len =frm.number3_from.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.number3_from.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.number3_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.price3.value==""){
		alert("������ �Է��ϼ���");
		frm.price3.focus();
		return false;
	}
	else{
		var len =frm.price3.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
			 var ch = frm.price3.value.substring(i,i+1);
			 
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("���ڸ� �Է� �ϼ���");
					frm.price3.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if(frm.number1_from.value >= frm.number1_to.value){
		alert("���ڸ� �ٽ� �Է����ּ���. ū���ڰ� �ڿ� �;� �մϴ�.");	
		frm.number1_to.focus();
		return false;
	}
	if(frm.number2_from.value - frm.number1_to.value != 1){
		alert("1ū ���ڰ� �ԷµǾ� �մϴ�.");	
		frm.number2_from.focus();
		return false;
	}
	if(frm.number2_from.value >= frm.number2_to.value){
		alert("���ڸ� �ٽ� �Է����ּ���. ū���ڰ� �ڿ� �;� �մϴ�.");	
		frm.number2_to.focus();
		return false;
	}
	if(frm.number3_from.value - frm.number2_to.value != 1){
		alert("1ū ���ڰ� �ԷµǾ� �մϴ�.");	
		frm.number3_from.focus();
		return false;
	}
	checkform1();
	if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	else frm.use_opt23.value = 'f';
	
	
	if (frm.op_name2.value==""){
		//alert("�ɼ�2�� ������ ���ϼ���");
		//frm.op_name2.focus();
		//return false;
	}
	else{	
	
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
		//alert("�ɼ�3�� ������ ���ϼ���");
		//frm.op_name3.focus();
		//return false;
	}
	else{	
	
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
	 return true;
}

</script>
<script>
function pro_del1(frm)
	{



		for(i=1;i<frm.opt1.options.length ;i++){
			if ( frm.opt1.options[i].selected){
				document.all.opt1.options[i] = null;
				return true;
			}
		}
		
		alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
	}
	
	function pro_del2(frm)
	{
		
		for(i=1;i<frm.opt2.options.length ;i++){
			if ( frm.opt2.options[i].selected){
				document.all.opt2.options[i] = null;
				return true;
			}
		}
		
		alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
	}

	function pro_del3(frm)
	{
		
		for(i=1;i<frm.opt3.options.length ;i++){
			if ( frm.opt3.options[i].selected){
				document.all.opt3.options[i] = null;
				return true;
			}
		}
		
		alert("�����Ͻ� �ɼ��׸��� �����Ͻʽÿ�");		
	}




	function pro_add1(frm,pro,price)
	{

		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("�ɼ��׸��� �Է��ϼ���.");
			frm.pro_value1.focus (); 
			return false;}
			
		else{	
				if (price=="" ) {


						e1.value = pro;
						e1.text= pro + "(���ذ�)" ;

							for(k=1;k<frm.opt1.options.length ;k++){
								if (e1.value == frm.opt1.options[k].value){
									alert ("�����ϴ� �ɼ��׸��Դϴ�.�ٽ� �Է��ϼ���.");
									frm.pro_value1.value ="";
									frm.pro_value1.focus();
									return false;
								}
							}				

					}
				else{

				
						var Digit = '1234567890'
						var len = price.length;
						var ret;
						ret =false;		
						for(var i=0;i<len;i++){  
							 var ch = price.substring(i,i+1);
							 
							for (var k=0;k<=Digit.length;k++){				
								
								if(Digit.substring(k,k+1) == ch)
								{					
									e1.value = pro + "^" + price;
									e1.text= pro + "(" + price +"��)" ;

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




				}		
		}


		

		document.all.opt1.add(e1);
		frm.pro_value1.value ="";		
		frm.pro_price1.value ="";		
		frm.pro_value1.focus (); 		
	}

	function pro_add2(frm,pro){
		var e1=document.createElement("OPTION")
		if (pro=="" ){ 
			alert ("�ɼ��׸��� �Է��ϼ���.");
			frm.pro_value2.focus (); 
			return false;}
			
		else{	

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


	function pro_add3(frm,pro)
	{
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

//*************************** ���� ���ε� â ********************************************************************

function fileup(formname,imagename){
// formname : form �� name
// mart_id : ���� mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "../file_upload.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** ���� ���ε� â ********************************************************************
</script>
<script>
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
function re_init(){
	documnet.writeform.reset();
	init();
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.item_explain.value;
	f.item_name.focus();
	//f.editBox.setFocus();
}


function checkform1(){
	var f = document.writeform;
	f.editBox.editmode = "html";
	f.item_explain.value = f.editBox.html;
	return true;
}
</script>
<script event="onscriptletevent(name, eventData)" for="editBox">
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</script>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="HandleLoad()">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�������� �⺻��������</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF"><strong>[�����̵� �������� ��ǰ ����]</strong> ��ǰ�� �����մϴ�.</td>
					</tr>
<form method="post" name=writeform onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="updateflag">
<input type="hidden" name="item_no" value="<?echo $item_no?>">
<input type="hidden" name="union_no" value="<?echo $union_no?>">
<input type="hidden" name="op1" value="">
<input type="hidden" name="op2" value="">
<input type="hidden" name="op3" value="">
<input type="hidden" name="doctype" value="0">
<input type="hidden" name="opt">
<input type="hidden" name="item_explain" value='<?echo htmlspecialchars($item_explain)?>'>
<input type="hidden" name="use_opt1">
<input type="hidden" name="use_opt23">
<input type="hidden" name="reg_date" value='<?echo $reg_date?>'>
				
				  <tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											��ǰ��</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_name" size="25" value='<?echo $item_name?>' class="input_03" style="width:90%">
										</td>
										<td width="15%" bgcolor="#DDC5E4" align="left">
											<p align="center">������</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_company" size="25" value='<?echo $item_company?>' class="input_03" style="width:90%">
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											���߰�</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="price" size="25" value='<?echo $price?>' class="input_03" style="width:90%">
										</td>
										<td width="15%" bgcolor="#DDC5E4" align="left">
											<p align="center">��ǰ�ڵ�</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_code" size="25" value='<?echo $item_code?>' class="input_03" style="width:90%">
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">����</td>
										<td width="85%" bgcolor="#FFFFFF" colspan="3">
											
											<table border="0" width="429">
												<tr>
												<td width="9" rowspan="4"></td>
												<td width="154">
													
													<input name="number1_from" size="3" value='<?echo $number1_from?>' class="input_03"> 
													~ 
													<input name="number1_to" size="3" value='<?echo $number1_to?>' class="input_03"> 
													�� ����
												</td>
												<td width="254">
													
													<input name="price1" size="25" value='<?echo $price1?>' class="input_03" class="aa"> 
													��
												</td>
												</tr>
												<tr>
												<td width="154">
													 
													
													<input name="number2_from" size="3" value='<?echo $number2_from?>' class="input_03"> 
													~ 
													
													<input name="number2_to" size="3" value='<?echo $number2_to?>' class="input_03"> 
													�� ����
												</td>
												<td width="254">
													
													<input name="price2" size="25" value='<?echo $price2?>' class="input_03" class="aa"> 
													�� 
												</td>
												</tr>
												<tr>
												<td width="154">
													 
													
													<input name="number3_from" size="3" value='<?echo $number3_from?>' class="input_03"> 
													�� �̻�&nbsp;&nbsp; 
												</td>
												<td width="254">
													
													<input name="price3" size="25" value='<?echo $price3?>' class="input_03" class="aa"> 
													�� 
												</td>
												</tr>
												<tr>
												<td width="408" colspan="2">
													 <br>
													<font color="#0000FF">�� 3�ܰ���� ������ å���Ͻ� �� �ֽ��ϴ�.<br>
													(��: 1~15������ 10,000��/ 16~25������ 8,500��/ 26�� �̻� 7,500��) </font>
													 
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										 <td width="15%" bgColor="#DDC5E4" align="center">�������</td>
										 <td width="85%" bgColor="#FFFFFF" align="center" colspan="4"><p
										 align="left"><input type="checkbox" value="1" name="if_cash"
										 <?
										 if($if_cash == '1') echo "checked";
										 ?>
										 >�����������<br>
										 <font color="#C00000"> (�������� ��������Դϴ�. Ÿ ��ǰ�� ���� ���Ž�, 
										 ���ݰ����� �����մϴ�.)</font><br>
										 </td>
									  </tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											��ϵ� ��ǰ�̹���</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											<?
											if($img != ""){
												echo ("	
											<img src='$Co_img_DOWN$mart_id/$img' WIDTH='150' HEIGHT='144'>
												");
											}
											else{
												echo ("
											<span class='aa'>&nbsp;&nbsp;���� ��ϵ� �̹����� �����ϴ�.
												");
											}
											?>
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">��ǰ �̹���</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											&nbsp; 
											<input name="img" size="45" value='<?echo $img?>' class="input_03" readonly> 
											<input onclick="javascript:fileup('writeform','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="ã�ƺ���"><br>
											<br>
											&nbsp; <font color="#0000FF">�̹���������� ���� 181 pixel x ���� 174 pixel �� 
											�����մϴ�.</font> 
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											������ ����</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											
											<input name="icon_no" type="radio" value="0"
											<?
											if($icon_no == 0) echo " checked";
											?>
											> ������ 
											<input name="icon_no" type="radio" value="1"
											<?
											if($icon_no == 1) echo " checked";
											?>
											> 
											<img src="../images/hot.gif" WIDTH="22" HEIGHT="13"> 
											<input name="icon_no" type="radio" value="2"
											<?
											if($icon_no == 2) echo " checked";
											?>
											> 
											<img src="../images/new.gif" WIDTH="22" HEIGHT="13"> 
											<br>
											<font color="#0000FF">�Ż�ǰ�̳� ��õ��ǰ �� �����ϰ� ���� ��ǰ�� 
											�������� �����ϼ���.<br>
											��� ��ǰ�� �� ���� ��� ��ĩ �길���� ���� ������ �� �ʿ��� 
											��ǰ���� <br>
											�����ϼ���.</font>
										</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#DDC5E4" align="center" colspan="4">
											��ǰ����</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#FFFFFF" align="center" colspan="4">
											
											<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">������ 
											<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML �����Է� 
											<br>
											
											<table>
											<tr>
												<td bgColor="#ffffff" width="100%"><p align="center">
													<object id="editBox" data="../editor/Editor_sml.htm" width="530" height="160" type="text/x-scriptlet">
													</object>
												</td>
											</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#DDC5E4" align="center" colspan="4">
											<input type="checkbox" name="use_opt23_chk"<?
											if($use_opt23 == 't') echo " checked";
											?>
											>
											 ���ݵ��� �ɼǻ��
										</td>
									</tr>
									<?
								if(isset($opts[1]) && $opts[1] != ""){
										$op2 = explode("!", $opts[1]);
										$op2_count = count($op2);
									}
									?>
								<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											�ɼ����� 1</td>
										<td width="25%" bgcolor="#FFFFFF" align="center">
											
											<input name="op_name2" size="25" value='<?echo $op2[0]?>' class="input_03" style="width:90%"></td>
										<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="3">
											<p align="center">
											<select name="opt2" size="4" style="WIDTH: 70%;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
											<option>------------------</option>
										<?
											for($i=1;$i< $op2_count;$i++){
												echo ("
											<option value='$op2[$i]'>$op2[$i]</option>
												");
											}
											?>  	
										</select>
									</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											�ɼ��׸� 1</td>
										<td width="25%" bgcolor="#FFFFFF" align="center">
											<input name="pro_value2" size="25" class="input_03" style="width:90%"></td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#FFFFFF" align="center" colspan="2">
											<input onclick="pro_add2(this.form,document.all.pro_value2.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Է�"> 
											<input onclick="pro_del2(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����"></td>
									</tr>
									<?
								if(isset($opts[2]) && $opts[2] != ""){
										$op3 = explode("!", $opts[2]);
										$op3_count = count($op3);
									}
									?>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											�ɼ����� 2</td>
										<td width="25%" bgcolor="#FFFFFF" align="center">
											
											<input name="op_name3" size="25" value='<?echo $op3[0]?>' class="input_03" style="width:90%"></td>
										<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="3">
											<p align="center">
											<select name="opt3" size="4" style="WIDTH: 70%;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
											<option>------------------</option>
										<?
											for($i=1;$i<$op3_count;$i++){
												echo ("
											<option value='$op3[$i]'>$op3[$i]</option>
												");
											}
											?>	
										</select>
									</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											�ɼ��׸� 2</td>
										<td width="25%" bgcolor="#FFFFFF" align="center"><input name="pro_value3" size="25" class="input_03" style="width:90%"></td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#FFFFFF" align="center" colspan="2">
											<input onclick="pro_add3(this.form,document.all.pro_value3.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Է�"> 
											<input onclick="pro_del3(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
										</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
											<table border="0" width="80%">
												<tr>
												<td width="100%"><p align="center">
													<font color="#0000FF">�ɼ� ���� 
													��� ����</font></td>
												</tr>
												<tr>
												<td width="100%">
													��ǰ�� �ɼ��� �����ϴ� �κ����ν� ����
													������ �ɼ��� ������ �� �ֽ��ϴ�. <br>����
													���ݵ��� �ɼ��� ����Ͻǰ����� �����ϼ���.<br>
													<br>
													1. ���ݵ��� �ɼǻ���� ���<br>
													��)������ �����ϵ� ������ �� ������ �ٸ� ���,<br>
													�ɼ����� 1: ������, �ɼ��׸� 1: <font color="#FF0000">55,66</font> |
													�ɼ����� 2 : ����, �ɼ��׸� 2 : <font color="#FF0000">����, ��</font><br>
													����ȭ�鿡 �Է��� �׸��� ��µ˴ϴ�.<br>
													�ɼ��׸��� 55, 66/ ����, ���� ���� ���� �Է��ϼž� �մϴ�.
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#DDC5E4" align="center" colspan="2">
											�����</td>
										<td width="50%" bgcolor="#FFFFFF" align="left" colspan="2">
											<p align="center"><?echo $reg_date?></td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</center></div>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�"> 
						<input onclick="re_init()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���Է�"> 
						<input onclick="window.location.href='union_slide_item_list.php?union_no=<?echo $union_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����Ʈ��">
					</td>
					</tr>
</form>
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
}
else if($flag == "update"){
	
	$op1 = str_replace("=","",$op1);
	$op2 = str_replace("=","",$op2);
	$op3 = str_replace("=","",$op3);
	$opt = $op1."=".$op2."=".$op3;

	if (isset($img)&&($img != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		if($updateflag=="ok"){
			$img_new = "item_".$item_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//���ε� ���� ����
		}
		else{
			$img_new = $img;
		}
		
	}
	
	$SQL = "update $Union_ItemTable set item_name = '$item_name', price = $price, number1_from = '$number1_from', number1_to = '$number1_to', number2_from = '$number2_from', number2_to = '$number2_to', number3_from = '$number3_from', price1 = '$price1', price2 = '$price2', price3 = '$price3', img = '$img_new', item_explain = '$item_explain', item_company = '$item_company', item_code = '$item_code', icon_no = '$icon_no', opt='$opt', use_opt23 = '$use_opt23', if_cash='$if_cash' where item_no = $item_no and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=union_slide_item_list.php?union_no=$union_no'>";
}
?>
<?
mysql_close($dbconn);
?>