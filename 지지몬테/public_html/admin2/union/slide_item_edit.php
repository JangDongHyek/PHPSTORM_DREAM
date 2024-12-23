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
		alert("\n상품명을 입력하세요.");
		frm.item_name.focus();
		return false;
	}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	var Digit = '1234567890'
	
	if (frm.number1_from.value==""){
		alert("숫자를 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.number1_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.number1_to.value==""){
		alert("숫자를 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.number1_to.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.price1.value==""){
		alert("가격을 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.price1.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.number2_from.value==""){
		alert("숫자를 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.number2_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.number2_to.value==""){
		alert("숫자를 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.number2_to.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if (frm.price2.value==""){
		alert("가격을 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.price2.focus();
					return false;
			} 
			ret = false;
		}	
	}

if (frm.number3_from.value==""){
		alert("숫자를 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.number3_from.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.price3.value==""){
		alert("가격을 입력하세요");
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
					
					alert("숫자만 입력 하세요");
					frm.price3.focus();
					return false;
			} 
			ret = false;
		}	
	}

	if(frm.number1_from.value >= frm.number1_to.value){
		alert("숫자를 다시 입력해주세요. 큰숫자가 뒤에 와야 합니다.");	
		frm.number1_to.focus();
		return false;
	}
	if(frm.number2_from.value - frm.number1_to.value != 1){
		alert("1큰 숫자가 입력되야 합니다.");	
		frm.number2_from.focus();
		return false;
	}
	if(frm.number2_from.value >= frm.number2_to.value){
		alert("숫자를 다시 입력해주세요. 큰숫자가 뒤에 와야 합니다.");	
		frm.number2_to.focus();
		return false;
	}
	if(frm.number3_from.value - frm.number2_to.value != 1){
		alert("1큰 숫자가 입력되야 합니다.");	
		frm.number3_from.focus();
		return false;
	}
	checkform1();
	if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	else frm.use_opt23.value = 'f';
	
	
	if (frm.op_name2.value==""){
		//alert("옵션2의 제목을 정하세요");
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
		//alert("옵션3의 제목을 정하세요");
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
		
		alert("삭제하실 옵션항목을 선택하십시요");		
	}
	
	function pro_del2(frm)
	{
		
		for(i=1;i<frm.opt2.options.length ;i++){
			if ( frm.opt2.options[i].selected){
				document.all.opt2.options[i] = null;
				return true;
			}
		}
		
		alert("삭제하실 옵션항목을 선택하십시요");		
	}

	function pro_del3(frm)
	{
		
		for(i=1;i<frm.opt3.options.length ;i++){
			if ( frm.opt3.options[i].selected){
				document.all.opt3.options[i] = null;
				return true;
			}
		}
		
		alert("삭제하실 옵션항목을 선택하십시요");		
	}




	function pro_add1(frm,pro,price)
	{

		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("옵션항목을 입력하세요.");
			frm.pro_value1.focus (); 
			return false;}
			
		else{	
				if (price=="" ) {


						e1.value = pro;
						e1.text= pro + "(기준가)" ;

							for(k=1;k<frm.opt1.options.length ;k++){
								if (e1.value == frm.opt1.options[k].value){
									alert ("존재하는 옵션항목입니다.다시 입력하세요.");
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
									e1.text= pro + "(" + price +"원)" ;

											for(k=1;k<frm.opt1.options.length ;k++){
												if (e1.value == frm.opt1.options[k].value){
													alert ("존재하는 옵션항목입니다.다시 입력하세요.");
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
									
									alert("차등한 가격기입에는 숫자만 가능합니다.");
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
			alert ("옵션항목을 입력하세요.");
			frm.pro_value2.focus (); 
			return false;}
			
		else{	

			e1.value = pro;
			e1.text= pro  ;

					for(k=1;k<frm.opt2.options.length ;k++){
						if (e1.value == frm.opt2.options[k].value){
							alert ("존재하는 옵션항목입니다.다시 입력하세요.");
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
			alert ("옵션항목을 입력하세요.");
			frm.pro_value3.focus (); 
			return false;}
			
		else{	
			e1.value = pro;
			e1.text= pro ;

					for(k=1;k<frm.opt3.options.length ;k++){
						if (e1.value == frm.opt3.options[k].value){
							alert ("존재하는 옵션항목입니다.다시 입력하세요.");
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

//*************************** 파일 업로드 창 ********************************************************************

function fileup(formname,imagename){
// formname : form 의 name
// mart_id : 상점 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "../file_upload.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** 파일 업로드 창 ********************************************************************
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
			<!--왼쪽부분시작-->
<?
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>공동구매 기본정보설정</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF"><strong>[슬라이드 공동구매 상품 수정]</strong> 상품을 수정합니다.</td>
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
											상품명</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_name" size="25" value='<?echo $item_name?>' class="input_03" style="width:90%">
										</td>
										<td width="15%" bgcolor="#DDC5E4" align="left">
											<p align="center">제조사</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_company" size="25" value='<?echo $item_company?>' class="input_03" style="width:90%">
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											시중가</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="price" size="25" value='<?echo $price?>' class="input_03" style="width:90%">
										</td>
										<td width="15%" bgcolor="#DDC5E4" align="left">
											<p align="center">상품코드</td>
										<td width="35%" bgcolor="#FFFFFF" align="center">
											
											<input name="item_code" size="25" value='<?echo $item_code?>' class="input_03" style="width:90%">
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">가격</td>
										<td width="85%" bgcolor="#FFFFFF" colspan="3">
											
											<table border="0" width="429">
												<tr>
												<td width="9" rowspan="4"></td>
												<td width="154">
													
													<input name="number1_from" size="3" value='<?echo $number1_from?>' class="input_03"> 
													~ 
													<input name="number1_to" size="3" value='<?echo $number1_to?>' class="input_03"> 
													개 까지
												</td>
												<td width="254">
													
													<input name="price1" size="25" value='<?echo $price1?>' class="input_03" class="aa"> 
													원
												</td>
												</tr>
												<tr>
												<td width="154">
													 
													
													<input name="number2_from" size="3" value='<?echo $number2_from?>' class="input_03"> 
													~ 
													
													<input name="number2_to" size="3" value='<?echo $number2_to?>' class="input_03"> 
													개 까지
												</td>
												<td width="254">
													
													<input name="price2" size="25" value='<?echo $price2?>' class="input_03" class="aa"> 
													원 
												</td>
												</tr>
												<tr>
												<td width="154">
													 
													
													<input name="number3_from" size="3" value='<?echo $number3_from?>' class="input_03"> 
													개 이상&nbsp;&nbsp; 
												</td>
												<td width="254">
													
													<input name="price3" size="25" value='<?echo $price3?>' class="input_03" class="aa"> 
													원 
												</td>
												</tr>
												<tr>
												<td width="408" colspan="2">
													 <br>
													<font color="#0000FF">총 3단계까지 가격을 책정하실 수 있습니다.<br>
													(예: 1~15개까지 10,000원/ 16~25개까지 8,500원/ 26개 이상 7,500원) </font>
													 
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										 <td width="15%" bgColor="#DDC5E4" align="center">결제방법</td>
										 <td width="85%" bgColor="#FFFFFF" align="center" colspan="4"><p
										 align="left"><input type="checkbox" value="1" name="if_cash"
										 <?
										 if($if_cash == '1') echo "checked";
										 ?>
										 >현금전용결제<br>
										 <font color="#C00000"> (현금전용 결제기능입니다. 타 상품과 같이 구매시, 
										 현금결제만 가능합니다.)</font><br>
										 </td>
									  </tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											등록된 제품이미지</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											<?
											if($img != ""){
												echo ("	
											<img src='$Co_img_DOWN$mart_id/$img' WIDTH='150' HEIGHT='144'>
												");
											}
											else{
												echo ("
											<span class='aa'>&nbsp;&nbsp;현재 등록된 이미지가 없습니다.
												");
											}
											?>
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">제품 이미지</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											&nbsp; 
											<input name="img" size="45" value='<?echo $img?>' class="input_03" readonly> 
											<input onclick="javascript:fileup('writeform','img');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="찾아보기"><br>
											<br>
											&nbsp; <font color="#0000FF">이미지사이즈는 가로 181 pixel x 세로 174 pixel 이 
											적당합니다.</font> 
										</td>
									</tr>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											아이콘 선택</td>
										<td width="85%" bgcolor="#FFFFFF" align="left" colspan="3">
											
											<input name="icon_no" type="radio" value="0"
											<?
											if($icon_no == 0) echo " checked";
											?>
											> 사용않음 
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
											<font color="#0000FF">신상품이나 추천상품 등 강조하고 싶은 상품에 
											아이콘을 선택하세요.<br>
											모든 상품에 다 넣을 경우 자칫 산만해질 수도 있으니 꼭 필요한 
											상품에만 <br>
											선택하세요.</font>
										</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#DDC5E4" align="center" colspan="4">
											상품설명</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#FFFFFF" align="center" colspan="4">
											
											<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
											<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
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
											 가격동일 옵션사용
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
											옵션제목 1</td>
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
											옵션항목 1</td>
										<td width="25%" bgcolor="#FFFFFF" align="center">
											<input name="pro_value2" size="25" class="input_03" style="width:90%"></td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#FFFFFF" align="center" colspan="2">
											<input onclick="pro_add2(this.form,document.all.pro_value2.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="입력"> 
											<input onclick="pro_del2(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제"></td>
									</tr>
									<?
								if(isset($opts[2]) && $opts[2] != ""){
										$op3 = explode("!", $opts[2]);
										$op3_count = count($op3);
									}
									?>
									<tr>
										<td width="15%" bgcolor="#DDC5E4" align="center">
											옵션제목 2</td>
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
											옵션항목 2</td>
										<td width="25%" bgcolor="#FFFFFF" align="center"><input name="pro_value3" size="25" class="input_03" style="width:90%"></td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#FFFFFF" align="center" colspan="2">
											<input onclick="pro_add3(this.form,document.all.pro_value3.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="입력"> 
											<input onclick="pro_del3(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
										</td>
									</tr>
									<tr>
										<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
											<table border="0" width="80%">
												<tr>
												<td width="100%"><p align="center">
													<font color="#0000FF">옵션 선택 
													사용 설명</font></td>
												</tr>
												<tr>
												<td width="100%">
													제품의 옵션을 설정하는 부분으로써 동일
													가격의 옵션을 적용할 수 있습니다. <br>먼저
													가격동일 옵션을 사용하실건지를 선택하세요.<br>
													<br>
													1. 가격동일 옵션사용의 경우<br>
													예)가격은 동일하되 사이즈 및 색상이 다를 경우,<br>
													옵션제목 1: 사이즈, 옵션항목 1: <font color="#FF0000">55,66</font> |
													옵션제목 2 : 색상, 옵션항목 2 : <font color="#FF0000">레드, 블랙</font><br>
													우측화면에 입력한 항목이 출력됩니다.<br>
													옵션항목의 55, 66/ 레드, 블랙은 각각 따로 입력하셔야 합니다.
												</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="50%" bgcolor="#DDC5E4" align="center" colspan="2">
											등록일</td>
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
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료"> 
						<input onclick="re_init()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="재입력"> 
						<input onclick="window.location.href='union_slide_item_list.php?union_no=<?echo $union_no?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
					</td>
					</tr>
</form>
				</table>

<br>
			<!--내용 END~~-->
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
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
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