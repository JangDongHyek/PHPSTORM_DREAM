<?php
include_once("../../connect.php");

/*************************************************************************/
/* payapp                                                                */
/* copyright �� 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp �����κ��� ������û���� ������ ���޹޾� ó���մϴ�.          */
/*                                                                       */
/*************************************************************************/

/*
�� �������� payapp �������� ȣ���� �ϴ� ������ �Դϴ�. ���� ����ڴ� ���������� �� �� �����ϴ�.
���������� payapp.kr���� ������ �����ؾ� �մϴ�.

payapp.kr���� �����ʹ� POST�� ������ �մϴ�.
*/


/*
$_POST['userid'];	�Ǹ��� ȸ�� ���̵�
$_POST['linkkey'];	���� KEY
$_POST['linkval'];	���� VALUE
$_POST['goodname'];	��ǰ��
$_POST['price'];	������û �ݾ�
$_POST['recvphone'];���� �޴�����ȣ
$_POST['memo'];		�޸�
$_POST['reqaddr'];	�ּҿ�û (1:��û, 0:��û����)
$_POST['reqdate'];	������û �Ͻ�
$_POST['pay_memo'];	������ �Է��� �޸�
$_POST['pay_addr'];	������ �Է��� �ּ�
$_POST['pay_date'];	�������� �Ͻ�
$_POST['pay_type'];	�������� (1:�ſ�ī��, 2:�޴���ȭ, 3:USDī��, 4:������, 6:������ü, 7:�������, 9:��ȭ��ǰ��)
$_POST['pay_state'];������û ���� (4:�����Ϸ�, 8,16,31:��û���, 9,64:�������)
$_POST['var1'];		���� ��� ���� 1
$_POST['var2'];		���� ��� ���� 2
$_POST['mul_no'];	������û��ȣ
$_POST['payurl'];	���������� �ּ�
$_POST['csturl'];	������ǥURL
$_POST['card_name'];	�ſ�ī���
$_POST['currency'];	��ȭ (krw:��ȭ,usd:�޷�)
$_POST['vccode'];	������ȭ ������ȣ
$_POST['score'];	DM Score (currency�� usd�̰� ���������� �� DM ����
*/

// �Ʒ� ������ payapp �Ǹ����� ������ �Է��ϼ���.
// �Ǹ��� ����Ʈ�� �ִ� ����KEY, ����VALUE�� �Ϲ� ����ڿ��� ������ ���� �ʵ��� ���� �Ͻñ� �ٶ��ϴ�.
$payapp_userid	= 'buseong';	// payapp �Ǹ��� ���̵�
$payapp_linkkey	= 'r018aLN0ThpV+HmjWH1pDe1DPJnCCRVaOgT+oqg6zaM=';				// payapp ����key, �Ǹ��� ����Ʈ �α��� �� ���� �޴����� Ȯ�� ����
$payapp_linkval	= 'r018aLN0ThpV+HmjWH1pDf5bkQcclgThsGdp7PR0foQ=';				// payapp ����value, �Ǹ��� ����Ʈ �α��� �� ���� �޴����� Ȯ�� ����

$order_num = $_POST['var1'];
$pay_type = $_POST['pay_type'];
$check_userid	= $_POST['userid'];
$check_key	= $_POST['linkkey'];
$check_val	= $_POST['linkval'];
$price = $_POST['price'];
$pay_date =$_POST['pay_date'];
$mul_no =$_POST['mul_no'];
$card_name = $_POST['card_name'];
$card_name = iconv("utf8", "euckr", $card_name);
$csturl = $_POST['csturl'];
$pay_memo = $_POST['pay_memo'];
$pay_memo = iconv("utf8", "euckr", $pay_memo);
$pay_addr = $_POST['pay_addr'];
$pay_addr = iconv("utf8", "euckr", $pay_addr);

/*
userid, linkkey, linkval ���� �� Ȯ�� �ϰ� ������ ��쿡�� �������θ� ó�� �ϼž� �մϴ�.
*/

if( $check_userid == $payapp_userid && $check_key == $payapp_linkkey && $check_val == $payapp_linkval )
{
	switch( $_POST['pay_state'] )
	{
		case '4':
			// �����Ϸ�

			/*
			TODO : �̰����� �����Ϸ� ó���� �մϴ�.

			ex) UPDATE payrequest SET pay_state='�����Ϸ�', pay_date='{$_POST['pay_date']}' WHERE orderno='$_POST['var1']' AND mul_no={$_POST['mul_no']};
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// �̹� order_buy�� ����Ǿ� ������


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy set paymethod='bycard', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy set paymethod='byaccount', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='2' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy_temp set paymethod='byaccount', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num' and mart_id='$mart_id')";
				mysql_query($ordcopy_sql, $dbconn);

				$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num' and mart_id='$mart_id'";
				mysql_query($ordcopy_sql1, $dbconn);
				
				$sql2 = "update order_pro set status='2' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}

			break;
		case '8':
		case '16':
		case '31':
			// ��û���

			/*
			TODO : �̰����� ������û ��� ó���� �մϴ�. (�������� ���� ���¿��� ���)
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// �̹� order_buy�� ����Ǿ� ������


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy set paymethod='bycard', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy set paymethod='byaccount', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='5' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy_temp set paymethod='byaccount', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num' and mart_id='$mart_id')";
				mysql_query($ordcopy_sql, $dbconn);

				$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num' and mart_id='$mart_id'";
				mysql_query($ordcopy_sql1, $dbconn);

				$sql2 = "update order_pro set status='5' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}

			break;
		case '9':
		case '64':
			// �������

			/*
			TODO : �̰����� �������� ��� ó���� �մϴ�. (�����Ϸ� ���¿��� ���)

			ex) UPDATE payrequest SET pay_state='�������', pay_date='{$_POST['pay_date']}' WHERE orderno='$_POST['var1']' AND mul_no={$_POST['mul_no']};
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// �̹� order_buy�� ����Ǿ� ������


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy set paymethod='bycard', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy set paymethod='byaccount', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='10' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// �ſ�ī��
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// ������ü
					$sql = "update order_buy_temp set paymethod='byaccount', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num' and mart_id='$mart_id')";
				mysql_query($ordcopy_sql, $dbconn);

				$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num' and mart_id='$mart_id'";
				mysql_query($ordcopy_sql1, $dbconn);

				$sql2 = "update order_pro set status='10' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}

			break;
		default:
			break;
	}
}


// ó������
echo 'SUCCESS';
// ó������
//echo 'FAIL';

exit;


?>