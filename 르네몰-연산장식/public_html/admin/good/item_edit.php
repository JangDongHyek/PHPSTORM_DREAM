<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$cur_category_name = category_navi($category_num);

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
	$if_customer_price = $ary["if_customer_price"];
}

$SQL = "select * from $ItemTable where item_no='$item_no' and mart_id='$mart_id'";
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
	$img_big2 = $ary[img_big2];
	$img_big3 = $ary[img_big3];
	$img_big4 = $ary[img_big4];
	$img_big5 = $ary[img_big5];
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
	$fee = $ary[fee];
	$parcel_price=$ary[parcel_price];
	$opts = explode("=", $opt);
	$parcel_price=$ary[parcel_price];
	$short_explain = eregi_replace( "<br>", "", $short_explain );
	$gibon = $ary[gibon];
	$search_word = $ary[search_word];
	
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){alert("\n상품이름을 입력하세요.");frm.item_name.focus();return false;}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	var Digit = '1234567890'

	if (frm.z_price.value==""){
		alert("판매가를 입력하세요");
		frm.z_price.focus();
		return false;
	}

	oEditors.getById["item_explain"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	var content=oEditors.getById["item_explain"].getIR();
	content=content.replace("<P>&nbsp;</P>","");
	if (content== "" ){ 
		 alert("내용을 입력하세요."); 
		 oEditors.getById["item_explain"].exec("FOCUS", []); 
		return false;
	}

	/*if (frm.member_price.value==""){
		alert("공급가를 입력하세요");
		frm.member_price.focus();
		return false;
	}*/

		//if(frm.jaego_use[0].checked){
	//	if (frm.jaego.value==""){
	//		alert("재고량을 입력하세요");
	//		frm.jaego.focus();
	//		return false;		
	//	}
	//}
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

	//checkform1();
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

	if(!editor_wr_ok())
	{
		return false;
	}
	
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
										
										alert("포인트에는 숫자만 가능합니다.");
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


function pro_add2(frm,pro,pro_price)
	{
		var e1=document.createElement("OPTION")



		if (pro=="" ){ 
			alert ("옵션항목을 입력하세요.");
			frm.pro_value2.focus (); 
			return false;
		}else{	

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

			e1.value = e1.value + "^" + pro_price;
			e1.text= e1.text + "S:" + pro_price +"원" ;


		document.all.opt2.add(e1);
		frm.pro_value2.value =""	
		frm.pro_price2.value =""		
		frm.pro_value2.focus (); 		

    //DesSet();

		}


	}


function pro_add3(frm,pro,pro_price)
	{
		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("옵션항목을 입력하세요.");
			frm.pro_value3.focus (); 
			return false;
		}	
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
			e1.value = e1.value + "^" + pro_price;
			e1.text= e1.text + "S:" + pro_price +"원" ;

		
		document.all.opt3.add(e1);
		frm.pro_value3.value =""
		frm.pro_price3.value =""		
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

//*************************** 파일 업로드 창 ******************************************************************

function fileup(formname,imagename){
// formname : form 의 name
// mart_id : 상점 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** 파일 업로드 창 *******************************************************************
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>현재카테고리 : <?=$cur_category_name?></b></td>
				</tr>
			</table>

			<!--내용 START~~-->   	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px"><b>[상품 수정]</b> 상품을 수정합니다.<br><br>
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
          		<form action='item_modify.php?item_no=<?=$item_no?>&flag=update&page=<?=$page?>&searchword=<?=$searchword?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&pu=<?=$pu?>' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="img_sml_updateflag">
				<input type="hidden" name="img_updateflag">
				<input type="hidden" name="img_big_updateflag">
				<input type="hidden" name="img_big2_updateflag">
				<input type="hidden" name="img_big3_updateflag">
				<input type="hidden" name="img_big4_updateflag">
				<input type="hidden" name="img_big5_updateflag">
				<input type="hidden" name="img_high_updateflag">
				<input type="hidden" name="item_no" value="<?=$item_no?>">
				<input type="hidden" name="category_num" value="<?=$category_num?>">
				<input type="hidden" name="prevno" value="<?=$prevno?>">
				<input type="hidden" name="op1" value="">
				<input type="hidden" name="op2" value="">
				<input type="hidden" name="op3" value="">
				<input type="hidden" name="doctype" value="0">
				<input type="hidden" name="opt">
				<!--<input type="hidden" name="item_explain" value="<?=$item_explain?>">-->
				<input type="hidden" name="use_opt1">
				<input type="hidden" name="use_opt23">
				<input type="hidden" name="reg_date" value='<?=$reg_date?>'>
				<input type="hidden" name="img_sml_old" value='<?=$img_sml?>'>
				<input type="hidden" name="img_old" value='<?=$img?>'>
				<input type="hidden" name="img_big_old" value='<?=$img_big?>'>
				<input type="hidden" name="img_big2_old" value='<?=$img_big2?>'>
				<input type="hidden" name="img_big3_old" value='<?=$img_big3?>'>
				<input type="hidden" name="img_big4_old" value='<?=$img_big4?>'>
				<input type="hidden" name="img_big5_old" value='<?=$img_big5?>'>
				<input type="hidden" name="img_high_old" value='<?=$img_high?>'>
				<input type="hidden" name="searchword" value='<?=$searchword?>'>
				<input type="hidden" name="provider_id" value="<?=$Mall_Admin_ID?>">
				<input type="hidden" name="old_z_price" value="<?=$z_price?>">
				<input type="hidden" name="old_item_name" value="<?=$item_name?>">

<?
if($if_gnt_item == 0){
?>
				<input type='hidden' name='provide_price' value='$provide_price'>	
<?
}
?>
              			
          		<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				상품명
							</td>
                			<td width="32%" bgcolor="#FFFFFF">
                				<input name="item_name" size="25" value="<?=$item_name?>" class='input'>
							</td>
                			<td width="18%" bgcolor="#C8DFEC" colspan='2' align="center">
								제조사
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input name="item_company" size="25" value="<?=$item_company?>" class='input'>
							</td>
              			</tr>
              			<!-- <tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
                				공급사(입점몰)
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
              			</tr> -->
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">
								소비자가 <input type="checkbox" value="1" name="if_strike" <?
						if($if_customer_price != '1') echo " disabled";
						if($if_strike == "1") echo " checked";
						?>>
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
								공급가
							</td>
			                <td bgColor="#ffffff">
								<input name="member_price" value="<?=$member_price?>"  class='input' size="14" onKeyDown="checkNumber()">
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
								판매가
							</td>
			                <td bgColor="#ffffff">
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()" onkeyup="this.value=comma(this.value);">
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								포인트
							</td>
			                <td bgColor="#ffffff">
								<input name="bonus" value="<?=$bonus?>"  class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								배송정보
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="radio" value="무료배송" name="fee" <?if($fee=="무료배송"){ echo "checked";}?>>무료배송 <input type="radio" value="착불" name="fee" <?if($fee=="착불"){ echo "checked";}?>>착불 <input type="radio" value="" name="fee" <?if($fee==""||$fee=="선불"){ echo "checked";}?>>선불
								<input type="radio" value="고객선택" name="fee" <?if($fee=="고객선택"){ echo "checked";}?>>고객선택
							</td>
			              </tr>
						  <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								택배비
							</td>
			                <td bgColor="#ffffff" >
								<input name="parcel_price" value="<?=$parcel_price?>" onkeydown="checkNumber()" class='input' size="14">
							</td>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								수량
							</td>
			                <td bgColor="#ffffff" colspan="2">
								<input name="gibon" value="<?=$gibon?>"  class='input' size="5">개
							</td>

			              </tr>
			              <tr>
			                <td align="center" bgColor="#c8dfec" colSpan="2">
								결제방법
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="checkbox" value="1" name="if_cash" <?if($if_cash == '1') echo "checked";?>>현금전용결제<br>
								<font color="#C00000"> (현금전용 결제기능입니다. 타 상품과 같이 구매시, 현금결제만 가능합니다.)</font><br>
							</td>
			              </tr>
						  <tr>
			                <td align="center" bgColor="#c8dfec" colSpan="2">
								연관검색어
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<textarea name="search_word" style="width:100%; height:80px;"><?=$search_word?></textarea>
								<p>※ 너무 많은 검색어를 입력하시면 오류가 발생합니다.<br/>※ 예) 옷걸이,옷 걸이,걸이<br/>※ 콤마(,)로 분류를 해주세요! 그리고 콤마(,) 앞뒤에 띄어쓰기 사용은 불가능합니다.</p>
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#ffffff" colSpan="6">
								<br><font color="#0000ff">소비자가는 상점에 출력되지 않습니다.<br>
								판매가, 회원가, 포인트는 숫자만 입력하시고, 포인트를 
								지급하지 않을 경우 &quot;0&quot;을 입력하세요.<br>
								상품등록시 개별적으로 회원가를 입력하시면 기본설정에서 설정한 회원가는 해당상품에 대해<br>적용되지 않습니다.</font><br><br>
			                </td>
			              </tr>        			
<?
if($if_gnt_item == 1){
?>
              			<tr>
                			<td align="center" bgColor="#c8dfec" colspan="2">
                				공급여부
							</td>
                			<td bgColor="#ffffff">
                				<input  class='input' type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>가능 
                				<input  class='input' type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>불가능
							</td>
                			<td bgcolor="#c8dfec" colspan="2" align="center">
								공급가
							</td>
                			<td bgcolor="#ffffff">
                				<input  class='input' size="14" name="provide_price" value='<?=$provide_price?>'>
							</td>
              			</tr>
<?
}
?>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">
								등록된<br>제품<br>이미지
							</td>
			                <td width="85%" bgColor="#e6f0f7" colspan='4'>
								<table width='100%' border='0' bgcolor='#FFFFFF'>
									<tr>
										<td width='12.5%'>리스트</td>
										<td width='12.5%'>상세설명</td>
										<td width='12.5%'>확대1</td>
										<td width='12.5%'>확대2</td>
										<td width='12.5%'>확대3</td>
										<td width='12.5%'>확대4</td>
										<td width='12.5%'>확대5</td>
										<td width='12.5%'>메인</td>
									</tr>
									</tr>
									<tr>
										<td>
<?
if($img_sml != '' && file_exists("$Co_img_UP$mart_id/$img_sml")){
	if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img != '' && file_exists("$Co_img_UP$mart_id/$img")){
	if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img' width='50' height='50'></embed>
		";
	}
}
?>
										</td>
										<td>
