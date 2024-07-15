<?
include_once('./_common.php');

$g5['title'] = '벙커링스테이션';
include_once('./_head.php');

loginCheck($member['mb_id'], $member['mb_category']);

// 이노페이 결제 moid
$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$member['mb_no'];
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>
	#container{padding:0 0 140px;}
</style>

<!-- 마케팅 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="podoCS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">마케팅 상품</h4>
                </div>
                <div class="modal-body">
					<div class="txt">
						<h3>"마케팅 상품 준비중입니다" </h3>
						<span>배너광고는 포도씨 관리자에게 문의바랍니다.</span>
						<a href="mailto:support@podosea.com">support@podosea.com</a>
					</div>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 마케팅 모달팝업 -->

<!-- pay Modal -->
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="charge_bunker" name="charge_bunker">
                <input type="hidden" value="" id="charge_bonus" name="charge_bonus">
                <input type="hidden" value="" id="charge_price" name="charge_price">
                <div id="box_charge">
                    <h3>충전금액을 선택해 주세요.</h3>
                    <!--<div class="box_cont">-->
                    <div>
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
        </div>
    </div>
</div>

<div id="area_bunker">
	<div id="sub_bn">
		<div class="txt">
			<h2>벙커링 스테이션</h2>
			<span>벙커가 부족할 때, 포도씨 벙커링 스테이션에서 충전하세요!</span>
            <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php">지금충전하기</a>-->
            <a onclick="payModalOpen('')">지금충전하기</a>
		</div>
		<!--<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_coin.png"></div>-->
	</div>
	<div class="bunker_info">
		<div class="inr v3">
			<div class="box">
				<h3>벙커</h3>
				<div class="area_table">
					<table class="table v1">
						<colgroup>
							<col style="width:50%">
							<col style="width:50%">
						</colgroup>
						<thead>
							<tr>
								<th>벙커</th>
								<th>결제금액</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span>3,000</span></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=3300">3,300원</a>-->
                                    <a onclick="payModalOpen('3300')">3,300원</a>
                                </td>
							</tr>
							<tr>
								<td><span>9,000</span><em>+500</em></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=9900">9,900원</a>-->
                                    <a onclick="payModalOpen('9900')">9,900원</a>
                                </td>
							</tr>
							<tr>
								<td><span>30,000</span><em>+1,800</em></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=33000">33,000원</a>-->
                                    <a onclick="payModalOpen('33000')">33,000원</a>
                                </td>
							</tr>
							<tr>
								<td><span>90,000</span><em>+6,000</em></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=99000">99,000원</a>-->
                                    <a onclick="payModalOpen('99000')">99,000원</a>
                                </td>
							</tr>
							<tr>
								<td><span>180,000</span><em>+12,500</em></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=198000">198,000원</a>-->
                                    <a onclick="payModalOpen('198000')">198,000원</a>
                                </td>
							</tr>
							<tr>
								<td><span>450,000</span><em>+35,000</em></td>
								<td>
                                    <!--<a href="<?php /*=G5_BBS_URL*/?>/charge.php?p=495000">495,000원</a>-->
                                    <a onclick="payModalOpen('495000')">495,000원</a>
                                </td>
							</tr>
						</tbody>
					</table>
				</div>
				<ul class="info">
					<li>※모든 상품은 부가세(VAT)포함 금액입니다.</li>
					<li>※벙커를 구매하시면 상품에 따라 일정량의 보너스벙커가 지급되며, 추가 지급되는 무료벙커의 수량은 변경될 수 있습니다.</li>
                    <li>※서비스 이용 시 보너스 벙커를 우선하여 차감하며, 보너스 벙커는 선물/환전 대상이 아닙니다.</li>
                    <li>※유료로 구매하신 충전 벙커는 유효기간이 없으며, 보너스 벙커의 유효기간은 최종 접속일로부터 90일 입니다.</li>
					<li>※사용하지 않은 벙커는 구매 후 7일 이내에 구매취소 및 환불 가능하며, 환불시 보너스 벙커는 자동으로 차감됩니다.</li>
					<li>※45만벙커를 초과하여 구매를 원하시는 경우, 포도씨 관리자에게 직접 문의 부탁드립니다.</li>
				</ul>
			</div>
			<div class="box">
				<h3>기업회원 업그레이드</h3>
				<div id="area_premium">
					<a href="<?=G5_BBS_URL?>/premium.php" >
						<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_premium.png"></div>
						<div class="txt">
							<h2><span class="bold">프리미엄 회원</span>으로 <span class="bold last">업그레이드</span></h2>
							<em>프리미엄 기업회원으로 업그레이드하고 다양한 혜택을 체험하세요!</em>
						</div>
					</a>
				</div>
			</div>
			<div class="box">
				<h3>광고문의</h3>
				<div id="area_premium" class="ad" >
					<a href="" data-toggle="modal" data-target="#podoCS">
						<div class="obj"><img src="<?php echo G5_IMG_URL ?>/obj_ad.png"></div>
						<div class="txt">
							<h2>지금까지 없었던 <br><span class="bold last">해양시장 특화 광고 마케팅</span></span></h2>
							<em>포도씨와 함께 노출이 아닌 매출을 위한 마케팅을 시작해 보세요</em>
						</div>
					</a>
				</div>
			</div>
			<!--
			<div class="box last">
				<h3>등급별 혜택</h3>
				<div class="area_table grade">
					<div class="scrollTable">
					<table class="table v1">
						<colgroup>
							<col style="width:30%">
							<col style="width:10%">
							<col style="width:10%">
							<col style="width:50%">
						</colgroup>
						<thead>
							<tr>
								<th>혜택</th>
								<th>Basic</th>
								<th>Premium</th>
								<th>비고</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>기본 기업 홈페이지</td>
								<td>O</td>
								<td>O</td>
								<td><p>기업회원 프로필 바탕으로 자동 작성됩니다.</p></td>
							</tr>
							<tr>
								<td>고급 기업 홈페이지</td>
								<td>X</td>
								<td>O</td>
								<td>
									<ul>
										<li>카다로그 표시</li>
										<li>기업 홍보영상 표시</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>기업 검색시 상위노출</td>
								<td>X</td>
								<td>O</td>
								<td><p>동일조건에서 Premium 회원이 상위노출됩니다.</p></td>
							</tr>
							<tr>
								<td>검색키워드 개수</td>
								<td>5개</td>
								<td>10개</td>
								<td></td>
							</tr>
							<tr>
								<td>기업의뢰에 대한 견적 회신</td>
								<td>과금</td>
								<td>무료</td>
								<td><p>Basic 회원은 기업 의뢰시 견적금액별 벙커가 소모됩니다.</p></td>
							</tr>
							<tr>
								<td>매물올리기, 채용공고</td>
								<td>과금</td>
								<td>무료</td>
								<td><p>Basic 회원은 매물올리기와 채용공고 등록시 건당 500벙커가 소모됩니다.</p></td>
							</tr>
						</tbody>
					</table>
				</div>
				</div>
			</div>
			-->
		</div>
	</div>
