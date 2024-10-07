<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	

/*SMS $SQL = "select * from $Sms_ConfigTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$sms_user = $ary[sms_user];
	$sms_passwd = $ary[sms_passwd];
	$mart_name = $ary[mart_name];
	$callback_num1 = $ary[callback_num1];
	$callback_num2 = $ary[callback_num2];
	$callback_num3 = $ary[callback_num3];
	$admin_num1 = $ary[admin_num1];
	$admin_num2 = $ary[admin_num2];
	$admin_num3 = $ary[admin_num3];
	$if_money_chk_msg = $ary[if_money_chk_msg];
	$money_chk_msg = $ary[money_chk_msg];
	$if_product_send_msg = $ary[if_product_send_msg];
	$product_send_msg = $ary[product_send_msg];
	$if_order_cancel_msg = $ary[if_order_cancel_msg];
	$order_cancel_msg = $ary[order_cancel_msg];
	$if_order_cancel_msg_admin = $ary[if_order_cancel_msg_admin];
	$order_cancel_msg_admin = $ary[order_cancel_msg_admin];
}*/

if($update_flag == ''){
	$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$if_provider = mysql_result($dbresult, 0, "if_provider");
		
	$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$if_gnt_item = $ary[if_gnt_item];
	}

	if($icash_id !=''){
		$method = "<a href='http://txdman.icash.co.kr' target='_new'>[ICASH 카드결제현황]</a>";
	}
	if($telec_id !=''){
		$method = "<a href='http://www.ebizpro.co.kr' target='_new'' target='_new'>[TELEC 카드결제현황]</a>";
	}
	if($prepay_id !=''){
		$method = "<a href='https://pg.pre-pay.co.kr:4002/login.htm' target='_new'>[PREPAY 카드결제현황]</a>";
	}
	if($allthegate_id !=''){
		$method = "<a href='http://www.allthegate.com/login/r_login.jsp' target='_new'>[ALLTHEGATE 카드결제현황]</a>";
	}
	if($tgcorp_id !=''){
		$method = "<a href='https://npg.tgcorp.com/mdbop/login.jsp' target='_new'>[TGCORP 카드결제현황]</a>";
	}
	if($if_provider == 1 || $if_gnt_item == 1){
		$method = "<a href='order_gnt.php'>[GNT주문현황]</a>";
	}

	$method = "<a href='http://admin.kcp.co.kr/' target='_new'>[KCP 카드결제현황]</a>";
	
	$today = date("Ymd");
	include "../admin_head.php";
	include "../stat/cal.php";

	if( $QryFromDate ){
		$QryFromDate = substr($QryFromDate,0,10);
	}else{
		$QryFromDate = date("Y-m-d");
	}
	if( $QryToDate ){
		$QryToDate = substr($QryToDate,0,10);
	}else{
		$QryToDate = date("Y-m-d");
	}

	if($QryMonth == '') $QryMonth = date("Y-m");
?>
<script>
function goTo(f){
	f.submit();
}
function go_today(){
	window.location.href='order_new2.php?today=<?=$today?>&flag=today';
}
function checkform(f){
	if(f.searchword.value==""){
		alert("검색어를 입력하세요.");
		f.searchword.focus();
		return false;
	}
	return true;
}

