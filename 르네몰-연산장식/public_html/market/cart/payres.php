<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";


include "../include/getmartinfo.php";
?>

<?php
###################################################################################################################################################
   /*
     * [����������û ������(STEP2-2)]
     *
     * LG�ڷ������� ���� �������� LGD_PAYKEY(����Key)�� ������ ���� ������û.(�Ķ���� ���޽� POST�� ����ϼ���)
     */

	$configPath = "/home/yensan/public_html/market/cart/lgdacom"; //LG�ڷ��޿��� ������ ȯ������("/conf/lgdacom.conf,/conf/mall.conf") ��ġ ����. 

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
  
		$order_num = $xpay->Response("LGD_OID",0); //�ֹ���ȣ
		$res_msg = $xpay->Response("LGD_RESPMSG",0); //����޼���

		
		//echo "������û�� �Ϸ�Ǿ����ϴ�.  <br>";
        //echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        //echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //echo "�ŷ���ȣ : " . $xpay->Response("LGD_TID",0) . "<br>";
        //echo "�������̵� : " . $xpay->Response("LGD_MID",0) . "<br>";
       // echo "�����ֹ���ȣ : " . $xpay->Response("LGD_OID",0) . "<br>";
       // echo "�����ݾ� : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
       // echo "����ڵ� : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";
        //echo "����޼��� : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
           //�������� �ſ�ī��: SC0010  ������ü: SC0030
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            //echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        //echo "<p>";

		   
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
############################### Start ���� ############################################################################################################################################

	$rSuccYn = 'y';
	$card_paid = 't';
	$status = 2;//ī�强���϶� �ٷ� �����Ϸ�


	$sql="update order_pro set  status='1' where order_num='$order_num' and mart_id='$mart_id'";
	mysql_query($sql);
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

		if( $paymethod == 'byaccount' || $paymethod == 'byaccount_point'){
			$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
			//echo $all_sql."<br>";
			$all_res = mysql_query($all_sql, $dbconn);

			$order_str = "������ ���������� �Ϸ�Ǿ����ϴ�.";
		}else if( $paymethod == 'bycard' || $paymethod == "bycard_point" ){
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


//���⿡ ����Ʈ
		//���� ����Ʈ ���̺� ����Ÿ�� �������� 
		$SQL = "select * from $BonusTable where order_num = '$order_num' and mart_id='$mart_id' and mode='p'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);

		if($numRows == 0){
			//������ id �˾Ƴ���
			$id = '';
			$SQL = "select id from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows > 0){
				$id = mysql_result($dbresult,0,0);
			}
			
			if(!empty($id)){//ȸ�����ſ��� ����
				//����Ʈ ����
				$SQL = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
							
				for ($i=0; $i<$numRows; $i++) {
					mysql_data_seek($dbresult,$i);
					$ary = mysql_fetch_array($dbresult);
					$order_num = $ary["order_num"];
					$order_pro_no = $ary["order_pro_no"];
					$item_name = $ary["item_name"];
					$quantity = $ary["quantity"];
					$z_price = $ary["z_price"];
					if($z_price > 0){
						$bonus = round($z_price * 0.02);
						$bonus_sum = $bonus * $quantity;
						$content = "�ֹ���ȣ:".$order_num."\n��ǰ��:".$item_name."\n����:".$quantity; 
						
						$write_date = date("Ymd H:i:s");
									
												
						//$sql9 = "select mem_grade from mart_member_new where username='$id'";
						//$res9 = mysql_query($sql9, $dbconn);
						//$row9 = mysql_fetch_array($res9);
						//if($row9[mem_grade] == 2){
						//	$bonus_sum = $bonus_sum * 2;
						//}else{
							
						//}
					
						$bonus_sum = $bonus_sum;
							
						$SQL2 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) ".
						"values ('$mart_id', '$id', '$write_date', $bonus_sum, '$content', '$order_num', 'p')";
						$dbresult2 = mysql_query($SQL2, $dbconn);


						$SQL3 = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus_sum 
						where username='$id' and mart_id='$mart_id'";
						$dbresult3 = mysql_query($SQL3, $dbconn);

						$bonus_sum="";
					}
				}
			}	
		}







	}
