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
	$item_kyukyuk = $ary[item_kyukyuk];
	$min_buy = $ary[min_buy];

	/*$opts = explode("=", $opt);*/
	$opt1 = $ary[opt];
	$opt2 = $ary[opt2];
	$opt3 = $ary[opt3];
	$opt4 = $ary[opt4];
	
	$if_opt_jaego = $ary[if_opt_jaego];
	$if_opt_jaego2 = $ary[if_opt_jaego2];
	$if_opt_jaego3 = $ary[if_opt_jaego3];
	$if_opt_jaego4 = $ary[if_opt_jaego4];

	$sql="select * from $OptionTable where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name.=$rs[opt_name]."/";
		$opt_price.=$rs[opt_price]."/";
		$opt_ea.=$rs[opt_ea]."/";
		$opt_order.=$rs[opt_order]."/";
		$opt_no.=$rs[opt_no]."/";
		$opt_code.=$rs[opt_code]."/";
		$opt_order_j=$rs[opt_order];

	}
	//$opts = explode("=", $opt);
	

	$sql="select * from $OptionTable2 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name2.=$rs[opt_name]."/";
		$opt_price2.=$rs[opt_price]."/";
		$opt_ea2.=$rs[opt_ea]."/";
		$opt_order2.=$rs[opt_order]."/";
		$opt_no2.=$rs[opt_no]."/";
		$opt_code2.=$rs[opt_code]."/";
		$opt_order_j2=$rs[opt_order];
	}

	$sql="select * from $OptionTable3 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name3.=$rs[opt_name]."/";
		$opt_price3.=$rs[opt_price]."/";
		$opt_ea3.=$rs[opt_ea]."/";
		$opt_order3.=$rs[opt_order]."/";
		$opt_no3.=$rs[opt_no]."/";
		$opt_code3.=$rs[opt_code]."/";
		$opt_order_j3=$rs[opt_order];
	}

	$sql="select * from $OptionTable4 where item_no='$item_no' order by opt_order asc";
	$result=mysql_query($sql);
	while($rs=mysql_fetch_array($result)){
		$opt_name4.=$rs[opt_name]."/";
		$opt_price4.=$rs[opt_price]."/";
		$opt_ea4.=$rs[opt_ea]."/";
		$opt_order4.=$rs[opt_order]."/";
		$opt_no4.=$rs[opt_no]."/";
		$opt_code4.=$rs[opt_code]."/";
		$opt_order_j4=$rs[opt_order];
	}


	$short_explain = eregi_replace( "<br>", "", $short_explain );
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
var opt_order=<?=$opt_order_j?>+1;
var opt_order2=<?=$opt_order_j2?>+1;
var opt_order3=<?=$opt_order_j3?>+1;
var opt_order4=<?=$opt_order_j4?>+1;
function opt_add(frm){
	var opt_price=0;
	var opt_ea=0;
	var option=document.createElement("option");
	if(!frm.op_name1.value){
		alert("�ɼǸ��� �Է��Ͻʽÿ�.");
		frm.op_name1.focus();
		return;
	}
	if(!frm.optName.value){
		alert("�ɼ� �׸��� �Է��Ͻʽÿ�");
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
	
	frm.opt_name.value+=frm.optName.value+"/";
	frm.opt_price.value+=+opt_price+"/";
	frm.opt_ea.value+=frm.optEa.value+"/";
	frm.opt_order.value+=opt_order+"/";
	frm.opt_code.value+=frm.optCode.value+"/";
	frm.opt_no.value+="/";
	option.value=frm.optName.value+"(+"+opt_price+"��)";
	option.text=frm.optName.value+"(+"+opt_price+"�� ���: "+opt_ea+"�� code"+frm.optCode.value+")";
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
	var opt_price=frm.opt_price.value.split("/");
	var opt_name=frm.opt_name.value.split("/");
	var opt_ea=frm.opt_ea.value.split("/");
	var opt_code=frm.opt_code.value.split("/");
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
	var opt_price=frm.opt_price.value.split("/");
	var opt_name=frm.opt_name.value.split("/");
	var opt_ea=frm.opt_ea.value.split("/");
	var opt_code=frm.opt_code.value.split("/");
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
		alert("�Էµ� �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	opt_price[k]=frm.optPrice.value;
	opt_ea[k]=frm.optEa.value;
	opt_name[k]=frm.optName.value;
	opt_code[k]=frm.optCode.value;
	frm.opt1.options[k+1].value=opt_name[k]+"(+"+opt_price[k]+"��)";
	frm.opt1.options[k+1].text=opt_name[k]+"(+"+opt_price[k]+"�� ��� :"+opt_ea[k]+"�� code"+opt_code[k]+")";
	
	for(j=0;j<opt_name.length;j++){
		if(opt_price[j]){
			frm.opt_price.value+=opt_price[j]+"/";
			frm.opt_name.value+=opt_name[j]+"/";
			frm.opt_ea.value+=opt_ea[j]+"/";
			frm.opt_code.value+=opt_code[j]+"/";
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
	var opt_no=frm.opt_no.value.split("/");
	var opt_price=frm.opt_price.value.split("/");
	var opt_name=frm.opt_name.value.split("/");
	var opt_ea=frm.opt_ea.value.split("/");
	var opt_order=frm.opt_order.value.split("/");
	var opt_code=frm.opt_code.value.split("/");
	frm.opt_price.value="";
	frm.opt_name.value="";
	frm.opt_ea.value="";
	frm.opt_order.value="";
	frm.opt_code.value="";
	//frm.opt_no.value="";
	var k=0;
	for(i=1;i<frm.opt1.options.length;i++){
		if(frm.opt1.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	
	frm.opt1.options[k+1]=null;
	
	opt_price.splice(k,1);
	opt_ea.splice(k,1);
	opt_name.splice(k,1);
	opt_order.splice(k,1);
	opt_code.splice(k,1);
	opt_no.splice(k,1);
	for(j=0;j<opt_name.length;j++){
		if(opt_price[j]){
			frm.opt_price.value+=opt_price[j]+"/";
			frm.opt_name.value+=opt_name[j]+"/";
			frm.opt_ea.value+=opt_ea[j]+"/";
			frm.opt_order.value+=opt_order[j]+"/";
			frm.opt_code.value+=opt_code[j]+"/";
			//frm.opt_no.value+=opt_no[j]+"/";
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

	var opt_name=frm.opt_name.value.split("/");
	var opt_ea=frm.opt_ea.value.split("/");
	var opt_price=frm.opt_price.value.split("/");
	var opt_code=frm.opt_code.value.split("/");


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
		alert("�� �̻� �ø� �� �����ϴ�.");
		return;
	}
	if(j==frm.opt1.options.length){
		alert("�� �̻� ���� �� �����ϴ�.");
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
			optPrice+=opt_price[z]+"/";
			optName+=opt_name[z]+"/";
			optEa+=opt_ea[z]+"/";
			optCode+=opt_ea[z]+"/";
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
		alert("�ɼǸ��� �Է��Ͻʽÿ�.");
		frm.op_name2.focus();
		return;
	}
	if(!frm.optName2.value){
		alert("�ɼ� �׸��� �Է��Ͻʽÿ�");
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
	frm.opt_no2.value+="/";
	frm.opt_name2.value+=frm.optName2.value+"/";
	frm.opt_price2.value+=+opt_price2+"/";
	frm.opt_ea2.value+=frm.optEa2.value+"/";
	frm.opt_order2.value+=opt_order2+"/";
	frm.opt_code2.value+=frm.optCode2.value+"/";
	option.value=frm.optName2.value+"(+"+opt_price2+"��)";
	option.text=frm.optName2.value+"(+"+opt_price2+"�� ���: "+opt_ea2+"�� code"+frm.optCode2.value+")";
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
	var opt_price2=frm.opt_price2.value.split("/");
	var opt_name2=frm.opt_name2.value.split("/");
	var opt_ea2=frm.opt_ea2.value.split("/");
	var opt_code2=frm.opt_code2.value.split("/");
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
	var opt_price2=frm.opt_price2.value.split("/");
	var opt_name2=frm.opt_name2.value.split("/");
	var opt_ea2=frm.opt_ea2.value.split("/");
	var opt_code2=frm.opt_code2.value.split("/");
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
		alert("�Էµ� �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	opt_price2[k]=frm.optPrice2.value;
	opt_ea2[k]=frm.optEa2.value;
	opt_name2[k]=frm.optName2.value;
	opt_code2[k]=frm.optCode2.value;
	frm.opt2.options[k+1].value=opt_name2[k]+"(+"+opt_price2[k]+"��)";
	frm.opt2.options[k+1].text=opt_name2[k]+"(+"+opt_price2[k]+"�� ��� :"+opt_ea2[k]+"�� code "+opt_code2[k]+")";
	
	for(j=0;j<opt_name2.length;j++){
		if(opt_price2[j]){
			frm.opt_price2.value+=opt_price2[j]+"/";
			frm.opt_name2.value+=opt_name2[j]+"/";
			frm.opt_ea2.value+=opt_ea2[j]+"/";
			frm.opt_code2.value+=opt_code2[j]+"/";
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
	var opt_no2=frm.opt_no2.value.split("/");
	var opt_price2=frm.opt_price2.value.split("/");
	var opt_name2=frm.opt_name2.value.split("/");
	var opt_ea2=frm.opt_ea2.value.split("/");
	var opt_order2=frm.opt_order2.value.split("/");
	var opt_code2=frm.opt_code2.value.split("/");
	var opt_no2 = frm.opt_no2.value.split("/");
	frm.opt_price2.value="";
	frm.opt_name2.value="";
	frm.opt_ea2.value="";
	frm.opt_order2.value="";
	//frm.opt_code2.value="";
	var k=0;
	for(i=1;i<frm.opt2.options.length;i++){
		if(frm.opt2.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	
	frm.opt2.options[k+1]=null;
	
	opt_price2.splice(k,1);
	opt_ea2.splice(k,1);
	opt_name2.splice(k,1);
	opt_order2.splice(k,1);
	opt_code2.splice(k,1);
	opt_no2.splice(k,1);
	for(j=0;j<opt_name2.length;j++){
		if(opt_price2[j]){
			frm.opt_price2.value+=opt_price2[j]+"/";
			frm.opt_name2.value+=opt_name2[j]+"/";
			frm.opt_ea2.value+=opt_ea2[j]+"/";
			frm.opt_order2.value+=opt_order2[j]+"/";
			frm.opt_code2.value+=opt_code2[j]+"/";
			//frm.opt_no2.value+=opt_no2[j];
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
	
	var opt_name2=frm.opt_name2.value.split("/");
	var opt_ea2=frm.opt_ea2.value.split("/");
	var opt_price2=frm.opt_price2.value.split("/");
	var opt_code2=frm.opt_code2.value.split("/");


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
		alert("�� �̻� �ø� �� �����ϴ�.");
		return;
	}
	if(j==frm.opt2.options.length){
		alert("�� �̻� ���� �� �����ϴ�.");
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
			optPrice2+=opt_price2[z]+"/";
			optName2+=opt_name2[z]+"/";
			optEa2+=opt_ea2[z]+"/";
			optCode2+=opt_code2[z]+"/";
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
		alert("�ɼǸ��� �Է��Ͻʽÿ�.");
		frm.op_name3.focus();
		return;
	}
	if(!frm.optName3.value){
		alert("�ɼ� �׸��� �Է��Ͻʽÿ�");
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
	frm.opt_no3.value+="/";
	frm.opt_name3.value+=frm.optName3.value+"/";
	frm.opt_price3.value+=+opt_price3+"/";
	frm.opt_ea3.value+=frm.optEa3.value+"/";
	frm.opt_order3.value+=opt_order3+"/";
	frm.opt_code3.value+=frm.optCode3.value+"/";
	option.value=frm.optName3.value+"(+"+opt_price3+"��)";
	option.text=frm.optName3.value+"(+"+opt_price3+"�� ���: "+opt_ea3+"�� code"+frm.optCode3.value+")";
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
	var opt_price3=frm.opt_price3.value.split("/");
	var opt_name3=frm.opt_name3.value.split("/");
	var opt_ea3=frm.opt_ea3.value.split("/");
	var opt_code3=frm.opt_code3.value.split("/");
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
	var opt_price3=frm.opt_price3.value.split("/");
	var opt_name3=frm.opt_name3.value.split("/");
	var opt_ea3=frm.opt_ea3.value.split("/");
	var opt_code3=frm.opt_code3.value.split("/");
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
		alert("�Էµ� �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	opt_price3[k]=frm.optPrice3.value;
	opt_ea3[k]=frm.optEa3.value;
	opt_name3[k]=frm.optName3.value;
	opt_code3[k]=frm.optCode3.value;
	frm.opt3.options[k+1].value=opt_name3[k]+"(+"+opt_price3[k]+"��)";
	frm.opt3.options[k+1].text=opt_name3[k]+"(+"+opt_price3[k]+"�� ��� :"+opt_ea3[k]+"�� code"+opt_code3[k]+")";
	
	for(j=0;j<opt_name3.length;j++){
		if(opt_price3[j]){
			frm.opt_price3.value+=opt_price3[j]+"/";
			frm.opt_name3.value+=opt_name3[j]+"/";
			frm.opt_ea3.value+=opt_ea3[j]+"/";
			frm.opt_code3.value+=opt_code3[j]+"/";
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
	var opt_price3=frm.opt_price3.value.split("/");
	var opt_name3=frm.opt_name3.value.split("/");
	var opt_ea3=frm.opt_ea3.value.split("/");
	var opt_order3=frm.opt_order3.value.split("/");
	var opt_code=frm.opt_code3.value.split("/");
	//var opt_no3=frm.opt_price3.value.split("/");
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
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	
	frm.opt3.options[k+1]=null;
	
	opt_price3.splice(k,1);
	opt_ea3.splice(k,1);
	opt_name3.splice(k,1);
	opt_order3.splice(k,1);
	opt_code3.splice(k,1);
	opt_no3.splice(k,1);
	for(j=0;j<opt_name3.length;j++){
		if(opt_price3[j]){
			frm.opt_price3.value+=opt_price3[j]+"/";
			frm.opt_name3.value+=opt_name3[j]+"/";
			frm.opt_ea3.value+=opt_ea3[j]+"/";
			frm.opt_order3.value+=opt_order3[j]+"/";
			frm.opt_code3.value+=opt_code3[j]+"/";
			//frm.opt_no3.value+=opt_no3[j]+"/";
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
	
	var opt_name3=frm.opt_name3.value.split("/");
	var opt_ea3=frm.opt_ea3.value.split("/");
	var opt_price3=frm.opt_price3.value.split("/");
	var opt_code3=frm.opt_code3.value.split("/");


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
		alert("�� �̻� �ø� �� �����ϴ�.");
		return;
	}
	if(j==frm.opt3.options.length){
		alert("�� �̻� ���� �� �����ϴ�.");
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
			optPrice3+=opt_price3[z]+"/";
			optName3+=opt_name3[z]+"/";
			optEa3+=opt_ea3[z]+"/";
			optCode3+=opt_code3[z]+"/";
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
	if(!frm.op_name3.value){
		alert("�ɼǸ��� �Է��Ͻʽÿ�.");
		frm.op_name3.focus();
		return;
	}
	if(!frm.optName4.value){
		alert("�ɼ� �׸��� �Է��Ͻʽÿ�");
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
	frm.opt_no4.value+="/";
	frm.opt_name4.value+=frm.optName4.value+"/";
	frm.opt_price4.value+=+opt_price4+"/";
	frm.opt_ea4.value+=frm.optEa4.value+"/";
	frm.opt_order4.value+=opt_order4+"/";
	frm.opt_code4.value+=frm.optCode4.value+"/";
	option.value=frm.optName4.value+"(+"+opt_price4+"��)";
	option.text=frm.optName4.value+"(+"+opt_price4+"�� ���: "+opt_ea4+"�� code"+frm.optCode4.value+")";
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
	var opt_price4=frm.opt_price4.value.split("/");
	var opt_name4=frm.opt_name4.value.split("/");
	var opt_ea4=frm.opt_ea4.value.split("/");
	var opt_code4=frm.opt_code4.value.split("/");
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
	var opt_price4=frm.opt_price4.value.split("/");
	var opt_name4=frm.opt_name4.value.split("/");
	var opt_ea4=frm.opt_ea4.value.split("/");
	var opt_code4=frm.opt_code4.value.split("/");
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
		alert("�Էµ� �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	opt_price4[k]=frm.optPrice4.value;
	opt_ea4[k]=frm.optEa4.value;
	opt_name4[k]=frm.optName4.value;
	opt_code4[k]=frm.optCode4.value;
	frm.opt4.options[k+1].value=opt_name4[k]+"(+"+opt_price4[k]+"��)";
	frm.opt4.options[k+1].text=opt_name4[k]+"(+"+opt_price4[k]+"�� ��� :"+opt_ea4[k]+"�� code"+opt_code4[k]+")";
	
	for(j=0;j<opt_name4.length;j++){
		if(opt_price4[j]){
			frm.opt_price4.value+=opt_price4[j]+"/";
			frm.opt_name4.value+=opt_name4[j]+"/";
			frm.opt_ea4.value+=opt_ea4[j]+"/";
			frm.opt_code4.value+=opt_code4[j]+"/";
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
	var opt_no4=frm.opt_price4.value.split("/");
	var opt_price4=frm.opt_price4.value.split("/");
	var opt_name4=frm.opt_name4.value.split("/");
	var opt_ea4=frm.opt_ea4.value.split("/");
	var opt_order4=frm.opt_order4.value.split("/");
	var opt_code=frm.opt_code4.value.split("/");
	frm.opt_price4.value="";
	frm.opt_name4.value="";
	frm.opt_ea4.value="";
	frm.opt_order4.value="";
	//frm.opt_code4.value="";
	var k=0;
	for(i=1;i<frm.opt4.options.length;i++){
		if(frm.opt4.options[i].selected){
			sel=true;
			k=i-1;
			break;
		}
	}
	
	if(sel==false){
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
		return;
	}
	
	frm.opt4.options[k+1]=null;
	opt_no4.splice(k,1);
	opt_price4.splice(k,1);
	opt_ea4.splice(k,1);
	opt_name4.splice(k,1);
	opt_order4.splice(k,1);
	opt_code4.splice(k,1);
	for(j=0;j<opt_name4.length;j++){
		if(opt_price4[j]){
			frm.opt_price4.value+=opt_price4[j]+"/";
			frm.opt_name4.value+=opt_name4[j]+"/";
			frm.opt_ea4.value+=opt_ea4[j]+"/";
			frm.opt_order4.value+=opt_order4[j]+"/";
			frm.opt_code4.value+=opt_code4[j]+"/";
			//frm.opt_no4.value+=opt_no4[j]+"/";
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

	var opt_name4=frm.opt_name4.value.split("/");
	var opt_ea4=frm.opt_ea4.value.split("/");
	var opt_price4=frm.opt_price4.value.split("/");
	var opt_code4=frm.opt_code4.value.split("/");


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
		alert("�� �̻� �ø� �� �����ϴ�.");
		return;
	}
	if(j==frm.opt4.options.length){
		alert("�� �̻� ���� �� �����ϴ�.");
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
			optPrice4+=opt_price4[z]+"/";
			optName4+=opt_name4[z]+"/";
			optEa4+=opt_ea4[z]+"/";
			optCode4+=opt_ea4[z]+"/";
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
</script>
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){alert("\n��ǰ�̸��� �Է��ϼ���.");frm.item_name.focus();return false;}	
	
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
	/*if(frm.use_opt1_chk.checked) frm.use_opt1.value = 't';
	else frm.use_opt1.value = 'f';*/
	
	//if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	//else frm.use_opt23.value = 'f';
	
	/*
	if (frm.op_name1.value ==""){
		//alert("�ɼ�1�� ������ ���ϼ���");
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
    }*/

	/*
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
	*/

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




	function pro_add1(frm,pro,price,bonus,mem_price,op_name1_2,color)
	{

		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("�ɼ��׸��� �Է��ϼ���.");
			frm.pro_value1.focus (); 
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
					e1.text= e1.text + "�ڵ�:" + mem_price + op_name1_2 + ":" + color;
		}


		

		document.all.opt1.add(e1);
		frm.pro_value1.value ="";		
		frm.pro_price1.value ="";
		frm.pro_bonus1.value ="";
		frm.pro_mem_price1.value ="";						
		frm.pro_color.value ="";						
		frm.pro_value1.focus (); 		
	}


function pro_add2(frm,pro)
	{
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

    DesSet();

		}


	}

function DesSet(){

var Count_Arr = new Array(); 

//Count_Arr[]; // �ڷ�����

var i;
var frm=document.writeform;

	for(i=1;i<frm.opt2.options.length;i++){
	Count_Arr[i]=frm.opt2.options[i].value;
   //alert(Count_Arr[i]);
	}

	//alert(Count_Arr.length-1);
var sw;
var j;
  for(i=Count_Arr.length-1;i>0;i--){
     sw = true;
      for(j = 1;j<Count_Arr.length-1;j++){ 
    
			  if( Count_Arr[j] < Count_Arr[j + 1]){  // ���� ���� ���� ������ Ŭ�� �ڸ� �ٲ�.
            tmp = Count_Arr[j]
            Count_Arr[j] = Count_Arr[j + 1];
            Count_Arr[j + 1] = tmp;
            sw = false
        }
			}
      if(sw == true){ // sw = True �� ��� ������ �Ǿ��ų� �� �̻� ������ �� ���ٴ� ��.
          i=-1;
      }
	}



for(i=(eval(document.all.opt2.options.length-1));i>0;i--){
document.all.opt2.options[i]=null;
}

var j;
j=1;

		for(i=1;i<Count_Arr.length;i++){
			
			//document.all.opt2.add(Count_Arr[i]);
			document.all.opt2.options[j]= new Option(Count_Arr[i],Count_Arr[i]);
			//document.all.opt2.options.add(new Option(Count_Arr[i], Count_Arr[i]));

			j++;
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
<!--
function opensub2(x)
{	 
	var child;
	window.open(x,'x' ,'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,width=800,height=200,left=0,top=0');
}
// -->    
</script>
<script language="javascript">

//*************************** ���� ���ε� â ******************************************************************

function fileup(formname,imagename){
// formname : form �� name
// mart_id : ���� mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** ���� ���ε� â *******************************************************************
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
					<p style="padding-left: 10px"><b>[��ǰ ����]</b> ��ǰ�� �����մϴ�.<br><br>
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
          		<form action='item_modify2.php?item_no=<?=$item_no?>&flag=update&page=<?=$page?>&searchword=<?=$searchword?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&pu=<?=$pu?>' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
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
				<!-- �ɼ� �׸� �߰� �� �� ���̴� ��-->
				<input type="hidden" name="opt_no" value="<?=$opt_no?>">
				<input type="hidden" name="opt_order" value="<?=$opt_order?>">
				<input type="hidden" name="opt_name" value="<?=$opt_name?>">
				<input type="hidden" name="opt_price" value="<?=$opt_price?>">
				<input type="hidden" name="opt_ea" value="<?=$opt_ea?>">
				<input type="hidden" name="opt_code" value="<?=$opt_code?>">

				<input type="hidden" name="opt_no2" value="<?=$opt_no2?>">
				<input type="hidden" name="opt_order2" value="<?=$opt_order2?>">
				<input type="hidden" name="opt_name2" value="<?=$opt_name2?>">
				<input type="hidden" name="opt_price2" value="<?=$opt_price2?>">
				<input type="hidden" name="opt_ea2" value="<?=$opt_ea2?>">
				<input type="hidden" name="opt_code2" value="<?=$opt_code2?>">

				<input type="hidden" name="opt_no3" value="<?=$opt_no3?>">
				<input type="hidden" name="opt_order3" value="<?=$opt_order3?>">
				<input type="hidden" name="opt_name3" value="<?=$opt_name3?>">
				<input type="hidden" name="opt_price3" value="<?=$opt_price3?>">
				<input type="hidden" name="opt_ea3" value="<?=$opt_ea3?>">
				<input type="hidden" name="opt_code3" value="<?=$opt_code3?>">

				<input type="hidden" name="opt_no4" value="<?=$opt_no4?>">
				<input type="hidden" name="opt_order4" value="<?=$opt_order4?>">
				<input type="hidden" name="opt_name4" value="<?=$opt_name4?>">
				<input type="hidden" name="opt_price4" value="<?=$opt_price4?>">
				<input type="hidden" name="opt_ea4" value="<?=$opt_ea4?>">
				<input type="hidden" name="opt_code4" value="<?=$opt_code4?>">
				<!-- �ɼ� �׸� �߰� �� �� ���̴� ��-->
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
                				��ǰ��
							</td>
                			<td width="32%" bgcolor="#FFFFFF">
                				<input name="item_name" size="25" value="<?=$item_name?>" class='input'>
							</td>
                			<td width="18%" bgcolor="#C8DFEC" colspan='2' align="center">
								������
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input name="item_company" size="25" value="<?=$item_company?>" class='input'>
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
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">
								��ǰ�԰�
							</td>
			                <td bgColor="#ffffff">
								<input name="item_kyukyuk" value='<?=$item_kyukyuk?>'  class='input' size="14">
							</td>
			                <td bgColor="#c8dfec" colspan="2" align="center">
								��ǰ�ڵ�
							</td>
			                <td bgColor="#ffffff">
								<input name="item_code" value='<?=$item_code?>' class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#c8dfec" colSpan="2">
								������
							</td>
			                <td bgColor="#ffffff">
								<input type="radio" value="1" name="jaego_use" <?if($jaego_use == 1) echo " checked";?>>��� �� 
								<input type="radio" value="0" name="jaego_use" <?if($jaego_use == 0) echo " checked";?>>��� ���� ����
							</td>
			                <td  bgColor="#c8dfec" colspan="2" align="center">
								���
							</td>
			                <td bgColor="#ffffff">
								<input name="jaego" value='<?=$jaego?>'  class='input' size="14">
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
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()" onkeyup="this.value=comma(this.value);">
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
								<input name="price" value='<?=$price?>'  class='input' size="14">
							</td>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�������
							</td>
			                <td bgColor="#ffffff">
								<input type="radio" value="������" name="fee" <?if($fee=="������"){ echo "checked";}?>>������ <input type="radio" value="����" name="fee" <?if($fee=="����"){ echo "checked";}?>>���� <input type="radio" value="" name="fee" <?if($fee==""||$fee=="����"){ echo "checked";}?>>����
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								�ּұ��ż���
							</td>
			                <td bgColor="#ffffff" colSpan="4">
								<input name="min_buy" value="<?=$min_buy?>" class='input' size="14" colSpan="4">
							</td>							
			              </tr>
			              <tr>
			                <td align="center" bgColor="#c8dfec" colSpan="2">
								�������
							</td>
			                <td bgColor="#ffffff" colspan="4">
								<input type="checkbox" value="1" name="if_cash" <?if($if_cash == '1') echo "checked";?>>�����������<br>
								<font color="#C00000"> (�������� ��������Դϴ�. Ÿ ��ǰ�� ���� ���Ž�, ���ݰ����� �����մϴ�.)</font><br>
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#ffffff" colSpan="6">
								<br><font color="#0000ff">�Һ��ڰ��� ������ ��µ��� �ʽ��ϴ�.<br>
								�ǸŰ�, ����Ʈ�� ���ڸ� �Է��Ͻð�, ����Ʈ�� 
								�������� ���� ��� &quot;0&quot;�� �Է��ϼ���.<br>
								</font><br><br>
			                </td>
			              </tr>        			
<?
if($if_gnt_item == 1){
?>
              			<tr>
                			<td align="center" bgColor="#c8dfec" colspan="2">
                				���޿���
							</td>
                			<td bgColor="#ffffff">
                				<input  class='input' type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>���� 
                				<input  class='input' type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>�Ұ���
							</td>
                			<td bgcolor="#c8dfec" colspan="2" align="center">
								���ް�
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
								��ϵ�<br>��ǰ<br>�̹���
							</td>
			                <td width="85%" bgColor="#e6f0f7" colspan='4'>
								<table width='100%' border='0' bgcolor='#FFFFFF'>
									<tr>
										<td width='12.5%'>����Ʈ</td>
										<td width='12.5%'>�󼼼���</td>
										<td width='12.5%'>Ȯ��1</td>
										<td width='12.5%'>Ȯ��2</td>
										<td width='12.5%'>Ȯ��3</td>
										<td width='12.5%'>Ȯ��4</td>
										<td width='12.5%'>Ȯ��5</td>
										<td width='12.5%'>����</td>
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
								��ǰ<br>�̹���
							</td>
			                <td align="center" width="9%" bgColor="#E8F1F7">
								����Ʈ
							</td>
			                <td width="85%" bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_sml" value='<?=$img_sml?>' class='input' size='35'>
								<input onclick="javascript:fileup('writeform','img_sml');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'>
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#E8F1F7">
								�󼼼���
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img" value='<?=$img?>' size='35' class='input'>
								<input onclick="javascript:fileup('writeform','img');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���">
							</td>
			              </tr>
			              <tr>
			                <td align="center" bgColor="#E8F1F7">
								Ȯ��
							</td>
			                <td bgColor="#ffffff" colspan="4">
								&nbsp;<input name="img_big" value='<?=$img_big?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><br>
								&nbsp;<input name="img_big2" value='<?=$img_big2?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big2');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><br>
								&nbsp;<input name="img_big3" value='<?=$img_big3?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big3');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><br>
								&nbsp;<input name="img_big4" value='<?=$img_big4?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big4');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'><br>
								&nbsp;<input name="img_big5" value='<?=$img_big5?>' class='input' size='35'> 
								<input onclick="javascript:fileup('writeform','img_big5');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'>
							</td>
			              </tr>
			              <tr>
			                <td align='center' bgColor="#E8F1F7">
								����
							</td>
			                <td bgColor="#ffffff" colspan="5">
								&nbsp;<input name="img_high" value='<?=$img_high?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; width: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></span> 
								<input onclick="javascript:fileup('writeform','img_high');" class="aa" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���" style='cursor:hand'>
							</td>
						  </tr>
			              <tr>
			                <td width="100%" bgColor="#ffffff" colSpan="6" align="left">
								<img height="15" src="../images/tip.gif" width="30"> <font color="#0000ff"> �̹����� jpg,gif,swf�� �����մϴ�.<br>
								����Ʈ ȭ���� ������� 120*120 px �����Դϴ�.<br>
								�󼼼��� �������� ������� 240*240 px �����Դϴ�.<br>
								Ȯ���̹����� ���������� 500*500 px�̰�, ���Ǵ�� ���������� 
								�����մϴ�</font>
							</td>
			              </tr>
			              <tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������ ����
							</td>
                			<td width="85%" bgcolor="#FFFFFF" colspan="4">
                				<input name="icon_no" type="radio" value="0" <?if($icon_no == 0) echo " checked"?>>
                				<font color="#0000FF">������</font>
                				<input name="icon_no" type="radio" value="1" <?if($icon_no == 1) echo " checked"?>>
                				<img src="../images/hot.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="2" <?if($icon_no == 2) echo " checked"?>>
                				<img src="../images/new.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="3" <?if($icon_no == 3) echo " checked"?>>
                				<img src="../images/sale.gif" width="22" height="13">
                				<input name="icon_no" type="radio" value="4" <?if($icon_no == 4) echo " checked"?>>
                				<img src="../images/reserv.gif" width="53" height="12"><br>
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
								<textarea name="short_explain" rows='3' cols='108'><?=$short_explain?></textarea>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				��ǰ����
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
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14" value='<?=$opt1?>'>
								<input type="checkbox" name="if_opt_jaego" value="1" <? if($if_opt_jaego){echo "checked";}?>>������
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt1" size="6" style="width: 250" onchange="opt_change(this)">
          						<option>-------------------------------------</option>
								<?
									$sql="select * from $OptionTable where item_no='$item_no' order by opt_order asc";
									$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){
								?>
								<option value="<?=$rs[opt_no]?>"><?=$rs[opt_name]."(+".$rs[opt_price]."�� ��� ".$rs[opt_ea]."�� code ".$rs[opt_code].")"?></option>
								<? }?>
	            				</select><br>
	            				<input type="button" value="��" onclick="opt_rank('up')">
								<input type="button" value="��" onclick="opt_rank('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼǰ���
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��ڵ�
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand;display:none' id="modify">
                				<input onclick="opt_add(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="opt_del(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
              			
						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����2
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name2" size="14" value='<?=$opt2?>'>
								<input type="checkbox" name="if_opt_jaego2" value="1" <? if($if_opt_jaego2){echo "checked";}?>>������
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt2" size="6" style="width: 250" onchange="opt_change2(this)">
          						<option>-------------------------------------</option>
								<?
									$sql="select * from $OptionTable2 where item_no='$item_no' order by opt_order asc";
									$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){
								?>
								<option value="<?=$rs[opt_no]?>"><?=$rs[opt_name]."(+".$rs[opt_price]."�� ��� ".$rs[opt_ea]."�� code ".$rs[opt_code].")"?></option>
								<? }?>
	            				</select><br>
	            				<input type="button" value="��" onclick="opt_rank2('up')">
								<input type="button" value="��" onclick="opt_rank2('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼǰ���2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��ڵ�2
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode2" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify2(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand;display:none' id="modify2">
                				<input onclick="opt_add2(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="opt_del2(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>

						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����3
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name3" size="14" value='<?=$opt3?>'>
								<input type="checkbox" name="if_opt_jaego3" value="1" <? if($if_opt_jaego3){echo "checked";}?>>������
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt3" size="6" style="width: 250" onchange="opt_change3(this)">
          						<option>-------------------------------------</option>
								<?
									$sql="select * from $OptionTable3 where item_no='$item_no' order by opt_order asc";
									$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){
								?>
								<option value="<?=$rs[opt_no]?>"><?=$rs[opt_name]."(+".$rs[opt_price]."�� ��� ".$rs[opt_ea]."�� code ".$rs[opt_code].")"?></option>

								<? }?>
	            				</select><br>
	            				<input type="button" value="��" onclick="opt_rank3('up')">
								<input type="button" value="��" onclick="opt_rank3('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName3" size="14">
								
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼǰ���3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��ڵ�3
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode3" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify3(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand;display:none' id="modify3">
                				<input onclick="opt_add3(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="opt_del3(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>
						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����4
							</td>
                			<td width="22%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name4" size="14" value='<?=$opt4?>'>
								<input type="checkbox" name="if_opt_jaego4" value="1" <? if($if_opt_jaego4){echo "checked";}?>>������
							</td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt4" size="6" style="width: 250" onchange="opt_change4(this)">
          						<option>-------------------------------------</option>
								<?
									$sql="select * from $OptionTable4 where item_no='$item_no' order by opt_order asc";
									$result=mysql_query($sql);
									while($rs=mysql_fetch_array($result)){
								?>
								<option value="<?=$rs[opt_no]?>"><?=$rs[opt_name]."(+".$rs[opt_price]."�� ��� ".$rs[opt_ea]."�� code ".$rs[opt_code].")"?></option>

								<? }?>
	            				</select><br>
	            				<input type="button" value="��" onclick="opt_rank4('up')">
								<input type="button" value="��" onclick="opt_rank4('down')">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�4
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optName4" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼǰ���4
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optPrice4" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������4
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optEa4" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��ڵ�4
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="optCode4" size="14">
							</td>
              			</tr>
						<tr>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3">
								<input onclick="opt_modify4(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand;display:none' id="modify4">
                				<input onclick="opt_add4(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                				<input onclick="opt_del4(this.form)" class='butt_none' style='width:60' type="button" value="�� ��" style='cursor:hand'>
                			</td>
              			</tr>
						<tr>
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>

              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">�ɼ� ���� 
                    					��� ����</font>
									</td>
                  				</tr>
                  				<tr>
                    				<td width="100%">
										��ǰ�� �ɼ��� �����ϴ� �κ����ν� �� ��ǰ�� �ɼǸ�� �ɼ��׸�,�ɼǰ���,�������� �����Ͻø� �˴ϴ�.<br>
										<font color="red">�ɼ�����</font>�� �Է��ϼž� ��ǰ ���������� ���ɴϴ�.
										<br><br>
										1. <font color="blue">�ɼ�����</font> : �ɼ������� ��ǰ�� �ɼ��Դϴ�.<br>
										��)�Ƿ��� ������, �Ź��� �߻�����, ��ǻ�ʹ� �μ�ǰ �ɼ��� �ֵ��� ��ǰ�� ���� �ɼ��� �����ø� �˴ϴ�.<br>
										2. <font color="blue">�ɼ��׸�</font> : �ɼ� �׸��� �ɼ������Դϴ�.<br>
										��)������-XL,L,S | �߻����� - 240,245,260,270 <br>
										3. <font color="blue">�ɼǰ���</font> : �ɼǰ����� �� �ɼ��� �߰��ÿ� �߰�����Դϴ�.<br> �� ��ǰ ���Ž� �ǸŰ��� �߰��� �ݾ����� ������ ������ �� �ֽ��ϴ�.<br>
										4. <font color="blue">�ɼ����</font> : �� �ɼ��׸� ����Դϴ�. <br>
										��)������ - 220 30�� <br>
										5. <font color="blue">������</font> : �������� üũ�� �Ǿ������� ���� ��ǰ ���Ž� �ڵ����� ��� ������ �ϴ� ����Դϴ�.<br> üũ�� �Ǿ����� ������ �ڵ����� ������ �ʰ� �ǹǷ� �� ���� ������ �ֽñ� �ٶ��ϴ�.
                    					
                    				</td>
                  				</tr>
                				</table>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">�ɼ� ���� 
                    					��� ����</font>
									</td>
                  				</tr>
                  				<tr>
                    				<td width="100%">
                    					<br>
                    					1. �������� �ɼǻ��<br>
                    					��)����� ���� ������ �޶����� ���, <br>
                    					�ɼ�����: ������, �ɼ��׸�: 55, �����Է� : 5000 | �ɼ��׸� : 66, 
                    					�����Է� : 6000<br>
                    					����ȭ�鿡 �Է��� �׸��� ��µ˴ϴ�.<br>
                    					<!--<br>
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
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">�����</td>
                			<td width="53%" bgcolor="#FFFFFF" colspan="3"><?=$reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3"><span class="aa">�����������</span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                			<input type="radio" name="if_hide" value="0" <?if($if_hide=='0') echo "checked";?>>
                			������ ����� <br>
                			<input type="radio" value="1" name="if_hide" <?if($if_hide=='1') echo "checked";?>>������ �����������<br>
                			&nbsp;(����� ������, ������ ��µ����� �ʽ��ϴ�)</td>
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
        		<input class='butt_none' style='width:60' type="submit" value="�� ��" style='cursor:hand'> 
        		<input class='butt_none' style='width:60' type="reset" value="���Է�" style='cursor:hand'>
<?
if( $back == "ok" ){
?>
        		<input onclick="location.href='item_list_ok.php?back=<?=$back?>&prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="����Ʈ" style='cursor:hand'>
<?
}else{
?>
        		<input onclick="location.href='item_list.php?prevno=<?=$prevno?>&prevno2=<?=$prevno2?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>&pu=<?=$pu?>'" class='butt_none' style='width:60' type="button" value="����Ʈ" style='cursor:hand'>
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
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>	
<?
mysql_close($dbconn);
?>