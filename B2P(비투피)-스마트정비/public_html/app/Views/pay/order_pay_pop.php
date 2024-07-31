<?
/* ============================================================================== */
/* =   PAGE : 지불 요청 PAGE                                                    = */
/* ============================================================================== */
?>
<?
/* ============================================================================== */
/* = 라이브러리 및 사이트 정보 include                                          = */
/* = -------------------------------------------------------------------------- = */
require APPPATH . 'ThirdParty/KCP_autoPay/cfg/site_conf_inc.php'; // 환경설정 파일 include
require APPPATH . 'ThirdParty/KCP_autoPay/payx/pp_cli_hub_lib.php'; // library [수정불가]
/* ============================================================================== */

/* ============================================================================== */
/* =   01. 지불 요청 정보 설정                                                  = */
/* = -------------------------------------------------------------------------- = */
$ordr_idxx  = $_POST[ "ordr_idxx"  ];  // 주문 번호
$good_name  = $_POST[ "good_name"  ];  // 상품 정보
$good_mny   = $_POST[ "good_mny"   ];  // 결제 금액
$buyr_name  = $_POST[ "buyr_name"  ];  // 주문자 이름
$buyr_mail  = $_POST[ "buyr_mail"  ];  // 주문자 E-Mail
$buyr_tel2  = $_POST[ "buyr_tel2"  ];  // 주문자 휴대폰번호
$currency   = $_POST[ "currency"   ];  // 화폐단위 (WON)


$good_name = iconv("euc-kr","utf-8",$good_name);
$buyr_name = iconv("euc-kr","utf-8",$buyr_name);


/* = -------------------------------------------------------------------------- = */
$tran_cd       = "";                                               // 트랜잭션 코드
/* = -------------------------------------------------------------------------- = */
$res_cd        = "";                                               // 결과코드
$res_msg       = "";                                               // 결과메시지
$tno           = "";                                               // NHN KCP 거래번호
/* = -------------------------------------------------------------------------- = */
$card_cd         = "";                                             // 카드 코드
$card_no         = "";                                             // 카드 번호
$card_name       = "";                                             // 카드명
$app_time        = "";                                             // 승인시간
$app_no          = "";                                             // 승인번호
$quota           = "";                                             // 할부개월
/* ============================================================================== */

/* ============================================================================== */
/* =   02. 인스턴스 생성 및 초기화                                              = */
/* = -------------------------------------------------------------------------- = */

$c_PayPlus  = new C_PAYPLUS_CLI;
$c_PayPlus->mf_clear();

/* ============================================================================== */

/* = -------------------------------------------------------------------------- = */
/* =   03. 승인 요청                                                          = */
/* = -------------------------------------------------------------------------- = */
// 업체 환경 정보
$cust_ip = getenv( "REMOTE_ADDR" ); // 요청 IP (옵션값)

$cust_ip = getenv( "REMOTE_ADDR" ); // 요청 IP (옵션값)

$tran_cd = "00100000";

$common_data_set = "";

$common_data_set .= $c_PayPlus->mf_set_data_us( "amount",   $good_mny    );
$common_data_set .= $c_PayPlus->mf_set_data_us( "currency", $currency    );
$common_data_set .= $c_PayPlus->mf_set_data_us( "cust_ip",  $cust_ip );

$c_PayPlus->mf_add_payx_data( "common", $common_data_set );

$c_PayPlus->mf_set_ordr_data( "ordr_idxx", $ordr_idxx );
$c_PayPlus->mf_set_ordr_data( "good_name", $good_name );
$c_PayPlus->mf_set_ordr_data( "good_mny",  $good_mny  );
$c_PayPlus->mf_set_ordr_data( "buyr_name", $buyr_name );
$c_PayPlus->mf_set_ordr_data( "buyr_tel2", $buyr_tel2 );
$c_PayPlus->mf_set_ordr_data( "buyr_mail", $buyr_mail );

$card_data_set;

$card_data_set .= $c_PayPlus->mf_set_data_us( "card_mny", $good_mny );

