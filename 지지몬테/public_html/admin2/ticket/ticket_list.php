<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($page == ""){
	$page = 1;
}

if($mode == "search"){
	if( $sort ){
		if( $sort2 ){
			$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort' and m_uid='$sort2'";
		}else{
			$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort'";
		}	
	}else{
		if($select_key == 'provider_id' ){
			$qry = "SELECT count(*) FROM $TicketListTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$input_key%' and (a.tl_ok='신청' or a.tl_ok='승인')";
		}else{
			$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인')";
		}
	}
}else{
	if( $sort ){
		if( $sort2 ){
			$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and b_uid='$sort' and m_uid='$sort2' and (tl_ok='신청' or tl_ok='승인')";
		}else{
			$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and  b_uid='$sort and (tl_ok='신청' or tl_ok='승인')'";
		}	
	}else{
		$qry = "select count(*) from $TicketListTable where mart_id='$mart_id' and (tl_ok='신청' or tl_ok='승인')";
	}
}

$result = mysql_query($qry,$dbconn);
$total = mysql_result($result,0,0);

$line = 40;
$list = 10;
$total_page = ceil($total/$line);
$total_list = intval($total_page/$list);

if($total_page%$list == 0){
	$total_list--;
}

$curr_list = intval($page/$list);

if($page%$list == 0){
	$curr_list--;
}

$start_page = $curr_list*$list+1;
$prev_list = $start_page - $list;
$next_list = $start_page + $list;
$olds = $line*($page-1);

//================================= 정렬방법 =============================================
if( $orderstr == "area" ){
	$orderstr = "b_uid desc, m_uid desc, tl_regdate desc, ";
}else{
	$orderstr = "tl_regdate desc";
}

if($mode == "search"){
	if( $sort ){
		if( $sort2 ){
			$qry = "select * from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort' and m_uid='$sort2' order by $orderstr limit $olds,$line";
		}else{
			$qry = "select * from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort' order by $orderstr limit $olds,$line";
		}	
	}else{
		if($select_key == 'provider_id' ){
			$qry = "SELECT * FROM $TicketListTable AS a LEFT JOIN $MemberTable AS b ON a.provider_id = b.username WHERE b.mart_id='$mart_id' AND b.name LIKE '%$input_key%' and (a.tl_ok='신청' or a.tl_ok='승인') order by a.tl_regdate desc limit $olds,$line";
		}else{
			$qry = "select * from $TicketListTable where mart_id='$mart_id' and $select_key like '%$input_key%' and (tl_ok='신청' or tl_ok='승인') order by $orderstr limit $olds,$line";
		}
	}
}else{
	if( $sort ){
		if( $sort2 ){
			$qry = "select * from $TicketListTable where mart_id='$mart_id' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort' and m_uid='$sort2' order by $orderstr limit $olds,$line";
		}else{
			$qry = "select * from $TicketListTable where mart_id='$mart_id' and (tl_ok='신청' or tl_ok='승인') and b_uid='$sort' order by $orderstr limit $olds,$line";
		}	
	}else{
		$qry = "select * from $TicketListTable where mart_id='$mart_id' and (tl_ok='신청' or tl_ok='승인') order by $orderstr limit $olds,$line";
	}
}
$result = mysql_query($qry,$dbconn);
?>
<?
include "../admin_head.php";
?>
<script>
function del(username){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='<?=$PHP_SELF?>?flag=del&tl_uid='+username;
	}
	else return;
}

function confirm_cancel(num){
	if(confirm("회원사포인트 지급을 취소하시겠습니까?")){
		location.href= 'regist.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&flag=cancel&tl_uid='+num;
	}
	else return;
}

function confirm_ok(num){
	if(confirm("회원사포인트 지급을 승인하시겠습니까?")){
		location.href= 'regist.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&flag=ok&tl_uid='+num;
	}
	else return;
}

function check(){
	if(f.input_key.value == ''){
		alert("검색어를 입력하세요.");
		return false;
	}
	f.submit();
}
function opensub(t,w,h){	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h){	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}

//===== 1차 카테고리별 정렬 ======
function sort(cd){
	location.href="<?=$PHP_SELF?>?sort="+cd;
}