function fn_betdate(objname1, objname2, difvalue){	//'기준날짜를 기준으로 이후 날짜 가져오기
	obj1 = MM_findObj(objname1,document,form1);
	obj2 = MM_findObj(objname2,document,form1);
	var datD = new Date(<?=date("Y")?>,<?=date("m")?>-1,<?=date("d")?>);
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
	strTemp = strTemp + fn_numformat((datD.getMonth() + 1),2) + "-";
	strTemp = strTemp + fn_numformat(datD.getDate(),2);
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
function toggle(val) {
	dl = document.list;

    for (i = 0; i < dl.elements.length; i++) {
      if (dl.elements[i].name == 'checkSel[]')
        dl.elements[i].checked = val;
    }
}
function add_list_print(){
	dl = document.list;
	dl.update_flag.value='add_list_print'
	dl.submit();
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>주문관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top">
					주문번호를 클릭하시면 주문에 대한 상세내역과 수정가능한 페이지로 이동합니다.<br>
					주문검색은 오늘, 3일, 일주일 단위로 검색가능하며, 조회기간을 따로이 입력하여 검색하실수도 있습니다.<br>
					<font color='#6C6FFA'>결제방법은 쇼핑몰고객의 결제수단을 나타내는 것입니다.<br>
					신용카드로 결제했을 경우, 신용카드 실패로 나오더라도 꼭 카드결제 관리자모드로 접속하셔서 확인하시기 바랍니다.</font><br>
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#FFFFFF" height="3" align="center">
					<b><a href='order_new2.php'>[전체주문현황]</a> <?=$method?></b>
				</td>
				</tr>

				<form action='order_new2.php' id='form1' name='form1' method='post'>
				<input type='hidden' name='flag' value='find'>
				<input type='hidden' name='cnfPagecount' value='<?=$cnfPagecount?>'>
<?
if($QryFromDate == '') $QryFromDate = date("Y-m-d");
if($QryToDate == '') $QryToDate = date("Y-m-d");
if($QryMonth == '') $QryMonth = date("Y-m");
?>
				<tr>
				<td valign="top" width="100%" bgColor="#ffffff" height="3" align="center">
						<table border="0" width="95%" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<table cellSpacing="0" cellPadding="0" width="100%" border="0">
								<tr>
								<td width="100%" bgColor="#cccccc">
									<table cellSpacing="1" cellPadding="3" width="100%" border="0">
									<tr>
									<td width="100%" bgColor="#f7f7f7" height="20">
										<table cellSpacing="0" cellPadding="0" width="100%" border="0">
										<tr>
											<td width="13%">&nbsp; 조회기간</td>
											<td width="26%">
												<input name="QryFromDate" value="<?=$QryFromDate?>" class="input_03" size="16"> 
												<font color="#3D918A">~</font>
												<input name="QryToDate" value="<?=$QryToDate?>" class="input_03" size="16">
											</td>
											<td width="33%">
												<input type='button' class='butt_none' style='width:40' value='1개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:1')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='2개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:2')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='3개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:3')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='4개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:4')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='5개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:5')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='6개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:6')">&nbsp; 
												<input type='button' class='butt_none' style='width:40' value='12개월' onclick="fn_betdate('QryFromDate', 'QryToDate', 'M:12')">
											</td>
										</tr>
										<tr height="10">
											<td width="13%"></td>
											<td width="26%"></td>
											<td width="33%"></td>
										 </tr>
										 <tr>
											<td width="13%">&nbsp; 진행처리</td>
											<td width="59%" colspan="2">
												<select name="status_flag" style="BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-BOTTOM: black 1px solid; height: 18px" size="1">
												<option selected value="">전체</option>
												<option value="1" <?if($status_flag == 1) echo " selected";?>>주문</option>
												<option value="5" <?if($status_flag == 5) echo " selected";?>>주문취소</option>
												<option value="2" <?if($status_flag == 2) echo " selected";?>>입금확인</option>
												<option value="6" <?if($status_flag == 6) echo " selected";?>>배송중</option>
												<option value="3" <?if($status_flag == 3) echo " selected";?>>배송완료</option>
												<option value="7" <?if($status_flag == 7) echo " selected";?>>교환</option>
												<option value="11" <?if($status_flag == 11) echo " selected";?>>맞교환</option>
												<option value="12" <?if($status_flag == 12) echo " selected";?>>대기</option>
												<option value="4" <?if($status_flag == 4) echo " selected";?>>환불</option>
												<option value="10" <?if($status_flag == 4) echo " selected";?>>결제취소</option>
												</select>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
												<input type='image' src="../images/ggo.gif" border="0" width="39" height="18">
												<a href='../to_excel/order_list.php?flag=<?=$flag?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>'><img src='../images/excel.gif' align='bottom' border='0' width='84' height='18'></a>
											</td>
										 </tr>
										</table>
									</td>
									</tr>
								</table>
								</td>
								</tr>
								</table>
							</td>
						</tr>
						</form>
						</table>

						<table border="0" width="100%" height="10" cellspacing="0" cellpadding="0">
						<tr>
							<td width="100%"></td>
							</tr>

							<form action='order_new2.php' method=post>
							<input type=hidden name='flag' value='<?=$flag?>'>
							<input type='hidden' name='keyset' value='<?=$keyset?>'>
							<input type='hidden' name='searchword' value='<?=$searchword?>'>
							<input type=hidden name='QryFromDate' value='<?=$QryFromDate?>'>
							<input type=hidden name='QryToDate' value='<?=$QryToDate?>'>
							<input type=hidden name='page' value=''>

							<tr>
							<td width="100%" align="right"><b><!-- *입금확인시 SMS 발송은 주문상세페이지에서만 이루어 집니다. --></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<select name="cnfPagecount" onchange="goTo(this.form)" style="background-color: #FECB8E; border-left: 1px dotted rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0)" size="1">
								<option value="" <?if($cnfPagecount == '') echo " selected";?>>정렬갯수</option>
								<option value="10" <?if($cnfPagecount == '10') echo " selected";?>>10</option>
								<option value="15" <?if($cnfPagecount == '15') echo " selected";?>>15</option>
								<option value="20" <?if($cnfPagecount == '20') echo " selected";?>>20</option>
								<option value="25" <?if($cnfPagecount == '25') echo " selected";?>>25</option>
								<option value="30" <?if($cnfPagecount == '30') echo " selected";?>>30</option>
								</select>&nbsp;&nbsp;&nbsp; </td>
							</tr>
							<tr>
							<td width="100%"></td>
							</tr>
						</table>
						</td>
						</tr>
					</form>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="7">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											
											<form action='order_new2.php' method='post' onsubmit='return checkform(this)'>
											<input type='hidden' name='flag' value='search'>
											<input type='hidden' name='page' value=''>
											<input type=hidden name='cnfPagecount' value='<?=$cnfPagecount?>'>

											<tr>
											<td width="50%">&nbsp; 
												<font color='#ffffff'>날짜검색시 입력예: 20031212</font>
											</td>
											<td width="50%" align="right">
												<select name="keyset" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
												<option value="name" <?if($keyset == 'name') echo "selected";?>>주문자</option>
												<option value="money_sender" <?if($keyset == 'money_sender') echo "selected";?>>입금자</option>
												<option value="receiver" <?if($keyset == 'receiver') echo "selected";?>>수취인</option>
												<option value="date" <?if($keyset == 'date') echo "selected";?>>날짜</option>
												<option value="item_name" <?if($keyset == 'item_name') echo "selected";?>>상품명</option>
												<option value="order_num" <?if($keyset == 'order_num') echo "selected";?>>주문번호</option>
												<option value="tel" <?if($keyset == 'tel') echo "selected";?>>전화번호</option>
												<option value="email" <?if($keyset == 'email') echo "selected";?>>이메일</option>
												</select>
												&nbsp; 
												<input name="searchword" value='<?=$searchword?>' size="13" class="input_03"> &nbsp; 
												<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" type="submit" value="검색"> <input type='button' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" style='cusor:hand' onclick="location.href='<?=$PHP_SELF?>'" value="취소">&nbsp;
											</td>
											</tr>
											</form>
										
										</table>
									</td>
								</tr>

								<form name='list' action='order_new2.php' method='post'>
								<input type='hidden' name='update_flag' value='update'>
								<input type='hidden' name='page' value='<?=$page?>'>
								<input type='hidden' name='keyset' value='<?=$keyset?>'>
								<input type='hidden' name='searchword' value='<?=$searchword?>'>
								<input type='hidden' name='flag' value='<?=$flag?>'>
								<input type='hidden' name='cnfPagecount' value='<?=$cnfPagecount?>'>
								<input type='hidden' name='QryFromDate' value='<?=$QryFromDate?>'>
								<input type='hidden' name='QryToDate' value='<?=$QryToDate?>'>
								<input type='hidden' name='status_flag' value='<?=$status_flag?>'>
								
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center">번호</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">주문번호</td>
									<td width="10%" bgcolor="#FFFFFF" align="center">이름</td>
									<td width="16%" bgcolor="#FFFFFF" align="center">날짜</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">총결제액</td>
									<td width="14%" bgcolor="#FFFFFF" align="center">진행상태</td>
									<td width="24%" bgcolor="#FFFFFF" align="center">결제방법</td>
								</tr>
