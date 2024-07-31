
<div class="box onOffBox"><!--판매사이트 및 판매상태-->
    <h4><span class="color-blue">(필수)</span> 판매사이트 및 판매상태</h4>
    <div class="wrap box__site-group">
        <!-- 지마켓 -->
        <?
        $is_sell_display_gmkt = "";
        $is_sell_display_iac = "";

        $useGmarket = true;
        if($w == 'u' && empty($goods_data['gmkt_no'])){
            $useGmarket = false;
        }

        $useAuction = true;
        if($w == 'u' && empty($goods_data['iac_no'])){
            $useAuction = false;
        }

        $isSell_gmkt = true;
        if($goods_data['isSell_gmkt'] != 'T'){
            $isSell_gmkt = false;
        }

        $isSell_iac = true;
        if($goods_data['isSell_iac'] != 'T'){
            $isSell_iac = false;
        }

        if($w == ""){
            $is_sell_display_gmkt = "none";
            $is_sell_display_iac = "none";

            $isSell_gmkt = true;
            $isSell_iac = true;
        }

        ?>
        <div class="box__bundle">
            <div class="box__filter-group">
                <div class="form form--gmarket">
                    <div class="input_checkbox form__inner form">
                        <input type="checkbox" class="form__checkbox" id="useGmarket" name="useGmarket" value="useGmarket" <?=get_checked($useGmarket, true)?>>
                        <label for="useGmarket" class="form__label">
                            <i class="fa-duotone fa-square-check txt-lg"></i><span class="for-a11y">Gmarket</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box__filter-group" id="div_gmarket" style="display: <?=$is_sell_display_gmkt?>">
                <div class="input_radio form">
                    <input class="form__radio" id="isSellGmkt1" type="radio" value="T" name="isSellGmkt" <?=get_checked($isSell_gmkt,true)?>>
                    <label for="isSellGmkt1" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매가능</label>
                </div>
                <div class="input_radio form">
                    <input class="form__radio" id="isSellGmkt2" type="radio" value="F" name="isSellGmkt" <?=get_checked($isSell_gmkt,false)?>>
                    <label for="isSellGmkt2" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매중지</label>
                </div>
            </div>
        </div>

        <!-- 옥션 -->
        <div class="box__bundle">
            <div class="box__filter-group">
                <div class="form form--auction">
                    <div class="input_checkbox form__inner form">
                        <input type="checkbox"  class="form__checkbox" id="useAuction" name="useAuction" value="useAuction" <?=get_checked($useAuction, true)?>>
                        <label for="useAuction" class="form__label">
                            <i class="fa-duotone fa-square-check txt-lg"></i><span class="for-a11y">Auction</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="box__filter-group" id="div_auction" style="display: <?=$is_sell_display_iac?>">
           <!--               프로그램 확인필요-->
                <div class="input_radio form">
                    <input class="form__radio" id="isSellIac1" type="radio" value="T" name="isSellIac" <?=get_checked($isSell_iac,true)?>>
                    <label for="isSellIac1" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매가능</label>
                </div>
                <div class="input_radio form">
                    <input class="form__radio" id="isSellIac2" type="radio" value="F" name="isSellIac" <?=get_checked($isSell_iac,false)?>>
                    <label for="isSellIac2" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매중지</label>
                </div>
            </div>
        </div>
    </div>
</div>
<!--판매사이트 및 판매상태-->

<div class="box titleBox"><!--상품명-->
    <h4><span class="color-blue">(필수)</span> 상품명</h4>

    <div class="">
        <p><span class="color-blue">(필수)</span> 상품명</p>
        <!-- 테스트값 제거 -->
        <input type="text" id="goodsName_kor" name="goodsName_kor" placeholder="최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다. (상품명 포함)" class="border_gray" value="<?=$goods_data['goodsName_kor']?>">
        <p class="text-guide">※ 적합한 상품명을 입력하면 검색 결과 노출에 도움이 될 수 있습니다. 일부 카테고리를 제외하고 언제든 상품명 수정이 가능합니다.</p>
    </div>

    <div class="">
        <p>프로모션 문구</p>
        <!-- 테스트값 제거 -->
        <input type="text" id="goodsName_promotion" name="goodsName_promotion" placeholder="최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다. (상품명 포함)" class="border_gray" value="<?=$goods_data['promotion']?>">
        <p class="text-guide">※ 1+1행사 중, 사은품 증정 등 판매 촉진을 위한 문구를 입력해보세요.</p>
    </div>

    <div class="">
        <p>판매자 관리코드</p>
        <input type="hidden" id="managedCode" name="managedCode" placeholder="판매자 관리코드를 입력하세요." class="border_gray" readonly value="">
        <p class="text-guide">판매자 관리코드는 내부정책에 따라 자동으로 관리가 됩니다.</p>
    </div>
</div>
<!--상품명-->

