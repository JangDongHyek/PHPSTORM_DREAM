<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_zoom_module = $ary[item_zoom_module];
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary[if_gnt_item];
}

if ($flag == "") {

$SQL = "select * from $ItemTable where item_no = $item_no and mart_id='$mart_id'";

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);

	$provider_id = $ary[provider_id];
	$category_num = $ary[category_num];
	$item_name = $ary[item_name];
	$price = $ary[price];
	$z_price = $ary[z_price];
	$member_price = $ary[member_price];
	$g_margin = $ary[g_margin];
	$bonus = $ary[bonus];
	$use_bonus = $ary[use_bonus];
	$jaego = $ary[jaego];
	$img = $ary[img];
	$img_big = $ary[img_big];
	$opt = $ary[opt];
	$doctype = $ary[doctype];
	$item_explain = htmlspecialchars($ary[item_explain], ENT_QUOTES);
	$short_explain = $ary[short_explain];
	$reg_date = $ary[reg_date];
	$item_company = $ary[item_company];
	$item_code = $ary[item_code];
	$icon_no = $ary[icon_no];
	$use_opt1 = $ary[use_opt1];
	$use_opt23 = $ary[use_opt23];
	$jaego_use = $ary[jaego_use];
	$if_strike = $ary[if_strike];
	$if_provide_item = $ary[if_provide_item];
	$provide_price = $ary[provide_price];
	$img_sml = $ary[img_sml];
	$flash_big_width = $ary[flash_big_width];
	$flash_big_height = $ary[flash_big_height];
	$if_hide = $ary[if_hide];
	$img_high = $ary[img_high];
	$if_cash = $ary[if_cash];
	
	$opts = explode("=", $opt);
}
?>
<?
	include "../admin_head.php";
