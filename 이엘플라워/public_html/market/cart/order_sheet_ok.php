<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
include "../include/getmartinfo.php";
include "../../include/kakao.class.php";

if($ispoint=="1"){
	$whereChange="order_num='$order_point_num'";
	$order_num2=$_SESSION[order_point_num];
}else{
	$whereChange="order_num='$order_num'";
	$order_num2=$order_num;
}
$sql="select * from $Order_ProTable where $whereChange";
$result=mysql_query($sql);
$totalQuantity=0;
$totalEA=0;
$i=0;
while($rs=mysql_fetch_array($result)){
	$totalEA+=$i;
	$quantity=$rs[quantity];
	$totalQuantity+=$quantity;
	$item_no2=$rs[item_no];
	$sql="select * from $ItemTable where item_no='$item_no2'";
	$result2=mysql_query($sql);
	$rs2=mysql_fetch_array($result2);
	$item_no=$rs2[item_no];
	$jaego_use=$rs2[jaego_use];
	$jaego=$rs2[jaego];
	$opt=$rs[opt];
	$opt2=$rs[opt2];
	$opt3=$rs[opt3];
	$opt4=$rs[opt4];
	$if_opt_jaego=$rs2[if_opt_jaego];
	$if_opt_jaego2=$rs2[if_opt_jaego2];
	$if_opt_jaego3=$rs2[if_opt_jaego3];
	$if_opt_jaego4=$rs2[if_opt_jaego4];
	if($jaego==0&&$jaego_use=="1"){
		echo "
			<script>
			alert(\"�˼��մϴ�. ���� ��ǰ�� ��� �����ϴ�.\");
			history.go(-1);
			</script>
			";
			exit;
	}
	if($jaego<$quantity&&$jaego_use=="1"&&$jaego){
		echo "<script language='javascript'>";
		echo "alert('����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $jaego�� ���Ϸ� �����Ͻ� �� �����Ͻñ� �ٶ��ϴ�.');";
		echo "history.go(-1);";
		echo "</script>";
		exit;
	}
		$sql="select opt_name,opt_ea from $OptionTable where item_no='$item_no2' and opt_no='$opt'";
		$result3=mysql_query($sql);
		$rs3=mysql_fetch_array($result3);
		$opt_ea=$rs3[opt_ea];
		$opt_name=$rs3[opt_name];
		
		if($opt_ea<$quantity&&$if_opt_jaego&&$rs3[opt]){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$sql="select opt_name,opt_ea from $OptionTable2 where item_no='$item_no2' and opt_no='$opt2'";
		
		$result3=mysql_query($sql);
		$rs3=mysql_fetch_array($result3);
		$opt_ea=$rs3[opt_ea];
		$opt_name=$rs3[opt_name];
		
		if($opt_ea<$quantity&&$if_opt_jaego2&&$rs3[opt2]){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		
		$sql="select opt_name,opt_ea from $OptionTable3 where item_no='$item_no2' and opt_no='$opt3'";
		$result3=mysql_query($sql);
		$rs3=mysql_fetch_array($result3);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		
		if($opt_ea<$quantity&&$if_opt_jaego3&&$rs3[opt3]){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$sql="select opt_name,opt_ea from $OptionTable4 where item_no='$item_no2' and opt_no='$opt4'";
		$result4=mysql_query($sql);
		$rs4=mysql_fetch_array($result4);
		$opt_ea=$rs[opt_ea];
		$opt_name=$rs[opt_name];
		
		if($opt_ea<$quantity&&$if_opt_jaego4&&$rs3[opt4]){
			echo "
			<script>
			alert(\"$opt_name ����� �ʰ��Ͽ� �Է��ϼ̽��ϴ�. $opt_ea ���Ϸ� �Է��ϼ���.\");
			history.go(-1);
			</script>
			";
			exit;
		}
		$i++;
		
}
$SQL = "select * from add_freight_fee where zipcode like '$zip' order by freight_fee desc limit 1";
$rs = mysql_query($SQL, $dbconn);
if(mysql_num_rows($rs))
{
	$row = mysql_fetch_array($rs);
	$addition_freight_fee = $row[freight_fee];
	echo ("
		<script language=javascript>
			if(!confirm('����� �ּ� : {$address}��(��) ��ۺ�($addition_freight_fee ��) �߰� �����Դϴ�.\\n\\n�׷��� �ֹ��Ͻðڽ��ϱ�?'))
				history.back();
		</script>
	");
	$freight_fee += $addition_freight_fee;
	$mon_tot_freight += $addition_freight_fee;
}
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
/*
if( $paymethod == "bypoint" ){
	$use_bonus_tot = $use_bonus_tot3;
}*/

$use_bonus_tot = $use_bonus_tot3;
if($use_bonus_tot3!=""){
	$if_use_bonus = "1";
}

if( $paymethod == "bycard" || $paymethod == "bycard_point")
{
	$card_freight = $mon_tot_freight - $use_bonus_tot;
	if($card_freight < $card_limit){
		echo ("
			<script language=javascript>
				alert('ī��(������ü)���� �ݾ��� $card_limit �̻����� ���ּ���..');
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

$SQL = "select order_num from $Order_BuyTable where $whereChange and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows=mysql_num_rows($dbresult);
if (mysql_num_rows($dbresult)>0) {
	echo ("
		<script language=javascript>
			alert('�̹� �����ϴ� �ֹ���ȣ�Դϴ�.\\n\\n �ߺ����� �߰��� �� �����ϴ�.');
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/'>";
	unset($_SESSION[order_point_num]);
	unset($_SESSION[order_num]);
	exit;
}

if($account_no == 'nobank'){
	$account_no = "0";
}

$use_bonus_tot = str_replace( ",", "", $use_bonus_tot );

$status = "1"; //�ֹ����� -> �ֹ�

if($use_bonus_tot == $mon_tot_freight)
	$status = "2";

if( !$message ){
	$message = "��û���� ����";
}

//=============== �ӽ��ֹ��� ������ ������ ===========================================
$SQL = "delete from $Order_BuyTable_Temp where $whereChange and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);

//=============== �ӽ��ֹ��� ������ �Է� ===========================================
$SQL = "insert into  $Order_BuyTable_Temp (index_no, order_num, mart_id, id, name, passport1, passport2, tel1, tel2, email, buyer_zip, buyer_address, buyer_address_d, receiver, rev_tel, rev_tel1, zip, address, address_d, message, paymethod, account_no, status, date, partner, money_sender, pay_day, if_use_bonus, mon_tot, use_bonus_tot, freight_fee, field1, field2, field3, field4, field5,non_pass, anonymity,ment,send_name,card_content,occ_choice,hope_date,ampm,hope_time,hope_type) values ( '', '$order_num2', '$mart_id', '$UnameSess', '$name', '$passport1', '$passport2', '$buyer_tel', '$buyer_tel1', '$email', '$buyer_zip', '$buyer_address', '$buyer_address_d', '$receiver', '$rev_tel', '$rev_tel1', '$zip', '$address', '$address_d', '$message', '$paymethod', '$account_no', '$status', '$date', '$partner', '$money_sender', '$pay_day', '$if_use_bonus', '$mon_tot_freight', '$use_bonus_tot','$freight_fee', '$field1', '$field2', '$field3','$field4','$field5','$NonMemberPass', '$anonymity','$ment','$send_name','$card_content','$occ_choice','$hope_date','$ampm','$hope_time','$hope_type')";
$dbresult = mysql_query($SQL, $dbconn);



//=============== �ӽ��ֹ��� ������ ������ ===========================================
$SQL = "delete from order_buy_temp2 where $whereChange and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);

//=============== �ӽ��ֹ��� ������ �Է� ===========================================
$SQL = "insert into  order_buy_temp2 (index_no, order_num, mart_id, id, name, passport1, passport2, tel1, tel2, email, buyer_zip, buyer_address, buyer_address_d, receiver, rev_tel, rev_tel1, zip, address, address_d, message, paymethod, account_no, status, date, partner, money_sender, pay_day, if_use_bonus, mon_tot, use_bonus_tot, freight_fee, field1, field2, field3, field4, field5,non_pass, anonymity,ment,send_name,card_content,occ_choice,hope_date,ampm,hope_time,hope_type) values ( '', '$order_num2', '$mart_id', '$UnameSess', '$name', '$passport1', '$passport2', '$buyer_tel', '$buyer_tel1', '$email', '$buyer_zip', '$buyer_address', '$buyer_address_d', '$receiver', '$rev_tel', '$rev_tel1', '$zip', '$address', '$address_d', '$message', '$paymethod', '$account_no', '$status', '$date', '$partner', '$money_sender', '$pay_day', '$if_use_bonus', '$mon_tot_freight', '$use_bonus_tot','$freight_fee', '$field1', '$field2', '$field3','$field4','$field5','$NonMemberPass', '$anonymity','$ment','$send_name','$card_content','$occ_choice','$hope_date','$ampm','$hope_time','$hope_type')";
$dbresult = mysql_query($SQL, $dbconn);



$sql="select * from $Order_ProTable where $whereChange";
$result=mysql_query($sql);
while($rs=mysql_fetch_array($result)){
	$quantity=$rs[quantity];
	$item_no2=$rs[item_no];
	
	$opt = $rs[opt];
	$opt2= $rs[opt2];
	$opt3= $rs[opt3];
	$opt4= $rs[opt4];


	$sql="select * from $ItemTable where item_no='$item_no2'";
	$result2=mysql_query($sql);
	$rs2=mysql_fetch_array($result2);
	$item_no=$rs2[item_no];
	$jaego_use=$rs2[jaego_use];
	$jaego=$rs2[jaego];
	$if_opt_jaego=$rs2[if_opt_jaego];
	$if_opt_jaego2=$rs2[if_opt_jaego2];
	$if_opt_jaego3=$rs2[if_opt_jaego3];
	$if_opt_jaego4=$rs2[if_opt_jaego4];
	if($jaego_use=="1"){
		$sql="update $ItemTable set jaego=jaego-$quantity where item_no='$item_no2'";
		mysql_query($sql);
	}else{}
	//�� �ɼ� ��� ������
	if($if_opt_jaego){
	$sql="update $OptionTable set opt_ea=opt_ea-$quantity where item_no='$item_no2' and opt_no=$opt";
	mysql_query($sql);
	}
	if($if_opt_jaego2){
	$sql="update $OptionTable2 set opt_ea=opt_ea-$quantity where item_no='$item_no2' and opt_no=$opt2";
	mysql_query($sql);
	}
	if($if_opt_jaego3){
	$sql="update $OptionTable3 set opt_ea=opt_ea-$quantity where item_no='$item_no2' and opt_no=$opt3";
	mysql_query($sql);
	}
	if($if_opt_jaego4){
	$sql="update $OptionTable4 set opt_ea=opt_ea-$quantity where item_no='$item_no2' and opt_no=$opt4";
	mysql_query($sql);
	}

}


//����Ʈ ��� (�¶��� �Ա�, ����Ʈ ����)
/*if( $use_bonus_tot3 != "" ){
	$write_date = date("Y-m-d H:i:s");
	$content = $order_num." ���ſ� ����Ʈ ���";
	
	$bonus = -$use_bonus_tot;
	$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num2', 'u')";

	$dbresult = mysql_query($SQL, $dbconn);
	
	$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess' and mart_id='$mart_id'";
	
	$dbresult = mysql_query($SQL, $dbconn);
}*/




//$SQL = "update $Order_ProTable set status='1' where $whereChange and mart_id='$mart_id'";
//$dbresult = mysql_query($SQL, $dbconn);
//if ($dbresult == false) echo "���� ���� ����!";

/*if( $dbresult ){ // ���������� �ֹ��� �̷�� ���� �� SMS ����
	//================== SMS ���� ========================================================
	//================== DB ���� ������ �ҷ��� ===========================================
	include "../../connect_sms.php";

	//================== ������ sms�� ���� =============================================
	$tr_senddate = date("YmdHis");
	$tran_phone = "$buyer_tel1";//�޴� ��� ��ȣ
	$tran_callback = "$shop_tel";//������ ��� ��ȣ
	$tran_msg = "$name"."�� �ֹ��� �̷�������ϴ�.�ֹ���ȣ�� "."$order_num"."�Դϴ�[$mart_id]";

	$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
	$sms_res = mysql_query( $sms_sql, $connect );

	if( !$sms_res ){
		echo "
		<script>
			alert('���� ���� ����');
		</script>
		";
	}

	//================== ���������ڿ��� sms�� ���� =======================================
	$tr_senddate = date("YmdHis");
	$tran_phone1 = "010-3198-5678";//�޴� ��� ��ȣ
	$tran_callback1 = "$shop_tel";//������ ��� ��ȣ
	$tran_msg1 = "$name"."���� ��ǰ�� �ֹ��߽��ϴ�.�ֹ���ȣ�� "."$order_num"."�Դϴ�[$mart_id]";

	$sms_sql1 = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone1', '$tran_callback1', '1', sysdate(), '$tran_msg1' )";
	$sms_res1 = mysql_query( $sms_sql1, $connect );

	//================== ���������� sms�� ���� ===========================================
	//================== ������ ������ �ҷ��� ============================================
	$p_sql = "select provider_id from $Order_ProTable where $whereChange and mart_id='$mart_id'";
	$p_res = mysql_query($p_sql, $dbconn);

	while( $p_row = mysql_fetch_array($p_res) ){		
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$p_row[provider_id]'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone2 = "$pro_phon";//�޴� ��� ��ȣ
		$tran_callback2 = "$shop_tel";//������ ��� ��ȣ
		$tran_msg2 = "$name"."���� ��ǰ�� �ֹ��߽��ϴ�.�ֹ���ȣ�� "."$order_num"."�Դϴ�[$mart_id]";

		$sms_sql2 = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone2', '$tran_callback2', '1', sysdate(), '$tran_msg2' )";
		$sms_res2 = mysql_query( $sms_sql2, $connect );
	}
	if( !$sms_res2 ){
		echo "
		<script>
			alert('���� ���� ����');
		</script>
		";
	}
	//====================================================================================
}*/
	/*$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	$user_id = "whwindow"; //������

	$rand		= rand(1000, 9999);
	$wr_message = $name."���� �ֹ��Ͽ����ϴ�.";//$content;
	$send_content = $name."���� �ֹ��Ͽ����ϴ�.";
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//������ ��� ��ȣ
	$send_back = "1588-1943";//������ ��� ��ȣ
	$send_phone = "010-8081-8077";//�޴� ��� ��ȣ 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//��ü��ϳ����
	$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";
	mysql_query($sql, $conn_db);

	$wr_message = "[�̿��ö��]".$name."�� �ֹ������Ǿ����ϴ�.";//$content;
	$send_content = "[�̿��ö��]".$name."�� �ֹ������Ǿ����ϴ�.";
	$send_date = date("YmdHis");

	//$send_back = "010-2231-6545";//������ ��� ��ȣ
	$send_back = "1588-1943";//������ ��� ��ȣ
	$send_phone = $buyer_tel1;//�޴� ��� ��ȣ 

	$sql = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content')";
	$res=mysql_query($sql, $conn_db);
	

	//��ü��ϳ����
	$sql = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$user_id','$send_phone','$send_back','1','$send_date','$send_content',curdate())";
	mysql_query($sql, $conn_db);*/


	

if(0 < $use_bonus_tot){ //����Ʈ ���� ����Ʈ ��ŭ �� �ش�.
	$mon_tot_freight = $mon_tot_freight - $use_bonus_tot;
	if($mon_tot_freight == 0){
		//echo "<meta http-equiv='refresh' content='0; URL=order_ok.html?mart_id=$mart_id'>";
		//exit;
	}
}

if( $paymethod == "byonline" || $paymethod == "byonline_point" || $paymethod == "bypoint" ){ //�¶����Ա�,����Ʈ����
	echo "<meta http-equiv='refresh' content='0; URL=order_ok.html?order_num=$order_num2&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&buyer_tel1=$buyer_tel1&ispoint=$ispoint'>";
	exit;
}

if($paymethod == 'bycard' || $paymethod == 'bycard_point' ){
	$cur_dir = dirname($SCRIPT_NAME);
	//�̳�����
	//$url="./card_account_xpay.html";
	//if($_SESSION['UnameSess']=="test00"){
	$url="./innopay.html";
	//}
	echo "
		<script language = 'javascript'>
		<!--
		 function OpenWindow_Submit(){ 
		 document.FormA.submit();
		 }
		//-->
		</script>
		<form name='FormA'  method='post' action ='".$url."?order_num=$order_num2&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot'>
		<!-- ������ ���� �ʼ� hidden���� -->
		<input type='hidden' name='OrderID' value='$order_num2'>
		<input type='hidden' name='Amount' value='$mon_tot_freight'>
		<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok_new.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot&ispoint=$ispoint'>
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
		<input type='text' name='ispoint' value='$ispoint'>
		</form>
		<Body Onload='OpenWindow_Submit();'>
	";
}

if($paymethod == 'byaccount' || $paymethod == 'byaccount_point' ){
	$cur_dir = dirname($SCRIPT_NAME);
	//$url="./card_account1_xpay.html";
	$url="./innopay.html";
	echo "
		<script language = 'javascript'>
		<!--
		 function OpenWindow_Submit(){ 
		 document.FormA.submit();
		 }
		//-->
		</script>
		<form name='FormA'  method='post' action ='".$url."?order_num=$order_num2&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot'>
		<!-- ������ ���� �ʼ� hidden���� -->
		<input type='hidden' name='OrderID' value='$order_num2'>
		<input type='hidden' name='Amount' value='$mon_tot_freight'>
		<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&ispoint=$ispoint'>
		<input type='hidden' name='note_url' value='http://$HTTP_HOST$cur_dir/note_url.php'>
		<input type='hidden' name='Name' value='$name'>
		<input type='hidden' name='passport' value='$passport'>
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
		<input type='text' name='ispoint' value='$ispoint'>
		</form>
		<Body Onload='OpenWindow_Submit();'>
	";
}


if($paymethod == 'byeasy'){
	$cur_dir = dirname($SCRIPT_NAME);
	//�̳�����
	//$url="./card_account_xpay.html";
	//if($_SESSION['UnameSess']=="test00"){
	$url="./innopay.html";
	//}
	echo "
		<script language = 'javascript'>
		<!--
		 function OpenWindow_Submit(){ 
		 document.FormA.submit();
		 }
		//-->
		</script>
		<form name='FormA'  method='post' action ='".$url."?order_num=$order_num2&mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot'>
		<!-- ������ ���� �ʼ� hidden���� -->
		<input type='hidden' name='OrderID' value='$order_num2'>
		<input type='hidden' name='Amount' value='$mon_tot_freight'>
		<input type='hidden' name='Ret_URL' value='http://$HTTP_HOST$cur_dir/order_ok_new.html?mart_id=$mart_id&category_num=$category_num&category_num1=$category_num1&category_num2=$category_num2&cate_num=$cate_num&flag=$flag&item_no=$item_no&provider_id=$provider_id&paymethod=$paymethod&use_bonus_tot=$use_bonus_tot&ispoint=$ispoint'>
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
		<input type='text' name='ispoint' value='$ispoint'>
		</form>
		<Body Onload='OpenWindow_Submit();'>
	";
}
if($paymethod=="kakao_pay"){
	//īī�����̿� �Ѱ��� �Ķ���� ����
	$list=array();
	$list['adminKey']='f67d586e5915fd23cb2369e0ce0358a5';//admin key
	$list['cid']='C111960088';//�������̵�
	$list['order_id']=$order_num2;//�ֹ���ȣ
	if($UnameSess){
		$list['user_id']=$UnameSess;//ȸ�����̵�
	}else{
		$list['user_id']="guest";//ȸ�����̵�
	}
	if($totalQuantity>1){
		$list['item_name']=$item_name."�� ".$totalQuantity."��";//��ǰ��
	}else{
		$list['item_name']=iconv("euc-kr","utf-8",$item_name);//��ǰ��
	}
	$list['quantity']=$totalQuantity;//��ǰ����
	$list['total_amount']=$mon_tot_freight;//������ �ݾ�
	$list['free_amount']="0";//��ۺ�?? 
	//īī������ �����غ�
	$kakaoPay=new KakaPay("1",$list,"pc");//īī������ ������� �����ϱ� 1 �����غ� 2 �������� pc:pc���� mobile: ����Ϲ���
	$kakaoPay->readyKakaoPay();//���� �غ�� �� ����
	$result=$kakaoPay->execKakaoPay();//īī������ �Ķ���� �Ѱ��ְ� json���� �޾ƿ�

	$_SESSION[kakao_tid]=$result->tid;
	$_SESSION[orderNo]=$order_num2;





	echo "<meta http-equiv='refresh' content='0;url=".$result->next_redirect_pc_url."'>";
}

?>
<?
mysql_close($dbconn);
?>
