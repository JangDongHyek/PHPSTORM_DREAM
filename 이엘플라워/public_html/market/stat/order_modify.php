<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
if($flag == "modify"){

	// SMS 발송
	/**include "../../admin/sms/class.sms.php";
	$SMS = new SMS;
	$SMS->SMS_Login($sms_user,$sms_passwd);
	
	if($if_order_cancel_msg == '1'){	
		$SQL = "select tel2,name from $Order_BuyTable where order_num = '$order_num_query'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$tel2_tmp = mysql_result($dbresult,0,0);
			$name_tmp = mysql_result($dbresult,0,1);
		}

		$callback = "$callback_num1$callback_num2$callback_num3";		
		$order_cancel_msg_tmp = str_replace('[SHOP_NAME]',$mart_name,$order_cancel_msg); 
		$order_cancel_msg_tmp = str_replace('[MEM_NAME]',$name_tmp,$order_cancel_msg_tmp); 
		$sms_client_num = str_replace('-','',$tel2_tmp); 
		
		$SMS->Add($sms_client_num,"$callback","$mart_name","$order_cancel_msg_tmp","");
	}
	if($if_order_cancel_msg_admin == '1'){
		$SQL = "select name from $Order_BuyTable where order_num = '$order_num_query'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$name_tmp = mysql_result($dbresult,0,0);
		}
		$callback = "$callback_num1$callback_num2$callback_num3";		
		$admin_num = "$admin_num1$admin_num2$admin_num3";
		$order_cancel_msg_admin_tmp = str_replace('[SHOP_NAME]',$mart_name,$order_cancel_msg_admin); 
		$order_cancel_msg_admin_tmp = str_replace('[MEM_NAME]',$name_tmp,$order_cancel_msg_admin_tmp); 
		
		$SMS->Add($admin_num,"$callback","$mart_name","$order_cancel_msg_admin_tmp","");
	}		
	
	if($if_order_cancel_msg == '1' || $if_order_cancel_msg_admin == '1'){
		$result = $SMS->Send();
		if ($result) {
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
		else echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}**/

	$SQL = "update $Order_BuyTable set name='$name', tel1='$buyer_tel', tel2='$buyer_tel1', email='$email', buyer_address='$buyer_address', buyer_address_d='$buyer_address_d', buyer_zip='$buyer_zip', receiver='$receiver', rev_tel='$rev_tel', zip='$zip', address='$address', address_d='$address_d', message='$message' where order_num = '$order_num_query' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	
	echo "<meta http-equiv='refresh' content='0; URL=order_view.html?mart_id=$mart_id&order_num_query=$order_num_query'>";
}

mysql_close($dbconn);
?>