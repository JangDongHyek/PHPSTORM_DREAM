<style>
	.innopay-layer{position:fixed;top:0px;left:0px;width:100%;height:100%;z-index:999999;display:none}
</style>

<input type="hidden" name="ordr_idxx"   value="<?php echo $od_id; ?>">
<input type="hidden" name="good_name"   value="<?php echo $goods; ?>">
<input type="hidden" name="good_mny"    value="<?php echo $tot_price; ?>">
<input type="hidden" name="PayMethod" id="PayMethod" value="CARD">
<input type="hidden" name="GoodsCnt" value="1" placeholder="">
<input type="hidden" name="GoodsName" value="" placeholder="상품">
<input type="hidden" name="Amt" value="" placeholder="10000" onKeyUp="javascript:numOnly(this,document.frm,false);">
<input type="hidden" name="Moid" value="" placeholder="11222">
<!--<input type="hidden" name="MID" value="testpay01m" placeholder="">-->
<input type="hidden" name="MID" value="<?=$default['de_inno_mid']?>" placeholder="">
<input type="hidden" name="ReturnURL" value="<?=G5_SHOP_URL?>/innopay.return.php" placeholder="">
<input type="hidden" name="ResultYN" value="N" >
<input type="hidden" name="mallUserID" value="<?=$member[mb_id]?>" maxlength="30" placeholder="">
<input type="hidden" name="BuyerName" value="<?=$row[re_name]?>" placeholder="">
<input type="hidden" name="BuyerTel" value="<?=$row[re_tel]?>" placeholder="">
<input type="hidden" name="BuyerEmail" value="" placeholder="">
 <!--hidden 데이타 필수-->
<input type="hidden" name="ediDate" value=""> <!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
<input type="hidden" name="MerchantKey" value="<?=$default['de_inno_mert_key']?>"> <!-- 발급된 가맹점키 -->
<input type="hidden" name="EncryptData" value=""> <!-- 암호화데이터 -->
<input type="hidden" name="MallIP" value="127.0.0.1"/> <!-- 가맹점서버 IP 가맹점에서 설정-->
<input type="hidden" name="UserIP" value="127.0.0.1"> <!-- 구매자 IP 가맹점에서 설정-->
<input type="hidden" name="FORWARD" value="Y" id="forward"> <!--Y:팝업연동 N:페이지전환 -->
<input type="hidden" name="MallResultFWD"   value="N"> <!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
<input type="hidden" name="device" value=""> <!-- 자동셋팅 -->
<!--hidden 데이타 옵션-->
<input type="hidden" name="BrowserType" value="">
<input type="hidden" name="MallReserved" value="">
<!-- 현재는 사용안함 -->
<input type="hidden" name="SUB_ID" value=""> <!-- 서브몰 ID -->
<input type="hidden" name="BuyerPostNo" value="" > <!-- 배송지 우편번호 -->
<input type="hidden" name="BuyerAddr" value=""> <!-- 배송지주소 -->
<input type="hidden" name="BuyerAuthNum">
<input type="hidden" name="ParentEmail">

<!-- 리턴 받는 값 필드-->
<input type="hidden" name="tno" value=""><!--T아이디-->
<input type="hidden" name="app_no" value=""><!-- -->
<input type="hidden" name="amount" value=""><!-- 가격-->
<input type="hidden" name="app_time" value=""><!-- 결제 시간-->
<input type="hidden" name="card_name" value=""><!-- 카드명 -->
<input type="hidden" name="bank_name" value=""><!-- 은행명 -->


