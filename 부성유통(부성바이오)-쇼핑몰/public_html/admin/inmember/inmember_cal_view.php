<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../admin_head.php";
include "../stat/cal.php";
?>
<?
$mem_sql = "select name from $MemberTable where username='$username'";
$mem_res = mysql_query( $mem_sql, $dbconn );
$mem_row = mysql_fetch_array( $mem_res );
$mem_name = $mem_row[name];
if( $mem_res ){
	mysql_free_result( $mem_res );
}
?>
<?
if($QryFromDate == '') $QryFromDate = date("Y-m");
if($QryToDate == '') $QryToDate = date("Y-m");
if($QryMonth == '') $QryMonth = date("Y-m");
?>
<script>
function fn_betdate(objname1, objname2, difvalue){	//'기준날짜를 기준으로 이후 날짜 가져오기
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?echo date("Y")?>,<?echo date("m")?>-1,<?echo date("d")?>);
	var arrValue = new Array();
	obj2.value = fn_getdate(datD);
	arrValue = difvalue.split(":");
	if(arrValue[0] == "D"){
		datD.setDate(datD.getDate() - eval(arrValue[1]));
	}
	if(arrValue[0] == "M"){
		datD.setMonth(datD.getMonth() - eval(arrValue[1]));
	}
	obj1.value = fn_getdate(datD);
}
function fn_getdate(datArg){	//'현재 날자 가져오기
	var datD = datArg;
	var strTemp = "";
	strTemp = strTemp + datD.getYear() + "-";
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2);
	//strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	//strTemp = strTemp + fn_numformat(datD.getDate(),2);
	return strTemp;
}
function fn_numformat(intNum, intLen){	//'글자수에 맞추어 0을 더한 숫자 생성
	var strNum = intNum + "";
	var strTemp = "";
	for(i = 0; i < (eval(intLen) - strNum.length); i++){
		strTemp = "0" + strTemp;
	}
	strTemp = strTemp + strNum;
	return strTemp;
}
function MM_findObj(n, d, f) { //'객체명 찾기
	var p,i,x;
	if(!d) d = document;
	if((p = n.indexOf("?"))>0 && parent.frames.length) {
		d = parent.frames[n.substring(p+1)].document;
		n = n.substring(0,p);
	}
	if(!(x = d[n]) && d.all) x = d.all[n];
	for (i = 0;!x && i<d.forms.length;i++) x = d.forms[i][n];
	for(i = 0;!x && d.layers && i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
	if(!x  &&  document.getElementById) x = document.getElementById(n); 
	if(f) x = d.form1[n];
	return x;
}
</script>
<script>
function goto_byselect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}

function checkform(){
	var frm = document.form1;
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("시작월을 입력하세요");
		frm.QryFromDate.focus();
		return false;
	}
	else{
		var len =frm.QryFromDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryFromDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryFromDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryToDate.value==""){
		alert("종료월을 입력하세요");
		frm.QryToDate.focus();
		return false;
	}
	else{
		var len =frm.QryToDate.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryToDate.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryToDate.focus();
				return false;
			}
			ret = false;
		}	
	}
	if (frm.QryMonth.value==""){
		alert("해당월을 입력하세요");
		frm.QryMonth.focus();
		return false;
	}
	else{
		var len =frm.QryMonth.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){
		 	if(i == 4) i++;
		 	var ch = frm.QryMonth.value.substring(i,i+1);
			
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			
			if (!ret){
				alert("형식에 맞게 입력 하세요");
				frm.QryMonth.focus();
				return false;
			}
			ret = false;
		}	
	}
	return true;
}

