<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
//================== �Լ� ������ �ҷ��� ==================================================
include "../../main.class";
?>
<?
include "../../market/include/getmartinfo.php";
?>
<?php
    /*
     * ���������� ���� 
     */
    $LGD_RESPCODE = "";           			// �����ڵ�: 0000(����) �׿� ����
    $LGD_RESPMSG = "";            			// ����޼���
    $LGD_MID = "";                			// �������̵� 
    $LGD_OID = "";                			// �ֹ���ȣ
    $LGD_AMOUNT = "";             			// �ŷ��ݾ�
    $LGD_TID = "";                			// �������� �ο��� �ŷ���ȣ
    $LGD_PAYTYPE = "";            			// ���������ڵ�
    $LGD_PAYDATE = "";            			// �ŷ��Ͻ�(�����Ͻ�/��ü�Ͻ�)
    $LGD_HASHDATA = "";           			// �ؽ���
    $LGD_FINANCECODE = "";        			// ��������ڵ�(ī������/�����ڵ�/������ڵ�)
    $LGD_FINANCENAME = "";        			// ��������̸�(ī���̸�/�����̸�/������̸�)
    $LGD_ESCROWYN = "";           			// ����ũ�� ���뿩��
    $LGD_TIMESTAMP = "";          			// Ÿ�ӽ�����
    $LGD_FINANCEAUTHNUM = "";     			// ������� ���ι�ȣ(�ſ�ī��, ������ü, ��ǰ��)
	
    /*
     * �ſ�ī�� ������� ����
     */
    $LGD_CARDNUM = "";            			// ī���ȣ(�ſ�ī��)
    $LGD_CARDINSTALLMONTH = "";   			// �Һΰ�����(�ſ�ī��) 
    $LGD_CARDNOINTYN = "";        			// �������Һο���(�ſ�ī��) - '1'�̸� �������Һ� '0'�̸� �Ϲ��Һ�
    $LGD_TRANSAMOUNT = "";        			// ȯ������ݾ�(�ſ�ī��)
    $LGD_EXCHANGERATE = "";       			// ȯ��(�ſ�ī��)

    /*
     * �޴���
     */
    $LGD_PAYTELNUM = "";          			// ������ �̿����ȭ��ȣ

    /*
     * ������ü, ������
     */
    $LGD_ACCOUNTNUM = "";         			// ���¹�ȣ(������ü, �������Ա�) 
    $LGD_CASTAMOUNT = "";         			// �Ա��Ѿ�(�������Ա�)
    $LGD_CASCAMOUNT = "";         			// ���Աݾ�(�������Ա�)
    $LGD_CASFLAG = "";            			// �������Ա� �÷���(�������Ա�) - 'R':�����Ҵ�, 'I':�Ա�, 'C':�Ա���� 
    $LGD_CASSEQNO = "";           			// �Աݼ���(�������Ա�)
    $LGD_CASHRECEIPTNUM = "";     			// ���ݿ����� ���ι�ȣ
    $LGD_CASHRECEIPTSELFYN = "";  			// ���ݿ����������߱������� Y: �����߱��� ����, �׿� : ������
    $LGD_CASHRECEIPTKIND = "";    			// ���ݿ����� ���� 0: �ҵ������ , 1: ����������

    /*
     * OKĳ����
     */
    $LGD_OCBSAVEPOINT = "";       			// OKĳ���� ��������Ʈ
    $LGD_OCBTOTALPOINT = "";      			// OKĳ���� ��������Ʈ
    $LGD_OCBUSABLEPOINT = "";     			// OKĳ���� ��밡�� ����Ʈ

    /*
     * ��������
     */
    $LGD_BUYER = "";              			// ������
    $LGD_PRODUCTINFO = "";        			// ��ǰ��
    $LGD_BUYERID = "";            			// ������ ID
    $LGD_BUYERADDRESS = "";       			// ������ �ּ�
    $LGD_BUYERPHONE = "";         			// ������ ��ȭ��ȣ
    $LGD_BUYEREMAIL = "";         			// ������ �̸���
    $LGD_BUYERSSN = "";           			// ������ �ֹι�ȣ
    $LGD_PRODUCTCODE = "";        			// ��ǰ�ڵ�
    $LGD_RECEIVER = "";           			// ������
    $LGD_RECEIVERPHONE = "";      			// ������ ��ȭ��ȣ
    $LGD_DELIVERYINFO = "";       			// �����
    

    $LGD_RESPCODE            = $HTTP_POST_VARS["LGD_RESPCODE"];
    $LGD_RESPMSG             = $HTTP_POST_VARS["LGD_RESPMSG"];
    $LGD_MID                 = $HTTP_POST_VARS["LGD_MID"];
    $LGD_OID                 = $HTTP_POST_VARS["LGD_OID"];
    $LGD_AMOUNT              = $HTTP_POST_VARS["LGD_AMOUNT"];
    $LGD_TID                 = $HTTP_POST_VARS["LGD_TID"];
    $LGD_PAYTYPE             = $HTTP_POST_VARS["LGD_PAYTYPE"];
    $LGD_PAYDATE             = $HTTP_POST_VARS["LGD_PAYDATE"];
    $LGD_HASHDATA            = $HTTP_POST_VARS["LGD_HASHDATA"];
    $LGD_FINANCECODE         = $HTTP_POST_VARS["LGD_FINANCECODE"];
    $LGD_FINANCENAME         = $HTTP_POST_VARS["LGD_FINANCENAME"];
    $LGD_ESCROWYN            = $HTTP_POST_VARS["LGD_ESCROWYN"];
    $LGD_TRANSAMOUNT         = $HTTP_POST_VARS["LGD_TRANSAMOUNT"];
    $LGD_EXCHANGERATE        = $HTTP_POST_VARS["LGD_EXCHANGERATE"];
    $LGD_CARDNUM             = $HTTP_POST_VARS["LGD_CARDNUM"];
    $LGD_CARDINSTALLMONTH    = $HTTP_POST_VARS["LGD_CARDINSTALLMONTH"];
    $LGD_CARDNOINTYN         = $HTTP_POST_VARS["LGD_CARDNOINTYN"];
    $LGD_TIMESTAMP           = $HTTP_POST_VARS["LGD_TIMESTAMP"];
    $LGD_FINANCEAUTHNUM      = $HTTP_POST_VARS["LGD_FINANCEAUTHNUM"];
    $LGD_PAYTELNUM           = $HTTP_POST_VARS["LGD_PAYTELNUM"];
    $LGD_ACCOUNTNUM          = $HTTP_POST_VARS["LGD_ACCOUNTNUM"];
    $LGD_CASTAMOUNT          = $HTTP_POST_VARS["LGD_CASTAMOUNT"];
    $LGD_CASCAMOUNT          = $HTTP_POST_VARS["LGD_CASCAMOUNT"];
    $LGD_CASFLAG             = $HTTP_POST_VARS["LGD_CASFLAG"];
    $LGD_CASSEQNO            = $HTTP_POST_VARS["LGD_CASSEQNO"];
    $LGD_CASHRECEIPTNUM      = $HTTP_POST_VARS["LGD_CASHRECEIPTNUM"];
    $LGD_CASHRECEIPTSELFYN   = $HTTP_POST_VARS["LGD_CASHRECEIPTSELFYN"];
    $LGD_CASHRECEIPTKIND     = $HTTP_POST_VARS["LGD_CASHRECEIPTKIND"];
    $LGD_OCBSAVEPOINT        = $HTTP_POST_VARS["LGD_OCBSAVEPOINT"];
    $LGD_OCBTOTALPOINT       = $HTTP_POST_VARS["LGD_OCBTOTALPOINT"];
    $LGD_OCBUSABLEPOINT      = $HTTP_POST_VARS["LGD_OCBUSABLEPOINT"];

    $LGD_BUYER               = $HTTP_POST_VARS["LGD_BUYER"];
    $LGD_PRODUCTINFO         = $HTTP_POST_VARS["LGD_PRODUCTINFO"];
    $LGD_BUYERID             = $HTTP_POST_VARS["LGD_BUYERID"];
    $LGD_BUYERADDRESS        = $HTTP_POST_VARS["LGD_BUYERADDRESS"];
    $LGD_BUYERPHONE          = $HTTP_POST_VARS["LGD_BUYERPHONE"];
    $LGD_BUYEREMAIL          = $HTTP_POST_VARS["LGD_BUYEREMAIL"];
    $LGD_BUYERSSN            = $HTTP_POST_VARS["LGD_BUYERSSN"];
    $LGD_PRODUCTCODE         = $HTTP_POST_VARS["LGD_PRODUCTCODE"];
    $LGD_RECEIVER            = $HTTP_POST_VARS["LGD_RECEIVER"];
    $LGD_RECEIVERPHONE       = $HTTP_POST_VARS["LGD_RECEIVERPHONE"];
    $LGD_DELIVERYINFO        = $HTTP_POST_VARS["LGD_DELIVERYINFO"];

    $LGD_MERTKEY = "fa1865ca207c711910627982412c734e";  //LG �ڷ��޿��� �߱��� ����Ű�� ������ �ֽñ� �ٶ��ϴ�.
       
    $LGD_HASHDATA2 = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_RESPCODE.$LGD_TIMESTAMP.$LGD_MERTKEY); 

    /*
     * ���� ó����� ���ϸ޼���
     *
     * OK   : ���� ó����� ����
     * �׿� : ���� ó����� ����
     *
     * �� ���ǻ��� : ������ 'OK' �����̿��� �ٸ����ڿ��� ���ԵǸ� ����ó�� �ǿ��� �����Ͻñ� �ٶ��ϴ�.
     */    
    $resultMSG = "������� ���� DBó��(NOTE_URL) ������� �Է��� �ֽñ� �ٶ��ϴ�.";
	  
	


		###########���뺯��###########3
		$order_num = $LGD_OID;
		if($LGD_PAYTYPE == "SC0010"){
			$paymethod = "bycard";
		}elseif($LGD_PAYTYPE == "SC0030"){
			$paymethod = "byaccount";
		}
		
		$res_cd =	$LGD_RESPCODE; //�����ڵ�
		$order_num =$LGD_OID; //���� �ֹ���ȣ
		#######ī������#############
		$app_no =	$LGD_FINANCEAUTHNUM;//����������ι�ȣ
		$paydate =  $LGD_PAYDATE; //�����Ͻ�
		$tno =		$LGD_TID; //������ �ŷ���ȣ
		$quota =	$LGD_CARDINSTALLMONTH; //ī�� �Һΰ���
		$noinf =	$LGD_CARDNOINTYN;//������ �Һ� 
		$res_msg =	$LGD_RESPMSG;//����޼���
		$card_name =$LGD_FINANCENAME;//ī���
		############################3
		if($noinf == 1){ //������
			$noinf = "y";
		}else{ //�Ϲ�
			$noinf = "n";
		}





    if ($LGD_HASHDATA2 == $LGD_HASHDATA) {      //�ؽ��� ������ �����ϸ�
        if($LGD_RESPCODE == "0000"){            //������ �����̸�
            /*
             * �ŷ����� ��� ���� ó��(DB) �κ� */

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

			
             //* ���� ��� ó���� �����̸� "OK"
              
            //if( �������� ����ó����� ���� ) 

					$resultMSG = "OK";   


				}
			################################ End ���� ###################################################################################################################




            
			
			

        }else {                                 //������ �����̸�
            /*
             * �ŷ����� ��� ���� ó��(DB) �κ�
             * ������� ó���� �����̸� "OK"
             */  



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

							//if( �������� ����ó����� ���� ) 
							$resultMSG = "OK";    


						}
			######################################################### End ���� ##################################################################    



        }
    } else {                                    //�ؽ��� ������ �����̸�
        /*
         * hashdata���� ���� �α׸� ó���Ͻñ� �ٶ��ϴ�. 
         */  
		$resultMSG = "������� ���� DBó��(NOTE_URL) �ؽ��� ������ �����Ͽ����ϴ�.";         
    }

    echo $resultMSG;       
	
	

?>
