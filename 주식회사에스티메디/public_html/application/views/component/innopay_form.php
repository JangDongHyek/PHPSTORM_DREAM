<?php
/**
 * 이노페이 결제연동
 */
// $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
// $currentDomain = $_SERVER['HTTP_HOST'];
// $currentUrl = $protocol . $currentDomain;
$currentUrl = rtrim(base_url(), '/');

$CI =& get_instance();
$member = $CI->session->userdata('member');

?>
<!-- InnoPay 결제연동 스크립트(필수) -->
<!--<script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/jquery-2.1.4.min.js"></script>-->
<script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/innopay-2.0.js" charset="utf-8"></script>
<script>
	<? // 이노페이 PG 결제호출 ?>
	const executePayment = (data={}) => {
		const f = document.ipay;
		const iPayJson = {
			PayMethod: data.payMethod,              // data*
			MID: f.MID.value,
			MerchantKey: f.MerchantKey.value,
			GoodsName: data.goodsName || '일반',     // data*
			Amt: data.amt + '',                          // data*
			Moid: data.moid,                        // data*
			BuyerName: f.BuyerName.value,
			BuyerTel: f.BuyerTel.value,
			BuyerEmail: f.BuyerEmail.value,
			ResultYN: 'N',
			ReturnURL: f.ReturnURL.value,
			FORWARD: 'Y',
			GoodsCnt: 1,
			MallReserved: data.mallReserved ?? '',  // data*
		};

		if (iPayJson.BuyerTel == '') iPayJson.BuyerTel = '051-853-3475';

		// 필수필드 검사
		if (iPayJson.PayMethod == '') {
			showAlert('결제수단 입력실패<br>관리자에게 문의해 주세요.');
			return false;
		}
		if (iPayJson.Amt == '0') {
			showAlert('결제금액 입력실패<br>관리자에게 문의해 주세요.');
			return false;
		}
		if (iPayJson.Moid == '0') {
			showAlert('주문번호 입력실패<br>관리자에게 문의해 주세요.');
			return false;
		}

		// 테스트 100원
        <?if(IS_PRIVATE){?>
		if (data.payMethod != 'VBANK') {
		    iPayJson.Amt = "100";
		}

		console.log(iPayJson);
		<?}?>

		// 이노페이 실행
		innopay.goPay(iPayJson);
	}

</script>

<form name="ipay" method="post">
	<input type="hidden" name="MID" value="<?=IPAY_MID?>"/>
	<input type="hidden" name="MerchantKey" value="<?=IPAY_KEY?>"/>
	<input type="hidden" name="BuyerName" value="<?=$member['mb_id']?>"/>
	<input type="hidden" name="BuyerTel" value="<?=$member['cn_tel']?>"/>
	<input type="hidden" name="BuyerEmail" value="<?=$member['cn_email'] ? $member['cn_email'] : 'itforyou@daum.net'?>"/>
	<input type="hidden" name="ReturnURL" value="<?=$currentUrl?>/api/returnIPay"/>
	<?/**
	<!--필수필드-->
	<input type="hidden" name="PayMethod" value=""/><!--지불수단-->
	<input type="hidden" name="MID" value="<?=IPAY_MID?>"/><!--상점아이디-->
	<input type="hidden" name="MerchantKey" value="<?=IPAY_KEY?>"/><!--상점라이센스키-->
	<input type="hidden" name="GoodsName" value="약속처방"/><!--상품명-->
	<input type="hidden" name="Amt" value="0"/><!--거래금액-->
	<input type="hidden" name="Moid" value=""/><!--상점주문번호-->
	<input type="hidden" name="BuyerName" value=""/><!--구매자명-->
	<input type="hidden" name="BuyerTel" value=""/><!--구매자연락처-->
	<input type="hidden" name="BuyerEmail" value=""/><!--구매자메일주소-->
	<input type="hidden" name="ResultYN" value="Y"/><!--결제결과창유무-->
	<input type="hidden" name="ReturnURL" value=""/><!--결제결과전송URL-->
	<!--선택필드 -->
	<input type="hidden" name="FORWARD" value="Y"/><!--결제창연동방식-->
	<input type="hidden" name="GoodsCnt" value="1"/><!--결제상품개수-->
	<input type="hidden" name="MallReserved" value=""/><!--상점예비정보-->
	<input type="hidden" name="OfferingPeriod" value=""/><!--제공기간-->
	<input type="hidden" name="ArsConnType" value=""/><!--ARS연동방식-->
	<input type="hidden" name="DutyFreeAmt" value=""/><!--면세금액-->
	<input type="hidden" name="EncodingType" value=""/><!--인코딩타입-->
	<input type="hidden" name="MallIP" value=""/><!--가맹점서버IP-->
	<input type="hidden" name="UserIP" value=""/><!--구매자IP-->
	<input type="hidden" name="mallUserID" value=""/><!--가맹점고객ID-->
	<input type="hidden" name="User_ID" value=""/><!--영업사원ID-->
	<input type="hidden" name="VbankExpDate" value=""/><!--가상계좌입금예정일-->
	 */?>
</form>