//===== 2차 카테고리별 정렬 ======
<?
if( $sort ){
?>
function sort2(cd,cd2){
	location.href="<?=$PHP_SELF?>?sort="+cd+"&sort2="+cd2;
}
<?
}else{
?>
function sort2(cd2){
	location.href="<?=$PHP_SELF?>?sort2="+cd2;
}
<?
}
?>

function toggle(val){//전체선택, 전체해제
	dl = document.allform;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}

//////////////   print_form 스크립터   //////////////
function printWindow(Type,Check){
	if (Check == 1){
		IEPrint.left	= 0;
		IEPrint.right	= 0;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}else{
		IEPrint.left	= 5;
		IEPrint.right	= 5;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}

	IEPrint.header		= "회원사포인트 리스트";
	IEPrint.footer		= "회원사포인트 리스트";
	IEPrint.printbg		= true;		// 이전버전과 달리 true, false로 설정한다.
	IEPrint.landscape	= true;		// 가로 출력을 원하시면 true / 세로출력은 false	
	IEPrint.print();				// 위에 설정한 값을 실제 적용하고, 프린트다이얼로그를 띄웁니다.
}

function printDiv(type,check){
	if (document.all && window.print)
	{
		window.onbeforeprint	= beforeDivs;
		window.onafterprint		= afterDivs;
		printWindow(type,check);
	}
}
function beforeDivs () {
  if (document.all) {
    objContents.style.display = 'none';
    objSelection.innerHTML = document.all['d1'].innerHTML;
  }
}
function afterDivs () {
  if (document.all) {
    objContents.style.display = 'block';
    objSelection.innerHTML = "";
  }
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<OBJECT ID="IEPrint" style="display:none" CLASSID="CLSID:F290B058-CB26-460E-B3D4-8F36AEEDBE44" 
codebase="../cab/IEPrint.cab#version=1,0,0,7"></OBJECT>
<DIV ID="objContents">
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
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원사포인트 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
		<span id="d1">
		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">현재 쇼핑몰에 가입한 모든 회원사들에 대한 회원사포인트를 기록/관리하는 곳입니다.</td>
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
				 <tr height="40">
					<td><p align="center"><b>[회원사포인트 리스트]</b></td>
					<td colspan='2' align='right'></td>
				 </tr>
				 <tr height="20">
					<form name="f" method="post" action="<?=$PHP_SELF?>?mode=search" onsubmit="check(); return false;">
					<input type='hidden' name='sort' value='<?=$sort?>'>
					<input type='hidden' name='sort2' value='<?=$sort2?>'>
					<input type='hidden' name='sort3' value='<?=$sort3?>'>
					<td width="30%"><b>&nbsp;&nbsp; 현재 
					: 총 <font color="#ff0000"><?=$total?></font></b>건</td>
					<td width='20%'><input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="회원사포인트등록" onclick="location.href='ticket_insert.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'"></td>
					<td width="50%" align="right">
						<select name="select_key" size="1">
							<option value="provider_id" <?if($select_key == "provider_id") echo " selected";?>>회원사명</option>
							<option value="tl_money" <?if($select_key == "tl_money") echo " selected";?>>포인트 금액</option>
							<option value="tl_regdate" <?if($select_key == "tl_regdate") echo " selected";?>>포인트신청일</option>
							<option value="tl_getdate" <?if($select_key == "tl_getdate") echo " selected";?>>포인트지급일</option>
							<option value="tl_ok" <?if($select_key == "tl_ok") echo " selected";?>>상 태</option>
						</select> 
						<input name='input_key' value='<?=$input_key?>' class="input_03" size="15"> &nbsp; 
						<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="취소" onclick="location.href='<?=$PHP_SELF?>'">
					</td>
				 </tr>
				 </form>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="99%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#E1E1E1" align="center">
					<form name='allform' method='post' action='ticket_regist.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&flag=ok'>
					<tr align="middle" bgColor="#cccccc" height="30">
						<td width="6%"><b>No</b></td>
						<td width="4%"><b>선택</b></td>
						<td width="15%"><b>회원사</b></td>
						<td width="15%"><b>포인트 금액</b></td>
						<td width="25%"><b>내 역</b></td>
						<td width="14%"><b>포인트 신청일</b></td>
						<td width="14%"><b>포인트 지급일</b></td>
						<td width="7%"><b>상 태</b></td>
					  </tr>
<?
if( $total == 0 ){
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td colspan='8'><b>회원사포인트 기록이 없습니다.</b></td>
					  </tr>
<?
}
?>
<?
$i = 0;
while( $ary = mysql_fetch_array($result) ){
	$id = $total - ($olds + $i);
	$i++;

	$provider_id = $ary[provider_id];
	$tl_uid = $ary[tl_uid];
	$tl_money = $ary[tl_money];
	$tl_content  = $ary[tl_content];
	$tl_regdate = $ary[tl_regdate];
	$tl_getdate = $ary[tl_getdate];
	$tl_ok = $ary[tl_ok];
	
	$tl_regdate = substr( $tl_regdate, 0, 10 );
	$tl_getdate = substr( $tl_getdate, 0, 10 );

	$sum_str = number_format($tl_money);

	//============================== 회원사 정보를 불러옴 ================================
	$m_sql = "select name from $MemberTable where username='$provider_id' and mart_id='$mart_id'";
	$m_res = mysql_query($m_sql, $dbconn);
	$m_row = mysql_fetch_array($m_res);
	$member_name = $m_row[name];
?>
					  <tr align='center' height="25" bgColor='#ffffff'>
						 <td><?=$id?></td>
						 <td><input name='checkSel[]' type='checkbox' value='<?=$tl_uid?>'></td>
						 <td><a href='ticket_view.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&tl_uid=<?=$tl_uid?>&QryFromDate1=<?=$QryFromDate1?>&QryToDate1=<?=$QryToDate1?>'><b><?=$member_name?></b></a></td>
						 <td><a href='ticket_view.php?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&tl_uid=<?=$tl_uid?>&QryFromDate1=<?=$QryFromDate1?>&QryToDate1=<?=$QryToDate1?>'><b><?=$sum_str?></b></a></td>
						 <td><?=$tl_content?></td>
						 <td><?=$tl_regdate?></td>
						 <td><?=$tl_getdate?></td>
						 <td><?=$tl_ok?></td>
					  </tr>
<?
}
if( $result ){
	mysql_free_result( $result );
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td width="100%" bgColor="#ffffff">
<!----------------------------------- 페이징 시작 --------------------------------------->
<? 
if($prev_list <= 0){ 
?>
				처음
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$prev_list?>&sort=<?=$sort?>&sort2=<?=$sort2?>">처음</a>
<? 
} 
?>
<? 
if($page-1 <= 0){ 
?>
				◁
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page-1?>&sort=<?=$sort?>&sort2=<?=$sort2?>">◁</a>
<? 
} 
?>
				&nbsp;
<? 
for($i=$start_page;$i<$start_page+$list;$i++){ 
?>
<? 
	if($i == $page){ 
?>
				<b><?=$i?></b>
<? 
	}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$i?>&sort=<?=$sort?>&sort2=<?=$sort2?>"><?=$i?></a>
<? 
	} 
?>
				&nbsp;
<?
	if($i>=$total_page)
	break
?>
<? 
} 
?>
<? 
if($page+1 > $total_page){ 
?>
				▷
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page+1?>&sort=<?=$sort?>&sort2=<?=$sort2?>">▷</a>
<? 
} 
?>
<? 
if($next_list>$total_page){ 
?>
				끝
<? 
}else{ 
?>
				<a href="<?=$PHP_SELF?>?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$next_list?>&sort=<?=$sort?>&sort2=<?=$sort2?>">끝</a>
<? 
} 
?>
<!----------------------------------- 페이징 끝 ----------------------------------------->
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input onclick="javascript:toggle(1)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="전체선택">&nbsp;<input onclick="javascript:toggle(0)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" type="button" value="선택해제">&nbsp;<input type="submit" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #3D918A 1px solid; BORDER-LEFT:  #3D918A 1px solid; BORDER-RIGHT: #3D918A 1px solid; BORDER-TOP: #3D918A 1px solid; COLOR:#3D918A;  HEIGHT: 18px" value="회원사포인트승인">&nbsp;&nbsp;
				<input onclick="printDiv('false','');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="프린트">
				</td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
			</tr>
		 </form>
		 </table>
		 </span>
<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</DIV>
<DIV ID="objSelection">

</DIV>
</body>
</html>
<?
mysql_close($dbconn);
?>