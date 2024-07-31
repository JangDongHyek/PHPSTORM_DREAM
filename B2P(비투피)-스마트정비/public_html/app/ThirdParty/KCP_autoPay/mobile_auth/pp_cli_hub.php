<?
    /* ============================================================================== */
    /* =   PAGE : ��ġŰ �߱� ��û ���� ����													= */
    /* ============================================================================== */
    
	include "../cfg/site_conf_inc.php";       // ȯ�漳�� ���� include
    require "pp_cli_hub_lib.php";              // library [�����Ұ�]

?>

<?
    /* ============================================================================== */
    /* =   01. ��ġŰ �߱� ��û ���� ����             	                                    = */
    /* = -------------------------------------------------------------------------- = */
    $cust_ip        = getenv( "REMOTE_ADDR"    ); // ��û IP
    /* = -------------------------------------------------------------------------- = */
    $tran_cd        = $_POST[ "tran_cd"        ]; // ó�� ����
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx      = $_POST[ "ordr_idxx"      ]; // �ֹ���ȣ
    $good_name      = $_POST[ "good_name"      ]; // ��ǰ��
    $good_mny       = $_POST[ "good_mny"       ]; // �����ݾ�
    $buyr_name      = $_POST[ "buyr_name"      ]; // �ֹ��ڸ�
    /* = -------------------------------------------------------------------------- = */
    $res_cd         = "";                                                     // �����ڵ�
    $res_msg        = "";                                                     // ���� �޼���
    /* = -------------------------------------------------------------------------- = */
    $card_cd        = "";                                                     // �ſ�ī�� �ڵ�
    $card_name      = "";                                                     // �ſ�ī�� ��
    $batch_key      = "";                                                     // ��ġŰ

    /* ============================================================================== */
    /* =   02. �ν��Ͻ� ���� �� �ʱ�ȭ                                              = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus = new C_PP_CLI;
    $c_PayPlus->mf_clear();


    /* = -------------------------------------------------------------------------- = */
    /* =   03. ��ġŰ �߱� ��û              		                                        = */
    /* = -------------------------------------------------------------------------- = */
	
	$c_PayPlus->mf_set_encx_data( $_POST[ "enc_data" ], $_POST[ "enc_info" ] );


    /* ============================================================================== */
    /* =   04. ����                                                                 = */
    /* = -------------------------------------------------------------------------- = */

	$c_PayPlus->mf_do_tx( $trace_no, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "",
						  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
						  $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); // ���� ���� ó��

	$res_cd  = $c_PayPlus->m_res_cd;  // ��� �ڵ�
	$res_msg = $c_PayPlus->m_res_msg; // ��� �޽���
	$card_cd   = $c_PayPlus->mf_get_res_data( "card_cd"   );       // ī�� �ڵ�
	$card_name = $c_PayPlus->mf_get_res_data( "card_name" );       // ī���
	$batch_key = $c_PayPlus->mf_get_res_data( "batch_key" );       // ��ġŰ
?>
    <html>
    <head>
        <title>����Ʈ�� �� ����â</title>
        <script type="text/javascript">
            function goResult()
            {
                document.pay_info.submit()
            }

            // ���� �� ���ΰ�ħ ���� ���� ��ũ��Ʈ (�ߺ����� ����)
            function noRefresh()
            {
                /* CTRL + NŰ ����. */
                if ((event.keyCode == 78) && (event.ctrlKey == true))
                {
                    event.keyCode = 0;
                    return false;
                }
                /* F5 ��Ű ����. */
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
        <input type="hidden" name="res_cd"          value="<?= $res_cd           ?>">    <!-- ��� �ڵ� -->
        <input type="hidden" name="res_msg"         value="<?= $res_msg          ?>">    <!-- ��� �޼��� -->
        <input type="hidden" name="ordr_idxx"       value="<?= $ordr_idxx        ?>">    <!-- �ֹ���ȣ -->
        <input type="hidden" name="good_mny"        value="<?= $good_mny         ?>">    <!-- �����ݾ� -->
        <input type="hidden" name="good_name"       value="<?= $good_name        ?>">    <!-- ��ǰ�� -->
        <input type="hidden" name="buyr_name"       value="<?= $buyr_name        ?>">    <!-- �ֹ��ڸ� -->

        <!-- �ſ�ī�� ���� -->
        <input type="hidden" name="card_cd"         value="<?= $card_cd          ?>">    <!-- ī���ڵ� -->
        <input type="hidden" name="card_name"       value="<?= $card_name        ?>">    <!-- ī���̸� -->
        <input type="hidden" name="batch_key"       value="<?= $batch_key        ?>">    <!-- ��ġŰ -->
    </form>
    </body>
    </html>
