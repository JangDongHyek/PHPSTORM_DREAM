
<div class="box deliBox"><!--배송-->
    <h4>
        <span class="color-blue">(필수)</span> 배송
    </h4>

    <?
        $shippingArr = json_decode($goods_data['shipping'], true);
        $shippingType = "1";
        if(!empty($shippingArr)){
            $shippingType = $shippingArr['type'];
        }
    ?>

    <div class="wrap">
        <div class="input_form">
            <p>배송방법</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="shippingType1" name="shippingType" value="1" <?=get_checked($shippingType, "1")?>>
                    <label for="shippingType1">
                        <i class="fa-duotone fa-circle-check"></i>택배,소포,등기
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="shippingType2" name="shippingType" value="2" <?=get_checked($shippingType, "2")?>>
                    <label for="shippingType2">
                        <i class="fa-duotone fa-circle-check"></i>직접배송
                    </label>
                </div>
            </div>
        </div>
        <!--상품상태-->
<!--        <div class="input_form">
            <p>배송 템플릿</p>
            <div class="flex gap5">
                <button class="btn btn-blue">템플릿 선택</button>
                <div class="input_checkbox">
                    <input type="checkbox" id="input_all">
                    <label for="input_all"><i class="fa-duotone fa-square-check"></i>템플릿 추가</label>
                </div>
            </div>
        </div>-->
        <!--템플릿-->
    </div>

    <div class="input_form secondBox" id="div_shippingType" style="display: <?=get_displayed($shippingType,'1')?>">
        <p><span class="color-blue">(필수)</span> 택배사</p>
        <div class="input_select">

            <select class="border_gray" id="companyNo" name="companyNo">
                <option value="">선택</option>
                <?
                    foreach ($delivery_company_list as $index => $data){ ?>
                        <option value="<?=$data['code']?>" <?=get_selected($shippingArr['companyNo'],$data['code'])?>><?=$data['name']?></option>
                    <?}
                ?>
            </select>
        </div>
    </div><!--택배사-->

    <?
        $quickServiceArr = $shippingArr['quickService'];
        $useQuickService = false;
        if(!empty($quickServiceArr)){
            $useQuickService = true;
        }
        $visitAndTakeArr = $shippingArr['visitAndTake'];
        $useVisitAndTake = false;
        if(!empty($visitAndTakeArr)){
            $useVisitAndTake = true;
        }
    ?>
    <div class="wrap">
        <div class="input_form">
            <p>추가 배송방법</p>
            <div class="flex gap20">
                <div class="input_checkbox">
                    <input type="checkbox" id="quickService" name="quickService" value="T" <?=get_checked($useQuickService, true)?>>
                    <label for="quickService">
                        <i class="fa-duotone fa-circle-check"></i>퀵서비스
                    </label>
                </div>
                <div class="input_checkbox">
                    <input type="checkbox" id="visitAndTake" name="visitAndTake" value="T" <?=get_checked($useVisitAndTake, true)?>>
                    <label for="visitAndTake">
                        <i class="fa-duotone fa-circle-check"></i>방문수령
                    </label>
                </div>
            </div>
        </div>
        <!--추가 배송방법-->
    </div>

    <div class="secondBox" id="deliQuickBox" style="display: <?=get_displayed($useQuickService,true)?>"> <!--퀵서비스 선택시-->
        <div class="input_form ">
            <p>퀵서비스 가능지역</p>
            <div class="flex gap20 flexwrap">
                <?
                    $quickRegions = $quickServiceJiyuck['quickRegions'];
                    $quickGyeonggi = $quickServiceJiyuck['quickGyeonggi'];

                    $shippingEnableRegionCodeArr = explode(",",$quickServiceArr['shippingEnableRegionCode']);

                    $useQuickGyeonggi = false;
                    foreach ($shippingEnableRegionCodeArr as $index => $code){
                        if (substr($code, 0, 2) === "02") {
                            $useQuickGyeonggi = true;
                        }
                    }

                    foreach ($quickRegions as $code => $name) { ?>
                        <div class="input_checkbox">
                            <input type="checkbox" id="quick_<?=$code?>" name="quickList[]" value="<?=$code?>" <?=get_checked(in_array($code,$shippingEnableRegionCodeArr),true)?>>
                            <label for="quick_<?=$code?>">
                                <i class="fa-duotone fa-circle-check"></i><?=$name?>
                            </label>
                        </div>
                    <?}?>

                <div class="input_checkbox" id="div_gyeonggiList" style="display: <?=get_displayed($useQuickGyeonggi,true)?>">
                        <?
                        foreach ($quickGyeonggi as $code => $name) { ?>

                            <input type="checkbox" id="gyeonggiList_<?=$code?>" name="gyeonggiList[]" value="<?=$code?>" <?=get_checked(in_array($code,$shippingEnableRegionCodeArr),true)?>>
                            <label for="gyeonggiList_<?=$code?>">
                                <i class="fa-duotone fa-circle-check"></i><?=$name?>
                            </label>

                        <?}
                        ?>
                    </div>
            </div>
        </div><!--퀵서비스 가능지역-->
        <br>
        <div class="input_form ">
            <p>퀵서비스 업체명</p>
            <div class="input_unit">
                <input type="text" class="border_gray w50" placeholder="업체명을 입력해주세요" id="quickCompanyName" name="quickCompanyName" value="<?=$quickServiceArr['companyName']?>">
            </div>
        </div><!--퀵서비스 업체명-->
        <div class="input_form ">
            <p>퀵서비스 연락처</p>
            <div class="input_unit">
                <input type="text" class="border_gray w50" placeholder="'-'를 제외한 숫자만 입력해주세요" id="quickCompanyHp" name="quickCompanyHp" value="<?=$quickServiceArr['phoneNo']?>">
            </div>
        </div><!--퀵서비스 연락처-->
    </div>
    <div class="secondBox" id="deliPickBox" <?=get_displayed($useVisitAndTake,true)?>"> <!--방문수령 선택시-->
        <div class="input_form ">
            <p>방문 혜택</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="noBenefit" name="visitAndTakeType" value="1" <?=get_checked($visitAndTakeArr['type'],"1")?>>
                    <label for="noBenefit">
                        <i class="fa-duotone fa-circle-check"></i>구매자 혜택없음
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="priceDiscount" name="visitAndTakeType" value="2" <?=get_checked($visitAndTakeArr['type'],"2")?>>
                    <label for="priceDiscount">
                        <i class="fa-duotone fa-circle-check"></i>가격할인(금액환불)
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="gift" name="visitAndTakeType" value="3" <?=get_checked($visitAndTakeArr['type'],"3")?>>
                    <label for="gift">
                        <i class="fa-duotone fa-circle-check"></i>사은품
                    </label>
                </div>
            </div>
        </div><!--방문 혜택-->
        <br>
        <div class="input_form" id="priceDiscountBox"  style="display: none"><!--가격할인시-->
            <div class="input_unit">
                <input type="text" class="border_gray w50"  id="visitAndTakeDiscount" name="visitAndTakeDiscount" value="<?=$visitAndTakeArr['discount']?>">원
            </div>
        </div>
        <div class="input_form" id="giftBox"  style="display: none"><!--사은품시-->
            <div class="input_unit">
                <input type="text" class="border_gray w50" placeholder="사은품을 입력해주세요" id="visitAndTakeGifts" name="visitAndTakeGifts" value="<?=$visitAndTakeArr['gifts']?>">
            </div>
        </div>
        <div class="input_form ">
            <p>방문 주소</p>
            <div class="input_select">
                <select class="border_gray" id="visitAndTakeAddrNo" name="visitAndTakeAddrNo">
                    <option value="">선택해주세요</option>
                    <?
                    $address_list = $address_book_data['list'];

                    foreach ($address_list as $index => $data) {?>
                        <option value="<?=$data['addrNo']?>" <?=get_selected($visitAndTakeArr['addrNo'],$data['addrNo'])?>><?=$data['addrName']." (".$data['addr1']." ". $data['addr2'] . ")"?></option>
                    <?}
                    ?>
                </select>
            </div>
        </div><!--방문 주소-->
    </div>

    <div class="wrap">
        <div class="input_form">
            <p>발송정책</p>
            <div class="flex gap20">
                <?
                    $dispatchPolicyNo = $shippingArr['dispatchPolicyNo']['gmkt'];
                ?>

                <select class="border_gray" id="dispatchPolicyNo" name="dispatchPolicyNo">
                    <option value="">선택</option>
                    <?
                    foreach ($dispatch_policy_data as $index => $data){ ?>
                        <option value="<?=$data['gmarket_reg_no']?>" <?=get_selected($dispatchPolicyNo, $data['gmarket_reg_no'])?>><?=$data['dispatch_policy']." > ".$data['dispatch_info']?></option>
                    <?}
                    ?>
                </select>
            </div><!--발송정책-->
        </div>
    </div>
    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 출고지</p>
        <div class="input_select">
            <?
                $placeNo = $shippingArr['policy']['placeNo'];
            ?>
            <select class="border_gray" id="placeNo" name="placeNo">
                <option value="">선택해주세요</option>
                <?
                    $places_list = $places_data['list'];
                    
                    foreach ($places_list as $index => $data) {?>
                        <option value="<?=$data['placeNo']?>" <?=get_selected($placeNo, $data['placeNo'])?>><?=$data['placeName']?></option>
                    <?}
                ?>
            </select>
        </div><!--출고지-->

        <p class="text-guide">
            주소 (우편번호)
        </p>
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>출고지 주소록은 '배송정보관리'메뉴에서 관리가 가능합니다.
        </p>
    </div>
    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 묶음배송</p>
        <?
            $useBundle = $shippingArr['policy']['bundle'] == null ? false : true;
        ?>
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="shippingPolicyFeeType1" name="shippingPolicyFeeType" value="1" <?=get_checked($useBundle, true)?>>
                <label for="shippingPolicyFeeType1">
                    <i class="fa-duotone fa-circle-check"></i>설정함
                </label>
            </div>


            <div class="input_radio">
                <input type="radio" id="shippingPolicyFeeType2" name="shippingPolicyFeeType" value="2" <?=get_checked($useBundle, false)?>>
                <label for="shippingPolicyFeeType2">
                    <i class="fa-duotone fa-circle-check"></i>설정안함(개별배송)
                </label>
            </div>
        </div>
        <!--묶음배송-->
    </div>
    <div class="input_form secondBox" id="div_shippingPolicyFeeType1" style="display: <?=get_displayed($useBundle,true)?>">
        <p><span class="color-blue">(필수)</span> 배송비 선택</p><!--묶음배송시/배송비 선택-->
        <div class="input_select">
            <input type="hidden" id="bundelDeliveryTmplId" value="<?=$shippingArr['policy']['bundle']['deliveryTmplId']?>">
            <select class="border_gray" id="deliveryTmplId" name="deliveryTmplId">
                <option value="">출고지를 먼저 선택해주세요.</option>
            </select>
        </div>

        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>배송비는 '배송정보관리'메뉴에서만 관리가 가능합니다.
        </p>
        <!--묶음배송시/배송비 선택-->
    </div>
    <div class="input_form secondBox" id="div_shippingPolicyFeeType2" style="display: <?=get_displayed($useBundle,false)?>">
        <?
            $eachArr = $shippingArr['policy']['each'];
            $useEach = false;
            if(!empty($eachArr)){
                $useEach = true;
            }
        ?>

        <p><span class="color-blue">(필수)</span> 배송비 선택</p><!--개별배송시/배송비-->
        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="eachFeeType1" name="eachFeeType" value="1" <?=get_checked($eachArr['feeType'], "1")?>>
                <label for="eachFeeType1">
                    <i class="fa-duotone fa-circle-check"></i>무료
                </label>
            </div>
            <div class="input_radio">
                <input type="radio" id="eachFeeType2" name="eachFeeType" value="2" <?=get_checked($eachArr['feeType'], "2")?>>
                <label for="eachFeeType2">
                    <i class="fa-duotone fa-circle-check"></i>유료
                </label>
            </div>
            <div class="input_radio">
                <input type="radio" id="eachFeeType3" name="eachFeeType" value="3" <?=get_checked($eachArr['feeType'], "3")?>>
                <label for="eachFeeType3">
                    <i class="fa-duotone fa-circle-check"></i>조건부 무료
                </label>
            </div>
