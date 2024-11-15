<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";

$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_zoom_module = $ary["item_zoom_module"];
}

$SQL = "select * from $ItemTable where item_no = $item_no";

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$category_num = $ary["category_num"];
	$provider_id = $ary["mart_id"];
	$item_name = $ary["item_name"];
	$price = $ary["price"];
	$z_price = $ary["z_price"];
	$bonus = $ary["bonus"];
	$use_bonus = $ary["use_bonus"];
	$jaego = $ary["jaego"];
	$img = $ary["img"];
	$img_big = $ary["img_big"];
	$opt = $ary["opt"];
	$doctype = $ary["doctype"];
	$item_explain = $ary["item_explain"];
	$reg_date = $ary["reg_date"];
	$item_company = $ary["item_company"];
	$item_code = $ary["item_code"];
	$icon_no = $ary["icon_no"];
	$use_opt1 = $ary["use_opt1"];
	$use_opt23 = $ary["use_opt23"];
	$jaego_use = $ary["jaego_use"];
		
	$opts = explode("=", $opt);
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm)
{
	if(frm.item_name.value==""){alert("\n상품이름을 입력하세요.");frm.item_name.focus();return false;}	
	
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	
	
	var Digit = '1234567890'

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
	

	if (frm.bonus.value==""){
		alert("포인트를 입력하세요");
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
// mart_id : 상점 mart_id
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
</head>

<body onload=HandleLoad() bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="106" valign="top"><p align="left"><br>
    	<br>
    	<br>
    	</p>
    	
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
      	</tr>
      	<tr>
        	<td width="100%" height="1" bgcolor="#98A043"></td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#F2F2F2">
        		<p style="padding-left: 5px"><span class="bb"><br>
        		<small>▶</small> <font face="돋움">쇼핑몰 <strong>상품</strong>을<strong> <br>
        		&nbsp;&nbsp; 관리</strong>합니다.<br>
        		</font><br>
        		</span>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#98A043" height="1"></td>
      	</tr>
    	</table>
    	
    	<p align="left"><br>
    	<br>
    </td>
    <td width="1" bgcolor="#808080"><br>
    </td>
    <td width="646" bgcolor="#FFFFFF">
    	<div align="center"><center>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><strong><span class="cc">[상품 수정]</span></strong><span class="aa"> 상품을 수정합니다.<br>
        		</span><br>
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
          		
          		<form method="post" name=writeform onsubmit="return checkform(this)">
				<input type="hidden" name="flag" value="update">
				<input type="hidden" name="img_updateflag">
				<input type="hidden" name="img_big_updateflag">
				<input type="hidden" name="category_num" value="<?echo $category_num?>">
				<input type="hidden" name="prevno" value="<?echo $prevno?>">
				<input type="hidden" name="op1" value="">
				<input type="hidden" name="op2" value="">
				<input type="hidden" name="op3" value="">
				<input type="hidden" name="doctype" value="0">
				<input type="hidden" name="opt">
				<input type="hidden" name="item_explain" value='<?echo $item_explain?>'>
				<input type="hidden" name="use_opt1">
				<input type="hidden" name="use_opt23">
				<input type="hidden" name="reg_date" value='<?echo $reg_date?>'>
				<input type="hidden" name="page" value='<?echo $page?>'>
				<input type="hidden" name="img_old" value='<?echo $img?>'>
				<input type="hidden" name="img_big_old" value='<?echo $img_big?>'>
				
				<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				<span class="aa">상품명</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="item_name" size="14" value="<?echo $item_name?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="15%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<span class="aa"><p align="center">제조사</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="item_company" size="14" value="<?echo $item_company?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				<span class="aa">소비자가</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="price" size="14" value="<?echo $price?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="15%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<p align="center"><span class="aa">판매가</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="z_price" size="14" value="<?echo $z_price?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				<span class="aa">상품코드</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="item_code" size="14" value="<?echo $item_code?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="15%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<p align="center"><span class="aa">포인트</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="bonus" size="14" value="<?echo $bonus?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<span class="aa">재고관리</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<p align="left">&nbsp;<span class="aa">
                				<input class="aa" type='radio' name="jaego_use" value='1'
                				<?
                				if($jaego_use == 1) echo " checked";
                				?>
                				>사용 함
                				<input class="aa" type='radio' name="jaego_use" value='0'
                				<?
                				if($jaego_use == 0||$jaego_use == "") echo " checked";
                				?>
                				>사용 하지 않음
                				</span></td>
                			<td width="15%" bgcolor="#C8DFEC" align="left" colspan="2">
                				<p align="center"><span class="aa">재고량</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				<span class="aa"><input class="aa" name="jaego" value='<?echo $jaego?>' size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" rowspan="2" colspan="2">
                				<span class="aa">등록된<br>
                				제품<br>
                				이미지</span></td>
                			<td width="43%" bgcolor="#E6F0F7" align="left" colspan="2">
                				<p align="center"><span class="aa">&nbsp; &nbsp;중</span></td>
                			<td width="42%" bgcolor="#E6F0F7" align="left" colspan="2">
                				<span class="aa"><p align="center">대</span></td>
              			</tr>
              			<tr>
                			<td width="43%" bgcolor="#FFFFFF" align="left" colspan="2">
                				<span class="aa"><p align="center"></span>
                				<img src='<?echo "$Co_img_DOWN$provider_id/$img"?>' WIDTH="150" HEIGHT="144"><span class="aa"></span></td>
                			<td width="42%" bgcolor="#FFFFFF" align="left" colspan="2">
                				<span class="aa"><p align="center"></span>
                				<img src='<?echo "$Co_img_DOWN$provider_id/$img_big"?>' WIDTH="193" HEIGHT="185"><span class="aa"></span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#C8DFEC" align="center" colspan="6">
                				<span class="aa">상품설명</span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" align="center" colspan="6">
                				<span class="aa">
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
                				<span class="aa">옵션사용</span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt1_chk"
                				<?
                				if($use_opt1 == 't') echo " checked";
                				?>
                				>
                				<span class="aa"> 가격차등 옵션사용</span></td>
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
                				<span class="aa">옵션제목 </span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="op_name1" size="14" value='<?echo $op1_1[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="3">
                				<select name="opt1" size="2" style="WIDTH: 150">
          						<option>------------------</option>
        						<?
	            				for($i=1;$i< $op1_count;$i++){
	            					$op1_1 = explode("^", $op1[$i]);
	            					echo ("
	            				<option value='$op1[$i]'>$op1_1[0]($op1_1[1] 원)</option>
	            					");
	            				}
	            				?>		
	            				</select>
							</td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<span class="aa">옵션항목</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center"><span class="aa">
                				<input class="aa" name="pro_value1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<span class="aa">가격입력</span></td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<span class="aa"><p align="center">
                				<input class="aa" name="pro_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt23_chk"<?
                				if($use_opt23 == 't') echo " checked";
                				?>
                				>
                				<span class="aa"> 가격동일 옵션사용</span>
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
                				<span class="aa">옵션제목 1</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="op_name2" size="14" value='<?echo $op2[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="2">
                				<span class="aa"><p align="center"></span>
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
                				<span class="aa">옵션항목 1</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				<span class="aa"><input class="aa" name="pro_value2" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<?
        				if(isset($opts[2]) && $opts[2] != ""){
	            			$op3 = explode("!", $opts[2]);
	            			$op3_count = count($op3);
	            		}
	            		?>
	            		<tr>
                			<td width="26%" bgcolor="#C8DFEC" align="center" colspan="2">
                				<span class="aa">옵션제목 2</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="op_name3" size="14" value='<?echo $op3[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="2">
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
                				<span class="aa">옵션항목 2</span></td>
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				<span class="aa">
                				<input class="aa" name="pro_value3" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
                				<span class="aa">등록일</span></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
                				<p align="center"><span class="aa"><?echo $reg_date?></span></td>
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
        		<input class="aa" onclick="window.location.href='item_list_gnt.php?category_num=<?echo $category_num?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트로">
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
mysql_close($dbconn);
?>