</div>

<script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/innopay-2.0.js" charset="utf-8"></script><!-- InnoPay 결제연동 스크립트(필수) -->
<form id="payfrm" name="payfrm" method="post">
    <!-- 이노페이 필수 -->
    <input type="hidden" name="PayMethod" value="CARD">
    <input type="hidden" name="MID" value="<?=$MID?>"> <!-- 테스트 : testpay01m -->
    <input type="hidden" name="MerchantKey" value="<?=$MerchantKey?>"> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
    <input type="hidden" name="GoodsName" id="GoodsName" value="BUNKER">
    <input type="hidden" name="Amt" id="Amt" value="<?=$price?>">
    <input type="hidden" name="BuyerName" value="<?=$member['mb_name']?>">
    <input type="hidden" name="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
    <input type="hidden" name="BuyerEmail" value="<?=!empty($member['mb_email']) ? $member['mb_email'] : 'test@test.com'?>">
    <input type="hidden" name="ResultYN" value="N">
    <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
    <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/charge_result.php">
    <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
</form>

<script>
    // 충전금액 선택 모달
    function payModalOpen(price) {
        selectPrice(price);
        $("#payModal").modal("show");
    }

    // 충전금액 선택
    function selectPrice(price) {
        price = price.replace(/,/gi, ''); // 콤마 제거
        $('.carge_list li').removeClass('on'); // 전체 class 제거
        $('#p'+price).addClass('on'); // 입력 or 선택한 금액 class 추가
        $('#charge_price').val(number_format(price)); // 콤마 추가

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

    // 충전하기
    function charge() {
        if($('#charge_price').val() == 0 || $('#charge_price').val().length == 0) {
            swal('충전금액을 선택해 주세요.');
            return false;
        }
        $('#Amt').val($('#charge_price').val().replace(/,/gi, ''));

        // 결제요청 함수
        var frm = document.payfrm;
        innopay.goPay({
            //// 필수 파라미터
            PayMethod: frm.PayMethod.value,     // 결제수단 (CARD,BANK,VBANK,CARS,CSMS,DSMS,EPAY,EBANK)
            MID: frm.MID.value,                 // 가맹점 MID
            MerchantKey:frm.MerchantKey.value,	// 가맹점 라이센스키
            GoodsName:frm.GoodsName.value,		// 상품명
            Amt:frm.Amt.value,					// 결제금액(과세)
            BuyerName:frm.BuyerName.value,		// 고객명
            BuyerTel:frm.BuyerTel.value,		// 고객전화번호
            BuyerEmail:frm.BuyerEmail.value,	// 고객이메일
            ResultYN:frm.ResultYN.value,		// 결제결과창 출력유뮤
            Moid:frm.Moid.value,		        // 가맹점에서 생성한 주문번호 셋팅
            //// 선택 파라미터
            ReturnURL:frm.ReturnURL.value,		// 결제결과 전송 URL(없는 경우 아래 innopay_result 함수에 결제결과가 전송됨)
            mallUserID : frm.mallUserID.value,	// 가맹점 고객ID
            EncodingType : 'utf-8',				// 가맹점 서버 인코딩 타입 (utf-8, euc-kr)
        });
    }
</script>

<?
include_once('./_tail.php');
?>