<!--            <div class="input_radio">
                <input type="radio" id="eachFeeType4" name="eachFeeType" value="4">
                <label for="eachFeeType4">
                    <i class="fa-duotone fa-circle-check"></i>수량별 차등
                </label>
            </div>-->
        </div>
        <br>
        <div id="div_paid" class="input_unit" style="display: <?=get_displayed($eachArr['feeType'], "2")?>">
            <input type="text" class="border_gray w50" id="basic_delivery_price" name="basic_delivery_price" value="<?=$eachArr['fee']?>">원
        </div>
        <div id="div_conditional" class="flex" style="display: <?=get_displayed($eachArr['feeType'], "3")?>">
            <div class="input_unit">
                배송비 : <input type="text" class="border_gray w50"  id="condition_delivery_price" name="condition_delivery_price" value="<?=$eachArr['fee']?>">원
            </div>

            <div class="input_unit">
                <input type="text" class="border_gray w50" id="condition_over_price" name="condition_over_price" value="<?=$eachArr['details'][0]['Condition']?>">원 이상 구매시 무료
            </div>

        </div>
        <!--
        <div id="div_differential" class="flex" style="display: none">
            <div class="input_unit">
                <input type="text" class="border_gray w25" value="0">개 이상
                <input type="text" class="border_gray w25" value="0">개 미만
            </div>
            <div class="input_unit">
                <input type="text" class="border_gray w50" value="0">원
            </div>
            <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
            <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
        </div>-->
        <!--개별배송시/배송비-->
    </div>
