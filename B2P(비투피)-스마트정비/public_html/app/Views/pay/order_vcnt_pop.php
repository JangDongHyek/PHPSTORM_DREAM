<?
/* ============================================================================== */
/* =   PAGE : 지불 요청 PAGE                                                    = */
/* = -------------------------------------------------------------------------- = */
/* =   Copyright (c)  2024 NHN KCP Inc.   All Rights Reserverd.                   = */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* = 라이브러리 및 사이트 정보 include                                          = */
/* = -------------------------------------------------------------------------- = */
/*
require "./pp_cli_hub_lib.php";
include "./../../cfg/site_conf_inc.php";
*/
require APPPATH . 'ThirdParty/KCP_vcnt/sample/FixedVirtualAccountIssuance/pp_cli_hub_lib.php'; // library [수정불가]
require APPPATH . 'ThirdParty/KCP_vcnt/cfg/site_conf_inc.php'; // 환경설정 파일 include

/* ============================================================================== */

/* ============================================================================== */
/* =   01. 지불 요청 정보 설정                                                  = */
/* = -------------------------------------------------------------------------- = */
$ordr_idxx  = $_POST[ "ordr_idxx"   ] ; // 주문 번호
$good_name  = $_POST[ "good_name"   ] ; // 상품명
$good_mny   = $_POST[ "good_mny"    ] ; // 입금 금액
$buyr_name  = $_POST[ "buyr_name"   ] ; // 주문자 이름
$buyr_mail  = $_POST[ "buyr_mail"   ] ; // 주문자 E-Mail
$buyr_tel1  = $_POST[ "buyr_tel1"   ] ; // 주문자 전화번호
$buyr_tel2  = $_POST[ "buyr_tel2"   ] ; // 주문자 휴대폰번호
$currency   = $_POST[ "currency"    ] ; // 화폐단위 (WON/USD)
$va_uniq_key= $_POST[ "va_uniq_key" ] ; // 유니크 키값

$good_name = iconv("euc-kr","utf-8",$good_name);
$buyr_name = iconv("euc-kr","utf-8",$buyr_name);

/* = -------------------------------------------------------------------------- = */
$tx_cd      = "";                                                    // 트랜잭션 코드
$bSucc      = "";                                                    // DB 작업 성공 여부
/* = -------------------------------------------------------------------------- = */
$res_cd     = "";                                                    // 결과코드
$res_msg    = "";                                                    // 결과메시지
$tno        = "";                                                    // 거래번호
/* = -------------------------------------------------------------------------- = */
$bankname   = "";                                                    // 입금은행
$bankcode   = "";                                                    // 은행코드
$depositor  = "";                                                    // 가상계좌주명
$account    = "";                                                    // 가상계좌번호
$app_time   = "";                                                    // 발급시간
/* ============================================================================== */


/* ============================================================================== */
/* =   02. 인스턴스 생성 및 초기화                                              = */
/* = -------------------------------------------------------------------------- = */
$c_PayPlus  = new C_PAYPLUS_CLI;
$c_PayPlus->mf_clear();
/* ============================================================================== */


/* ============================================================================== */
/* =   03. 처리 요청 정보 설정, 실행                                             = */
/* = -------------------------------------------------------------------------- = */

/* = -------------------------------------------------------------------------- = */
/* =   03-1. 승인 요청                                                          = */
/* = -------------------------------------------------------------------------- = */
// 업체 환경 정보
$cust_ip = getenv( "REMOTE_ADDR" );

$tx_cd = "00100000";

$common_data_set = "";

$common_data_set .= $c_PayPlus->mf_set_data_us( "amount"  , $good_mny  );
$common_data_set .= $c_PayPlus->mf_set_data_us( "currency", $currency  );
$common_data_set .= $c_PayPlus->mf_set_data_us( "cust_ip" , $cust_ip   );
$common_data_set .= $c_PayPlus->mf_set_data_us( "escw_mod", "N"        );

$c_PayPlus->mf_add_payx_data( "common", $common_data_set );

// 주문 정보

