<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<?
if($flag == "update"){

	//================== 업로드 파일을 불러옴 ================================================
	include "../../upload.php";
	$upload = "$UploadRoot/$mart_id/";
	//================== 첨부 파일을 업로드함 ================================================
	if( $shoplogo_name ){
		$shop_file = FileUploadName( "$shop_logo", "$upload", $shoplogo, $shoplogo_name );//파일을 업로드 함

		$query = "update $MartMngInfoTable set logo='$shop_file' where mart_id='$mart_id'";
		$result = mysql_query( $query, $dbconn );
		if( !$result ){
			echo("
				<script>
				window.alert('파일 업로드에 실패했습니다.');
				history.go(-1)
				</script>
			");
			exit;
		}
	}else{
		$shop_file = $shop_logo;
	}

	$SQL = "update $MartInfoTable set name='$name', shopname='$shopname', passport='$passport', ".
	"email = '$email', tel1 = '$tel1', tel2 = '$tel2', place = '$place' where mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn); 
	
	if($xpay_id && $xpay_key){ //lg u+ 상점아디키,머트키
		$xpay_query=" , xpay_id='$xpay_id', xpay_key='$xpay_key'";
	}

	$SQL = "update $MartMngInfoTable set freight_limit = '$freight_limit', freight_cost = '$freight_cost', 
	card_yes = '$card_yes', shopuser = '$shopuser', pur_limit = '$pur_limit', card_limit = '$card_limit', 
	init_bonus = '$init_bonus', bookmark_bonus_ok='$bookmark_bonus_ok', init_bookmark_bonus='$init_bookmark_bonus', by_cash_bonus_ok='$by_cash_bonus_ok', init_by_cash_bonus='$init_by_cash_bonus', if_union = '$if_union', if_notice = '$if_notice', if_chuchon = '$if_chuchon',
	if_coupon = '$if_coupon', if_receipt = '$if_receipt', if_event = '$if_event', if_community = '$if_community', 
	copyright = '$copyright', if_poll = '$if_poll', page_title = '$page_title', member_confirm = '$member_confirm', 
	user_words = '$user_words', user_words_perm='$user_words_perm', if_quiz = '$if_quiz', account_yes='$account_yes', bonus_ok='$bonus_ok', bonus_auto_ok='$bonus_auto_ok', bonus_auto_percent='$bonus_auto_percent', 
	bonus_limit='$bonus_limit', union_freight_limit = '$union_freight_limit', 
	union_freight_cost = '$union_freight_cost', if_mem_use_pass='$if_mem_use_pass', 
	if_nomem_use_pass='$if_nomem_use_pass', if_use_bottom_img='$if_use_bottom_img', if_member_price='$if_member_price',
	member_price_percent='$member_price_percent', if_customer_price='$if_customer_price' $xpay_query where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn); 
	
	
	$SQL = "select * from $BankTable where mart_id='$mart_id' order by account_no";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "쿼리 실행 실패!";
	$numRows = mysql_num_rows($dbresult);
	for ($i=0; $i < $numRows; $i++) {	
		mysql_data_seek($dbresult,$i);
		$ary = mysql_fetch_array($dbresult);
		$account_no = $ary["account_no"];	
		
		$SQL = "update $BankTable set bank_name = '$bank_name[$i]', bank_number = '$bank_number[$i]', ".
		"owner_name = '$owner_name[$i]' where account_no = $account_no  and mart_id='$mart_id'";

		$dbresult_1 = mysql_query($SQL, $dbconn); 
	}
	echo "<meta http-equiv='refresh' content='0; URL=main_setting.php'>";
}else if( $flag == "insert" ){
	//$sql0 = "insert into";
}

mysql_close($dbconn);
?>