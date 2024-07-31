<!-- 상품 추가 정보 -->
<!--<div class="box addInfoBox">

    <h4>
        상품 추가 정보
    </h4>
    <div class="input_form">
        <p>원산지 구분</p>
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="radi_refund_01" name="radi_refund">
                <label for="radi_refund_01">
                    <i class="fa-duotone fa-circle-check"></i>상품 상세설명 참조
                </label>
            </div>
            <div class="input_radio">
                <input type="radio" id="radi_refund_02" name="radi_refund" checked>
                <label for="radi_refund_02">
                    <i class="fa-duotone fa-circle-check"></i>원산지 의무표시 대상아님
                </label>
            </div>
        </div>
    </div>
    <div class="input_form">
        <p>제조일자</p>
        <input type="date" class="w50 border_gray">
        <p>소비기한</p>
        <input type="date" class="w50 border_gray">
    </div>
</div>-->
<!-- 상품 추가 정보 -->

<div class="box channelBox">
    <h4>
        <span class="color-blue">(필수)</span> 노출 채널
    </h4>

    <?
    $pcs = json_decode($goods_data['pcs'], true);
    ?>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 포털 가격비교 사이트 상품등록</p>

        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="use_comparison1" name="use_comparison" <?=get_checked($pcs['isUse'], true)?> value="T">
                <label for="use_comparison1">
                    <i class="fa-duotone fa-circle-check"></i>등록함
                </label>
            </div>


            <div class="input_radio">
                <input type="radio" id="use_comparison2" name="use_comparison" <?=get_checked($pcs['isUse'], false)?> value="F">
                <label for="use_comparison2">
                    <i class="fa-duotone fa-circle-check"></i>등록안함
                </label>
            </div>
        </div>

        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>등록함으로 설정한 경우, 포털 가격비교 사이트를 통한 주문 발생 시 판매가의 2%가 서비스 이용료로 부과됩니다.
        </p>
    </div><!--노출 채널-->

    <div class="wrap secondBox" id="div_use_coupon" style="display: <?=get_displayed($pcs['isUse'], true)?>">
        <div class="input_form">
            <p><span class="color-blue">(필수)</span> 쿠폰적용</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="use_coupon1" name="use_coupon" <?=get_checked($pcs['isUseIacPcsCoupon'], true)?> value="T">
                    <label for="use_coupon1">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="use_coupon2" name="use_coupon" <?=get_checked($pcs['isUseIacPcsCoupon'], false)?> value="F">
                    <label for="use_coupon2">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>
    </div><!--쿠폰적용-->
<!--    <div class="wrap">
        <div class="input_form">
            <p><span class="color-blue">(필수)</span> G마켓 부담 할인</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="b2pDiscount1" name="b2pDiscount">
                    <label for="b2pDiscount1">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="b2pDiscount2" name="b2pDiscount">
                    <label for="b2pDiscount2">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>
    </div>--><!--b2p 행사 할인-->

    <?
        $siteDiscount = json_decode($goods_data['siteDiscount'], true);
    ?>

    <div class="wrap">
        <div class="input_form">
            <p><span class="color-blue">(필수)</span> 사이트 부담 할인</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="siteDiscount1" name="siteDiscount" <?=get_checked($siteDiscount['gmkt'], true)?> value="T">
                    <label for="siteDiscount1">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="siteDiscount2" name="siteDiscount" <?=get_checked($siteDiscount['gmkt'], false)?> value="F">
                    <label for="siteDiscount2">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>
    </div><!--사이트 부담 할인-->
</div>
<!-- 채널 / 쿠폰 / 할인  -->

<? /*
<? if($w == "u") { ?>
<!--    <div class="box donateBox">
        <h4>
            <span class="color-blue">(필수)</span> 후원/나눔쇼핑
        </h4>
        <div class="input_form">
            <p><span class="color-blue">(필수)</span> G마켓 후원쇼핑</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_huwon_01" name="radi_huwon">
                    <label for="radi_huwon_01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="radi_huwon_02" name="radi_huwon" checked>
                    <label for="radi_huwon_02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>

            </div>
        </div>
        <div class="input_form secondBox">
            <p><span class="color-blue">(필수)</span> 후원분야</p>

            <div class="input_select">

                <select class="border_gray">
                    <option value="후원분야">후원분야</option>
                    <option value="아동복지">아동복지</option>
                    <option value="여성권익">여성권익</option>
                    <option value="환경보호">환경보호</option>
                    <option value="국제구호">국제구호</option>
                    <option value="소비자권익">소비자권익</option>
                    <option value="기타">기타</option>
                </select>
            </div>

            <p><span class="color-blue">(필수)</span> 후원기간</p>

            <div class="flex gap10">
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray">
                </div>
                ~
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray">
                </div>
            </div>

            <p><span class="color-blue">(필수)</span> 후원금액</p>

            <div class="input_unit">
                <input type="text" class="border_gray" value="0">원
            </div>

            <p><span class="color-blue">(필수)</span> 누적 적립한도액</p>

            <div class="input_unit">
                <input type="text" class="border_gray" value="0">원
            </div>
        </div><!--후원-->

        <div class="input_form">
            <p><span class="color-blue">(필수)</span> 옥션 나눔쇼핑</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_nanum_01" name="radi_nanum">
                    <label for="radi_nanum_01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="radi_nanum_02" name="radi_nanum" checked>
                    <label for="radi_nanum_02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>

            </div>
        </div>
        <div class="input_form secondBox">
            <p><span class="color-blue">(필수)</span> 나눔기간</p>

            <div class="flex gap10">
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray">
                </div>
                ~
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray">
                </div>
            </div>

            <p><span class="color-blue">(필수)</span> 나눔금액</p>

            <div class="input_unit">
                <input type="text" class="border_gray" value="0">원
            </div>

        </div><!--나눔-->
    </div>
    <!--후원/나눔쇼핑-->-->
<?}?>
 */?>


<?php echo view('goods/js/goods_js_5', $this->data); ?>