$c_PayPlus->mf_set_ordr_data( "ordr_idxx",  $ordr_idxx );
$c_PayPlus->mf_set_ordr_data( "good_name",  $good_name );
$c_PayPlus->mf_set_ordr_data( "good_mny" ,  $good_mny  );
$c_PayPlus->mf_set_ordr_data( "buyr_name",  $buyr_name );
$c_PayPlus->mf_set_ordr_data( "buyr_tel1",  $buyr_tel1 );
$c_PayPlus->mf_set_ordr_data( "buyr_tel2",  $buyr_tel2 );
$c_PayPlus->mf_set_ordr_data( "buyr_mail",  $buyr_mail );

// 가상계좌 설정

$vcnt_data_set ="";

$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_txtype"  , "41210000"             ); // 절대 값 , 수정불가
$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_mny"     , $good_mny              ); // 결제 금액
$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_bankcode", $_POST[ "ipgm_bank"  ] ); // 입금은행
$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_name"    , $_POST[ "ipgm_name"  ] ); // 입금자명
$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_date"    , $_POST[ "ipgm_date"  ] ); // 입금 예정일
$vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_uniq_key", $_POST[ "va_uniq_key"] ); // 유니크 키 값

$c_PayPlus->mf_add_payx_data( "va", $vcnt_data_set );


/* ============================================================================== */
/* =   03-2. 실행                                                               = */
/* ------------------------------------------------------------------------------ */

$c_PayPlus->mf_do_tx( "", $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tx_cd, "",
    $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
    $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path );

$res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
$res_msg = $c_PayPlus->m_res_msg; // 결과 메시지

$res_msg = iconv("euc-kr","utf-8",$res_msg);
/* ============================================================================== */


/* ============================================================================== */
/* =   04. 승인 결과 처리                                                       = */
/* = -------------------------------------------------------------------------- = */
if ( $res_cd == "0000" )
{
    $tno = $c_PayPlus->mf_get_res_data( "tno" );       // NHNKCP 거래 고유 번호

    /* = -------------------------------------------------------------------------- = */
    /* =   04-1. 가상계좌 발급 결과 처리                                            = */
    /* = -------------------------------------------------------------------------- = */

    $bankname  = $c_PayPlus->mf_get_res_data( "bankname"  ) ; // 입금은행
    $bankcode  = $c_PayPlus->mf_get_res_data( "bankcode"  ) ; // 은행코드
    $depositor = $c_PayPlus->mf_get_res_data( "depositor" ) ; // 가상계좌주명
    $account   = $c_PayPlus->mf_get_res_data( "account"   ) ; // 가상계좌번호
    $app_time  = $c_PayPlus->mf_get_res_data( "app_time"  ) ; // 발급시간

    $bankname = iconv("euc-kr","utf-8",$bankname);
    $depositor = iconv("euc-kr","utf-8",$depositor);

    /* = -------------------------------------------------------------------------- = */
    /* =   04-2. 승인 결과를 업체 자체적으로 DB 처리 작업하시는 부분입니다.         = */
    /* = -------------------------------------------------------------------------- = */
    /* =         승인 결과를 DB 작업 하는 과정에서 정상적으로 승인된 건에 대해      = */
    /* =         DB 작업을 실패하여 DB update 가 완료되지 않은 경우, 자동으로       = */
    /* =         승인 취소 요청을 하는 프로세스가 구성되어 있습니다.                = */
    /* =         DB 작업이 실패 한 경우, bSucc 라는 변수(String)의 값을 "false"     = */
    /* =         로 세팅해 주시기 바랍니다. (DB 작업 성공의 경우에는 "false" 이외의 = */
    /* =         값을 세팅하시면 됩니다.)                                           = */
    /* = -------------------------------------------------------------------------- = */
    $bSucc = "";             // DB 작업 실패일 경우 "false" 로 세팅

    /* = -------------------------------------------------------------------------- = */
    /* =   04-3. DB 작업 실패일 경우 자동 승인 취소                                 = */
    /* = -------------------------------------------------------------------------- = */
    if ( $bSucc == "false" )
    {
        $c_PayPlus->mf_clear();

        $tx_cd = "00200000";

        $c_PayPlus->mf_set_modx_data( "tno",      $tno     );                       // NHNKCP 원거래 거래번호
        $c_PayPlus->mf_set_modx_data( "mod_type", "STSC"   );                       // 원거래 변경 요청 종류
        $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip );                       // 변경 요청자 IP
        $c_PayPlus->mf_set_modx_data( "mod_desc", "결과 처리 오류 - 자동 취소" );   // 변경 사유
        $c_PayPlus->mf_do_tx( "",                $g_conf_home_dir, $g_conf_site_cd,
            $g_conf_site_key,  $tx_cd,           "",
            $g_conf_pa_url,    $g_conf_pa_port,  "payplus_cli_slib",
            $ordr_idxx,        $cust_ip,         $g_conf_log_level,
            "",                $g_conf_tx_mode );

        $res_cd  = $c_PayPlus->m_res_cd;
        $res_msg = $c_PayPlus->m_res_msg;
    }

}    // End of [res_cd = "0000"]

