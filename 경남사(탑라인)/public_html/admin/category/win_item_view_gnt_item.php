<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag == ''){

	$SQL = "select * from $Gnt_ItemTable where seller_id = '$Mall_Admin_ID' and item_no = $item_no";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0) {
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$seller_price = $ary["seller_price"];
		$category_num = $ary["category_num"];
		$seller_bonus = $ary["seller_bonus"];
		$seller_icon_no = $ary["seller_icon_no"];
		$seller_mem_price = $ary["seller_mem_price"];
	}
	
	$SQL = "select * from $ItemTable where item_no = $item_no";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0) {
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$mart_id_tmp = $ary["mart_id"];
		$item_name = $ary["item_name"];
		$price = $ary["price"];
		$z_price = $ary["z_price"];
		$bonus = $ary["bonus"];
		$use_bonus = $ary["use_bonus"];
		$jaego = $ary["jaego"];
		$img_sml = $ary["img_sml"];
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
		$if_provide_item = $ary["if_provide_item"];
		$provide_price = $ary["provide_price"];
		
		$opts = explode("=", $opt);
	}
	if($seller_price != 0) $z_price = $seller_price;
	if($seller_bonus == 0) {
		$seller_bonus = $bonus;
	}
	if($seller_mem_price != 0) {
		$member_price = $seller_mem_price;
	}
	if($seller_icon_no == '') {
		$seller_icon_no = $icon_no;
	}
?>
<?
	include "../admin_head.php";
?>
<script language="JavaScript">
function checkform(frm){
	var Tmp1="";
	var Tmp2="";
	var Tmp3="";	
	
	
	
	var Digit = '1234567890'

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
	if (frm.seller_bonus.value==""){
		alert("보너스를 입력하세요");
		frm.seller_bonus.focus();
		return false;
	}
	else{
		var len =frm.seller_bonus.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = frm.seller_bonus.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력 하세요");
					frm.seller_bonus.focus();
					return false;
			} 
			ret = false;
		}	
	
	}
	return true;
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
	f.z_price.focus();
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

<body onload='HandleLoad()' bgcolor="#FFFFFF" topmargin="0" leftmargin="0">

