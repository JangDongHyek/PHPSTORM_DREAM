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
<script>
var opt_order=1;
var opt_order2=1;
var opt_order3=1;
var opt_order4=1;
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
	for(j=0;j<opt_name.length;j++){
		if(opt_price[j]){
			frm.opt_price.value+=opt_price[j]+"/";
			frm.opt_name.value+=opt_name[j]+"/";
			frm.opt_ea.value+=opt_ea[j]+"/";
			frm.opt_order.value+=opt_order[j]+"/";
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
	frm.opt2.options[k+1].text=opt_name2[k]+"(+"+opt_price2[k]+"�� ��� :"+opt_ea2[k]+"�� code"+opt_code2[k]+")";

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
	var opt_price2=frm.opt_price2.value.split("/");
	var opt_name2=frm.opt_name2.value.split("/");
	var opt_ea2=frm.opt_ea2.value.split("/");
	var opt_order2=frm.opt_order2.value.split("/");
	var opt_code2=frm.opt_code2.value.split("/");
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
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
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
			frm.opt_price2.value+=opt_price2[j]+"/";
			frm.opt_name2.value+=opt_name2[j]+"/";
			frm.opt_ea2.value+=opt_ea2[j]+"/";
			frm.opt_order2.value+=opt_order2[j]+"/";
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
	var opt_code3=frm.opt_code3.value.split("/");
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
	for(j=0;j<opt_name3.length;j++){
		if(opt_price3[j]){
			frm.opt_price3.value+=opt_price3[j]+"/";
			frm.opt_name3.value+=opt_name3[j]+"/";
			frm.opt_ea3.value+=opt_ea3[j]+"/";
			frm.opt_order3.value+=opt_order3[j]+"/";
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
	var opt_price4=frm.opt_price4.value.split("/");
	var opt_name4=frm.opt_name4.value.split("/");
	var opt_ea4=frm.opt_ea4.value.split("/");
	var opt_order4=frm.opt_order4.value.split("/");
	var opt_code=frm.opt_code4.value.split("/");
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
		alert("������ �ɼ��� �����ϼž� �մϴ�.");
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
			frm.opt_price4.value+=opt_price4[j]+"/";
			frm.opt_name4.value+=opt_name4[j]+"/";
			frm.opt_ea4.value+=opt_ea4[j]+"/";
			frm.opt_order4.value+=opt_order4[j]+"/";
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
<script>
/*
function pro_add1(frm,pro,price,bonus,mem_price){
	var e1=document.createElement("OPTION")

	if (pro=="" ){
		alert ("�ɼ��׸��� �Է��ϼ���.");
		frm.pro_value1.focus ();
		return false;
	}else{
		if (price=="" ) {
			alert ("������ �Է��ϼ���.");
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
					e1.value = e1.value + "^" + mem_price;
					e1.text= e1.text + "S:" + mem_price +"��" ;

			}
	}

	document.all.opt1.add(e1);
	frm.pro_value1.value ="";
	frm.pro_price1.value ="";
	frm.pro_bonus1.value ="";
	frm.pro_mem_price1.value ="";
	frm.pro_value1.focus ();
}*/




</script>
<script src="../../editor/easyEditor.js"></script>
</head>
<?
include_once('../../editor_ori/func_editor.php');
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

				<!-- �ɼ� �׸� �߰� �� �� ���̴� ��-->
				<input type="hidden" name="opt_order" value="">
				<input type="hidden" name="opt_name" value="">
				<input type="hidden" name="opt_price" value="">
				<input type="hidden" name="opt_ea" value="">
				<input type="hidden" name="opt_code" value="">

				<input type="hidden" name="opt_order2" value="">
				<input type="hidden" name="opt_name2" value="">
				<input type="hidden" name="opt_price2" value="">
				<input type="hidden" name="opt_ea2" value="">
				<input type="hidden" name="opt_code2" value="">

				<input type="hidden" name="opt_order3" value="">
				<input type="hidden" name="opt_name3" value="">
				<input type="hidden" name="opt_price3" value="">
				<input type="hidden" name="opt_ea3" value="">
				<input type="hidden" name="opt_code3" value="">

				<input type="hidden" name="opt_order4" value="">
				<input type="hidden" name="opt_name4" value="">
				<input type="hidden" name="opt_price4" value="">
				<input type="hidden" name="opt_ea4" value="">
				<input type="hidden" name="opt_code4" value="">
				<!-- �ɼ� �׸� �߰� �� �� ���̴� ��-->
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
                                <textarea name="item_explain" id="item_explain"><?=$item_explain?></textarea>
                            </td>
                        </tr>

              			<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name1" size="14">
								<input type="checkbox" name="if_opt_jaego" value="1">������
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt1" size="6" style="width:250" onchange="opt_change(this)">
          						<option>-------------------------------------</option>
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
							<td colspan="6" height="10" bgcolor="#ffffff"></td>
						</tr>


						<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ�����2
							</td>
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name2" size="14">
								<input type="checkbox" name="if_opt_jaego2" value="1">������
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt2" size="6" style="width:250" onchange="opt_change2(this)">
          						<option>-------------------------------------</option>
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
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name3" size="14">
								<input type="checkbox" name="if_opt_jaego3" value="1">������
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt3" size="6" style="width:250" onchange="opt_change3(this)">
          						<option>-------------------------------------</option>
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
                			<td width="25%" bgcolor="#FFFFFF">
                				<input class='input' name="op_name4" size="14">
								<input type="checkbox" name="if_opt_jaego4" value="1">������
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="5">
                				<select name="opt4" size="6" style="width:250" onchange="opt_change4(this)">
          						<option>-------------------------------------</option>
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
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<table border="0" width="80%">
                  				<tr>
                    				<td width="100%" align="center">
                    					<font color="#0000FF">�ɼ� ���� ��� ����</font>
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
        <script>
            var ed = new easyEditor("item_explain"); //�ʱ�ȭ id�Ӽ���
            ed.init(); //�������� ����
        </script>
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

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, img, img_big, img_big2, img_big3, img_big4, img_big5, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee, item_kyukyuk,min_buy,opt2,opt3,opt4,if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$img_new','$img_big_new','$img_big2_new','$img_big3_new','$img_big4_new','$img_big5_new','$op_name1','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee', '$item_kyukyuk', '$min_buy','$op_name2','$op_name3','$op_name4','$if_opt_jaego','$if_opt_jaego2','$if_opt_jaego3','$if_opt_jaego4')";

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
	$sql="select max(item_no) as item_no from $ItemTable";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$item_no=$rs[item_no];
	$opt_name=explode("/",$opt_name);
	$opt_price=explode("/",$opt_price);
	$opt_ea=explode("/",$opt_ea);
	$opt_order=explode("/",$opt_order);
	$opt_code=explode("/",$opt_code);
	for($i=0;$i<sizeof($opt_name)-1;$i++){
		$sql="insert into $OptionTable(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name[$i]','$opt_price[$i]','$opt_ea[$i]','$opt_order[$i]','$opt_code[$i]')";
		$result=mysql_query($sql);
	}
	
	$opt_name2=explode("/",$opt_name2);
	$opt_price2=explode("/",$opt_price2);
	$opt_ea2=explode("/",$opt_ea2);
	$opt_order2=explode("/",$opt_order2);
	$opt_code2=explode("/",$opt_code2);
	for($i=0;$i<sizeof($opt_name2)-1;$i++){
		$sql="insert into $OptionTable2(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name2[$i]','$opt_price2[$i]','$opt_ea2[$i]','$opt_order2[$i]','$opt_code2[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name3=explode("/",$opt_name3);
	$opt_price3=explode("/",$opt_price3);
	$opt_ea3=explode("/",$opt_ea3);
	$opt_order3=explode("/",$opt_order3);
	for($i=0;$i<sizeof($opt_name3)-1;$i++){
		$sql="insert into $OptionTable3(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name3[$i]','$opt_price3[$i]','$opt_ea3[$i]','$opt_order3[$i]','$opt_code3[$i]')";
		$result=mysql_query($sql);
	}

	$opt_name4=explode("/",$opt_name4);
	$opt_price4=explode("/",$opt_price4);
	$opt_ea4=explode("/",$opt_ea4);
	$opt_order4=explode("/",$opt_order4);
	$opt_code4=explode("/",$opt_code4);
	for($i=0;$i<sizeof($opt_name4)-1;$i++){
		$sql="insert into $OptionTable4(item_no,opt_name,opt_price,opt_ea,opt_order,opt_code) values('$item_no','$opt_name4[$i]','$opt_price4[$i]','$opt_ea4[$i]','$opt_order4[$i]','$opt_code4[$i]')";
		$result=mysql_query($sql);
	}
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>