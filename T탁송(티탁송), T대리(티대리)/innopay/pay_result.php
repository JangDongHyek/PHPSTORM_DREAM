<?php
/*******************************************************************************
 * FILE NAME : InnopayPgNoti_PHP.php
 * DATE : 2015.03.18
*******************************************************************************/
include_once('../common.php');

@extract($_GET);
@extract($_POST);
@extract($_SERVER);

/**********************************************************************************/
//이부분에 로그파일 경로를 수정해주세요.	
$LogPath = G5_DATA_PATH."/log_innopay";
/**********************************************************************************/


$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP,0, 13);


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
	$moid          	= $moid;
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

	}else if($payMethod == '02' || $payMethod == '03' || $PayMethod == "CARD"){
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
    $logfile = fopen( $LogPath . "/innopay_card.log", "a+" );
    
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

	} else if($payMethod == '02' || $payMethod == '03' || $PayMethod == "CARD"){
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

/*
// print_r($_GET);
// 완료 GET파일 (TEST모듈사용시 POST값 없음)
// 카드결제
Array
(
    [PayMethod] => CARD
    [MID] => testpay01m
    [TID] => testpay01m01082007171315420519
    [mallUserID] => test01
    [Amt] => 100
    [name] => 테스트기관(자격번호)
    [GoodsName] => 사용코드구매
    [OID] => 20200717131541761020
    [MOID] => 20200717131541761020
    [AuthDate] => 200717131604
    [AuthCode] => 14280077
    [ResultCode] => 3001
    [ResultMsg] => 카드 결제 성공
    [VbankNum] => 
    [MerchantReserved] => regType=1
    [MallReserved] => regType=1
    [SUB_ID] => 
    [fn_cd] => 16
    [fn_name] => 하나
    [CardQuota] => 00
    [BuyerEmail] => 
    [BuyerAuthNum] => 
    [ErrorCode] => O
    [ErrorMsg] => 하나카드OK: 14280077
    [AcquCardCode] => 03
    [AcquCardName] => 외환
    [FORWARD] => Y
)
*/

/*
$mb_id = $mallUserID;
$regType = "";

if ($MallReserved != "") {
	$_arr1 = explode("&", $MallReserved);
	for ($i = 0; $i < count($_arr1); $i++) {
		$_arr2 = explode("=", $_arr1[$i]);
		if ($_arr2[0] == "regType" && ($_arr2[1] == "1" || $_arr2[1] == "2")) {
			$regType = (int)$_arr2[1];
		}
	}
}
if ($regType == "") {
	// 혹시 regType값 못받으면 DB에서 체크
	$row = sql_fetch("SELECT COUNT(*) AS cnt FROM g5_member WHERE mb_id = '{$mb_id}'");
	$regType = ((int)$row['cnt'] > 0)? 2 : 1;
}
*/

ob_start();
print_r($_REQUEST);
$queryString = ob_get_clean();
$sql="INSERT INTO g5_paylog SET data = '{$queryString}'";
sql_query($sql);

//=======================================================================================
// 200820 카드심사용
//---------------------------------------------------------------------------------------
echo "0000"; 

$result_msg = "테스트결제가 완료되었으며, 카드결제 완료건은 23시경 자동으로 취소됩니다. (현재 카드결제로는 탁송/대리 요청불가)";

echo "<script>
		alert('{$result_msg}');
		location.href = '".G5_URL."/index.php';
	  </script>";

/*
if ($FORWARD == "Y") {		// PC : 팝업오픈닫긔
	echo "<script>
		alert('{$result_msg}');
		opener.location.reload();
		window.close();
	</script>";

} else {					// 모바일 : 페이지이동
	//goto_url(G5_BBS_URL.'/enter.php');
	echo "<script>
		alert('{$result_msg}');
		location.href = '".G5_BBS_URL."/enter.php';
	</script>";
}
*/

exit;

?>