<table border="0" width="646" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="646" bgcolor="#FFFFFF">
    	<div align="center"><center>
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      	<tr>
        	<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
        		<p style="padding-left: 10px"><strong>[상품 수정]</strong>
        		  GNT 상품은 판매가,마일리지,회원가만 수정할 수 있습니다.<br>
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
          		
          		<form method="post" name=writeform onsubmit="return checkform(this)">
				<input type="hidden" name="flag" value="update">
				<input type="hidden" name="item_no" value="<?echo $item_no?>">
				<input type="hidden" name="item_explain" value='<?echo $item_explain?>'>
				<input type="hidden" name="category_num" value='<?echo $category_num?>'>
				
				<tr>
            		<td width="90%" bgcolor="#999999">
            			<table border="0" width="100%" cellspacing="1" cellpadding="3">
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan='2'>
                				상품명</td>
                			<td width="32%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_name" size="14" value="<?echo $item_name?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
                			<td width="18%" bgcolor="#C8DFEC" align="left" colspan='2'>
                				<p align="center">제조사</td>
                			<td width="35%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="item_company" size="14" value="<?echo $item_company?>" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
              			</tr>
              			<tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">소비자가 
			                </td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="price" value='<?echo $price?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14" disabled></td>
			                <td align="left" width="15%" bgColor="#c8dfec" colspan="2"><p align="center">상품코드</td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="item_code" value='<?echo $item_code?>' style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14" disabled></td>
			              </tr>
			              <tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">재고관리</td>
			                <td align="middle" width="35%" bgColor="#ffffff"><p align="left">&nbsp; 
			                <input type="radio" value="1" disabled name="jaego_use"
			                <?
              				if($jaego_use == 1) echo " checked";
              				?>
              				>사용 함 
			                <input type="radio" value="0" disabled name="jaego_use"
			                <?
              				if($jaego_use == 0) echo " checked";
              				?>
              				>사용 하지 않음 </td>
			                <td align="left" width="15%" bgColor="#c8dfec" colspan="2"><p align="center">
			                재고량</td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="jaego" value='<?echo $jaego?>' disabled style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></td>
			              </tr>
			              <tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">판매가</td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="z_price" value="<?echo $z_price?>" style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></td>
			                <td align="left" width="15%" bgColor="#c8dfec" colspan="2"><p align="center">회원가</td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="member_price" value="<?echo $member_price?>" style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></td>
			              </tr>
			              <tr>
                			<td align="middle" width="15%" bgColor="#c8dfec" colspan="2">
                				공급여부</td>
                			<td align="middle" width="32%" bgColor="#ffffff">
                				
                				<input type="radio" value="1" name="if_provide_item"<?if($if_provide_item == 1) echo " checked"?> disabled>가능 
                				<input type="radio" value="0" name="if_provide_item"<?if($if_provide_item == 0) echo " checked"?> disabled>불가능</td>
                			<td align="left" width="18%" bgcolor="#c8dfec" colspan="2">
                				<p align="center">공급가</td>
                			<td align="middle" width="35%" bgcolor="#ffffff">
                				
                				<input style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14" name="provide_price" value='<?echo $provide_price?>' disabled></td>
              			</tr>
			              <tr>
			                <td align="middle" width="15%" bgColor="#c8dfec" colSpan="2">마일리지</td>
			                <td align="middle" width="35%" bgColor="#ffffff">
			                <input name="seller_bonus" size="14" value="<?echo $seller_bonus?>" style="BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; WIDTH: 90%; BORDER-BOTTOM: rgb(136,136,136) 1px solid" size="14"></td>
			                <td align="left" width="50%" bgColor="#FFFFFF" colspan="3" bordercolor="#FFFFFF"></td>
			              </tr>
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
					      			if($img_sml != '' && file_exists("$Co_img_UP$mart_id_tmp/$img_sml")){
				      					if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id_tmp/$img_sml' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id_tmp/$img_sml' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			                <td align="center" width="32%" bgColor="#ffffff" colspan="2">
			                <?
					      			if($img != '' && file_exists("$Co_img_UP$mart_id_tmp/$img")){
				      					if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id_tmp/$img' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id_tmp/$img' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			                <td align="center" width="29%" bgColor="#ffffff">
			                <?
					      			if($img_big != '' && file_exists("$Co_img_UP$mart_id_tmp/$img_big")){
				      					if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
													echo "
				      					<img src='$Co_img_DOWN$mart_id_tmp/$img_big' width='99' height='95'>
				      						";
				      					}
				      					if (strstr(strtolower(substr($img_big,-4)),'.swf')){
													echo "
				      					<embed src='$Co_img_DOWN$mart_id_tmp/$img_big' width='99' height='95'></embed>
				      						";
				      					}
					      			}
					      			?>
					      			</td>
			              </tr>
			              <!--
			              <tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" rowspan="2" colspan="2">
                				등록된<br>
                				제품<br>
                				이미지</td>
                			<td width="43%" bgcolor="#E6F0F7" align="left" colspan="2">
                				<p align="center">&nbsp; &nbsp;중</td>
                			<td width="42%" bgcolor="#E6F0F7" align="left" colspan="2">
                				<p align="center">대</td>
              			</tr>
              			<tr>
                			<td width="43%" bgcolor="#FFFFFF" align="left" colspan="2">
                				<p align="center">
                				<img src='<?echo "$Co_img_DOWN$mart_id_tmp/$img"?>' WIDTH="150" HEIGHT="144"></td>
                			<td width="42%" bgcolor="#FFFFFF" align="left" colspan="2">
                				<p align="center">
                				<img src='<?echo "$Co_img_DOWN$mart_id_tmp/$img_big"?>' WIDTH="193" HEIGHT="185"></td>
              			</tr>
              			//-->
              			<tr>
                			<td width="15%" bgcolor="#C8DFEC" align="center" colspan="2">
                				아이콘 선택</td>
                			<td width="85%" bgcolor="#FFFFFF" align="left" colspan="4">
                				
                				<input name="seller_icon_no" type="radio" value="0"
                				<?
                				if($seller_icon_no == 0) echo " checked"
                				?>
                				>
                				<font color="#0000FF">사용않음</font>
                				<input name="seller_icon_no" type="radio" value="1"
                				<?
                				if($seller_icon_no == 1) echo " checked"
                				?>
                				>
                				<img src="../images/hot.gif" WIDTH="22" HEIGHT="13">
                				<input name="seller_icon_no" type="radio" value="2"
                				<?
                				if($seller_icon_no == 2) echo " checked"
                				?>
                				>
                				<img src="../images/new.gif" WIDTH="22" HEIGHT="13">
                				<input name="seller_icon_no" type="radio" value="3"
                				<?
                				if($seller_icon_no == 3) echo " checked"
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
                				
                				<input name="editmode" onclick="setEditMode('html');" type="radio" value="html" disabled>에디터 
        						<input name="editmode" onclick="setEditMode('text');" type="radio" value="text" disabled>HTML 직접입력 
                				<table>
                  				<tr>
          						<td width="100%" bgcolor="#FFFFFF"><p align="center">
          							<OBJECT id=editBox data=../editor/Editor_sml.htm width=530 height=160 type=text/x-scriptlet disabled></OBJECT>
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
                				<input type="checkbox" name="use_opt1_chk" disabled
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
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name1" size="14" value='<?echo $op1_1[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3" rowspan="3">
                				<select name="opt1" size="2" style="WIDTH: 150" disabled>
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
                				옵션항목</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_value1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
              			</tr>
              			<tr>
                			<td width="21%" bgcolor="#C8DFEC" align="center" colspan="2">
                				가격입력</td>
                			<td width="35%" bgcolor="#FFFFFF" align="left">
                				<p align="center">
                				<input name="pro_price1" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#DBEAF2" align="center" colspan="6">
                				<input type="checkbox" name="use_opt23_chk" disabled
                				<?
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
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name2" size="14" value='<?echo $op2[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="2">
                				<p align="center">
                				<select name="opt2" size="2" style="WIDTH: 150;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;" disabled>
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
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="pro_value2" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
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
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="op_name3" size="14" value='<?echo $op3[0]?>' style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3" rowspan="2">
                				<p align="center">
                				<select name="opt3" size="2" style="WIDTH: 150;BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid;" disabled>
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
                			<td width="25%" bgcolor="#FFFFFF" align="center">
                				
                				<input name="pro_value3" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid" disabled></td>
              			</tr>
              			<tr>
                			<td width="50%" bgcolor="#C8DFEC" align="center" colspan="3">
                				등록일</td>
                			<td width="50%" bgcolor="#FFFFFF" align="left" colspan="3">
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
        	<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
        		<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">
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
if($flag == 'update'){

	$SQL = "update $Gnt_ItemTable set seller_price = '$z_price', seller_bonus='$seller_bonus', 
	seller_mem_price ='$member_price', seller_icon_no='$seller_icon_no' where seller_id = '$Mall_Admin_ID' and item_no = $item_no";

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