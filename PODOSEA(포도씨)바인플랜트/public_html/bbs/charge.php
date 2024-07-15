<?
include_once('./_common.php');
$name = "charge";
$g5['title'] = '충전하기';
include_once('./_head.php');

$price = $p; // 충전금액

if(!empty($price)) {
    if($price != 3300 && $price != 9900 && $price != 33000 && $price != 99000 && $price != 198000 && $price != 495000) {
        alert('올바른 경로가 아닙니다.');
    }
}

// 이노페이 결제 moid
$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$member['mb_no'];
?>

<? if($name=="charge") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="charge">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#ft_menu{display:none;}
	.box_cont{margin:0;}
</style>

    <input type="hidden" value="" id="charge_bunker" name="charge_bunker">
    <input type="hidden" value="" id="charge_bonus" name="charge_bonus">
    <input type="hidden" value="" id="charge_price" name="charge_price">
    <div id="area_charge">
		<h2 class="title">충전하기</h2>
		<div id="charge_wrap">
			<div id="box_charge">
				<h3>충전금액을 선택해 주세요.</h3>
				<div class="box_cont">
					<!--<ul class="list_product charge">
						<li>
							<button type="button" class="btn_close" onclick="delPrice();"></button>
							<input type="text" class="frm_input" id="charge_value" name="charge_value" placeholder="충전금액" value="<?/*= !empty($price) ? number_format($price) : ''*/?>" onkeyup="comma_number(this);selectPrice(this.value, 'input');">
						</li>
					</ul>-->
					<div class="mybunker">충전 후 벙커 : <span id="bunker"></span></div>
					
					<ul class="carge_list">
						<li id="p3300" onclick="selectPrice('3300');" <?php echo $price == '3300' ? 'class="on"' : ''; ?>><span>+3,300</span></li>
						<li id="p9900" onclick="selectPrice('9900');" <?php echo $price == '9900' ? 'class="on"' : ''; ?>><span>+9,900</span></li>
						<li id="p33000" onclick="selectPrice('33000');" <?php echo $price == '33000' ? 'class="on"' : ''; ?>><span>+33,000</span></li>
						<li id="p99000" onclick="selectPrice('99000');" <?php echo $price == '99000' ? 'class="on"' : ''; ?>><span>+99,000</span></li>
						<li id="p198000" onclick="selectPrice('198000');" <?php echo $price == '198000' ? 'class="on"' : ''; ?>><span>+198,000</span></li>
						<li id="p495000" onclick="selectPrice('495000');" <?php echo $price == '495000' ? 'class="on"' : ''; ?>><span>+495,000</span></li>
					</ul>				
				</div>

				<div class="box">
					<h3>결제수단</h3>
					<ul class="area_pay">
						<li>
							<div class="box_radio">
							<label for="pay01">
								
								<input type="radio" id="pay01" checked name="pay_type" value="CARD" checked>						
								<span class="radio_body"></span>
								<em>카드결제</em>
							</label>
							</div>
						</li>
						<!--<li>
							<div class="box_radio">
							<label for="pay02">
								<input type="radio" id="pay02" name="pay_type" value="BANK">
								<span class="radio_body"></span>
								<em>무통장입금</em>
							</label>
							</div>
						</li>-->
					</ul>
				</div>

				<div class="area_btn fixed">
					<a href="javascript:charge();" class="btn_next">충전하기</a>
				</div>
			</div>	
	</div>

    <script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
    <form id="payfrm" name="payfrm" method="post">
        <!-- 이노페이 필수 -->
        <input type="hidden" name="PayMethod" value="CARD">
        <input type="hidden" name="GoodsCnt" value="1">
        <input type="hidden" name="GoodsName" id="GoodsName" value="BUNKER">
        <input type="hidden" name="Amt" id="Amt" value="<?=$price?>">
        <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
        <input type="hidden" name="MID" value="<?=$MID?>"> <!-- 테스트 : testpay01m -->
        <input type="hidden" name="MerchantKey" value="<?=$MerchantKey?>"> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
        <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/charge_result.php">
        <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/charge_result.php">
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
        $(function() {
           selectPrice('<?=$price?>');
        });

        // 충전금액 선택
        function selectPrice(price, mode) {
            price = price.replace(/,/gi, ''); // 콤마 제거
            $('.carge_list li').removeClass('on'); // 전체 class 제거
            $('#p'+price).addClass('on'); // 입력 or 선택한 금액 class 추가
            $('#charge_price').val(number_format(price)); // 콤마 추가
            // if(mode != 'input') { // 직접입력 아니고 선택 시
            //     $('#charge_value').val(number_format(price)); // 콤마 추가
            // }

            var bunker = 0;
            var bonus = 0;
            if(price == 3300) {
                bunker = 200;
            } else if(price == 9900) {
                bunker = 600;
                bonus = 40;
            } else if(price == 33000) {
                bunker = 2000;
                bonus = 150;
            } else if(price == 99000) {
                bunker = 6000;
                bonus = 500;
            } else if(price == 198000) {
                bunker = 12000;
                bonus = 1200;
            } else if(price == 495000) {
                bunker = 30000;
                bonus = 3300;
            }

            // 충전 후 벙커
            var my_bunker = '<?=$member['mb_bunker'] + $member['mb_bunker_bonus']?>'; // 내 현재 벙커 (보너스 벙커 포함)
            var after_bunker = (bunker*1 + bonus*1) + my_bunker*1;
            $('#bunker').text(number_format(after_bunker.toString()));
            $('#charge_bunker').val(bunker);
            $('#charge_bonus').val(bonus);
        }

        // 충전금액 초기화
        function delPrice() {
            $('.carge_list li').removeClass('on');
            // $('#charge_value').val('');
            $('#bunker').text('');
        }

        // 충전하기
        function charge() {
            if($('#charge_price').val() == 0 || $('#charge_price').val().length == 0) {
                swal('충전금액을 입력해 주세요.');
                return false;
            }
            $('#Amt').val($('#charge_price').val().replace(/,/gi, ''));

            goPay(document.payfrm);
        }
    </script>

<?
include_once('./_tail.php');