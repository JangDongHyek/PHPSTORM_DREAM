<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
include "../../market/include/getmartinfo.php";

    /*
     * [����������û ������(STEP2-2)]
     *
     * LG���÷������� ���� �������� LGD_PAYKEY(����Key)�� ������ ���� ������û.(�Ķ���� ���޽� POST�� ����ϼ���)
     */
	
	/* �� �߿�
	* ȯ�漳�� ������ ��� �ݵ�� �ܺο��� ������ ������ ��ο� �νø� �ȵ˴ϴ�.
	* �ش� ȯ�������� �ܺο� ������ �Ǵ� ��� ��ŷ�� ������ �����ϹǷ� �ݵ�� �ܺο��� ������ �Ұ����� ��ο� �νñ� �ٶ��ϴ�. 
	* ��) [Window �迭] C:\inetpub\wwwroot\lgdacom ==> ����Ұ�(�� ���丮)
	*/
	
	$configPath = "/home/jsbusan/public_html/mobile/cart/lgdacom"; //LG���÷������� ������ ȯ������("/conf/lgdacom.conf,/conf/mall.conf") ��ġ ����. 

    /*
     *************************************************
     * 1.�������� ��û - BEGIN
     *  (��, ���� �ݾ�üũ�� ���Ͻô� ��� �ݾ�üũ �κ� �ּ��� ���� �Ͻø� �˴ϴ�.)
     *************************************************
     */
    $CST_PLATFORM               = $HTTP_POST_VARS["CST_PLATFORM"];
    $CST_MID                    = $HTTP_POST_VARS["CST_MID"];
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
    $LGD_PAYKEY                 = $HTTP_POST_VARS["LGD_PAYKEY"];

    require_once("./lgdacom/XPayClient.php");
    $xpay = &new XPayClient($configPath, $CST_PLATFORM);
    $xpay->Init_TX($LGD_MID);    
    
    $xpay->Set("LGD_TXNAME", "PaymentByKey");
    $xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);
    
    //�ݾ��� üũ�Ͻñ� ���ϴ� ��� �Ʒ� �ּ��� Ǯ� �̿��Ͻʽÿ�.
	//$DB_AMOUNT = "DB�� ���ǿ��� ������ �ݾ�"; //�ݵ�� �������� �Ұ����� ��(DB�� ����)���� �ݾ��� �������ʽÿ�.
	//$xpay->Set("LGD_AMOUNTCHECKYN", "Y");
	//$xpay->Set("LGD_AMOUNT", $DB_AMOUNT);
	    
    /*
     *************************************************
     * 1.�������� ��û(�������� ������) - END
     *************************************************
     */

    /*
     * 2. �������� ��û ���ó��
     *
     * ���� ������û ��� ���� �Ķ���ʹ� �����޴����� �����Ͻñ� �ٶ��ϴ�.
     */
    if ($xpay->TX()) {
        //1)������� ȭ��ó��(����,���� ��� ó���� �Ͻñ� �ٶ��ϴ�.)
        /*
		echo "������û�� �Ϸ�Ǿ����ϴ�.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        echo "�ŷ���ȣ : " . $xpay->Response("LGD_TID",0) . "<br>";
        echo "�������̵� : " . $xpay->Response("LGD_MID",0) . "<br>";
        echo "�����ֹ���ȣ : " . $xpay->Response("LGD_OID",0) . "<br>";
        echo "�����ݾ� : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
        echo "����ڵ� : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";
        echo "����޼��� : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
          */ 
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            //echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        echo "<p>";


		###########���뺯��###########3
		$paymethod= $_POST[ "paymethod"         ];
		$res_cd =	$xpay->Response_Code(); //�����ڵ�
		$order_num =$xpay->Response("LGD_OID",0); //���� �ֹ���ȣ
		#######ī������#############
		$app_no =	$xpay->Response("LGD_FINANCEAUTHNUM",0);//����������ι�ȣ
		$paydate =  $xpay->Response("LGD_PAYDATE",0); //�����Ͻ�
		$tno =		$xpay->Response("LGD_TID",0); //������ �ŷ���ȣ
		$quota =	$xpay->Response("LGD_CARDINSTALLMONTH",0); //ī�� �Һΰ���
		$noinf =	$xpay->Response("LGD_CARDNOINTYN",0);//������ �Һ� 
		$res_msg =	$xpay->Response("LGD_RESPMSG",0);//����޼���
		$card_name =$xpay->Response("LGD_FINANCENAME",0);//ī���
		############################3
		if($noinf == 1){ //������
			$noinf = "y";
		}else{ //�Ϲ�
			$noinf = "n";
		}





           
        if( "0000" == $xpay->Response_Code() ) {
         	//����������û ��� ���� DBó��
           	



						############################### Start ���� ############################################################################################################################################

				$rSuccYn = 'y';
				$card_paid = 't';
				$status = 2;//ī�强���϶� �ٷ� �����Ϸ�



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

					if( $paymethod == 'byaccount'){
						$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
						//echo $all_sql."<br>";
						$all_res = mysql_query($all_sql, $dbconn);

						$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
					}else if( $paymethod == 'bycard' ){
						$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
						//echo $all_sql."<br>";
						$all_res = mysql_query($all_sql, $dbconn);

						$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
						
					}else{
						$order_str = "�ֹ��� ���������� �Ϸ�Ǿ����ϴ�.";
					}

					$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
					$cartdel_res = mysql_query($cartdel_sql, $dbconn);
					if($cartdel_res == false){
						echo "���� ���� ����";
					}
					//=============== �ӽ��ֹ��� ������ ������ ===========================================
					$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
					$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

				}
			################################ End ���� ###################################################################################################################


            //����������û ��� ���� DBó�� ���н� Rollback ó��
          	$isDBOK = true; //DBó�� ���н� false�� ������ �ּ���.
          	if( !$isDBOK ) {
           		echo "<p>";
           		$xpay->Rollback("���� DBó�� ���з� ���Ͽ� Rollback ó�� [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
            		
                echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br>";
                echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
            		
                if( "0000" == $xpay->Response_Code() ) {
                  	echo "�ڵ���Ұ� ���������� �Ϸ� �Ǿ����ϴ�.<br>";
                }else{
          			echo "�ڵ���Ұ� ���������� ó������ �ʾҽ��ϴ�.<br>";
                }
          	}            	
        }else{
          	//����������û ��� ���� DBó��
         				######################################################## Start ���� ###################################################################
						$card_paid = 'f'; //��������
						$rSuccYn = 'n';
						$status = 1;

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
							if( $paymethod == 'byaccount'){
								$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
									//echo $all_sql."<br>";
									$all_res = mysql_query($all_sql, $dbconn);
									$order_str = "������ �����߽��ϴ�.";
								
							}else if( $paymethod == 'bycard' ){
								$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
								//echo $all_sql."<br>";
								$all_res = mysql_query($all_sql, $dbconn);

									$order_str = "������ �����߽��ϴ�.<br><span class=text_red>$res_msg</span>";
								
							}else{
								$order_str = "������ �����߽��ϴ�.";
							}

							$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
							$cartdel_res = mysql_query($cartdel_sql, $dbconn);
							if($cartdel_res == false){
								echo "���� ���� ����";
							}

							//=============== �ӽ��ֹ��� ������ ������ ===========================================
							$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
							$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

						}
			######################################################### End ���� ##################################################################    
     
        }
    }else {
        //2)API ��û���� ȭ��ó��
        echo "������û�� �����Ͽ����ϴ�.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //����������û ��� ���� DBó��
        echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br>";            	                        
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


if( $paymethod == 'byonline'){ //�������Ա��϶�
	$status = 1; 
	$order_str = "�ֹ��� ���������� �Ϸ�Ǿ����ϴ�.";


	$cartdel_sql = "update $Order_ProTable set status='$status' where order_num='$order_num' and mart_id='$mart_id'";
	$cartdel_res = mysql_query($cartdel_sql, $dbconn);
	if($cartdel_res == false){
		echo "���� ���� ����";
	}

	//================== �ֹ��� ���̺� �ֹ���ȣ�� ������ ===================================
	$ordcopy_sql0 = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
	$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
	$order_tot0 = mysql_num_rows($ordcopy_res0);
	if($order_tot0 == 0){
		//================== �ӽ��ֹ��� ������ �ֹ��� ���̺�� ������ ========================
		$ordcopy_sql = "insert into $Order_BuyTable ( select * from $Order_BuyTable_Temp where order_num='$order_num' and mart_id='$mart_id')";

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
		//=============== �ӽ��ֹ��� ������ ������ ===========================================
		$ordcopy_sql1 = "delete from $Order_BuyTable_Temp where order_num='$order_num' and mart_id='$mart_id'";
		$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

	}
}












//================== �ֹ��� ������ �ҷ��� ================================================
$order_sql = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
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
		$pay_sql = "select * from $BankTable where mart_id='$mart_id' and account_no='$account_no'";
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
		$paystr = "�ǽð�������ü + ����Ʈ����";
		$totpaystr = "�� �ǽð�������ü �ݾ�";
	}

	if($paymethod== 'bycard'){
		$paystr = "ī�����";
		$totpaystr = "ī����� �ݾ�";
	}
	if($paymethod== 'byaccount'){
		$paystr = "�ǽð�������ü";
		$totpaystr = "�ǽð�������ü �ݾ�";
	}
	if($paymethod== 'byescro'){
		$paystr = "�츮����ũ��";
		$totpaystr = "�츮����ũ�� �ݾ�";
	}
	//====================== �¶��� �Աݽ� ���� ���� =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�������Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�������Ա�";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number ������ : $owner_name )";
			$paystr = "�������Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�������Ա� + ����Ʈ����";
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
			$paystr = "�������Ա� + ����Ʈ����";
			$totpaystr = "�¶��� �Ա��� �ݾ�";
		}else{
			$account_str ="";
			$paystr = "�������Ա� + ����Ʈ����";
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
		
//����Ʈ ��� (�¶��� �Ա�, ����Ʈ ����)
if( ($paymethod == "byaccount_point" || $paymethod == "bycard_point") && $UnameSess ){
	$bonus_sql = "select * from $BonusTable where order_num = '$order_num' and id = '$UnameSess' and mart_id='$mart_id' and mode='u'";
	$bonus_res = mysql_query($bonus_sql, $dbconn);
	$bonus_tot = mysql_num_rows($bonus_res);
	
	if($bonus_tot <= 0){
		$write_date = date("Ymd H:i:s");
		$content = $order_num." ���ſ� ����Ʈ ���";
		
		$bonus = - $use_bonus_tot;
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num', 'u')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess' and mart_id='$mart_id'";

		$dbresult = mysql_query($SQL, $dbconn);
	}
}

unset($_SESSION["order_num"]);
?>
<?
include "../../market/include/head_alltemplate.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="euc-kr" />
		<title>����</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
		<link rel="apple-touch-icon" href="http://img.orga.co.kr/images/mobile/apple-touch-icon.png" />
        <link rel="shortcut icon" href="http://img.orga.co.kr/images/mobile/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
		<script type="text/JavaScript" src="../js/jquery-1.7.min.js"></script>
		<script type="text/javascript">
			document.createElement('header');
			document.createElement('nav');
			document.createElement('section');
			document.createElement('article');
			document.createElement('footer');
			
			function check_submit() {

				var query = document.searchForm.searchTerm.value;

				if(query != ''){
					document.searchForm.submit();
				} else {
					alert("�˻�� �Է��ϼ���");
					document.searchForm.searchTerm.focus(); 
					return;
				}	
			}			
		</script>
		
		
<script language="javascript" src="/js/jquery/plugin/blockUI/jquery.blockUI.js" charset="utf-8"></script>
<script language="javascript" src="/js/jquery/plugin/validate/jquery.validate.js" charset="utf-8"></script>
<script>
function searchZipcode(){
	popView('zipcode_search');
	document.frmMain.keyword.focus();
}
function apply(zipcode,addr,delvAreaType,zipcodeInvoice){
	alert("("+zipcode.substring(0,3)+"-"+zipcode.substring(0,3)+") "+ addr);
	document.frmMain.recvPost1.value = zipcode.substring(0,3);
	document.frmMain.recvPost2.value = zipcode.substring(3,6);
	document.frmMain.recvAddr.value = addr;
	document.frmMain.delvAreaType.value = delvAreaType;
	document.frmMain.zipcodeInvoice.value = zipcodeInvoice;
	$('.zipList').html("");
	popClose('zipcode_search');
	document.frmMain.recvAddrDtl.focus();
}
function popAddress(){

	if(document.getElementsByName('keyword')[0].value.trim()==''){
		alert('�������� �Է����ּ���. ');
		return;
	}
	
	$.getJSON(
        '/ajax/morder/zipcodeSearch.orga'
        ,{
        	keyWord : document.getElementsByName('keyword')[0].value.trim()
        	,keyField : 'addr3'
        }
        ,function(data) {
        	if(data.resultCode=='1'){
        		var p = '';
        		if(data.zipcodeList.length>0){
	            	for(var i=0;i<data.zipcodeList.length;i++){
	            		p += "<li>"
	            			+"<a onclick=\""
	            			+"apply('"+data.zipcodeList[i].zipcode+"','"
	            			+data.zipcodeList[i].addr1+" "+data.zipcodeList[i].addr2+" "+data.zipcodeList[i].addr3+" "+"','"
	            			+data.zipcodeList[i].delvAreaType+"','"
	            			+data.zipcodeList[i].zipcodeInvoice
	            			+"');"
	            			+"\">"
		            		+"<p> "
	                		+data.zipcodeList[i].addr1+" "
	                		+data.zipcodeList[i].addr2+" "
	                		+data.zipcodeList[i].addr3+" "
	                		+"</p><p>"
	                		+data.zipcodeList[i].zipcode.substring(0,3)+"-"+data.zipcodeList[i].zipcode.substring(3,6)	
	                		+"</p></a></li>";	
	            	}
	            	//alert(p);
	        		$('.zipList').html(p);
        		}else{
        			alert('�˻��� ������ �����ϴ�.');
            		$('.zipList').html("");
        		}
        		
        	}else{
        		alert(data.resultMsg);
        		$('.zipList').html("");
        		popClose('zipcode_search');
        	}
        }
    );
}

window.onload = function(){
	
	
	

    $('#orderSame').click(function() {
        $('#recvNm').val($('#ordNm').val());
    });
	
	$('#frmMain').validate({
		rules:{
			ordNm:{required:true}
			,ordEmail:{required:true,email:true}
			,ordPw:{required:true,minlength:4,maxlength:8}
			,ordTel:{required:true}
			,ordMobile:{required:true}
			,recvNm:{required:true}
			,recvTel:{required:true}
			,recvMobile:{required:true}
		},
		messages:{
			ordNm:{required:"�ֹ��ڸ��� �Է����ּ���"}
			,ordEmail:{required:"�̸����� �Է����ּ���"}
			,ordPw:{required:"�ֹ���ȣ�� 4���̻� 8�����Ϸ� �Է����ּ���"}
			,ordTel:{required:"�ֹ��� ��ȭ��ȣ�� �Է����ּ���"}
			,ordMobile:{required:"�ֹ��� �ڵ�����ȣ�� �Է����ּ���"}
			,recvNm:{required:"�����ڸ��� �Է����ּ���"}
			,recvTel:{required:"����� ��ȭ��ȣ�� �Է����ּ���"}
			,recvMobile:{required:"����� �ڵ�����ȣ�� �Է����ּ���"}
		},
		showErrors: function(errorMap, errorList) {
		},
		invalidHandler : function (form, validator){
			var error = validator.errorList[0];
			alert(error.message);
			$(error.element).focus();
		},
		submitHandler: function(f){
			$('.confirmBtn').hide();
			if(!confirm('���� �Ͻðڽ��ϱ�?')){
				$('.confirmBtn').show();
				return false;
			}
			if(document.frmMain.cashOrderCost.value>0){
				
				document.frmMain.action = "/mobile/order/orderCash.orga";
				document.frmMain.submit();
				
			}else{
				alert('���������� �����Ͻ� �� �����ϴ�.');
				$('.confirmBtn').show();
				return;
			}
		}
	});
}

function applyAddress(val){
    if(val == "") return;
    var data = {atOnce : $("input[name=atOnce]").val()};
    data.cartGoodChk = $("input[name=cartGoodChk]").val();
    data.post = val.split("��")[0];

    $.ajaxCustom({
        url : "/ajax/morder/estimatedDeliveryDate.orga",
        data : data,
        successCallBack : function(result){
            $("#deliHopeDtmField").show();
            $("input[name=hopeDeliDtm]").val(result.date);
            $("#hopeDeliDtm").html(result.date.substring(0,4) + "�� " + result.date.substring(4,6) + "�� " + result.date.substring(6,8) + "��");
            if(val.split("��").length==6){
                var zipcode = val.split("��")[0];
                var recvTelText = val.split("��")[1];
                var recvMobileText = val.split("��")[2];
                var	addrText = val.split("��")[3];
                var addrDtlText = val.split("��")[4];
                var zipcodeInvoiceCd = val.split("��")[5];

                with(document.frmMain){
                    recvPost1.value = zipcode.substring(0,3);
                    recvPost2.value = zipcode.substring(3,6);
                    recvTel.value = recvTelText;
                    recvMobile.value = recvMobileText;
                    recvAddr.value = addrText;
                    recvAddrDtl.value = addrDtlText;
                    zipcodeInvoice.value = zipcodeInvoiceCd;
                }
            }else{
                with(document.frmMain){
                    recvPost1.value = "";
                    recvPost2.value = "";
                    recvTel.value = "";
                    recvMobile.value = "";
                    recvAddr.value = "";
                    recvAddrDtl.value = "";
                    zipcodeInvoice.value = "";
                }
            }
        }
    });
}
function applyCoupon(memCouponSeq, discountPrice){
	var totalSalePrice = 19500;
	$('.couponDiscount').html(commaInput(discountPrice));
	document.frmMain.orderMemCouponSeq.value = memCouponSeq;
	popClose('my_coupon');
	$('.totalSalePrice').html(commaInput(parseInt(totalSalePrice,10)-parseInt(discountPrice,10)));
	document.frmMain.cashOrderCost.value = parseInt(totalSalePrice,10)-parseInt(discountPrice,10);
	
}

function commaInput(val){
	var reg = /(^[+-]?\d+)(\d{3})/;
	
	var repText = val+'';
	while(reg.test(repText)){
		repText = repText.replace(reg,'$1' + ',' + '$2');
	} 
	return repText; 
	
}
</script>

	</head>
	<body>
	<? include("../include/top.html"); ?>


 
		<section id="content">

			<article id="contentSubTitle">
				<div class="subTitle">
					<h2>&nbsp;&nbsp;<a href="../">Ȩ</a> > �ֹ��Ϸ�</h2>
				</div>
			</article>
 
			<article class="order">
				<b><?=$order_str?></b><br>
				�ֹ���ȣ : <?=$order_num?> <br />
				�ֹ���¥ : <?=$date_str?>
			</article>

			<article id="productReview">
				<h3><span class="ic"></span>�ֹ��ϽŻ�ǰ</h3>
 				
 				
				<div class="basket">
					
  <?
$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
$ok_res = mysql_query($ok_sql, $dbconn);
$ok_tot = mysql_num_rows($ok_res);
$mon_tot = 0;
$i = 0;
while($ok_row = mysql_fetch_array($ok_res)){
	$i++;
	$item_name = $ok_row[item_name];
	$coupon_used = $ok_row[coupon_used];
	$item_no_forcash = $ok_row[item_no];
	$item_no_coupon = $ok_row[item_no];
	if($i == 0){
		$item_no_tmp = $ok_row[item_no]; //���� ���� ������ ��ǰ
	}
	$order_pro_no = $ok_row[order_pro_no];
	$mart_id = $ok_row[mart_id];
	$opt = $ok_row[opt];
	$opt2 = $ok_row[opt2];
	$opt3 = $ok_row[opt3];
	$opt4 = $ok_row[opt4];
	
	$sql="select * from $OptionTable where opt_no='$opt'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	
	
	$sql="select * from $OptionTable2 where opt_no='$opt2'";
	$result=mysql_query($sql);
	$rs2=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable3 where opt_no='$opt3'";
	$result=mysql_query($sql);
	$rs3=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable4 where opt_no='$opt4'";
	$result=mysql_query($sql);
	$rs4=mysql_fetch_array($result);
	
	$opt_name=$rs[opt_name];
	$opt_name2=$rs2[opt_name];
	$opt_name3=$rs3[opt_name];
	$opt_name4=$rs4[opt_name];

	$opt_price = $ok_row[opt_price];
	$opt_price2 = $ok_row[opt_price2];
	$opt_price3 = $ok_row[opt_price3];
	$opt_price4 = $ok_row[opt_price4];

	$z_price = $ok_row[z_price];
	$bonus = $ok_row[bonus];
		
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ok_row[use_bonus];
	$status = $ok_row[status];
	$quantity = $ok_row[quantity];
	$sum = ($z_price*$quantity)+(($opt_price+$opt_price2+$opt_price3+$opt_price4)*$quantity);

	$sum_str = number_format($sum);
	
	$mon_tot += $sum;

	$cart_sql1 = "select * from $ItemTable where item_no='$item_no_coupon'";
	$cart_res1 = mysql_query($cart_sql1, $dbconn);
	$cart_row1 = mysql_fetch_array($cart_res1);

	$prevno = $cart_row1[prevno];
	$cate_num = $cart_row1[category_num];
	$use_coupon = $cart_row1[use_coupon];
	$provider_id = $cart_row1[provider_id];
	$img_sml = $cart_row1[img_sml];
	$img = $cart_row1[img];
	$img_big = $cart_row1[img_big];
	$img_high = $cart_row1[img_high];
	$fee = $cart_row1[fee];
	$short_explain = $cart_row1[short_explain];
	$short_explain = han_cut($short_explain,28);

	//============================== �������� ������ =====================================
	$me_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$me_res = mysql_query($me_sql, $dbconn);
	$me_row = mysql_fetch_array($me_res);
	$in_name = $me_row[name];
	$me_delivery = $me_row[me_delivery];
	$me_delivery_price = number_format($me_row[me_delivery_price]);

	if( $fee == "����" ){
		$me_delivery_str = "$fee (��۾�ü : $me_delivery / ��� : $me_delivery_price)";
	}else{
		$me_delivery_str = "$fee";
	}

	if($use_coupon == '1' && $coupon_used=='0'){ 
		$coupon_str = "<a href=\"javascript:CouponWin('$item_no_coupon')\"><img src='http://www.mocoupon.co.kr/onlineShop/img/button-u8.gif' border='0'></a>";	
	}else{
		$coupon_str = '';
	}
  
	$if_cash_str = '';
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_forcash'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_forcash'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}

	//============================ ��ǰ �̹��� =======================================
	if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
		if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'></embed>";
		}
	}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
		if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img' width='50' height='50'></embed>";
		}
	}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
		if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_big' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_big,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_big' width='50' height='50'></embed>";
		}
	}else{
		$img_str = "<img src='../image/noimage_ss.gif' border='0' width='50' height='50' border='0'>";
	}