################################ End ���� ###################################################################################################################
			
			//����������û ��� ���� DBó��
           //	echo "����������û ��� ���� DBó���Ͻñ� �ٶ��ϴ�.<br>";

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
       $order_str =  $xpay->Response_Msg() . $xpay->Response_Code();
            
    }
###################################################################################################################################################
?>



<?



//����Ʈ ��� (�¶��� �Ա�, ����Ʈ ����)
if( ($paymethod == "byaccount_point" || $paymethod == "bycard_point") && $UnameSess ){
	$bonus_sql = "select * from $BonusTable where order_num = '$order_num' and id = '$UnameSess' and mode='u'";
	$bonus_res = mysql_query($bonus_sql, $dbconn);
	$bonus_tot = mysql_num_rows($bonus_res);
	
	if($bonus_tot <= 0){
		$write_date = date("Ymd H:i:s");
		$content = $order_num." ���ſ� ����Ʈ ���";
		
		$bonus = - $use_bonus_tot;
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num', 'u')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess'";

		$dbresult = mysql_query($SQL, $dbconn);
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
?>
<?
unset($_SESSION["order_num"]);
?>
<?
include "../include/head_alltemplate.php";
?>
<script language=JavaScript>
<!--
//==================== ���콺�����ʱ�����ư�� Ű���� ���� �±� ===========================
document.onkeydown=click;
document.onkeyup=click;
function click(){
	//CTRL+N ����
	if((event.ctrlKey) && (event.keyCode == 78)){
		event.keyCode=null;
		return false;
	}

	//F11 ����
	if (event.keyCode == 122){
		event.keyCode=null;
		return false;  
	}
	
	//F5 ����
	if (event.keyCode == 116){
		event.keyCode=null;
		return false;  
	}
}

function keydown(){
	return false;
}

function onUnload(fo_path){
}

document.onmousedown=click;
document.onkeydown=keydown;

function wload(){
	window.resizeTo(370, 484);
}

function PlayOpen(mName){
	if(MPlayer.PlayState != 2)
	MPlayer.Open(mName);
}
//-->
</script>

<script>
//================================= ��â����(ctrl + N) ���� �ҽ� =======================
function checkKP(){
	if (event.ctrlKey)
	if ((event.keyCode == 78) || (event.keyCode == 104))
		event.returnValue = false;
}
//-->
</script>
<script>
//================================= ��â����(ctrl + N) ���� �ҽ� =======================
function checkKP(){
	if (event.ctrlKey)
	if ((event.keyCode == 78) || (event.keyCode == 104))
		event.returnValue = false;
}
//-->
</script>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="">
<!---------------------- ž�޴� ���� ---------------------------------------------------->

<?
include "../include/top.htm";
?>

<!---------------------- ž�޴� �� ------------------------------------------------------>	
	</td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="1000" align="center" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="238" valign="top">
		  <!----------------------------------����޴� ����------------------------------------------>
          <? include "../include/sub_menu.htm" ?>
      <!----------------------------------����޴� ��------------------------------------------>
        </td>
        <td valign="top"><table width="750" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><?	include "../include/sub_top.htm"; ?>
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="12%"><img src="../images/mypage_1.gif" width="170" height="44"></td>
                        <td width="88%" background="../images/join_2.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><div align="right"><img src="../images/home_icon.gif" width="8" height="9" align="absmiddle"> Ȩ &gt; ���������� &gt; ��ٱ��� </div></td>
                              <td width="2%">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%"><img src="../images/mypage_3.gif" width="277" height="66"></td>
                        <td width="98%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><img src="../images/mypage_4.gif" width="473" height="15"></td>
                            </tr>
                            <tr>
                              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="15%"><a href="../mypage/update.html?mart_id=<?=$mart_id?>"><img src="../images/mypage_5.gif" width="73" height="25" border="0"></a></td>
                                    <td width="2%"><img src="../images/mypage_6.gif" width="4" height="25"></td>
                                    <td width="27%"><a href="../cart/cart.html?mart_id=<?=$mart_id?>&category_num=<?=$category_num?>&category_num1=<?=$category_num1?>&category_num2=<?=$category_num2?>&cate_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no?>"><img src="../images/mypage_over_7.gif" width="62" height="25" border="0"></a></td>
                                    <td width="5%"><img src="../images/mypage_8.gif" width="2" height="25"></td>
                                    <td width="5%"><a href="../mypage/wish.html"><img src="../images/mypage_9.gif" border="0"></a></td>
                                    <td width="5%"><img src="../images/mypage_10.gif"></td>
                                    <td width="5%"><a href="../stat/order.html"><img src="../images/mypage_11.gif" border="0"></a></td>
                                    <td width="5%"><img src="../images/mypage_12.gif"></td>
                                    <td width="5%"><a href="../mypage/send.html"><img src="../images/mypage_13.gif" border="0"></a></td>
                                    <td width="5%"><img src="../images/mypage_14.gif"></td>
                                    <td width="5%"><a href="../mypage/point.html"><img src="../images/mypage_15.gif" border="0"></a></td>
                                    <td width="5%"><img src="../images/mypage_16.gif"></td>
                                    <td width="5%"><a href="../mypage/out.html"><img src="../images/mypage_17.gif" border="0"></a></td>
                                    <td width="6%"><img src="../images/mypage_18.gif"></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="../images/mypage_19.gif" width="473" height="26"></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="../images/mypage_20.gif" width="750" height="46"></td>
                </tr>
                <tr>
                  <td><!---------------------- ������� ���� -------------------------------------------------->
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="90"><img src="../image/mypage/step_1.gif" width="90" height="40"></td>
                          <td width="90"><img src="../image/mypage/step_2.gif" width="90" height="40"></td>
                          <td width="90"><img src="../image/mypage/step_3.gif" width="90" height="40"></td>
                          <td width="90"><img src="../image/mypage/step_4_on.gif" width="90" height="40"></td>
                          <td bgcolor="#F3F3F3">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="20" colspan="5"></td>
                        </tr>
                      </table>
                      <!---------------------- ������� �� -------------------->
                      <!---------------------- �ֹ��� ���� -------------------->
                      <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
                        <tr>
                          <td bgcolor="F1766C" height="3" colspan="2"></td>
                        </tr>
                        <tr align="center">
                          <td height="50" colspan="2"  bgcolor="#F7F7F7" class="product"><?=$order_str?>
						  </td>
                        </tr>
                        <tr>
                          <td width="70"  bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�ֹ���ȣ</td>
                          <td><span class="price">
                            <?=$order_num?>
                          </span></td>
                        </tr>
                        <tr>
                          <td width="70"  bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�ֹ���¥</td>
                          <td><span class="price">
                            <?=$date_str?>
                          </span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�ֹ���ǰ</td>
                          <td><?
$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
//echo $ok_sql."<br>";
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
	$z_price = $ok_row[z_price];
	$bonus = $ok_row[bonus];
		
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ok_row[use_bonus];
	$status = $ok_row[status];
	$quantity = $ok_row[quantity];
	$sum = $z_price*$quantity;

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
	$me_delivery_price = number_format($cart_row1[parcel_price]);

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
                              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td width="70" valign="top"><table width="60" height="60" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="center" background="../image/product/product_back.gif"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$category_num?>&category_num1=<?=$prevno?>&category_num2=<?=$category_num2?>&cate_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no_forcash?>'>
                                          <?=$img_str?>
                                        </a></td>
                                      </tr>
                                  </table></td>
                                  <td><span class="text_red"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$category_num?>&category_num1=<?=$prevno?>&category_num2=<?=$category_num2?>&cate_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no_forcash?>'>[
                                          <?=$item_name?>
                                          ]</a></span>
                                      <?=$if_cash_str?>
                                      <?=$coupon_str?>
                                      <?
	if(isset($opt)&&$opt!=""&&$opt!="!!"){
?>
                                            <br>
                                            �ɼ�:
                                            <?
		$opts = explode("!", $opt);

		if(strstr($opts[0],'^')){
			$opts_1 = explode("^", $opts[0]);
		}else{
			$opts_1[0] = $opts[0];
		}
		
		if($opts_1[0] != ""){
			echo "$opts_1[0]";
		}
		if($opts_1[1] != ""){
			echo "($opts_1[1] ��)&nbsp;";
		}
		if($opts[1] != ""){		
			$opts2_1=explode("^",$opts[1]);

			if($opts2_1[1] == 0 || $opts2_1[1] == ""){
				echo "&nbsp;$opts2_1[0]";
			}else{
				echo "&nbsp;$opts2_1[0](+$opts2_1[1] ��)";
			}

		}
		if($opts[2] != ""){
			$opts3_1=explode("^",$opts[2]);
			if($opts3_1[1] == 0 || $opts3_1[1] == ""){
				echo "&nbsp;$opts3_1[0]";
			}else{
				echo "&nbsp;$opts3_1[0](+$opts3_1[1] ��)";
			}
		}
	}
?>
                                      <br>
                                      <span class="text_14_s2">
                                      <?=$short_explain?>
                                    </span> </td>
                                  <td width='90'>�ܰ� :
                                      <?=$z_price_str?>
                                      ��</td>
                                  <td width='40'><?=$quantity?>
                                    ��</td>
                                  <td width='90'>�հ� :
                                      <?=$sum_str?>
                                      ��</td>
                                  <td width='80' class='mypage_1'>��� :
                                      <?=$me_delivery_str?></td>
                                </tr>
                              </table>
                              <?
}           			
$mon_tot_freight = $mon_tot + $freight_fee;
?>
                          </td>
                        </tr>
