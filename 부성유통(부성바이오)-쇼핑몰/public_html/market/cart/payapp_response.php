<?php
include_once("../../connect.php");

/*************************************************************************/
/* payapp                                                                */
/* copyright ⓒ 2012 UDID. all right reserved.                           */
/*                                                                       */
/* oapi sample                                                           */
/* - version 004-001                                                     */
/* - payapp 서버로부터 결제요청상태 정보를 전달받아 처리합니다.          */
/*                                                                       */
/*************************************************************************/

/*
이 페이지는 payapp 서버에서 호출을 하는 페이지 입니다. 따라서 사용자는 이페이지를 볼 수 없습니다.
본페이지는 payapp.kr에서 접속이 가능해야 합니다.

payapp.kr에서 데이터는 POST로 전송을 합니다.
*/


/*
$_POST['userid'];	판매자 회원 아이디
$_POST['linkkey'];	연동 KEY
$_POST['linkval'];	연동 VALUE
$_POST['goodname'];	상품명
$_POST['price'];	결제요청 금액
$_POST['recvphone'];수신 휴대폰번호
$_POST['memo'];		메모
$_POST['reqaddr'];	주소요청 (1:요청, 0:요청안함)
$_POST['reqdate'];	결제요청 일시
$_POST['pay_memo'];	결제시 입력한 메모
$_POST['pay_addr'];	결제시 입력한 주소
$_POST['pay_date'];	결제승인 일시
$_POST['pay_type'];	결제수단 (1:신용카드, 2:휴대전화, 3:USD카드, 4:대면결제, 6:계좌이체, 7:가상계좌, 9:문화상품권)
$_POST['pay_state'];결제요청 상태 (4:결제완료, 8,16,31:요청취소, 9,64:승인취소)
$_POST['var1'];		임의 사용 변수 1
$_POST['var2'];		임의 사용 변수 2
$_POST['mul_no'];	결제요청번호
$_POST['payurl'];	결제페이지 주소
$_POST['csturl'];	매출전표URL
$_POST['card_name'];	신용카드명
$_POST['currency'];	통화 (krw:원화,usd:달러)
$_POST['vccode'];	국제전화 국가번호
$_POST['score'];	DM Score (currency가 usd이고 결제성공일 때 DM 점수
*/

// 아래 정보를 payapp 판매자의 정보로 입력하세요.
// 판매자 사이트에 있는 연동KEY, 연동VALUE는 일반 사용자에게 노출이 되지 않도록 주의 하시기 바랍니다.
$payapp_userid	= 'buseong';	// payapp 판매자 아이디
$payapp_linkkey	= 'r018aLN0ThpV+HmjWH1pDe1DPJnCCRVaOgT+oqg6zaM=';				// payapp 연동key, 판매자 사이트 로그인 후 설정 메뉴에서 확인 가능
$payapp_linkval	= 'r018aLN0ThpV+HmjWH1pDf5bkQcclgThsGdp7PR0foQ=';				// payapp 연동value, 판매자 사이트 로그인 후 설정 메뉴에서 확인 가능

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
userid, linkkey, linkval 값을 비교 확인 하고 동일한 경우에만 결제여부를 처리 하셔야 합니다.
*/

if( $check_userid == $payapp_userid && $check_key == $payapp_linkkey && $check_val == $payapp_linkval )
{
	switch( $_POST['pay_state'] )
	{
		case '4':
			// 결제완료

			/*
			TODO : 이곳에서 결제완료 처리를 합니다.

			ex) UPDATE payrequest SET pay_state='결제완료', pay_date='{$_POST['pay_date']}' WHERE orderno='$_POST['var1']' AND mul_no={$_POST['mul_no']};
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// 이미 order_buy에 저장되어 있을때


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy set paymethod='bycard', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
					$sql = "update order_buy set paymethod='byaccount', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='2' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='t', status='2', authnumber='', payment_date='$pay_date', field1='', field2='', field3='$card_name', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
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
			// 요청취소

			/*
			TODO : 이곳에서 결제요청 취소 처리를 합니다. (결제하지 않은 상태에서 취소)
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// 이미 order_buy에 저장되어 있을때


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy set paymethod='bycard', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
					$sql = "update order_buy set paymethod='byaccount', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='5' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='f', status='5', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
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
			// 승인취소

			/*
			TODO : 이곳에서 결제승인 취소 처리를 합니다. (결제완료 상태에서 취소)

			ex) UPDATE payrequest SET pay_state='결제취소', pay_date='{$_POST['pay_date']}' WHERE orderno='$_POST['var1']' AND mul_no={$_POST['mul_no']};
			*/
			$chk_sql = "select * from order_buy where mart_id='$mart_id' and order_num='$order_num'";
			$chk_qry = mysql_query($chk_sql,$dbconn);
			$chk_num = mysql_num_rows($chk_qry);
			if($chk_num > 0){	// 이미 order_buy에 저장되어 있을때


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy set paymethod='bycard', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
					$sql = "update order_buy set paymethod='byaccount', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}
				mysql_query($sql,$dbconn);

				$sql2 = "update order_pro set status='10' where mart_id='$mart_id' and order_num='$order_num'";
				mysql_query($sql2,$dbconn);


			}else{


				if($pay_type == 1){	// 신용카드
					$sql = "update order_buy_temp set paymethod='bycard', card_paid='f', status='10', authnumber='', payment_date='$pay_date', field1='', field2='', field3='', field4='', field5='$pay_memo', csturl='$csturl', pay_addr='$pay_addr' where mart_id='$mart_id' and order_num='$order_num' and mul_no='$mul_no'";
				}

				if($pay_type == 6){	// 계좌이체
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


// 처리응답
echo 'SUCCESS';
// 처리실패
//echo 'FAIL';

exit;


?>