<?
//$from_end_day = how_many_days(substr($QryFromDate,0,4), substr($QryFromDate,5,2));
//$to_end_day = how_many_days(substr($QryToDate,0,4), substr($QryToDate,5,2));

//$QryFromDate1 = $QryFromDate."-01";
//$QryToDate1 = $QryToDate."-".$to_end_day;

if(!empty($status_flag)) $status_str = " and status='$status_flag' ";
else $status_str = '';

if($status_flag == 2){
	$order_by = "order by payment_date";
}else{
	$order_by = "order by date";
}

if($flag == "today"){
	$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str and date like '$today%' $order_by desc";
}else if($flag == "search"){
	if($keyset == 'item_name'){
		$SQL = "select DISTINCT T1.* from $Order_BuyTable T1, $Order_ProTable T2 where T1.mart_id='$mart_id' and T1.status != '9' $status_str and T1.order_num=T2.order_num and binary T2.item_name like '%$searchword%' $order_by desc";
	}else if($keyset == 'name'){
		$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str and  binary name like '%$searchword%' $order_by desc";
	}else if($keyset == 'tel'){
		$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str and  (binary tel1 like '%$searchword%' or binary tel2 like '%$searchword%') $order_by desc";
	}else{
		$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str and binary $keyset like '%$searchword%' $order_by desc";
	}
}else if($flag == 'find'){
	$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str and ( date >= '$QryFromDate' and left(date,10) <= '$QryToDate') $order_by desc";
}else{
	$SQL = "select * from $Order_BuyTable where mart_id='$mart_id' and status != '9' $status_str $order_by desc";
}			

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 20;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;
$total_page = ($numRows - 1)/$cnfPagecount;
$total_page=intval($total_page)+1;	