/* = -------------------------------------------------------------------------- = */
/* =   04-4. 승인 실패를 업체 자체적으로 DB 처리 작업하시는 부분입니다.         = */
/* = -------------------------------------------------------------------------- = */
else
{
}
/* ============================================================================== */


/* ============================================================================== */
/* =   05. 폼 구성 및 결과페이지 호출                                           = */
/* ============================================================================== */
?>

<html>
<head>
    <script>
        function goResult()
        {
            document.pay_info.submit();
        }
    </script>
</head>

<body onload="goResult()">
<form name="pay_info" method="post" action="<?=base_url()?>pay/OrderVcntResult" accept-charset="euc-kr" onsubmit="document.charset='euc-kr';">
    <input type="hidden" name="bSucc"       value="<?=$bSucc       ?>">  <!-- 쇼핑몰 DB 처리 성공 여부 -->

    <input type="hidden" name="res_cd"      value="<?=$res_cd      ?>">  <!-- 결과 코드 -->
    <input type="hidden" name="res_msg"     value="<?=$res_msg     ?>">  <!-- 결과 메세지 -->
    <input type="hidden" name="ordr_idxx"   value="<?=$ordr_idxx   ?>">  <!-- 주문번호 -->
    <input type="hidden" name="va_uniq_key" value="<?=$va_uniq_key ?>">  <!-- 주문번호 -->
    <input type="hidden" name="tno"         value="<?=$tno         ?>">  <!-- NHNKCP 거래번호 -->
    <input type="hidden" name="good_mny"    value="<?=$good_mny    ?>">  <!-- 결제금액 -->
    <input type="hidden" name="good_name"   value="<?=$good_name   ?>">  <!-- 상품명 -->
    <input type="hidden" name="buyr_name"   value="<?=$buyr_name   ?>">  <!-- 주문자명 -->
    <input type="hidden" name="buyr_tel1"   value="<?=$buyr_tel1   ?>">  <!-- 주문자 전화번호 -->
    <input type="hidden" name="buyr_tel2"   value="<?=$buyr_tel2   ?>">  <!-- 주문자 휴대폰번호 -->
    <input type="hidden" name="buyr_mail"   value="<?=$buyr_mail   ?>">  <!-- 주문자 E-mail -->

    <input type="hidden" name="bankname"    value="<?=$bankname    ?>">  <!-- 가상계좌은행 -->
    <input type="hidden" name="bankcode"    value="<?=$bankcode    ?>">  <!-- 가상계좌은행코드 -->
    <input type="hidden" name="depositor"   value="<?=$depositor   ?>">  <!-- 가상계좌주명 -->
    <input type="hidden" name="account"     value="<?=$account     ?>">  <!-- 가상계좌번호 -->
    <input type="hidden" name="app_time"    value="<?=$app_time    ?>">  <!-- 발급시간 -->
</form>
</body>
</html>