?>                 
					<input type="hidden" name="cartGoodChk" value="25266"/>
					<dl>
						<dt>
							<ul>
								<li><?=$img_str?>[<?=$item_name?>] </li>
<?
													if(isset($opt)&&$opt!=""){
												?>
												
												<?=$opt_name?>-<?=$opt_price?>��
												<?}?>
												<? if(isset($opt2)&&$opt2!=""){?><br>
												<?=$opt_name2?>-<?=$opt_price2?>��
												<? }?>
												<? if(isset($opt3)&&$opt3!=""){?><br>
												<?=$opt_name3?>-<?=$opt_price3?>��
												<? }?>
												<? if(isset($opt4)&&$opt4!=""){?><br>
												<?=$opt_name4?>-<?=$opt_price4?>��
												<? }?>								
								
							</ul>
						</dt>
						<dd>
							<ul>
									<li><span class="item">��ǰ����</span>: <?=$z_price_str?>��</li>
									<li><span class="item">����</span>: <?=$quantity?>��</li>
									<li><span class="item">�������</span>: <?=$me_delivery_str?></li>
									<li><span class="item">�հ�ݾ�</span>: <span class="price"> <?=$sum_str?>��</li>
							</ul>
						</dd>
					</dl>
<?
}
$mon_tot_freight = $mon_tot + $freight_fee;