<!-- 등록 카테고리-->
<input type="hidden" id="ac_cate" name="ac_cate" value="<?=$goods_data['catCode_iac']?>">
<input type="hidden" id="gm_cate" name="gm_cate" value="<?=$goods_data['catCode_gmkt']?>">
<input type="hidden" id="esm_cate" name="esm_cate" value="<?=$goods_data['catCode_esm']?>">
<input type="hidden" id="cate_name" name="cate_name" value="<?=$goods_data['cate_name']?>">
<? if(empty($w)){?>
        <div class="box cateBox">
            <h4><span class="color-blue">(필수)</span> 카테고리</h4>
            <div class="flex justi-sb">
                <p>카테고리 선택</p>
            </div>
            <div class="box__filter-group">
                <div class="box__category-wrapper">
                    <div class="box__category-wrap">
                        <div class="box__category">
                            <div class="box__category-inner"><span class="text__category">대분류</span>
                                <ul class="list__category" role="listbox" id="cate1">
                                    <li class="list-item is-selected" role="presentation" data-cate_no="<?=GMAC_CAR_CATE?>">
                                        <button class="button__category" type="button" onclick="getCategory('cate1','<?=GMAC_CAR_CATE?>','RK자동차용품', false)">자동차용품</button><button type="button" class="button__category--more"><i class="fa-light fa-chevron-right"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box__category">
                            <div class="box__category-inner"><span class="text__category">중분류</span>
                                <ul class="list__category" role="listbox" id="cate2">

                                </ul>
                            </div>
                        </div>
                        <div class="box__category">
                            <div class="box__category-inner"><span class="text__category">소분류</span>
                                <ul class="list__category" role="listbox" id="cate3">

                                </ul>
                            </div>
                        </div>
                        <div class="box__category">
                            <div class="box__category-inner"><span class="text__category">세분류</span>
                                <ul class="list__category" role="listbox" id="cate4">

                                </ul>
                            </div>
                        </div>
                        <div class="box__category">
                            <div class="box__category-inner"><span class="text__category">상세분류</span>
                                <ul class="list__category" role="listbox" id="cate5">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>상품 등록 후 카테고리 수정이 불가합니다.
            </p>
        </div>
        <!-- 등록 카테고리-->
    <?} else {?>
    <!-- 수정 카테고리-->
    <div class="box cateBox">
        선택한 카테고리 : <?=$goods_data['cate_name']?> <br>

        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>상품 등록 후 카테고리 수정이 불가합니다.
        </p>
    </div>
    <!-- 수정 카테고리-->
    <?}?>

<!--카탈로그-->
<!--<div class="box titleBox">
    <h4>카탈로그</h4>

    <p>카탈로그</p>
    <div class="flex">
        <div class="input_select">

            <select class="border_gray w100px">
                <option value="제품명">제품명</option>
                <option value="브랜드">브랜드</option>
                <option value="제조사">제조사</option>
                <option value="바코드">바코드</option>
                <option value="모델명">모델명</option>
            </select>
        </div>
        <input type="text" id="" name="" placeholder="최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다. (상품명 포함)" class="border_gray" value="">
    </div>
</div>-->
<!--카탈로그-->

