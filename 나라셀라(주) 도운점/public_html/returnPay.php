<?php
/*******************************************************************************
 * FILE NAME : InnopayPgNoti_PHP.php
 * DATE : 2015.03.18
*******************************************************************************/

include_once('./_common.php');

@extract($_GET);
@extract($_POST);
@extract($_SERVER);

$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP,0, 13);

/* 가공 데이터 */

$class_idx = $class_idx;
$tmp_users_idx = $tmp_users_idx;

/* 이노페이 데이터 */

$PayMethod			= $PayMethod;
$MID				= $MID;
$TID				= $TID;
$mallUserID			= $mallUserID;
$Amt				= $Amt;
$name				= $name;
$GoodsName			= $GoodsName;
$MOID				= $MOID;
$AuthDate			= $AuthDate;
$AuthCode			= $AuthCode;
$ResultCode			= $ResultCode;
$ResultMsg			= $ResultMsg;
$fn_cd				= $fn_cd;
$fn_name			= $fn_name;
$CardQuota			= $CardQuota;
$BuyerEmail			= $BuyerEmail;
$BuyerAuthNum		= $BuyerAuthNum;
$ErrorCode			= $ErrorCode;
$ErrorMsg			= $ErrorMsg;
$AcquCardCode		= $AcquCardCode;
$AcquCardName		= $AcquCardName;
$VbankNum			= $VbankNum;
$VbankName			= $VbankName;
$VbankExpDate       = $VbankExpDate;
$VBankAccountName   = $VBankAccountName;
$ReceiptType = $ReceiptType;

$result = ($ResultCode == "3001" || $ResultCode == "4000" || $ResultCode == "4100"); /* 결제성공시 true */

if(!$result){
    alert("결제실패<br>[아래와 같은 사유로 결제 실패하였습니다.]<br>{$ResultMsg}");
    exit;
}

/* 세션 끊김 방지(mb_id) 및 추가 Users 가져오기 */

$sql = "
    SELECT
        *
    FROM
        tmp_users_data
    WHERE
        users_idx = '{$tmp_users_idx}';
";

$userData = sql_fetch($sql);
$userData['users'] = json_decode($userData['users'], true);
$personCnt = count($userData['users']);

/* 등록한 유저추가 */

$status = "";

if($PayMethod == 'VBANK'){
    $status = "DEPOSIT_WAIT";
}else{    
    /* 정원이 초과하면 대기상태로 가는 로직 */
    $sql = "
        SELECT
            COUNT(*) AS cnt
        FROM
            class_member_list
        WHERE
            class_idx = '{$class_idx}' AND
            isUse = 'Y'
    ";
    
    $nowPerson = (int)sql_fetch($sql)['cnt'];
    
    $info = getClassInfo($class_idx);
    
    /* 대기상태로 */
    if(($nowPerson + $personCnt) > $info['maxPerson']){
        $status = "WAIT";
    }else{
        $status = "CONFIRMED";
    }
}


$sql = "
    INSERT INTO
        class_app_list
    SET
        mb_id = '{$member['mb_id']}',
        class_idx = '{$class_idx}',
        person = '{$personCnt}',
        status = '{$status}',
        payType = '{$PayMethod}'
";
    
sql_query($sql);
$class_app_idx = sql_insert_id();


foreach($userData['users'] as $key => $data){
    $sql = "
        INSERT INTO
            class_member_list
        SET
            class_idx = '{$class_idx}',
            class_app_idx = '{$class_app_idx}',
            name = '{$data['name']}',
            birth = '{$data['birth']}',
            hp = '{$data['hp']}',
            email = '{$data['email']}'
    ";
    
    sql_query($sql);
}

/* 결제 로그 등록 */
$sql = "
    INSERT INTO
        pay_list
    SET
        mb_id = '{$userData['mb_id']}',
        class_app_idx = '{$class_app_idx}',
        class_idx = '{$class_idx}',
        PayMethod = '{$PayMethod}',
        MID = '{$MID}',
        TID = '{$TID}',
        mallUserID = '{$mallUserID}',
        Amt = '{$Amt}',
        name = '{$name}',
        GoodsName = '{$GoodsName}',        
        MOID = '{$MOID}',
        AuthDate = '{$AuthDate}',
        AuthCode = '{$AuthCode}',
        ResultCode = '{$ResultCode}',
        ResultMsg = '{$ResultMsg}',        
        fn_cd = '{$fn_cd}',
        fn_name = '{$fn_name}',
        CardQuota = '{$CardQuota}',
        BuyerEmail = '{$BuyerEmail}',        
        ErrorCode = '{$ErrorCode}',
        ErrorMsg = '{$ErrorMsg}',
        AcquCardCode = '{$AcquCardCode}',
        AcquCardName = '{$AcquCardName}', 
        VbankNum = '{$VbankNum}',
        VbankName = '{$VbankName}',
        ReceiptType = '{$ReceiptType}',
        VbankExpDate = '{$VbankExpDate}',
        VBankAccountName = '{$VBankAccountName}'
";

sql_query($sql);


$sucessMsg = "";

/* 가상계좌 */
if($PayMethod == 'VBANK'){
    $Amt = number_format($Amt);
    
    $sucessMsg .= "가상계좌가 발급되었습니다.<br><br>- 이메일(E-mail) 또는 Mypage 이용내역(Class)에서도 확인 하실 수 있습니다.<br>";
    $sucessMsg .= "<br>은행명 : {$VbankName}<br>";
    $sucessMsg .= "계좌번호 : {$VbankNum}<br>";
    $sucessMsg .= "입금자명 : {$VBankAccountName}<br>";
    $sucessMsg .= "입금금액 : {$Amt}원<br>";

}else{
    $sucessMsg = "정상적으로 결제처리 되었습니다.";

    //알림톡 기능추가_231023_정상 결제 처리 완료 후 알림톡 발송
    $params = array("mb_name" => $name, "tab" => "class");
    

    $sendAlimTalk = sendAlimTalk(1, $params, $member['mb_hp']);

    //FIXME 알림톡 템플릿 등록후 테스트 진행필요 : 테스트 성공시 삭제
   /* if ($_SERVER['REMOTE_ADDR'] == '121.140.204.65') {
        echo print_r($params);
        echo "<br>";
        echo $member['mb_hp'];
        // PHP 배열을 JSON 문자열로 변환
        $jsonParams = json_encode($params);
        echo "<script>console.log($jsonParams)</script>";
        echo print_r($sendAlimTalk);
        $jsonParams2 = json_encode($sendAlimTalk);
        echo "<script>console.log($jsonParams2)</script>";

        //alert($sendAlimTalk, G5_URL."/mypage.php?tab=class");
    }*/

}

if ($_SERVER['REMOTE_ADDR'] != '121.140.204.65') {
    alert($sucessMsg, G5_URL."/mypage.php?tab=class");
}else{
    alert($sucessMsg, G5_URL."/mypage.php?tab=class");
}

?>