<?
if($freight_fee)
{
?>
                        <tr>
                        	<td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">��۷�</td>
                        	<td><span class="text_red"><?=number_format($freight_fee)?>��</span></td>
                       	</tr>
<?
}
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�����ݾ�</td>
                          <td><span class="price">
                            <?=number_format($mon_tot_freight)?>
                            ��</span></td>
                        </tr>
                        <?
if($if_use_bonus == 1){
	$use_bonus_tot_str = number_format($use_bonus_tot);
	//���� �����ؾߵ� �ݾ� 
	$money_to_pay = $mon_tot_freight - $use_bonus_tot;
	$money_to_pay_str = number_format($money_to_pay);

/*	if( !empty($paystr) ){
		$paystr = $paystr." + ����Ʈ ���";
	}else{
		$paystr = "����Ʈ ���";
	}*/

?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">����Ʈ ���</td>
                          <td><span class="price">
                            <?=$use_bonus_tot_str?>
                            ��</span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle"><?=$totpaystr?></td>
                          <td><span class="price">
                            <?=$money_to_pay_str?>
                            ��</span></td>
                        </tr>
                        <?
}
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�������</td>
                          <td><?=$paystr?>
                              <?=$account_str?></td>
                        </tr>
                        <?
if( $use_bonus_tot < $mon_tot_freight ){
?>
                        <?
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�Ա��ڸ�</td>
                          <td><?=$money_sender?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�Աݿ�����</td>
                          <td><?=$pay_day?></td>
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
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">ī���</td>
                          <td><?=$card_name?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">���ι�ȣ</td>
                          <td><?=$app_no?> <a onclick="window.open('http://admin.kcp.co.kr/Modules/Sale/Card/ADSA_CARD_BILL_Receipt.jsp?c_trade_no=<?=$tno?>', 'card_receipt','width=420,height=670');" style="cursor:hand;">[�ſ�ī�� ��ǥ ���]</a></td>
                        </tr>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�Һ�</td>
                          <td><?=$quota_str?>&nbsp;<?=$noinf_str?></td>
                        </tr>
<?
		}
	}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
		$bank_name = $field3;
