<?
    /* ============================================================================== */
    /* =   PAGE : ���� ��û PAGE                                             			= */
    /* ============================================================================== */
?>
<?
     include "../cfg/site_conf_inc.php";       // ȯ�漳�� ���� include
?>
<?
	/* ============================================================================== */
    /* =   PAGE : ���� ���� ���� PAGE                                             			= */
    /* ============================================================================== */
    /* kcp�� ����� kcp �������� ���۵Ǵ� ���� ��û ���� */
    $req_tx          = $_POST[ "req_tx"         ]; // ��û ����         
    $res_cd          = $_POST[ "res_cd"         ]; // ���� �ڵ�         
    $tran_cd         = $_POST[ "tran_cd"        ]; // Ʈ����� �ڵ�     
    $ordr_idxx       = $_POST[ "ordr_idxx"      ]; // �ֹ���ȣ
    $good_name       = $_POST[ "good_name"      ]; // ��ǰ��            
    $good_mny        = $_POST[ "good_mny"       ]; // �����ݾ�       
    $buyr_name       = $_POST[ "buyr_name"      ]; // �ֹ��ڸ�          
	$enc_info        = $_POST[ "enc_info"       ]; // ��ȣȭ ����       
    $enc_data        = $_POST[ "enc_data"       ]; // ��ȣȭ ������     

  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>��ġŰ �߱� ����������</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">  
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <meta http-equiv="Pragma" content="no-cache"> 
  <meta http-equiv="Expires" content="-1">
  <link href="../static/css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>

 <!-- �ŷ���� �ϴ� kcp ������ ����� ���� ��ũ��Ʈ-->
<script type="text/javascript" src="js/approval_key.js"></script>

<script type="text/javascript">
      /* �ֹ���ȣ ���� ���� */
    function init_orderid()
    {
        var today = new Date();
        var year  = today.getFullYear();
        var month = today.getMonth() + 1;
        var date  = today.getDate();
        var time  = today.getTime();

        if (parseInt(month) < 10)
        {
            month = "0" + month;
        }

        if (parseInt(date) < 10)
        {
            date  = "0" + date;
        }

        var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;

        document.order_info.ordr_idxx.value = order_idxx;
    }

    /* kcp web ����â ȣ�� (����Ұ�) */
    function call_pay_form()
    {
        var v_frm = document.order_info;

        v_frm.action = PayUrl;

        if (v_frm.Ret_URL.value == "")
        {
            return false;
        }
        else
        {
            v_frm.submit();
        }
    }

    /* kcp ����� ���� ���� ��ȣȭ ���� üũ �� ���� ��û (����Ұ�) */
    function chk_pay()
    {
        self.name = "tar_opener";
        var pay_form = document.pay_form;

        if (pay_form.res_cd.value == "3001" )
        {
            alert("����ڰ� ����Ͽ����ϴ�.");
            pay_form.res_cd.value = "";
        }

        if (pay_form.enc_info.value)
        {
            pay_form.submit();
        }
    }
</script>
</head>

<body onload="init_orderid();chk_pay();">
<div class="wrap">

<!-- �ֹ����� �Է� form : order_info -->
<form name="order_info" method="post" action="pp_cli_hub.php" >

<?
    /* ============================================================================== */
    /* =   1. �ֹ� ���� �Է�                                                        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ������ �ʿ��� �ֹ� ������ �Է� �� �����մϴ�.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
                <!-- header -->
                <div class="header">
                    <a href="../index.html" class="btn-back"><span>�ڷΰ���</span></a>
                    <h1 class="title">��ġŰ �߱� SAMPLE</h1>
                </div>
                <!-- //header -->
                <!-- contents -->
				<div id="skipCont" class="contents">
					<p class="txt-type-1">�� �������� ��ġŰ �߱� ��û�� �ϴ� �������Դϴ�.</p>
					<p class="txt-type-2">�ҽ� ���� �� [�� �ʼ�] �Ǵ� [�� �ɼ�] ǥ�ð� ���Ե� ������ �������� ��Ȳ�� �°� ������ ���� �����Ͻñ� �ٶ��ϴ�.</p>


					<h2 class="title-type-3">�ֹ� ����</h2>
					<ul class="list-type-1">

					<!-- �ֹ���ȣ -->
                    <li>
                        <div class="left"><p class="title">�ֹ���ȣ</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="ordr_idxx" value="" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>

					<!-- ��ǰ�� -->
                    <li>
                        <div class="left"><p class="title">��ǰ��</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="good_name" value="�ȭ" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>

					<!-- ���� �ݾ� -->
                    <li>
                        <div class="left"><p class="title">���� �ݾ�</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="good_mny" value="1004" maxlength="9" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
 
					<!-- �ֹ��ڸ� -->
                    <li>
                        <div class="left"><p class="title">�ֹ��ڸ�</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_name" value="ȫ�浿"  />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>                   
					</ul>

					 <!-- ������� ���� -->
					<h2 class="title-type-3">������� ����</h2>
					<ul class="list-type-1">


					<!-- �׷� ID -->
                    <li>
                        <div class="left"><p class="title">�׷� ID</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="kcp_group_id" value="A52Q71000489" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
 					</ul>  
					<div Class="Line-Type-1">
					<ul class="list-btn-2">
						<li><a href="#none" onclick="kcp_AJAX();" class="btn-type-2 pc-wd-3">��ġŰ �߱� ��û</a></li>						
						<li class="pc-only-show"><a href="../index.html" class="btn-type-3 pc-wd-2">ó������</a></li>
					</ul>
					</div>
                
                    <!-- footer -->
                    <div class="grid-footer">
                        <div class="inner">
                            <div class="footer">
                                �� NHN KCP Corp.
                            </div>
                        </div>
                    </div>
                    <!--//footer-->

      <!-- �������� -->
	<input type="hidden" name="req_tx"          value='pay'>                           <!-- ��û ���� -->
    <input type="hidden" name="shop_name"       value="<?=$g_conf_site_name ?>">       <!-- ����Ʈ �̸� --> 
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd   ?>">       <!-- ����Ʈ �ڵ� -->
    <input type="hidden" name="currency"        value="410"/>                          <!-- ��ȭ �ڵ� -->
    
    <!-- ������� Ű -->
    <input type="hidden" name="approval_key"    id="approval">
    <!-- ������ �ʿ��� �Ķ����(����Ұ�)-->
    <input type="hidden" name="escw_used"       value="N">
    <input type="hidden" name="pay_method"      value="AUTH">
    <input type="hidden" name="ActionResult"    value="batch">
    <!-- ���� URL (kcp�� ����� ������ ��û�� �� �ִ� ��ȣȭ �����͸� ���� ���� �������� �ֹ������� URL) -->
    <input type="hidden" name="Ret_URL"         value="<?=$url?>">


    <!-- ���� ���� ��Ͻ� ���� Ÿ�� ( �ʵ尡 ���ų� ���� '' �ϰ�� TEXT, ���� XML �Ǵ� JSON ���� -->
    <input type="hidden" name="response_type"  value="TEXT"/>
    <input type="hidden" name="PayUrl"   id="PayUrl"   value=""/>
    <input type="hidden" name="traceNo"  id="traceNo"  value=""/>

</form>
</div>
<form name="pay_form" method="post" action="pp_cli_hub.php">
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">              <!-- ��� �ڵ�          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">             <!-- Ʈ����� �ڵ�      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">           <!-- �ֹ���ȣ           -->
	<input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- �����ݾ�           -->
	<input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- ��ǰ��             -->	
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">           <!-- �ֹ��ڸ�           -->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">	
</form>
</body>
</html>