$prev_page = $page - 1;
$next_page = $page + 1;

for ($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++) {	
	if ($i >= $numRows) break;	
	mysql_data_seek($dbresult, $i);	
	$ary=mysql_fetch_array($dbresult);	
	$name = $ary[name];
	$order_num = $ary[order_num];
	
	$mon_tot = number_format($ary[mon_tot]);
	$freight_fee = $ary[freight_fee];
	$paymethod = $ary[paymethod];
	$card_paid = $ary[card_paid];
	$if_use_bonus = $ary[if_use_bonus];
	$use_bonus_tot = $ary[use_bonus_tot];
	$account_no = $ary[account_no];

	//====================== 결제방법 정보 ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$pay_sql = "select * from $BankTable where mart_id='$mart_id' and account_no='$account_no'";
		$pay_res = mysql_query($pay_sql, $dbconn);
		$pay_row = mysql_fetch_array($pay_res);
		$account_no = $pay_row[account_no];
		$bank_name = $pay_row[bank_name];
		$bank_number = $pay_row[bank_number];
		$owner_name = $pay_row[owner_name];
	}

	if($paymethod == 'bycard'){
		if($card_paid == 't')
			$paystr = "카드결제";
		elseif($card_paid == 'f')
			$paystr = "카드결제실패";
	}
	if($paymethod == 'byaccount'){
		$paystr = "계좌이체";
	}
	if($paymethod== 'bycard_point'){
		$paystr = "카드결제 + 포인트결제";
	}	
	if($paymethod== 'byaccount_point'){
		$paystr = "계좌이체 + 포인트결제";
	}
	//====================== 온라인 입금시 계좌 정보 =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금";
		}else{
			$account_str ="";
			$paystr = "온라인입금";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금+포인트결제";
		}else{
			$account_str ="";
			$paystr = "온라인입금+포인트결제";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "포인트결제";
	}
	/*
	if( ($if_use_bonus == 1 ) && ($use_bonus_tot > 0) ){		
		if( !empty($paymethod_str) ){
			$paymethod_str = $paymethod_str."+포인트";
		}else{
			$paymethod_str = "포인트";
		}
	}*/

	$status_temp = $ary[status];
	$j = $numRows - $i;
	$date = str_replace("-","",$ary[date]);
	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);						
	
	$item_detail_head = "
							<tr>
								<td align='middle' width='98%' bgColor='#F3F3F3' colspan='7'>
								<table border='0' width='100%'>
									<tr>
	";
	$item_detail_body = "";
	$item_detail_tail = "
									</tr>
								 </table>
								 </td>
							  </tr>
	";
												
	$SQL1 = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	$mon_tot = 0;
	for ($k=0; $k<$numRows1; $k++) {
		mysql_data_seek($dbresult1,$k);
		$ary1 = mysql_fetch_array($dbresult1);
		$order_pro_no = $ary1[order_pro_no];
		$item_name = $ary1[item_name]; 
		$item_code = $ary1[item_code]; 
		$z_price = $ary1[z_price];
		$bonus = $ary1[bonus];
		$use_bonus = $ary1[use_bonus];
		$good_status = $ary1[status];
		$quantity = $ary1[quantity];
		$sum = $z_price*$quantity;

		if($good_status == 1){
			$good_status_str = "주문";
		}else if($good_status == 2){
			$good_status_str = "입금확인";
		}else if($good_status == 3){
			$good_status_str = "배송완료";
		}else if($good_status == 4){
			$good_status_str = "환불";
		}else if($good_status == 5){
			$good_status_str = "주문취소";
		}else if($good_status == 6){
			$good_status_str = "배송중";
		}else if($good_status == 7){
			$good_status_str = "교환";
		}else if($good_status == 10){
			$good_status_str = "결제취소";
		}else if($good_status == 11){
			$good_status_str = "맞교환";
		}else if($good_status == 12){
			$good_status_str = "대기";
		}
		
		$mon_tot += $sum; //합계금액
	
		if($item_code != '') $item_code_str = "($item_code)";
		else $item_code_str = "";
		$item_detail_body .= "<td width='50%'><img src='../images/dot.gif' width='5' height='7'>$item_name $item_code_str : $quantity [$good_status_str]</td>";
		
		if($k%2 == 1) $item_detail_body .= "</tr><tr>";
	}
	$mon_tot_str = number_format($mon_tot);
	if($k > 0)
	$item_detail_str = $item_detail_head.$item_detail_body.$item_detail_tail;
	else $item_detail_str = $item_detail_head.$item_detail_tail;
	
	if($freight_fee == ''){
		if($mon_tot >= $freight_limit){
			$freight_fee = 0;
		}else{
			$freight_fee = $freight_cost;
		}
	}
	$mon_tot_freight = $mon_tot + $freight_fee;
	
	$mon_tot_freight_str = number_format($mon_tot_freight);

	if($status_temp == 1){
		$status_temp_str = "주문";
	}else if($status_temp == 2){
		$status_temp_str = "입금확인";
	}else if($status_temp == 3){
		$status_temp_str = "배송완료";
	}else if($status_temp == 4){
		$status_temp_str = "환불";
	}else if($status_temp == 5){
		$status_temp_str = "주문취소";
	}else if($status_temp == 6){
		$status_temp_str = "배송중";
	}else if($status_temp == 7){
		$status_temp_str = "교환";
	}else if($status_temp == 10){
		$status_temp_str = "결제취소";
	}else if($status_temp == 11){
		$status_temp_str = "맞교환";
	}else if($status_temp == 12){
		$status_temp_str = "대기";
	}else{
		$status_temp_str = "-";
	}
