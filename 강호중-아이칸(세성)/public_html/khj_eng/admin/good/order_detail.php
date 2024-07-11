<?
//if (!headers_sent()) {
//Header("Cache-Control: No-Cache\n");
//Header("Pragma: No-Cache\n");
//Header("expires: now\n");
//}
include "../lib/Mall_Admin_Session.php";
?>
<?
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$freight_limit = mysql_result($dbresult, 0, "freight_limit");
$freight_cost = mysql_result($dbresult, 0, "freight_cost");	
$bonus_ok  = mysql_result($dbresult, 0, "bonus_ok");	
$if_gnt_item = mysql_result($dbresult, 0, "if_gnt_item");	//0:일반상점 1:공급상점 2:판매상점

$SQL = "select * from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_provider = $ary[if_provider];
	$if_seller = $ary[if_seller];
	$mycoupon_id = $ary[mycoupon_id];
}

$SQL = "select * from order_config where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$field1_text = $ary[field1_text];
	$field2_text = $ary[field2_text];
	$field3_text = $ary[field3_text];
	$field4_text = $ary[field4_text];
	$field5_text = $ary[field5_text];
}
if($update_flag == ''){
	include "../admin_head.php";
?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
	RemindWindow = window.open( "", "mainpage","toolbar=no,width=610,height=150,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}
// -->
</script>
<script>
function really(order_num){
	if(confirm("\n정말로 삭제하시겟습니까?\n\n삭제하시면 현주문과 관련된 데이타가\n\n삭제되며 복구는 되지않습니다.")){
		window.location.href='order_detail.php?status_flag=<?=$status_flag?>&page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&update_flag=delete_data&order_num='+order_num;
		return true;
	}
	return false; 
}

/*
function checkform(f){
	if(confirm("\n공급처로 주문정보를 보내시겠습니까?\n")){
		return true;
	}
	else
		return false; 
}
*/
</script>
<script language="JavaScript">  
/*function print_page(){  
	IEPrint.left = 0;  
	IEPrint.right = 0;  
	IEPrint.top = 0;  
	IEPrint.bottom = 0;  
	IEPrint.header = "";  
	IEPrint.footer = "";  
	IEPrint.printbg = true; // 이전버전과 달리 true, false로 설정한다.  
	IEPrint.landscape = false; // 가로 출력을 원하시면 true로 넣으면 됩니다. 세로출력은 false입니다.  
	IEPrint.print(); // 위에 설정한 값을 실제 적용하고, 프린트다이얼로그를 띄웁니다.  
}  
print_page();*/

//////////////   print_form 스크립터   //////////////
function printWindow(Type,Check){
	if (Check == 1){
		IEPrint.left	= 0;
		IEPrint.right	= 0;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}else{
		IEPrint.left	= 10;
		IEPrint.right	= 10;
		IEPrint.top		= 0;
		IEPrint.bottom	= 0;
	}

	IEPrint.header		= "";
	IEPrint.footer		= "";
	IEPrint.printbg		= true;		// 이전버전과 달리 true, false로 설정한다.
	IEPrint.landscape	= Type;		// 가로 출력을 원하시면 true로 넣으면 됩니다. 세로출력은 false입니다.	
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
<script>
function printWin(url){ 
	window.open(url, 'printWin', 'width=700,height=600,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
}	
function person_mail(email){
	window.open('person_mail_pop.php?email='+email, 'printWin', 'width=700,height=660,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
}
</script>
<script>

function order_update(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}


function send_to_provider(f){
	if(confirm("\n공급처로 주문정보를 보내시겠습니까?\n")){
		f.action='order_update.php';
		window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
		f.target='order_update_win';
		f.submit();
	}	
}

function add_memo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function add_mymemo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function add_secretmemo(f){
	f.action='order_update.php';
	window.open("","order_update_win","top=3000,left=3000,width=0,height=0");
	f.target='order_update_win';
	f.submit();
}
function jaego_back(){
	var conf = confirm("재고수량을 복구하시겠습니까?");
	if(conf == true)
	window.open("order_update.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&update_flag=jaego_back&order_num=<?=$order_num?>","0x0","top=3000,left=3000,width=0,height=0");
}
function receipt_win(mart_id,order_num){
	var url = "../../market/receipt/receipt.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&mart_id="+mart_id+"&order_num="+order_num
	var uploadwin = window.open(url,"receipt","width=590,height=500,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}

function product_send_mail(order_num){
	var conf = confirm("배송중메일을 보내시겠습니까?");
	if(conf == true)
	window.open("./product_send_mail.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&order_num="+order_num,"0x0","top=3000,left=3000,width=0,height=0");
}

function money_ok_mail(order_num){
	var conf = confirm("입금확인메일을 보내시겠습니까?");
	if(conf == true)
	window.open("./money_ok_mail.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>&order_num="+order_num,"0x0","top=3000,left=3000,width=0,height=0");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<OBJECT ID="IEPrint" style="display:none" CLASSID="CLSID:F290B058-CB26-460E-B3D4-8F36AEEDBE44" 
codebase="../cab/IEPrint.cab#version=1,0,0,7"></OBJECT>
<DIV ID="objContents">
  <?  include '../inc/menu4.html'; ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">주문관리</span> &gt; <span class="text_gray2_c">주문관리 </span> </div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>주문관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>
			<span id="d1">
			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center" style="word-break:break-all">
				<tr>
				<td width="90%" bgcolor="#FFFFFF">
					주문번호에 대한 상세내역입니다.<br>
					기본설정에서 포인트 사용으로 세팅되어 있고,<br>
					배송완료로 수정하실 경우에만 회원에게 포인트가 적립됩니다.<br><br>
					주문과 동시에 각 상품의 재고량에서 주문량만큼 차감이 되며,<br>
					미입금/주문취소/환불/교환등의 경우, 재고수량 복구 버튼을 클릭하셔야 재고가 복구됩니다.<br>
					주문정보를 삭제하실 경우에는 수량복구 후 삭제를 클릭해주세요.
				</td>
				</tr>
				<tr>
				<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>
<?
	$SQL = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";



	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$id = $ary[id];
		$name = $ary[name];
		$passport1 = $ary[passport1];
		$passport2 = $ary[passport2];
		$tel1 = $ary[tel1];
		$tel2 = $ary[tel2];
		$email = $ary[email];
		$buyer_zip = $ary[buyer_zip];
		$buyer_address = $ary[buyer_address];
		$buyer_address_d = $ary[buyer_address_d];
		$receiver = $ary[receiver];
		$rev_tel = $ary[rev_tel];
		$rev_tel1 = $ary[rev_tel1];
		$zip = $ary[zip];
		$address = $ary[address];
		$message = nl2br($ary[message]);
		$mon_tot = $ary[mon_tot];
		$use_bonus_tot = $ary[use_bonus_tot];
		$freight_fee = $ary[freight_fee];
		$paymethod = $ary[paymethod];
		$account_no = $ary[account_no];
		$freight_code = $ary[freight_code];
		$deposite = $ary[deposite];
		$delivery = $ary[delivery];
		$status = $ary[status];
		$date = $ary[date];
		$address_d = $ary[address_d];
		$money_sender = $ary[money_sender];
		$pay_day = $ary[pay_day];
		$date_str = $date;
		//$date_str = substr($date,0,4)."년 ".substr($date,5,2)."월 ".substr($date,8,2)."일";
		$if_use_bonus = $ary[if_use_bonus];
		$use_bonus_tot = $ary[use_bonus_tot];
		$partner = $ary[partner];
		$send_date = $ary[send_date];
		$keeper_message = $ary[keeper_message];
		$secret_message = $ary[secret_message];
		$jaego_back = $ary[jaego_back];
		$field1 = $ary[field1];
		$field2 = $ary[field2];
		$field3 = $ary[field3];
		$field4 = $ary[field4];
		$field5 = $ary[field5];
		$card_paid = $ary[card_paid];
		$field1 = $ary[field1];
		$authnumber = $ary[authnumber];

		if( !$id ){
			$id = "비회원";
		}
	}

	//====================== 결제방법 정보 ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$bank_sql = "select * from $BankTable where mart_id='$mart_id' and bank_name != '' and bank_number != '' and owner_name != ''";
		$bank_res = mysql_query($bank_sql, $dbconn);
		$bank_tot = mysql_num_rows($bank_res);
		$bank_str = "<select class='input_03' name='account_no'>";
		if($bank_tot > 0){
			$bank_str .= "<option value=''>입금하실 은행</option>";
			while($bank_row = mysql_fetch_array($bank_res))
			{
				//$account_no = $bank_row[account_no];
				$bank_name = $bank_row[bank_name];
				$bank_number = $bank_row[bank_number];
				$owner_name = $bank_row[owner_name];
				$selected = "";
				if($account_no == $bank_row[account_no])
					$selected = "selected";
				$bank_str .= "<option value='$bank_row[account_no]' $selected >$bank_name $bank_number 예금주 : $owner_name</option>";
			}
		}else{
			$bank_str .= "<option value='nobank'>준비중입니다.</option>";
		}
		$bank_str .= "</select>";
	}

	if($paymethod== 'bycard'){
		if($card_paid == 't')
			$paystr = "카드결제";
		elseif($card_paid == 'f')
			$paystr = "카드결제실패";
		$totpaystr = "카드결제 금액";
	}
	if($paymethod== 'bycard_point'){
		$paystr = "카드결제 + 포인트결제";
		$totpaystr = "카드결제 금액";
	}
	if($paymethod== 'byaccount'){
		$paystr = "실시간계좌이체";
		$totpaystr = "실시간계좌이체 금액";
	}
	if($paymethod== 'byaccount_point'){
		$paystr = "실시간계좌이체 + 포인트결제";
		$totpaystr = "실시간계좌이체 금액";
	}
	//====================== 온라인 입금시 계좌 정보 =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str = $bank_str;
			$paystr = "무통장입금";
			$totpaystr = "온라인 입금 금액";
		}else{
			$account_str = $bank_str;
			$paystr = "무통장입금";
			$totpaystr = "온라인 입금 금액";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금 금액";
		}else{
			$account_str ="";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금 금액";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "포인트결제";
		$totpaystr = "결제 금액";
	}
?>
			<tr>
				<td width="100%" bgcolor="#FFFFFF" height="35" align="center">
					<b>[주문번호 <?=$order_num?> | <?="$name($id)"?>님의 주문내역]
					
<?
	if($jaego_back == '0'){
?>
					<input onclick='javascript:jaego_back()' style='BACKGROUND-COLOR: white; BORDER: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=90' type='button' value='재고수량복구'>
<?
	}else{
	}
?>	
					</b>
				</td>
			</tr>
				
<form method="POST">
<input type='hidden' name='update_flag' value='update_all'>
<input type='hidden' name='order_num' value='<?=$order_num?>'>
<input type='hidden' name='mart_id' value='<?=$mart_id?>'>
<input type='hidden' name='email_flag' value=''>
<input type='hidden' name='status_old' value='<?=$status?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='keyset' value='<?=$keyset?>'>
<input type='hidden' name='searchword' value='<?=$searchword?>'>
<input type='hidden' name='flag' value='<?=$flag?>'>
<input type='hidden' name='cnfPagecount' value='<?=$cnfPagecount?>'>
<input type='hidden' name='QryFromDate' value='<?=$QryFromDate?>'>
<input type='hidden' name='QryToDate' value='<?=$QryToDate?>'>
<input type='hidden' name='status_flag' value='<?=$status_flag?>'>
								
				<tr>
				<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
					<table border="0" width="95%">
						<tr>
							<td width="100%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan='7'>
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="100%">&nbsp; <b>주문 내역</b></td>
											</tr>
										</table>
									</td>
								</tr>
<?
	if(!empty($mycoupon_id)){
		$coupon_str = ",쿠폰사용내역";
	}	
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td width="29%">상품명(포인트<?=$coupon_str?>)</td>
									<td width="7%">수 량</td>
									<td width="10%">가 격</td>
									<td width="12%">합 계</td>
									<td width="15%">상 태</td>
									<td width="15%">송장번호</td>
									<td width="10%">택배회사</td>
								</tr>
<?
	$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' order by order_pro_no desc";
	//echo $SQL;
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$prev_status = "";
	$mon_tot = 0;
	$bonus_tot = 0;
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$order_pro_no = $ary[order_pro_no];
		$item_no = $ary[item_no];
		$item_name = $ary[item_name];
		$opt = $ary[opt];
		$z_price = $ary[z_price];
		$coupon_used = $ary[coupon_used];
		$cpntype = $ary[cpntype];
		$rate = $ary[rate];
		$provider_id = $ary[provider_id];
		$pro_freight_code = $ary[pro_freight_code];
		$pro_delivery = $ary[pro_delivery];
		$z_price_str = number_format($z_price);
		$quantity = $ary[quantity];
		$opt = $ary[opt];
		$good_status  = $ary[status];
		$bonus  = $ary[bonus]; 

		$sql="select * from $OptionTable where opt_no='$opt'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		//echo $rs[opt_name]." ";
		//echo $rs[opt_price]*$quantity."원";
		$opt_name=$rs[opt_name];
		$opt_price=$rs[opt_price]*$quantity;
		$sum = ($z_price*$quantity)+$opt_price;
		$sum_str = number_format($sum);
	
		$bonus_sum = $bonus * $quantity;
		
		$mon_tot += $sum;
		$bonus_tot += $bonus_sum;
		if(($i > 0) &&($prev_status != $status)){
			$total_status = "Not Equal";
		}
		if($coupon_used == '1'){
			if($cpntype == '1'){
				$cpntype_str = ",정율:$rate %";
			}
			if($cpntype == '2'){
				$cpntype_str = ",정액:$rate 원";
			}
			if($cpntype == '3'){
				$cpntype_str = ",사은품:$rate";
			}	
		}else{
			$cpntype_str = '';
		}

		//====================== 입점몰 기본 정보를 가져옴 ===============================
		$in_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$in_res = mysql_query($in_sql, $dbconn);
		$in_row = mysql_fetch_array($in_res);
		$me_delivery = $in_row[me_delivery];
		if( $in_res ){
			mysql_free_result( $in_res );
		}
?>
								<tr bgcolor='#FFFFFF'>
									<input type='hidden' name='order_pro_no[]' value='<?=$order_pro_no?>'>
									<input type='hidden' name='good_status_old[]' value='<?=$good_status?>'>
									<input type='hidden' name='provider_id[]' value='<?=$provider_id?>'>
									<?
									$cate_que = "select * from item where item_no='$item_no'";
									$cate_res = mysql_query($cate_que,$dbconn);
									$cate_rows = mysql_fetch_array($cate_res);
									?>
									<td><a onClick="window.open('../good/item_edit_old.php?item_no=<?=$item_no?>&category_num=<?=$cate_rows[category_num]?>', 'mainpage','toolbar=no,width=700,height=600,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no');" style='cursor:hand'><?=$item_name?>(<?=$bonus?><?=$cpntype_str?>) </a>
<?
		if(isset($opt)&&$opt!=""&&$opt!="!!"){
			echo ("	
			<br>
					<img src='../images/optionbar.gif'>옵션:
				");
				echo $opt_name." ".$opt_price."원";
				/*$opts = explode("!", $opt);
			if(strstr($opts[0],'^'))
				$opts_1 = explode("^", $opts[0]);
			else {
				$opts_1[0] = $opts[0];
				$opts_1[1] = '';
			}
			if($opts_1[0] != "")
				echo "$opts_1[0]";
			if($opts_1[1] != "")
				echo "($opts_1[1] 원)&nbsp;";
			if($opts[1] != "")
				echo "$opts[1]&nbsp;";
			if($opts[2] != "")
				echo "$opts[2]";*/
		}
?>
									</td>
									<td align='center'><input name='quantity[]' size='3' value='<?=$quantity?>' style='border: 1px solid rgb(136,136,136)'></td>
									<td align='right'><?=$z_price_str?>원</td>
									<td align='right'><?=$sum_str?>원</td>
									<td align='center'>
					<?
						if($status == 1){
							$status_value = "주문";
					}else if($status == 5){
						$status_value = "주문취소";
					}else if($status == 2){
						$status_value = "입금확인";
					}else if($status == 6){
						$status_value = "배송중";
					}else if($status == 3){
						$status_value = "배송완료";
					}else if($status == 7){
						$status_value = "교환";
					}else if($status == 4){
						$status_value = "환불";
					}else if($status == 8){
						$status_value = "고객주문취소";
					}else if($status == 10){
						$status_value = "결제취소";
					}else if($status == 11){
						$status_value = "맞교환";
					}else if($status == 12){
						$status_value = "대기";
					}
					echo $status_value;
					?>	
									</td>
									<td><input name="pro_freight_code[]" size="15" value='<?=$pro_freight_code?>' class="input_03"></td>
									<td>
									<?
										$query_Freight = "select * from $Add_Freight_Name";
										$dbresult_Freight = mysql_query($query_Freight, $dbconn); 
									?>
									
									<?
									if ( $pro_delivery ){
									?>
											<select name="pro_delivery[]">
											<?
												for($zz=0;$rows_Freight=mysql_fetch_array($dbresult_Freight);$zz++){
													if($pro_delivery == $rows_Freight[pro_delivery]){
														$checked_pd = "selected";
													}
											?>
												<option value="<?=$rows_Freight[pro_delivery]?>" <?=$checked_pd?>><?=$rows_Freight[pro_delivery]?></option>
											<?
												$checked_pd = "";
											}
											?>
											</select>				
									<?
									}else{
									?>
											<select name="pro_delivery[]">
											<?
												for($zz=0;$rows_Freight=mysql_fetch_array($dbresult_Freight);$zz++){
											?>
												<option value="<?=$rows_Freight[pro_delivery]?>"><?=$rows_Freight[pro_delivery]?></option>
											<?
											}
											?>
											</select>				
									<?
									}
									?>
				
									


									
									
									
									
									
									
									</td>
								</tr>
<?
	}

	if($freight_fee == ''){
		if($mon_tot >= $freight_limit){		// 배송료설정
			$freight_fee = 0;
		}else{
			$freight_fee = $freight_cost;
		}
	}
	$mon_tot_freight = $mon_tot + $freight_fee;

	if($if_use_bonus == 1){
		$use_bonus_tot_str = number_format($use_bonus_tot);
		$money_to_pay = $mon_tot_freight - $use_bonus_tot;
		$money_to_pay_str = number_format($money_to_pay);
	}
?>
								
								<!-- <tr>
									<td width="35%" bgcolor="#FFFFFF"><p align="center">배송비</td>
									<td width="65%" bgcolor="#FFFFFF" align="center" colspan="4">
										<p align="right"><?=number_format($freight_fee)?>원</td>
								</tr> -->
								<tr>
									<td width="100%" bgcolor="#FFFFFF" colspan='7'><p align="right"><b>
									<font color='#FF0000'>총액: <?=number_format($mon_tot_freight)?> 원</font></b><br>
										포인트 적립 총액: <?=number_format($bonus_tot)?> 원<br>
<?
	if($if_use_bonus == 1){
		echo ("
	포인트 사용총액: $use_bonus_tot_str 원<br>	
	$totpaystr	: $money_to_pay_str 원	
		");
	}
?>
										
									</td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
<?###################################################################Start 현금영수증 ####################################################################?>
<script language="JavaScript" src="http://pgweb.uplus.co.kr/WEB_SERVER/js/receipt_link.js"></script>
<?
$LGD_HASHDATA = md5($xpay_id.$field1.$xpay_key);	
?>
<?
if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>									
	<input onclick="javascript:showCashReceipts('<?=$xpay_id?>','<?=$order_num?>','seqno','CR','service')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="현금영수증 출력">
	
	<input onclick="javascript:window.open('../../market/cart/CashReceipt.html?order_num=<?=$order_num?>&mon_tot_freight=<?=$mon_tot_freight?>&item_name=<?=$item_name?>','','left=100,top=50,width=400,height=500,scrollbars=yes');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="현금영수증 발급">
<?
}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
?>	
	<input onclick="javascript:showCashReceipts('<?=$xpay_id?>','<?=$order_num?>','seqno','BANK','service')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="현금영수증 출력">
<?
}else{//카드결제
?>
	<input onclick="javascript:showReceiptByTID('<?=$xpay_id?>', '<?=$field1?>', '<?=$LGD_HASHDATA?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #7b7d7b 1px solid; BORDER-LEFT: #7b7d7b 1px solid; BORDER-RIGHT: #7b7d7b 1px solid; BORDER-TOP: #7b7d7b 1px solid; COLOR: #7b7d7b; HEIGHT: 18px; width=120" type="button" value="카드전표 출력">
<?}?>
<?###################################################################End 현금영수증 ####################################################################?>

					<table border="0" width="95%">
						<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="4">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
												<td width="50%">&nbsp; <b>주문자 정보 </b></td>
												<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="name" size="25" value='<?=$name?>' class="input_03"> (<?=$id?>)
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">이메일</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="email" size="25" value='<?=$email?>' class="input_03">&nbsp;<a href="#" onClick="person_mail('<?=$email?>');"><img src="./outlook.jpg" border="0" width="22" height="18" align="middle"></a>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">전화</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="tel1" size="25" value='<?=$tel1?>' class="input_03">
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">휴대폰</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="tel2" size="25" value='<?=$tel2?>' class="input_03">
										
								</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">주소</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										(<?=$buyer_zip?>) <?=$buyer_address?> &nbsp;<?=$buyer_address_d?>
									</td>
								</tr>								
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">주문일시</td>
									<td width="29%" bgcolor="#FFFFFF" align="left" colspan='3'><?=$date_str?></td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">메모</td>
									<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
										<p align="left">
										<?=$message?>
								  </td>
								</tr>								
								
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">고객알림메모</td>
									<td width="63%" bgcolor="#FFFFFF" align="center" colspan="3">
										<p align="left">
										<textarea cols="51" name="keeper_message" rows="6" style="width:90%" class="input_03"><?=$keeper_message?></textarea>
								  </td>
								</tr>
								<tr>
									 <td align="middle" width="12%" bgColor="#ffffff">구매내역</td>
									 <td align="middle" width="63%" bgColor="#ffffff" colSpan="3"><p align="left">
									 <?
									 if($id!=''){
										$SQL = "select order_num from $Order_BuyTable where id='$id' and status='3' and mart_id='$mart_id'";//배송완료
													//echo "sql=$SQL";
													$dbresult = mysql_query($SQL, $dbconn);
													$numRows = mysql_num_rows($dbresult);
													$mon_tot = 0;
													for($i=0;$i<$numRows;$i++){
														$order_num_tmp = mysql_result($dbresult,$i,0);
														
														$SQL1 = "select z_price,quantity from $Order_ProTable where order_num='$order_num_tmp' and mart_id='$mart_id' order by order_pro_no desc";
														//echo "sql1=$SQL1";
														$dbresult1 = mysql_query($SQL1, $dbconn);
														$numRows1 = mysql_num_rows($dbresult1);
														for($j=0;$j<$numRows1;$j++){
															$z_price = mysql_result($dbresult1,$j,0);
															$quantity = mysql_result($dbresult1,$j,1);
															$sum = $z_price*$quantity;
															$mon_tot += $sum;
														}
													}
													$mon_tot_str = number_format($mon_tot);
													if($numRows > 0){
														echo "
														주문횟수 $numRows 건, 총주문금액 $mon_tot_str 원
														";
													}
													else{
														echo "
												구매내역이 없습니다.
														";
													}
												}			
												else{//비회원
													$SQL0 = "select order_num from $Order_BuyTable where status='3' and mart_id='$mart_id' ";
													
													if(!empty($passport1)&&!empty($passport1))
														$SQL1 = "(passport1='$passport1' and passport2='$passport2')";
													else $SQL1 = "(passport1='my!!@passport' and passport2='my!!@passport')";
													
													if(!empty($email))
														$SQL2 = "email='$email'";
													else $SQL2 = "email='my!!@email123'";
													
													if(!empty($tel1))
														$SQL3 = "tel1='$tel1'";
													else $SQL3 = "tel1='my!!@tel123'";
													
													if(!empty($tel2))
														$SQL4 = "tel2='$tel2'";
													else $SQL4 = "tel2='my!!@tel123'";
													
													$SQL = $SQL0.' and ('.$SQL1.' or '.$SQL2.' or '.$SQL3.' or '.$SQL4.')';
													//if($Mall_Admin_ID == 'test1')
													//echo "sql=$SQL";
													$dbresult = mysql_query($SQL, $dbconn);
													$numRows = mysql_num_rows($dbresult);
													$mon_tot = 0;
													for($i=0;$i<$numRows;$i++){
														$order_num_tmp = mysql_result($dbresult,$i,0);
														
														$SQL1 = "select z_price,quantity from $Order_ProTable where order_num='$order_num_tmp' and mart_id='$mart_id' order by order_pro_no desc";
														//echo "sql1=$SQL1";
														$dbresult1 = mysql_query($SQL1, $dbconn);
														$numRows1 = mysql_num_rows($dbresult1);
														for($j=0;$j<$numRows1;$j++){
															$z_price = mysql_result($dbresult1,$j,0);
															$quantity = mysql_result($dbresult1,$j,1);
															$sum = $z_price*$quantity;
															$mon_tot += $sum;
														}
													}
													$mon_tot_str = number_format($mon_tot);
													if($numRows > 0){
														echo "
														주문횟수 $numRows 건, 총주문금액 $mon_tot_str 원(배송완료기준)
														";
													}
													else{
														echo "
												구매내역이 없습니다.
														";
													}
												}	
												?>
									</td>
								  </tr>
								<tr>
									<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
									
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="50%">&nbsp; <b>수신자 정보 </b></td>
											<td width="50%"></td>
											</tr>
										</table>
									</td>
								</tr>
								<!--
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="receiver" size="25" value='<?=$receiver?>' class="input_03">
										</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">전화</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="rev_tel" size="25" value='<?=$rev_tel?>' class="input_03">
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">우편번호</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="zip" size="25" value='<?=$zip?>' class="input_03">
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">기타연락처</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="rev_tel1" size="25" value='<?=$rev_tel1?>' class="input_03">
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">주소</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<input name="address" size="50" value='<?=$address?>' class="input_03">
									
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">상세주소</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<input name="address_d" size="50" value='<?=$address_d?>' class="input_03">
									
									<a href='add_print.php?order_num=<?=$order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
									</td>
								</tr>
								//-->
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">이름</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<?=$receiver?>
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">전화</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<?=$rev_tel?>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">우편번호</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<?=$zip?>
									</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">기타연락처</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<?=$rev_tel1?>
									</td>
								</tr>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">주소</td>
									<td width="63%" bgcolor="#FFFFFF" align="left" colspan="3">
										<?="$address &nbsp;$address_d"?>
								
									&nbsp;<a href='add_print.php?order_num=<?=$order_num?>' target='mainpage' onclick='OpenWindow()'><img src='../images/add-print.gif' width='72' height='17' border='0'></a>
									</td>
								</tr>
								<tr>
									<td width="75%" bgcolor="#8FBECD" align="center" colspan="4">
										
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<td width="100%">&nbsp; <b>결제 정보 </b></td>
											</tr>
										</table>
									</td>
								</tr>
<?
if($if_use_bonus == 1){
	$use_bonus_tot_str = number_format($use_bonus_tot);
	//실제 결제해야될 금액 
	$money_to_pay = $mon_tot_freight - $use_bonus_tot;
	$money_to_pay_str = number_format($money_to_pay);
	/*
	if( !empty($paystr) ){
		$paystr = $paystr." + 포인트 사용";
	}else{
		$paystr = "포인트 사용";
	}*/
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td>포인트 사용</td>
									<td align="left"><?=$use_bonus_tot_str?>원</td>
									<td><?=$totpaystr?></td>
									<td align="left"><?=$money_to_pay_str?>원</td>
								</tr>
<?
}

if($paymethod=="bycard" || $paymethod=="bycard_point")
{
	if($field2 == "00")
		$field2 = "일시불";

	$pay_info_str = "승인번호 : ".$authnumber."<br>";
	$pay_info_str .= "DACOM 거래번호 : ".$field1."<br>";
	$pay_info_str .= "카드명 : ".$field3."<br>";
	$pay_info_str .= "할부 : ".$field2;
	if($card_paid == 'f')
		$pay_info_str = $field5;
}else if($paymethod=="byaccount" || $paymethod=="byaccount_point")
{
	$pay_info_str = "은행명 : ".$field3;
	if($card_paid == 'f')
		$pay_info_str = $field5;
}else if($paymethod=="byonline")
{
	$paystr = "";
}
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td>결제방법</td>
									<td align="left" ><?=$paystr?> <?=$account_str?></td>
									<td>결제정보</td>
									<td align="left" ><?=$pay_info_str?></td>
								</tr>
<?
if($paymethod=="byonline" ||$paymethod=="byonline_point")
{
?>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">입금자명</td>
									<td width="29%" bgcolor="#FFFFFF" align="left">
										<input name="money_sender" size="25" value='<?=$money_sender?>' class="input_03">
								  </td>
									<td width="12%" bgcolor="#FFFFFF" align="center">입금예정일</td>
									<td width="22%" bgcolor="#FFFFFF" align="left">
										<input name="pay_day" size="25" value='<?=$pay_day?>' class="input_03">
								  </td>
								</tr>
<?
}
?>
								<tr>
									<td width="12%" bgcolor="#FFFFFF" align="center">진행처리</td>
									<td colspan='3' bgcolor="#FFFFFF">
<?
if($status == '8'){
?>
										<font color='red'>고객주문취소</font><input type='hidden' name='status' value='8'>
<?										
}else if($status == '9'){
?>
										<font color='red'>삭제</font>
										<input type='hidden' name='status' value='9'>
<?
}else if($status == '10'){
?>
										<font color='red'>결제취소</font>
										<input type='hidden' name='status' value='10'>
<?
}else{
?>
										<select name="status" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; HEIGHT: 18px">
											<option value="1" <?if($status == 1) echo " selected";?>>주문</option>
											<option value="5" <?if($status == 5) echo " selected";?>>주문취소</option>
											<option value="2" <?if($status == 2) echo " selected";?>>입금확인</option>
											<option value="6" <?if($status == 6) echo " selected";?>>배송중</option>
											<option value="3" <?if($status == 3) echo " selected";?>>배송완료</option>
											<option value="7" <?if($status == 7) echo " selected";?>>교환</option>
											<option value="11" <?if($status == 11) echo " selected";?>>맞교환</option>
											<option value="12" <?if($status == 12) echo " selected";?>>대기</option>
											<option value="4" <?if($status == 4) echo " selected";?>>환불</option>
											<option value="10">결제취소</option>
										</select>
<?
}
?>
<?
if($status == '3'){
	$send_str = "<br>$send_date";
}
?>
										<?=$send_str?>
									</td>
								</tr>
								</table>
							</td>
						</tr>
					</table>
					<p align="center">
					<input onClick="javascript:order_update(this.form)" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="수정">
					<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
					<input onClick="javascript:window.location.href='order_new.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&flag=<?=$flag?>&cnfPagecount=<?=$cnfPagecount?>&QryFromDate=<?=$QryFromDate?>&QryToDate=<?=$QryToDate?>&status_flag=<?=$status_flag?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="리스트">
					<input onClick="javascript:product_send_mail('<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="배송중메일">
					<input onClick="javascript:money_ok_mail('<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="입금확인메일">
					<input onClick="javascript:printWin('order_print.php?order_num=<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="프린트">
					<!-- <input onclick="printDiv('false','');" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="프린트"> -->
					<input onClick="javascript:return really('<?=$order_num?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="주문정보 삭제">
					</p>
				</td>
				</tr>
			</form>
			</table>
			</span>
			

<?
if($if_gnt_item == '2' && $numRows > 0){

	$content = '';
	$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id='$provider_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows1 = mysql_num_rows($dbresult);
	if($numRows1>0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$content = $ary[content];
	}

?>
			  <table border="0" width="90%" align='center'>
			  
			  <form action='order_detail.php' method='post'>
			  <input type='hidden' name='update_flag' value='add_memo'>
			  <input type='hidden' name='order_num' value='<?=$order_num?>'>
			  <input type='hidden' name='provider_id' value='<?=$provider_id?>'>
			  
			  <tr>
				 <td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
					<tr>
					  <td width="100%" bgColor="#8fbecd"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						 <tr>
							<td width="100%">&nbsp; <b>판매자메모</b></td>
						 </tr>
					  </table>
					  </td>
					</tr>
					<tr>
					  <td align="middle" width="100%" bgColor="#ffffff" rowspan="3"><p align="left">
					  <textarea style="width: 90%"  class="input_03" name="content" rows="6" cols="93"><?=$content?></textarea></td>
					</tr>
				 </table>
				 </td>
			  </tr>
			  <tr>
				 <td width="100%"><br><p align="center">
				 <input onclick='javascript:add_memo(this.form)' style="BORDER: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="메모전송"></td>
			  </tr>
			  </a>
			  </form>
			</table>
	<?
	}
	?>
<?
	if($if_gnt_item == '2' && $numRows > 0){
	
		$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id=''";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows1 = mysql_num_rows($dbresult);
		if($numRows1>0){
			mysql_data_seek($dbresult,0);
			$ary = mysql_fetch_array($dbresult);
			$content1 = $ary[content];
		}
	
	?>	
			  <table border="0" width="90%" align='center'>
			  
			  <form action='order_detail.php' method='post'>
			  <input type='hidden' name='update_flag' value='add_secretmemo'>
			  <input type='hidden' name='order_num' value='<?=$order_num?>'>
			  
			  <tr>
				 <td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
					<tr>
					  <td width="100%" bgColor="#8fbecd"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						 <tr>
							<td width="100%">&nbsp; <b>나만의 메모</b></td>
						 </tr>
					  </table>
					  </td>
					</tr>
					<tr>
					  <td align="middle" width="100%" bgColor="#ffffff" rowspan="3"><p align="left">
					  <textarea style="width: 90%"  class="input_03" name="secret_message" rows="6" cols="93"><?=$secret_message?></textarea></td>
					</tr>
				 </table>
				 </td>
			  </tr>
			  <tr>
				 <td width="100%"><br><p align="center">
				 <input onclick='javascript:add_mymemo(this.form)' style="BORDER: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="메모저장"></td>
			  </tr>
			  </a>
			  </form>
			</table>
<?
	}else{
?>

			<table border="0" width="90%" align='center'>
			<form action='order_detail.php' method='post'>
			<input type='hidden' name='update_flag' value='add_secretmemo'>
			<input type='hidden' name='order_num' value='<?=$order_num?>'>
			  
			  <tr>
				 <td width="100%" bgColor="#999999"><table cellSpacing="1" cellPadding="3" width="100%" border="0">
					<tr>
					  <td width="100%" bgColor="#8fbecd"><table cellSpacing="0" cellPadding="0" width="100%" border="0">
						 <tr>
							<td width="100%">&nbsp; <b>나만의 메모</b></td>
						 </tr>
					  </table>
					  </td>
					</tr>
					<tr>
					  <td align="middle" width="100%" bgColor="#ffffff" rowspan="3"><p align="left">
					  <textarea style="width: 90%"  class="input_03" name="secret_message" rows="6" cols="93"><?=$secret_message?></textarea></td>
					</tr>
				 </table>
				 </td>
			  </tr>
			  <tr>
				 <td width="100%" align="center" height="30"><input onclick='javascript:add_secretmemo(this.form)' style="BORDER: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="메모저장"></td>
			  </tr>
			  </form>
			</table>
		</td>
	</tr>
  </table>

<?
	}
?>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</DIV>
<DIV ID="objSelection">

</DIV>
</form>
</body>
</html>
<?
}
if($update_flag == "delete_data"){

	
	$id = '';
	$status = '';
	//구매자 id 알아내기
	$SQL = "select id,status from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$id = mysql_result($dbresult,0,0);
		$status = mysql_result($dbresult,0,1);
	}
	
	if(!empty($id)&&$status=='3'){
		//구매총액변경
		$SQL = "select * from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
				
		$order_num_tmp = $order_num[$i];
		$sum_total = 0;
		for ($i=0; $i<$numRows; $i++) {
			mysql_data_seek($dbresult,$i);
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
	
	$SQL = "delete from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $Order_BuyTable set status='9' where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	//사용한 보너스 복구
	$SQL = "select id, use_bonus_tot from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";;
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	
	$SQL1 = "select * from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$numRows1 = mysql_num_rows($dbresult1);
	
	if($numRows > 0 &&$numRows1>0){
		$id = mysql_result($dbresult,0,0);
		$use_bonus_tot = mysql_result($dbresult,0,1);
		
		if(!empty($id)&&!empty($use_bonus_tot)){
			//회원테이블에서 보너스 총액 복구
			$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
			
			//보너스 테이블에서 삭제
			$SQL = "delete from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
			//echo "sql=$SQL";
			$dbresult = mysql_query($SQL, $dbconn);
		}	
	}
	
	//삭제시 보너스에서 삭제
	$SQL = "select id,bonus from $BonusTable where order_num ='$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	$bonus_total = 0;
	for ($i=0; $i<$numRows; $i++) {
		$id = mysql_result($dbresult,$i,0);
		$bonus = mysql_result($dbresult,$i,1);
		$bonus_total += $bonus;
	}
	if(!empty($id)){		
		$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total-$bonus_total where username='$id' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	
	$SQL = "delete from $BonusTable where order_num='$order_num' and bonus>0 and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
						
	echo "<meta http-equiv='refresh' content='0; URL=order_new.php?page=$page&keyset=$keyset&searchword=$searchword&cnfPagecount=$cnfPagecount&QryFromDate=$QryFromDate&QryToDate=$QryToDate&status_flag=$status_flag'>";
	
}
?>
<?
mysql_close($dbconn);
?>