?>				</div>
<!---------------------- ��ٱ��� ���̺� �� ---------------------->
                    

                 		

				<h3><span class="ic"></span>�ֹ�������</h3>
				<table class="orderinfoForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>�ֹ���</th>
							<td><?=$name?></td>
						</tr>
						<tr>
							<th class="bg">��ȭ��ȣ</th>
							<td class="bg">
								<?=$tel1?>
							</td>
						</tr>
						<tr>
							<th>�޴�����ȣ</th>
							<td>
								<?=$tel2?>
							</td>
						</tr>
						<tr>
							<th class="bg">�ֹ����ּ�</th>
							<td class="bg">
								[
                              <?=$buyer_zip?>
                              ]
                              <?=$buyer_address?>
                              <?=$buyer_address_d?>
							</td>
						</tr>
						<tr>
							<th>�̸���</th>
							<td>
								<?=$email?>
							</td>
						</tr>
					</tbody>
				</table>


				<div class="pt10"></div>
				<h3><span class="ic"></span>���������</h3>
				<table class="deliveryForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>�����ڸ�</th>
							<td>
								<?=$receiver?>
							</td>
						</tr>
						<tr>
							<th class="bg">��ȭ��ȣ</th>
							<td class="bg">
								<?=$rev_tel?>
							</td>
						</tr>
						<tr>
							<th>�޴�����ȣ</th>
							<td>
								<?=$rev_tel1?>
							</td>
						</tr>
						<tr>
							<th class="bg">������ּ�</th>
							<td class="bg">
								[
                              <?=$zip?>
                              ]
                              <?=$address?>
							  <?=$address_d?>
							</td>
						</tr>
                        <tr id="deliHopeDtmField" style="display:none">
							<th style="color:red">��ۿ�����</th>
							<td>
								<input type="hidden" name="hopeDeliDtm" value=""/><span id="hopeDeliDtm"></span>
							</td>
						</tr>
					</tbody>
				</table>













				<div class="pt10"></div>
				<h3><span class="ic"></span>��������</h3>
				<table class="deliveryForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>�������</th>
							<td>
								<?=$paystr?>
                              <?=$account_str?>
							</td>
						</tr>












