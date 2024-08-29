<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
$date = date("Ymd H:i:s");
$SQL = "select order_num from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows=mysql_num_rows($dbresult);
if (mysql_num_rows($dbresult)>0) {
	echo ("
		<script language=javascript>
			alert(\"이미 존재하는 주문번호입니다.\\n\\n 중복으로 추가될 수 없습니다.\");
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/index.php?mart_id=$mart_id'>";
	exit;
}
if($account_no == 'nobank') $account_no=0;

$SQL = "insert into $Order_BuyTable (order_num, mart_id, id, name, passport1, passport2, tel1, tel2, email, buyer_zip, buyer_address, buyer_address_d, receiver, rev_tel, rev_tel1, zip, address, address_d, message, paymethod, account_no, status, date, partner, money_sender, pay_day,freight_fee, field1, field2, field3, field4, field5) values ('$order_num', '$mart_id', '$UnameSess', '$name', '$passport1', '$passport2', '$buyer_tel', '$buyer_tel1', '$email', '$buyer_zip', '$buyer_address', '$buyer_address_d', '$receiver', '$rev_tel', '$rev_tel1', '$zip', '$address', '$address_d', '$message', '$paymethod', '$account_no', '1', '$date', '$partner', '$money_sender', '$pay_day', '$freight_fee', '$field1', '$field2', '$field3', '$field4','$field5')";

$dbresult = mysql_query($SQL, $dbconn);

//재고량에서 빼기 
$SQL = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
//echo "sql=$SQL";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
		
for ($i=0; $i<$numRows; $i++) {
	mysql_data_seek($dbresult,$i);
	$ary = mysql_fetch_array($dbresult);
	$item_no = $ary["item_no"];
	$item_name = $ary["item_name"];
	$quantity = $ary["quantity"];
	
	$SQL1 = "select jaego, jaego_use from $ItemTable where item_no=$item_no";
	$dbresult1 = mysql_query($SQL1, $dbconn);
	$jaego = mysql_result($dbresult1, 0, 0);
	$jaego_use = mysql_result($dbresult1, 0, 1);
	if($jaego_use == '1'){
		$jaego_new = $jaego - $quantity;
		if($jaego_new <= 0) $jaego_new = 0;
		
		$SQL2 = "update $ItemTable set jaego = $jaego_new where item_no = $item_no";
		//echo "sql=$SQL";
		//echo "<br>";
		$dbresult2 = mysql_query($SQL2, $dbconn);
	}
}

$SQL = "update $Order_ProTable set status='1' where order_num='$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";



if($if_order_msg == '1'||$if_order_msg_admin == '1'){
	/** include "../../admin/sms/class.sms.php";
	$SMS = new SMS;
	$SMS->SMS_Login($sms_user,$sms_passwd);	**/
	
	if($paymethod == 'byonline') $pay_type_str = "결제:무통장";
	else if($paymethod == 'byaccount') $pay_type_str = "결제:계좌이체";
	else $pay_type_str = "결제:카드";
	
	
	if($if_order_msg == '1'){
	
		$callback = "$callback_num1$callback_num2$callback_num3";		
		$order_msg = str_replace('[SHOP_NAME]',$mart_name,$order_msg); 
		$order_msg = str_replace('[MEM_NAME]',$name,$order_msg); 
		$order_msg = str_replace('[PAY_TYPE]',$pay_type_str,$order_msg); 
		$sms_client_num = str_replace('-','',$buyer_tel1); 
			
		/*
		echo "callback=$callback <br>";
		echo "join_msg=$join_msg <br>";
		echo "sms_client_num=$sms_client_num <br>";
		*/
		//$SMS->Add($sms_client_num,"$callback","$mart_name","$order_msg","");	// sms 설정
	}	
	
	if($if_order_msg_admin == '1'){
	
		$callback = "$callback_num1$callback_num2$callback_num3";		
		$admin_num = "$admin_num1$admin_num2$admin_num3";
		$order_msg_admin = str_replace('[SHOP_NAME]',$mart_name,$order_msg_admin); 
		$order_msg_admin = str_replace('[MEM_NAME]',$name,$order_msg_admin); 
		$order_msg_admin = str_replace('[PAY_TYPE]',$pay_type_str,$order_msg_admin); 
		/*	
		echo "callback=$callback <br>";
		echo "admin_num=$admin_num <br>";
		echo "join_msg_admin=$join_msg_admin <br>";
		*/
		//$SMS->Add($admin_num,"$callback","$mart_name","$order_msg_admin","");	 // sms 설정
	}
	
	/**$result = $SMS->Send();
	if ($result) {
		//echo "SMS 서버에 접속했습니다.<br>";
		$success = $fail = 0;
		foreach($SMS->Result as $result) {
			list($phone,$code)=explode(":",$result);
			if ($code=="Error") {
				//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
				$fail++;
			} else {
				//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
				$success++;
			}
		}
		//echo $success.'건을 전송했으며'.$fail.'건을 보내지 못했습니다.';
		$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
	}
	else echo "에러: SMS 서버와 통신이 불안정합니다.<br>"; **/
}

// 결재 정보
if($mart_id == 'wj564283')
	echo "<meta http-equiv='refresh' content='0; URL=order_ok.php?mart_id=$mart_id'>";
	
if($paymethod == 'byonline')
	echo "<meta http-equiv='refresh' content='0; URL=order_ok.php?mart_id=$mart_id'>";
if($paymethod == 'bycard'){ //아이캐시
	echo "<meta http-equiv='refresh' content='0; URL=./order_icash.php?mart_id=$mart_id&iTotalAmt=$mon_tot_freight&purchase_no=$order_num'>";
}

if($paymethod == 'by_telec_account'){
	$cur_dir = dirname($SCRIPT_NAME);
	echo ("
	<script>
	function OpenWin(url, ShopID,  OrderID, Amount, Name, Ret_URL){ 
		var R_URL=url+'?ShopID='+ShopID+'&OrderID='+OrderID+'&Amount='+Amount +'&Name='+Name +'&Ret_URL='+escape(Ret_URL);
		window.open(R_URL, 'Window', 'width=600,height=500,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes');
	}	
	</script>
	");
	echo ("
	<script>
		OpenWin('https://www.telec.co.kr/order/telecbank.jsp', '$telec_id', '$order_num', '$mon_tot_freight', '$name', 'http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id')
	</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=order_account_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'byesignpay'){
	echo ("
	<script>
	function OpenWin(url, ShopID,  OrderID, Amount, Name, E_mail, Phone, Ret_URL){ 
		var R_URL=url+'?ShopID='+ShopID+'&OrderID='+OrderID+'&Amount='+Amount +'&Name='+Name +'&E_mail='+E_mail +'&Phone='+Phone +'&Ret_URL='+escape(Ret_URL);
		window.open(R_URL, 'Window', 'width=505,height=540,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes');
	}	
	</script>
	");
	$cur_dir = dirname($SCRIPT_NAME);
	echo ("
	<script>
		OpenWin('esignpay.php', '$esignpay_id', '$order_num', '$mon_tot_freight', '$name', '$email', '$buyer_tel', 'http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id')
	</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=order_ok.php?mart_id=$mart_id'>";
}
if($paymethod == 'byprepay'){
	$cur_dir = dirname($SCRIPT_NAME);
	$RecognPage = urlencode("http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id&if_prepay=ok");
	$ErrorPage = urlencode("http://$HTTP_HOST$cur_dir/order_fail.php?mart_id=$mart_id");
	$OrderAddr = $address.' '.$address_d;
	$BrandName = $item_name;
	echo "<meta http-equiv='refresh' content='0; URL=../prepay/request.php?mart_id=$mart_id&SHOPCODE=$prepay_id&OrderAddr=$OrderAddr&BrandName=$BrandName&RecognPage=$RecognPage&ErrorPage=$ErrorPage&OrderNo=$order_num&Amount=$mon_tot_freight&OrderName=$name&OrderTelNo=$buyer_tel'>";
}
if($paymethod == 'byallthegate'){
	$cur_dir = dirname($SCRIPT_NAME);
	echo ("
	<script>
	PgUrl = 'http://www.allthegate.com/enduser/cCreditInputKovan.jsp';
	PgUrl = PgUrl + '?retailer_id=' + '$allthegate_id';
	PgUrl = PgUrl + '&txtCustNo='	+ '$name' ;
	PgUrl = PgUrl + '&order_no='	+ '$order_num' ;
	PgUrl = PgUrl + '&deal_won='	+ '$mon_tot_freight' ;
	PgUrl = PgUrl + '&cat_id='	+ '9000400001' ;
	PgUrl = PgUrl + '&rtnUrl='		+ 'http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id' ;
	PgUrl = PgUrl + '&cancelUrl='	+ 'http://$HTTP_HOST$cur_dir/order_cancel.php?mart_id=$mart_id' ;
	PgUrl = PgUrl + '&failedUrl='	+ 'http://$HTTP_HOST$cur_dir/order_fail.php?mart_id=$mart_id' ;
	PgUrl = PgUrl + '&OrderName='	+ '$name' ;
	PgUrl = PgUrl + '&OrderContact='	+ '$buyer_tel' ;
	PgUrl = PgUrl + '&OrderEtc='	+ 'etc' ;
	PgUrl = PgUrl + '&DeliveryName='+ '$receiver' ;
	PgUrl = PgUrl + '&DeliveryTel='	+ '$rev_tel' ;
	PgUrl = PgUrl + '&DeliveryAddr='+ '$address $address_d' ;
  PgUrl = PgUrl + '&Email='+ '$email' ;
  PgUrl = PgUrl + '&GoodsName='+ '$item_name' ;

	window.open(PgUrl, 'payfee','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=600,top=0,left=0');
</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=order_card_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'by_allthegate_account'){
	$cur_dir = dirname($SCRIPT_NAME);
	echo ("
	<script>
	PgUrl = 'http://www.allthegate.com/enduser/cFingerPay.jsp';
	PgUrl = PgUrl + '?retailer_id=' + '$allthegate_id';
	PgUrl = PgUrl + '&txtCustNo='	+ '$name' ;
	PgUrl = PgUrl + '&order_no='	+ '$order_num'  ;
	PgUrl = PgUrl + '&deal_won='	+ '$mon_tot_freight' ;
	PgUrl = PgUrl + '&rtnUrl='		+ 'http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id' ;
	PgUrl = PgUrl + '&zuminNo2='	+ '$passport2' ;
	PgUrl = PgUrl + '&cancelUrl='	+ 'http://$HTTP_HOST$cur_dir/order_account_cancel.php?mart_id=$mart_id' ;
	PgUrl = PgUrl + '&DeliveryName='+ '$receiver' ;
	PgUrl = PgUrl + '&DeliveryTel='	+ '$rev_tel' ;
	PgUrl = PgUrl + '&DeliveryAddr='+ '$address $address_d' ;
PgUrl = PgUrl + '&failedUrl='	+ 'http://$HTTP_HOST$cur_dir/order_account_fail.php?mart_id=$mart_id' ;
	
	window.open(PgUrl, 'window','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=465,height=600,top=80,left=280');
	</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=order_account_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'bytgcorp'){
	$date = date("YmdHis");
	$name = urlencode($name);
	$item_name = urlencode($item_name);
	echo ("
	<script>
	var MXID = '$tgcorp_id';
var MXOTP = '$tgcorp_pw';
var MXISSUENO = '$mart_id!$order_num';
var MXISSUEDATE = '$date';
var AMOUNT = '$mon_tot_freight';
var CURRENCY = 'KRW';
var URL = '$HTTP_HOST';
var DBPATH = '/autocart/tgcorp/dbpath.php';
var REDIRPATH = '/autocart/market/cart/order_tg_card_result.php';
var VERSION = '1';
var CCMODE = '11';
var MSTR = '$mart_id';
var SMODE = '3001';
var CcNameOnCard = '$name';
var CcProdDesc = '$item_name';
 

var data = 'MxID=' + MXID + '&MxOTP=' + MXOTP + '&MxIssueNO=' + MXISSUENO;
data = data + '&MxIssueDate=' + MXISSUEDATE+ '&Amount=' + AMOUNT;
data = data + '&Currency=' + CURRENCY+ '&URL=' + URL;
data = data + '&DBPATH=' + DBPATH+ '&REDIRPATH=' + REDIRPATH;
data = data + '&CcMode=' + CCMODE;
data = data + '&VERSION=' + VERSION + '&MSTR=' + MSTR;
data = data + '&Smode=' + SMODE;
data = data + '&CcNameOnCard=' + CcNameOnCard + '&CcProdDesc=' + CcProdDesc; 

  redirection = 'https://npg.tgcorp.com/dlp/auready.jsp'+ '?' +  data;
window.open(redirection, 'Window', 'resizable=yes, width=500, height=470');
</script>
");
echo "<meta http-equiv='refresh' content='0; URL=order_card_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'by_tg_account'){
	$date = date("YmdHis");
	$passport = str_replace('-','',$passport);
	
	if(strlen($item_name) > 5){
	$item_name = substr($item_name, 0, 5);
		preg_match('/^([\x00-\x7e]|.{2})*/', $item_name, $item_name_tmp);
		$item_name = $item_name_tmp[0];
	}
	$name = urlencode($name);
	$item_name = urlencode($item_name);
	$receiver = urlencode($receiver);
	$address = urlencode($address);
	$address_d = urlencode($address_d);
	
	echo "
<SCRIPT>
	var MXID = '$tgcorp_id';
var MXOTP = '$tgcorp_pw';
var MXISSUENO = '$mart_id!$order_num';
var MXISSUEDATE = '$date';
var AMOUNT = '$mon_tot_freight';
var CURRENCY = 'KRW';
var URL = '$HTTP_HOST';
var DBPATH = '/autocart/tgcorp/dbpath.php';
var REDIRPATH = '/autocart/market/cart/order_tg_account_result.php';
var VERSION = '1';
var CCMODE = '10';
var MSTR = '$mart_id';
var SMODE = '2401';
	var CCNAMEONCARD = '$name';
	var PRODNAME = '$item_name';
	var CCUSERMAIL = '$email';
	var CCUSERPHONE = '$buyer_tel';
	var CCUSERMPHONE = '$buyer_tel1';
	var NAME = '$receiver';
	var EMAIL = '$email';
	var PHONE = '$rev_tel';
	var PHONENO = '$rev_tel1';
	var ADDR = '$address $address_d';
	var MXBIZNO = '$passport';
	var MXURI = '$HTTP_HOST';

	var data = 'MxID=' + MXID + '&MxOTP=' + MXOTP + '&MxIssueNO=' + MXISSUENO;
	data = data + '&MxIssueDate=' + MXISSUEDATE+ '&Amount=' + AMOUNT;
	data = data + '&Currency=' + CURRENCY+ '&URL=' + URL;
	data = data + '&DBPATH=' + DBPATH+ '&REDIRPATH=' + REDIRPATH;
	data = data + '&VERSION=' + VERSION + '&MSTR=' + MSTR + '&CcMode=' + CCMODE;
data = data + '&Smode=' + SMODE + '&CcNameOnCard=' + CCNAMEONCARD + '&CcProdDesc=' + PRODNAME;
data = data + '&CcUserMail=' + CCUSERMAIL + '&CcUserPhone=' + CCUSERPHONE;
data = data + '&Name=' + NAME + '&Email=' + EMAIL + '&CcUserMPhone=' + CCUSERMPHONE;
data = data + '&Phone=' + PHONE + '&PhoneNO=' + PHONENO + '&Addr=' + ADDR;
data = data + '&MxBizNO=' + MXBIZNO + '&MxURI=' + MXURI + '&ProdName=' +PRODNAME;
	redirection = 'https://npg.tgcorp.com/dlp/auready.jsp'+ '?' +  data;
	window.open(redirection, 'Window', 'resizable=yes, width=520, height=470');
</SCRIPT>
  ";
  echo "<meta http-equiv='refresh' content='0; URL=order_account_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'by_dacom_card'){
	$cur_dir = dirname($SCRIPT_NAME);
	echo "
	<script language = 'javascript'>
	<!--
	function openWindow()
	{
	window.open('','Window','width=470, height=500, menubar=no, status, scrollbars');
		document.mainForm.action='http://pg.dacom.net:7080/card/cardAuthAppInfo.jsp';
		/*테스트용 결제창 URL http://pg.dacom.net:7080/card/cardAuthAppInfo.jsp;
		Test ID로 테스트시 테스트용 URL로 테스트 하셔야 합니다.
		실제 : http://pg.dacom.net/card/cardAuthAppInfo.jsp
		*/
		document.mainForm.target = 'Window';
		document.mainForm.submit();
	}
	//-->
	</script>
	<form name='mainForm' method='POST' action=''>
	<!-- 결제를 위한 필수 hidden정보 -->
	<input type='hidden' name='mid' value='$dacom_id'>
	<input type='hidden' name='oid' value='$order_num'>
	<input type='hidden' name='amount' value='$mon_tot_freight'>
	<input type='hidden' name='ret_url' value='http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id'><!-- 팝업창 사용 -->
	<input type='hidden' name='buyer' value='$name'>
	<input type='hidden' name='productinfo' value='$item_name'>
	</form>
	<script>
	openWindow()
	</script>
	";
	echo "<meta http-equiv='refresh' content='0; URL=order_card_ing.php?mart_id=$mart_id'>";
}
if($paymethod == 'by_dacom_account'){
	$cur_dir = dirname($SCRIPT_NAME);
	$passport = $passport1.$passport2;
	echo "
	<script language = 'javascript'>
	<!--
	function openWindow()
	{
		window.open('', 'Window', 'width=510, height=700, scrollbars');
		document.mainForm.action= 'http://pg.dacom.net:7080/transfer/transferSelectBank.jsp';
	 /*테스트용 결제창 URL http://pg.dacom.net:7080/transfer/transferSelectBank.jsp;
	테스트 시에는 테스트 ID를 테스트용 URL에 링크를 걸어 사용하셔야 합니다.
	실제: http://pg.dacom.net/transfer/transferSelectBank.jsp*/

document.forms[0].target = 'Window';
document.forms[0].submit();
	}
	//-->
	</script>
	<form name='mainForm' method='POST' action=''>
	<!-- 결제를 위한 필수 hidden정보 -->
	<input type='hidden' name='mid' value='$dacom_id'>
	<input type='hidden' name='oid' value='$order_num'>
	<input type='hidden' name='amount' value='$mon_tot_freight'>
	<input type='hidden' name='ret_url' value='http://$HTTP_HOST$cur_dir/order_ok.php?mart_id=$mart_id'><!-- 팝업창 사용시 -->
	<input type='hidden' name='buyer' value='$name'>
	<input type='hidden' name='pid' value='$passport'>
	<input type='hidden' name='productinfo' value='$item_name'>
	</form>
	<script>
	openWindow()
	</script>
	";
	echo "<meta http-equiv='refresh' content='0; URL=order_account_ing.php?mart_id=$mart_id'>";
}				 
?>
<?
mysql_close($dbconn);
?>