<?
if($img_big != '' && file_exists("$Co_img_UP$mart_id/$img_big")){
	if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_big' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_big,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_big' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img_big2 != '' && file_exists("$Co_img_UP$mart_id/$img_big2")){
	if (strstr(strtolower(substr($img_big2,-4)),'.jpg') || strstr(strtolower(substr($img_big2,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_big2' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_big2,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_big2' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img_big3 != '' && file_exists("$Co_img_UP$mart_id/$img_big3")){
	if (strstr(strtolower(substr($img_big3,-4)),'.jpg') || strstr(strtolower(substr($img_big3,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_big3' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_bi3g,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_big3' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img_big4 != '' && file_exists("$Co_img_UP$mart_id/$img_big4")){
	if (strstr(strtolower(substr($img_big4,-4)),'.jpg') || strstr(strtolower(substr($img_big4,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_big4' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_big4,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_big4' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img_big5 != '' && file_exists("$Co_img_UP$mart_id/$img_big5")){
	if (strstr(strtolower(substr($img_big5,-4)),'.jpg') || strstr(strtolower(substr($img_big5,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_big5' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_big5,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_big5' width='50' height='50'></embed>
		";
	}
}
?>
					      				</td>
										<td>
<?
if($img_high != '' && file_exists("$Co_img_UP$mart_id/$img_high")){
	if (strstr(strtolower(substr($img_high,-4)),'.jpg') || strstr(strtolower(substr($img_high,-4)),'.gif')){
				echo "
	<img src='$Co_img_DOWN$mart_id/$img_high' width='50' height='50'>
		";
	}
	if (strstr(strtolower(substr($img_high,-4)),'.swf')){
				echo "
	<embed src='$Co_img_DOWN$mart_id/$img_high' width='50' height='50'></embed>
		";
	}
}
?>
										</td>
									</tr>
								</table>
							</td>
			              </tr>
			              <tr>
			                <td align="center" width="8%" bgColor="#c8dfec" rowspan="4">
								제품<br>이미지
							</td>
			                <td align="center" width="9%" bgColor="#E8F1F7">
								리스트
							</td>
			                <td width="85%" bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_sml" value='<?=$img_sml?>' class='input' size='35'>
								<input onclick="javascript:fileup('writeform','img_sml');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'>
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#E8F1F7">
								상세설명
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img" value='<?=$img?>' size='35' class='input'>
								<input onclick="javascript:fileup('writeform','img');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기">
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#E8F1F7">
								확대
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_big" value='<?=$img_big?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'><br>
								&nbsp;<input name="img_big2" value='<?=$img_big2?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big2');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'><br>
								&nbsp;<input name="img_big3" value='<?=$img_big3?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big3');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'><br>
								&nbsp;<input name="img_big4" value='<?=$img_big4?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big4');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'><br>
								&nbsp;<input name="img_big5" value='<?=$img_big5?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big5');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'>
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								메인
							</td>
			                <td bgColor="#ffffff" colspan="5">
								&nbsp;<input name="img_high" value='<?=$img_high?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; width: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></span> 
								<input onclick="javascript:fileup('writeform','img_high');" class="aa" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="찾아보기" style='cursor:hand'>
							</td>
						  </tr>
			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6" align="left">
								<img height="15" src="../images/tip.gif" width="30"> <font color="#0000ff"> 이미지는 jpg,gif,swf를 지원합니다.<br>
								리스트 화면의 사이즈는 120*160 px 고정입니다.<br>
								상세설명 페이지의 사이즈는 300*300 px 고정입니다.<br>
								확대이미지의 권장사이즈는 500*500 px이고, 임의대로 사이즈조정 
								가능합니다</font>
							</td>
			              </tr>
			              <tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				아이콘 선택
							</td>
                			<td width="85%" bgcolor="#FFFFFF" colspan="4">
                				<input name="icon_no" type="radio" value="0" <?if($icon_no == 0) echo " checked"?>>
                				<font color="#0000FF">사용않음</font>
                				<input name="icon_no" type="radio" value="1" <?if($icon_no == 1) echo " checked"?>>
                				<img src="../images/hot.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="2" <?if($icon_no == 2) echo " checked"?>>
                				<img src="../images/new.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="3" <?if($icon_no == 3) echo " checked"?>>
                				<img src="../images/sale.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="4" <?if($icon_no == 4) echo " checked"?>>
                				<img src="../images/reserv.gif" width="53" height="12"><br>
                				<font color="#0000FF">신상품이나 추천상품 등 강조하고 싶은 상품에 
                				아이콘을 선택하세요.<br>
                				모든 상품에 다 넣을 경우 자칫 산만해질 수도 있으니 꼭 필요한 
                				상품에만 <br>
                				선택하세요.</font>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				간단 설명
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<textarea name="short_explain" rows='3' cols='108'><?=$short_explain?></textarea>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				상품설명
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
								
<!--------------------------------------- 에디터 시작 ------------------------------------------------------>
<script type="text/javascript" src="../../smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<input type='hidden' name='secontent' value=''>
<textarea name="item_explain" id="item_explain" rows="10" cols="100" style="width:667px; height:412px; display:none;"><?=$item_explain?></textarea>
<!--textarea name="item_explain" id="item_explain" rows="10" cols="100" style="width:100%; height:412px; min-width:610px; display:none;"></textarea-->
<!--
<p>
	<input type="button" onclick="pasteHTML();" value="본문에 내용 넣기" />
	<input type="button" onclick="showHTML();" value="본문 내용 가져오기" />
	<input type="button" onclick="submitContents(this);" value="서버로 내용 전송" />
	<input type="button" onclick="setDefaultFont();" value="기본 폰트 지정하기 (궁서_24)" />
</p>
-->

<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "item_explain",
	sSkinURI: "../../smarteditor/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		fOnBeforeUnload : function(){
			//alert("아싸!");	
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["item_explain"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["item_explain"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["item_explain"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["item_explain"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	alert(form.item_explain.value);
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("item_explain").value를 이용해서 처리하면 됩니다.



	try {
		return false;
		//elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["item_explain"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
<!--------------------------------------- 에디트 끝 ------------------------------------------------------>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				옵션사용
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk" <?if($use_opt1 == 't') echo " checked";?>> 가격차등 옵션사용
							</td>
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
                				옵션제목
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14" value='<?=$op1_1[0]?>'>
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="6">
                				<select name="opt1" size="6" style="width: 250">
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
	            				<span class="aa">M: 포인트 S: 회원가</span>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목
							</td>
                			<td width="32%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				가격입력
							</td>
                			<td width="32%" bgcolor="#FFFFFF">
                				<input name="pro_price1" size="14" class='input'>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				포인트입력
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input name="pro_bonus1" size="14" class='input'>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				회원가입력
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input name="pro_mem_price1" size="14" class='input'">
							</td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add1(this.form,document.all.pro_value1.value,document.all.pro_price1.value,document.all.pro_bonus1.value,document.all.pro_mem_price1.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'> 
                				<input onclick="pro_del1(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt23_chk" <? if($use_opt23 == 't') echo " checked";?>> 가격추가 옵션사용
                			</td>
              			</tr>
<?
if(isset($opts[1]) && $opts[1] != ""){
	$op2 = explode("!", $opts[1]);
	$op2_count = count($op2);
	$op2_count = $op2_count - 1;
}
?>
        				<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 1


							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input name="op_name2" size="14" value='<?=$op2[0]?>' class='input'>
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="4">
                				<select name="opt2" size="4" style="width: 250;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
          						<option>------------------</option>
<?
for($i=1;$i<=$op2_count;$i++){
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
                				옵션항목 1
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value2" size="14">
							</td>
              			</tr>


              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션가격 1
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_price2" size="10">※추가할 금액만 입력
							</td>
              			</tr> 

              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add2(this.form,document.all.pro_value2.value,document.all.pro_price2.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'> 
                				<input onclick="pro_del2(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
							</td>
              			</tr>
<?
print_r($opts[2]);
if(isset($opts[2]) && $opts[2] != ""){
	$op3 = explode("!", $opts[2]);
	$op3_count = count($op3);
	$op3_count = $op3_count - 1;
}
?>
	            		<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 2
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name3" size="14" value='<?=$op3[0]?>'>
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="4">
                				<select name="opt3" size="4" style="width:250;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;">
          						<option>------------------</option>
<?
for($i=1;$i<=$op3_count;$i++){
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
                				옵션항목 2
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input name="pro_value3" size="14" class='input'>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션가격 2
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_price3" size="10">※추가할 금액만 입력
							</td>
              			</tr> 

              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add3(this.form,document.all.pro_value3.value,document.all.pro_price3.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'> 
                				<input onclick="pro_del3(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">옵션 선택 
                    					사용 설명</font>
									</td>
                  				</tr>
                  				<tr>
                    				<td width="100%">
                    					제품의 옵션을 설정하는 부분으로써 동일 가격의 옵션적용, 차등 가격의 옵션을 적용할 수 있습니다. 먼저 가격차등 옵션사용인지 가격동일 옵션사용인지를 선택하세요.<br><br>
                    					1. 가격차등 옵션사용의 경우<br>
                    					예)사이즈에 따라 가격이 달라지는 경우,<br>
                    					옵션제목: 사이즈, 옵션항목: 55, 가격입력 : 5000 | 옵션항목 : 66, 가격입력 : 6000<br>
                    					우측화면에 입력한 항목이 출력됩니다.<br><br>
                    					2. 가격추가 옵션사용의 경우<br>
                    					예)가격은 기본가격에 추가할 가격만 입력하시면 됩니다.<BR>										
                    				</td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">등록일</td>
                			<td width="53%" bgcolor="#FFFFFF" colspan="3"><?=$reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3"><span class="aa">상점출력유무</span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                			<input type="radio" name="if_hide" value="0" <?if($if_hide=='0') echo "checked";?>>
                			상점에 출력함 <br>
                			<input type="radio" value="1" name="if_hide" <?if($if_hide=='1') echo "checked";?>>상점에 출력하지않음<br>
                			&nbsp;(등록은 되지만, 상점에 출력되지는 않습니다)</td>
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
        		<input class='butt_none' style='width:60' type="submit" value="완 료" style='cursor:hand'> 
        		<input class='butt_none' style='width:60' type="reset" value="재입력" style='cursor:hand'>
<?
if( $back == "ok" ){
?>
        		<input onclick="location.href='item_list_ok.php?back=<?=$back?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="리스트" style='cursor:hand'>
<?
}else{
?>
        		<input onclick="location.href='item_list.php?prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="리스트" style='cursor:hand'>
<?
}
?>
        	</td>
      	</tr>
      	
      	</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>	
<?
mysql_close($dbconn);
?>