<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//카테고리 현재 위치
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
//포인트 관련
$shop_sql2 = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$shop_res2 = mysql_query($shop_sql2, $dbconn);
$row2 = mysql_fetch_array($shop_res2);
$bonus_auto_ok = $row2[bonus_auto_ok];
$bonus_auto_percent = $row2[bonus_auto_percent];

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
		alert("\n상품이름을 입력하세요.");
		frm.item_name.focus();
		return false;
	}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	

	var Digit = '1234567890'

	if (frm.z_price.value==""){
		alert("판매가를 입력하세요");
		frm.z_price.focus();
		return false;
	}

	/*if (frm.member_price.value==""){
		alert("공급가를 입력하세요");
		frm.member_price.focus();
		return false;
	}*/

	//if (frm.bonus.value==""){
	//	alert("포인트를 입력하세요");
	//	frm.bonus.focus();
	//	return false;
	//}
	
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
	
	alert("삭제하실 옵션항목을 선택하십시요");		
}
	
function pro_del2(frm){
	
	for(i=1;i<frm.opt2.options.length ;i++){
		if ( frm.opt2.options[i].selected){
			document.all.opt2.options[i] = null;
			return true;
		}
	}
	
	alert("삭제하실 옵션항목을 선택하십시요");		
}

function pro_del3(frm){
	
	for(i=1;i<frm.opt3.options.length ;i++){
		if ( frm.opt3.options[i].selected){
			document.all.opt3.options[i] = null;
			return true;
		}
	}
	
	alert("삭제하실 옵션항목을 선택하십시요");		
}