?>
							<tr align='center'>
							<input type='hidden' name='status_old[]' value='<?=$status_temp?>'>
							<input type='hidden' name='order_num[]' value='<?=$order_num?>'>
							<input type='hidden' name='status_old[]' value='<?=$good_status?>'>
								<td bgcolor='#FFFFFF' rowspan='2'><?=$j?> <input type='checkbox' name='checkSel[]' value='<?=$order_num?>'></td>
								<td  bgcolor='#FFFFFF'><a href='order_detail.php?order_num=<?=$order_num?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>'><?=$order_num?></a></td>
								<td bgcolor='#FFFFFF'><?=$name?></td>
								<td bgcolor='#FFFFFF'><?=$date_str?></td>
								<td bgcolor='#FFFFFF'><?=$mon_tot_freight_str?>원</td>
								<td bgcolor='#FFFFFF'>
<?
	if($status_temp == '9'){
?>
									<font color='red'>삭제</font>
									<input type='hidden' name='status[]' value='9'>
<?
	}else if($status_temp == '8'){
?>
									<font color='red'>고객주문취소</font>
									<input type='hidden' name='status[]' value='8'>
<?
	}else if($status_temp == '10'){
?>
									<font color='red'>결제취소</font>
									<input type='hidden' name='status[]' value='10'>
<?
	}else{
?>
									<?=$status_temp_str?>
<?
	}
?>
								</td>
								<td bgcolor='#FFFFFF' align='center'><?=$paystr?></td>
								</tr>
								<?=$item_detail_str?>
