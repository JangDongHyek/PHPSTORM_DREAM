<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
include( '../../market/include/getmartinfo.php' );

if($mode == "del"){
	$SQL = "delete from $Order_ProTable where order_pro_no='$order_pro_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
if($mode == "del_order"){
	$SQL = "delete from $Order_ProTable where order_pro_no='$order_pro_no' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if($ispoint!="1"){
		echo "<meta http-equiv='refresh' content='0; URL=../cart/order.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag&ispoint=0'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=../cart/order.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag&ispoint=1'>";
	}
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
		$sql = "select opt,opt2,opt3,opt4 from $Order_ProTable where mart_id='$mart_id' and order_pro_no='$order_pro_no[$i]' and status=0";
		$result=mysql_query($sql);
		if(!$result){
			echo mysql_error();
			echo mysql_errno();
			exit;
		}
		$o_rs=mysql_fetch_array($result);
		$opt=$o_rs[0];
		$opt2=$o_rs[1];
		$opt3=$o_rs[2];
		$opt4=$o_rs[3];
		
		$SQL = "select jaego_use,jaego,if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4 from $ItemTable where item_no='$item_no_in_order'";
		$dbresult = mysql_query($SQL, $dbconn);
		$jaego_use = mysql_result($dbresult,0,0);
		$jaego = mysql_result($dbresult,0,1);
		$if_opt_jaego = mysql_result($dbresult,0,2);
		$if_opt_jaego2 = mysql_result($dbresult,0,3);
		$if_opt_jaego3 = mysql_result($dbresult,0,4);
		$if_opt_jaego4 = mysql_result($dbresult,0,5);
		$sql="select opt_name,opt_ea from $OptionTable where item_no='$item_no_in_order' and opt_no='$opt'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		if($opt_ea<$quantity[$i]&&$if_opt_jaego&&$opt){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$sql="select opt_name,opt_ea from $OptionTable2 where item_no='$item_no_in_order' and opt_no='$opt2'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		if($opt_ea<$quantity[$i]&&$if_opt_jaego2&&$opt2){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$sql="select opt_name,opt_ea from $OptionTable3 where item_no='$item_no_in_order' and opt_no='$opt3'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		if($opt_ea<$quantity[$i]&&$if_opt_jaego3&&$opt3){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$sql="select opt_name,opt_ea from $OptionTable4 where item_no='$item_no_in_order' and opt_no='$opt4'";
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		if($opt_ea<$quantity[$i]&&$if_opt_jaego4&&$opt4){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
	 	if($jaego_use == '1' && $quantity[$i] > $quantity_prev && $quantity[$i] > $jaego){
			echo "
			<script>
			alert(\"����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $jaego ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}else{	
			$SQL = "update $Order_ProTable set quantity='$quantity[$i]' where mart_id='$mart_id' and order_pro_no='$order_pro_no[$i]' and status='0'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
	}
	echo "<meta http-equiv='refresh' content='0; URL=cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag'>";
	exit;
}
if($mode == "coupon_update"){
	if($cpntype == '1') //����
		$SQL = "update $Order_ProTable set z_price = z_price - (z_price*($rate/100)), coupon_used='1', cpntype='$cpntype', rate='$rate' where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no_forcash'";
	if($cpntype == '2') //����
		$SQL = "update $Order_ProTable set z_price = z_price - $rate, coupon_used='1', cpntype='$cpntype', rate='$rate'  where order_num = '$order_num' and mart_id = '$mart_id' and item_no='$item_no_forcash'";
	if($cpntype == '3'){ //����ǰ
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
	alert(\"\\n�ش��ϴ� ��ǰ��ȣ�� ��ǰ�� �������� �ʽ��ϴ�.\\n\\n�����ڿ��� �����Ͽ� �ּ���.\");
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
//$opts = explode("=",$opt);

if($flag == "addorder"){
	
	$category_date = date("Y-m-d H:i:s");
	
	$cur_date = date("Ymd");
	$opt=$opt1;
	/*if(!empty($opt1))	$opt = $opt1;
	else $opt = "";
		
	if(!empty($opt2))	$opt = $opt."!".$opt2;
	else $opt = $opt."!";
	
	if(!empty($opt3))	$opt = $opt."!".$opt3;
	else $opt = $opt."!";*/

	
	$SQL = "select * from $ItemTable where item_no=$item_no";
	$dbresult = mysql_query($SQL, $dbconn);
	$provider_id = mysql_result($dbresult, 0, "provider_id");
	$provide_price = mysql_result($dbresult, 0, "provide_price");
	$if_opt_jaego = mysql_result($dbresult, 0, "if_opt_jaego");
	$if_opt_jaego2 = mysql_result($dbresult, 0, "if_opt_jaego2");
	$if_opt_jaego3 = mysql_result($dbresult, 0, "if_opt_jaego3");
	$if_opt_jaego4 = mysql_result($dbresult, 0, "if_opt_jaego4");
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
		$order_num = $order_num;		// �ֹ���ȣ����
	}

	//session_register("order_num");
	if($if_cash!="2"){
		if (!isset($order_num) || $order_num=="") {
			$order_num = mtime();
			//$order_num = "$mart_id"."$order_num";
			$order_num = $order_num;		// �ֹ���ȣ����
		}
	}else{
		if (!isset($order_point_num) || $order_point_num=="") {
			$order_point_num = mtime();
			//$order_num = "$mart_id"."$order_num";
			$order_point_num = $order_point_num;		// �ֹ���ȣ����
		}
	}
	
	$_SESSION["order_num"] = $order_num;
	if($if_cash=="2"){
		$order_point_num="P".str_replace("P","",$order_point_num);
		$_SESSION['order_point_num']=$order_point_num;
		$order_num_value="'$order_point_num'";
		$ispoint="1";
	}else{
		$order_num_value="'$order_num'";
		$ispoint="0";
	}
	$sql = "select * from $OptionTable where opt_no='$opt'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$opt_price=$rs[opt_price];
	$opt_ea=$rs[opt_ea];
	$opt_name=$rs[opt_name];
	
	$sql = "select * from $OptionTable2 where opt_no='$opt2'";
	$result=mysql_query($sql);
	$rs2=mysql_fetch_array($result);
	$opt_price2=$rs2[opt_price];
	$opt_ea2=$rs2[opt_ea];
	$opt_name2=$rs2[opt_name];
	
	$sql = "select * from $OptionTable3 where opt_no='$opt3'";
	$result=mysql_query($sql);
	$rs3=mysql_fetch_array($result);
	$opt_price3=$rs3[opt_price];
	$opt_ea3=$rs3[opt_ea];
	$opt_name3=$rs3[opt_name];
	
	$sql = "select * from $OptionTable4 where opt_no='$opt4'";
	$result=mysql_query($sql);
	$rs4=mysql_fetch_array($result);
	$opt_ea4=$rs4[opt_ea];
	$opt_price4=$rs4[opt_price];
	$opt_name4=$rs4[opt_name];

	$sql = "select * from $OptionTable5 where opt_no='$opt5'";
	$result=mysql_query($sql);
	$rs5=mysql_fetch_array($result);
	$opt_ea5=$rs5[opt_ea];
	$opt_price5=$rs5[opt_price];
	$opt_name5=$rs5[opt_name];

	$sql = "select * from $OptionTable6 where opt_no='$opt6'";
	$result=mysql_query($sql);
	$rs6=mysql_fetch_array($result);
	$opt_ea6=$rs6[opt_ea];
	$opt_price6=$rs6[opt_price];
	$opt_name6=$rs6[opt_name];
	
	if($opt_ea<$quantity&&$if_opt_jaego&&$opt){
		echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
		exit;
	}
	if($opt_ea2<$quantity&&$if_opt_jaego2&&$opt2){
		echo "
			<script>
			alert(\"$opt_name2 ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea2 ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
		exit;
	}
	if($opt_ea3<$quantity&&$if_opt_jaego3&&$opt3){
		echo "
			<script>
			alert(\"$opt_name3 ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea3 ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
		exit;
	}
	if($opt_ea4<$quantity&&$if_opt_jaego4&&$opt4){
		echo "
			<script>
			alert(\"$opt_name4 ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea4 ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
		exit;
	}
	$SQL = "select order_pro_no, quantity from $Order_ProTable where order_num=$order_num_value and mart_id='$mart_id' and item_no='$item_no' and opt='$opt' and opt2='$opt2' and opt3='$opt3' and opt4='$opt4' and status = '0'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if ($numRows > 0) {
		$order_pro_no = mysql_result($dbresult, 0,"order_pro_no");
		$quantity_prev = mysql_result($dbresult, 0,"quantity");
		
		//$SQL = "update $Order_ProTable set quantity = $quantity_prev+$quantity where mart_id='$mart_id' and order_pro_no = $order_pro_no and status = '0'";
		$SQL = "update $Order_ProTable set quantity = $quantity_prev+$quantity where mart_id='$mart_id' and order_pro_no = $order_pro_no and status = '0'";
		$dbresult = mysql_query($SQL, $dbconn);
	}else{
		if($bonus_ok == 'f') $bonus = 0;
		$SQL = "insert into $Order_ProTable (order_num, mart_id, item_no, item_name, item_code, opt, z_price, quantity, bonus, use_bonus, status, date, provider_id, provide_price,opt2,opt3,opt4,opt5,opt6,opt_price,opt_price2,opt_price3,opt_price4,opt_price5,opt_price6,priceKind,ispoint) values ($order_num_value, '$mart_id', $item_no, '$item_name', '$item_code', '$opt', $z_price, $quantity, $bonus, $use_bonus, '0', '$cur_date', '$provider_id', '$provide_price','$opt2','$opt3','$opt4','$opt5','$opt6','$opt_price','$opt_price2','$opt_price3','$opt_price4','$opt_price5','$opt_price6','$priceKind','$ispoint')";	
		$dbresult = mysql_query($SQL, $dbconn);
	}
	if( $direct_submit_flag == "direct_submit" ){//�ٷ� �����϶�
		echo "<meta http-equiv='refresh' content='0; URL=../cart/order.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag&ispoint=$ispoint'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=../cart/cart.html?mart_id=$mart_id&provider_id=$provider_id&item_no=$item_no&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&direct_submit_flag=$direct_submit_flag&ispoint=$ispoint'>";
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
