<?
include "../lib/Mall_Admin_Session.php";
?>
<?
include "../stat/cal.php";

if($page == ""){
	$page = 1;
}

if( $QryFromDate ){
	$QryFromDate = substr($QryFromDate,0,7);
}else{
	$QryFromDate = date("Y-m");
}
if( $QryToDate ){
	$QryToDate = substr($QryToDate,0,7);
}else{
	$QryToDate = date("Y-m");
}

if($QryMonth == '') $QryMonth = date("Y-m");

$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

$QryFromDate = $QryFromDate."-01";
$QryToDate = $QryToDate."-".$to_end_day;
?>
<?
if($flag=="del"){
	$SQL = "delete from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag=="member_confirm"){
	$SQL = "update $MemberTable set is_member='$is_member' where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
include "../admin_head.php";
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

function checkform(){
	var frm = document.form1;
	var Digit = '1234567890'
	
	if (frm.QryFromDate.value==""){
		alert("시작월을 입력하세요");
		frm.QryFromDate.focus();
		return false;
	}

	if (frm.QryToDate.value==""){
		alert("종료월을 입력하세요");
		frm.QryToDate.focus();
		return false;
	}

	if (frm.QryMonth.value==""){
		alert("해당월을 입력하세요");
		frm.QryMonth.focus();
		return false;
	}

	return true;
}
</script>
<script>
function del(username){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='<?=$PHP_SELF?>?flag=del&username='+username;
	}
	else return;
}

function confirm_cancel(num){
	if(confirm("쿠폰 지급을 취소하시겠습니까?")){
		location.href= 'regist.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=cancel&t_uid='+num;
	}
	else return;
}

function confirm_ok(num){
	if(confirm("쿠폰 지급을 승인하시겠습니까?")){
		location.href= 'regist.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=ok&t_uid='+num;
	}
	else return;
}

