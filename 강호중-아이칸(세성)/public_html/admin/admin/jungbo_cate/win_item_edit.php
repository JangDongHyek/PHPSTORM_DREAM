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
	if(frm.item_name.value==""){alert("\n��ǰ�̸��� �Է��ϼ���.");frm.item_name.focus();return false;}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	
	
	var Digit = '1234567890'

	/*
	if (frm.price.value==""){
		alert("�Һ��ڰ��� �Է��ϼ���");
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
					
					alert("���ڸ� �Է� �ϼ���");
					frm.price.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	*/
	if (frm.z_price.value==""){
		alert("�ǸŰ��� �Է��ϼ���");
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
					
					alert("���ڸ� �Է� �ϼ���");
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
					
					alert("���ڸ� �Է� �ϼ���");
					frm.member_price.focus();
					return false;
			}
			ret = false;
		}	
	}
	if (frm.bonus.value==""){
		alert("���ϸ����� �Է��ϼ���");
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
					
					alert("���ڸ� �Է� �ϼ���");
					frm.bonus.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	if(frm.jaego_use[0].checked){
		
		if (frm.jaego.value==""){
			alert("����� �Է��ϼ���");
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
						
						alert("���ڸ� �Է� �ϼ���");
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
	checkform1();
	if(frm.use_opt1_chk.checked) frm.use_opt1.value = 't';
	else frm.use_opt1.value = 'f';
	
	if(frm.use_opt23_chk.checked) frm.use_opt23.value = 't';
	else frm.use_opt23.value = 'f';
	
	
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
               
    }       

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




	function pro_add1(frm,pro,price,bonus,mem_price)
	{

		var e1=document.createElement("OPTION")

		if (pro=="" ){ 
			alert ("�ɼ��׸��� �Է��ϼ���.");
			frm.pro_value1.focus (); 
			return false;
		}
			
		else{	
				if (price=="" ) {

					alert ("������ �Է��ϼ���.");
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
										
										alert("���ϸ������� ���ڸ� �����մϴ�.");
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

//*************************** ���� ���ε� â ********************************************************************

function fileup(formname,imagename){
// formname : form �� name
// mart_id : Ȩ������ mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename
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
        		<p style="padding-left: 10px"><strong>[��ǰ ����]</strong> ��ǰ�� �����մϴ�.<br>
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
                				��ǰ��</td>
                			<td width="32%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_name" size="14" value="<?echo $item_name?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="18%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<p align="center">������</td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_company" size="14" value="<?echo $item_company?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td bgcolor="#C8DFEC" align="center" colspan="2">
                				���޻�
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
              			</tr>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">
								�Һ��ڰ� <input disabled type="checkbox" value="1" name="if_strike">
							</td>
			                <td bgColor="#ffffff">
								<input name="price" value='<?=$price?>'  class='input' size="14">
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
								�ǸŰ�
							</td>
			                <td bgColor="#ffffff">
								<input name="z_price" value="<?=$z_price?>" class='input' size="14" onKeyDown="checkNumber()">
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
								���ް�
							</td>
			                <td bgColor="#ffffff">
								<input name="member_price" value="<?=$member_price?>"  class='input' size="14" onkeyup="this.value=comma(this.value);" onKeyDown="checkNumber()">
							</td>							
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								���ϸ���
							</td>
			                <td bgColor="#ffffff">
								<input name="bonus" value="<?=$bonus?>"  class='input' size="14">
							</td>
			              </tr>
			              <tr>
			                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><br>
			                <font color="#0000ff">�Һ��ڰ��� Ȩ�������� ��µ��� �ʽ��ϴ�.<br>
			                �ǸŰ�, ȸ����, ���ϸ����� ���ڸ� �Է��Ͻð�, ���ϸ����� 
			                �������� ���� ��� &quot;0&quot;�� �Է��ϼ���.<br>
			                ��ǰ��Ͻ� ���������� ȸ������ �Է��Ͻø� �⺻�������� ������ ȸ������ �ش��ǰ�� ����<br>
											������� �ʽ��ϴ�.</font><br>
			                <br>
			                </td>
			              </tr>
              			<?
              			if($if_gnt_item == 1){
              			?>
              			<tr>
                			<td align="middle" width="15%" bgColor="#c8dfec" colspan="2">
                				���޿���</td>
                			<td align="middle" width="32%" bgColor="#ffffff">
                				
                				<input type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?>>���� 
                				<input type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?>>�Ұ���</td>
                			<td align="left" width="18%" bgcolor="#c8dfec" colspan="2">
                				<p align="center">���ް�</td>
                			<td align="middle" width="35%" bgcolor="#ffffff">
                				
                				<input style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14" name="provide_price" value='<?echo $provide_price?>'></td>
              			</tr>
              			<?
              			}
              			?>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2" rowspan="2">
			                ��ϵ�<br>
			                ��ǰ<br>
			                �̹���</td>
			                <td align="left" width="26%" bgColor="#e6f0f7"><p align="center">
			                &nbsp;&nbsp;����/����Ʈ&nbsp;</td>
			                <td align="center" width="32%" bgColor="#e6f0f7" colspan="2">
			                &nbsp; &nbsp;�󼼼���</td>
			                <td align="center" width="29%" bgColor="#e6f0f7">
			                &nbsp;Ȯ���̹���</td>
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
			                ��ǰ<br>
			                �̹���</td>
			                <td align="middle" width="7%" bgColor="#E8F1F7">����/����Ʈ</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img_sml" value='<?echo $img_sml?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img_sml');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���">
			                &nbsp; </td>
			              </tr>
			              <tr>
			                <td align="middle" width="7%" bgColor="#E8F1F7">
			                �󼼼���</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img" value='<?echo $img?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���">
			                &nbsp; </td>
			              </tr>
			              <tr>
			                <td align="middle" width="7%" bgColor="#E8F1F7">
			                Ȯ���̹���</td>
			                <td align="left" width="87%" bgColor="#ffffff" colspan="4">
			                &nbsp; 
			                <input name="img_big" value='<?echo $img_big?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
			                <input onclick="javascript:fileup('writeform','img_big');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���">
			                &nbsp; <br>
			                �÷��� ���α���
			                <input name="flash_big_width" value='<?echo $flash_big_width?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="3">&nbsp;&nbsp;&nbsp; 
			                ���α���
			                <input name="flash_big_height" value='<?echo $flash_big_height?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="3">&nbsp;&nbsp;&nbsp; <br>
			                <font color="#0000ff">�÷��� ������ �ø���� ���ο�, ���� ���̸� �Է����ּ���.������ 
			                px �Դϴ�.</font> </td>
			              </tr>
			              <tr>
			                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><p
			                align="left"><img height="15" src="../images/tip.gif" width="30"> <font
			                color="#0000ff">
			                �̹����� jpg,gif,swf�� �����մϴ�.<br>
			                ����/����Ʈ ȭ���� ������� 100*100 px �����Դϴ�.<br>
			                �󼼼��� �������� ������� 180*180 px �����Դϴ�.<br>
			                Ȯ���̹����� ���������� 400*400 px�̰�, ���Ǵ�� ���������� 
			                �����մϴ�.<br>
			                ����/����Ʈ/�󼼼����� 50kb, Ȯ���̹����� �뷮�� 100kb�� ���� �� 
			                �����ϴ�.</font></td>
			              </tr>
			              <tr>
		                <td align="middle" width="8%" bgColor="#c8dfec">��ȭ��<br>
		                �̹���</td>
		                <td align="middle" width="94%" bgColor="#FFFFFF" colspan="5"><p align="left">
		                ��
		                <input name="img_high" value='<?echo $img_high?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 50%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"> 
		                <input onclick="javascript:fileup('writeform','img_high');" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="ã�ƺ���"> 
		                &nbsp; <br>
		                </td>
		              </tr>
		              <tr>
		                <td align="middle" width="100%" bgColor="#ffffff" colSpan="6"><font
		                color="#0000ff"><p align="left"></font><img height="15" src="../images/tip.gif"
		                width="30"> <font color="#0000ff">��ȭ�� �̹����� �̹��������α׷��� 
		                �̿��Ͽ� ������ �̹���(icp,ixf)�� ���ε��� �� �ֽ��ϴ�.<br>
		                �̹��� �뷮�� 300kb�� ���� �� �����ϴ�.<br>
		                ��ȭ�� �̹����� ����Ͻ� ��쿡�� Ȯ���̹����� ������� �ʽ��ϴ�.</font></td>
		              </tr>
			              <tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				������ ����</td>
                			<td width="85%" bgcolor="#FFFFFF" align="left" colspan="4">
                				
                				<input name="icon_no" type="radio" value="0"
                				<?
                				if($icon_no == 0) echo " checked"
                				?>
                				>
                				<font color="#0000FF">������</font>
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
                				<font color="#0000FF">�Ż�ǰ�̳� ��õ��ǰ �� �����ϰ� ���� ��ǰ�� 
                				�������� �����ϼ���.<br>
                				��� ��ǰ�� �� ���� ��� ��ĩ �길���� ���� ������ �� �ʿ��� 
                				��ǰ���� <br>
                				�����ϼ���.</font>
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				��ǰ����</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				
                				<input name="editmode" onclick="setEditMode('html');" type="radio" value="html">������ 
        						<input name="editmode" onclick="setEditMode('text');" type="radio" value="text">HTML �����Է� 
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
                				�ɼǻ��</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk"
                				<?
                				if($use_opt1 == 't') echo " checked";
                				?>
                				>
                				 �������� �ɼǻ��</td>
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
                				�ɼ����� </td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name1" size="14" value='<?echo $op1_1[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
                			<td width="53%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="6">
                				<select name="opt1" size="2" style="WIDTH: 250">
          						<option>-------------------------------------</option>
        						<?
	            				for($i=1;$i< $op1_count;$i++){
	            					$op1_1 = explode("^", $op1[$i]);
	            					if(!empty($op1_1[2])) $bonus_str = "M:".$op1_1[2]."��";
	            					else $bonus_str = '';
	            					
	            					if(!empty($op1_1[3])) $mem_price_str = "S:".$op1_1[3]."��";
	            					else $mem_price_str = '';
	            					echo ("
	            				<option value='$op1[$i]'>$op1_1[0]($op1_1[1] ��)$bonus_str $mem_price_str</option>
	            					");
	            				}
	            				?>		
	            				</select><br>
	            				M: ���ϸ��� S: ȸ����
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ��׸�</td>
                			<td width="32%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_value1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�����Է�</td>
                			<td width="32%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				���ϸ����Է�</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_bonus1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				ȸ�����Է�</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_mem_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
                				<input onclick="pro_add1(this.form,document.all.pro_value1.value,document.all.pro_price1.value,document.all.pro_bonus1.value,document.all.pro_mem_price1.value)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�Է�"> 
                				<input  onclick="pro_del1(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="����">
                			</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
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
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ����� 1</td>
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
                				�ɼ��׸� 1</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				<input name="pro_value2" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
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
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				�ɼ����� 2</td>
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
                				�ɼ��׸� 2</td>
                			<td width="22%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="pro_value3" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></td>
              			</tr>
              			<tr>
                			<td width="47%" bgcolor="#FFFFFF" align="center" colspan="3">
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
                    					������ �ɼ�����, ���� ������ �ɼ��� ������ �� �ֽ��ϴ�. ���� 
                    					�������� �ɼǻ������ ���ݵ��� �ɼǻ�������� �����ϼ���.<br>
                    					<br>
                    					1. �������� �ɼǻ���� ���<br>
                    					��)����� ���� ������ �޶����� ���, <br>
                    					�ɼ�����: ������, �ɼ��׸�: 55, �����Է� : 5000 | �ɼ��׸� : 66, 
                    					�����Է� : 6000<br>
                    					����ȭ�鿡 �Է��� �׸��� ��µ˴ϴ�.<br>
                    					<br>
                    					2. ���ݵ��� �ɼǻ���� ���<br>
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
                			<td width="47%" bgcolor="#C8DFEC" align="center" colspan="3">
                				�����</td>
                			<td width="53%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<p align="center"><?echo $reg_date?></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">Ȩ�������������</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                			<input type="radio" name="if_hide" value="0"
                			<?
                			if($if_hide=='0') echo "checked";
                			?>
                			>
                			 Ȩ�������� ����� <br>
                			<input type="radio" value="1" name="if_hide"
                			<?
                			if($if_hide=='1') echo "checked";
                			?>
                			>Ȩ�������� ����������� <br>
                			&nbsp; (����� ������, Ȩ�������� ��µ����� �ʽ��ϴ�)</td>
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
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�"> 
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
        		<input onclick="window.close()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="�ݱ�">
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
	
	if(isset($img_sml)&&($img_sml != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_sml_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_sml_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_sml_old"); // ����...
				}
			}
			
			$img_sml_new = "item_sml_".$item_no."_".$img_sml; // ȭ�� ���� ���� ¢��
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_sml","$Co_img_UP$mart_id/$img_sml_new" );	//�� ���� ����
		}
		else{
			$img_sml_new = $img_sml;
		}
		
	}
	else{ // �һ����� �̹��� ��ĭ..
		// ���� �һ����� �̹��� ������ ����.
		if($img_sml_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_sml_old")){
				unlink("$Co_img_UP$mart_id/$img_sml_old");
			}
		}
	}
	
	if(isset($img_big)&&($img_big != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if($img_big_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_big_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_big_old"); // ����...
				}
			}
			
			$img_big_new = "item_big_".$item_no."_".$img_big; // ȭ�� ���� ���� ¢��
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // ȭ�� �ִ��� Ȯ���ϰ�
				copy ("$Co_img_UP$mart_id/$img_big","$Co_img_UP$mart_id/$img_big_new" );	//�� ���� ����
		}
		else{
			$img_big_new = $img_big;
		}
		
	}
	else{ // ������� �̹��� ��ĭ..
		// ���� ������� �̹��� ������ ����.
		if($img_big_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_big_old")){
				unlink("$Co_img_UP$mart_id/$img_big_old");
			}
		}
	}
	
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			
			if($img_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_old"); // ����...
				}
			}
			
			$img_new = "item_".$item_no."_".$img;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img"))
				copy ("$Co_img_UP$mart_id/$img","$Co_img_UP$mart_id/$img_new" );	//�� ���� ����
		}
		else{
			$img_new = $img;
		}
		
	}
	else{ // �߻����� �̹��� ��ĭ..
		// ���� �߻����� �̹��� ������ ����.
		if($img_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_old")){
				unlink("$Co_img_UP$mart_id/$img_old");
			}
		}
	}
	
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			
			if($img_high_old !=""){ // ���� ȭ�� �ִ°�?
				if(file_exists("$Co_img_UP$mart_id/$img_high_old")){ // ȭ�� ������...
					unlink("$Co_img_UP$mart_id/$img_high_old"); // ����...
				}
			}
			
			$img_high_new = "item_high_".$item_no."_".$img_high;
			//echo "img_new = $img_new";
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				copy ("$Co_img_UP$mart_id/$img_high","$Co_img_UP$mart_id/$img_high_new" );	//�� ���� ����
		}
		else{
			$img_high_new = $img_high;
		}
		
	}
	else{ // �߻����� �̹��� ��ĭ..
		// ���� �߻����� �̹��� ������ ����.
		if($img_high_old !=""){
			if(file_exists("$Co_img_UP$mart_id/$img_high_old")){
				unlink("$Co_img_UP$mart_id/$img_high_old");
			}
		}
	}
	
	if(isset($img_sml)&&($img_sml != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_sml_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_sml"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_sml");	//�ӽ� ���� ����
		}
	}
	if(isset($img_big)&&($img_big != "")){ // ȭ�� �Է³��� �����ƴϰ�
		if($img_big_updateflag=="ok"){ // ȭ�� ������Ʈ �Ǿ���..
			if(file_exists("$Co_img_UP$mart_id/$img_big"))  // ȭ�� �ִ��� Ȯ���ϰ�
				unlink ("$Co_img_UP$mart_id/$img_big");	//�ӽ� ���� ����
		}
	}
	if(isset($img)&&($img != "")){
		if($img_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img"))
				unlink ("$Co_img_UP$mart_id/$img");	//�ӽ� ���� ����
		}
	}
	if(isset($img_high)&&($img_high != "")){
		if($img_high_updateflag=="ok"){
			if(file_exists("$Co_img_UP$mart_id/$img_high"))
				unlink ("$Co_img_UP$mart_id/$img_high");	//�ӽ� ���� ����
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