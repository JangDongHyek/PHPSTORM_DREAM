<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��û PAGE                                                    = */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* = ���̺귯�� �� ����Ʈ ���� include                                          = */
    /* = -------------------------------------------------------------------------- = */
    include "../cfg/site_conf_inc.php";       // ȯ�漳�� ���� include
    require "pp_cli_hub_lib.php";              // library [�����Ұ�]
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   01. ���� ��û ���� ����                                                  = */
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx  = $_POST[ "ordr_idxx"  ];  // �ֹ� ��ȣ
    $good_name  = $_POST[ "good_name"  ];  // ��ǰ ����
    $good_mny   = $_POST[ "good_mny"   ];  // ���� �ݾ�
    $buyr_name  = $_POST[ "buyr_name"  ];  // �ֹ��� �̸�
    $buyr_mail  = $_POST[ "buyr_mail"  ];  // �ֹ��� E-Mail
    $buyr_tel2  = $_POST[ "buyr_tel2"  ];  // �ֹ��� �޴�����ȣ
    $currency   = $_POST[ "currency"   ];  // ȭ����� (WON)
    /* = -------------------------------------------------------------------------- = */
    $tran_cd       = "";                                               // Ʈ����� �ڵ�
    /* = -------------------------------------------------------------------------- = */
    $res_cd        = "";                                               // ����ڵ�
    $res_msg       = "";                                               // ����޽���
    $tno           = "";                                               // NHN KCP �ŷ���ȣ
    /* = -------------------------------------------------------------------------- = */
    $card_cd         = "";                                             // ī�� �ڵ�
    $card_no         = "";                                             // ī�� ��ȣ
    $card_name       = "";                                             // ī���
    $app_time        = "";                                             // ���νð�
    $app_no          = "";                                             // ���ι�ȣ
    $quota           = "";                                             // �Һΰ���
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   02. �ν��Ͻ� ���� �� �ʱ�ȭ                                              = */
    /* = -------------------------------------------------------------------------- = */

    $c_PayPlus  = new C_PAYPLUS_CLI;
    $c_PayPlus->mf_clear();
    
    /* ============================================================================== */

    /* = -------------------------------------------------------------------------- = */
    /* =   03. ���� ��û                                                          = */
    /* = -------------------------------------------------------------------------- = */
    // ��ü ȯ�� ����
    $cust_ip = getenv( "REMOTE_ADDR" ); // ��û IP (�ɼǰ�)

    $cust_ip = getenv( "REMOTE_ADDR" ); // ��û IP (�ɼǰ�)

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
    /* =   04. ���� �� ���ó��                                                        = */
    /* ------------------------------------------------------------------------------ */

	$c_PayPlus->mf_do_tx( $trace_no, $g_conf_home_dir, $g_conf_site_cd, "", $tran_cd, "",
						  $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
						  $cust_ip, $g_conf_log_level, 0, 0);

	$res_cd  = $c_PayPlus->m_res_cd;  // ��� �ڵ�
	$res_msg = $c_PayPlus->m_res_msg; // ��� �޽���

	$tno   = $c_PayPlus->mf_get_res_data( "tno"       ); // NHN KCP �ŷ���ȣ                
	$amount   = $c_PayPlus->mf_get_res_data( "amount"       ); // �� �ݾ�
	$card_cd   = $c_PayPlus->mf_get_res_data( "card_cd"   ); // ī��� �ڵ�
	$card_no   = $c_PayPlus->mf_get_res_data( "card_no"   ); // ī�� ��ȣ
	$card_name = $c_PayPlus->mf_get_res_data( "card_name" ); // ī�� ����
	$app_time  = $c_PayPlus->mf_get_res_data( "app_time"  ); // ���� �ð�
	$app_no    = $c_PayPlus->mf_get_res_data( "app_no"    ); // ���� ��ȣ
	$quota     = $c_PayPlus->mf_get_res_data( "quota"     ); // �Һ� ���� ��
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
        <form name="pay_info" method="post" action="./result.php">
            <input type="hidden" name="amount"     value="<?=$amount     ?>">  <!-- �� �ݾ� -->

            <input type="hidden" name="res_cd"     value="<?=$res_cd     ?>">  <!-- ��� �ڵ� -->
            <input type="hidden" name="res_msg"    value="<?=$res_msg    ?>">  <!-- ��� �޼��� -->
            <input type="hidden" name="ordr_idxx"  value="<?=$ordr_idxx  ?>">  <!-- �ֹ���ȣ -->
            <input type="hidden" name="tno"        value="<?=$tno        ?>">  <!-- NHN KCP �ŷ���ȣ -->
            <input type="hidden" name="good_mny"   value="<?=$good_mny   ?>">  <!-- �����ݾ� -->
            <input type="hidden" name="good_name"  value="<?=$good_name  ?>">  <!-- ��ǰ�� -->
            <input type="hidden" name="buyr_name"  value="<?=$buyr_name  ?>">  <!-- �ֹ��ڸ� -->
            <input type="hidden" name="buyr_tel2"  value="<?=$buyr_tel2  ?>">  <!-- �ֹ��� �޴�����ȣ -->
            <input type="hidden" name="buyr_mail"  value="<?=$buyr_mail  ?>">  <!-- �ֹ��� E-mail -->

            <input type="hidden" name="card_cd"    value="<?=$card_cd    ?>">  <!-- ī���ڵ� -->
            <input type="hidden" name="card_no"    value="<?=$card_no    ?>">  <!-- ī���ȣ -->
            <input type="hidden" name="card_name"  value="<?=$card_name  ?>">  <!-- ī��� -->
            <input type="hidden" name="app_time"   value="<?=$app_time   ?>">  <!-- ���νð� -->
            <input type="hidden" name="app_no"     value="<?=$app_no     ?>">  <!-- ���ι�ȣ -->
            <input type="hidden" name="quota"      value="<?=$quota      ?>">  <!-- �Һΰ��� -->

        </form>
    </body>
    </html>
