<?php
include_once('./_common.php');
/**********************************************************************************/
//이부분에 로그파일 경로를 수정해주세요.	
$LogPath = G5_PATH."/innopay/log";
/**********************************************************************************/
$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP,0, 13);
// 주문번호를 얻는다.
$od_id = $_REQUEST[moid];


/*******************************************************************************
 * 변수명           한글명
 *--------------------------------------------------------------------------------
 ********************************************************************************
 * 공통
 ********************************************************************************
 * transSeq			거래번호
 * userId			사용자아이디
 * userName			사용자이름
 * userPhoneNo		사용자휴대폰번호
 * moid				주문번호
 * goodsName		상품명
 * goodsAmt			상품금액
 * buyerName		구매자명
 * buyerPhoneNo		구매자휴대폰번호
 * pgCode			PG코드 ( 01:NICE / 02:KICC / 03:INFINISOFT / 04:KSNET / 05:KCP / 06:SMATRO )
 * pgName			PG명
 * payMethod		결제수단( 01:현금결제 / 02:신용카드 / 03:신용카드ARS )
 * payMethodName	결제수단명
 * pgMid			PG아이디
 * pgSid			PG서비스아이디
 * status			거래상태 ( 25:결제완료 / 85:결제취소 )
 * statusName		거래상태명
 * pgResultCode		PG결과코드
 * pgResultMsg		PG결과메세지
 * pgAppDate		PG승인일자
 * pgAppTime		PG승인시간
 * pgTid			PG거래번호
 * approvalAmt		승인금액
 * approvalNo		승인번호
 * stateCd			거래상태값 ( 0:승인 / 1:매입전취소 / 2:매입후취소 )
 ********************************************************************************
 * 현글결제(현금영수증)
 ********************************************************************************
 * cashReceiptType			증빙구분 ( 1:소득공제 / 2:지출증빙 )
 * cashReceiptTypeName		증빙구분명
 * cashReceiptSupplyAmt		공급가
 * cashReceiptVat			부가세
 ********************************************************************************
 * 신용카드결제
 ********************************************************************************
 * cardNo					카드번호
 * cardQuota				할부개월
 * cardIssueCode			발급사코드 ( 메뉴얼참조 )
 * cardIssueName			발급사명
 * cardAcquireCode			매입사코드 ( 메뉴얼참조 )
 * cardAcquireName			매입사명
 ********************************************************************************
 * 결제취소
 ********************************************************************************
 * cancelAmt				취소요청금액
 * cancelMsg				취소요청메세지
 * cancelResultCode			취소결과코드
 * cancelResultMsg			취소결과메세지
 * cancelAppDate			취소승인일자
 * cancelAppTime			취소승인시간
 * cancelPgTid				PG거래번호
 * cancelApprovalAmt		승인금액
 * cancelApprovalNo			승인번호
*******************************************************************************/

	$transSeq      	= $transSeq;
	$userId        	= $userId;
	$userName      	= $userName;
	$userPhoneNo   	= $userPhoneNo;
	$moid          	= $MOID;
	$goodsName     	= $goodsName;
	$goodsAmt      	= $goodsAmt;
	$buyerName     	= $buyerName;
	$buyerPhoneNo  	= $buyerPhoneNo;
	$pgCode        	= $pgCode;
	$pgName        	= $pgName;
	$payMethod     	= $payMethod;
	$payMethodName 	= $payMethodName;
	$pgMid         	= $pgMid;
	$pgSid         	= $pgSid;
	$status        	= $status;
	$statusName    	= $statusName;
	$pgResultCode  	= $pgResultCode;
	$pgResultMsg   	= $pgResultMsg;
	$pgAppDate     	= $pgAppDate;
	$pgAppTime     	= $pgAppTime;
	$pgTid         	= $pgTid;
	$approvalAmt   	= $approvalAmt;
	$approvalNo    	= $approvalNo;
  $stateCd       	= $stateCd;

	
	if($payMethod == '01'){
		//현금결제(현금영수증)
		$cashReceiptType		= $cashReceiptType;
		$cashReceiptTypeName	= $cashReceiptTypeName;
		$cashReceiptSupplyAmt	= $cashReceiptSupplyAmt;
		$cashReceiptVat			= $cashReceiptVat;

	}else if($payMethod == '02' || $payMethod == '03'){
		//신용카드 & 신용카드ARS
		$cardNo				= $cardNo;
		$cardQuota			= $cardQuota;
		$cardIssueCode		= $cardIssueCode;
		$cardIssueName		= $cardIssueName;
		$cardAcquireCode	= $cardAcquireCode;
		$cardAcquireName	= $cardAcquireName;
	}


	if($status == '85'){
		//결제취소
		$cancelAmt			= $cancelAmt;
		$cancelMsg			= $cancelMsg;
		$cancelResultCode	= $cancelResultCode;
		$cancelResultMsg	= $cancelResultMsg;
		$cancelAppDate		= $cancelAppDate;
		$cancelAppTime		= $cancelAppTime;
		$cancelPgTid		= $cancelPgTid;
		$cancelApprovalAmt	= $cancelApprovalAmt;
		$cancelApprovalNo	= $cancelApprovalNo;
	}

	//상품 정보가 추가될 경우 (주석제거)
	//$goodsSize			= $goodsSize;
	//$goodsCodeArray		= $goodsCodeArray;
	//$goodsNameArray		= $goodsNameArray;
	//$goodsAmtArray		= $goodsAmtArray;
	//$goodsCntArray		= $goodsCntArray;
	//$totalAmtArray		= $totalAmtArray;

	//배송지 정보가 추가될 경우 (주석제거)
	//$zoneCode				= $zoneCode;
	//$address				= $address;
	//$addressDetail		= $addressDetail;
	//$recipientName		= $recipientName;
	//$recipientPhoneNo		= $recipientPhoneNo;
	//$comment				= $comment;


	$PageCall = date("Y-m-d [H:i:s]",time());
    $logfile = fopen( $LogPath . "/innopay_receive.log", "a+" );
    
    fwrite( $logfile,"************************************************\r\n");
	fwrite( $logfile,"PageCall time : ".$PageCall."\r\n");
	fwrite( $logfile,"transSeq      : ".$transSeq."\r\n");
	fwrite( $logfile,"userId        : ".$userId."\r\n");
	fwrite( $logfile,"userName      : ".$userName."\r\n");
	fwrite( $logfile,"userPhoneNo   : ".$userPhoneNo."\r\n");
	fwrite( $logfile,"moid          : ".$moid."\r\n");
	fwrite( $logfile,"goodsName     : ".$goodsName."\r\n");
	fwrite( $logfile,"goodsAmt      : ".$goodsAmt."\r\n");
	fwrite( $logfile,"buyerName     : ".$buyerName."\r\n");
	fwrite( $logfile,"buyerPhoneNo  : ".$buyerPhoneNo."\r\n");
	fwrite( $logfile,"pgCode        : ".$pgCode."\r\n");
	fwrite( $logfile,"pgName        : ".$pgName."\r\n");
	fwrite( $logfile,"payMethod     : ".$payMethod."\r\n");
	fwrite( $logfile,"payMethodName : ".$payMethodName."\r\n");
	fwrite( $logfile,"pgMid         : ".$pgMid."\r\n");
	fwrite( $logfile,"pgSid         : ".$pgSid."\r\n");
	fwrite( $logfile,"status        : ".$status."\r\n");
	fwrite( $logfile,"statusName    : ".$statusName."\r\n");
	fwrite( $logfile,"pgResultCode  : ".$pgResultCode."\r\n");
	fwrite( $logfile,"pgResultMsg   : ".$pgResultMsg."\r\n");
	fwrite( $logfile,"pgAppDate     : ".$pgAppDate."\r\n");
	fwrite( $logfile,"pgAppTime     : ".$pgAppTime."\r\n");
	fwrite( $logfile,"pgTid         : ".$pgTid."\r\n");
	fwrite( $logfile,"approvalAmt   : ".$approvalAmt."\r\n");
	fwrite( $logfile,"approvalNo    : ".$approvalNo."\r\n");
    fwrite( $logfile,"stateCd       : ".$stateCd."\r\n");

	if($payMethod == '01'){
		fwrite( $logfile,"cashReceiptType       : ".$cashReceiptType."\r\n");
		fwrite( $logfile,"cashReceiptTypeName   : ".$cashReceiptTypeName."\r\n");
		fwrite( $logfile,"cashReceiptSupplyAmt  : ".$cashReceiptSupplyAmt."\r\n");
		fwrite( $logfile,"cashReceiptVat        : ".$cashReceiptVat."\r\n");
	} else if($payMethod == '02' || $payMethod == '03'){
		fwrite( $logfile,"cardNo          : ".$cardNo."\r\n");
		fwrite( $logfile,"cardQuota       : ".$cardQuota."\r\n");
		fwrite( $logfile,"cardIssueCode   : ".$cardIssueCode."\r\n");
		fwrite( $logfile,"cardIssueName   : ".$cardIssueName."\r\n");
		fwrite( $logfile,"cardAcquireCode : ".$cardAcquireCode."\r\n");
		fwrite( $logfile,"cardAcquireName : ".$cardAcquireName."\r\n");
	}
	
	if($status == '85'){
		fwrite( $logfile,"cancelAmt         : ".$cancelAmt."\r\n");
		fwrite( $logfile,"cancelMsg         : ".$cancelMsg."\r\n");
		fwrite( $logfile,"cancelResultCode  : ".$cancelResultCode."\r\n");
		fwrite( $logfile,"cancelResultMsg   : ".$cancelResultMsg."\r\n");
		fwrite( $logfile,"cancelAppDate     : ".$cancelAppDate."\r\n");
		fwrite( $logfile,"cancelAppTime     : ".$cancelAppTime."\r\n");
		fwrite( $logfile,"cancelPgTid       : ".$cancelPgTid."\r\n");
		fwrite( $logfile,"cancelApprovalAmt : ".$cancelApprovalAmt."\r\n");
		fwrite( $logfile,"cancelApprovalNo  : ".$cancelApprovalNo."\r\n");
	
	}

	//상품 정보가 추가될 경우 (주석제거)
	//fwrite( $logfile,"goodsSize  		: ".$goodsSize."\r\n");
	//fwrite( $logfile,"goodsCodeArray  : ".$goodsCodeArray."\r\n");
	//fwrite( $logfile,"goodsNameArray  : ".$goodsNameArray."\r\n");
	//fwrite( $logfile,"goodsAmtArray  	: ".$goodsAmtArray."\r\n");
	//fwrite( $logfile,"goodsCntArray  	: ".$goodsCntArray."\r\n");
	//fwrite( $logfile,"totalAmtArray  	: ".$totalAmtArray."\r\n");

	//배송지 정보가 추가될 경우 (주석제거)
	//fwrite( $logfile,"zoneCode  		: ".$zoneCode."\r\n");
	//fwrite( $logfile,"address  		: ".$address."\r\n");
	//fwrite( $logfile,"addressDetail  	: ".$addressDetail."\r\n");
	//fwrite( $logfile,"recipientName  	: ".$recipientName."\r\n");
	//fwrite( $logfile,"recipientPhoneNo: ".$recipientPhoneNo."\r\n");
	//fwrite( $logfile,"comment  		: ".$comment."\r\n");
	
    fwrite( $logfile,"************************************************");
    fclose( $logfile );