$card_data_set .= $c_PayPlus->mf_set_data_us( "card_tx_type",   "11511000" );
$card_data_set .= $c_PayPlus->mf_set_data_us( "quota",          "00" );
$card_data_set .= $c_PayPlus->mf_set_data_us( "bt_group_id",    $_POST[ "bt_group_id"  ] );
$card_data_set .= $c_PayPlus->mf_set_data_us( "bt_batch_key",   $_POST[ "bt_batch_key" ] );

$c_PayPlus->mf_add_payx_data( "card", $card_data_set );


/* ============================================================================== */
/* =   04. 실행 및 결과처리                                                        = */
/* ------------------------------------------------------------------------------ */

$c_PayPlus->mf_do_tx( $trace_no, $g_conf_home_dir, $g_conf_site_cd, "", $tran_cd, "",
    $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
    $cust_ip, $g_conf_log_level, 0, 0);

$res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
$res_msg = $c_PayPlus->m_res_msg; // 결과 메시지

$tno   = $c_PayPlus->mf_get_res_data( "tno"       ); // NHN KCP 거래번호
$amount   = $c_PayPlus->mf_get_res_data( "amount"       ); // 총 금액
$card_cd   = $c_PayPlus->mf_get_res_data( "card_cd"   ); // 카드사 코드
$card_no   = $c_PayPlus->mf_get_res_data( "card_no"   ); // 카드 번호
$card_name = $c_PayPlus->mf_get_res_data( "card_name" ); // 카드 종류
$app_time  = $c_PayPlus->mf_get_res_data( "app_time"  ); // 승인 시간
$app_no    = $c_PayPlus->mf_get_res_data( "app_no"    ); // 승인 번호
$quota     = $c_PayPlus->mf_get_res_data( "quota"     ); // 할부 개월 수

$res_msg = iconv("euc-kr","utf-8",$res_msg);
$card_name = iconv("euc-kr","utf-8",$card_name);

?>

<html>
<head>
    <script type="text/javascript">
        function goResult()
        {
            document.pay_info.submit();
        }
    </script>
</head>

<body onload="goResult();">
<form name="pay_info" method="post" action="<?=base_url()?>pay/OrderPayResult" accept-charset="euc-kr" onsubmit="document.charset='euc-kr';">
    <input type="hidden" name="bt_batch_key"     value="<?=$_POST[ "bt_batch_key" ]     ?>">  <!-- 배치키wc -->

    <input type="hidden" name="amount"     value="<?=$amount     ?>">  <!-- 총 금액 -->

    <input type="hidden" name="res_cd"     value="<?=$res_cd     ?>">  <!-- 결과 코드 -->
    <input type="hidden" name="res_msg"    value="<?=$res_msg    ?>">  <!-- 결과 메세지 -->
    <input type="hidden" name="ordr_idxx"  value="<?=$ordr_idxx  ?>">  <!-- 주문번호 -->
    <input type="hidden" name="tno"        value="<?=$tno        ?>">  <!-- NHN KCP 거래번호 -->
    <input type="hidden" name="good_mny"   value="<?=$good_mny   ?>">  <!-- 결제금액 -->
    <input type="hidden" name="good_name"  value="<?=$good_name  ?>">  <!-- 상품명 -->
    <input type="hidden" name="buyr_name"  value="<?=$buyr_name  ?>">  <!-- 주문자명 -->
    <input type="hidden" name="buyr_tel2"  value="<?=$buyr_tel2  ?>">  <!-- 주문자 휴대폰번호 -->
    <input type="hidden" name="buyr_mail"  value="<?=$buyr_mail  ?>">  <!-- 주문자 E-mail -->

    <input type="hidden" name="card_cd"    value="<?=$card_cd    ?>">  <!-- 카드코드 -->
    <input type="hidden" name="card_no"    value="<?=$card_no    ?>">  <!-- 카드번호 -->
    <input type="hidden" name="card_name"  value="<?=$card_name  ?>">  <!-- 카드명 -->
    <input type="hidden" name="app_time"   value="<?=$app_time   ?>">  <!-- 승인시간 -->
    <input type="hidden" name="app_no"     value="<?=$app_no     ?>">  <!-- 승인번호 -->
    <input type="hidden" name="quota"      value="<?=$quota      ?>">  <!-- 할부개월 -->

</form>
</body>
</html>