<?
}
?>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>
			
			<tr>
			  <td width="100%" height="10" align="center">
			  <table border="0" width="95%"
			  cellspacing="0" cellpadding="0">
				 <tr>
					<td width="100%" height="10"></td>
				 </tr>
				 <tr>
					<td width="100%" bgColor="#7bbebd">
					<table cellSpacing="1" cellPadding="3" width="100%" border="0">
					  <tr>
						 <td width="100%" bgColor="#e9f5f5" height="30">
						 <table width="100%" border="0">
							<tr>
							  <td width="100%">
								<input onclick="javascript:toggle(1)" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="전체선택"> 
								<input onclick="javascript:toggle(0)" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="선택해제">
								&nbsp; &nbsp;
								<font color="#3d918a">선택한 주문의</font> 
								<input onclick="add_list_print()" style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="주소출력">&nbsp;&nbsp;&nbsp;
								<select name='status_all' class='aa' style='height: 18px; background-color: rgb(193,219,227); border: 1px solid black' size='1'>
									<option>주문상태를 : </option>
									<option value="1">주문</option>
									<option value="5">주문취소</option>
									<option value="2">입금확인</option>
									<option value="6">배송중</option>
									<option value="3">배송완료</option>
									<option value="7">교환</option>
									<option value="11">맞교환</option>
									<option value="12">대기</option>
									<option value="4">환불</option>
									<option value="10">결제취소</option>
									<option value="9">삭제</option>
								</select>&nbsp;&nbsp;
								<input  style="BORDER-RIGHT: #3d918a 1px solid; BORDER-TOP: #3d918a 1px solid; BORDER-LEFT: #3d918a 1px solid; COLOR: #3d918a; BORDER-BOTTOM: #3d918a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="submit" value=" 변 경 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	
							  </td>
							</tr>
						 </table>
						 </td>
					  </tr>
					</table>
					</td>
				 </tr>
				 <tr>
					<td width="100%"></td>
				 </tr>
			  </table>
			  </td>
			</tr>
			</form>
				
