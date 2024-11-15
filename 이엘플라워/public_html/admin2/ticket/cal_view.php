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
$left_menu = "7";
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
			  <td vAlign="top" width="90%" bgColor="#ffffff">현재 쇼핑몰에 가입한 모든 회원사들에 대한 정산을 기록/관리하는 곳입니다.<br>쿠폰이 회원에게 적립금으로 지급된 경우만 정산에 포함됩니다.</td>
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
					<td colSpan="2">&nbsp;&nbsp;<b>날짜 : <?=$QryFromDate?> ~ <?=$QryToDate?></b>
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
						<td width='10%' bgColor="#e7e7e7">번 호</td>
						<td width='30%' bgColor="#e7e7e7">쿠폰번호</td>
						<td width='15%' bgColor="#e7e7e7">지급액</td>
						<td width='15%' bgColor="#e7e7e7">지급일</td>
						<td width='15%' bgColor="#e7e7e7">받은사람</td>
						<td width='15%' bgColor="#e7e7e7">받은날짜</td>
					  </tr>
<?
$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

//$QryFromDate = str_replace( "-", "", $QryFromDate );
//$QryToDate = str_replace( "-", "", $QryToDate );
//$QryFromDate = $QryFromDate."-01";
//$QryToDate = $QryToDate."-".$to_end_day;

$sql = "select * from $TicketTable where mart_id='$mart_id' and provider_id='$provider_id' and t_ok='y' and ( t_getdate >= '$QryFromDate' and t_getdate <= '$QryToDate') order by t_uid desc";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows( $res );
?>
<?
if( $tot == '0' ){
?>
					  <tr align='center' height='30'>
						 <td bgColor='#ffffff' align='center' colspan='6'>정산 기록이 없습니다</td>
					  </tr>
<?
}
?>
<?
if($cnfPagecount == "") $cnfPagecount = 20;
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

	$t_id = $row[t_id];
	$t_title = $row[t_title];
	$t_money = $row[t_money];
	$t_name = $row[t_name];
	$t_jumin1 = $row[t_jumin1];
	$t_jumin2 = $row[t_jumin2];
	$t_date = $row[t_date];
	$t_getdate = $row[t_getdate];
	$t_regdate = $row[t_regdate];

	$t_getdate_str = substr($t_getdate,0,4)."/".substr($t_getdate,5,2)."/".substr($t_getdate,8,2);
	$t_regdate_str = substr($t_regdate,0,4)."/".substr($t_regdate,5,2)."/".substr($t_regdate,8,2);
	$t_money_str = number_format($t_money);

	$sum = $sum + $t_money;

	//============================== 쿠폰을 받은 회원 정보를 불러옴 ======================
	if( $t_id ){
		$tm_name ="<a href='../member/member_view.php?username=$t_id'><b>$t_name</b></a>";
	}else{
		$tm_name ="<b>$t_name</b>";
	}

	$j = $tot - $i;
?>
					  <tr align='center' height='25' bgColor='#ffffff'>
						 <td><?=$j?></td>
						 <td><?=$t_title?></td>
						 <td><b><?=$t_money_str?></b></td>
						 <td><?=$t_getdate_str?></td>
						 <td><?=$tm_name?></td>
						 <td><?=$t_regdate_str?></td>
					  </tr>
<?
}
?>
					  <tr align='center' height='30' bgColor='#ffffff'>
						 <td colspan='6' align='center'>합 계 : <?=number_format($sum)?>원</td>
					  </tr>
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
				<a href='<?=$PHP_SELF?>?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&provider_id=<?=$provider_id?>'>처음</a> 
<?
}
if($start_page > 1){
?>
				<a href='<?=$PHP_SELF?>?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&provider_id=<?=$provider_id?>'>◁</a>&nbsp;
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
				<a href='<?=$PHP_SELF?>?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&provider_id=<?=$provider_id?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='<?=$PHP_SELF?>?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&provider_id=<?=$provider_id?>'>▷</a>
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
				<a href='<?=$PHP_SELF?>?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&provider_id=<?=$provider_id?>'>끝</a> 
<?
}
?>
				</td>
			</tr>
			<tr height='30'>
				<td><input  onclick="location.href='cal_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>'" class='butt_none' style='width:60' type="button" style='cursor:hand' value="리스트"></td>
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