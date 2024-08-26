<?php
include_once('./_common.php');

/*******************************************************************************
 * FILE NAME : InnopayPgNoti_PHP.php
 * DATE : 2015.03.18
 *******************************************************************************/


@extract($_GET);
@extract($_POST);
@extract($_SERVER);
/**********************************************************************************/
//이부분에 로그파일 경로를 수정해주세요.
$LogPath = G5_PATH."/log";
/**********************************************************************************/

//print_r($_REQUEST);exit;

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

$PayMethod = $_REQUEST["PayMethod"]; // 지불수단 (CARD : 신용카드, BNAK : 계좌이체, EPAY : 간편결제)
$ResultCode = $_REQUEST["ResultCode"]; // 결과코드
$ResultMsg = $_REQUEST["ResultMsg"]; // 결과메시지

$pg_status = 2; // 결제상태 (0:대기, 1:성공, 2:실패)
if ($ResultCode == "3001") { // 카드결제 성공
    $pg_status = 1;
}
if($ResultCode == "4000") { // 계좌이체 성공
    $pg_status = 1;
}

$forward = $_REQUEST['FORWARD'];
// moid(moid) '=' goodsCnt(수량)
$moid_arr_charge =explode('=',$_REQUEST["MOID"]);
$charge =  $moid_arr_charge[1];

//캐쉬충전에서 안넘어오고 재능 구매시 cnt넘어와서 빈값처리 해줌.
if ($charge != "Y"){
    $charge = "";
}

/**********DB 컬럼 추가**********
 * 계좌이체
    BankCd          은행코드
    BankName        은행명
    ReceiptType     현금영수증(0:미발행/1:발행(개인소득공제)/2:발행(사업자지출증빙)
    BuyerAuthNum    현금영수증구매자인증번호(휴대폰번호 등) -- ※ 값 받아오지 않음

 * 간편결제
    EPayCl          간편결제코드(01:카카오/02:LPay/03:PAYCO/04:SSG/06:네이버
    AcquCardName    매입사카드명
    AcquCardCode    매입사코드
 **********DB 컬럼 추가**********/

/**
 * 캐시 충전 시 판매자 정보 변경 필요할 경우 Buyer... 수정 할 것.
 **/
$moid_arr = explode('-',$_REQUEST["MOID"]);
$idx = $moid_arr[1]; // new_talent ta_idx

$sql = "select mb_id,ta_title from new_talent where ta_idx = '{$idx}' ";
$seller = sql_fetch($sql);


$sql = "INSERT INTO new_payment SET 
        transSeq = '{$_REQUEST["TID"]}',
        payMethod = '{$_REQUEST["PayMethod"]}',
        userId = '{$_REQUEST["mallUserID"]}',
        GoodsCnt = '{$moid_arr_charge[1]}',
        GoodsName = '{$_REQUEST["GoodsName"]}',
        Amt = '{$_REQUEST["Amt"]}',
        Moid = '{$moid_arr_charge[0]}',
        MID = '{$_REQUEST["MID"]}',
        BuyerName = '{$_REQUEST["name"]}',
        BuyerTel = '{$_REQUEST["BuyerTel"]}',
        BuyerEmail = '{$_REQUEST["BuyerEmail"]}',
        ResultMsg = '{$_REQUEST["ResultMsg"]}',
        fn_name = '{$_REQUEST["fn_name"]}',
        CardQuota = '{$_REQUEST["CardQuota"]}',
        ErrorCode = '{$_REQUEST["ErrorCode"]}',
        ErrorMsg = '{$_REQUEST["ErrorMsg"]}',
        ResultCode = '{$_REQUEST["ResultCode"]}',
        status = '진행대기',
        status_date = '".G5_TIME_YMDHIS."',
        wr_datetime = '".G5_TIME_YMDHIS."',
        BankCd = '{$_REQUEST['BankCd']}',
        BankName = '{$_REQUEST['BankName']}',
        ReceiptType = '{$_REQUEST['ReceitType']}',
        BuyerAuthNum = '{$_REQUEST['BuyerAuthNum']}',
        AuthDate = '{$_REQUEST['AuthDate']}',
        AuthCode = '{$_REQUEST['AuthCode']}',
        EPayCl = '{$_REQUEST['EPayCl']}',
        AcquCardName = '{$_REQUEST['AcquCardName']}',
        AcquCardCode = '{$_REQUEST['AcquCardCode']}',
        charge = '{$charge}',
        seller_id = '{$seller['mb_id']}'
        ";
$result = sql_query($sql);
$payment_idx = sql_insert_id();




