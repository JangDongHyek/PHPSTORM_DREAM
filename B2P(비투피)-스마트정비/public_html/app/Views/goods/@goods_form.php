<?php
echo view('common/header_adm');
$pid = "manager_product_write";
$header_name = "제품 현황";

?>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">제품 현황</h6>
            <div class="menu02">
                <a href="<?=base_url('admin/manager_product_list')?>" class="active">제품 현황</a>
                <!--                <a href="<?=base_url('admin/manager_stock_list')?>">재고 관리</a>-->
            </div>
        </div>

        <form id="item_form" name="item_form">
            <div class="write_wrap">
                <div class="top_wrap">
                    <h1>제품 등록하기</h1>
                    <div class="btn_wrap">
                        <a href="<?=base_url('admin/manager_product_list')?>" class="btn btn-sm btn-gray">목록</a>
                        <a href="<?=base_url('admin/manager_product_list')?>" class="btn btn-sm btn-pink">삭제</a>
                        <button type="button" onclick="save_goods()" class="btn btn-sm btn-blue">저장</button>
                    </div>
                </div>

                <div class="box">
                    <h4><span class="color-blue">(필수)</span> 판매사이트 및 판매상태</h4>
                    <div class="wrap box__site-group">
                        <div class="box__filter-group ">
                            <div class="input_radio form">
                                <input class="form__radio" id="isSell1" type="radio" value="T" name="isSell" checked>
                                <label for="isSell1" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매가능</label>
                            </div>
                            <div class="input_radio form">
                                <input class="form__radio" id="isSell2" type="radio" value="F" name="isSell">
                                <label for="isSell2" class="form__label"><i class="fa-duotone fa-circle-check"></i>판매중지</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="box">
                    <h4><span class="color-blue">(필수)</span> 상품명</h4>

                    <div class="">
                        <p><span class="color-blue">(필수)</span> 상품명</p>
                        <!-- 테스트값 삭제 -->
                        <input type="text" id="goodsName_kor" name="goodsName_kor" placeholder="입력하세요" class="border_gray" value="테스트 상품">
                        <p class="text-guide">※ 적합한 상품명을 입력하면 검색 결과 노출에 도움이 될 수 있습니다. 일부 카테고리를 제외하고 언제든 상품명 수정이 가능합니다.</p>
                    </div>

                    <div class="">
                        <p>프로모션 문구</p>
                        <input type="text" id="goodsName_promotion" name="goodsName_promotion" placeholder="최대 한글 50자, 영문/숫자 100자까지 입력 가능합니다. (상품명 포함)" class="border_gray">
                        <p class="text-guide">※ 1+1행사 중, 사은품 증정 등 판매 촉진을 위한 문구를 입력해보세요.</p>
                    </div>

                    <input type="hidden" id="manageCode" name="manageCode" value="">
                </div>


                <div class="box">
                    <h4><span class="color-blue">(필수)</span> 카테고리</h4>
                    <input type="hidden" id="ac_cate" name="ac_cate">
                    <input type="hidden" id="gm_cate" name="gm_cate">
                    * 카테고리는 한번 저장하면 수정이 불가능합니다.

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
                </div>


                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 판매가
                    </h4>
                    <div class="input_form">

                        <div class="">
                            <p><span class="color-blue">(필수)</span> 판매가</p>
                            <div class="input_unit">
                                <!-- 테스트값 삭제 -->
                                <input type="text" id="price" name="price" placeholder="입력해주세요." class="border_gray" value="10000">원
                            </div>
                            <p class="text-guide">
                                <!--<span id="span_charge">판매이용료 0% : 0원</span><br>-->
                                <span>*정확한 판매이용료는 해당 쇼핑몰에서 확인해주세요.</span>
                            </p>
                        </div>
                    </div>

                    <div class="wrap">
                        <div class="">
                            <p>할인</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_discount01" name="sellerDiscount" value="T">
                                    <label for="radi_discount01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_discount02" name="sellerDiscount" value="F" checked>
                                    <label for="radi_discount02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="" id="div_sellerDiscount" style="display: <?=get_displayed('','T')?>">
                            <p>할인설정</p>
                            <div class="input_unit2">
                                <input type="text" id="discountprice" name="discountprice" placeholder="숫자만 입력해주세요." class="border_gray">
                                <div class="input_select">

                                    <select class="border_gray">
                                        <option value="%">%</option>
                                        <option value="원">원</option>
                                    </select>
                                </div>
                            </div>
                            <p class="flex gap5 text-guide"><i class="fa-duotone fa-circle-exclamation"></i>100원이상 10원단위로 입력, 판매가 대비 70%까지 입력해주세요.</p>


                            <div class="flex gap20">
                                <div class="input_checkbox">
                                    <input type="checkbox" id="radi_discountDate01">
                                    <label for="radi_discountDate01">
                                        <i class="fa-duotone fa-square-check"></i> 특정기간 할인
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
                                <span class="color-blue">최종 판매가</span>
                                <strong class="color-blue">1000원</strong>
                                <span>(0원 할인)</span>
                            </p>
                        </div>

                    </div>

                    <div class="wrap">
                        <div>
                            <p>판매기간</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_period01" name="sellingPeriod" value="T" >
                                    <label for="radi_period01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>

                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_period02" name="sellingPeriod" checked value="F">
                                    <label for="radi_period02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div  class="" id="div_sellingPeriod" style="display: <?=get_displayed('','T')?>">
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
                            </div>
                        </div>
                    </div>


                    <div class="input_form">
                        <div class="">
                            <p>부과세</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="isVatFree1" name="isVatFree" value="T" checked>
                                    <label for="isVatFree1">
                                        <i class="fa-duotone fa-circle-check"></i>과세상품
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="isVatFree2" name="isVatFree" value="F">
                                    <label for="isVatFree2">
                                        <i class="fa-duotone fa-circle-check"></i>면세상품
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 옵션
                    </h4>

                    <div class="input_form">
                        <p>선택형</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_selectOption1" name="useSelectOption" value="T">
                                <label for="radi_selectOption1">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_selectOption2" name="useSelectOption" value="F" checked>
                                <label for="radi_selectOption2">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="input_form input_grid3" id="div_selectOption" style="display: <?=get_displayed('','T')?>">
                        <div>
                            <p><span class="color-blue">(필수)</span> 옵션 입력방식</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload01_01" name="radi_option_upload01">
                                    <label for="radi_option_upload01_01">
                                        <i class="fa-duotone fa-circle-check"></i>직접 입력하기
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload01_02" name="radi_option_upload01">
                                    <label for="radi_option_upload01_02">
                                        <i class="fa-duotone fa-circle-check"></i>엑셀 일괄 등록하기
                                    </label>
                                </div>

                            </div>

                            <div class="exel_btn_wrap">
                                <input type="file" id="file-exel">
                                <label for="file-exel" class="btn btn-sm btn-blue">
                                    <i class="fa-duotone fa-arrow-up-from-bracket"></i>엑셀 업로드
                                </label>

                                <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(단독형)</a>
                                <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(2개조합형)</a>
                                <a href="" class="inlineflex gap5 btn btn-sm btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 양식 다운로드(3개조합형)</a>
                            </div>
                        </div>


                        <div>
                            <p><span class="color-blue">(필수)</span> 옵션 유형</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload02_01" name="radi_option_upload02">
                                    <label for="radi_option_upload02_01">
                                        <i class="fa-duotone fa-circle-check"></i>단독형
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload02_02" name="radi_option_upload02">
                                    <label for="radi_option_upload02_02">
                                        <i class="fa-duotone fa-circle-check"></i>조합형
                                    </label>
                                </div>
                            </div>
                        </div>




                        <div>
                            <p><span class="color-blue">(필수)</span> 옵션명 개수</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload03_01" name="radi_option_upload03">
                                    <label for="radi_option_upload03_01">
                                        <i class="fa-duotone fa-circle-check"></i>2개
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_option_upload03_02" name="radi_option_upload03">
                                    <label for="radi_option_upload03_02">
                                        <i class="fa-duotone fa-circle-check"></i>3개
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div>
                        <p><span class="color-blue">(필수)</span> 옵션입력</p>

                        <div class="option_grid">
                            <div>
                                <p class="text-guide">옵션명</p>
                                <div class="input_select option-name">

                                    <select class="border_gray">
                                        <option value="옵션명 선택">옵션명 선택</option>
                                        <option value="옵션명 선택">옵션명 선택</option>
                                        <option value="옵션명 선택">옵션명 선택</option>
                                    </select>
                                </div>
                                <div class="input_select option-name">

                                    <select class="border_gray">
                                        <option value="옵션명 선택">옵션명 선택</option>
                                        <option value="옵션명 선택">옵션명 선택</option>
                                        <option value="옵션명 선택">옵션명 선택</option>
                                    </select>
                                </div>


                                <button class="btn-option-save btn-blue"><i class="fa-light fa-arrow-down"></i>옵션목록으로 적용</button>
                            </div>


                            <div class="">
                                <p class="text-guide">옵션값</p>


                                <div class="flex gap10 option-value">
                                    <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" class="border_gray" value="니로 / H06,모닝 / K02,올 뉴 모닝 / K02-1">
                                    <button class="flex gap5 btn btn-blue"><i class="fa-light fa-plus"></i>추가</button>
                                </div>

                                <div class="flex gap10 option-value">
                                    <input type="text" placeholder="콤마(‘,’)로 구분해서 입력해주세요" class="border_gray">
                                    <button class="flex gap5 btn btn-white"><i class="fa-light fa-xmark"></i>삭제</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="option_list">
                        <p><span class="color-blue">(필수)</span> 옵션 목록 <strong class="color-blue">3</strong>개</p>

                        <div class="flex justi-sb">
                            <div class="input_checkbox">

                                <input type="checkbox" id="input_option_list">

                                <label for="input_option_list"><i class="fa-duotone fa-square-check txt-lg"></i>재고수량 관리</label>
                            </div>

                            <div class="flex gap10">
                                <div class="input_select">

                                    <select class="border_gray">
                                        <option value="등록순">등록순</option>
                                        <option value="등록순">등록순</option>
                                        <option value="등록순">등록순</option>
                                    </select>
                                </div>

                                <a href="" class="inlineflex gap5 btn btn-white"><i class="fa-duotone fa-file-excel color-green"></i> 엑셀 다운로드</a>
                            </div>
                        </div>


                        <div class="option_table">
                            <div class="top_btn">
                                <div></div>
                                <button class="btn btn-sm btn-white">선택삭제</button>
                            </div>
                            <table>
                                <thead>
                                <tr>
                                    <th width="50px">
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-selectall">
                                            <label for="option-selectall"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </th>
                                    <!--                                    <th>이미지</th>-->
                                    <th width="auto">옵션명</th>
                                    <th width="auto">옵션값<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="100px">추가금<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="100px">재고수량<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">판매상태<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">옵션관리코드<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="auto">노출여부<button class="btn btn-sm btn-white">일괄수정</button></th>
                                    <th width="50px">삭제</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input_checkbox">
                                            <input type="checkbox" id="option-select01">
                                            <label for="option-select01"><i class="fa-duotone fa-square-check txt-lg"></i></label>
                                        </div>
                                    </td>
                                    <!--                                    <td>이미지</td>-->
                                    <td>차종</td>
                                    <td><input type="text" value="니로 / H06" class="border_gray"></td>
                                    <td><input type="text" value="100" class="border_gray"></td>
                                    <td><input type="text" value="0" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="판매가능">판매가능</option>
                                                <option value="품절">품절</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" value="BOL01-205A001" class="border_gray"></td>
                                    <td>
                                        <div class="input_select">

                                            <select class="border_gray">
                                                <option value="노출">노출</option>
                                                <option value="미노출">미노출</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-sm btn-white">삭제</button></td>
                                </tr>
                                <tr class="nodata_tr">
                                    <td colspan="9">
                                        <p><i class="fa-duotone fa-circle-exclamation"></i>적용된 옵션값이 없습니다</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="box">
                    <h4>
                        재고수량
                    </h4>
                    <div class="input_form">

                        <div class="">
                            <p><span class="color-blue">(필수)</span> 재고수량</p>
                            <div class="input_unit">
                                <!-- 테스트값 삭제 -->
                                <input type="text" id="stock" name="stock" placeholder="입력해주세요." class="border_gray" value="999">개
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>옵션 재고수량을 설정하면, 옵션의 재고수량으로 자동 적용됩니다.
                            </p>
                        </div>
                    </div>

                </div>


                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 상품이미지
                    </h4>
                    <div class="proImgWrap">
                        <div class="btn-proImgList">
                            <span>상품 기본 이미지</span>
                            <input id="basicImgURL" name="basicImgURL" placeholder="링크를 입력해주세요" value="https://www.itforone.co.kr/theme/itforone04/img/main/img_company01.jpg"><br>
                        </div>
                        <div class="">
                            <span>상품 추가 이미지</span>
                            <div><input id="addtionalImg_0" name="addtionalImg[]" placeholder="링크를 입력해주세요" value="https://gi.esmplus.com/b2pcorp/%EC%B9%B4%EC%8A%A4%ED%8A%B8%EC%BD%94%20%EC%99%80%EC%9D%B4%ED%8D%BC/13.jpg"></div>
                            <? for($i=1; $i<14; $i++){ ?>
                                <div><input id="addtionalImg_<?=$i?>" name="addtionalImg[]" placeholder="링크를 입력해주세요"></div>
                            <?}?>

                        </div>
                    </div>
                    <p class="flex gap5 text-guide">
                        <i class="fa-duotone fa-circle-exclamation"></i>상품이미지는 15장까지 업로드 가능합니다
                    </p>

                </div>

                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 상품 상세설명
                    </h4>
                    <div class="con-detail-wrap">
                        <!-- 테스트값 삭제 -->
                        <textarea id="html_kor" name="html_kor" class="border_gray" placeholder="HTML을 작성해주세요."><div>테스트입니다</div></textarea>
                    </div>
                    <div class="flex justi-sb">
                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>Iframe, 다른상품링크, 팝업링크를 제외하고 입력해주세요.
                        </p>
                    </div>
                </div>


                <div class="box">
                    <h4>
                        상품 주요정보
                    </h4>
                    <div class="input_form">

                        <div class="">
                            <p>브랜드 및 제조사</p>
                            <div class="input_search">
                                <input type="text" id="brandNo" name="brandNo" placeholder='브랜드 및 제조사, 상품브랜드를 검색해보세요.' class="border_gray">
                                <button><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            <div class="input_checkbox">
                                <input type="checkbox" id="no_brand">
                                <label for="no_brand"><i class="fa-duotone fa-square-check"></i>브랜드 없음</label>
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>브랜드 및 제조사를 등록하면 검색 결과에 노출될 확률이 높아집니다.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="box">
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
                        </div>

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
                        </div>
                    </div>

                    <div class="wrap">
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
                        </div>


                        <!--                    최대구매 수량 설정함일때-->
                        <div class="input_form" id="div_buyableQuantity" style="display: <?=get_displayed('','T')?>">
                            <p>제한설정</p>

                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="buyableQuantity2" name="buyableQuantityChild" value="1" checked>
                                    <label for="buyableQuantity2">
                                        <i class="fa-duotone fa-circle-check"></i>최대구매제한
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="buyableQuantity3" name="buyableQuantityChild" value="2">
                                    <label for="buyableQuantity3">
                                        <i class="fa-duotone fa-circle-check"></i>기간제한
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="buyableQuantity4" name="buyableQuantityChild" value="3">
                                    <label for="buyableQuantity4">
                                        <i class="fa-duotone fa-circle-check"></i>1회 제한
                                    </label>
                                </div>
                            </div>

                            <p class="flex gap10" id="p_buyableQuantity">
                                구매자 1명이 최대 <input type="text" class="border_gray" style="width:100px" value="0" id="uyableQuantityQty" name="uyableQuantityQty">개 까지 구매가능(최대 999개)
                            </p>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 배송
                    </h4>
                    <div class="wrap">
                        <div class="input_form">
                            <p>상품상태</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_deli01_02" name="shippingType" value="2" checked>
                                    <label for="radi_deli01_02">
                                        <i class="fa-duotone fa-circle-check"></i>직접배송
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap">
                        <div class="input_form">
                            <p>발송정책</p>
                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_deli02_06" name="dispatchPolicyNo" value="1638190" checked>
                                    <label for="radi_deli02_06">
                                        <i class="fa-duotone fa-circle-check"></i>발송일 미정
                                    </label>
                                </div>
                            </div>
                            <p class="flex gap5 text-guide">
                                <i class="fa-duotone fa-circle-exclamation"></i>발송 마감일은 주문일로부터 +30일로 자동 입력됩니다.
                            </p>
                        </div>
                    </div>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 출고지</p>
                        <div class="input_select">
                            <select class="border_gray" id="policyPlaceNo" name="policyPlaceNo">
                                <option value="20269292">기본출고지</option>
                            </select>
                        </div>
                    </div>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 묶음배송</p>
                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_deli03_02" name="radi_deli03" checked>
                                <label for="radi_deli03_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함(개별배송)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 배송비 선택</p>
                        <div class="input_select">
                            <select class="border_gray">
                                <option value="기본배송비">기본배송비</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 반품/교환
                    </h4>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 반품/교환지</p>
                        <div class="input_select">
                            <select class="border_gray" id="returnAndExchangeAddrNo" name="returnAndExchangeAddrNo">
                                <option value="4966801">기본 반품/교환지</option>
                            </select>
                        </div>
                    </div>


                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 반품/교환 배송비(편도)</p>

                        <div class="flex gap20">
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
                        </div>
                        <br>
                        <div class="input_unit">
                            <input type="text" class="border_gray" value="0">원
                        </div>
                    </div>
                </div>



                <!-- 추가작업필요 -->
                <div class="box">
                    <h4>
                        추가구성
                    </h4>
                    <div class="input_form">
                        <p>추가구성</p>

                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_chuga_01" name="radi_chuga">
                                <label for="radi_chuga_01">
                                    <i class="fa-duotone fa-circle-check"></i>설정함
                                </label>
                            </div>
                            <div class="input_radio">
                                <input type="radio" id="radi_chuga_02" name="radi_chuga" checked>
                                <label for="radi_chuga_02">
                                    <i class="fa-duotone fa-circle-check"></i>설정안함
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box">
                    <h4>
                        <span class="color-blue">(필수)</span> 노출 채널
                    </h4>
                    <div class="input_form">
                        <p><span class="color-blue">(필수)</span> 포털 가격비교 사이트 상품등록</p>

                        <div class="flex gap20">
                            <div class="input_radio">
                                <input type="radio" id="radi_ch_01" name="radi_ch">
                                <label for="radi_ch_01">
                                    <i class="fa-duotone fa-circle-check"></i>등록함
                                </label>
                            </div>


                            <div class="input_radio">
                                <input type="radio" id="radi_ch_02" name="radi_ch" checked>
                                <label for="radi_ch_02">
                                    <i class="fa-duotone fa-circle-check"></i>등록안함
                                </label>
                            </div>
                        </div>

                        <p class="flex gap5 text-guide">
                            <i class="fa-duotone fa-circle-exclamation"></i>등록함으로 설정한 경우, 포털 가격비교 사이트를 통한 주문 발생 시 판매가의 2%가 서비스 이용료로 부과됩니다.
                        </p>
                    </div>

                    <div class="wrap">
                        <div class="input_form">
                            <p><span class="color-blue">(필수)</span> 쿠폰적용</p>

                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon01_01" name="radi_coupon01" checked>
                                    <label for="radi_coupon01_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_coupon01_02" name="radi_coupon01" disabled>
                                    <label for="radi_coupon01_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap">
                        <div class="input_form">
                            <p><span class="color-blue">(필수)</span> 사이트 부담 할인</p>

                            <div class="flex gap20">
                                <div class="input_radio">
                                    <input type="radio" id="radi_discount01_01" name="radi_discount01" disabled>
                                    <label for="radi_discount01_01">
                                        <i class="fa-duotone fa-circle-check"></i>설정함
                                    </label>
                                </div>


                                <div class="input_radio">
                                    <input type="radio" id="radi_discount01_02" name="radi_discount01" checked>
                                    <label for="radi_discount01_02">
                                        <i class="fa-duotone fa-circle-check"></i>설정안함
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!--<div class="box">
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
                </div>-->
            </div>
        </form>

    </div>
</div>


<!--
    스크립트 포함하면 너무 길어서 별도로 분리
    꼼수로 js파일이 아닌 php로 해서 php변수를 넘기기 쉽게 함
-->
<?php echo view('goods/js/goods_js'); ?>
<?php echo view('common/footer'); ?>
