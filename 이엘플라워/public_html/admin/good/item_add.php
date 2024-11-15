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
<?
include("../../smarteditor2/editor.lib.php");
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


	var attFile = frm.img_big.value;
	if(attFile!=""){
	   if(!(/(.jpg|.gif|.bmp)$/i).test(attFile)){
		alert("이미지는 gif, jpg, bmp 파일만 가능합니다.");
		return false;
	   } 
	}
	var attFile = frm.img_big2.value;
	if(attFile!=""){
	   if(!(/(.jpg|.gif|.bmp)$/i).test(attFile)){
		alert("이미지는 gif, jpg, bmp 파일만 가능합니다.");
		return false;
	   } 
	}
	var attFile = frm.img_big3.value;
	if(attFile!=""){
	   if(!(/(.jpg|.gif|.bmp)$/i).test(attFile)){
		alert("이미지는 gif, jpg, bmp 파일만 가능합니다.");
		return false;
	   } 
	}
	var attFile = frm.img_big4.value;
	if(attFile!=""){
	   if(!(/(.jpg|.gif|.bmp)$/i).test(attFile)){
		alert("이미지는 gif, jpg, bmp 파일만 가능합니다.");
		return false;
	   } 
	}
	var attFile = frm.img_big5.value;
	if(attFile!=""){
	   if(!(/(.jpg|.gif|.bmp)$/i).test(attFile)){
		alert("이미지는 gif, jpg, bmp 파일만 가능합니다.");
		return false;
	   } 
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


	

	oEditors.getById["item_explain"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.

	var content=oEditors.getById["item_explain"].getIR();
	content=content.replace("<P>&nbsp;</P>","");
	if (content== "" ){ 
		 alert("내용을 입력하세요."); 
		 oEditors.getById["item_explain"].exec("FOCUS", []); 
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
</script>
<script>
var opt_order=1;
var opt_order2=1;
var opt_order3=1;
var opt_order4=1;
var opt_order5=1;
var opt_order6=1;
function opt_add(frm){
	var opt_price=0;
	var opt_ea=0;
	var option=document.createElement("option");
	if(!frm.op_name1.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name1.focus();
		return;
	}
	if(!frm.optName.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName.focus();
		return;
	}
	if(!frm.optPrice.value){
		opt_price=0;
	}else{
		opt_price=frm.optPrice.value;
	}
	if(!frm.optEa.value){
		opt_ea=0;
	}else{
		opt_ea=frm.optEa.value;
	}
	frm.opt_name.value+=frm.optName.value+"|";
	frm.opt_price.value+=+opt_price+"|";
	frm.opt_ea.value+=frm.optEa.value+"|";
	frm.opt_order.value+=opt_order+"|";
	frm.opt_code.value+=frm.optCode.value+"|";
	option.value=frm.optName.value+"(+"+opt_price+"원)";
	option.text=frm.optName.value+"(+"+opt_price+"원 재고: "+opt_ea+"개 code"+frm.optCode.value+")";
	document.all.opt1.add(option);
	frm.optName.value="";
	frm.optPrice.value="";
	frm.optEa.value="";
	frm.optCode.value="";
	frm.optName.focus();
	var modify=document.getElementById("modify");
	modify.style.display="none";

	opt_order++;
}

function opt_change(opt){
	var frm=document.writeform;
	var opt_price=frm.opt_price.value.split("|");
	var opt_name=frm.opt_name.value.split("|");
	var opt_ea=frm.opt_ea.value.split("|");
	var opt_code=frm.opt_code.value.split("|");
	var modify=document.getElementById("modify");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName.value=opt_name[i-1];
			frm.optEa.value=opt_ea[i-1];
			frm.optPrice.value=opt_price[i-1];
			frm.optCode.value=opt_code[i-1];
			modify.style.display="inline";
			break;
		}
	}
}
function opt_modify(frm){
	var sel=false;
	var opt_price=frm.opt_price.value.split("|");
	var opt_name=frm.opt_name.value.split("|");
	var opt_ea=frm.opt_ea.value.split("|");
	var opt_code=frm.opt_code.value.split("|");
	frm.opt_price.value="";
	frm.opt_name.value="";
	frm.opt_ea.value="";
	frm.opt_code.value="";
	var k=0;
	for(i=1;i<frm.opt1.options.length;i++){
		if(frm.opt1.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price[k]=frm.optPrice.value;
	opt_ea[k]=frm.optEa.value;
	opt_name[k]=frm.optName.value;
	opt_code[k]=frm.optCode.value;
	frm.opt1.options[k+1].value=opt_name[k]+"(+"+opt_price[k]+"원)";
	frm.opt1.options[k+1].text=opt_name[k]+"(+"+opt_price[k]+"원 재고 :"+opt_ea[k]+"개 code"+opt_code[k]+")";
	
	for(j=0;j<opt_name.length;j++){
		if(opt_price[j]){
			frm.opt_price.value+=opt_price[j]+"|";
			frm.opt_name.value+=opt_name[j]+"|";
			frm.opt_ea.value+=opt_ea[j]+"|";
			frm.opt_code.value+=opt_code[j]+"|";
		}
	}
	frm.optName.value="";
	frm.optPrice.value="";
	frm.optEa.value="";
	frm.optCode.value="";
	frm.optName.focus();
	var modify=document.getElementById("modify");
	modify.style.display="none";
}
function opt_del(frm){
	var sel=false;
	var opt_price=frm.opt_price.value.split("|");
	var opt_name=frm.opt_name.value.split("|");
	var opt_ea=frm.opt_ea.value.split("|");
	var opt_order=frm.opt_order.value.split("|");
	var opt_code=frm.opt_code.value.split("|");
	frm.opt_price.value="";
	frm.opt_name.value="";
	frm.opt_ea.value="";
	frm.opt_order.value="";
	frm.opt_code.value="";
	var k=0;
	for(i=1;i<frm.opt1.options.length;i++){
		if(frm.opt1.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt1.options[k+1]=null;
	
	opt_price.splice(k,1);
	opt_ea.splice(k,1);
	opt_name.splice(k,1);
	opt_order.splice(k,1);
	opt_code.splice(k,1);
	for(j=0;j<opt_name.length;j++){
		if(opt_price[j]){
			frm.opt_price.value+=opt_price[j]+"|";
			frm.opt_name.value+=opt_name[j]+"|";
			frm.opt_ea.value+=opt_ea[j]+"|";
			frm.opt_order.value+=opt_order[j]+"|";
			frm.opt_code.value+=opt_code[j]+"|";
		}
	}
	frm.optName.value="";
	frm.optPrice.value="";
	frm.optEa.value="";
	frm.optCode.value="";
	frm.optName.focus();
	var modify=document.getElementById("modify");    
	modify.style.display="none";
}
function opt_rank(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name=frm.opt_name.value.split("|");
	var opt_ea=frm.opt_ea.value.split("|");
	var opt_price=frm.opt_price.value.split("|");
	var opt_code=frm.opt_code.value.split("|");


	for(i=1;i<frm.opt1.options.length;i++){
		if(frm.opt1.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt1.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name[k-1];
	saveOptPrice=opt_price[k-1];
	saveOptEa=opt_ea[k-1];
	saveOptCode=opt_code[k-1];
	
	opt_name[k-1]=opt_name[j-1];
	opt_price[k-1]=opt_price[j-1];
	opt_ea[k-1]=opt_ea[j-1];
	opt_code[k-1]=opt_code[j-1];
	
	opt_name[j-1]=saveOptName;
	opt_price[j-1]=saveOptPrice;
	opt_ea[j-1]=saveOptEa;
	opt_code[j-1]=saveOptCode;

	
	var optPrice="";
	var optName="";
	var optEa="";
	var optCode="";
	frm.opt_price.value="";
	frm.opt_name.value="";
	frm.opt_ea.value="";
	frm.opt_code.value="";
	for(z=0;z<opt_name.length;z++){
		if(opt_name[z]){
			optPrice+=opt_price[z]+"|";
			optName+=opt_name[z]+"|";
			optEa+=opt_ea[z]+"|";
			optCode+=opt_code[z]+"|";
		}
	}
	frm.opt_price.value=optPrice;
	frm.opt_name.value=optName;
	frm.opt_ea.value=optEa;
	frm.opt_code.value=optCode;

	changeOptionText=frm.opt1.options[j].text;
	changeOptionValue=frm.opt1.options[j].text;
	frm.opt1.options[j].text=frm.opt1.options[k].text;
	frm.opt1.options[j].value=frm.opt1.options[k].value;
	frm.opt1.options[k].text=changeOptionText;
	frm.opt1.options[k].value=changeOptionValue;
	frm.optName.value="";
	frm.optPrice.value="";
	frm.optEa.value="";
	frm.optCode.value="";
	frm.opt1.options[j].selected=true;
	var modify=document.getElementById("modify");
	modify.style.display="none";
	
	
}


function opt_add2(frm){
	var opt_price2=0;
	var opt_ea2=0;
	var option=document.createElement("option");
	if(!frm.op_name2.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name2.focus();
		return;
	}
	if(!frm.optName2.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName2.focus();
		return;
	}
	if(!frm.optPrice2.value){
		opt_price2=0;
	}else{
		opt_price2=frm.optPrice2.value;
	}
	if(!frm.optEa2.value){
		opt_ea2=0;
	}else{
		opt_ea2=frm.optEa2.value;
	}
	frm.opt_name2.value+=frm.optName2.value+"|";
	frm.opt_price2.value+=+opt_price2+"|";
	frm.opt_ea2.value+=frm.optEa2.value+"|";
	frm.opt_order2.value+=opt_order2+"|";
	frm.opt_code2.value+=frm.optCode2.value+"|";
	option.value=frm.optName2.value+"(+"+opt_price2+"원)";
	option.text=frm.optName2.value+"(+"+opt_price2+"원 재고: "+opt_ea2+"개 code"+frm.optCode2.value+")";
	document.all.opt2.add(option);
	frm.optName2.value="";
	frm.optPrice2.value="";
	frm.optEa2.value="";
	frm.optCode2.value="";
	frm.optName2.focus();
	var modify2=document.getElementById("modify2");
	modify2.style.display="none";

	opt_order2++;
}

function opt_change2(opt){
	var frm=document.writeform;
	var opt_price2=frm.opt_price2.value.split("|");
	var opt_name2=frm.opt_name2.value.split("|");
	var opt_ea2=frm.opt_ea2.value.split("|");
	var opt_code2=frm.opt_code2.value.split("|");
	var modify2=document.getElementById("modify2");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName2.value=opt_name2[i-1];
			frm.optEa2.value=opt_ea2[i-1];
			frm.optPrice2.value=opt_price2[i-1];
			frm.optCode2.value=opt_code2[i-1];
			modify2.style.display="inline";
			break;
		}
	}
}
function opt_modify2(frm){
	var sel=false;
	var opt_price2=frm.opt_price2.value.split("|");
	var opt_name2=frm.opt_name2.value.split("|");
	var opt_ea2=frm.opt_ea2.value.split("|");
	var opt_code2=frm.opt_code2.value.split("|");
	frm.opt_price2.value="";
	frm.opt_name2.value="";
	frm.opt_ea2.value="";
	frm.opt_code2.value="";
	var k=0;
	for(i=1;i<frm.opt2.options.length;i++){
		if(frm.opt2.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price2[k]=frm.optPrice2.value;
	opt_ea2[k]=frm.optEa2.value;
	opt_name2[k]=frm.optName2.value;
	opt_code2[k]=frm.optCode.value;
	frm.opt2.options[k+1].value=opt_name2[k]+"(+"+opt_price2[k]+"원)";
	frm.opt2.options[k+1].text=opt_name2[k]+"(+"+opt_price2[k]+"원 재고 :"+opt_ea2[k]+"개 code"+opt_code2[k]+")";
	
	for(j=0;j<opt_name2.length;j++){
		if(opt_price2[j]){
			frm.opt_price2.value+=opt_price2[j]+"|";
			frm.opt_name2.value+=opt_name2[j]+"|";
			frm.opt_ea2.value+=opt_ea2[j]+"|";
			frm.opt_code2.value+=opt_code2[j]+"|";
		}
	}
	frm.optName2.value="";
	frm.optPrice2.value="";
	frm.optEa2.value="";
	frm.optCode2.value="";
	frm.optName2.focus();
	var modify2=document.getElementById("modify2");
	modify2.style.display="none";
}
function opt_del2(frm){
	var sel=false;
	var opt_price2=frm.opt_price2.value.split("|");
	var opt_name2=frm.opt_name2.value.split("|");
	var opt_ea2=frm.opt_ea2.value.split("|");
	var opt_order2=frm.opt_order2.value.split("|");
	var opt_code2=frm.opt_code2.value.split("|");
	frm.opt_price2.value="";
	frm.opt_name2.value="";
	frm.opt_ea2.value="";
	frm.opt_order2.value="";
	frm.opt_code2.value="";
	var k=0;
	for(i=1;i<frm.opt2.options.length;i++){
		if(frm.opt2.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt2.options[k+1]=null;
	
	opt_price2.splice(k,1);
	opt_ea2.splice(k,1);
	opt_name2.splice(k,1);
	opt_order2.splice(k,1);
	opt_code2.splice(k,1);
	for(j=0;j<opt_name2.length;j++){
		if(opt_price2[j]){
			frm.opt_price2.value+=opt_price2[j]+"|";
			frm.opt_name2.value+=opt_name2[j]+"|";
			frm.opt_ea2.value+=opt_ea2[j]+"|";
			frm.opt_order2.value+=opt_order2[j]+"|";
			frm.opt_code2.value+=opt_code2[j]+"|";
		}
	}
	frm.optName2.value="";
	frm.optPrice2.value="";
	frm.optEa2.value="";
	frm.optCode2.value="";
	frm.optName2.focus();
	var modify2=document.getElementById("modify2");    
	modify2.style.display="none";
}
function opt_rank2(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name2=frm.opt_name2.value.split("|");
	var opt_ea2=frm.opt_ea2.value.split("|");
	var opt_price2=frm.opt_price2.value.split("|");
	var opt_code2=frm.opt_code2.value.split("|");


	for(i=1;i<frm.opt2.options.length;i++){
		if(frm.opt2.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt2.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name2[k-1];
	saveOptPrice=opt_price2[k-1];
	saveOptEa=opt_ea2[k-1];
	saveOptCode=opt_code2[k-1];
	
	opt_name2[k-1]=opt_name2[j-1];
	opt_price2[k-1]=opt_price2[j-1];
	opt_ea2[k-1]=opt_ea2[j-1];
	opt_code2[k-1]=opt_code2[j-1];
	
	opt_name2[j-1]=saveOptName;
	opt_price2[j-1]=saveOptPrice;
	opt_ea2[j-1]=saveOptEa;
	opt_code2[j-1]=saveOptCode;

	
	var optPrice2="";
	var optName2="";
	var optEa2="";
	var optCode2="";
	frm.opt_price2.value="";
	frm.opt_name2.value="";
	frm.opt_ea2.value="";
	frm.opt_code2.value="";
	for(z=0;z<opt_name2.length;z++){
		if(opt_name2[z]){
			optPrice2+=opt_price2[z]+"|";
			optName2+=opt_name2[z]+"|";
			optEa2+=opt_ea2[z]+"|";
			optCode2+=opt_code2[z]+"|";
		}
	}
	frm.opt_price2.value=optPrice2;
	frm.opt_name2.value=optName2;
	frm.opt_ea2.value=optEa2;
	frm.opt_code2.value=optCode2;

	changeOptionText=frm.opt2.options[j].text;
	changeOptionValue=frm.opt2.options[j].text;
	frm.opt2.options[j].text=frm.opt2.options[k].text;
	frm.opt2.options[j].value=frm.opt2.options[k].value;
	frm.opt2.options[k].text=changeOptionText;
	frm.opt2.options[k].value=changeOptionValue;
	frm.optName2.value="";
	frm.optPrice2.value="";
	frm.optEa2.value="";
	frm.optCode2.value="";
	frm.opt2.options[j].selected=true;
	var modify2=document.getElementById("modify2");
	modify2.style.display="none";
	
	
}



function opt_add3(frm){
	var opt_price3=0;
	var opt_ea3=0;
	var option=document.createElement("option");
	if(!frm.op_name3.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name3.focus();
		return;
	}
	if(!frm.optName3.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName3.focus();
		return;
	}
	if(!frm.optPrice3.value){
		opt_price3=0;
	}else{
		opt_price3=frm.optPrice3.value;
	}
	if(!frm.optEa3.value){
		opt_ea3=0;
	}else{
		opt_ea3=frm.optEa3.value;
	}
	frm.opt_name3.value+=frm.optName3.value+"|";
	frm.opt_price3.value+=+opt_price3+"|";
	frm.opt_ea3.value+=frm.optEa3.value+"|";
	frm.opt_order3.value+=opt_order3+"|";
	frm.opt_code3.value+=frm.optCode3.value+"|";
	option.value=frm.optName3.value+"(+"+opt_price3+"원)";
	option.text=frm.optName3.value+"(+"+opt_price3+"원 재고: "+opt_ea3+"개 code"+frm.optCode3.value+")";
	document.all.opt3.add(option);
	frm.optName3.value="";
	frm.optPrice3.value="";
	frm.optEa3.value="";
	frm.optCode3.value="";
	frm.optName3.focus();
	var modify3=document.getElementById("modify3");
	modify3.style.display="none";

	opt_order3++;
}

function opt_change3(opt){
	var frm=document.writeform;
	var opt_price3=frm.opt_price3.value.split("|");
	var opt_name3=frm.opt_name3.value.split("|");
	var opt_ea3=frm.opt_ea3.value.split("|");
	var opt_code3=frm.opt_code3.value.split("|");
	var modify3=document.getElementById("modify3");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName3.value=opt_name3[i-1];
			frm.optEa3.value=opt_ea3[i-1];
			frm.optPrice3.value=opt_price3[i-1];
			frm.optCode3.value=opt_code3[i-1];
			modify3.style.display="inline";
			break;
		}
	}
}
function opt_modify3(frm){
	var sel=false;
	var opt_price3=frm.opt_price3.value.split("|");
	var opt_name3=frm.opt_name3.value.split("|");
	var opt_ea3=frm.opt_ea3.value.split("|");
	var opt_code3=frm.opt_code3.value.split("|");
	frm.opt_price3.value="";
	frm.opt_name3.value="";
	frm.opt_ea3.value="";
	frm.opt_code3.value="";
	var k=0;
	for(i=1;i<frm.opt3.options.length;i++){
		if(frm.opt3.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price3[k]=frm.optPrice3.value;
	opt_ea3[k]=frm.optEa3.value;
	opt_name3[k]=frm.optName3.value;
	opt_code3[k]=frm.optCode3.value;
	frm.opt3.options[k+1].value=opt_name3[k]+"(+"+opt_price3[k]+"원)";
	frm.opt3.options[k+1].text=opt_name3[k]+"(+"+opt_price3[k]+"원 재고 :"+opt_ea3[k]+"개 code"+opt_code3[k]+")";
	
	for(j=0;j<opt_name3.length;j++){
		if(opt_price3[j]){
			frm.opt_price3.value+=opt_price3[j]+"|";
			frm.opt_name3.value+=opt_name3[j]+"|";
			frm.opt_ea3.value+=opt_ea3[j]+"|";
			frm.opt_code3.value+=opt_code3[j]+"|";
		}
	}
	frm.optName3.value="";
	frm.optPrice3.value="";
	frm.optEa3.value="";
	frm.optCode3.value="";
	frm.optName3.focus();
	var modify3=document.getElementById("modify3");
	modify3.style.display="none";
}
function opt_del3(frm){
	var sel=false;
	var opt_price3=frm.opt_price3.value.split("|");
	var opt_name3=frm.opt_name3.value.split("|");
	var opt_ea3=frm.opt_ea3.value.split("|");
	var opt_order3=frm.opt_order3.value.split("|");
	var opt_code3=frm.opt_code3.value.split("|");
	frm.opt_price3.value="";
	frm.opt_name3.value="";
	frm.opt_ea3.value="";
	frm.opt_order3.value="";
	frm.opt_code3.value="";
	var k=0;
	for(i=1;i<frm.opt3.options.length;i++){
		if(frm.opt3.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt3.options[k+1]=null;
	
	opt_price3.splice(k,1);
	opt_ea3.splice(k,1);
	opt_name3.splice(k,1);
	opt_order3.splice(k,1);
	opt_code3.splice(k,1);
	for(j=0;j<opt_name3.length;j++){
		if(opt_price3[j]){
			frm.opt_price3.value+=opt_price3[j]+"|";
			frm.opt_name3.value+=opt_name3[j]+"|";
			frm.opt_ea3.value+=opt_ea3[j]+"|";
			frm.opt_order3.value+=opt_order3[j]+"|";
			frm.opt_code3.value+=opt_code3[j]+"|";
		}
	}
	frm.optName3.value="";
	frm.optPrice3.value="";
	frm.optEa3.value="";
	frm.optCode3.value="";
	frm.optName3.focus();
	var modify3=document.getElementById("modify3");    
	modify3.style.display="none";
}
function opt_rank3(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name3=frm.opt_name3.value.split("|");
	var opt_ea3=frm.opt_ea3.value.split("|");
	var opt_price3=frm.opt_price3.value.split("|");
	var opt_code3=frm.opt_code3.value.split("|");


	for(i=1;i<frm.opt3.options.length;i++){
		if(frm.opt3.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt3.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name3[k-1];
	saveOptPrice=opt_price3[k-1];
	saveOptEa=opt_ea3[k-1];
	saveOptCode=opt_code3[k-1];
	
	opt_name3[k-1]=opt_name3[j-1];
	opt_price3[k-1]=opt_price3[j-1];
	opt_ea3[k-1]=opt_ea3[j-1];
	opt_code3[k-1]=opt_code3[j-1];
	
	opt_name3[j-1]=saveOptName;
	opt_price3[j-1]=saveOptPrice;
	opt_ea3[j-1]=saveOptEa;
	opt_code3[j-1]=saveOptCode;

	
	var optPrice3="";
	var optName3="";
	var optEa3="";
	var optCode3="";
	frm.opt_price3.value="";
	frm.opt_name3.value="";
	frm.opt_ea3.value="";
	frm.opt_code3.value="";
	for(z=0;z<opt_name3.length;z++){
		if(opt_name3[z]){
			optPrice3+=opt_price3[z]+"|";
			optName3+=opt_name3[z]+"|";
			optEa3+=opt_ea3[z]+"|";
			optCode3+=opt_code3[z]+"|";
		}
	}
	frm.opt_price3.value=optPrice3;
	frm.opt_name3.value=optName3;
	frm.opt_ea3.value=optEa3;
	frm.opt_code3.value=optCode3;

	changeOptionText=frm.opt3.options[j].text;
	changeOptionValue=frm.opt3.options[j].text;
	frm.opt3.options[j].text=frm.opt3.options[k].text;
	frm.opt3.options[j].value=frm.opt3.options[k].value;
	frm.opt3.options[k].text=changeOptionText;
	frm.opt3.options[k].value=changeOptionValue;
	frm.optName3.value="";
	frm.optPrice3.value="";
	frm.optEa3.value="";
	frm.optCode3.value="";
	frm.opt3.options[j].selected=true;
	var modify3=document.getElementById("modify3");
	modify3.style.display="none";
	
	
}
function opt_add4(frm){
	var opt_price4=0;
	var opt_ea4=0;
	var option=document.createElement("option");
	if(!frm.op_name4.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name4.focus();
		return;
	}
	if(!frm.optName4.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName4.focus();
		return;
	}
	if(!frm.optPrice4.value){
		opt_price4=0;
	}else{
		opt_price4=frm.optPrice4.value;
	}
	if(!frm.optEa4.value){
		opt_ea4=0;
	}else{
		opt_ea4=frm.optEa4.value;
	}
	frm.opt_name4.value+=frm.optName4.value+"|";
	frm.opt_price4.value+=+opt_price4+"|";
	frm.opt_ea4.value+=frm.optEa4.value+"|";
	frm.opt_order4.value+=opt_order4+"|";
	frm.opt_code4.value+=frm.optCode4.value+"|";
	option.value=frm.optName4.value+"(+"+opt_price4+"원)";
	option.text=frm.optName4.value+"(+"+opt_price4+"원 재고: "+opt_ea4+"개 code"+frm.optCode4.value+")";
	document.all.opt4.add(option);
	frm.optName4.value="";
	frm.optPrice4.value="";
	frm.optEa4.value="";
	frm.optCode4.value="";
	frm.optName4.focus();
	var modify4=document.getElementById("modify4");
	modify4.style.display="none";

	opt_order4++;
}

function opt_change4(opt){
	var frm=document.writeform;
	var opt_price4=frm.opt_price4.value.split("|");
	var opt_name4=frm.opt_name4.value.split("|");
	var opt_ea4=frm.opt_ea4.value.split("|");
	var opt_code4=frm.opt_code4.value.split("|");
	var modify4=document.getElementById("modify4");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName4.value=opt_name4[i-1];
			frm.optEa4.value=opt_ea4[i-1];
			frm.optPrice4.value=opt_price4[i-1];
			frm.optCode4.value=opt_code4[i-1];
			modify4.style.display="inline";
			break;
		}
	}
}
function opt_modify4(frm){
	var sel=false;
	var opt_price4=frm.opt_price4.value.split("|");
	var opt_name4=frm.opt_name4.value.split("|");
	var opt_ea4=frm.opt_ea4.value.split("|");
	var opt_code4=frm.opt_code4.value.split("|");
	frm.opt_price4.value="";
	frm.opt_name4.value="";
	frm.opt_ea4.value="";
	frm.opt_code4.value="";
	var k=0;
	for(i=1;i<frm.opt4.options.length;i++){
		if(frm.opt4.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price4[k]=frm.optPrice4.value;
	opt_ea4[k]=frm.optEa4.value;
	opt_name4[k]=frm.optName4.value;
	opt_code4[k]=frm.optCode4.value;
	frm.opt4.options[k+1].value=opt_name4[k]+"(+"+opt_price4[k]+"원)";
	frm.opt4.options[k+1].text=opt_name4[k]+"(+"+opt_price4[k]+"원 재고 :"+opt_ea4[k]+"개 code"+opt_code4[k]+")";
	
	for(j=0;j<opt_name4.length;j++){
		if(opt_price4[j]){
			frm.opt_price4.value+=opt_price4[j]+"|";
			frm.opt_name4.value+=opt_name4[j]+"|";
			frm.opt_ea4.value+=opt_ea4[j]+"|";
			frm.opt_code4.value+=opt_code4[j]+"|";
		}
	}
	frm.optName4.value="";
	frm.optPrice4.value="";
	frm.optEa4.value="";
	frm.optCode4.value="";
	frm.optName4.focus();
	var modify4=document.getElementById("modify4");
	modify4.style.display="none";
}
function opt_del4(frm){
	var sel=false;
	var opt_price4=frm.opt_price4.value.split("|");
	var opt_name4=frm.opt_name4.value.split("|");
	var opt_ea4=frm.opt_ea4.value.split("|");
	var opt_order4=frm.opt_order4.value.split("|");
	var opt_code=frm.opt_code4.value.split("|");
	frm.opt_price4.value="";
	frm.opt_name4.value="";
	frm.opt_ea4.value="";
	frm.opt_order4.value="";
	frm.opt_code4.value="";
	var k=0;
	for(i=1;i<frm.opt4.options.length;i++){
		if(frm.opt4.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt4.options[k+1]=null;
	
	opt_price4.splice(k,1);
	opt_ea4.splice(k,1);
	opt_name4.splice(k,1);
	opt_order4.splice(k,1);
	opt_code4.splice(k,1);
	for(j=0;j<opt_name4.length;j++){
		if(opt_price4[j]){
			frm.opt_price4.value+=opt_price4[j]+"|";
			frm.opt_name4.value+=opt_name4[j]+"|";
			frm.opt_ea4.value+=opt_ea4[j]+"|";
			frm.opt_order4.value+=opt_order4[j]+"|";
			frm.opt_code4.value+=opt_code4[j]+"|";
		}
	}
	frm.optName4.value="";
	frm.optPrice4.value="";
	frm.optEa4.value="";
	frm.optCode4.value="";
	frm.optName4.focus();
	var modify4=document.getElementById("modify4");    
	modify4.style.display="none";
}
function opt_rank4(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name4=frm.opt_name4.value.split("|");
	var opt_ea4=frm.opt_ea4.value.split("|");
	var opt_price4=frm.opt_price4.value.split("|");
	var opt_code4=frm.opt_code4.value.split("|");


	for(i=1;i<frm.opt4.options.length;i++){
		if(frm.opt4.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt4.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name4[k-1];
	saveOptPrice=opt_price4[k-1];
	saveOptEa=opt_ea4[k-1];
	saveOptCode=opt_code4[k-1];
	
	opt_name4[k-1]=opt_name4[j-1];
	opt_price4[k-1]=opt_price4[j-1];
	opt_ea4[k-1]=opt_ea4[j-1];
	opt_code4[k-1]=opt_code4[j-1];
	
	opt_name4[j-1]=saveOptName;
	opt_price4[j-1]=saveOptPrice;
	opt_ea4[j-1]=saveOptEa;
	opt_code4[j-1]=saveOptCode;

	
	var optPrice4="";
	var optName4="";
	var optEa4="";
	var optCode4="";
	frm.opt_price4.value="";
	frm.opt_name4.value="";
	frm.opt_ea4.value="";
	frm.opt_code4.value="";
	for(z=0;z<opt_name4.length;z++){
		if(opt_name4[z]){
			optPrice4+=opt_price4[z]+"|";
			optName4+=opt_name4[z]+"|";
			optEa4+=opt_ea4[z]+"|";
			optCode4+=opt_code4[z]+"|";
		}
	}
	frm.opt_price4.value=optPrice4;
	frm.opt_name4.value=optName4;
	frm.opt_ea4.value=optEa4;
	frm.opt_code4.value=optCode4;

	changeOptionText=frm.opt4.options[j].text;
	changeOptionValue=frm.opt4.options[j].text;
	frm.opt4.options[j].text=frm.opt4.options[k].text;
	frm.opt4.options[j].value=frm.opt4.options[k].value;
	frm.opt4.options[k].text=changeOptionText;
	frm.opt4.options[k].value=changeOptionValue;
	frm.optName4.value="";
	frm.optPrice4.value="";
	frm.optEa4.value="";
	frm.optCode4.value="";
	frm.opt4.options[j].selected=true;
	var modify4=document.getElementById("modify4");
	modify4.style.display="none";
	
	
}






function opt_add5(frm){
	var opt_price5=0;
	var opt_ea5=0;
	var option=document.createElement("option");
	if(!frm.op_name5.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name5.focus();
		return;
	}
	if(!frm.optName5.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName5.focus();
		return;
	}
	if(!frm.optPrice5.value){
		opt_price5=0;
	}else{
		opt_price5=frm.optPrice5.value;
	}
	if(!frm.optEa5.value){
		opt_ea5=0;
	}else{
		opt_ea5=frm.optEa5.value;
	}
	frm.opt_name5.value+=frm.optName5.value+"|";
	frm.opt_price5.value+=+opt_price5+"|";
	frm.opt_ea5.value+=frm.optEa5.value+"|";
	frm.opt_order5.value+=opt_order5+"|";
	frm.opt_code5.value+=frm.optCode5.value+"|";
	option.value=frm.optName5.value+"(+"+opt_price5+"원)";
	option.text=frm.optName5.value+"(+"+opt_price5+"원 재고: "+opt_ea5+"개 code"+frm.optCode5.value+")";
	document.all.opt5.add(option);
	frm.optName5.value="";
	frm.optPrice5.value="";
	frm.optEa5.value="";
	frm.optCode5.value="";
	frm.optName5.focus();
	var modify5=document.getElementById("modify5");
	modify5.style.display="none";

	opt_order5++;
}

function opt_change5(opt){
	var frm=document.writeform;
	var opt_price5=frm.opt_price5.value.split("|");
	var opt_name5=frm.opt_name5.value.split("|");
	var opt_ea5=frm.opt_ea5.value.split("|");
	var opt_code5=frm.opt_code5.value.split("|");
	var modify5=document.getElementById("modify5");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName5.value=opt_name5[i-1];
			frm.optEa5.value=opt_ea5[i-1];
			frm.optPrice5.value=opt_price5[i-1];
			frm.optCode5.value=opt_code5[i-1];
			modify5.style.display="inline";
			break;
		}
	}
}
function opt_modify5(frm){
	var sel=false;
	var opt_price5=frm.opt_price5.value.split("|");
	var opt_name5=frm.opt_name5.value.split("|");
	var opt_ea5=frm.opt_ea5.value.split("|");
	var opt_code5=frm.opt_code5.value.split("|");
	frm.opt_price5.value="";
	frm.opt_name5.value="";
	frm.opt_ea5.value="";
	frm.opt_code5.value="";
	var k=0;
	for(i=1;i<frm.opt5.options.length;i++){
		if(frm.opt5.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price5[k]=frm.optPrice5.value;
	opt_ea5[k]=frm.optEa5.value;
	opt_name5[k]=frm.optName5.value;
	opt_code5[k]=frm.optCode5.value;
	frm.opt5.options[k+1].value=opt_name5[k]+"(+"+opt_price5[k]+"원)";
	frm.opt5.options[k+1].text=opt_name5[k]+"(+"+opt_price5[k]+"원 재고 :"+opt_ea5[k]+"개 code"+opt_code5[k]+")";
	
	for(j=0;j<opt_name5.length;j++){
		if(opt_price5[j]){
			frm.opt_price5.value+=opt_price5[j]+"|";
			frm.opt_name5.value+=opt_name5[j]+"|";
			frm.opt_ea5.value+=opt_ea5[j]+"|";
			frm.opt_code5.value+=opt_code5[j]+"|";
		}
	}
	frm.optName5.value="";
	frm.optPrice5.value="";
	frm.optEa5.value="";
	frm.optCode5.value="";
	frm.optName5.focus();
	var modify5=document.getElementById("modify5");
	modify5.style.display="none";
}
function opt_del5(frm){
	var sel=false;
	var opt_price5=frm.opt_price5.value.split("|");
	var opt_name5=frm.opt_name5.value.split("|");
	var opt_ea5=frm.opt_ea5.value.split("|");
	var opt_order5=frm.opt_order5.value.split("|");
	var opt_code=frm.opt_code5.value.split("|");
	frm.opt_price5.value="";
	frm.opt_name5.value="";
	frm.opt_ea5.value="";
	frm.opt_order5.value="";
	frm.opt_code5.value="";
	var k=0;
	for(i=1;i<frm.opt5.options.length;i++){
		if(frm.opt5.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt5.options[k+1]=null;
	
	opt_price5.splice(k,1);
	opt_ea5.splice(k,1);
	opt_name5.splice(k,1);
	opt_order5.splice(k,1);
	opt_code5.splice(k,1);
	for(j=0;j<opt_name5.length;j++){
		if(opt_price5[j]){
			frm.opt_price5.value+=opt_price5[j]+"|";
			frm.opt_name5.value+=opt_name5[j]+"|";
			frm.opt_ea5.value+=opt_ea5[j]+"|";
			frm.opt_order5.value+=opt_order5[j]+"|";
			frm.opt_code5.value+=opt_code5[j]+"|";
		}
	}
	frm.optName5.value="";
	frm.optPrice5.value="";
	frm.optEa5.value="";
	frm.optCode5.value="";
	frm.optName5.focus();
	var modify5=document.getElementById("modify5");    
	modify5.style.display="none";
}
function opt_rank5(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name5=frm.opt_name5.value.split("|");
	var opt_ea5=frm.opt_ea5.value.split("|");
	var opt_price5=frm.opt_price5.value.split("|");
	var opt_code5=frm.opt_code5.value.split("|");


	for(i=1;i<frm.opt5.options.length;i++){
		if(frm.opt5.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt5.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name5[k-1];
	saveOptPrice=opt_price5[k-1];
	saveOptEa=opt_ea5[k-1];
	saveOptCode=opt_code5[k-1];
	
	opt_name5[k-1]=opt_name5[j-1];
	opt_price5[k-1]=opt_price5[j-1];
	opt_ea5[k-1]=opt_ea5[j-1];
	opt_code5[k-1]=opt_code5[j-1];
	
	opt_name5[j-1]=saveOptName;
	opt_price5[j-1]=saveOptPrice;
	opt_ea5[j-1]=saveOptEa;
	opt_code5[j-1]=saveOptCode;

	
	var optPrice5="";
	var optName5="";
	var optEa5="";
	var optCode5="";
	frm.opt_price5.value="";
	frm.opt_name5.value="";
	frm.opt_ea5.value="";
	frm.opt_code5.value="";
	for(z=0;z<opt_name5.length;z++){
		if(opt_name5[z]){
			optPrice5+=opt_price5[z]+"|";
			optName5+=opt_name5[z]+"|";
			optEa5+=opt_ea5[z]+"|";
			optCode5+=opt_code5[z]+"|";
		}
	}
	frm.opt_price5.value=optPrice5;
	frm.opt_name5.value=optName5;
	frm.opt_ea5.value=optEa5;
	frm.opt_code5.value=optCode5;

	changeOptionText=frm.opt5.options[j].text;
	changeOptionValue=frm.opt5.options[j].text;
	frm.opt5.options[j].text=frm.opt5.options[k].text;
	frm.opt5.options[j].value=frm.opt5.options[k].value;
	frm.opt5.options[k].text=changeOptionText;
	frm.opt5.options[k].value=changeOptionValue;
	frm.optName5.value="";
	frm.optPrice5.value="";
	frm.optEa5.value="";
	frm.optCode5.value="";
	frm.opt5.options[j].selected=true;
	var modify5=document.getElementById("modify5");
	modify5.style.display="none";
	
	
}

function opt_add6(frm){
	var opt_price6=0;
	var opt_ea6=0;
	var option=document.createElement("option");
	if(!frm.op_name6.value){
		alert("옵션명을 입력하십시오.");
		frm.op_name6.focus();
		return;
	}
	if(!frm.optName6.value){
		alert("옵션 항목을 입력하십시오");
		frm.optName6.focus();
		return;
	}
	if(!frm.optPrice6.value){
		opt_price6=0;
	}else{
		opt_price6=frm.optPrice6.value;
	}
	if(!frm.optEa6.value){
		opt_ea6=0;
	}else{
		opt_ea6=frm.optEa6.value;
	}
	frm.opt_name6.value+=frm.optName6.value+"|";
	frm.opt_price6.value+=+opt_price6+"|";
	frm.opt_ea6.value+=frm.optEa6.value+"|";
	frm.opt_order6.value+=opt_order6+"|";
	frm.opt_code6.value+=frm.optCode6.value+"|";
	option.value=frm.optName6.value+"(+"+opt_price6+"원)";
	option.text=frm.optName6.value+"(+"+opt_price6+"원 재고: "+opt_ea6+"개 code"+frm.optCode6.value+")";
	document.all.opt6.add(option);
	frm.optName6.value="";
	frm.optPrice6.value="";
	frm.optEa6.value="";
	frm.optCode6.value="";
	frm.optName6.focus();
	var modify6=document.getElementById("modify6");
	modify6.style.display="none";

	opt_order6++;
}

function opt_change6(opt){
	var frm=document.writeform;
	var opt_price6=frm.opt_price6.value.split("|");
	var opt_name6=frm.opt_name6.value.split("|");
	var opt_ea6=frm.opt_ea6.value.split("|");
	var opt_code6=frm.opt_code6.value.split("|");
	var modify6=document.getElementById("modify6");
	for(i=0;i<opt.options.length;i++){
		if(opt.options[i].selected){
			frm.optName6.value=opt_name6[i-1];
			frm.optEa6.value=opt_ea6[i-1];
			frm.optPrice6.value=opt_price6[i-1];
			frm.optCode6.value=opt_code6[i-1];
			modify6.style.display="inline";
			break;
		}
	}
}
function opt_modify6(frm){
	var sel=false;
	var opt_price6=frm.opt_price6.value.split("|");
	var opt_name6=frm.opt_name6.value.split("|");
	var opt_ea6=frm.opt_ea6.value.split("|");
	var opt_code6=frm.opt_code6.value.split("|");
	frm.opt_price6.value="";
	frm.opt_name6.value="";
	frm.opt_ea6.value="";
	frm.opt_code6.value="";
	var k=0;
	for(i=1;i<frm.opt6.options.length;i++){
		if(frm.opt6.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("입력된 옵션을 선택하셔야 합니다.");
		return;
	}
	opt_price6[k]=frm.optPrice6.value;
	opt_ea6[k]=frm.optEa6.value;
	opt_name6[k]=frm.optName6.value;
	opt_code6[k]=frm.optCode6.value;
	frm.opt6.options[k+1].value=opt_name6[k]+"(+"+opt_price6[k]+"원)";
	frm.opt6.options[k+1].text=opt_name6[k]+"(+"+opt_price6[k]+"원 재고 :"+opt_ea6[k]+"개 code"+opt_code6[k]+")";
	
	for(j=0;j<opt_name6.length;j++){
		if(opt_price6[j]){
			frm.opt_price6.value+=opt_price6[j]+"|";
			frm.opt_name6.value+=opt_name6[j]+"|";
			frm.opt_ea6.value+=opt_ea6[j]+"|";
			frm.opt_code6.value+=opt_code6[j]+"|";
		}
	}
	frm.optName6.value="";
	frm.optPrice6.value="";
	frm.optEa6.value="";
	frm.optCode6.value="";
	frm.optName6.focus();
	var modify6=document.getElementById("modify6");
	modify6.style.display="none";
}
function opt_del6(frm){
	var sel=false;
	var opt_price6=frm.opt_price6.value.split("|");
	var opt_name6=frm.opt_name6.value.split("|");
	var opt_ea6=frm.opt_ea6.value.split("|");
	var opt_order6=frm.opt_order6.value.split("|");
	var opt_code=frm.opt_code6.value.split("|");
	frm.opt_price6.value="";
	frm.opt_name6.value="";
	frm.opt_ea6.value="";
	frm.opt_order6.value="";
	frm.opt_code6.value="";
	var k=0;
	for(i=1;i<frm.opt6.options.length;i++){
		if(frm.opt6.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("삭제할 옵션을 선택하셔야 합니다.");
		return;
	}
	
	frm.opt6.options[k+1]=null;
	
	opt_price6.splice(k,1);
	opt_ea6.splice(k,1);
	opt_name6.splice(k,1);
	opt_order6.splice(k,1);
	opt_code6.splice(k,1);
	for(j=0;j<opt_name6.length;j++){
		if(opt_price6[j]){
			frm.opt_price6.value+=opt_price6[j]+"|";
			frm.opt_name6.value+=opt_name6[j]+"|";
			frm.opt_ea6.value+=opt_ea6[j]+"|";
			frm.opt_order6.value+=opt_order6[j]+"|";
			frm.opt_code6.value+=opt_code6[j]+"|";
		}
	}
	frm.optName6.value="";
	frm.optPrice6.value="";
	frm.optEa6.value="";
	frm.optCode6.value="";
	frm.optName6.focus();
	var modify6=document.getElementById("modify6");    
	modify6.style.display="none";
}
function opt_rank6(arrow){
	var frm=document.writeform;
	var k=0;
	var changeOption="";
	var currentOption="";
	var j=0;

	var opt_name6=frm.opt_name6.value.split("|");
	var opt_ea6=frm.opt_ea6.value.split("|");
	var opt_price6=frm.opt_price6.value.split("|");
	var opt_code6=frm.opt_code6.value.split("|");


	for(i=1;i<frm.opt6.options.length;i++){
		if(frm.opt6.options[i].selected){
			k=i;
			break;
		}
	}
	
	if(arrow=="up"){
		j=k-1;
		
	}else if(arrow=="down"){
		j=k+1;
	}
	if(j==0){
		alert("더 이상 올릴 수 없습니다.");
		return;
	}
	if(j==frm.opt6.options.length){
		alert("더 이상 내릴 수 없습니다.");
		return;
	}
	
	


	saveOptName=opt_name6[k-1];
	saveOptPrice=opt_price6[k-1];
	saveOptEa=opt_ea6[k-1];
	saveOptCode=opt_code6[k-1];
	
	opt_name6[k-1]=opt_name6[j-1];
	opt_price6[k-1]=opt_price6[j-1];
	opt_ea6[k-1]=opt_ea6[j-1];
	opt_code6[k-1]=opt_code6[j-1];
	
	opt_name6[j-1]=saveOptName;
	opt_price6[j-1]=saveOptPrice;
	opt_ea6[j-1]=saveOptEa;
	opt_code6[j-1]=saveOptCode;

	
	var optPrice6="";
	var optName6="";
	var optEa6="";
	var optCode6="";
	frm.opt_price6.value="";
	frm.opt_name6.value="";
	frm.opt_ea6.value="";
	frm.opt_code6.value="";
	for(z=0;z<opt_name6.length;z++){
		if(opt_name6[z]){
			optPrice6+=opt_price6[z]+"|";
			optName6+=opt_name6[z]+"|";
			optEa6+=opt_ea6[z]+"|";
			optCode6+=opt_code6[z]+"|";
		}
	}
	frm.opt_price6.value=optPrice6;
	frm.opt_name6.value=optName6;
	frm.opt_ea6.value=optEa6;
	frm.opt_code6.value=optCode6;

	changeOptionText=frm.opt6.options[j].text;
	changeOptionValue=frm.opt6.options[j].text;
	frm.opt6.options[j].text=frm.opt6.options[k].text;
	frm.opt6.options[j].value=frm.opt6.options[k].value;
	frm.opt6.options[k].text=changeOptionText;
	frm.opt6.options[k].value=changeOptionValue;
	frm.optName6.value="";
	frm.optPrice6.value="";
	frm.optEa6.value="";
	frm.optCode6.value="";
	frm.opt6.options[j].selected=true;
	var modify6=document.getElementById("modify6");
	modify6.style.display="none";
	
	
}

</script>
<script>
/*
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
}*/

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
<SCRIPT LANGUAGE="JavaScript">
<!--
function toggle1(iobject){
		document.all.auto.style.display = ""
		document.all.passive.style.display = "none"
}	
function toggle2(iobject){
		document.all.auto.style.display = "none"
		document.all.passive.style.display = ""
}
//-->
</SCRIPT>

<style>

.style1 {
	color: #FF0000;
	font-weight: bold;
}
</style>


</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="70%" height="100%"  border="0" cellpadding="0" cellspacing="0">
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
				<!--<input type="hidden" name="op1" value="">
				<input type="hidden" name="op2" value="">
				<input type="hidden" name="op3" value="">-->
				<input type="hidden" name="doctype" value="0">
				<!--<input type="hidden" name="opt">-->
				<input type="hidden" name="use_opt1">
				<input type="hidden" name="use_opt23">
				<input type="hidden" name="reg_date" value='<?=$reg_date?>'>
				<input type="hidden" name="provider_id" value="<?=$Mall_Admin_ID?>">
				<!-- 옵션 항목 추가 할 때 쓰이는 폼-->
				<input type="hidden" name="opt_order" value="1|2|3|">
				<input type="hidden" name="opt_name" value="샴페인|샴페인|샴페인|">
				<input type="hidden" name="opt_price" value="10000|20000|30000|">
				<input type="hidden" name="opt_ea" value="">
				<input type="hidden" name="opt_code" value="">

				<input type="hidden" name="opt_order2" value="1|2|3|">
				<input type="hidden" name="opt_name2" value="케이크|케이크|케이크|">
				<input type="hidden" name="opt_price2" value="25000|35000|45000|">
				<input type="hidden" name="opt_ea2" value="">
				<input type="hidden" name="opt_code2" value="">

				<input type="hidden" name="opt_order3" value="1|2|3|">
				<input type="hidden" name="opt_name3" value="캔디|캔디|캔디|">
				<input type="hidden" name="opt_price3" value="10000|20000|30000|">
				<input type="hidden" name="opt_ea3" value="">
				<input type="hidden" name="opt_code3" value="">

				<input type="hidden" name="opt_order4" value="1|2|3|">
				<input type="hidden" name="opt_name4" value="코사지1개|코사지2개|코사지3개|">
				<input type="hidden" name="opt_price4" value="6000|12000|18000|">
				<input type="hidden" name="opt_ea4" value="">
				<input type="hidden" name="opt_code4" value="">

				<input type="hidden" name="opt_order5" value="1|2|3|">
				<input type="hidden" name="opt_name5" value="초코릿|초코릿|초코릿|">
				<input type="hidden" name="opt_price5" value="10000|15000|20000|">
				<input type="hidden" name="opt_ea5" value="">
				<input type="hidden" name="opt_code5" value="">

				<input type="hidden" name="opt_order6" value="1|2|3|">
				<input type="hidden" name="opt_name6" value="장미1송이|장미5송이|장미10송이|">
				<input type="hidden" name="opt_price6" value="4000|20000|40000|">
				<input type="hidden" name="opt_ea6" value="">
				<input type="hidden" name="opt_code6" value="">
				<!-- 옵션 항목 추가 할 때 쓰이는 폼-->
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
								<input name="price" class='input' size="14" onKeyUp="this.value=comma(this.value);" onKeyDown="checkNumber()">
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
								<input name="jaego" class='input' size="14" onKeyUp="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>
			              </tr>
<!--
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
-->
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								원산지
							</td>
			                <td bgColor="#ffffff">
								<input name="item_origin" value="<?=$item_origin?>" class='input' size="25">
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								유통기한
							</td>
			                <td bgColor="#ffffff">
								<input name="item_bestbefore" value="<?=$item_bestbefore?>" class='input' size="25">
							</td>
			              </tr>
						  <tr>
			           <td align='center' bgColor="#c8dfec" colSpan="2">
								판매가
								</td>
			          <td bgColor="#ffffff">
									<table>
										<tr>
											<td>기본가격</td>
											<td><input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()" <?if($bonus_auto_ok=='t'){?>onKeyUp="checkPrice()"<?}?>></td>
										</tr>
										<tr>
											<td>고급가격:</td>
											<td><input name="z_price2" value="<?=$z_price?>" class='input' size="14"></td>
										</tr>
										<tr>
											<td>특품가격:</td>
											<td><input name="z_price3" value="<?=$z_price?>" class='input' size="14"></td>
										</tr>
									</table>
									
									
									
									
									
									

								</td>							
			          <td align='center' bgColor="#c8dfec" colSpan="2">
									포인트
								</td>
			          <td bgColor="#ffffff">
								<table>
										<tr>
											<td>기본포인트</td>
											<td><input name="bonus" value="<?=$bonus?>"  class='input' size="14"> </td>
										</tr>
										<tr>
											<td>고급포인트</td>
											<td><input name="bonus2" value="<?=$bonus2?>"  class='input' size="14"> </td>
										</tr>
										<tr>
											<td>특품포인트</td>
											<td><input name="bonus3" value="<?=$bonus3?>"  class='input' size="14"> </td>
										</tr>
									</table>
								
								<?if($bonus_auto_ok=='t'){
								//	echo"($bonus_auto_percent"."%&nbsp;자동적용중)";
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
								<input type="radio" value="0" name="if_cash" <?if($if_cash == '0') echo "checked";?>>해제하기
								<input type="radio" value="1" name="if_cash">현금전용결제<br>
								<input type="radio" value="2" name="if_cash">포인트전용결제<br>
								<font color="#C00000"> (현금전용 결제기능입니다. 타 상품과 같이 구매시, 현금결제만 가능합니다.)</font><br>
							</td>
			              </tr>
			              <tr>
			                <td align='center' width="100%" bgColor="#ffffff" colSpan="6">
								<br><font color="#0000ff">
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

</table>
<table bgcolor=#ffffff border="0" width="100%" cellpadding=1 cellspacing=1>
	<tr>
		<td align=center bgcolor=#ffffff colspan=6>
			 <input type=radio name="thumbnail" value="y" onClick="toggle1()" checked>썸네일사용 <input type=radio name="thumbnail" value="n" onClick="toggle2()">개별등록하기
		</td>
	</tr>
</table>
<table border="0" width="100%" cellpadding=1 cellspacing=1 id="auto">

               			<tr>
			                <td align='center' width="80" bgColor="#c8dfec" colspan="2">
								제품<br>이미지
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;1.<input type="file" name="img_big" class='input' size="60"> <br>
								&nbsp;2.<input type="file" name="img_big2" class='input' size="60"> <br>
								&nbsp;3.<input type="file" name="img_big3" class='input' size="60"><br>
								&nbsp;4.<input type="file" name="img_big4" class='input' size="60"><br>
								&nbsp;5.<input type="file" name="img_big5" class='input' size="60"><br>
							</td>
			              </tr>

			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6">
								<img height="15" src="../images/tip.gif" width="30">
							  <font color="#0000ff"> 리스트, 상세이미지는 1번 이미지로 자동 생성됩니다.<br>
                              <img height="15" src="../images/tip.gif" width="30"> <strong>리스트이미지는 가로사이즈를 기준으로 출력되오니 가로×세로 비율을 맞추어 올려주시길 권장합니다.</strong><br>
                              <a href="javascript:;" onClick="window.open('pop_alsee.php','popup','resizable=no,width=650,height=800,scrollbars=yes')"><img src="../images/info_bn.gif" style="margin:5px 0 10px 5px;"></a><br>							
							  용량제한 : 5M(5120000byte)<BR>								
								종류제한 : 이미지는 jpg,gif,bmp를 지원합니다.<BR>
							  이미지 사이즈는 자동 조절되어서 생성됩니다.</font></td>
			              </tr>
</table>
<table border="0" width="100%" cellpadding=1 cellspacing=1 id="passive" style="display:none">


              			<tr>
			                <td align='center' width="8%" bgColor="#c8dfec" rowspan="3">
								제품<br>이미지
							</td>
			                <td align='center' width="7%" bgColor="#E8F1F7">
								리스트
							</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
								&nbsp;1.<input type="file" name="zimg_sml" class='input' size="60">
			                </td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								상세
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;1.<input type="file" name="zimg" class='input' size="60">
			                </td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								확대
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;1.<input type="file" name="zimg_big" class='input' size="60"> <br>
								&nbsp;2.<input type="file" name="zimg_big2" class='input' size="60"> <br>
								&nbsp;3.<input type="file" name="zimg_big3" class='input' size="60"><br>
								&nbsp;4.<input type="file" name="zimg_big4" class='input' size="60"><br>
								&nbsp;5.<input type="file" name="zimg_big5" class='input' size="60"><br>
								
							</td>
			              </tr>
			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6">
								<img height="15" src="../images/tip.gif" width="30">
								<font color="#0000ff"> 개별 이미지 등록(움직이는 이미지 등록가능)<br>							
								용량제한 : 5M(5120000byte)<BR>								
								종류제한 : 이미지는 jpg,gif,bmp를 지원합니다<BR>
								이미지크기 : 리스트130px 상세300px 확대600px</font>
							</td>
			              </tr>
</table>
<table border="0" width="100%" cellpadding=1 cellspacing=1>
						  <tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
								아이콘 선택
							</td>
                			<td bgcolor="#FFFFFF" align="left" colspan="4">
                				<input name="icon_no" type="radio" value="0" checked><font color="#0000FF">사용않음</font>&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="1"><img src="../images/1.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="2"><img src="../images/2.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="3"><img src="../images/3.gif" >&nbsp;&nbsp;
                				<input name="icon_no" type="radio" value="4"><img src="../images/4.gif"><br>
								<input name="icon_no" type="radio" value="5"><img src="../images/5.gif" >&nbsp;&nbsp;
								<input name="icon_no" type="radio" value="6"><img src="../images/6.gif" >&nbsp;&nbsp;
								<input name="icon_no" type="radio" value="7"><img src="../images/7.gif" >&nbsp;&nbsp;
								<input name="icon_no" type="radio" value="8"><img src="../images/8.gif" >&nbsp;&nbsp;
								<input name="icon_no" type="radio" value="9"><img src="../images/9.gif" ><br>
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
                				상품 설명<br>
<span class="style1">가로 800px 이하 사이즈의 이미지 파일을 등록하세요.</span>
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">								

<!--------------------------------------- 에디터 시작 ------------------------------------------------------>
<script type="text/javascript" src="../../smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<input type='hidden' name='secontent' value=''>
<textarea name="item_explain" id="item_explain" rows="10" cols="100" style="width:667px; height:412px; display:none;"><?=$item_explain?></textarea>
<script type="text/javascript">
var oEditors = [],ed_nonce = "<?=ft_nonce_create('smarteditor');?>";
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "item_explain",
	sSkinURI: "../../smarteditor2/SmartEditor2Skin.html",	
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
              			<!--<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk" checked> 가격차등 옵션사용
							</td>
              			</tr>-->
              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14" value="<?=$optionNameArray[1]?>">
								<input type="checkbox" name="if_opt_jaego" value="1">재고관리
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt1" size="6" style="width:250" onChange="opt_change(this)">
													<option>-------------------------------------</option>
													<option value="">샴페인(+10000원 재고 개 code )</option>
													<option value="">샴페인(+20000원 재고 개 code )</option>
													<option value="">샴페인(+30000원 재고 개 code )</option>

												</select><br>
        						<input type="button" value="▲" onClick="opt_rank('up')">
								<input type="button" value="▼" onClick="opt_rank('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션가격
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				재고수량
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션코드
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify">
                				<input onclick="opt_add(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="opt_del(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
              			

						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						
						
						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목2
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name2" size="14" value="<?=$optionNameArray[2]?>">
								<input type="checkbox" name="if_opt_jaego2" value="1">재고관리
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt2" size="6" style="width:250" onChange="opt_change2(this)">
													<option>-------------------------------------</option>
													<option value="">케이크(+25000원 재고 개 code )</option>
													<option value="">케이크(+35000원 재고 개 code )</option>
													<option value="">케이크(+45000원 재고 개 code )</option>
												</select>
												<br>
        						<input type="button" value="▲" onClick="opt_rank2('up')">
								<input type="button" value="▼" onClick="opt_rank2('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName2" size="14" value="">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션가격2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				재고수량2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션코드2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify2(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify2">
                				<input onclick="opt_add2(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="opt_del2(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>
						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션제목3
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name3" size="14"  value="<?=$optionNameArray[3]?>">
								<input type="checkbox" name="if_opt_jaego3" value="1">재고관리
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt3" size="6" style="width:250" onChange="opt_change3(this)">
													<option>-------------------------------------</option>
													<option value="">캔디(+10000원 재고 개 code )</option>
													<option value="">캔디(+20000원 재고 개 code )</option>
													<option value="">캔디(+30000원 재고 개 code )</option>

												</select><br>
        						<input type="button" value="▲" onClick="opt_rank3('up')">
								<input type="button" value="▼" onClick="opt_rank3('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션항목3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName3" size="14"  value="<?=$optNameArray[3]?>">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션가격3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				재고수량3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				옵션코드3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify3(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify3">
                				<input onclick="opt_add3(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                				<input onclick="opt_del3(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                			</td>
              			</tr>



						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						<tr>
               <td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">옵션제목4</td>
         			 <td width="25%" bgcolor="#FFFFFF">
								<input class='input' name="op_name4" size="14" value="<?=$optionNameArray[4]?>">
								<input type="checkbox" name="if_opt_jaego4" value="1">재고관리
							 </td>
                <td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
									<select name="opt4" size="6" style="width:250" onChange="opt_change4(this)">
          						<option>-------------------------------------</option>
											<option value="">코사지1개(+6000원 재고 개 code )</option>
											<option value="">코사지2개(+12000원 재고 개 code )</option>
											<option value="">코사지3개(+18000원 재고 개 code )</option>
        					</select><br>
        				<input type="button" value="▲" onClick="opt_rank4('up')">
								<input type="button" value="▼" onClick="opt_rank4('down')">
							</td>
            </tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션항목4</td>
								<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optName4" size="14" value=""></td>
       			</tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션가격4</td>
           			<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optPrice4" size="14"></td>
       			</tr>
						<tr>
               	<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">재고수량4</td>
                <td width="35%" bgcolor="#FFFFFF"><input class='input' name="optEa4" size="14"></td>
       			</tr>
						<tr>
            		<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션코드4</td>
           			<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optCode4" size="14"></td>
      			</tr>
						<tr>
              	<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
									<input onclick="opt_modify4(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify4">
                	<input onclick="opt_add4(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                	<input onclick="opt_del4(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                </td>
            </tr>

						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						<tr>
               <td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">옵션제목5</td>
         			 <td width="25%" bgcolor="#FFFFFF">
								<input class='input' name="op_name5" size="14" value="<?=$optionNameArray[5]?>">
								<input type="checkbox" name="if_opt_jaego5" value="1">재고관리
							 </td>
                <td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
									<select name="opt5" size="6" style="width:250" onChange="opt_change5(this)">
          						<option value="">초코릿(+10000원 재고 개 code )</option>
											<option value="">초코릿(+15000원 재고 개 code )</option>
											<option value="">초코릿(+20000원 재고 개 code )</option>

        					</select><br>
        				<input type="button" value="▲" onClick="opt_rank5('up')">
								<input type="button" value="▼" onClick="opt_rank5('down')">
							</td>
            </tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션항목5</td>
								<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optName5" size="14" value="<?=$optNameArray[5]?>"></td>
       			</tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션가격5</td>
           			<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optPrice5" size="14"></td>
       			</tr>
						<tr>
               	<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">재고수량5</td>
                <td width="35%" bgcolor="#FFFFFF"><input class='input' name="optEa5" size="14"></td>
       			</tr>
						<tr>
            		<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션코드5</td>
           			<td width="35%" bgcolor="#FFFFFF"><input class='input' name="optCode5" size="14"></td>
      			</tr>
						<tr>
              	<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
									<input onclick="opt_modify5(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify5">
                	<input onclick="opt_add5(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                	<input onclick="opt_del5(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
                </td>
            </tr>

						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						<tr>
               <td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">옵션제목6</td>
         			 <td width="26%" bgcolor="#FFFFFF">
								<input class='input' name="op_name6" size="14" value="<?=$optionNameArray[6]?>">
								<input type="checkbox" name="if_opt_jaego6" value="1">재고관리
							 </td>
                <td width="60%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
									<select name="opt6" size="6" style="width:260" onChange="opt_change6(this)">
          						<option value="">장미1송이(+4000원 재고 개 code )</option>
											<option value="">장미5송이(+20000원 재고 개 code )</option>
											<option value="">장미10송이(+40000원 재고 개 code )</option>
        					</select><br>
        				<input type="button" value="▲" onClick="opt_rank6('up')">
								<input type="button" value="▼" onClick="opt_rank6('down')">
							</td>
            </tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션항목6</td>
								<td width="36%" bgcolor="#FFFFFF"><input class='input' name="optName6" size="14" value="<?=$optNameArray[6]?>"></td>
       			</tr>
						<tr>
								<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션가격6</td>
           			<td width="36%" bgcolor="#FFFFFF"><input class='input' name="optPrice6" size="14"></td>
       			</tr>
						<tr>
               	<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">재고수량6</td>
                <td width="36%" bgcolor="#FFFFFF"><input class='input' name="optEa6" size="14"></td>
       			</tr>
						<tr>
            		<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">옵션코드6</td>
           			<td width="36%" bgcolor="#FFFFFF"><input class='input' name="optCode6" size="14"></td>
      			</tr>
						<tr>
              	<td width="60%" bgcolor="#FFFFFF" align="center" colspan="3">
									<input onclick="opt_modify6(this.form)" class='butt_none' style='width:60' type="button" value="수 정" style='cursor:hand;display:none' id="modify6">
                	<input onclick="opt_add6(this.form)" class='butt_none' style='width:60' type="button" value="입 력" style='cursor:hand'>
                	<input onclick="opt_del6(this.form)" class='butt_none' style='width:60' type="button" value="삭 제" style='cursor:hand'>
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
										제품의 옵션을 설정하는 부분으로써 각 상품의 옵션명과 옵션항목,옵션가격,재고수량을 기입하시면 됩니다.<br>
										<font color="red">옵션제목</font>을 입력하셔야 상품 상세페이지에 나옵니다.
										<br><br>
										1. <font color="blue">옵션제목</font> : 옵션제목은 상품의 옵션입니다.<br>
										예)의류는 사이즈, 신발은 발사이즈, 컴퓨터는 부속품 옵션이 있듯이 상품에 대한 옵션을 적으시면 됩니다.<br>
										2. <font color="blue">옵션항목</font> : 옵션 항목은 옵션종류입니다.<br>
										예)사이즈-XL,L,S | 발사이즈 - 240,245,260,270 <br>
										3. <font color="blue">옵션가격</font> : 옵션가격은 각 옵션을 추가시에 추가요금입니다.<br> 각 상품 구매시 판매가에 추가된 금액으로 물건을 구매할 수 있습니다.<br>
										4. <font color="blue">옵션재고</font> : 각 옵션항목에 재고입니다. <br>
										예)사이즈 - 220 30개 <br>
										5. <font color="blue">재고관리</font> : 재고관리에 체크가 되어있으면 고객이 상품 구매시 자동으로 재고가 빠지게 하는 기능입니다.<br> 체크가 되어있지 않으면 자동으로 빠지지 않게 되므로 이 점을 유의해 주시길 바랍니다.
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
if($thumbnail == 'n'){
	$img_sml = $zimg_sml;
	$img_sml_name = $zimg_sml_name;

	$img = $zimg;
	$img_name = $zimg_name;

	$img_big = $zimg_big;
	$img_big_name = $zimg_big_name;

	$img_big2 = $zimg_big2;
	$img_big2_name = $zimg_big2_name;

	$img_big3 = $zimg_big3;
	$img_big3_name = $zimg_big3_name;

	$img_big4 = $zimg_big4;
	$img_big4_name = $zimg_big4_name;

	$img_big5 = $zimg_big5;
	$img_big5_name = $zimg_big5_name;
}
	if (isset($img_sml_name)&&($img_sml_name != "")){
		$size_sml = filesize($img_sml);
		$size_width_sml = getimagesize($img_sml);
	
		if($size_sml > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"리스트 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}
	if (isset($img_name)&&($img_name != "")){
		$size = filesize($img);
		$size_width = getimagesize($img);
	
		if($size > 5120000){
			echo ("
		<script language='javascript'>
			alert(\"상세 이미지의 크기는 5Mbyte를 넘을 수 없습니다.\");
			history.go(-1);
			exit;
		</script>
			");
			exit;
		}
	}	
	if (isset($img_big_name)&&($img_big_name != "")){
		$size_big = filesize($img_big);
		$size_width_big = getimagesize($img_big);
	
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
		$now_time = date("YmdHis");
##################################img_sml###############################################
	
	if (isset($img_sml_name)&&($img_sml_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_sml_name ){
		
			$img_sml_name = "s1_".$now_time.".jpg";

			$file = FileUploadName( "", "$upload", $img_sml, $img_sml_name );//파일을 업로드 함

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


##################################img###############################################
	
	if (isset($img_name)&&($img_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_name ){

			$img_name = "m1_".$now_time.".jpg";

			$file = FileUploadName( "", "$upload", $img, $img_name );//파일을 업로드 함

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






##################################img_big###############################################
	
	if (isset($img_big_name)&&($img_big_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big_name ){

			$img_big_name = "b1_".$now_time.".jpg";

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

			$img_big2_name = "b2_".$now_time.".jpg";

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

			$img_big3_name = "b3_".$now_time.".jpg";

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

			$img_big4_name = "b4_".$now_time.".jpg";

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

			$img_big5_name = "b5_".$now_time.".jpg";
			
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


	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		$img_sml_new = "item_sml_".$maxItem_no_1."_".$img_sml_name;
	}
	if($img_updateflag=="ok" && $img_name != ""){
		$img_new = "item_".$maxItem_no_1."_".$img_name;
	}

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





	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml_name"))
		copy ("$Co_img_UP$mart_id/$img_sml_name","$Co_img_UP$mart_id/$img_sml_new" );	//업로드 파일 저장
	}
	if($img_updateflag=="ok" && $img_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_name"))
		copy ("$Co_img_UP$mart_id/$img_name","$Co_img_UP$mart_id/$img_new" );	//업로드 파일 저장
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
	if($img_sml_updateflag=="ok" && $img_sml_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_sml_name"))
			unlink("$Co_img_UP$mart_id/$img_sml_name");
	}
	if($img_big_updateflag=="ok" && $img_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_name"))
			unlink("$Co_img_UP$mart_id/$img_name");
	}

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



if($thumbnail == 'y'){//썸네일 사용시

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
				$ThumFileName130 = $maxItem_no_1."_".$unique."_".$FileName."130.jpg";
				$ThumFileName300 = $maxItem_no_1."_".$unique."_".$FileName."300.jpg";
				$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName."600.jpg";
				
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
				$ThumFileName600 = $maxItem_no_1."_".$unique."_".$FileName . "600.jpg";
				
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
			$img_sml_new = $maxItem_no_1."_1_".$img_big_name."130.jpg";
			$img_new = $maxItem_no_1."_1_".$img_big_name."300.jpg";
			$img_big_new_th =  $maxItem_no_1."_1_".$img_big_name."600.jpg";
		}
		############## 썸네일 BIG2 #################
		if($img_big2_new){
			MakeThum2($img_big2_name,$rg_file2_path,$maxItem_no_1,$mart_id,2);
			$img_big2_new_th =  $maxItem_no_1."_2_".$img_big2_name."600.jpg";
		}
		############## 썸네일 BIG3 #################
		if($img_big3_new){
			MakeThum2($img_big3_name,$rg_file3_path,$maxItem_no_1,$mart_id,3); 
			$img_big3_new_th =  $maxItem_no_1."_3_".$img_big3_name."600.jpg";
		}
		############## 썸네일 BIG4 #################
		if($img_big4_new){
			MakeThum2($img_big4_name,$rg_file4_path,$maxItem_no_1,$mart_id,4); 
			$img_big4_new_th =  $maxItem_no_1."_4_".$img_big4_name."600.jpg";
		}
		############## 썸네일 BIG5 #################
		if($img_big5_new){
			MakeThum2($img_big5_name,$rg_file5_path,$maxItem_no_1,$mart_id,5); 
			$img_big5_new_th =  $maxItem_no_1."_5_".$img_big5_name."600.jpg";
		}
}else{
		$img_big_new_th = $img_big_new;
		$img_big2_new_th = $img_big2_new;
		$img_big3_new_th = $img_big3_new;
		$img_big4_new_th = $img_big4_new;
		$img_big5_new_th = $img_big5_new;
}



	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	$item_order = "1";//상품 출력 순서

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price,z_price2,z_price3, g_margin, member_price, bonus,bonus2,bonus3, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee, thumbnail,opt2,opt3,opt4,opt5,opt6,if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4,item_origin,item_bestbefore) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price','$z_price2','$z_price3', '$g_margin', '$member_price', '$bonus','$bonus2', '$bonus3','$use_bonus','$jaego','$img_new','$img_big_new_th','$img_big2_new_th','$img_big3_new_th','$img_big4_new_th','$img_big5_new_th','$op_name1','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee', '$thumbnail','$op_name2','$op_name3','$op_name4','$op_name5','$op_name6','$if_opt_jaego','$if_opt_jaego2','$if_opt_jaego3','$if_opt_jaego4','$item_origin','$item_bestbefore')";

	$dbresult = mysql_query($SQL, $dbconn);
	$sql="select max(item_no) as item_no from $ItemTable";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$item_no=$rs[item_no];
	$opt_name=explode("|",$opt_name);
	$opt_price=explode("|",$opt_price);
	$opt_ea=explode("|",$opt_ea);
	$opt_order=explode("|",$opt_order);
	$opt_code=explode("|",$opt_code);
	for($i=0;$i<sizeof($opt_name)-1;$i++){
		$sql="insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name[$i]','$opt_price[$i]','$opt_ea[$i]','$opt_order[$i]','$opt_code[$i]')";
		$result=mysql_query($sql);
	}
	
	$opt_name2=explode("|",$opt_name2);
	$opt_price2=explode("|",$opt_price2);
	$opt_ea2=explode("|",$opt_ea2);
	$opt_order2=explode("|",$opt_order2);
	$opt_code2=explode("|",$opt_code2);
	for($i=0;$i<sizeof($opt_name2)-1;$i++){
		$sql="insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name2[$i]','$opt_price2[$i]','$opt_ea2[$i]','$opt_order2[$i]','$opt_code2[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name3=explode("|",$opt_name3);
	$opt_price3=explode("|",$opt_price3);
	$opt_ea3=explode("|",$opt_ea3);
	$opt_order3=explode("|",$opt_order3);
	for($i=0;$i<sizeof($opt_name3)-1;$i++){
		$sql="insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name3[$i]','$opt_price3[$i]','$opt_ea3[$i]','$opt_order3[$i]','$opt_code3[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name4=explode("|",$opt_name4);
	$opt_price4=explode("|",$opt_price4);
	$opt_ea4=explode("|",$opt_ea4);
	$opt_order4=explode("|",$opt_order4);
	$opt_code4=explode("|",$opt_code4);
	for($i=0;$i<sizeof($opt_name4)-1;$i++){
		$sql="insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name4[$i]','$opt_price4[$i]','$opt_ea4[$i]','$opt_order4[$i]','$opt_code4[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name5=explode("|",$opt_name5);
	$opt_price5=explode("|",$opt_price5);
	$opt_ea5=explode("|",$opt_ea5);
	$opt_order5=explode("|",$opt_order5);
	$opt_code5=explode("|",$opt_code5);
	for($i=0;$i<sizeof($opt_name5)-1;$i++){
		$sql="insert into $OptionTable5(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name5[$i]','$opt_price5[$i]','$opt_ea5[$i]','$opt_order5[$i]','$opt_code5[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name6=explode("|",$opt_name6);
	$opt_price6=explode("|",$opt_price6);
	$opt_ea6=explode("|",$opt_ea6);
	$opt_order6=explode("|",$opt_order6);
	$opt_code6=explode("|",$opt_code6);
	for($i=0;$i<sizeof($opt_name6)-1;$i++){
		$sql="insert into $OptionTable6(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name6[$i]','$opt_price6[$i]','$opt_ea6[$i]','$opt_order6[$i]','$opt_code6[$i]')";
		$result=mysql_query($sql);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>