?>
<script language="JavaScript">
function checkform(frm)
{
	if(frm.item_name.value==""){alert("\n상품이름을 입력하세요.");frm.item_name.focus();return false;}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	
	
	var Digit = '1234567890'

	/*
	if (frm.price.value==""){
		alert("소비자가를 입력하세요");
		frm.price.focus();
		return false;
	}
	else{
		var len =frm.price.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = frm.price.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력 하세요");
					frm.price.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	*/
	if (frm.z_price.value==""){
		alert("판매가를 입력하세요");
		frm.z_price.focus();
		return false;
	}
	else{
		var len =frm.z_price.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = frm.z_price.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력 하세요");
					frm.z_price.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	
	if (frm.member_price.value!=""){
	
		var len =frm.member_price.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		    var ch = frm.member_price.value.substring(i,i+1);
		
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
					
					alert("숫자만 입력 하세요");
					frm.member_price.focus();
					return false;
			}
			ret = false;
		}	
	}
	if (frm.bonus.value==""){
		alert("마일리지를 입력하세요");
		frm.bonus.focus();
		return false;
	}
	else{
		var len =frm.bonus.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = frm.bonus.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력 하세요");
					frm.bonus.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	if(frm.jaego_use[0].checked){
		
		if (frm.jaego.value==""){
			alert("재고량을 입력하세요");
			frm.jaego.focus();
			return false;
		}
		else{
			var len =frm.jaego.value.length;
			var ret;
			ret =false;		
			for(var i=0;i<len;i++){  
			    var ch = frm.jaego.value.substring(i,i+1);
			    
				for (var k=0;k<=Digit.length;k++){				
					
					if(Digit.substring(k,k+1) == ch)
					{					
						ret = true;
						break;					
					}
				}	
				 
				if (!ret){
						
						alert("숫자만 입력 하세요");
						frm.jaego.focus();
						return false;
				} 
				ret = false;
			}	
		
		}
	}
	<?
	if($if_gnt_item == 1){
	?>
	if(frm.if_provide_item[0].checked){
		
		if (frm.provide_price.value==""){
			alert("공급가를 입력하세요");
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
						
						alert("숫자만 입력 하세요");
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
	checkform1();
	if(frm.use_opt1_chk.checked) frm.use_opt1.value = 't';
	else frm.use_opt1.value = 'f';
	
	if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	else frm.use_opt23.value = 'f';
	
	
	if (frm.op_name1.value ==""){
		//alert("옵션1의 제목을 정하세요");
		//frm.op_name1.focus();
		//return false;
	}
	else{
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

	//frm.submit();
	return true;
}

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




	function pro_add1(frm,pro,price,bonus,mem_price)
	{

		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("옵션항목을 입력하세요.");
			frm.pro_value1.focus (); 
			return false;
		}
			
		else{	
				if (price=="" ) {

					alert ("가격을 입력하세요.");
					frm.pro_price1.focus();
					return false;
	
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
						
						e1.value = pro + "^" + price;
						e1.text= pro + "(" + price +"원)" ;
									
						
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
										
										alert("마일리지에는 숫자만 가능합니다.");
										frm.pro_bonus1.focus();
										return false;
								}
								ret = false;
							}
							
						}
						e1.value = e1.value + "^" + bonus;
						e1.text= e1.text + "M:" + bonus +"원" ;		
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
										
										alert("회원가에는 숫자만 가능합니다.");
										frm.mem_price.focus();
										return false;
								}
								ret = false;
							}
						}
						e1.value = e1.value + "^" + mem_price;
						e1.text= e1.text + "S:" + mem_price +"원" ;
				}		
		}


		

		document.all.opt1.add(e1);
		frm.pro_value1.value ="";		
		frm.pro_price1.value ="";
		frm.pro_bonus1.value ="";
		frm.pro_mem_price1.value ="";						
		frm.pro_value1.focus (); 		
	}



	function pro_add2(frm,pro)
	{
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
<!--
function opensub2(x)
{	 
	var child;
	window.open(x,'x' ,'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,width=800,height=200,left=0,top=0');
}
// -->    
</script>
<script language="javascript">

//*************************** 파일 업로드 창 ********************************************************************

function fileup(formname,imagename){
// formname : form 의 name
// mart_id : 홈페이지 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename
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
}
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
//콤마 넣기(정수만 해당) 
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

//문자열에서 숫자만 가져가기 
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
//숫자만 입력하기 
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
//마진 계산하기
function cal(){
	var here = document.writeform;
	var tot; 
	tot = Math.ceil( ( ( here.z_price.value * here.g_margin.value ) / 100 ) / 10 ) * 10;
	here.member_price.value=tot;
	here.bonus.focus();
}
</script>
</head>

<body onload=HandleLoad() bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="646" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="646" bgcolor="#FFFFFF">
    	<div align="center"><center>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><strong>[상품 수정]</strong> 상품을 수정합니다.<br>
        		<br>
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
        	<td width="100%" bgcolor="#FFFFFF" valign="top">
        		<div align="center"><center>
        		<table border="0" width="95%">
          		
          		<form action='win_item_edit.php' method="post" name=writeform onsubmit="return checkform(this)">
							<input type="hidden" name="flag" value="update">
							<input type="hidden" name="img_sml_updateflag">
							<input type="hidden" name="img_updateflag">
							<input type="hidden" name="img_big_updateflag">
							<input type="hidden" name="img_high_updateflag">
							
							<input type="hidden" name="item_no" value="<?echo $item_no?>">
							<input type="hidden" name="category_num" value="<?echo $category_num?>">
							<input type="hidden" name="prevno" value="<?echo $prevno?>">
							<input type="hidden" name="op1" value="">
							<input type="hidden" name="op2" value="">
							<input type="hidden" name="op3" value="">
							<input type="hidden" name="doctype" value="0">
							<input type="hidden" name="opt">
							<input type="hidden" name="item_explain" value="<?echo $item_explain?>">
							<input type="hidden" name="use_opt1">
							<input type="hidden" name="use_opt23">
							<input type="hidden" name="reg_date" value='<?echo $reg_date?>'>
							<input type="hidden" name="page" value='<?echo $page?>'>
							<input type="hidden" name="img_sml_old" value='<?echo $img_sml?>'>
							<input type="hidden" name="img_old" value='<?echo $img?>'>
							<input type="hidden" name="img_big_old" value='<?echo $img_big?>'>
							<input type="hidden" name="img_high_old" value='<?echo $img_high?>'>
							<input type="hidden" name="searchword" value='<?echo $searchword?>'>
							<?
              	if($if_gnt_item == 0){
              		echo ("
              	<input type='hidden' name='provide_price' value='$provide_price'>	
              		");
              	}	
              	?>
              			
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				상품명</td>
                			<td width="32%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_name" size="14" value="<?echo $item_name?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="18%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<p align="center">제조사</td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_company" size="14" value="<?echo $item_company?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
                				공급사
							</td>
                			<td bgcolor="#FFFFFF" colspan="4">
								<select name="provider_id" class='input'>
									<option value="">공급사 선택안함</option>
<?
$sql5 = "select * from $MemberTable where perms='3' order by name asc";
$res5 = mysql_query( $sql5, $dbconn );
$tot5 = mysql_num_rows( $res5 );
if( !$tot5 ){
?>
									<option value="">등록된 공급사 가 없습니다.</option>
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
              			</tr>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">
								소비자가 <input disabled type="checkbox" value="1" name="if_strike">
							</td>
			                <td bgColor="#ffffff">
								<input name="price" value='<?=$price?>'  class='input' size="14">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								상품코드
							</td>
			                <td bgColor="#ffffff">
								<input name="item_code" value='<?=$item_code?>' class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#c8dfec" colSpan="2">
								재고관리
							</td>
			                <td bgColor="#ffffff">
								<input type="radio" value="1" name="jaego_use" <?if($jaego_use == 1) echo " checked";?>>사용 함 
								<input type="radio" value="0" name="jaego_use" <?if($jaego_use == 0) echo " checked";?>>사용 하지 않음
							</td>
			                <td  bgColor="#c8dfec" colspan="2" align="center">
								재고량
							</td>
			                <td bgColor="#ffffff">
								<input name="jaego" value='<?=$jaego?>'  class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								판매가
							</td>
			                <td bgColor="#ffffff">
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								마 진
							</td>
			                <td bgColor="#ffffff">
								<input name="g_margin" value='<?=$g_margin?>' class='input' size="5" onChange='cal()' onKeyDown="checkNumber()"> %
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								공급가
							</td>
			                <td bgColor="#ffffff">
								<input name="member_price" value="<?=$member_price?>"  class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								마일리지
							</td>
			                <td bgColor="#ffffff">
								<input name="bonus" value="<?=$bonus?>"  class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><br>
			                <font color="#0000ff">소비자가는 홈페이지에 출력되지 않습니다.<br>
			                판매가, 회원가, 마일리지는 숫자만 입력하시고, 마일리지를 
			                지급하지 않을 경우 &quot;0&quot;을 입력하세요.<br>
			                상품등록시 개별적으로 회원가를 입력하시면 기본설정에서 설정한 회원가는 해당상품에 대해<br>
											적용되지 않습니다.</font><br>
			                <br>
			                </td>
			              </tr>
              			<?
              			if($if_gnt_item == 1){
              			?>
              			<tr>
                			<td align="middle" width="15%" bgColor="#c8dfec" colspan="2">
                				공급여부</td>
                			<td align="middle" width="32%" bgColor="#ffffff">
                				
                				<input type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>가능 
                				<input type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>불가능</td>
                			<td align="left" width="18%" bgcolor="#c8dfec" colspan="2">
                				<p align="center">공급가</td>
                			<td align="middle" width="35%" bgcolor="#ffffff">
                				
                				<input style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14" name="provide_price" value='<?echo $provide_price?>'></td>
              			</tr>
              			<?
              			}
              			?>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2" rowspan="2">
			                등록된<br>
			                제품<br>
			                이미지</td>
			                <td align="left" width="26%" bgColor="#e6f0f7"><p align="center">
			                &nbsp;&nbsp;메인/리스트&nbsp;</td>
			                <td align="center" width="32%" bgColor="#e6f0f7" colspan="2">
			                &nbsp; &nbsp;상세설명</td>
			                <td align="center" width="29%" bgColor="#e6f0f7">
			                &nbsp;확대이미지</td>
			              </tr>
			              <tr>
			                <td align="left" width="26%" bgColor="#ffffff">
			                <p align="center">
			                <?
					      			if($img_sml != '' && file_exists("$Co_img_UP$mart_id/$img_sml")){
				      					if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id/$img_sml' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id/$img_sml' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			                <td align="center" width="32%" bgColor="#ffffff" colspan="2">
			                <?
					      			if($img != '' && file_exists("$Co_img_UP$mart_id/$img")){
				      					if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id/$img' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id/$img' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			                <td align="center" width="29%" bgColor="#ffffff">
			                <?
					      			if($img_big != '' && file_exists("$Co_img_UP$mart_id/$img_big")){
				      					if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id/$img_big' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img_big,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id/$img_big' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			              </tr>
			              <tr>
			                <td align="middle" width="8%" bgColor="#c8dfec" rowspan="3">
			                제품<br>
			                이미지</td>
			                <td align="middle" width="7%" bgColor="#E8F1F7">메인/리스트</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img_sml" value='<?echo $img_sml?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img_sml');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기">
			                &nbsp; </td>
			              </tr>
			              <tr>
			                <td align="middle" width="7%" bgColor="#E8F1F7">
			                상세설명</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img" value='<?echo $img?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기">
			                &nbsp; </td>
			              </tr>
			              <tr>
			                <td align="middle" width="7%" bgColor="#E8F1F7">
			                확대이미지</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img_big" value='<?echo $img_big?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img_big');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기">
			                &nbsp; <br>
			                플래쉬 가로길이
			                <input name="flash_big_width" value='<?echo $flash_big_width?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="3">&nbsp;&nbsp;&nbsp; 
			                세로길이
			                <input name="flash_big_height" value='<?echo $flash_big_height?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="3">&nbsp;&nbsp;&nbsp; <br>
			                <font color="#0000ff">플래쉬 파일을 올릴경우 가로와, 세로 길이를 입력해주세요.단위는 
			                px 입니다.</font> </td>
			              </tr>
			              <tr>
			                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><p
			                align="left"><img height="15" src="../images/tip.gif" width="30"> <font
			                color="#0000ff">
			                이미지는 jpg,gif,swf를 지원합니다.<br>
			                메인/리스트 화면의 사이즈는 100*100 px 고정입니다.<br>
			                상세설명 페이지의 사이즈는 180*180 px 고정입니다.<br>
			                확대이미지의 권장사이즈는 400*400 px이고, 임의대로 사이즈조정 
			                가능합니다.<br>
			                메인/리스트/상세설명은 50kb, 확대이미지의 용량은 100kb를 넘을 수 
			                없습니다.</font></td>
			              </tr>
			              <tr>
		                <td align="middle" width="8%" bgColor="#c8dfec">고화질<br>
		                이미지</td>
		                <td align="middle" width="94%" bgColor="#FFFFFF" colspan="5"><p align="left">
		                　
		                <input name="img_high" value='<?echo $img_high?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
		                <input onclick="javascript:fileup('writeform','img_high');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기"> 
		                &nbsp; <br>
		                </td>
		              </tr>
		              <tr>
		                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><font
		                color="#0000ff"><p align="left"></font><img height="15" src="../images/tip.gif"
		                width="30"> <font color="#0000ff">고화질 이미지는 이미지줌프로그램을 
		                이용하여 제작한 이미지(icp,ixf)를 업로드할 수 있습니다.<br>
		                이미지 용량은 300kb를 넘을 수 없습니다.<br>
		                고화질 이미지를 사용하실 경우에는 확대이미지는 적용되지 않습니다.</font></td>
		              </tr>
			              <tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				아이콘 선택</td>
                			<td width="85%" bgcolor="#FFFFFF" align="left" colspan="4">
                				
                				<input name="icon_no" type="radio" value="0"
                				<?
                				if($icon_no == 0) echo " checked"
                				?>
                				>
                				<font color="#0000FF">사용않음</font>
                				<input name="icon_no" type="radio" value="1"
                				<?
                				if($icon_no == 1) echo " checked"
                				?>
                				>
                				<img src="../images/hot.gif" WIDTH="22" HEIGHT="13">
                				<input name="icon_no" type="radio" value="2"
                				<?
                				if($icon_no == 2) echo " checked"
                				?>
                				>
                				<img src="../images/new.gif" WIDTH="22" HEIGHT="13">
                				<input name="icon_no" type="radio" value="3"
                				<?
                				if($icon_no == 3) echo " checked"
                				?>
                				>
                				<img src="../images/sale.gif" WIDTH="22" HEIGHT="13"><br>
                				<font color="#0000FF">신상품이나 추천상품 등 강조하고 싶은 상품에 
                				아이콘을 선택하세요.<br>
                				모든 상품에 다 넣을 경우 자칫 산만해질 수도 있으니 꼭 필요한 
                				상품에만 <br>
                				선택하세요.</font>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				상품설명</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				
                				<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">에디터 
        						<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML 직접입력 
                				<table>
                  				<tr>
          						<td width="100%" bgcolor="#FFFFFF"><p align="center">
          							<OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet></OBJECT>
          						</td>
								</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				옵션사용</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk"
                				<?
                				if($use_opt1 == 't') echo " checked";
                				?>
                				>
                				 가격차등 옵션사용</td>
              			</tr>
              			<?
        				if(isset($opts[0]) && $opts[0] != ""){
	            			$op1 = explode("!", $opts[0]);
	            			$op1_count = count($op1);
	            			$op1_1 = explode("^", $op1[0]);
	            		}
	            		?>	
	            		<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 </td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name1" size="14" value='<?echo $op1_1[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="6">
                				<select name="opt1" size="2" style="WIDTH: 250">
          						<option>-------------------------------------</option>
        						<?
	            				for($i=1;$i< $op1_count;$i++){
	            					$op1_1 = explode("^", $op1[$i]);
	            					if(!empty($op1_1[2])) $bonus_str = "M:".$op1_1[2]."원";
	            					else $bonus_str = '';
	            					
	            					if(!empty($op1_1[3])) $mem_price_str = "S:".$op1_1[3]."원";
	            					else $mem_price_str = '';
	            					echo ("
	            				<option value='$op1[$i]'>$op1_1[0]($op1_1[1] 원)$bonus_str $mem_price_str</option>
	            					");
	            				}
	            				?>		
	            				</select><br>
	            				M: 마일리지 S: 회원가
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목</td>
                			<td width="32%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_value1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				가격입력</td>
                			<td width="32%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				마일리지입력</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_bonus1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				회원가입력</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_mem_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add1(this.form,document.all.pro_value1.value,document.all.pro_price1.value,document.all.pro_bonus1.value,document.all.pro_mem_price1.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="입력"> 
                				<input  onclick="pro_del1(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
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
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 1</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name2" size="14" value='<?echo $op2[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="53%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="3">
                				<p align="center">
                				<select name="opt2" size="2" style="WIDTH: 150;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
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
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목 1</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				<input name="pro_value2" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
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
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 2</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name3" size="14" value='<?echo $op3[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="53%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="3">
                				<p align="center">
                				<select name="opt3" size="2" style="WIDTH: 150;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
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
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목 2</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="pro_value3" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
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
                    					가격의 옵션적용, 차등 가격의 옵션을 적용할 수 있습니다. 먼저 
                    					가격차등 옵션사용인지 가격동일 옵션사용인지를 선택하세요.<br>
                    					<br>
                    					1. 가격차등 옵션사용의 경우<br>
                    					예)사이즈에 따라 가격이 달라지는 경우, <br>
                    					옵션제목: 사이즈, 옵션항목: 55, 가격입력 : 5000 | 옵션항목 : 66, 
                    					가격입력 : 6000<br>
                    					우측화면에 입력한 항목이 출력됩니다.<br>
                    					<br>
                    					2. 가격동일 옵션사용의 경우<br>
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
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">
                				등록일</td>
                			<td width="53%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<p align="center"><?echo $reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">홈페이지출력유무</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                			<input type="radio" name="if_hide" value="0"
                			<?
                			if($if_hide=='0') echo "checked";
                			?>
                			>
                			 홈페이지에 출력함 <br>
                			<input type="radio" value="1" name="if_hide"
                			<?
                			if($if_hide=='1') echo "checked";
                			?>
                			>홈페이지에 출력하지않음 <br>
                			&nbsp; (등록은 되지만, 홈페이지에 출력되지는 않습니다)</td>
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
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료"> 
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
        		<input onclick="window.close()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="닫기">
        	</td>
      	</tr>
      	
      	</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
</body>
</html>
<?
}
else if($flag == "update"){
	$opt = $op1."=".$op2."=".$op3;
	
	if(isset($img_sml)&&($img_sml != "")){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_sml_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // 삭제...
				}
			}
			
			$img_sml_new = "item_sml_".$item_no."_".$img_sml; // 화일 이픔 새로 짖고
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//새 파일 저장
		}
		else{
			$img_sml_new = $img_sml;
		}
		
	}
	else{ // 소사이즈 이미지 빈칸..
		// 이전 소사이즈 이미지 있으면 삭제.
		if($img_sml_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){
				unlink("$Co_img_UP$mart_id/$img_sml_old");
			}
		}
	}
	
	if(isset($img_big)&&($img_big != "")){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if($img_big_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // 삭제...
				}
			}
			
			$img_big_new = "item_big_".$item_no."_".$img_big; // 화일 이픔 새로 짖고
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // 화일 있는지 확인하고
				copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//새 파일 저장
		}
		else{
			$img_big_new = $img_big;
		}
		
	}
	else{ // 대사이즈 이미지 빈칸..
		// 이전 대사이즈 이미지 있으면 삭제.
		if($img_big_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big_old")){
				unlink("$Co_img_UP$mart_id/$img_big_old");
			}
		}
	}
	
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_old"); // 삭제...
				}
			}
			
			$img_new = "item_".$item_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//새 파일 저장
		}
		else{
			$img_new = $img;
		}
		
	}
	else{ // 중사이즈 이미지 빈칸..
		// 이전 중사이즈 이미지 있으면 삭제.
		if($img_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_old")){
				unlink("$Co_img_UP$mart_id/$img_old");
			}
		}
	}
	
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			
			if($img_high_old !=""){ // 기존 화일 있는가?
				if(file_exists("$Co_img_UP$mart_id/$img_high_old")){ // 화일 있으면...
					unlink("$Co_img_UP$mart_id/$img_high_old"); // 삭제...
				}
			}
			
			$img_high_new = "item_high_".$item_no."_".$img_high;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//새 파일 저장
		}
		else{
			$img_high_new = $img_high;
		}
		
	}
	else{ // 중사이즈 이미지 빈칸..
		// 이전 중사이즈 이미지 있으면 삭제.
		if($img_high_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_high_old")){
				unlink("$Co_img_UP$mart_id/$img_high_old");
			}
		}
	}
	
	if(isset($img_sml)&&($img_sml != "")){ // 화일 입력난이 공란아니고
		if($img_sml_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_sml");	//임시 파일 삭제
		}
	}
	if(isset($img_big)&&($img_big != "")){ // 화일 입력난이 공란아니고
		if($img_big_updateflag=="ok"){ // 화일 업데이트 되었고..
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // 화일 있는지 확인하고
				unlink ("$Co_img_UP$mart_id/$img_big");	//임시 파일 삭제
		}
	}
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img"))
				unlink ("$Co_img_UP$mart_id/$img");	//임시 파일 삭제
		}
	}
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				unlink ("$Co_img_UP$mart_id/$img_high");	//임시 파일 삭제
		}
	}
	$SQL = "update $ItemTable set category_num='$category_num', item_name='$item_name', price='$price', z_price='$z_price', g_margin='$g_margin', member_price='$member_price', bonus='$bonus', use_bonus='$use_bonus', jaego='$jaego', img ='$img_new', img_big='$img_big_new', opt='$opt', doctype='$doctype', item_explain='$item_explain', short_explain='$short_explain', reg_date='$reg_date', item_company ='$item_company', item_code='$item_code', icon_no='$icon_no', use_opt1='$use_opt1', use_opt23='$use_opt23', jaego_use='$jaego_use', if_strike='$if_strike', if_provide_item='$if_provide_item', provider_id='$provider_id', provide_price='$provide_price',	img_sml='$img_sml_new', flash_big_width='$flash_big_width', flash_big_height='$flash_big_height', if_hide='$if_hide', img_high='$img_high', if_cash='$if_cash' where item_no='$item_no' and mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn);

	echo "
	<script>
	window.opener.location.reload();
	window.close();
	</script>
	";
}
?>	
<?
mysql_close($dbconn);
?>