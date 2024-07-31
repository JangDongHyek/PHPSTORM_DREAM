
<div class="box detailBox"><!--상세설명-->
    <h4>
        <span class="color-blue">(필수)</span> 상품 상세설명
    </h4>
    <div class="con-detail-wrap">
        <!-- 테스트값 삭제 -->
        <?
            $descriptions = json_decode($goods_data['descriptions'], true);
        ?>
        <textarea id="html_kor" name="html_kor" class="border_gray" placeholder="HTML을 작성해주세요."><?=$descriptions['kor']['html']?></textarea>
    </div>
    <div class="flex justi-sb">
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>Iframe, 다른상품링크, 팝업링크를 제외하고 입력해주세요.
        </p>
    </div>
</div>
<!--상세설명-->

<div class="box infoBox"><!--주요정보-->
    <h4>상품 주요정보</h4>
    <div class="input_form w100">

        <div class="brandWrap">
            <?
                $showBrand = false;
                if(!empty($goods_data['brandNo'])){
                    $showBrand = true;
                }
                if(!$showBrand) {?>
                    <p>브랜드 및 제조사</p>
                    <form name="brandSearch">
                        <div class="input_search" onclick="getBrand()">
                            <input type="text" id="input_brandSearch" name="input_brandSearch" placeholder='브랜드 및 제조사, 상품브랜드를 검색해보세요.' class="border_gray">
                            <button type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <div class="input_checkbox">
                        <input type="checkbox" id="noBrand" name="noBrand" value="T">
                        <label for="noBrand"><i class="fa-duotone fa-square-check"></i>브랜드 없음</label>
                    </div>

                    <input type="hidden" id="brandNo" name="brandNo">
                    <input type="hidden" id="brandName" name="brandName">
                    <input type="hidden" id="makerName" name="makerName">
                    <input type="hidden" id="productBrandName" name="productBrandName">

                    <div id="all_search" style="display: none;">
                        <div class="all_search">
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">브랜드</span>
                                    <ul class="list__category" role="listbox" id="brand_cate1">

                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">제조사</span>
                                    <ul class="list__category" role="listbox" id="brand_cate2">

                                    </ul>
                                </div>
                            </div>
                            <div class="box__category">
                                <div class="box__category-inner"><span class="text__category">상품브랜드</span>
                                    <ul class="list__category" role="listbox" id="brand_cate3">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?}
            ?>
            <div id="div_selectedBrand" style="display: <?=get_displayed($showBrand,true)?>">
                선택한 브랜드 : <span id="span_brandName"><?=$goods_data['brandName']?></span> |
                제조사 : <span id="span_makerName"><?=$goods_data['makerName']?></span> | 
                상품브랜드 : <span id="span_productBrandName"><?=$goods_data['productBrandName']?></span>
            </div>

            <p class="flex gap5 text-guide">
                <i class="fa-duotone fa-circle-exclamation"></i>브랜드 및 제조사를 등록하면 검색 결과에 노출될 확률이 높아집니다.
                <i class="fa-duotone fa-circle-exclamation"></i>상품 등록 후 브랜드 수정이 불가합니다.
            </p>
        </div>
    </div>

</div>
<!--주요정보-->
<!-- is-selected -->


<div class="box certiBox"><!--인증정보-->
    <h4>
        <span class="color-blue">(필수)</span> 인증정보
    </h4>

    <div class="wrap1_2">
        <div class="input_form">
            <div class="">
                <p>살생화학/살생물제품 인증</p>
                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="killing1" name="killing" value="0" disabled>
                        <label for="killing1">
                            <i class="fa-duotone fa-circle-check"></i>인증대상
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="killing2" name="killing" value="1" checked>
                        <label for="killing2">
                            <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="killing3" name="killing" value="2" disabled>
                        <label for="killing3">
                            <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                        </label>
                    </div>
                </div>
            </div>

        </div>


        <!--                인증대상일때-->
<!--        <div class="input_form secondBox">
            <div class="">
                <p>인증 유형</p>

                <div class="option_grid">
                    <div class="flex gap10 ">
                        <input type="text" id="child_certId" name="child_certId" placeholder="인증번호" class="border_gray w150px" value="">
                        <button class="flex gap5 btn btn-blue">인증하기</button>
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                    </div>
                </div>
                <p class="flex gap5 text-guide">
                    <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                </p>
            </div>

        </div>-->
    </div>

    <div class="wrap1_2">
        <div class="input_form">
            <div class="">
                <p>인증정보</p>
                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="Certification1" name="Certification" value="0" disabled>
                        <label for="Certification1">
                            <i class="fa-duotone fa-circle-check"></i>인증대상
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="Certification2" name="Certification" value="1" checked>
                        <label for="Certification2">
                            <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="Certification3" name="Certification" value="2" disabled>
                        <label for="Certification3">
                            <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                        </label>
                    </div>
                </div>
            </div>

        </div>


        <!-- 인증대상일때-->