//************************************************************************************

        //위에서 상점 데이터베이스에 등록 성공유무에 따라서 성공시에는 "0000"를 인피니로
        //리턴하셔야합니다. 아래 조건에 데이터베이스 성공시 받는 FLAG 변수를 넣으세요
        //(주의) "0000"를 리턴하지 않으시면 인피니 지불 서버는 "0000"를 수신할때까지 계속 재전송(최대지정횟수)을 시도합니다
        //기타 다른 형태의 PRINT( echo )는 하지 않으시기 바랍니다

//      if (데이터베이스 등록 성공 유무 조건변수 = true)
//      {

               // echo "0000";                        // 절대로 지우지마세요

//      }

//*************************************************************************************
if($pgResultCode=="0000"){
	
		$sql = " select * from {$g5['g5_shop_order_data_table']} where od_id = '$od_id' or cart_id='$od_id' order by od_id desc";
		$od = sql_fetch($sql);
		$od_id=$od[od_id];

		// 주문정보
		$data = unserialize(base64_decode($od['dt_data']));
		$sql_common = " from {$g5['g5_shop_cart_table']} where od_id = '$od_id' and ct_status = '쇼핑' ";
		// 주문금액
		$sql = " select SUM(IF(io_type = 1, io_price, (ct_price + io_price)) * ct_qty) as od_price, COUNT(distinct it_id) as cart_count $sql_common ";
		$row = sql_fetch($sql);
		$tot_ct_price  = $row['od_price'];
		$cart_count    = $row['cart_count'];
		$tot_od_price  = $tot_ct_price;
		$i_price       = (int)$data['od_price'];
		$i_send_cost   = (int)$data['od_send_cost'];
		$i_send_cost2  = (int)$data['od_send_cost2'];
		$i_send_coupon = (int)$data['od_send_coupon'];
		$i_temp_point  = (int)$data['od_temp_point'];

		// 쿠폰금액
		$tot_cp_price = 0;
		if($od['mb_id']) {
			// 상품쿠폰
			$tot_it_cp_price = $tot_od_cp_price = 0;
			$it_cp_cnt = count($data['cp_id']);
			$arr_it_cp_prc = array();
			for($i=0; $i<$it_cp_cnt; $i++) {
				$cid = $data['cp_id'][$i];
				$it_id = $data['it_id'][$i];
				$sql = " select cp_id, cp_method, cp_target, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
							from {$g5['g5_shop_coupon_table']}
							where cp_id = '$cid'
							  and mb_id IN ( '{$od['mb_id']}', '전체회원' )
							  and cp_method IN ( 0, 1 ) ";
				$cp = sql_fetch($sql);
				if(!$cp['cp_id'])
					continue;

				// 사용한 쿠폰인지
				if(is_used_coupon($od['mb_id'], $cp['cp_id']))
					continue;

				// 분류할인인지
				if($cp['cp_method']) {
					$sql2 = " select it_id, ca_id, ca_id2, ca_id3
								from {$g5['g5_shop_item_table']}
								where it_id = '$it_id' ";
					$row2 = sql_fetch($sql2);

					if(!$row2['it_id'])
						continue;

					if($row2['ca_id'] != $cp['cp_target'] && $row2['ca_id2'] != $cp['cp_target'] && $row2['ca_id3'] != $cp['cp_target'])
						continue;
				} else {
					if($cp['cp_target'] != $it_id)
						continue;
				}

				// 상품금액
				$sql = " select SUM( IF(io_type = '1', io_price * ct_qty, (ct_price + io_price) * ct_qty)) as sum_price $sql_common and it_id = '$it_id' ";
				$ct = sql_fetch($sql);
				$item_price = $ct['sum_price'];

				if($cp['cp_minimum'] > $item_price)
					continue;

				$dc = 0;
				if($cp['cp_type']) {
					$dc = floor(($item_price * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
				} else {
					$dc = $cp['cp_price'];
				}

				if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
					$dc = $cp['cp_maximum'];

				if($item_price < $dc)
					continue;

				$tot_it_cp_price += $dc;
				$arr_it_cp_prc[$it_id] = $dc;
			}

			$tot_od_price -= $tot_it_cp_price;

			// 주문쿠폰
			if($data['od_cp_id']) {
				$sql = " select cp_id, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
							from {$g5['g5_shop_coupon_table']}
							where cp_id = '{$data['od_cp_id']}'
							  and mb_id IN ( '{$od['mb_id']}', '전체회원' )
							  and cp_method = '2' ";
				$cp = sql_fetch($sql);

				// 사용한 쿠폰인지
				$cp_used = is_used_coupon($od['mb_id'], $cp['cp_id']);

				$dc = 0;
				if(!$cp_used && $cp['cp_id'] && ($cp['cp_minimum'] <= $tot_od_price)) {
					if($cp['cp_type']) {
						$dc = floor(($tot_od_price * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
					} else {
						$dc = $cp['cp_price'];
					}

					if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
						$dc = $cp['cp_maximum'];

					$tot_od_cp_price = $dc;
					$tot_od_price -= $tot_od_cp_price;
				}
			}

			$tot_cp_price = $tot_it_cp_price + $tot_od_cp_price;
		}

		// 배송비
		$od_send_cost = get_sendcost($od['cart_id']);

		$tot_sc_cp_price = 0;
		if($od['mb_id'] && $od_send_cost > 0) {
			// 배송쿠폰
			if($data['sc_cp_id']) {
				$sql = " select cp_id, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
							from {$g5['g5_shop_coupon_table']}
							where cp_id = '{$data['sc_cp_id']}'
							  and mb_id IN ( '{$od['mb_id']}', '전체회원' )
							  and cp_method = '3' ";
				$cp = sql_fetch($sql);

				// 사용한 쿠폰인지
				$cp_used = is_used_coupon($od['mb_id'], $cp['cp_id']);

				$dc = 0;
				if(!$cp_used && $cp['cp_id'] && ($cp['cp_minimum'] <= $tot_od_price)) {
					if($cp['cp_type']) {
						$dc = floor(($send_cost * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
					} else {
						$dc = $cp['cp_price'];
					}

					if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
						$dc = $cp['cp_maximum'];

					if($dc > $send_cost)
						$dc = $send_cost;

					$tot_sc_cp_price = $dc;
				}
			}
		}

		// 추가배송비
		$od_send_cost2 = (int)$data['od_send_cost2'];

		// 포인트
		$od_temp_point = (int)$data['od_temp_point'];

		$i_price     = $i_price + $i_send_cost + $i_send_cost2 - $i_temp_point - $i_send_coupon;
		$order_price = $tot_od_price + $od_send_cost + $od_send_cost2 - $tot_sc_cp_price - $od_temp_point;

		if ($od['mb_id']) {
			$mb = get_member($od['mb_id']);
			$od_pwd = $mb['mb_password'];
		} else {
			$od_pwd = get_encrypt_string($data['od_pwd']);
		}

		$od_escrow = 0;

		// 복합과세 금액
		$od_tax_mny = round($i_price / 1.1);
		$od_vat_mny = $i_price - $od_tax_mny;
		$od_free_mny = 0;
		if($default['de_tax_flag_use']) {
			$od_tax_mny  = (int)$data['comm_tax_mny'];
			$od_vat_mny  = (int)$data['comm_vat_mny'];
			$od_free_mny = (int)$data['comm_free_mny'];
		}

		$od_pg = $default['de_pg_service'];
		if($data['od_settle_case'] == 'KAKAOPAY')
			$od_pg = 'KAKAOPAY';

		$od_email         = get_email_address($data['od_email']);
		$od_name          = clean_xss_tags($data['od_name']);
		$od_tel           = clean_xss_tags($data['od_tel']);
		$od_hp            = clean_xss_tags($data['od_hp']);
		$od_zip           = preg_replace('/[^0-9]/', '', $data['od_zip']);
		$od_zip1          = substr($od_zip, 0, 3);
		$od_zip2          = substr($od_zip, 3);
		$od_addr1         = clean_xss_tags($data['od_addr1']);
		$od_addr2         = clean_xss_tags($data['od_addr2']);
		$od_addr3         = clean_xss_tags($data['od_addr3']);
		$od_addr_jibeon   = preg_match("/^(N|R)$/", $data['od_addr_jibeon']) ? $data['od_addr_jibeon'] : '';
		$od_b_name        = clean_xss_tags($data['od_b_name']);
		$od_b_tel         = clean_xss_tags($data['od_b_tel']);
		$od_b_hp          = clean_xss_tags($data['od_b_hp']);
		$od_b_zip		  = preg_replace('/[^0-9]/', '', $data['od_b_zip']);
		$od_b_zip1        = substr($od_b_zip, 0, 3);
		$od_b_zip2        = substr($od_b_zip, 3);
		$od_b_addr1       = clean_xss_tags($data['od_b_addr1']);
		$od_b_addr2       = clean_xss_tags($data['od_b_addr2']);
		$od_b_addr3       = clean_xss_tags($data['od_b_addr3']);
		$od_b_addr_jibeon = preg_match("/^(N|R)$/", $data['od_b_addr_jibeon']) ? $data['od_b_addr_jibeon'] : '';
		$od_memo          = clean_xss_tags($data['od_memo']);
		$od_deposit_name  = clean_xss_tags($data['od_deposit_name']);
		$od_tax_flag      = $default['de_tax_flag_use'];
		$tot_ct_price  = $_REQUEST[goodsAmt]-($od_send_cost + $od_send_cost2);
		$od_receipt_price = $tot_ct_price + $od_send_cost + $od_send_cost2 - ($od_temp_point + $tot_cp_price + $tot_sc_cp_price);
		$od_receipt_point = $od_temp_point;
		$od_misu          = 0;
		$od_status        = '입금';
		//이노페이에서 받은 데이터
		$od_tno             = $tno;
		$od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $AuthDate);
		$od_bank_account=$PayMethod=="CARD"?$fn_name:$BankName;
		$od_app_no          = $AuthCode;
		// 주문서에 입력
		$sql = " insert {$g5['g5_shop_order_table']}
					set od_id             = '$od_id',
						mb_id             = '{$od['mb_id']}',
						od_pwd            = '$od_pwd',
						od_name           = '$od_name',
						od_email          = '$od_email',
						od_tel            = '$od_tel',
						od_hp             = '$od_hp',
						od_zip1           = '$od_zip1',
						od_zip2           = '$od_zip2',
						od_addr1          = '$od_addr1',
						od_addr2          = '$od_addr2',
						od_addr3          = '$od_addr3',
						od_addr_jibeon    = '$od_addr_jibeon',
						od_b_name         = '$od_b_name',
						od_b_tel          = '$od_b_tel',
						od_b_hp           = '$od_b_hp',
						od_b_zip1         = '$od_b_zip1',
						od_b_zip2         = '$od_b_zip2',
						od_b_addr1        = '$od_b_addr1',
						od_b_addr2        = '$od_b_addr2',
						od_b_addr3        = '$od_b_addr3',
						od_b_addr_jibeon  = '$od_b_addr_jibeon',
						od_deposit_name   = '$od_deposit_name',
						od_memo           = '$od_memo',
						od_cart_count     = '$cart_count',
						od_cart_price     = '$tot_ct_price',
						od_cart_coupon    = '$tot_it_cp_price',
						od_send_cost      = '$od_send_cost',
						od_send_coupon    = '$tot_sc_cp_price',
						od_send_cost2     = '$od_send_cost2',
						od_coupon         = '$tot_od_cp_price',
						od_receipt_price  = '$od_receipt_price',
						od_receipt_point  = '$od_receipt_point',
						od_bank_account   = '$od_bank_account',
						od_receipt_time   = '$od_receipt_time',
						od_misu           = '$od_misu',
						od_pg             = '$od_pg',
						od_tno            = '$od_tno',
						od_app_no         = '$od_app_no',
						od_escrow         = '$od_escrow',
						od_tax_flag       = '$od_tax_flag',
						od_tax_mny        = '$od_tax_mny',
						od_vat_mny        = '$od_vat_mny',
						od_free_mny       = '$od_free_mny',
						od_status         = '$od_status',
						od_shop_memo      = '',
						od_hope_date      = '{$data['od_hope_date']}',
						od_time           = '{$od['dt_time']}',
						od_ip             = '{$data['od_ip']}',
						od_settle_case    = '{$data['od_settle_case']}',
						od_test           = '{$data['od_test']}'
						";
		$result = sql_query($sql, true);

		$sql_card_point = "";
		if ($od_receipt_price > 0 && !$default['de_card_point']) {
			$sql_card_point = " , ct_point = '0' ";
		}
		$sql = "update {$g5['g5_shop_cart_table']}
				   set od_id = '$od_id',
					   ct_status = '입금'
					   $sql_card_point
				 where od_id = '{$od['cart_id']}'
				   and ct_select = '1' ";
		$result = sql_query($sql, true);

		// 회원이면서 포인트를 사용했다면 테이블에 사용을 추가
		if ($od['mb_id'] && $od_receipt_point)
			insert_point($od['mb_id'], (-1) * $od_receipt_point, "주문번호 $od_id 결제");

		// 쿠폰사용내역기록
		if($od['mb_id']) {
			$it_cp_cnt = count($data['cp_id']);
			for($i=0; $i<$it_cp_cnt; $i++) {
				$cid = $data['cp_id'][$i];
				$cp_it_id = $data['it_id'][$i];
				$cp_prc = (int)$arr_it_cp_prc[$cp_it_id];

				if(trim($cid)) {
					$sql = " insert into {$g5['g5_shop_coupon_log_table']}
								set cp_id       = '$cid',
									mb_id       = '{$od['mb_id']}',
									od_id       = '$od_id',
									cp_price    = '$cp_prc',
									cl_datetime = '{$od['dt_time']}' ";
					sql_query($sql);
				}

				// 쿠폰사용금액 cart에 기록
				$cp_prc = (int)$arr_it_cp_prc[$cp_it_id];
				$sql = " update {$g5['g5_shop_cart_table']}
							set cp_price = '$cp_prc'
							where od_id = '$od_id'
							  and it_id = '$cp_it_id'
							  and ct_select = '1'
							order by ct_id asc
							limit 1 ";
				sql_query($sql);
			}

			if($data['od_cp_id']) {
				$sql = " insert into {$g5['g5_shop_coupon_log_table']}
							set cp_id       = '{$data['od_cp_id']}',
								mb_id       = '{$od['mb_id']}',
								od_id       = '$od_id',
								cp_price    = '$tot_od_cp_price',
								cl_datetime = '{$od['dt_time']}' ";
				sql_query($sql);
			}

			if($data['sc_cp_id']) {
				$sql = " insert into {$g5['g5_shop_coupon_log_table']}
							set cp_id       = '{$data['sc_cp_id']}',
								mb_id       = '{$od['mb_id']}',
								od_id       = '$od_id',
								cp_price    = '$tot_sc_cp_price',
								cl_datetime = '{$od['dt_time']}' ";
				sql_query($sql);
			}
		}

		// 주문정보
		$info = get_order_info($od_id);

		// 미수금 정보 등 반영
		$sql = " update {$g5['g5_shop_order_table']}
					set od_misu         = '{$info['od_misu']}',
						od_tax_mny      = '{$info['od_tax_mny']}',
						od_vat_mny      = '{$info['od_vat_mny']}',
						od_free_mny     = '{$info['od_free_mny']}',
						od_status       = '$od_status'
					where od_id = '$od_id' ";
		sql_query($sql);
		$sql = " delete from {$g5['g5_shop_order_data_table']} where od_id = '$od_id'";
		sql_query($sql);
?>
	
<?php
	
	
}
?>