if ($pg_status == 1 ) // 결제성공
{
    if ($result == 1)
    {
        echo "0000"; // 절대로 지우지마세요
        $msg = '결제가 완료되었습니다.';


        if($charge == 'Y') // 캐시 충전
        {


            //성공일 경우 토탈 금액 업데이트 해줌
            $sql = "update g5_member set mb_6 = mb_6 + {$_REQUEST['Amt']} where mb_id = '{$_REQUEST["mallUserID"]}' ";
            sql_query($sql);

            $mb = get_member($_REQUEST["mallUserID"]);

            //히스토리
            payment_history($mb['mb_id'], $cache_buy_content['content'],$_REQUEST['Amt'],  $mb['mb_6'],'@pay_plus','',$cache_buy_content['idx'],$payment_idx,'new_payment');

            $url =  G5_BBS_URL."/my_income.php?tab=2";
        }
        else // 재능 구매
        {
            //구매한 재능 띄우기위해 division 변경해줌
            $sql = "update g5_member set mb_division = '1' where mb_id = '{$member['mb_id']}' ";
            sql_query($sql);

            // 재능 거래 금액의 3% 마일리지 적립 (판매자에게 적립) , 캐쉬수수료율 변경 85% > 90%
            $mileage = $_REQUEST['Amt'] * 3 / 100;
            $cashe = $_REQUEST['Amt'] * 90 / 100;
            $sql = " update g5_member set mb_7 = mb_7 + {$mileage},  mb_6 = mb_6 + {$cashe} where mb_id = '{$seller['mb_id']}'; ";
            sql_query($sql);
            $mb = get_member($seller['mb_id']);

            // 마일리지 적립 DB INSERT
            $sql = " insert into new_mileage set category = '적립', ta_idx = {$idx}, mb_id = '{$seller['mb_id']}', mileage = {$mileage}, remain_mileage = {$mb['mb_7']}, wr_datetime = '" . G5_TIME_YMDHIS . "'; ";
            sql_query($sql);

            //히스토리
            payment_history($seller['mb_id'], $talent_buy_content['content'],$cashe,  $mb['mb_6'],'@pay_plus','',$talent_buy_content['idx'],$idx,'new_talent');
            payment_history($seller['mb_id'], $mileage_content['content'],$mileage,  $mb['mb_7'],'@mileage_plus','Y',$mileage_content['idx'],$payment_idx,'new_payment');
            //포인트적립 히스토리
            if ($config["cf_point_percent"] > 0){
                $sale_point = ($cashe * ($config["cf_point_percent"] * 0.01));
                $sql = " update g5_member set mb_new_point = mb_new_point + {$sale_point} where mb_id = '{$member['mb_id']}'; ";
                sql_query($sql);

                $sale_point_mb = get_member($member['mb_id']);
                point_history($member['mb_id'], 14,$sale_point_plus['content'], $sale_point, $sale_point_mb['mb_new_point'], 'plus');
            }

            //알림톡
            alimtalk($member['mb_hp'], array("talent_title" => $seller['ta_title'],"mb_nick" => $member['mb_nick']), 'talent_buy');
            alimtalk($mb['mb_hp'], array("talent_title" => $seller['ta_title'],"mb_nick" => $mb['mb_nick']), 'buy_req');


            $url =  G5_BBS_URL."/my_item.php?tab=2";

        }
    }
    else
    {
		$msg = "서버와의 연결이 끊겼습니다. 금액 출금이 되었다면 고객센터(" . $config['cf_4'] . ")로 문의하시길 바랍니다.";
        $url = G5_BBS_URL."/item_view.php?idx=".$idx;
    }
}
else{ // 결제실패
    /*$msg_text = ''; // 실패 메세지
    if($PayMethod == 'CARD') { $msg_text = '카드사 결제'; }
    else if($PayMethod == 'BANK') { $msg_text = '계좌이체 결제'; }
    else if($PayMethod == 'EPAY') { $msg_text = '간편결제'; }*/

    $msg = '결제 실패입니다.('.$ResultMsg.') 고객센터(' . $config["cf_4"] . ')로 문의하시길 바랍니다.';
    $url = G5_BBS_URL."/item_view.php?idx=".$idx;
}


//else { // 모바일 : 페이지이동
//    echo "<script>
//		alert('{$result_msg}');
//		location.href = '{$result_url}';
//	</script>";
//}

//*************************************************************************************
?>

<?php if ($forward == 'Y'){ ?>
<script>
    alert('<?= $msg ?>');
    <?php if($_REQUEST["PayMethod"] != 'EPAY') { ?>
    opener.location.href = '<?=$url?>';
    window.close();
    <?php } else { ?>
    location.href = '<?=$url?>';
    <?php } ?>
</script>
<?php }else{ ?>

<script>
alert('<?= $msg ?>');
location.href = "<?= $url ?>";
</script>
<?php } ?>
<?php exit(); ?>