<!--        <div class="input_form secondBox">
            <div class="">
                <p>인증 유형</p>

                <div class="flex gap10">
                    <div class="input_select option-name w150px">
                                                <select id="child_certTargetCode" name="child_certTargetCode" class="border_gray">
                            <option value="0">안전인증</option>
                            <option value="1">안전확인</option>
                            <option value="2">공급자적합성확인</option>
                        </select>
                    </div>
                    <div class="input_select w150px">
                                                <select id="" name="" class="border_gray">
                            <option value="0">인증기관선택</option>
                        </select>
                    </div>
                    <div class="flex gap10">
                        <input type="text" id="child_certId" name="child_certId" placeholder="인증번호" class="border_gray w150px" value="">
                        <input type="text" id="" name="" placeholder="인증모델" class="border_gray w150px" value="">
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                    </div>
                </div>
                <p class="flex gap5 text-guide">
                    <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                </p>
            </div>

        </div>-->
    </div>

    <div class="wrap1_2">
        <div class="input_form">
            <div class="">
                <p>영업허가증</p>
                <div class="flex gap20">
                    <div class="input_radio">
                        <input type="radio" id="permission1" name="permission" value="0" disabled>
                        <label for="permission1">
                            <i class="fa-duotone fa-circle-check"></i>인증대상
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="permission2" name="permission" value="1" checked>
                        <label for="permission2">
                            <i class="fa-duotone fa-circle-check"></i>상세설명에 별도표기
                        </label>
                    </div>


                    <div class="input_radio">
                        <input type="radio" id="permission3" name="permission" value="2" disabled>
                        <label for="permission3">
                            <i class="fa-duotone fa-circle-check"></i>인증대상이 아님
                        </label>
                    </div>
                </div>
            </div>

        </div>


        <!-- 인증대상일때-->
<!--        <div class="input_form secondBox">
            <div class="">
                <p>허가 대상/업종</p>

                <div class="flex gap10">
                    <button class="flex gap5 btn btn-blue">영업허가증 첨부</button>
                    <div class="input_select option-name w150px">
                                                <select id="" name="" class="border_gray">
                            <option value="0">업종선택</option>
                        </select>
                    </div>
                    <div class="flex gap10 ">
                        <input type="text" id="" name="" placeholder="영업/허가기관" class="border_gray w150px" value="">
                        <input type="text" id="" name="" placeholder="영업/허가번호" class="border_gray w150px" value="">
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                        <button class="flex gap5 btn btn-white"><i class="fa-light fa-plus"></i>추가</button>
                    </div>
                </div>
                <p class="flex gap5 text-guide">
                    <i class="fa-duotone fa-circle-exclamation"></i>KC인증이 필수인 상품을 인증 없이 판매하는 경우 3년 이하의 징역 또는 3천만원 이하의 벌금형에 처해질 수 있습니다.
                </p>
            </div>

        </div>-->
    </div>

</div>
<!--인증정보필수-->

<div class="box howBox"><!--판매방식-->
    <h4>
        <span class="color-blue">(필수)</span> 판매방식
    </h4>

    <div class="wrap">
        <div class="input_form">
            <p>상품상태</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="goodsStatus0" name="goodsStatus" value="1" checked>
                    <label for="goodsStatus0">
                        <i class="fa-duotone fa-circle-check"></i>신상품
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="goodsStatus1" name="goodsStatus" value="2">
                    <label for="goodsStatus1">
                        <i class="fa-duotone fa-circle-check"></i>중고상품
                    </label>
                </div>
            </div>
        </div><!--상품상태-->

        <div class="input_form">
            <p>미성년자 구매</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="childSellStatus0" name="isAdultProduct" value="F" checked>
                    <label for="childSellStatus0">
                        <i class="fa-duotone fa-circle-check"></i>가능
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="childSellStatus1" name="isAdultProduct" value="T">
                    <label for="childSellStatus1">
                        <i class="fa-duotone fa-circle-check"></i>불가능
                    </label>
                </div>
            </div>
        </div><!--미성년자-->
    </div>

    <div class=""><!--최대구매 수량-->
        <div class="input_form">
            <p>최대구매 수량</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="buyableQuantity0" name="buyableQuantity" value="T" >
                    <label for="buyableQuantity0">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="buyableQuantity1" name="buyableQuantity" value="F" checked>
                    <label for="buyableQuantity1">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div><!--최대구매 수량-->

        <br>

        <!--                    최대구매 수량 설정함일때-->
        <div class="input_form secondBox" id="div_buyableQuantity" style="display: <?=get_displayed('','T')?>">
            <p>제한설정</p>

            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="buyableQuantity2" name="buyableQuantityChild" value="1" checked>
                    <label for="buyableQuantity2">
                        <i class="fa-duotone fa-circle-check"></i>최대구매제한
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="buyableQuantity3" name="buyableQuantityChild" value="3">
                    <label for="buyableQuantity3">
                        <i class="fa-duotone fa-circle-check"></i>기간제한
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="buyableQuantity4" name="buyableQuantityChild" value="2">
                    <label for="buyableQuantity4">
                        <i class="fa-duotone fa-circle-check"></i>1회 제한
                    </label>
                </div>
            </div>
            <p class="flex gap10" id="p_buyableQuantity">
                구매자 1명이 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="buyableQuantityQty" name="buyableQuantityQty">개 까지 구매가능(최대 999개)
            </p>
        </div>
    </div>

    <div class="wrap">
