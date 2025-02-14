<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!--알람설정 시작-->
<div id="mypage">
	<div id="point">
		<div class="mypoint">
			<h3>보유 만나</h3>
			<span><?=number_format($mb['cw_point'])?> 만나</span>
		</div>
		<div class="point_state">

			<form action="">
				<ul>
					<li class="tit">
						<span class="man">만나</span>
						<span class="won">결제금액</span>
					</li>
					<li>
						<div class="rdo_ico">
							<input type="radio" name="point_charge" id="man220" value="20000" class="hidden" checked>
							<label for="man220">
								<span class="man">220<b>만나</b></span>
								<span class="won">20,000<b>원</b></span>
							</label>
						</div>
					</li>
					<li>
						<div class="rdo_ico">
							<input type="radio" name="point_charge" id="man330" value="30000" class="hidden">
							<label for="man330">
								<span class="man">330<b>만나</b></span>
								<span class="won">30,000<b>원</b></span>
							</label>
						</div>
					</li>
					<li>
						<div class="rdo_ico">
							<input type="radio" name="point_charge" id="man550" value="50000" class="hidden">
							<label for="man550">
								<span class="man">550<b>만나</b></span>
								<span class="won">50,000<b>원</b></span>
							</label>
						</div>
					</li>
					<li>
						<div class="rdo_ico">
							<input type="radio" name="point_charge" id="man1100" value="100000" class="hidden">
							<label for="man1100">
								<span class="man">1,100<b>만나</b></span>
								<span class="won">100,000<b>원</b></span>
							</label>
						</div>
					</li>
				</ul>
				<div class="btnBox">
					<button type="button" onclick="payment();">결제하기</button>
				</div>
			</form>
		</div>
		<!-- /point_state -->
	</div>
</div><!--mypage-->
<!--마이페이지 끝-->

<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<!--<script type="text/javascript" src="<?/*=G5_JS_URL*/?>/Innopay.js"></script>--><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="GoodsCnt" value="1">
    <input type="hidden" name="GoodsName" id="GoodsName" value="">
    <input type="hidden" name="Amt" id="Amt" value="">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">

	<? if($member[mb_id] == "hong") { $private == true; } ?>

    <?php if($private) { ?>
    <input type="hidden" name="MID" value="testpay01m"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <?php } else { ?>
    <input type="hidden" name="MID" value="pgcsignalm"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="5xX2sDs2cMv6g/tvLaFRlBHH2iDs9YJMf5p33Zu702qSy4Fj7DTrUSF2Q8X9OPWVWITJW3Sr3GuXWmaWK//cwg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <?php } ?>
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/payment_result.php">
    <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/payment_result.php">
    <input type="hidden" name="ResultYN" value="N">

    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="">
    <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
    <input type="hidden" name="FORWARD" value="N"><!-- 팝업유무 Y,N -->

    <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
    <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
    <input type="hidden" name="MallIP" value="127.0.0.1"/>
    <input type="hidden" name="UserIP" value="127.0.0.1">
    <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
    <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
</form>

<script>
    // 결제하기
    function payment() {
        var manna = $("input[name='point_charge']:checked").val() / 10000 * 110;
        $('#GoodsName').val('크리스찬시그널_'+manna+'만나');
        $('#Amt').val($("input[name='point_charge']:checked").val());
        if('<?=$private?>' || '<?=$member['mb_id']?>' == 'hong') {
           $('#Amt').val('10');
           $('#Moid').val($("#Moid").val()+"-"+manna);
        }

        goPay(document.payfrm);
    }
</script>