<div class="box priceBox"><!--판매가-->
    <h4>
        <span class="color-blue">(필수)</span> 판매가
    </h4>
    <div class="input_form">

        <div class="">
            <p><span class="color-blue">(필수)</span> 쇼핑몰 노출 판매가</p>
            <div class="input_unit">
                <!-- 테스트값 삭제 -->
                <input type="text" id="price" name="price" placeholder="입력해주세요." class="border_gray" value="<?=number_format($goods_data['price'])?>">원
            </div>
            <p class="text-guide">
                <!--<span id="span_charge">판매이용료 0% : 0원</span><br>
                <span>*정확한 판매이용료는 해당 쇼핑몰에서 확인해주세요.</span>-->
            </p>
        </div>
    </div><!--판매가-->

    <?
        $sellerDiscount = json_decode($goods_data['sellerDiscount'], true);
        $sellerDiscountMarket = $sellerDiscount['gmkt'];
        if(empty($sellerDiscountMarket)){
            $sellerDiscountMarket = $sellerDiscount['iac'];
        }
        $emdDate = substr($sellerDiscountMarket['endDate'], 0, 4);
        $sellerDiscountChecked = ($emdDate !== "9999") ? "checked" : "";

        $sellerDiscountStartDate = substr($sellerDiscountMarket['startDate'], 0, 10);
        $sellerDiscountEndDate = substr($sellerDiscountMarket['endDate'], 0, 10);

        $sellerDiscountPrice = 0;

        if($sellerDiscountMarket['type'] == 1){
            $sellerDiscountPrice = $sellerDiscountMarket['priceOrRate1'];
            $sellerDiscountAfterPrice = $goods_data['price'] - $sellerDiscountMarket['priceOrRate1'];
        } else if($sellerDiscountMarket['type'] == 2){
            $sellerDiscountPrice = $goods_data['price'] * ($sellerDiscountMarket['priceOrRate1']/100);
            $sellerDiscountAfterPrice = $goods_data['price'] - ($goods_data['price'] * ($sellerDiscountMarket['priceOrRate1']/100));
        }


    ?>

    <div class="">
        <div class="">
            <p>할인</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_discount01" name="sellerDiscount" value="T" <?=get_checked($sellerDiscount['isUse'],true)?>>
                    <label for="radi_discount01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="radi_discount02" name="sellerDiscount" value="F" <?=get_checked($sellerDiscount['isUse'],'')?> <?=get_checked($sellerDiscount['isUse'],false)?>>
                    <label for="radi_discount02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div><!--할인-->

        <br>

        <div class="secondBox" id="div_sellerDiscount" style="display: <?=get_displayed($sellerDiscount['isUse'],true)?>">
            <p>할인설정</p>
            <div class="input_unit2">
                <input type="text" id="discountprice" name="discountprice" placeholder="숫자만 입력해주세요." class="border_gray" value="<?=$sellerDiscountMarket['priceOrRate1']?>">
                <div class="input_select">

                    <select class="border_gray" id="sellerDiscountType" name="sellerDiscountType">
                        <option value="2" <?=get_selected($sellerDiscountMarket['type'], 2)?>>%</option>
                        <option value="1" <?=get_selected($sellerDiscountMarket['type'], 1)?>>원</option>
                    </select>
                </div>
            </div>
            <p class="flex gap5 text-guide"><i class="fa-duotone fa-circle-exclamation"></i>100원이상 10원단위로 입력, 판매가 대비 70%까지 입력해주세요.</p>
            <!--할인설정-->

            <div class="flex gap20">
                <div class="input_checkbox">
                    <input type="checkbox" id="sellerDiscountDday" name="sellerDiscountDday" value="T" <?=$sellerDiscountChecked?>>
                    <label for="sellerDiscountDday">
                        <i class="fa-duotone fa-square-check"></i> 특정기간 할인
                    </label>
                    <div class="input_date" id="div_sellerDiscountDday">
                        <div class="input_select">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray" id="startDate" name="startDate" value="<?=$sellerDiscountStartDate?>">
                        </div>
                        ~
                        <div class="input_select">
                            <!--i class="fa-duotone fa-calendar"></i-->
                            <input type="date" class="border_gray" id="endDate" name="endDate" value="<?=$sellerDiscountEndDate?>">
                        </div>
                    </div>
                </div>
            </div><!--특정기간 할인-->

            <p class="flex gap5 input_discount_price">
                <span class="color-blue">최종 판매가</span>
                <strong class="color-blue" id="finalPrice"><?=number_format($sellerDiscountAfterPrice)?>원</strong>
                <span id="discountAmount">(<?=number_format($sellerDiscountPrice)?>원 할인)</span>
            </p><!--최종 판매가-->
        </div>

    </div>

    <?
        empty($goods_data['sellingPeriod']) || $goods_data['sellingPeriod'] == "-1" ? $useSellingPeriod = false : $useSellingPeriod = true;
    ?>

    <div class="">
        <div>
            <p>판매기간</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_period01" name="sellingPeriod" value="T" <?=get_checked($useSellingPeriod, true)?>>
                    <label for="radi_period01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>

                </div>


                <div class="input_radio">
                    <input type="radio" id="radi_period02" name="sellingPeriod"  <?=get_checked($useSellingPeriod, false)?> value="F">
                    <label for="radi_period02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div><!--판매기간-->

       <br>
       
        <div class="secondBox" id="div_sellingPeriod" style="display: <?=get_displayed($useSellingPeriod,true)?>">
            <p class="">
                기간설정
            </p>

            <div class="input_period">
                <div class="radi_period_set_wrap">
                    <input type="radio" id="radi_period_set15" name="periodValue" value="15">
                    <label for="radi_period_set15">15일</label>

                    <input type="radio" id="radi_period_set30" name="periodValue" value="30">
                    <label for="radi_period_set30">30일</label>

                    <input type="radio" id="radi_period_set60" name="periodValue" value="60">
                    <label for="radi_period_set60">60일</label>

                    <input type="radio" id="radi_period_set90" name="periodValue" value="90">
                    <label for="radi_period_set90">90일</label>

                    <input type="radio" id="radi_period_set120" name="periodValue" value="120">
                    <label for="radi_period_set120">120일</label>
                </div>
                <div class="flex gap5">
                    <p style="white-space: nowrap">판매 종료일</p>
                    <input type="date" id="endSellDate" name="endSellDate" value="<?=$goods_data['endSellDate']?>" class="border_gray wfit">
                </div>
            </div>
        </div><!--기간설정-->
    </div>


    <div class="input_form">
        <div class="">
            <p>부과세</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="isVatFree1" name="isVatFree" value="F" <?=get_checked($goods_data['isVatFree'], 'F')?>>
                    <label for="isVatFree1">
                        <i class="fa-duotone fa-circle-check"></i>과세상품
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="isVatFree2" name="isVatFree" value="T" <?=get_checked($goods_data['isVatFree'], 'T')?>>
                    <label for="isVatFree2">
                        <i class="fa-duotone fa-circle-check"></i>면세상품
                    </label>
                </div>
            </div>
        </div>

    </div><!--부과세-->
</div>
<!-- 판매가 -->

<?php echo view('goods/js/goods_js_1', $this->data); ?>