</div>
<!-- 배송 -->

<div class="box addressBox">
    <h4>
        <span class="color-blue">(필수)</span> 반품/교환
    </h4>
    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 반품/교환지</p>
        <?
            $returnAndExchangeArr = $shippingArr['returnAndExchange'];
        ?>
        <div class="input_select">
            <select class="border_gray" id="returnAndExchangeAddrNo" name="returnAndExchangeAddrNo">
                <option value="">선택해주세요</option>
                <?
                $address_list = $address_book_data['list'];

                foreach ($address_list as $index => $data) {?>
                    <option value="<?=$data['addrNo']?>" <?=get_selected($returnAndExchangeArr['addrNo'],$data['addrNo'])?>><?=$data['addrName']." (".$data['addr1']." ". $data['addr2'] . ")"?></option>
                <?}
                ?>
            </select>
        </div>
    </div><!--반품/교환지-->


    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 반품/교환 배송비(편도)</p>

<!--        <div class="flex gap20">
            <div class="input_radio">
                <input type="radio" id="radi_refund_01" name="radi_refund" checked>
                <label for="radi_refund_01">
                    <i class="fa-duotone fa-circle-check"></i>무료
                </label>
            </div>


            <div class="input_radio">
                <input type="radio" id="radi_refund_02" name="radi_refund">
                <label for="radi_refund_02">
                    <i class="fa-duotone fa-circle-check"></i>유료
                </label>
            </div>
        </div>-->
        <div class="input_unit">
            <input type="text" class="border_gray" value="<?=$returnAndExchangeArr['fee']?>" id="returnAndExchange" name="returnAndExchange">원
        </div>
    </div><!--반품/교환 배송비-->