<?
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
			<tr align="center">
				<td width="100%" bgcolor="#FFFFFF">
					<?
					if($page == 1){
						echo ("
						처음
						");
					}
					else{
						echo ("
						<a href='order_new2.php?page=1&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>처음</a> 
						");
					}
				
					if($start_page > 1){
						echo ("
						<a href='order_new2.php?page=$prev_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>
						◁&nbsp; 
						</a>
						");
					}
					else{
						echo ("
						◁&nbsp; 
						");
					}
					for($i=$start_page;$i<=$end_page;$i++){
						if($i == $page){
							echo ("	
							[<b>$i</b>]
							");
						}
						else{
							echo ("
						<a href='order_new2.php?page=$i&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>$i</a> 
							");
						}
					}
					if($end_page < $total_page){
						echo ("
						<a href='order_new2.php?page=$next_start_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>
						&nbsp;▷
						</a>
						");
					}
					else{
						echo ("
						&nbsp;▷
						");
					}
					if($page == $total_page){
						echo ("
						끝
						");
					}
					else{
						echo ("
						<a href='order_new2.php?page=$total_page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>끝</a> 
						");
					}
					?>
					</td>
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
if($update_flag == 'add_list_print'){
	$order_num_list = '';
	for($k=0; $k<count($checkSel); $k++) {
		if($k+1 < count($checkSel))
			$order_num_list .= $checkSel[$k].'|';
		else
			$order_num_list .= $checkSel[$k];
	}
	echo "
	<script>
	window.open( 'add_list_print.php?order_num_list=$order_num_list', '','toolbar=no,width=610,height=300,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');
	</script>
	";

	echo "<meta http-equiv='refresh' content='0; URL=order_new2.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>";
}

if($update_flag=='update'){
/**	//================== SMS DB 설정 파일을 불러옴 =======================================
	include "../../connect_sms.php";
	include "../../market/include/getmartinfo.php"; **/

	for($i=0; $i<count($checkSel); $i++){
		$num = $checkSel[$i];
		$pay_day = date("Y-m-d H:i:s");
		$SQL = "update $Order_BuyTable set status='$status_all', payment_date ='$pay_day' where order_num='$num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		$SQL22 = "update $Order_ProTable set status='$status_all' where order_num='$num'";
		$dbresult22 = mysql_query($SQL22, $dbconn);
	echo $SQL22;
	exit;
	
		if($status_old[$i] != '3' && $status_all == '3' && $bonus_ok == 't'){ //배송완료일때만, 포인트 사용할 때만 포인트 추가
		
			//기존 포인트 테이블에 데이타가 없을때만 
			$SQL = "select * from $BonusTable where order_num = '$num' and mart_id='$mart_id' and mode='p'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);

			$id = '';
			if($numRows == 0){
				//구매자 id 알아내기
				$SQL = "select id from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
				if($numRows > 0){
					$id = mysql_result($dbresult,0,0);
				}
				
				if(!empty($id)){//회원구매에만 적용
					//포인트 지급
					$SQL = "select * from $Order_ProTable where order_num = '$num' and mart_id='$mart_id'";
					$dbresult = mysql_query($SQL, $dbconn);
					$numRows = mysql_num_rows($dbresult);
							
					$order_num_tmp = $num;
					for ($k=0; $k<$numRows; $k++) {
						mysql_data_seek($dbresult,$k);
						$ary = mysql_fetch_array($dbresult);
						$order_pro_no_tmp = $ary[order_pro_no];
						$item_name_tmp = $ary[item_name];
						$quantity_tmp = $ary[quantity];
						$bonus_tmp = $ary[bonus];
						$status_tmp = $ary[status];
						if($bonus_tmp > 0){
							$bonus_sum = $bonus_tmp * $quantity_tmp;
							$content = "주문번호:".$order_num_tmp."\n제품명:".$item_name_tmp."\n수량:".$quantity_tmp; 
							
							$write_date = date("Ymd H:i:s");
							
							$SQL2 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) ".
							"values ('$mart_id', '$id', '$write_date', $bonus_sum, '$content', '$order_num_tmp', 'p')";
							$dbresult2 = mysql_query($SQL2, $dbconn);

							$SQL3 = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus_sum where username='$id' and mart_id='$mart_id'";
							$dbresult3 = mysql_query($SQL3, $dbconn);
							
						}
					}
				}
			}
		}	

		/*if( $status_old[$i] != '2' && $status_all == '2' ){ //입금확인시 sms보내기
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== SMS 전송 ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//받는 사람 번호
			$tran_callback = "$shop_tel";//보내는 사람 번호
			$tran_msg = "$name"."님의 입금내역이 확인되었습니다.주문번호 "."$num"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('문자 전송 실패');
				</script>
				";
			}
			//============================================================================

			//입점몰 정보 알아내기
			$ok_sql = "select * from $Order_ProTable where order_num = '$num' order by order_pro_no desc";
			$ok_res = mysql_query($ok_sql, $dbconn);
			$ok_tot = mysql_num_rows($ok_res);

			for( $k = 0; $k < $ok_tot; $k++ ){
				$ok_row = mysql_fetch_array($ok_res);
				$provider_id = $ok_row[provider_id];

				//================== 입점몰 정보를 불러옴 ================================
				$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
				$phon_res = mysql_query($phon_sql, $dbconn);
				$phon_row = mysql_fetch_array($phon_res);
				$pro_phon = $phon_row[tel2];
				$pro_name = $phon_row[name];

				$tr_senddate = date("YmdHis");
				$tran_phone = "$pro_phon";//받는 사람 번호
				$tran_callback = "$shop_tel";//보내는 사람 번호
				$tran_msg = "주문번호 "."$num"." 입금이 확인되었습니다.상품을 배송해주십시오.[$mart_id]";

				$sms_sql0 = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
				$sms_res0 = mysql_query( $sms_sql0, $connect );

				if( !$sms_res0 ){
					echo "
					<script>
						alert('입점몰에게 문자 전송 실패');
					</script>
					";
				}
			}
		}*/
		
		if($status_old[$i] != '3' && $status_all == 3){ //배송완료일때만, 구매총액 추가
			$id = '';
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);
				
			if(!empty($id)){
				//구매총액변경
				$SQL = "select * from $Order_ProTable where order_num = '$num' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
						
				$sum_total = 0;
				for ($k=0; $k<$numRows; $k++) {
					mysql_data_seek($dbresult,$k);
					$ary = mysql_fetch_array($dbresult);
					$z_price_tmp = $ary[z_price];
					$quantity_tmp = $ary[quantity];
					$sum_tmp = $z_price_tmp * $quantity_tmp;
					$sum_total += $sum_tmp;
				}
				$SQL = "update $Mart_Member_NewTable set money_total = money_total + $sum_total 
				where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
			}
			
			$send_date = date("Y-m-d H:i:s");
			$SQL = "update $Order_BuyTable set send_date='$send_date' where order_num='$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}	
		
		if($status_old[$i] == '3' && $status_all != 3){ //이전상태가 배송완료일때만, 구매총액 마이너스
			
			$id = '';
			//구매자 id 알아내기
			$SQL = "select id from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows > 0){
				$id = mysql_result($dbresult,0,0);
			}
			
			if(!empty($id)){
				//구매총액변경
				$SQL = "select * from $Order_ProTable where order_num = '$num' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
						
				$sum_total = 0;
				for ($k=0; $k<$numRows; $k++) {
					mysql_data_seek($dbresult,$k);
					$ary = mysql_fetch_array($dbresult);
					$z_price_tmp = $ary[z_price];
					$quantity_tmp = $ary[quantity];
					$sum_tmp = $z_price_tmp * $quantity_tmp;
					$sum_total += $sum_tmp;
				}
				$SQL = "update $Mart_Member_NewTable set money_total = money_total - $sum_total 
				where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
			}
			$SQL = "update $Order_BuyTable set send_date='' where order_num='$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);	
		}	
		
		if(($status_old[$i] != '5' && $status_all == '5')||($status_old[$i] != '4' && $status_all == '4')){ //주문취소,환불시 보너스에서 빼기
		
			//사용한 보너스 복구
			$SQL = "select id,use_bonus_tot from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			
			$SQL1 = "select * from $BonusTable where order_num='$num' and bonus<0 and mart_id='$mart_id'";
			$dbresult1 = mysql_query($SQL1, $dbconn);
			$numRows1 = mysql_num_rows($dbresult1);
			
			if($numRows > 0 &&$numRows1>0){
			
				$id = mysql_result($dbresult,0,0);
				$use_bonus_tot = mysql_result($dbresult,0,1);
				
				if(!empty($id)&&!empty($use_bonus_tot)){
					//회원테이블에서 보너스 총액 복구
					$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
					$dbresult = mysql_query($SQL, $dbconn);
					
					//보너스 테이블에서 삭제
					$SQL = "delete from $BonusTable where order_num='$num' and bonus<0 and mart_id='$mart_id'";
					$dbresult = mysql_query($SQL, $dbconn);
				}	
			}
			
			//보너스에서 삭제
			$SQL = "select id,bonus from $BonusTable where order_num ='$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			$bonus_total = 0;
			for ($k=0; $k<$numRows; $k++) {
				$id = mysql_result($dbresult,$k,0);
				$bonus = mysql_result($dbresult,$k,1);
				$bonus_total += $bonus;
			}
			if(!empty($id)){	
				$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total-$bonus_total where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
			}
			
			$SQL = "delete from $BonusTable where order_num='$num' and bonus>0 and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}	

		/**if( $status_old[$i] != '4' && $status_all == '4' ){ //환불시 sms보내기
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== SMS 전송 ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//받는 사람 번호
			$tran_callback = "$shop_tel";//보내는 사람 번호
			$tran_msg = "$name"."님이 주문하신 상품이 환불되었습니다.주문번호 "."$num"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('문자 전송 실패');
				</script>
				";
			}
			//============================================================================	
		}**/
		
		/**if( $status_old[$i] != '5' && $status_all == '5' ){ //주문취소시 sms보내기
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== SMS 전송 ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//받는 사람 번호
			$tran_callback = "$shop_tel";//보내는 사람 번호
			$tran_msg = "$name"."님이 주문하신 상품이 취소되었습니다.주문번호 "."$num"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('문자 전송 실패');
				</script>
				";
			}
			//============================================================================	
		}**/
		
		/*if( $status_old[$i] != '6' && $status_all == '6' ){ //배송중일때 sms보내기
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== SMS 전송 ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//받는 사람 번호
			$tran_callback = "$shop_tel";//보내는 사람 번호
			$tran_msg = "$name"."님이 주문하신 상품이 배송되었습니다.주문번호 "."$num"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('문자 전송 실패');
				</script>
				";
			}
			//============================================================================	
		}*/
	}	

	echo "<meta http-equiv='refresh' content='0; URL=order_new2.php?page=$page&keyset=$keyset&searchword=$searchword&flag=$flag&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>";
}	
?>
<?
mysql_close($dbconn);
?>