<!--        <div class="input_form">
            <p>예약판매</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_sale_method04_01" name="radi_sale_method04">
                    <label for="radi_sale_method04_01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="radi_sale_method04_02" name="radi_sale_method04">
                    <label for="radi_sale_method04_02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>-->
        <!--예약판매-->

        <!--<div class="input_form secondBox">
            <p>배송시작일 설정</p>
            <div class="flex gap20">
                <div class="input_checkbox">
                    <input type="checkbox" id="start_date01">
                    <label for="start_date01"><i class="fa-duotone fa-square-check"></i>일괄</label>
                </div>

                <div class="input_checkbox">
                    <input type="checkbox" id="start_date02">
                    <label for="start_date02"><i class="fa-duotone fa-square-check"></i>G마켓</label>
                </div>

                <div class="input_checkbox">
                    <input type="checkbox" id="start_date03">
                    <label for="start_date03"><i class="fa-duotone fa-square-check"></i>옥션</label>
                </div>
            </div>
            <div class="input_select" style="width:300px">
                <input type="date" class="border_gray">
            </div>
        </div>-->
        <!--배송시작일-->
    </div>

    <div class="wrap">
        <!--<div class="input_form">
            <p>G마켓 선물하기</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_sale_method05_01" name="radi_sale_method05">
                    <label for="radi_sale_method05_01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>
                <div class="input_radio">
                    <input type="radio" id="radi_sale_method05_02" name="radi_sale_method05">
                    <label for="radi_sale_method05_02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>-->
        <!--선물하기-->
    </div>
    <div class="wrap">
        <!--<div class="input_form">
            <p>G마켓 해외판매</p>
            <div class="flex gap20">
                <div class="input_radio">
                    <input type="radio" id="radi_sale_method06_01" name="radi_sale_method06">
                    <label for="radi_sale_method06_01">
                        <i class="fa-duotone fa-circle-check"></i>설정함
                    </label>
                </div>


                <div class="input_radio">
                    <input type="radio" id="radi_sale_method06_02" name="radi_sale_method06">
                    <label for="radi_sale_method06_02">
                        <i class="fa-duotone fa-circle-check"></i>설정안함
                    </label>
                </div>
            </div>
        </div>-->
        <!--해외판매-->
        <!--<div class="input_form secondBox">
            <p>상품무게</p>
            <div class="input_unit" style="width:300px">
                <input type="text" class="border_gray"> kg
            </div>
        </div>-->
        <!--상품무게-->
    </div>
</div>
<!--판매방식-->

<!--상품정보 제공고시-->
<!--
<div class="box info2Box">
    <h4>
        <span class="color-blue">(필수)</span> 상품정보 제공고시
    </h4>

    <div class="input_form">
        <p>상품정보 제공고시 템플릿</p>
        <div class="flex gap5">
            <div class="input_checkbox">
                <input type="checkbox" id="officialNotice_all">
                <label for="officialNotice_all"><i class="fa-duotone fa-square-check"></i>'상품 상세설명 참조'로 전체 입력</label>
            </div>
        </div>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 품명 및 모델명</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-1">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 동일모델의 출시년월</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-2">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> KC 인증정보</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-3">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>(자동차관리법에 따른 부품자기 인증 대상 자동차부품, 전기용품 및 생활용품 안전관리법에 따른 안전인증ㆍ안전확인ㆍ공급자 적합성확인대상제품 및 전파법에 따른 적합 인증ㆍ적합등록 대상 기자재에 한함)
        </p>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 제조자/수입자</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-4">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>수입품의 경우 수입자를 함께 입력, 병행수입의 경우 병행수입 여부로 대체 가능
        </p>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 제조국</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-5">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 크기</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-6">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 적용차종</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-7">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 제품사용으로 인한 위험 및 유의사항</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-11">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>연료절감장치에 한함
        </p>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 품질보증기준</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-8">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 검사합격증 번호</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-12">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
        <p class="flex gap5 text-guide">
            <i class="fa-duotone fa-circle-exclamation"></i>(대기환경보전법에 따른 첨가제ㆍ촉매제에 한함)
        </p>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> A/S 책임자와 전화번호</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-9">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p><span class="color-blue">(필수)</span> 주문후 예상 배송기간</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="15-10">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>

    <div class="input_form">
        <p>기타 특이사항</p>
        <input type="hidden" name="officialNoticeItemelementCode[]" value="999-5">
        <textarea name="officialNoticeItemelementValue[]" class="border_gray" placeholder="최대 한글 500자, 영문/숫자 1000자까지 입력 가능합니다."></textarea>
    </div>
</div>
-->
<!--상품정보 제공고시-->



<?php echo view('goods/js/goods_js_3', $this->data); ?>