?>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�����</td>
                          <td><?=$bank_name?></td>
                        </tr>
<?
	}else if($paymethod== 'byescro'){
?>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">����ũ�� ����</td>
                          <td>		
						<script>
						function go()
						{
						window.open("", "wbe_popup", "toolbar=no,menubar=no,location=no,scrollbars=no,status=no,resizable=no,width=450,height=500");
							document.escForm.target = "wbe_popup";
							document.escForm.action = "http://esc.wooribank.com/esc/b2c/register/easyesc/weesc121_01t.jsp";
							document.escForm.submit();
						}
						</script>
						  

						<form name="escForm" method="post">
						<input type="hidden" name="mId" value="admin1357">       <!--�츮����ũ�ο��� ����� ���θ� ���̵� //-->
						<input type="hidden" name="cName" value="<?=$name?>">    <!--���Ű��̸� //-->
						<input type="hidden" name="amt" value="<?=$mon_tot_freight?>">       <!--�ŷ��ݾ� //-->
						<input type="hidden" name="product" value="<?=$item_name?>">    <!--��ǰ�� //-->
						<input type="hidden" name="mTId" value="<?=$order_num?>">      <!--���θ� �ֹ���ȣ(50����Ʈ �̳�)//-->
						<input type="hidden" name="Popbanking" value="Y"> <!--�ǽð� ������ü ��뿩�� value="N"�̸� ��� ����//-->
						</form>
						<a href="javascript:go()"><font color=blue size=3><b>[�츮����ũ�� �����ϱ�]</b></font></a>

				
							</td>
                        </tr>
<?
	}
}
?>                        
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">��Ÿ��û</td>
                          <td><?=nl2br($message)?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">������</td>
                          <td><?=$name?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">����ó</td>
                          <td><?=$tel1?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�޴�����ȣ</td>
                          <td><?=$tel2?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�̸���</td>
                          <td><?=$email?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�ּ�</td>
                          <td>[
                              <?=$buyer_zip?>
                              ]
                              <?=$buyer_address?>
                              <?=$buyer_address_d?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�޴»��</td>
                          <td><?=$receiver?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">����ó</td>
                          <td><?=$rev_tel?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">�޴�����ȣ</td>
                          <td><?=$rev_tel1?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">������ּ�</td>
                          <td>[
                              <?=$zip?>
                              ]
                              <?=$address?>
							  <?=$address_d?></td>
                        </tr>
                        <tr>
                          <td bgcolor="F1766C" height="3" colspan="2"></td>
                        </tr>
                      </table>
                      <!---------------------- �ֹ��� �� ---------------------->
<SCRIPT LANGUAGE="JavaScript">
<!--
function receipt_win(mart_id, order_num){
	var url = "../receipt/receipt.php?mart_id="+mart_id+"&order_num="+order_num;
	var uploadwin = window.open(url,"receipt","width=600,height=550,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}
//-->
</SCRIPT>
                      <!---------------------- ��ư ���� ---------------------->
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="70" align="center"><a href="../main/."><img src="../image/bu_goshop.gif" width="140" height="50" border="0" align="absmiddle"></a>
<? 
if($card_paid == "t"){ ?>
						  <img src="../image/bu_print.gif" width="150" height="50" border="0" style='cursor:hand' onclick="receipt_win('<?=$mart_id?>', '<?=$order_num?>')">
<? } ?>
						  </td>
                        </tr>
                      </table>
                      <!---------------------- ��ư �� ----------------------->
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<!---------------------- �ϴܸ޴� ���� -------------------------------------------------->
<?
include "../include/bottom.htm";
?>
<!---------------------- �ϴܸ޴� �� ---------------------------------------------------->	
	</td>
  </tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>