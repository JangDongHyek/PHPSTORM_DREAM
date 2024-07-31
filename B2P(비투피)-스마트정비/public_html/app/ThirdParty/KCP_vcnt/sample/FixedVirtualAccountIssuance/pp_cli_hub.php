<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��û PAGE                                                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2024 NHN KCP Inc.   All Rights Reserverd.                   = */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* = ���̺귯�� �� ����Ʈ ���� include                                          = */
    /* = -------------------------------------------------------------------------- = */

    require "./pp_cli_hub_lib.php";
    include "./../../cfg/site_conf_inc.php";
   /* ============================================================================== */
   
    /* ============================================================================== */
    /* =   01. ���� ��û ���� ����                                                  = */
    /* = -------------------------------------------------------------------------- = */
    $ordr_idxx  = $_POST[ "ordr_idxx"   ] ; // �ֹ� ��ȣ
    $good_name  = $_POST[ "good_name"   ] ; // ��ǰ��
    $good_mny   = $_POST[ "good_mny"    ] ; // �Ա� �ݾ�
    $buyr_name  = $_POST[ "buyr_name"   ] ; // �ֹ��� �̸�
    $buyr_mail  = $_POST[ "buyr_mail"   ] ; // �ֹ��� E-Mail
    $buyr_tel1  = $_POST[ "buyr_tel1"   ] ; // �ֹ��� ��ȭ��ȣ
    $buyr_tel2  = $_POST[ "buyr_tel2"   ] ; // �ֹ��� �޴�����ȣ
    $currency   = $_POST[ "currency"    ] ; // ȭ����� (WON/USD)
    $va_uniq_key= $_POST[ "va_uniq_key" ] ; // ����ũ Ű��

    /* = -------------------------------------------------------------------------- = */
    $tx_cd      = "";                                                    // Ʈ����� �ڵ�
    $bSucc      = "";                                                    // DB �۾� ���� ����
    /* = -------------------------------------------------------------------------- = */
    $res_cd     = "";                                                    // ����ڵ�
    $res_msg    = "";                                                    // ����޽���
    $tno        = "";                                                    // �ŷ���ȣ
    /* = -------------------------------------------------------------------------- = */
    $bankname   = "";                                                    // �Ա�����
    $bankcode   = "";                                                    // �����ڵ�
    $depositor  = "";                                                    // ��������ָ�
    $account    = "";                                                    // ������¹�ȣ
    $app_time   = "";                                                    // �߱޽ð�
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   02. �ν��Ͻ� ���� �� �ʱ�ȭ                                              = */
    /* = -------------------------------------------------------------------------- = */
    $c_PayPlus  = new C_PAYPLUS_CLI;
    $c_PayPlus->mf_clear();
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   03. ó�� ��û ���� ����, ����                                             = */
    /* = -------------------------------------------------------------------------- = */

    /* = -------------------------------------------------------------------------- = */
    /* =   03-1. ���� ��û                                                          = */
    /* = -------------------------------------------------------------------------- = */
    // ��ü ȯ�� ����
    $cust_ip = getenv( "REMOTE_ADDR" );
    
        $tx_cd = "00100000";

        $common_data_set = "";
        
        $common_data_set .= $c_PayPlus->mf_set_data_us( "amount"  , $good_mny  );
        $common_data_set .= $c_PayPlus->mf_set_data_us( "currency", $currency  );       
        $common_data_set .= $c_PayPlus->mf_set_data_us( "cust_ip" , $cust_ip   );
        $common_data_set .= $c_PayPlus->mf_set_data_us( "escw_mod", "N"        );

        $c_PayPlus->mf_add_payx_data( "common", $common_data_set );

        // �ֹ� ����

        $c_PayPlus->mf_set_ordr_data( "ordr_idxx",  $ordr_idxx );
        $c_PayPlus->mf_set_ordr_data( "good_name",  $good_name );        
        $c_PayPlus->mf_set_ordr_data( "good_mny" ,  $good_mny  );       
        $c_PayPlus->mf_set_ordr_data( "buyr_name",  $buyr_name );        
        $c_PayPlus->mf_set_ordr_data( "buyr_tel1",  $buyr_tel1 );        
        $c_PayPlus->mf_set_ordr_data( "buyr_tel2",  $buyr_tel2 );        
        $c_PayPlus->mf_set_ordr_data( "buyr_mail",  $buyr_mail );        

        // ������� ����

            $vcnt_data_set ="";
                
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_txtype"  , "41210000"             ); // ���� �� , �����Ұ�
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_mny"     , $good_mny              ); // ���� �ݾ�
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_bankcode", $_POST[ "ipgm_bank"  ] ); // �Ա�����
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_name"    , $_POST[ "ipgm_name"  ] ); // �Ա��ڸ�
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_date"    , $_POST[ "ipgm_date"  ] ); // �Ա� ������
            $vcnt_data_set .= $c_PayPlus->mf_set_data_us( "va_uniq_key", $_POST[ "va_uniq_key"] ); // ����ũ Ű ��

            $c_PayPlus->mf_add_payx_data( "va", $vcnt_data_set );


    /* ============================================================================== */
    /* =   03-2. ����                                                               = */
    /* ------------------------------------------------------------------------------ */

        $c_PayPlus->mf_do_tx( "", $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tx_cd, "",
                              $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx,
                              $cust_ip, $g_conf_log_level, 0, 0, $g_conf_log_path ); 

        $res_cd  = $c_PayPlus->m_res_cd;  // ��� �ڵ�
        $res_msg = $c_PayPlus->m_res_msg; // ��� �޽���

    /* ============================================================================== */


    /* ============================================================================== */
    /* =   04. ���� ��� ó��                                                       = */
    /* = -------------------------------------------------------------------------- = */
            if ( $res_cd == "0000" )
            {
                $tno = $c_PayPlus->mf_get_res_data( "tno" );       // NHNKCP �ŷ� ���� ��ȣ

    /* = -------------------------------------------------------------------------- = */
    /* =   04-1. ������� �߱� ��� ó��                                            = */
    /* = -------------------------------------------------------------------------- = */

                    $bankname  = $c_PayPlus->mf_get_res_data( "bankname"  ) ; // �Ա�����      
                    $bankcode  = $c_PayPlus->mf_get_res_data( "bankcode"  ) ; // �����ڵ�      
                    $depositor = $c_PayPlus->mf_get_res_data( "depositor" ) ; // ��������ָ�  
                    $account   = $c_PayPlus->mf_get_res_data( "account"   ) ; // ������¹�ȣ  
                    $app_time  = $c_PayPlus->mf_get_res_data( "app_time"  ) ; // �߱޽ð�      

    /* = -------------------------------------------------------------------------- = */
    /* =   04-2. ���� ����� ��ü ��ü������ DB ó�� �۾��Ͻô� �κ��Դϴ�.         = */
    /* = -------------------------------------------------------------------------- = */
    /* =         ���� ����� DB �۾� �ϴ� �������� ���������� ���ε� �ǿ� ����      = */
    /* =         DB �۾��� �����Ͽ� DB update �� �Ϸ���� ���� ���, �ڵ�����       = */
    /* =         ���� ��� ��û�� �ϴ� ���μ����� �����Ǿ� �ֽ��ϴ�.                = */
    /* =         DB �۾��� ���� �� ���, bSucc ��� ����(String)�� ���� "false"     = */
    /* =         �� ������ �ֽñ� �ٶ��ϴ�. (DB �۾� ������ ��쿡�� "false" �̿��� = */
    /* =         ���� �����Ͻø� �˴ϴ�.)                                           = */
    /* = -------------------------------------------------------------------------- = */
                $bSucc = "";             // DB �۾� ������ ��� "false" �� ����

    /* = -------------------------------------------------------------------------- = */
    /* =   04-3. DB �۾� ������ ��� �ڵ� ���� ���                                 = */
    /* = -------------------------------------------------------------------------- = */
                if ( $bSucc == "false" )
                {
                    $c_PayPlus->mf_clear();

                    $tx_cd = "00200000";

                    $c_PayPlus->mf_set_modx_data( "tno",      $tno     );                       // NHNKCP ���ŷ� �ŷ���ȣ
                    $c_PayPlus->mf_set_modx_data( "mod_type", "STSC"   );                       // ���ŷ� ���� ��û ����
                    $c_PayPlus->mf_set_modx_data( "mod_ip",   $cust_ip );                       // ���� ��û�� IP
                    $c_PayPlus->mf_set_modx_data( "mod_desc", "��� ó�� ���� - �ڵ� ���" );   // ���� ����
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
    /* =   04-4. ���� ���и� ��ü ��ü������ DB ó�� �۾��Ͻô� �κ��Դϴ�.         = */
    /* = -------------------------------------------------------------------------- = */
            else
            {
            }
    /* ============================================================================== */


    /* ============================================================================== */
    /* =   05. �� ���� �� ��������� ȣ��                                           = */
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
    <form name="pay_info" method="post" action="./result.php">
        <input type="hidden" name="bSucc"       value="<?=$bSucc       ?>">  <!-- ���θ� DB ó�� ���� ���� -->
                                                                      
        <input type="hidden" name="res_cd"      value="<?=$res_cd      ?>">  <!-- ��� �ڵ� -->
        <input type="hidden" name="res_msg"     value="<?=$res_msg     ?>">  <!-- ��� �޼��� -->
        <input type="hidden" name="ordr_idxx"   value="<?=$ordr_idxx   ?>">  <!-- �ֹ���ȣ -->
        <input type="hidden" name="va_uniq_key" value="<?=$va_uniq_key ?>">  <!-- �ֹ���ȣ -->
        <input type="hidden" name="tno"         value="<?=$tno         ?>">  <!-- NHNKCP �ŷ���ȣ -->
        <input type="hidden" name="good_mny"    value="<?=$good_mny    ?>">  <!-- �����ݾ� -->
        <input type="hidden" name="good_name"   value="<?=$good_name   ?>">  <!-- ��ǰ�� -->
        <input type="hidden" name="buyr_name"   value="<?=$buyr_name   ?>">  <!-- �ֹ��ڸ� -->
        <input type="hidden" name="buyr_tel1"   value="<?=$buyr_tel1   ?>">  <!-- �ֹ��� ��ȭ��ȣ -->
        <input type="hidden" name="buyr_tel2"   value="<?=$buyr_tel2   ?>">  <!-- �ֹ��� �޴�����ȣ -->
        <input type="hidden" name="buyr_mail"   value="<?=$buyr_mail   ?>">  <!-- �ֹ��� E-mail -->
                                                                      
        <input type="hidden" name="bankname"    value="<?=$bankname    ?>">  <!-- ����������� -->
        <input type="hidden" name="bankcode"    value="<?=$bankcode    ?>">  <!-- ������������ڵ� -->
        <input type="hidden" name="depositor"   value="<?=$depositor   ?>">  <!-- ��������ָ� -->
        <input type="hidden" name="account"     value="<?=$account     ?>">  <!-- ������¹�ȣ -->
        <input type="hidden" name="app_time"    value="<?=$app_time    ?>">  <!-- �߱޽ð� -->
    </form>
    </body>
    </html>