function pro_add1(frm,pro,price,bonus,mem_price){
	var e1=document.createElement("OPTION")

	if (pro=="" ){
		alert ("옵션항목을 입력하세요.");
		frm.pro_value1.focus ();
		return false;
	}else{	
		if (price=="" ) {
			alert ("가격을 입력하세요.");
			frm.pro_price1.focus();
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

function pro_add2(frm,pro){
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
	document.all.opt2.add(e1);
	frm.pro_value2.value =""		
	frm.pro_value2.focus (); 		
	}
}


function pro_add3(frm,pro){
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

//*************************** 파일 업로드 창 ******************************

function fileup(formname,imagename, title){
// formname : form 의 name
// mart_id : 상점 mart_id
// imagename : 업로드되는 이미지 파일이 입력되는 field name, 이 값이 DB에 저장
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename+"&title="+title
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** 파일 업로드 창 *********************************
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
//포인트 자동계산
function checkPrice(){
	var form = document.writeform;
	var z_p = form.z_price.value;
	form.bonus.value = Math.floor((z_p * <?=$bonus_auto_percent?>) / 100);
}
//포인트 자동계산
function checkPrice_opt(){
	var form = document.writeform;
	var z_p2 = form.pro_price1.value;
	form.pro_bonus1.value = Math.floor((z_p2 * <?=$bonus_auto_percent?>) / 100);
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
					<p style="padding-left: 10px"><b>[상품 등록]</b> 새로운 상품을 등록합니다.<font color="#CE285A"> ▶ 이미지 파일명은 반드시 영문으로 하세요.</font><br><br>
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
				<input type="hidden" name="img_sml_updateflag" value='ok'>
				<input type="hidden" name="img_updateflag" value='ok'>
				<input type="hidden" name="img_big_updateflag" value='ok'>
				<input type="hidden" name="img_big2_updateflag" value='ok'>
				<input type="hidden" name="img_big3_updateflag" value='ok'>
				<input type="hidden" name="img_big4_updateflag" value='ok'>
				<input type="hidden" name="img_big5_updateflag" value='ok'>
				<input type="hidden" name="img_high_updateflag" value='ok'>
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
                				상품명
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_name" size="25">
							</td>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				제조사
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_company" size="25">
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
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								소비자가 <input type="checkbox" value="1" name="if_strike" <?
						if($if_customer_price != '1') echo " disabled";
						if($if_strike == "1") echo " checked";
						?>>
							</td>
			                <td bgColor="#ffffff">
								<input name="price" class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>
			                <td align="center" bgColor="#c8dfec" colspan="2">
								상품코드
							</td>
			                <td bgColor="#ffffff">
								<input name="item_code" class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								재고관리
							</td>
			                <td bgColor="#ffffff">
								<input class="aa" type="radio" value="1" name="jaego_use">사용 함 
								<input class="aa" type="radio" CHECKED value="0" name="jaego_use">사용 하지 않음
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								재고량
							</td>
			                <td bgColor="#ffffff">
								<input name="jaego" class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
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
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()" <?if($bonus_auto_ok=='t'){?>onKeyUp="checkPrice()"<?}?>>
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								포인트
							</td>
			                <td bgColor="#ffffff">
								<input name="bonus" value="<?=$bonus?>"  class='input' size="14"> 
								<?if($bonus_auto_ok=='t'){
									echo"($bonus_auto_percent"."%&nbsp;자동적용중)";
								}?>
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								배송정보
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="radio" value="무료배송" name="fee">무료배송 <input type="radio" value="착불" name="fee" >착불 <input type="radio" value="" name="fee">선불 <input type="radio" value="기본설정" name="fee" checked>기본설정
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="15%" bgColor="#c8dfec" colSpan="2">
								결제방법
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="checkbox" value="1" name="if_cash">현금전용결제<br>
								<font color="#C00000"> (현금전용 결제기능입니다. 타 상품과 같이 구매시, 현금결제만 가능합니다.)</font><br>
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="100%" bgColor="#ffffff" colSpan="6">
								<br><font color="#0000ff">소비자가는 상점에 출력되지 않습니다.<br>
								판매가, 회원가, 포인트는 숫자만 입력하시고, 포인트를 지급하지 않을 경우 &quot;0&quot;을 입력하세요.<br>
								상품등록시 개별적으로 회원가를 입력하시면 기본설정에서 설정한 회원가는 해당상품에 대해<br>적용되지 않습니다.</font><br><br>
			                </td>
			              </tr>
<?
if($if_gnt_item == 1){
?>
              			<tr>
                			<td align='center' bgColor="#c8dfec" colspan="2">
                				공급여부
							</td>
                			<td bgColor="#ffffff">
                				<input type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>가능 
                				<input type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>불가능
							</td>
                			<td align="center" bgcolor="#c8dfec" colspan="2">
                				공급가
							</td>
                			<td bgcolor="#ffffff">
                				<input class='input' size="14" name="provide_price">
							</td>
              			</tr>
<?
}
?>
               			<tr>
			                <td align='center' width="80" bgColor="#c8dfec" colspan="2">
								제품<br>이미지
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;1.<input type="file" name="img_big" class='input' size="25"> <br>
								&nbsp;2.<input type="file" name="img_big2" class='input' size="25"> <br>
								&nbsp;3.<input type="file" name="img_big3" class='input' size="25"><br>
								&nbsp;4.<input type="file" name="img_big4" class='input' size="25"><br>
								&nbsp;5.<input type="file" name="img_big5" class='input' size="25"><br>
							</td>
			              </tr>

			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6">
								<img height="15" src="../images/tip.gif" width="30">
								<font color="#0000ff"> 종류제한 : 이미지는 jpg,gif,bmp를 지원합니다.<br>							
								용량제한 : 5M(5120000byte)<BR>								
								결과 이미지의 사이즈는 가로600px 기준으로 자동 크기조절이 됩니다</font>
							</td>
			              </tr>
			              <tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
								아이콘 선택
							</td>
                			<td bgcolor="#FFFFFF" align="left" colspan="4">
                				<input name="icon_no" type="radio" value="0" checked><font color="#0000FF">사용않음</font>&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="1"><img src="../images/hot.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="2"><img src="../images/new.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="3"><img src="../images/sale.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="4"><img src="../images/reserv.gif"><br>
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
								<textarea name="short_explain" rows='3' cols='108'></textarea>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				상품 설명
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">								
								<?=myEditor(1,'../../editor','writeform','item_explain','100%','450');?>                				
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				옵션사용
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk" checked> 가격차등 옵션사용
							</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14">
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="6">
                				<select name="opt1" size="6" style="width:250">
          						<option>-------------------------------------</option>
        						</select>
        						<br>
	            				<span class="aa">M: 포인트 S: 회원가
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				가격입력
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_price1" size="14" <?if($bonus_auto_ok=='t'){?>onKeyUp="checkPrice_opt()"<?}?>>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				포인트입력
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_bonus1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				회원가입력
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_mem_price1" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add1(this.form,document.all.pro_value1.value,document.all.pro_price1.value,document.all.pro_bonus1.value,document.all.pro_mem_price1.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="pro_del1(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt23_chk" checked> 가격동일 옵션사용
                			</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 1
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
                				옵션항목 1
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value2" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add2(this.form,document.all.pro_value2.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="pro_del2(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
							</td>
              			</tr>
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목 2
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
                				옵션항목 2
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="pro_value3" size="14">
							</td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add3(this.form,document.all.pro_value3.value)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="pro_del3(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">옵션 선택 사용 설명</font>
									</td>
                  				</tr>
                  				<tr>
                    				<td width="100%">
                    					제품의 옵션을 설정하는 부분으로써 동일 가격의 옵션적용, 차등 가격의 옵션을 적용할 수 있습니다. 먼저 가격차등 옵션사용인지 가격동일 옵션사용인지를 선택하세요.<br><br>
                    					1. 가격차등 옵션사용의 경우<br>
                    					예)사이즈에 따라 가격이 달라지는 경우,<br>
                    					옵션제목: 사이즈, 옵션항목: 55, 가격입력 : 5000 | 옵션항목 : 66, 가격입력 : 6000<br>
                    					우측화면에 입력한 항목이 출력됩니다.<br><br>
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
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
                				등록일
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3"><?=$reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
								상점출력유무
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<input type="radio" name="if_hide" value="0" checked> 상점에 출력함<br>
                				<input type="radio" value="1" name="if_hide"> 상점에 출력하지않음<br>&nbsp;(등록은 되지만, 상점에 출력되지는 않습니다)</td>
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
		alert(\"상품갯수가 2000개를 넘어 더 이상의 상품을 등록할 수 없습니다.\");
		return false;
	}
	</script>
	";
}
else if($service_name == 'indi_base'&& $numRows > 2000){
	echo "
	 <script>
	 function check_ver(category_num,prevno){
		alert(\"상품갯수가 2000개를 넘어 더이상의 상품을 등록할 수 없습니다.\");
		return false;
	}
	</script>	
	";
}
else if($service_name == 'free_base'&& $numRows > 150){
	echo "
	<script>
	 function check_ver(){
		alert(\"상품갯수가 150개를 넘어 더 이상의 상품을 등록할 수 없습니다.\");
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
				<input onclick='return check_ver()' class='butt_none' style='width:60' type="submit" value="완 료" style='cursor:hand'>
        		<input class='butt_none' style='width:60' type="reset" value="재입력">
        		<input  onclick="location.href='item_list.php?pu=<?=$pu?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>'" class='butt_none' style='width:60' type="button" style='cursor:hand' value="리스트">
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
}
?>
<?
//================== 상품을 등록함 =======================================================
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
	if ($dbresult == false) echo "쿼리 실행 실패!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxItem_no = mysql_result($dbresult, 0, 0);
	else
		$maxItem_no = 0;
	$maxItem_no_1 = $maxItem_no+1;

############################# 이미지 용량 및 사이즈 제한 ##############################
	if (isset($img_big_name)&&($img_big_name != "")){
		$size_big = filesize($img_big);
		$size_width_big = getimagesize($img_big);
	
	/*
		if($size_width_big[0] > 2100 || $size_width_big[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"1번 이미지의 가로 또는 세로 픽셀이 2100픽셀 이상이면 업로드가 안됩니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
*/
		if($size_big > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"1번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big2_name)&&($img_big2_name != "")){
		$size_big2 = filesize($img_big2);
		$size_width_big2 = getimagesize($img_big2);
	/*
		if($size_width_big2[0] > 2100 || $size_width_big2[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"2번 이미지의 가로 또는 세로 픽셀이 2100픽셀 이상이면 업로드가 안됩니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big2 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"2번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big3_name)&&($img_big3_name != "")){
		$size_big3 = filesize($img_big3);
		$size_width_big3 = getimagesize($img_big3);
	/*
		if($size_width_big3[0] > 2100 || $size_width_big3[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"3번 이미지의 가로 또는 세로 픽셀이 2100픽셀 이상이면 업로드가 안됩니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big3 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"3번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big4_name)&&($img_big4_name != "")){
		$size_big4 = filesize($img_big4);
		$size_width_big4 = getimagesize($img_big4);
	/*
		if($size_width_big4[0] > 2100 || $size_width_big4[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"4번 이미지의 가로 또는 세로 픽셀이 2100픽셀 이상이면 업로드가 안됩니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big4 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"4번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_big5_name)&&($img_big5_name != "")){
		$size_big5 = filesize($img_big5);
		$size_width_big5 = getimagesize($img_big5);
	/*
		if($size_width_big5[0] > 2100 || $size_width_big5[1] > 2100){		
			echo ("
		<script language='javascript'>
			alert(\"5번 이미지의 가로 또는 세로 픽셀이 2100픽셀 이상이면 업로드가 안됩니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	*/	
		if($size_big5 > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"5번 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
#######################################################################################



		//================== 업로드 파일을 불러옴 ================================================
		include "../../upload.php";
		$upload = "$Co_img_UP"."$mart_id/";
		//================== 첨부 파일을 업로드함 ================================================
##################################img_big###############################################
	
	if (isset($img_big_name)&&($img_big_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big_name ){


			$file = FileUploadName( "", "$upload", $img_big, $img_big_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################
##################################img_big2###############################################
	
	if (isset($img_big2_name)&&($img_big2_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}
		
		if( $img_big2_name ){


			$file = FileUploadName( "", "$upload", $img_big2, $img_big2_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################
##################################img_big3###############################################
	
	if (isset($img_big3_name)&&($img_big3_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}

		
		if( $img_big3_name ){


			$file = FileUploadName( "", "$upload", $img_big3, $img_big3_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################
##################################img_big4###############################################
	
	if (isset($img_big4_name)&&($img_big4_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big4_name ){


			$file = FileUploadName( "", "$upload", $img_big4, $img_big4_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################
##################################img_big5###############################################
	
	if (isset($img_big5_name)&&($img_big5_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}

		
		if( $img_big5_name ){


			$file = FileUploadName( "", "$upload", $img_big5, $img_big5_name );//파일을 업로드 함

			if( !$file ){
				echo("
					<script>
					window.alert('파일 업로드에 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################



	if($img_big_updateflag=="ok" && $img_big_name != ""){
		$img_big_new = "item_big_".$maxItem_no_1."_".$img_big_name;
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		$img_big2_new = "item_big2_".$maxItem_no_1."_".$img_big2_name;
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		$img_big3_new = "item_big3_".$maxItem_no_1."_".$img_big3_name;
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		$img_big4_new = "item_big4_".$maxItem_no_1."_".$img_big4_name;
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		$img_big5_new = "item_big5_".$maxItem_no_1."_".$img_big5_name;
	}





	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//업로드 파일 저장
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			copy ("$Co_img_UP$mart_id/$img_big2_name","$Co_img_UP$mart_id/$img_big2_new" );	//업로드 파일 저장
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			copy ("$Co_img_UP$mart_id/$img_big3_name","$Co_img_UP$mart_id/$img_big3_new" );	//업로드 파일 저장
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			copy ("$Co_img_UP$mart_id/$img_big4_name","$Co_img_UP$mart_id/$img_big4_new" );	//업로드 파일 저장
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			copy ("$Co_img_UP$mart_id/$img_big5_name","$Co_img_UP$mart_id/$img_big5_new" );	//업로드 파일 저장
	}


	//임시화일 삭제
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}
	if($img_big2_updateflag=="ok" && $img_big2_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big2_name"))
			unlink("$Co_img_UP$mart_id/$img_big2_name");
	}
	if($img_big3_updateflag=="ok" && $img_big3_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big3_name"))
			unlink("$Co_img_UP$mart_id/$img_big3_name");
	}
	if($img_big4_updateflag=="ok" && $img_big4_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big4_name"))
			unlink("$Co_img_UP$mart_id/$img_big4_name");
	}
	if($img_big5_updateflag=="ok" && $img_big5_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big5_name"))
			unlink("$Co_img_UP$mart_id/$img_big5_name");
	}
















################################ 이미지 매직 ##################################33
$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";
$rg_file2_path = "$Co_img_UP$mart_id/$img_big2_new";
$rg_file3_path = "$Co_img_UP$mart_id/$img_big3_new";
$rg_file4_path = "$Co_img_UP$mart_id/$img_big4_new";
$rg_file5_path = "$Co_img_UP$mart_id/$img_big5_new";

/*
$FileName : 파일명
$ori_path : 원본파일경로
$maxItem_no_1 : 가장최근글번호 + 1한값
$mart_id : 계정 아이디
맨마지막숫자 : 유일성을 두기위해

썸네일 경로중 home2를 최신서버로 옮길시 home로 변경
*/
function MakeThum1($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
{
        $ThumFileName130 = $maxItem_no_1."_".$unique."_".$FileName."130.gif";
		$ThumFileName300 = $maxItem_no_1."_".$unique."_".$FileName."300.gif";
		$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName."600.gif";
        
        $FileName = $ori_path;
        $ThumFileName130 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName130;
		$ThumFileName300 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName300;
		$ThumFileName600 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName600;
        
        exec ("convert -geometry 130x $FileName $ThumFileName130");
		exec ("convert -geometry 300x $FileName $ThumFileName300");
		exec ("convert -geometry 600x $FileName $ThumFileName600");




		if(file_exists("$ori_path")){ 
			unlink ("$ori_path");	
		}



}
function MakeThum2($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
{
		$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName . "600.gif";
        
        $FileName = $ori_path;
		$ThumFileName600 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName600;
        
		exec ("convert -geometry 600x $FileName $ThumFileName600");




		if(file_exists("$ori_path")){ 
			unlink ("$ori_path");	
		}



}
################################ 이미지 매직 ##################################33

























		##############썸네일 img_big있을때##########
		if($img_big_new){
			MakeThum1($img_big_name,$rg_file1_path,$maxItem_no_1,$mart_id,1); 
			$img_sml_new = $maxItem_no_1."_1_".$img_big_name."130.gif";
			$img_new = $maxItem_no_1."_1_".$img_big_name."300.gif";
			$img_big_new_th =  $maxItem_no_1."_1_".$img_big_name."600.gif";
		}
		############## 썸네일 BIG2 #################
		if($img_big2_new){
			MakeThum2($img_big2_name,$rg_file2_path,$maxItem_no_1,$mart_id,2);
			$img_big2_new_th =  $maxItem_no_1."_2_".$img_big2_name."600.gif";
		}
		############## 썸네일 BIG3 #################
		if($img_big3_new){
			MakeThum2($img_big3_name,$rg_file3_path,$maxItem_no_1,$mart_id,3); 
			$img_big3_new_th =  $maxItem_no_1."_3_".$img_big3_name."600.gif";
		}
		############## 썸네일 BIG4 #################
		if($img_big4_new){
			MakeThum2($img_big4_name,$rg_file4_path,$maxItem_no_1,$mart_id,4); 
			$img_big4_new_th =  $maxItem_no_1."_4_".$img_big4_name."600.gif";
		}
		############## 썸네일 BIG5 #################
		if($img_big5_new){
			MakeThum2($img_big5_name,$rg_file5_path,$maxItem_no_1,$mart_id,5); 
			$img_big5_new_th =  $maxItem_no_1."_5_".$img_big5_name."600.gif";
		}




	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	$item_order = "1";//상품 출력 순서

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new_th','$img_big2_new_th','$img_big3_new_th','$img_big4_new_th','$img_big5_new_th','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee')";

	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>
