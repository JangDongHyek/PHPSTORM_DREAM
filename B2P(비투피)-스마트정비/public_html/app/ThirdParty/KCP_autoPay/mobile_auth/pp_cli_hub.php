<?
    /* ============================================================================== */
    /* =   PAGE : 배치키 발급 요청 정보 설정													= */
    /* ============================================================================== */
    
	include "../cfg/site_conf_inc.php";       // 환경설정 파일 include
    require "pp_cli_hub_lib.php";              // library [수정불가]

?>

<?
    /* ============================================================================== */
    /* =   01. 배치키 발급 요청 정보 설정             	                                    = */
    /* = -------------------------------------------------------------------------- = */
    $cust_ip        = getenv( "REMOTE_ADDR"    ); // 요청 IP
    /* = -------------------------------------------------------------------------- = */
    $tran_cd        = $_POST[ "tran_cd"        ]; // 처리 종류
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx      = $_POST[ "ordr_idxx"      ]; // 주문번호
    $good_name      = $_POST[ "good_name"      ]; // 상품명
    $good_mny       = $_POST[ "good_mny"       ]; // 결제금액
    $buyr_name      = $_POST[ "buyr_name"      ]; // 주문자명
    /* = -------------------------------------------------------------------------- = */
    $res_cd         = "";                                                     // 응답코드
    $res_msg        = "";                                                     // 응답 메세지
    /* = -------------------------------------------------------------------------- = */
    $card_cd        = "";                                                     // 신용카드 코드
    $card_name      = "";                                                     // 신용카드 명
    $batch_key      = "";                                                     // 배치키

    /* ============================================================================== */
    /* =   02. 인스턴스 생성 및 초기화                                              = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus = new C_PP_CLI;
    $c_PayPlus->mf_clear();


    /* = -------------------------------------------------------------------------- = */
    /* =   03. 배치키 발급 요청              		                                        = */
    /* = -------------------------------------------------------------------------- = */
	
	$c_PayPlus->mf_set_encx_data( $_POST[ "enc_data" ], $_POST[ "enc_info" ] );


    /* ============================================================================== */
    /* =   04. 실행                                                                 = */
    /* = -------------------------------------------------------------------------- = */

	$c_PayPlus->mf_do_tx( $trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
						  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
						  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // 응답 전문 처리

	$res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
	$res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
	$card_cd   = $c_PayPlus->mf_get_res_data( "card_cd"   );       // 카드 코드
	$card_name = $c_PayPlus->mf_get_res_data( "card_name" );       // 카드명
	$batch_key = $c_PayPlus->mf_get_res_data( "batch_key" );       // 배치키
?>
    <html>
    <head>
        <title>스마트폰 웹 결제창</title>
        <script type="text/javascript">
            function goResult()
            {
                document.pay_info.submit()
            }

            // 결제 중 새로고침 방지 샘플 스크립트 (중복결제 방지)
            function noRefresh()
            {
                /* CTRL + N키 막음. */
                if ((event.keyCode == 78) && (event.ctrlKey == true))
                {
                    event.keyCode = 0;
                    return false;
                }
                /* F5 번키 막음. */
                if(event.keyCode == 116)
                {
                    event.keyCode = 0;
                    return false;
                }
            }
            document.onkeydown = noRefresh ;
        </script>
    </head>

    <body onload="goResult()">
    <form name="pay_info" method="post" action="./result.php">
        <input type="hidden" name="res_cd"          value="<?= $res_cd           ?>">    <!-- 결과 코드 -->
        <input type="hidden" name="res_msg"         value="<?= $res_msg          ?>">    <!-- 결과 메세지 -->
        <input type="hidden" name="ordr_idxx"       value="<?= $ordr_idxx        ?>">    <!-- 주문번호 -->
        <input type="hidden" name="good_mny"        value="<?= $good_mny         ?>">    <!-- 결제금액 -->
        <input type="hidden" name="good_name"       value="<?= $good_name        ?>">    <!-- 상품명 -->
        <input type="hidden" name="buyr_name"       value="<?= $buyr_name        ?>">    <!-- 주문자명 -->

        <!-- 신용카드 정보 -->
        <input type="hidden" name="card_cd"         value="<?= $card_cd          ?>">    <!-- 카드코드 -->
        <input type="hidden" name="card_name"       value="<?= $card_name        ?>">    <!-- 카드이름 -->
        <input type="hidden" name="batch_key"       value="<?= $batch_key        ?>">    <!-- 배치키 -->
    </form>
    </body>
    </html>