<?
if( $use_bonus_tot < $mon_tot_freight ){
?>
                        <?
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>
 						<tr>
							<th class="bg">�Ա��ڸ�</th>
							<td class="bg">
								<?=$money_sender?>
							</td>
						</tr>
						<tr>
							<th>�Աݿ�����</th>
							<td>
								<?=$pay_day?>
							</td>
						</tr>

<?
	}else if($paymethod== 'bycard' || $paymethod== 'bycard_point'){
		if($quota == "00")
		{
			$quota_str = "�Ͻú�";
		}
		if($noinf == 'y')
		{
			$noinf_str = "������";
		}

		if($card_paid == 't'){
?>
 						<tr>
							<th class="bg">ī���</th>
							<td class="bg">
								<?=$card_name?>
							</td>
						</tr>
						<tr>
							<th>���ι�ȣ</th>
							<td>
								<?=$app_no?>
							</td>
						</tr>
 						<tr>
							<th class="bg">�Һ�</th>
							<td class="bg">
								<?=$quota_str?>&nbsp;<?=$noinf_str?>
							</td>
						</tr>

		
<?
		}
	}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
		$bank_name = $field3;
?>
 						<tr>
							<th class="bg">�����</th>
							<td class="bg">
								<?=$bank_name?>
							</td>
						</tr>

<?	
}
}
?>                        
					</tbody>
				</table>















                
				<h3><span class="ic"></span>�� �����ݾ�</h3>
<!---------------------- ��������� �� -------------------->
					<table class="totalPriceForm mt10 mb20">
					<colgroup>
						<col width="35%" />
						<col width="65%" />
					</colgroup>
					<tbody>
					
						<tr>
							<td>��ۺ�</td>
							<td class="price"><?=number_format($freight_fee)?>��</td>
						</tr>
                     
		
                        
						<tr>
							<th>�� �����ݾ�</th>
							<th class="price totalSalePrice"><?=number_format($mon_tot_freight)?>��</th>
							<input type="hidden" name="cashOrderCost" value="19500"/>
						</tr>
					</tbody>
				</table>
                


			</article>
 
		</section>
 
 
	<? include("../include/bottom.html"); ?>
	</body>
</html>