</div>
<!-- 반품교환 -->

<div class="box addBox">
    <h4>
        추가구성
    </h4>

    <!--추가구성설정-->
    <?php
        echo view('goods/form/goods_addon_form', $this->data);
    ?>
</div>
<!-- 추가구성 -->

<? /*
<? if($w == "u") { ?>
    <div class="box beneBox">
        <!-- 구매혜택 -->
        <h4>
            구매혜택
        </h4>

        <div class="">
            <p>사은품/덤</p>
            <input type="text" id="" name="" placeholder="한글 10자/영문 20자까지 입력가능합니다." class="border_gray">
            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>증정할 사은품을 입력해주세요.
            </p>
            <div class="flex gap10">
                <input type="text" id="" name="" placeholder="0" class="border_gray w100px">
                <p>+</p>
                <input type="text" id="" name="" placeholder="0" class="border_gray w100px">
            </div>
            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>최대 2자리 숫자까지만 입력 가능합니다. 입력예시) 1+1, 2+1.
            </p>
        </div>
        <div class="wrap">
            <div class="input_form">
                <p>복수구매할인</p>

                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="radi_hyetak_01" name="radi_hyetak">
                        <label for="radi_hyetak_01">
                            <i class="fa-duotone fa-circle-check"></i>설정함
                        </label>
                    </div>
                    <div class="input_radio">
                        <input type="radio" id="radi_hyetak_02" name="radi_hyetak" checked>
                        <label for="radi_hyetak_02">
                            <i class="fa-duotone fa-circle-check"></i>설정안함
                        </label>
                    </div>

                </div>
            </div>
            <div class="input_form secondBox">
                <p>조건설정</p>
                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="radi_buydiscount01" name="radi_buydiscount">
                        <label for="radi_buydiscount01">
                            <i class="fa-duotone fa-circle-check"></i>더 사면 할인
                        </label>
                    </div>
                    <div class="input_radio">
                        <input type="radio" id="radi_buydiscount02" name="radi_buydiscount">
                        <label for="radi_buydiscount02">
                            <i class="fa-duotone fa-circle-check"></i>N+1 할인
                        </label>
                    </div>
                </div><br>

                <!--  더 사면 할인-->
                <div class="input_unit3">
                    <input type="text" id="radi_buydiscount_price" name="radi_buydiscount_price" placeholder="0" class="border_gray">
                    <div class="input_select">

                        <select class="border_gray">
                            <option value="개">개</option>
                        </select>
                    </div>
                    이상 구매 시
                    <br>
                    <input type="text" id="radi_buydiscount_price" name="radi_buydiscount_price" placeholder="0" class="border_gray">
                    <div class="input_select">

                        <select class="border_gray">
                            <option value="원">원</option>
                        </select>
                    </div>
                    할인 (1개당)
                </div>
                <div class="flex gap20">
                    <div class="input_checkbox">
                        <input type="checkbox" id="radi_discountDate02">
                        <label for="radi_discountDate02">
                            <i class="fa-duotone fa-square-check"></i> 특정기간만 할인
                        </label>
                        <div class="input_date">
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
                    </div>
                </div>


                <!--  N+1 할인-->
                <div class="input_unit3">
                    <input type="text" id="radi_buydiscount_price" name="radi_buydiscount_price" placeholder="0" class="border_gray">
                    <div class="input_select">
                        <select class="border_gray">
                            <option value="개">개</option>
                        </select>
                    </div>
                    이상 구매 시 1개 상품 가격만큼 할인
                </div>
                <div class="flex gap20">
                    <div class="input_checkbox">
                        <input type="checkbox" id="radi_discountDate02">
                        <label for="radi_discountDate02">
                            <i class="fa-duotone fa-square-check"></i> 특정기간만 할인
                        </label>
                        <div class="input_date">
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
                    </div>
                </div>

                <p class="flex gap5 input_discount_price">
                    <span class="color-blue">최종 할인가</span>
                    <strong class="color-blue">0원</strong>
                </p>
            </div>
        </div>
        <div class="wrap">
            <div class="input_form">
                <p>스마일캐시 지급</p>

                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="radi_smilecash_01" name="radi_smilecash">
                        <label for="radi_smilecash_01">
                            <i class="fa-duotone fa-circle-check"></i>설정함
                        </label>
                    </div>
                    <div class="input_radio">
                        <input type="radio" id="radi_smilecash_02" name="radi_smilecash" checked>
                        <label for="radi_smilecash_02">
                            <i class="fa-duotone fa-circle-check"></i>설정안함
                        </label>
                    </div>

                </div>
            </div>
            <div class="input_form secondBox">
                <p>적립설정</p>
                <div class="flex gap20">
                </div>
                <div class="input_unit3">
                    <input type="text" id="save_set" name="save_set" placeholder="0" class="border_gray">
                    <div class="input_select">
                        <select class="border_gray">
                            <option value="%">%</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 구매혜택 -->

<?}?>
*/ ?>

<?php echo view('goods/js/goods_js_4', $this->data); ?>