function item_search(){
	if(checkform() == false) return false;
	var f=document.form1;
	if(f.item_name.value == ''){
		alert("검색어를 입력해 주세요.");
		f.item_name.focus();
		return false;
	}
	f.search_flag.value = 'item';
	f.submit();
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>정산 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">현재 쇼핑몰에 가입한 모든 입점몰들에 대한 정산을 기록/관리하는 곳입니다.<br>배송완료된 상품만 정산에 포함됩니다.</td>
			</tr>
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
			  <table width="95%" border="0" align="center">
				 <tr>
					<td width="100%" colSpan="2" height="20"><p align="center"><b>[<?=$mem_name?> 정산 리스트]</b></td>
				 </tr>
				 <tr>
					<td colSpan="2">
						<form id='form1' action='<?=$PHP_SELF?>' name='form1' method='post'>
						<input type='hidden' name='flag' value='search'>
						<input type='hidden' name='search_flag' value=''>
						<input type='hidden' name='page' value='<?=$page?>'>
						<input type='hidden' name='username' value='<?=$username?>'>
						<table border="0" width="100%" cellspacing="1" cellpadding="3">				
							<tr>
								<td width="100%" bgcolor="#E9F5F5" height="30">
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
<?
if($QryFromDate == '') $QryFromDate = date("Y-m");
if($QryToDate == '') $QryToDate = date("Y-m");
if($QryMonth == '') $QryMonth = date("Y-m");
?>
                      				<tr>
										<td width="100%" height="25" colspan="5">
											<table border="0" width="98%" cellspacing="1" cellpadding="2">
												<tr>
													<td width="3%">
														<input type="radio" value="months" name="out_form" <?if($out_form == 'months'||$out_form == '') echo "checked"?>>
													</td>
													<td width="164%" colspan="2">기간을 정하여 검색합니다.</td>
												</tr>
												<tr>
													<td width="3%"></td>
													<td width="30%">
														<input name="QryFromDate" value="<?=$QryFromDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="8"> 
														<font color="#3d918a">~</font> 
														<input name="QryToDate" value="<?=$QryToDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
													</td>
													<td width="67%" valign="top">
														<input type='button' class='butt_none' style='width:40' value='1개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='2개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='3개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='4개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='5개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='6개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
														<input type='button' class='butt_none' style='width:40' value='12개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">&nbsp;&nbsp;&nbsp;<input type='image' onfocus='blur();' src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'  align='absmiddle'>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</form>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center>
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					
					<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr height="30" align="center">
						<td width="10%" bgColor="#e7e7e7"><b>번 호</b></td>
						<td width="40%" bgColor="#e7e7e7"><b>상품명</b></td>
						<td width="10%" bgColor="#e7e7e7"><b>판매갯수</b></td>
						<td width="15%" bgColor="#e7e7e7"><b>매출액</b></td>
						<td width="15%" bgColor="#e7e7e7"><b>공급총액</b></td>
						<td width="10%" bgColor="#e7e7e7"><b>수 익</b></td>
					  </tr>
<?
$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

$QryFromDate1 = $QryFromDate."-01";
$QryToDate1 = $QryToDate."-".$to_end_day;

$sql = "select T1.z_price, T1.quantity, T1.item_no from $Order_ProTable T1, $Order_BuyTable T2 where T1.mart_id='$mart_id' and T1.provider_id='$username' and T1.order_num = T2.order_num and T1.status = '3' and ( T2.date >= '$QryFromDate1' and T2.date <= '$QryToDate1')"; //배송완료
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows( $res );
?>
<?
if( $tot == '0' ){
?>
					  <tr align='center' height='30'>
						 <td bgColor='#ffffff' align='center' colspan='6'>판매된 상품이 없습니다</td>
					  </tr>
<?
}
?>
<?
if($cnfPagecount == "") $cnfPagecount = 10;
if($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($tot - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;

if($page % 10 == 0)
	$start_page = $page - 9;
else
	$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;

for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $tot) break;
	mysql_data_seek($res, $i);
	$row = mysql_fetch_array($res);

	$z_price = $row[0];
	$quantity = $row[1];
	$item_no = $row[item_no];

	$sum = $z_price * $quantity;
	
	$item_sql = "select item_name, member_price from $ItemTable where mart_id='$mart_id' and item_no='$item_no'";
	$item_res = mysql_query($item_sql, $dbconn);
	$item_row = mysql_fetch_array($item_res);
	$item_name = $item_row[item_name];
	$member_price = $item_row[member_price];

	$member_price_sum = $member_price * $quantity;

	$sum_str = number_format($sum);
	$member_price_sum_str = number_format($member_price_sum);
	
	$margin = $sum - $member_price_sum ;
	$margin_str = number_format( $margin );

	$j = $tot - $i;
?>
					  <tr align='center' height='25'>
						 <td bgColor='#ffffff'><?=$j?></td>
						 <td bgColor='#ffffff'><b><?=$item_name?><b></td>
						 <td bgColor='#ffffff'><?=$quantity?></td>
						 <td bgColor='#ffffff'><?=$sum_str?></td>
						 <td bgColor='#ffffff'><?=$member_price_sum_str?></td>
						 <td bgColor='#ffffff'><?=$margin_str?></td>
					  </tr>
<?
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </center></div></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="right">
<?
if($page == 1){
?>
				처음
<?
}else{
?>
				<a href='inmall_member_list.php?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>처음</a> 
<?
}
if($start_page > 1){
?>
				<a href='inmall_member_list.php?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>◁</a>&nbsp;
<?
}else{
?>
				◁&nbsp; 
<?
}
for($i=$start_page;$i<=$end_page;$i++){
	if($i == $page){
?>
				[<b><?=$i?></b>]
<?
	}else{
?>
				<a href='inmall_member_list.php?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='inmall_member_list.php?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>▷</a>
<?
}else{
?>
				&nbsp;▷
<?
}
if($page == $total_page){
?>
				끝
<?
}else{
?>
				<a href='inmall_member_list.php?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>끝</a> 
<?
}
?>
				</td>
			</tr>
			<tr height='30'>
				<td><input  onclick="location.href='inmall_cal_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&QryFromDate1=<?=$QryFromDate1?>&QryToDate1=<?=$QryToDate1?>'" class='butt_none' style='width:60' type="button" style='cursor:hand' value="리스트"></td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
			</tr>
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
mysql_close($dbconn);
?>