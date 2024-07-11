<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
include "../include/getmartinfo.php";
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
	$new_use_bonus_tot = $use_bonus_tot = $use_bonus_tot1;
}
if( $paymethod == "byaccount_point" ){
	$new_use_bonus_tot = $use_bonus_tot = $use_bonus_tot2;
}
if( $paymethod == "bypoint" ){
	$new_use_bonus_tot = $use_bonus_tot = $use_bonus_tot3;
}

if( $paymethod == "bycard_point" || $paymethod == "byaccount_point")
{
	$use_bonus_tot += $old_use_bonus_tot;
}

if( $paymethod == "bycard" || $paymethod == "bycard_point")
{
	$card_freight = $mon_tot_freight - $use_bonus_tot;
	if($card_freight < $card_limit){
		echo ("
			<script language=javascript>
				alert('카드(계좌이체)결제 금액을 $card_limit 이상으로 해주세요..');
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

if($account_no == 'nobank'){
	$account_no = "0";
}

$use_bonus_tot = str_replace( ",", "", $use_bonus_tot );

// 온라인입금 정보만 변경일때
if($paymethod == "byonline")
{
	$SQL = "update $Order_BuyTable set account_no='$account_no', money_sender='$money_sender', pay_day='$pay_day' where order_num = '$order_num_query' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=order_view.html?mart_id=$mart_id&order_num_query=$order_num_query'>";
	exit;
}

if(($paymethod == "byonline_point" || $paymethod == "bypoint") && $UnameSess)
{
	$SQL = "select * from $BonusTable where order_num = '$order_num_query' and mart_id = '$mart_id' and id = '$UnameSess' and mode='u'";
	$dbresult = mysql_query($SQL, $dbconn);
	if(!mysql_num_rows($dbresult))
	{
		$write_date = date("Ymd H:i:s");
		$content = $order_num." 구매에 포인트 사용";
	
		$bonus = -$use_bonus_tot;
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num_query', 'u')";
		$dbresult = mysql_query($SQL, $dbconn);
	
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
}

$status = "1";

if(($use_bonus_tot+$old_use_bonus_tot) == $mon_tot_freight)
	$status = "2";

if($paymethod == "byonline_point" || $paymethod == "bypoint")
{
	$SQL = "update $Order_BuyTable set account_no = '$account_no', money_sender='$money_sender', pay_day='$pay_day', use_bonus_tot = use_bonus_tot + '$use_bonus_tot', paymethod='$paymethod', if_use_bonus='$if_use_bonus' where order_num = '$order_num_query' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL = "update $Order_ProTable set status='$status' where order_num='$order_num_query' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $BonusTable set bonus = bonus - '$use_bonus_tot' where order_num = '$order_num_query' and mart_id = '$mart_id' and id = '$UnameSess' and mode='u'";
	$dbresult = mysql_query($SQL, $dbconn);

	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - '$use_bonus_tot' where mart_id = '$mart_id' and username = '$UnameSess'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=order_view.html?mart_id=$mart_id&order_num_query=$order_num_query'>";
	exit;
}

if($if_use_bonus == 1){ //포인트 사용시 포인트 만큼 빼 준다.
	$mon_tot_freight = $mon_tot_freight - $use_bonus_tot;
}

// 임시 테이블에 다시 입력
if( $paymethod == "bycard" || $paymethod == "byaccount")
{
	$SQL = "insert into  $Order_BuyTable_Temp (select * from $Order_BuyTable where order_num='$order_num_query' and mart_id='$mart_id')";
	$dbresult = mysql_query($SQL, $dbconn);
	$SQL = "update $Order_BuyTable_Temp set paymethod='$paymethod', if_use_bonus='$if_use_bonus' where order_num = '$order_num_query' and mart_id = '$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
}

if( $paymethod == "bycard_point" || $paymethod == "byaccount_point")
{
	$SQL = "insert into  $Order_BuyTable_Temp (select * from $Order_BuyTable where order_num='$order_num_query' and mart_id='$mart_id')";
	$dbresult = mysql_query($SQL, $dbconn);
	$SQL = "update $Order_BuyTable_Temp set use_bonus_tot = $use_bonus_tot, paymethod='$paymethod', if_use_bonus='$if_use_bonus' where order_num = '$order_num_query' and mart_id = '$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn);
}

if( $paymethod == "bycard" || $paymethod == "bycard_point" )
{
	$cur_dir = dirname($SCRIPT_NAME);
	
	echo "
		<script language = 'javascript'>
		<!--
		 function OpenWindow_Submit(){ 
		 document.FormA.submit();
		 }
		//-->
		</script>
		<form name='FormA'  method='post' action ='./card_update.html?order_num=$order_num_query'>
		<!-- 결제를 위한 필수 hidden정보 -->
		<input type='hidden' name='mart_id' value='$mart_id'>
		<input type='hidden' name='order_num_query' value='$order_num_query'>
		<input type='hidden' name='Amount' value='$mon_tot_freight'>
		<input type='hidden' name='item_name' value='$item_name'>
		<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id'>		
		<input type='hidden' name='mon_tot_freight' value='$mon_tot_freight'>
		</form>
		<Body Onload='OpenWindow_Submit();'>
	";
}

if( $paymethod == "byaccount" || $paymethod == "byaccount_point")
{
	$cur_dir = dirname($SCRIPT_NAME);
	
	echo "
		<script language = 'javascript'>
		<!--
		 function OpenWindow_Submit(){ 
		 document.FormA.submit();
		 }
		//-->
		</script>
		<form name='FormA'  method='post' action ='./card_update.html?order_num=$order_num_query'>
		<!-- 결제를 위한 필수 hidden정보 -->
		<input type='hidden' name='mart_id' value='$mart_id'>
		<input type='hidden' name='order_num_query' value='$order_num_query'>
		<input type='hidden' name='Amount' value='$mon_tot_freight'>
		<input type='hidden' name='item_name' value='$item_name'>
		<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id'>		
		<input type='hidden' name='mon_tot_freight' value='$mon_tot_freight'>
		</form>
		<Body Onload='OpenWindow_Submit();'>
	";
}

//$SQL = "update $Order_ProTable set status='1' where order_num='$order_num' and mart_id='$mart_id'";
//$dbresult = mysql_query($SQL, $dbconn);
//if ($dbresult == false) echo "쿼리 실행 실패!";

/*if( $dbresult ){ // 정상적으로 주문이 이루어 졌을 때 SMS 전송
	//================== SMS 전송 ========================================================
	//================== DB 설정 파일을 불러옴 ===========================================
	include "../../connect_sms.php";

	//================== 고객에게 sms를 보냄 =============================================
	$tr_senddate = date("YmdHis");
	$tran_phone = "$buyer_tel1";//받는 사람 번호
	$tran_callback = "$shop_tel";//보내는 사람 번호
	$tran_msg = "$name"."님 주문이 이루어졌습니다.주문번호는 "."$order_num"."입니다[$mart_id]";

	$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
	$sms_res = mysql_query( $sms_sql, $connect );

	if( !$sms_res ){
		echo "
		<script>
			alert('문자 전송 실패');
		</script>
		";
	}

	//================== 최종관리자에게 sms를 보냄 =======================================
	$tr_senddate = date("YmdHis");
	$tran_phone1 = "010-3198-5678";//받는 사람 번호
	$tran_callback1 = "$shop_tel";//보내는 사람 번호
	$tran_msg1 = "$name"."님이 상품을 주문했습니다.주문번호는 "."$order_num"."입니다[$mart_id]";

	$sms_sql1 = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone1', '$tran_callback1', '1', sysdate(), '$tran_msg1' )";
	$sms_res1 = mysql_query( $sms_sql1, $connect );

	//================== 입점몰에게 sms를 보냄 ===========================================
	//================== 입점몰 정보를 불러옴 ============================================
	$p_sql = "select provider_id from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id'";
	$p_res = mysql_query($p_sql, $dbconn);

	while( $p_row = mysql_fetch_array($p_res) ){		
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$p_row[provider_id]'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone2 = "$pro_phon";//받는 사람 번호
		$tran_callback2 = "$shop_tel";//보내는 사람 번호
		$tran_msg2 = "$name"."님이 상품을 주문했습니다.주문번호는 "."$order_num"."입니다[$mart_id]";

		$sms_sql2 = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone2', '$tran_callback2', '1', sysdate(), '$tran_msg2' )";
		$sms_res2 = mysql_query( $sms_sql2, $connect );
	}
	if( !$sms_res2 ){
		echo "
		<script>
			alert('문자 전송 실패');
		</script>
		";
	}
	//====================================================================================
}*/
?>
<?
mysql_close($dbconn);
?>