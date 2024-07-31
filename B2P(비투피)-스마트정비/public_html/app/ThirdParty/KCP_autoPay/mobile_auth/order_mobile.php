<?
    /* ============================================================================== */
    /* =   PAGE : 결제 요청 PAGE                                             			= */
    /* ============================================================================== */
?>
<?
     include "../cfg/site_conf_inc.php";       // 환경설정 파일 include
?>
<?
	/* ============================================================================== */
    /* =   PAGE : 지불 정보 설정 PAGE                                             			= */
    /* ============================================================================== */
    /* kcp와 통신후 kcp 서버에서 전송되는 결제 요청 정보 */
    $req_tx          = $_POST[ "req_tx"         ]; // 요청 종류         
    $res_cd          = $_POST[ "res_cd"         ]; // 응답 코드         
    $tran_cd         = $_POST[ "tran_cd"        ]; // 트랜잭션 코드     
    $ordr_idxx       = $_POST[ "ordr_idxx"      ]; // 주문번호
    $good_name       = $_POST[ "good_name"      ]; // 상품명            
    $good_mny        = $_POST[ "good_mny"       ]; // 결제금액       
    $buyr_name       = $_POST[ "buyr_name"      ]; // 주문자명          
	$enc_info        = $_POST[ "enc_info"       ]; // 암호화 정보       
    $enc_data        = $_POST[ "enc_data"       ]; // 암호화 데이터     

  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
  <title>배치키 발급 샘플페이지</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi">  
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <meta http-equiv="Pragma" content="no-cache"> 
  <meta http-equiv="Expires" content="-1">
  <link href="../static/css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>

 <!-- 거래등록 하는 kcp 서버와 통신을 위한 스크립트-->
<script type="text/javascript" src="js/approval_key.js"></script>

<script type="text/javascript">
      /* 주문번호 생성 예제 */
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

    /* kcp web 결제창 호츨 (변경불가) */
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

    /* kcp 통신을 통해 받은 암호화 정보 체크 후 결제 요청 (변경불가) */
    function chk_pay()
    {
        self.name = "tar_opener";
        var pay_form = document.pay_form;

        if (pay_form.res_cd.value == "3001" )
        {
            alert("사용자가 취소하였습니다.");
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

<!-- 주문정보 입력 form : order_info -->
<form name="order_info" method="post" action="pp_cli_hub.php" >

<?
    /* ============================================================================== */
    /* =   1. 주문 정보 입력                                                        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
                <!-- header -->
                <div class="header">
                    <a href="../index.html" class="btn-back"><span>뒤로가기</span></a>
                    <h1 class="title">배치키 발급 SAMPLE</h1>
                </div>
                <!-- //header -->
                <!-- contents -->
				<div id="skipCont" class="contents">
					<p class="txt-type-1">이 페이지는 배치키 발급 요청을 하는 페이지입니다.</p>
					<p class="txt-type-2">소스 수정 시 [※ 필수] 또는 [※ 옵션] 표시가 포함된 문장은 가맹점의 상황에 맞게 적절히 수정 적용하시기 바랍니다.</p>


					<h2 class="title-type-3">주문 정보</h2>
					<ul class="list-type-1">

					<!-- 주문번호 -->
                    <li>
                        <div class="left"><p class="title">주문번호</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="ordr_idxx" value="" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>

					<!-- 상품명 -->
                    <li>
                        <div class="left"><p class="title">상품명</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="good_name" value="운동화" maxlength="40" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>

					<!-- 결제 금액 -->
                    <li>
                        <div class="left"><p class="title">결제 금액</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="good_mny" value="1004" maxlength="9" />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>
 
					<!-- 주문자명 -->
                    <li>
                        <div class="left"><p class="title">주문자명</p></div>
                        <div class="right">
                            <div class="ipt-type-1 pc-wd-2">
                                <input type="text" name="buyr_name" value="홍길동"  />
                                <a href="#none" class="btn-clear"></a>
                            </div>
                        </div>
                    </li>                   
					</ul>

					 <!-- 정기과금 정보 -->
					<h2 class="title-type-3">정기과금 정보</h2>
					<ul class="list-type-1">


					<!-- 그룹 ID -->
                    <li>
                        <div class="left"><p class="title">그룹 ID</p></div>
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
						<li><a href="#none" onclick="kcp_AJAX();" class="btn-type-2 pc-wd-3">배치키 발급 요청</a></li>						
						<li class="pc-only-show"><a href="../index.html" class="btn-type-3 pc-wd-2">처음으로</a></li>
					</ul>
					</div>
                
                    <!-- footer -->
                    <div class="grid-footer">
                        <div class="inner">
                            <div class="footer">
                                ⓒ NHN KCP Corp.
                            </div>
                        </div>
                    </div>
                    <!--//footer-->

      <!-- 공통정보 -->
	<input type="hidden" name="req_tx"          value='pay'>                           <!-- 요청 구분 -->
    <input type="hidden" name="shop_name"       value="<?=$g_conf_site_name ?>">       <!-- 사이트 이름 --> 
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd   ?>">       <!-- 사이트 코드 -->
    <input type="hidden" name="currency"        value="410"/>                          <!-- 통화 코드 -->
    
    <!-- 결제등록 키 -->
    <input type="hidden" name="approval_key"    id="approval">
    <!-- 인증시 필요한 파라미터(변경불가)-->
    <input type="hidden" name="escw_used"       value="N">
    <input type="hidden" name="pay_method"      value="AUTH">
    <input type="hidden" name="ActionResult"    value="batch">
    <!-- 리턴 URL (kcp와 통신후 결제를 요청할 수 있는 암호화 데이터를 전송 받을 가맹점의 주문페이지 URL) -->
    <input type="hidden" name="Ret_URL"         value="<?=$url?>">


    <!-- 결제 정보 등록시 응답 타입 ( 필드가 없거나 값이 '' 일경우 TEXT, 값이 XML 또는 JSON 지원 -->
    <input type="hidden" name="response_type"  value="TEXT"/>
    <input type="hidden" name="PayUrl"   id="PayUrl"   value=""/>
    <input type="hidden" name="traceNo"  id="traceNo"  value=""/>

</form>
</div>
<form name="pay_form" method="post" action="pp_cli_hub.php">
    <input type="hidden" name="res_cd"         value="<?=$res_cd?>">              <!-- 결과 코드          -->
    <input type="hidden" name="tran_cd"        value="<?=$tran_cd?>">             <!-- 트랜잭션 코드      -->
    <input type="hidden" name="ordr_idxx"      value="<?=$ordr_idxx?>">           <!-- 주문번호           -->
	<input type="hidden" name="good_mny"       value="<?=$good_mny?>">             <!-- 결제금액           -->
	<input type="hidden" name="good_name"      value="<?=$good_name?>">            <!-- 상품명             -->	
    <input type="hidden" name="buyr_name"      value="<?=$buyr_name?>">           <!-- 주문자명           -->
    <input type="hidden" name="enc_info"       value="<?=$enc_info?>">
    <input type="hidden" name="enc_data"       value="<?=$enc_data?>">	
</form>
</body>
</html>
