<?php


		

	function write_success($noti){
        //������ ���� log����� �˴ϴ�. log path���� �� dbó����ƾ�� �߰��Ͽ� �ֽʽÿ�.	

		$HostName = "localhost";
		$DbName = "jsbusan";
		$Admin = "jsbusan";
		$AdminPass = "ffpcm080";

		$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
		mysql_select_db($DbName, $dbconn);

		$martid = "jsbusan";









		$req_tx_name = "";

    if( $req_tx == "pay" )
    {
        $req_tx_name = "����";
    }
    else if( $req_tx == "mod" )
    {
        $req_tx_name = "����/���";
    }

// ������ ��� ���� ������ ����
// ���� �ҽ����� �۾��� ���� ����� ���� �ҽ��� �����

###########���뺯��###########3
$paymethod           = $_POST[ "paymethod"         ];
$use_pay_method = $_POST[ "paytype" ]; //�ŷ�Ÿ��
$res_cd = $_POST[ "respcode" ]; //�����ڵ�
$order_num = $_POST[ "oid" ]; //�ֹ���ȣ
#######ī������#############
$app_no = $_POST[ "authnumber" ];
$paydate = $_POST[ "paydate" ];
$tno = $_POST[ "transaction" ];
$quota = $_POST[ "cardperiod" ];
$noinf = $_POST[ "nointerestflag" ];
$res_msg = $_POST[ "respmsg" ];
$card_name = $_POST[ "financename" ];
############################3
if($noinf == 1){ //������
	$noinf = "y";
}else{ //�Ϲ�
	$noinf = "n";
}

if ($use_pay_method == "SC0010")				// �ſ�ī��
{
	$paymethod = "bycard";
}
else if ($use_pay_method == "SC0030")       // ������ü
{
	$paymethod = "byaccount";
}

$status = 1; 

if ($res_cd == "0000")										// ���� ����
{
	$rSuccYn = 'y';
	$card_paid = 't';
	$status = 2;
}else																// ���� ����
		{
	$rSuccYn = 'n';
	$card_paid = 'f';
}


if( $paymethod == 'byaccount'){
	$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
	if( $card_paid == 't' ){		
		$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
	}elseif($card_paid == 'f') {
		$order_str = "������ �����߽��ϴ�.";
	}
}else if( $paymethod == 'bycard' ){
	$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
	//echo $all_sql."<br>";
	$all_res = mysql_query($all_sql, $dbconn);
	if( $card_paid == 't' ){
		$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
	}elseif($card_paid == 'f') {
		$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
	}
}else{
	$order_str = "�ֹ��� ���������� �Ϸ�Ǿ����ϴ�.";
}

$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
//echo $cartdel_sql."<br>";
$cartdel_res = mysql_query($cartdel_sql, $dbconn);
if($cartdel_res == false){
	echo "���� ���� ����";
}

//================== �ֹ��� ������ �ҷ��� ================================================
$sql = "select * from order_config where mart_id ='$mart_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
if($tot > 0){
	$row = mysql_fetch_array($res);
	$buyer_name_use = $row[buyer_name_use];
	$buyer_passport_use = $row[buyer_passport_use];
	$buyer_email_use = $row[buyer_email_use];
	$buyer_tel_use = $row[buyer_tel_use];
	$buyer_tel1_use = $row[buyer_tel1_use];
	$buyer_zip_use = $row[buyer_zip_use];
	$buyer_address_use = $row[buyer_address_use];
	$receiver_use = $row[receiver_use];
	$rev_tel_use = $row[rev_tel_use];
	$rev_tel1_use = $row[rev_tel1_use];
	$zip_use = $row[zip_use];
	$address_use = $row[address_use];
	$money_sender_use = $row[money_sender_use];
	$pay_day_use = $row[pay_day_use];
	$field1_text = $row[field1_text];
	$field1_use = $row[field1_use];
	$field2_text = $row[field2_text];
	$field2_use = $row[field2_use];
	$field3_text = $row[field3_text];
	$field3_use = $row[field3_use];
	$field4_text = $row[field4_text];
	$field4_use = $row[field4_use];
	$field5_text = $row[field5_text];
	$field5_use = $row[field5_use];
}

//================== �ֹ��� ���̺� �ֹ���ȣ�� ������ ===================================
$ordcopy_sql0 = "select * from order_buy where order_num='$order_num'";
$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
$order_tot0 = mysql_num_rows($ordcopy_res0);
if($order_tot0 == 0){
	//================== �ӽ��ֹ��� ������ �ֹ��� ���̺�� ������ ========================
	$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num')";

	$ordcopy_res = mysql_query($ordcopy_sql, $dbconn);

	if( !$ordcopy_res ){
		echo ("
			<script language=javascript>
				alert('�ֹ����� �����ϴµ� �����߽��ϴ�.');
				history.go(-1);
			</script>
		");
		exit;
	}

	if( $paymethod== 'byaccount'){

		$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg' , payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
		if( $card_paid == 't' ){		
			$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
		}elseif($card_paid == 'f') {
			$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
		}
	}else if( $paymethod== 'bycard' ){
		$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$app_time', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
		if( $card_paid == 't' ){
			$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
		}elseif($card_paid == 'f') {
			$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
		}
	}
	
	//=============== �ӽ��ֹ��� ������ ������ ===========================================
	$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
	$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);
	/* if( !$ordcopy_res1 ){
		echo ("
			<script language=javascript>
				alert('�ӽ��ֹ��� ������ �����ϴµ� �����߽��ϴ�.');
				history.go(-1);
			</script>
		");
		exit;
	}*/
}
//================== �ֹ��� ������ �ҷ��� ================================================
$order_sql = "select * from order_buy where order_num='$order_num'";
$order_res = mysql_query($order_sql, $dbconn);
$order_tot = mysql_num_rows($order_res);
if($order_tot > 0){
	$order_row = mysql_fetch_array($order_res);
	$id = $order_row[id];
	$name = $order_row[name];
	$passport1 = $order_row[passport1];
	$passport2 = $order_row[passport2];
	$tel1 = $order_row[tel1];
	$tel2 = $order_row[tel2];
	$email = $order_row[email];
	$buyer_zip = $order_row[buyer_zip];
	$buyer_address = $order_row[buyer_address];
	$buyer_address_d = $order_row[buyer_address_d];
	$receiver = $order_row[receiver];
	$rev_tel = $order_row[rev_tel];
	$rev_tel1 = $order_row[rev_tel1];
	$zip = $order_row[zip];
	$address = $order_row[address];
	$address_d = $order_row[address_d];
	$message = $order_row[message];
	$paymethod = $order_row[paymethod];
	$account_no = $order_row[account_no];
	$status = $order_row[status];
	$date = $order_row[date];
	$money_sender = $order_row[money_sender];
	$pay_day = $order_row[pay_day];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	$if_use_bonus = $order_row[if_use_bonus];
	$use_bonus_tot = $order_row[use_bonus_tot];
	$freight_fee = $order_row[freight_fee];
	$field1 = $order_row[field1];
	$field2 = $order_row[field2];
	$field3 = $order_row[field3];
	$field4 = $order_row[field4];
	$field5 = $order_row[field5];
	
	if( !$message ){
		$message = "��û���� ����";
	}

	//====================== ������� ���� ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$pay_sql = "select * from bank where account_no='$account_no'";
		$pay_res = mysql_query($pay_sql, $dbconn);
		$pay_row = mysql_fetch_array($pay_res);
		$account_no = $pay_row[account_no];
		$bank_name = $pay_row[bank_name];
		$bank_number = $pay_row[bank_number];
		$owner_name = $pay_row[owner_name];
	}

	if( $paymethod == 'bycard_point'){
		$paystr = "ī����� + ����Ʈ����";
		$totpaystr = "�� ī�� ���� �ݾ�";
	}

	if( $paymethod == 'byaccount_point'){
		$paystr = "������ü + ����Ʈ����";
		$totpaystr = "�� ������ü �ݾ�";
	}

	if($paymethod== 'bycard'){
		$paystr = "ī�����";
		$totpaystr = "ī����� �ݾ�";
	}
	if($paymethod== 'byaccount'){
		$paystr = "������ü";
		$totpaystr = "������ü �ݾ�";
	}
	
	//====================== �¶��� �Աݽ� ���� ���� =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "����Ʈ����";
		$totpaystr = "������ �ݾ�";
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

}else{
	echo ("
		<script language=javascript>
			alert('�ֹ���ȣ�� �����ϴ�.');
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/'>";
	exit;
}
		


unset($_SESSION["order_num"]);














	    write_log("./write_success.log", $noti);
	    return true;
	}

	function write_failure($noti){
        //������ ���� log����� �˴ϴ�. log path���� �� dbó����ƾ�� �߰��Ͽ� �ֽʽÿ�.	



		$HostName = "localhost";
		$DbName = "jsbusan";
		$Admin = "jsbusan";
		$AdminPass = "ffpcm080";

		$dbconn = mysql_connect($HostName, $Admin, $AdminPass);
		mysql_select_db($DbName, $dbconn);

		$martid = "jsbusan";

















		$req_tx_name = "";

    if( $req_tx == "pay" )
    {
        $req_tx_name = "����";
    }
    else if( $req_tx == "mod" )
    {
        $req_tx_name = "����/���";
    }

// ������ ��� ���� ������ ����
// ���� �ҽ����� �۾��� ���� ����� ���� �ҽ��� �����

###########���뺯��###########3
$paymethod           = $_POST[ "paymethod"         ];
$use_pay_method = $_POST[ "paytype" ]; //�ŷ�Ÿ��
$res_cd = $_POST[ "respcode" ]; //�����ڵ�
$order_num = $_POST[ "oid" ]; //�ֹ���ȣ
#######ī������#############
$app_no = $_POST[ "authnumber" ];
$paydate = $_POST[ "paydate" ];
$tno = $_POST[ "transaction" ];
$quota = $_POST[ "cardperiod" ];
$noinf = $_POST[ "nointerestflag" ];
$res_msg = $_POST[ "respmsg" ];
$card_name = $_POST[ "financename" ];
############################3
if($noinf == 1){ //������
	$noinf = "y";
}else{ //�Ϲ�
	$noinf = "n";
}

if ($use_pay_method == "SC0010")				// �ſ�ī��
{
	$paymethod = "bycard";
}
else if ($use_pay_method == "SC0030")       // ������ü
{
	$paymethod = "byaccount";
}

$status = 1; 

if ($res_cd == "0000")										// ���� ����
{
	$rSuccYn = 'y';
	$card_paid = 't';
	$status = 2;
}else																// ���� ����
		{
	$rSuccYn = 'n';
	$card_paid = 'f';
}


if( $paymethod == 'byaccount'){
	$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
	if( $card_paid == 't' ){		
		$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
	}elseif($card_paid == 'f') {
		$order_str = "������ �����߽��ϴ�.";
	}
}else if( $paymethod == 'bycard' ){
	$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
	//echo $all_sql."<br>";
	$all_res = mysql_query($all_sql, $dbconn);
	if( $card_paid == 't' ){
		$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
	}elseif($card_paid == 'f') {
		$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
	}
}else{
	$order_str = "�ֹ��� ���������� �Ϸ�Ǿ����ϴ�.";
}

$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
//echo $cartdel_sql."<br>";
$cartdel_res = mysql_query($cartdel_sql, $dbconn);
if($cartdel_res == false){
	echo "���� ���� ����";
}

//================== �ֹ��� ������ �ҷ��� ================================================
$sql = "select * from order_config where mart_id ='$mart_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
if($tot > 0){
	$row = mysql_fetch_array($res);
	$buyer_name_use = $row[buyer_name_use];
	$buyer_passport_use = $row[buyer_passport_use];
	$buyer_email_use = $row[buyer_email_use];
	$buyer_tel_use = $row[buyer_tel_use];
	$buyer_tel1_use = $row[buyer_tel1_use];
	$buyer_zip_use = $row[buyer_zip_use];
	$buyer_address_use = $row[buyer_address_use];
	$receiver_use = $row[receiver_use];
	$rev_tel_use = $row[rev_tel_use];
	$rev_tel1_use = $row[rev_tel1_use];
	$zip_use = $row[zip_use];
	$address_use = $row[address_use];
	$money_sender_use = $row[money_sender_use];
	$pay_day_use = $row[pay_day_use];
	$field1_text = $row[field1_text];
	$field1_use = $row[field1_use];
	$field2_text = $row[field2_text];
	$field2_use = $row[field2_use];
	$field3_text = $row[field3_text];
	$field3_use = $row[field3_use];
	$field4_text = $row[field4_text];
	$field4_use = $row[field4_use];
	$field5_text = $row[field5_text];
	$field5_use = $row[field5_use];
}

//================== �ֹ��� ���̺� �ֹ���ȣ�� ������ ===================================
$ordcopy_sql0 = "select * from order_buy where order_num='$order_num'";
$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
$order_tot0 = mysql_num_rows($ordcopy_res0);
if($order_tot0 == 0){
	//================== �ӽ��ֹ��� ������ �ֹ��� ���̺�� ������ ========================
	$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num')";

	$ordcopy_res = mysql_query($ordcopy_sql, $dbconn);

	if( !$ordcopy_res ){
		echo ("
			<script language=javascript>
				alert('�ֹ����� �����ϴµ� �����߽��ϴ�.');
				history.go(-1);
			</script>
		");
		exit;
	}

	if( $paymethod== 'byaccount'){
		$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg' , payment_date='$app_time', field1 ='$tno' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
		if( $card_paid == 't' ){		
			$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
		}elseif($card_paid == 'f') {
			$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
		}
	}else if( $paymethod== 'bycard' ){
		$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$app_time', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
		//echo $all_sql."<br>";
		$all_res = mysql_query($all_sql, $dbconn);
		if( $card_paid == 't' ){
			$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
		}elseif($card_paid == 'f') {
			$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
		}
	}
	
	//=============== �ӽ��ֹ��� ������ ������ ===========================================
	$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
	$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);
	/* if( !$ordcopy_res1 ){
		echo ("
			<script language=javascript>
				alert('�ӽ��ֹ��� ������ �����ϴµ� �����߽��ϴ�.');
				history.go(-1);
			</script>
		");
		exit;
	}*/
}
//================== �ֹ��� ������ �ҷ��� ================================================
$order_sql = "select * from order_buy where order_num='$order_num'";
$order_res = mysql_query($order_sql, $dbconn);
$order_tot = mysql_num_rows($order_res);
if($order_tot > 0){
	$order_row = mysql_fetch_array($order_res);
	$id = $order_row[id];
	$name = $order_row[name];
	$passport1 = $order_row[passport1];
	$passport2 = $order_row[passport2];
	$tel1 = $order_row[tel1];
	$tel2 = $order_row[tel2];
	$email = $order_row[email];
	$buyer_zip = $order_row[buyer_zip];
	$buyer_address = $order_row[buyer_address];
	$buyer_address_d = $order_row[buyer_address_d];
	$receiver = $order_row[receiver];
	$rev_tel = $order_row[rev_tel];
	$rev_tel1 = $order_row[rev_tel1];
	$zip = $order_row[zip];
	$address = $order_row[address];
	$address_d = $order_row[address_d];
	$message = $order_row[message];
	$paymethod = $order_row[paymethod];
	$account_no = $order_row[account_no];
	$status = $order_row[status];
	$date = $order_row[date];
	$money_sender = $order_row[money_sender];
	$pay_day = $order_row[pay_day];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	$if_use_bonus = $order_row[if_use_bonus];
	$use_bonus_tot = $order_row[use_bonus_tot];
	$freight_fee = $order_row[freight_fee];
	$field1 = $order_row[field1];
	$field2 = $order_row[field2];
	$field3 = $order_row[field3];
	$field4 = $order_row[field4];
	$field5 = $order_row[field5];
	
	if( !$message ){
		$message = "��û���� ����";
	}

	//====================== ������� ���� ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$pay_sql = "select * from bank where account_no='$account_no'";
		$pay_res = mysql_query($pay_sql, $dbconn);
		$pay_row = mysql_fetch_array($pay_res);
		$account_no = $pay_row[account_no];
		$bank_name = $pay_row[bank_name];
		$bank_number = $pay_row[bank_number];
		$owner_name = $pay_row[owner_name];
	}

	if( $paymethod == 'bycard_point'){
		$paystr = "ī����� + ����Ʈ����";
		$totpaystr = "�� ī�� ���� �ݾ�";
	}

	if( $paymethod == 'byaccount_point'){
		$paystr = "������ü + ����Ʈ����";
		$totpaystr = "�� ������ü �ݾ�";
	}

	if($paymethod== 'bycard'){
		$paystr = "ī�����";
		$totpaystr = "ī����� �ݾ�";
	}
	if($paymethod== 'byaccount'){
		$paystr = "������ü";
		$totpaystr = "������ü �ݾ�";
	}
	
	//====================== �¶��� �Աݽ� ���� ���� =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "����Ʈ����";
		$totpaystr = "������ �ݾ�";
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�¶����Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

}else{
	echo ("
		<script language=javascript>
			alert('�ֹ���ȣ�� �����ϴ�.');
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/'>";
	exit;
}
		


unset($_SESSION["order_num"]);













	    write_log("./write_failure.log", $noti);
	    return true;
	}

    function write_hasherr($noti) {
        //������ ���� log����� �˴ϴ�. log path���� �� dbó����ƾ�� �߰��Ͽ� �ֽʽÿ�.	


	    write_log("./write_hasherr.log", $noti);
		return true;
    }

	function write_log($file, $noti) {
		$fp = fopen($file, "a+");
		ob_start();
		print_r($noti);
		$msg = ob_get_contents();
		ob_end_clean();
		fwrite($fp, $msg);
		fclose($fp);
	}
  
      
	function get_param($name){
		global $HTTP_POST_VARS, $HTTP_GET_VARS;
		if (!isset($HTTP_POST_VARS[$name]) || $HTTP_POST_VARS[$name] == "") {
			if (!isset($HTTP_GET_VARS[$name]) || $HTTP_GET_VARS[$name] == "") {
				return false;
			} else {
                 return $HTTP_GET_VARS[$name];
			}
		}
		return $HTTP_POST_VARS[$name];
	}

?>

