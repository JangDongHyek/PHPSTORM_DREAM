<?php
include_once('./_common.php');

$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$mb_no;
?>

<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="GoodsCnt" value="1">
    <input type="hidden" name="GoodsName" value="NAIMWEDDING">
    <input type="hidden" name="Amt" value="10">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="MID" value="testpay01m"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/payment_result.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/payment_result.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" value="Y"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>

<script>
    $(function() {
        goPay(document.payfrm);
    });
</script>