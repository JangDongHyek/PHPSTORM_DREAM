<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
include( '../include/getmartinfo.php' );

if($mode == "del"){
	$SQL = "delete from $Order_ProTable where order_pro_no='$order_pro_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
if($mode == "cart_del"){
	$SQL = "delete from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$order_num = "";
	//session_unregister("order_num");
	unset($_SESSION["order_num"]);
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
if($mode == "update"){
	for($i=0; $i<count($quantity); $i++){
		$SQL = "select item_no, quantity from $Order_ProTable where mart_id='$mart_id' and order_pro_no='$order_pro_no[$i]' and status='0'";
		$dbresult = mysql_query($SQL, $dbconn);
		$item_no_in_order = mysql_result($dbresult,0,0);
		$quantity_prev = mysql_result($dbresult,0,1);
		
		$SQL = "select jaego_use,jaego from $ItemTable where item_no='$item_no_in_order'";
		$dbresult = mysql_query($SQL, $dbconn);
		$jaego_use = mysql_result($dbresult,0,0);
		$jaego = mysql_result($dbresult,0,1);
	 	if($jaego_use == '1' && $quantity[$i] > $quantity_prev && $quantity[$i] > $jaego){
			echo "
			<script>
			alert(\"재고량을 초과하여 입력하셨습니다. $jaego 이하로 입력하세요.\");
			history.go(-1);
			</script>
			";
		}else{	
			$SQL = "update $Order_ProTable set quantity='$quantity[$i]' where mart_id='$mart_id' and order_pro_no='$order_pro_no[$i]' and status='0'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
	}
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
if($mode == "coupon_update"){
	if($cpntype == '1') //정률
		$SQL = "update $Order_ProTable set z_price = z_price - (z_price*($rate/100)), coupon_used='1', cpntype='$cpntype', rate='$rate' where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no_forcash'";
	if($cpntype == '2') //정액
		$SQL = "update $Order_ProTable set z_price = z_price - $rate, coupon_used='1', cpntype='$cpntype', rate='$rate'  where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no_forcash'";
	if($cpntype == '3'){ //사은품
		$SQL = "update $Order_ProTable set cpntype='$cpntype', rate='$rate' where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no_forcash'";
	}
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
?>
<?
/*function mtime(){ 
  $time = explode( " ", microtime()); 
  $usec = (double)$time[0]; 
  $sec = (double)$time[1]; 

  return number_format(($sec + $usec)*1000000, 0, '.', ''); 
}
*/
function mtime(){ 
	$time = date("YmdHis"); 
	$date = date("ms");
	$date1 =  rand(0, $date-1);
	return $time."-".$date1;
	//return number_format($time."-".$date1, 0, '.', ''); 
}

$SQL = "select read_num from $ItemTable where item_no='$item_no'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows == 0){
	echo ("
	<script>
	alert(\"\\n해당하는 제품번호의 제품이 존재하지 않습니다.\\n\\n관리자에게 문의하여 주세요.\");
	history.go(-1);
	</script>
	");
	exit;
}
$read_num = mysql_result($dbresult, 0, 0);
if($read_num == "") $read_num = 0;
$SQL = "update $ItemTable set read_num = $read_num + 1 where item_no = $item_no";
$dbresult = mysql_query($SQL, $dbconn);

$SQL = "select * from $ItemTable where item_no = $item_no";
$dbresult = mysql_query($SQL, $dbconn);
$opt = mysql_result($dbresult, 0, "opt");
$use_opt23 = mysql_result($dbresult, 0, "use_opt23");
$opts = explode("=",$opt);

if($flag == "addorder"){
	
	$category_date = date("Y-m-d H:i:s");
	
	$cur_date = date("Ymd");
	
	if(!empty($opt1))	$opt = $opt1;
	else $opt = "";
		
	if(!empty($opt2))	$opt = $opt."!".$opt2;
	else $opt = $opt."!";
	
	if(!empty($opt3))	$opt = $opt."!".$opt3;
	else $opt = $opt."!";

	
	$SQL = "select * from $ItemTable where item_no=$item_no";
	$dbresult = mysql_query($SQL, $dbconn);
	$provider_id = mysql_result($dbresult, 0, "provider_id");
	$provide_price = mysql_result($dbresult, 0, "provide_price");
					
	if($order_num){
		$order_sql = "select * from $Order_BuyTable where order_num='$order_num'";
		$order_res = mysql_query($order_sql, $dbconn);
		$order_tot = mysql_num_rows($order_res);
		if ($order_tot > 0) {
			$order_num = "";
		}
	}
	if (!isset($order_num) || $order_num=="") {
		$order_num = mtime();
		//$order_num = "$mart_id"."$order_num";
		$order_num = $order_num;		// 주문번호생성
	}
	//session_register("order_num");
	$_SESSION["order_num"] = $order_num;

	$SQL = "select order_pro_no, quantity from $Order_ProTable where order_num='$order_num' and mart_id='$mart_id' and item_no='$item_no' and opt='$opt' and status = '0'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if ($numRows > 0) {
		$order_pro_no = mysql_result($dbresult, 0,"order_pro_no");
		$quantity_prev = mysql_result($dbresult, 0,"quantity");
		
		$SQL = "update $Order_ProTable set quantity = $quantity_prev+$quantity where mart_id='$mart_id' and order_pro_no = $order_pro_no and status = '0'";
		$dbresult = mysql_query($SQL, $dbconn);
	}else{
		if($bonus_ok == 'f') $bonus = 0;
		$SQL = "insert into $Order_ProTable (order_num, mart_id, item_no, item_name, item_code, opt, z_price, quantity, bonus, use_bonus, status, date, provider_id, provide_price) values ('$order_num', '$mart_id', $item_no, '$item_name', '$item_code', '$opt', $z_price, $quantity, $bonus, $use_bonus, '0', '$cur_date', '$provider_id', '$provide_price')";		
		$dbresult = mysql_query($SQL, $dbconn);
	}
	if( $direct_submit_flag == "direct_submit" ){//바로 구매일때
		echo "<meta http-equiv='refresh' content='0; URL=../cart/order.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=../cart/cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag'>";
	}
}elseif($flag == "addestimate"){
	$write_date = date("Ymd H:i:s");
	
	if($provider_id == "") $mart_id_tmp1 = $mart_id;
	else $mart_id_tmp1 = $provider_id;
	
	$SQL = "insert into $EstimateTable (mart_id, item_no, item_name, title, name, email, write_date, content, item_code) values ('$mart_id_tmp1', '$item_no', '$item_name', '$title', '$name', '$email', '$write_date', '$content', '$item_code')";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=../main/product_info.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
}
?>
<?
mysql_close($dbconn);
?>