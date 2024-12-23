<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
include( '../../market/include/getmartinfo.php' );
?>

<?
if( $paymethod == "byonline_point"){
	$account_no = $account_no1;
	$money_sender = $money_sender1;
	$pay_day = $pay_day1;
}

if( $paymethod == "byonline_point" || $paymethod == "bycard_point" || $paymethod == "byaccount_point"  || $paymethod == "bypoint" ){
	$if_use_bonus = "1";
}

if( $paymethod == "bycard_point" ){
	$use_bonus_tot = $use_bonus_tot1;
}
if( $paymethod == "byaccount_point" ){
	$use_bonus_tot = $use_bonus_tot2;
}
if( $paymethod == "bypoint" ){
	$use_bonus_tot = $use_bonus_tot3;
}

if( $paymethod == "bycard" || $paymethod == "bycard_point")
{
	$card_freight = $mon_tot_freight - $use_bonus_tot;
	if($card_freight < $card_limit){
		echo ("
			<script language=javascript>
				alert('카드(실시간계좌이체)결제 금액을 $card_limit 이상으로 해주세요..');
				history.go(-1);
			</script>
		");
		exit;
	}
}
/*
byonline
byonline_point
bycard
bycard_point
byaccount
byaccount_point
bypoint
*/
?>


<?
$date = date("Y-m-d H:i:s");

$SQL = "select order_num from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows=mysql_num_rows($dbresult);
if (mysql_num_rows($dbresult)>0) {
	echo ("
		<script language=javascript>
			alert('이미 존재하는 주문번호입니다.\\n\\n 중복으로 추가될 수 없습니다.');
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/'>";
	exit;
}

if($account_no == 'nobank'){
	$account_no = "0";
}

$use_bonus_tot = str_replace( ",", "", $use_bonus_tot );

$status = "1"; //주문상태 -> 주문

if($use_bonus_tot == $mon_tot_freight)
	$status = "2";

if( !$message ){
	$message = "요청사항 없음";
}

//=============== 임시주문서 내용을 삭제함 ===========================================
$SQL = "delete from $Order_BuyTable_Temp where order_num='$order_num' and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);

//=============== 임시주문서 내용을 입력 ===========================================
$SQL = "insert into  $Order_BuyTable_Temp (index_no, order_num, mart_id, id, name, passport1, passport2, tel1, tel2, email, buyer_zip, buyer_address, buyer_address_d, receiver, rev_tel, rev_tel1, zip, address, address_d, message, paymethod, account_no, status, date, partner, money_sender, pay_day, if_use_bonus, mon_tot, use_bonus_tot, freight_fee, field1, field2, field3, field4, field5,mobile_chk) values ( '', '$order_num', '$mart_id', '$UnameSess', '$name', '$passport1', '$passport2', '$buyer_tel', '$buyer_tel1', '$email', '$buyer_zip', '$buyer_address', '$buyer_address_d', '$receiver', '$rev_tel', '$rev_tel1', '$zip', '$address', '$address_d', '$message', '$paymethod', '$account_no', '$status', '$date', '$partner', '$money_sender', '$pay_day', '$if_use_bonus', '$mon_tot_freight', '$use_bonus_tot','$freight_fee', '$field1', '$field2', '$field3','$field4','$field5','y')";




$dbresult = mysql_query($SQL, $dbconn);

//포인트 사용 (온라인 입금, 포인트 결제)
if( ($paymethod == "byonline_point" || $paymethod == "bypoint") && $UnameSess ){
	$write_date = date("Y-m-d H:i:s");
	$content = $order_num." 구매에 포인트 사용";
	
	$bonus = -$use_bonus_tot;
	$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num', 'u')";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess' and mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
}


if($if_use_bonus == 1){ //포인트 사용시 포인트 만큼 빼 준다.
	$mon_tot_freight = $mon_tot_freight - $use_bonus_tot;
	if($mon_tot_freight == 0){
		//echo "<meta http-equiv='refresh' content='0; URL=order_ok.html?mart_id=$mart_id'>";
		//exit;
	}
}

if($paymethod == "byescro" || $paymethod == "byonline" || $paymethod == "byonline_point" || $paymethod == "bypoint" ){ //무통장입금,포인트결제
	$sql="select * from $Order_ProTable where order_num='$order_num'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	// sms 문자 보내기
	include "../../connect_sms.php";


	$tr_senddate = date("YmdHis");
	$tran_phone = "$buyer_tel1";//받는 사람 번호
	$tran_callback = "051-643-4852";//보내는 사람 번호
	$tran_msg = "$name"."님 주문하신 {$row[item_name]} 결제완료되었습니다.";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone','$tran_callback','1',sysdate(),'$tran_msg')";
	$sms_res=mysql_query( $sms_query, $connect );

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone','$tran_callback','1',sysdate(),'$tran_msg1',curdate())";
	$result2 = mysql_query($all_query,$connect);


	$tr_senddate = date("YmdHis");
	$tran_phone = "010-4885-5818";//받는 사람 번호
	$tran_callback = "051-643-4852";//보내는 사람 번호
	$tran_msg = "$name"."님이 주문하신 {$row[item_name]} 주문하였습니다.\n결제금액:".number_format($mon_tot_freight)."원";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone','$tran_callback','1',sysdate(),'$tran_msg')";
	$sms_res=mysql_query( $sms_query, $connect );

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone','$tran_callback','1',sysdate(),'$tran_msg1',curdate())";
	$result2 = mysql_query($all_query,$connect);


	$tr_senddate = date("YmdHis");
	$tran_phone = "010-8545-5813";//받는 사람 번호
	$tran_callback = "051-643-4852";//보내는 사람 번호
	$tran_msg = "$name"."님이 주문하신 {$row[item_name]} 주문하였습니다.\n결제금액:".number_format($mon_tot_freight)."원";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone','$tran_callback','1',sysdate(),'$tran_msg')";
	$sms_res=mysql_query( $sms_query, $connect );
	echo "<meta http-equiv='refresh' content='0; URL=order_ok.html?order_num=$order_num&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod'>";
	exit;
}

if($paymethod == 'bycard' || $paymethod == 'bycard_point' ){
	$cur_dir = dirname($SCRIPT_NAME);
		/*if($_SERVER['REMOTE_ADDR']=="183.103.22.103"){
			$url="http://www.gigimonte.co.kr/mobile/cart/innopay.html";
		}else{
			$url="http://www.gigimonte.co.kr/mobile/cart/card_account_xpay.html";
		}*/
		$url="/mobile/cart/innopay.html";
		echo "
			<script language = 'javascript'>
			<!--
			 function OpenWindow_Submit(){ 
			 document.FormA.submit();
			 }
			//-->
			</script>
			<form name='FormA'  method='post' action ='".$url."?order_num=$order_num&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot'>
			<!-- 결제를 위한 필수 hidden정보 -->
			<input type='hidden' name='OrderID' value='$order_num'>
			<input type='hidden' name='Amount' value='$mon_tot_freight'>
			<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok_new.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id'>
			<input type='hidden' name='note_url' value='http://$HTTP_HOST$cur_dir/note_url.php'>


			<input type='hidden' name='Name' value='$name'>
			<input type='hidden' name='email' value='$email'>
			<input type='hidden' name='buyer_tel' value='$buyer_tel'>
			<input type='hidden' name='buyer_tel1' value='$buyer_tel1'>
			<input type='hidden' name='buyer_zip' value='$buyer_zip'>
			<input type='hidden' name='buyer_address' value='$buyer_address'>
			<input type='hidden' name='buyer_address_d' value='$buyer_address_d'>
			<input type='hidden' name='receiver' value='$receiver'>
			<input type='hidden' name='rev_tel' value='$rev_tel'>
			<input type='hidden' name='rev_tel1' value='$rev_tel1'>
			<input type='hidden' name='zip' value='$zip'>
			<input type='hidden' name='address' value='$address'>
			<input type='hidden' name='address_d' value='$address_d'>
			<input type='hidden' name='message' value='$message'>
			<input type='hidden' name='item_name' value='$item_name'>
			<input type='hidden' name='mon_tot_freight' value='$mon_tot_freight'>
			</form>
			<Body Onload='OpenWindow_Submit();'>
		";
}

if($paymethod == 'byaccount' || $paymethod == 'byaccount_point' ){
	$cur_dir = dirname($SCRIPT_NAME);
		
		$url="/mobile/cart/innopay.html";
		echo "
			<script language = 'javascript'>
			<!--
			 function OpenWindow_Submit(){ 
			 document.FormA.submit();
			 }
			//-->
			</script>
			<form name='FormA'  method='post' action ='".$url."?order_num=$order_num&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot'>
			<!-- 결제를 위한 필수 hidden정보 -->
			<input type='hidden' name='OrderID' value='$order_num'>
			<input type='hidden' name='Amount' value='$mon_tot_freight'>
			<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod'>
			<input type='hidden' name='note_url' value='http://$HTTP_HOST$cur_dir/note_url.php'>
			<input type='hidden' name='Name' value='$name'>
			<input type='hidden' name='passport1' value='$passport1'>
			<input type='hidden' name='passport2' value='$passport2'>
			<input type='hidden' name='email' value='$email'>
			<input type='hidden' name='buyer_tel' value='$buyer_tel'>
			<input type='hidden' name='buyer_tel1' value='$buyer_tel1'>
			<input type='hidden' name='buyer_zip' value='$buyer_zip'>
			<input type='hidden' name='buyer_address' value='$buyer_address'>
			<input type='hidden' name='buyer_address_d' value='$buyer_address_d'>
			<input type='hidden' name='receiver' value='$receiver'>
			<input type='hidden' name='rev_tel' value='$rev_tel'>
			<input type='hidden' name='rev_tel1' value='$rev_tel1'>
			<input type='hidden' name='zip' value='$zip'>
			<input type='hidden' name='address' value='$address'>
			<input type='hidden' name='address_d' value='$address_d'>
			<input type='hidden' name='message' value='$message'>
			<input type='hidden' name='item_name' value='$item_name'>
			<input type='hidden' name='item_no' value='$item_no'>
			<input type='hidden' name='mon_tot_freight' value='$mon_tot_freight'>
			</form>
			<Body Onload='OpenWindow_Submit();'>
		";
}
?>
<?
mysql_close($dbconn);
?>