function check(keyset, searchword){
	if(keyset == '' || searchword == ''){
		alert("먼저 검색을 하세요.");
		return false;
	}
	else{
		window.location.href='mail_send.php?keyset='+keyset+'&searchword='+searchword;
		return true;
	}
}
function opensub(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>쿠폰 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="97%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">
				쿠폰을 관리 하는 곳입니다.<br>
				발행 회원사를 클릭하시면 회원사 상세 정보를 볼 수 있습니다.<br>
				쿠폰명을 클릭하시면 쿠폰에 대한 상세 정보를 볼 수 있습니다.<br>
				이름을 클릭하시면 쿠폰을 받은 회원에 대한 상세 정보를 볼 수 있습니다.<br>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" bgColor="#ffffff"></td>
			</tr>
			<tr>
			  <td vAlign="top" bgColor="#808080" height="1"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
			  <table width="100%" border="0" align="center">
				 <tr>
					<td width="100%" colspan="2" height="20"><p align="center"><b>[쿠폰 
					리스트]</b></td>
				 </tr>
<?
if($order == '') $order = 't_regdate';
if($orderby == '') $orderby = 'desc';

$SQL = "select * from $TicketTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$total = mysql_num_rows($dbresult);
?>
				  <form action='<?=$PHP_SELF?>?mode=search' method="POST">
				  <input type='hidden' name='page' value=''>
				  <input type='hidden' name='keyset' value='<?=$keyset?>'>
				  <tr height="20">
					<td width="25%"><b>&nbsp;&nbsp; 현재 
					쿠폰발행수 : 총 <font color="#ff0000"><?=$total?></font></b></td>
					<!-- <td width='25%'><input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="쿠폰추가" onclick="location.href='insert.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'"> --></td>
					<td width="50%" align="right">
						<select name="keyset" size="1">
							<option value="provider_id" <?if($keyset == "provider_id") echo " selected";?>>회원사명</option>
							<option value="t_title" <?if($keyset == "t_title") echo " selected";?>>쿠폰명</option>
							<option value="t_name" <?if($keyset == "t_name") echo " selected";?>>이름</option>
							<option value="t_ok" <?if($keyset == "t_ok") echo " selected";?>>확인</option>
						</select> 
						<input type='text' name="searchword" value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="취소" onclick="location.href='<?=$PHP_SELF?>'"></td>
				 </tr>
				 </form>
				 <tr height='28'>
				 <form id='form1' action='<?=$PHP_SELF?>' name='form1' method='post' onsubmit='checkform(); return false'>
				 <input type="hidden" name="out_form" value="months">
					<td>
						&nbsp;&nbsp; <b>기간별 검색</b>
					</td>
					<td colspan='2'>
						<input name="QryFromDate" value="<?=$QryFromDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="8"> 
						<font color="#3d918a">~</font> 
						<input name="QryToDate" value="<?=$QryToDate?>" class="bb" style="BORDER-RIGHT: #6b6b6b 1px solid; BORDER-TOP: #6b6b6b 1px solid; BORDER-LEFT: #6b6b6b 1px solid; width: 67px; BORDER-BOTTOM: #6b6b6b 1px solid" size="7">
						<input type='button' class='butt_none' style='width:40' value='1개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='2개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='3개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='4개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='5개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='6개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
						<input type='button' class='butt_none' style='width:40' value='12개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">&nbsp;&nbsp;&nbsp;<input type='image' onfocus='blur();' src="../images/ggo.gif" border="0" width="39" height="18" style='cursor:hand'  align='absmiddle'>
					</td>
				</form>
				</tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#E1E1E1" align="center">
					<tr height="28" bgColor="#cccccc" align="center">
						<td width="7%">No</td>
						<td width="17%">발행회원사</td>
						<td width="18%">쿠폰명</td>
						<td width="10%">이 름</td>
						<td width="15%">유효기간</td>
						<td width="10%">확인</td>
						<td width="12%">등록일</td>
						<td width="11%">쿠폰상태</td>
					  </tr>
<?
if($order == 'name'){
	$binary_str = 'binary';
}else{
	$order = 't_regdate';
	$orderby = ' desc';
	$binary_str = '';
}

if( ($keyset == "t_ok") && ($searchword == "받음") ){
	$searchword = "y";
}else if( ($keyset == "t_ok") && ($searchword == "안받음") ){
	$searchword = "n";
}

if($mode == "search"){
	if( $keyset == "provider_id" ){
		$SQL = "SELECT * FROM $TicketTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$searchword%' order by a.t_regdate desc";
	}else{
		$SQL = "select * from $TicketTable where mart_id='$mart_id' and $keyset like '%$searchword%' order by $binary_str $order $orderby";
	}
}else{
	$SQL = "select * from $TicketTable where mart_id='$mart_id' order by $binary_str $order $orderby";
}

if( $out_form == months ){
	$SQL = "select * from $TicketTable where mart_id='$mart_id' and ( t_regdate >= '$QryFromDate' and t_regdate <= '$QryToDate') order by $binary_str $order $orderby";
}

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($cnfPagecount == "") $cnfPagecount = 20;
if($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
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
?>
<?
if( $numRows == 0 ){
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td colspan='8'><b>발급된 쿠폰이 없습니다.</b></td>
					  </tr>
<?
}
?>
<?
for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);

	$t_uid  = $ary[t_uid ];
	$provider_id = $ary[provider_id];
	$t_title = $ary[t_title];
	$t_id  = $ary[t_id ];
	$t_name = $ary[t_name];
	$t_jumin1 = $ary[t_jumin1];
	$t_date = $ary[t_date];
	$t_regdate = $ary[t_regdate];
	$t_ok = $ary[t_ok];
	$t_yes = $ary[t_yes];

	if( $t_ok == "y" ){
		$t_ok_str = "<font color='#33A6B3'>받음</font>";
	}else{
		$t_ok_str = "<font color='red'>안받음</font>";
	}
	/*if( $t_yes == 'y' && $t_ok == 'n' ){
		$t_yes_str = "<input type='button' value='쿠폰승인' class='input' onclick='confirm_cancel($t_uid)'>";
	}else if( $t_yes == 'y' && $t_ok == 'y' ){
		$t_yes_str = "<input type='button' value='쿠폰승인' class='input' onclick=\"window.alert('적립금을 지급받았기 때문에 취소할 수 없습니다')\";>";
	}else{
		$t_yes_str = "<input type='button' value='쿠폰취소' class='input' onclick='confirm_ok($t_uid)'>";
	}*/
	if( $t_yes == 'y' && $t_ok == 'n' ){
		$t_yes_str = "쿠폰승인";
	}else if( $t_yes == 'y' && $t_ok == 'y' ){
		$t_yes_str = "쿠폰승인";
	}else{
		$t_yes_str = "쿠폰취소";
	}

	$t_regdate_str = substr($t_regdate,0,4)."/".substr($t_regdate,5,2)."/".substr($t_regdate,8,2);

	$j = $numRows - $i;

	//============================== 회원사 정보를 불러옴 ================================
	$m_sql = "select name from $MemberTable where username='$provider_id' and mart_id='$mart_id'";
	$m_res = mysql_query($m_sql, $dbconn);
	$m_row = mysql_fetch_array($m_res);
	$member_name = $m_row[name];
	//============================== 쿠폰을 받은 회원 정보를 불러옴 ======================
	if( $t_id ){
		$tm_name ="<a href='../member/member_view.php?username=$t_id'><b>$t_name</b></a>";
	}else{
		$tm_name ="<b>$t_name</b>";
	}
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td><?=$j?></td>
						 <td><a href='../inmember/inmember_member_view.php?username=<?=$provider_id?>'><b><?=$member_name?></b></a></td>
						 <td align='left'> <a href='view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&t_uid=<?=$t_uid?>'><b><?=$t_title?></b></a></td>
						 <td><?=$tm_name?></td>
						 <td><?=$t_date?></td>
						 <td><?=$t_ok_str?></td>
						 <td><?=$t_regdate_str?></td>
						 <td><?=$t_yes_str?></td>
					  </tr>
<?
}
if( $m_res ){
	mysql_free_result( $m_res );
}
if( $dbresult ){
	mysql_free_result( $dbresult );
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
<?
if($page == 1){
?>
				처음
<?
}else{
?>
				<a href='<?=$PHP_SELF?>?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>처음</a> 
<?
}
if($start_page > 1){
?>
				<a href='<?=$PHP_SELF?>?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>◁</a>&nbsp;
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
				<a href='<?=$PHP_SELF?>?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='<?=$PHP_SELF?>?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>▷</a>
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
				<a href='<?=$PHP_SELF?>?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>끝</a> 
<?
}
?>
				</td>
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