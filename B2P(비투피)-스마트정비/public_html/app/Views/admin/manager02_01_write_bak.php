<?php 
    echo view('common/header_adm'); 
    $pid = "manager02_01_write";
    $header_name = "제품 관리";

?>
<link href="/css/esm_bak.css" rel="stylesheet" type="text/css">
<link href="/css/ext-all-tsp.css" rel="stylesheet" type="text/css">

<script>
    $(document).ready(function() {
        $('.adm_menu > li:nth-child(2)').addClass('active');
    })

</script>


<div id="adm_content">
    <?php echo view('common/admin_menu'); ?>

    <div class="con_wrap">

        <div class="tit_wrap">
            <h6 class="menu01">제품 관리</h6>
            <div class="menu02">
                <a href="./manager02_01_list" class="active">제품 관리</a>
                <a href="./manager02_02_list">재고 관리</a>
            </div>
        </div>

        <div class="write_wrap">
            <div class="top_wrap">
                <h1>제품 등록하기</h1>
                <div class="btn_wrap">
                    <a href="./manager01_01_list" class="btn btn-sm btn-gray">목록</a>
                    <a href="./manager01_01_list" class="btn btn-sm btn-pink">삭제</a>
                    <a href="./manager01_01_list" class="btn btn-sm btn-blue">저장</a>
                </div>
            </div>

            <div class="write_tab_wrap">
                <a class="bttn btn-tab active" data-tab="tab01">기본정보</a>
                <a class="bttn btn-tab" data-tab="tab02">노출정보</a>
                <a class="bttn btn-tab" data-tab="tab03">추가정보</a>
                <a class="bttn btn-tab" data-tab="tab04">고객혜택/광고</a>
            </div>

            <div class="box">

                <div id="tab01" class="tab_con active">


                    <h4>기본정보</h4>
                    <table class="item-group">
                        <colgroup>
                            <col width="150">
                            <col width="*">
                            <col width="150">
                            <col width="357">
                        </colgroup>
                        <tbody>
                            <!---->
                            <tr class="item item_use-market">
                                <th>
                                    <div class="label"><span> 노출 사이트 </span>
                                        <!----> <br>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="use-market">
                                                <div class="market iac">
                                                    <div class="use-market_setting"><em class="market-logo logo-iac"><span>옥션</span></em>
                                                        <div class="use-market_info input_select">

                                                            <select class="border_gray" title="노출여부를 선택해주세요" style="width: 130px;">
                                                                <option value="false">미노출</option>
                                                                <option value="true">노출</option>
                                                            </select>
                                                            <!---->
                                                            <!---->
                                                        </div>
                                                        <div role="dialog" aria-labelledby="approvedStatusAccount" class="l-layer-wrap" style="display: none;"><span class="l-layer-dim"></span>
                                                            <div class="l-layer layer-approved-status-account">
                                                                <div class="l-layer_block">
                                                                    <div class="l-layer_content">
                                                                        <p id="approvedStatusAccount" tabindex="0" class="a11y-hidden">미승인 상태 계정</p>
                                                                        <p class="approved-desc">판매자 ID : 은 미승인 상태의 계정입니다.<br>
                                                                            미승인 상태의 계정으로 상품등록을 하실경우 <strong class="hilite">판매중지</strong> 상태로 등록됩니다.<br>
                                                                            계정 승인이후 판매상태를 변경하세요.
                                                                        </p>
                                                                    </div> <button type="button" onclick="$(this).closest('.l-layer-wrap').hide();" class="l-layer_close_default"><span class="a11y-hidden">닫기</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!---->
                                                    </div>
                                                </div>
                                                <div class="market gmkt">
                                                    <div class="use-market_setting"><em class="market-logo logo-gmkt"><span>지마켓</span></em>
                                                        <div class="use-market_info">
                                                            <div>
                                                                <label class="sale_choice_item"><input type="radio" name="enable-namegmk" value="true">
                                                                    <i class="fa-duotone fa-circle-check"></i>판매가능
                                                                </label>
                                                                <label class="sale_choice_item"><input type="radio" name="enable-namegmk" value="false">
                                                                    <i class="fa-duotone fa-circle-check"></i>판매중지
                                                                </label>
                                                                <span class="use-market_detail">
                                                                    <span class="seller_item seller_id">
                                                                        b2pcorp
                                                                    </span>
                                                                    <span class="seller_item seller_goods_number">
                                                                        3403775115
                                                                        <a class="goods_detail_view" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_new_open.gif" alt="상품 자세히보기"> <span class="dim"></span></a>
                                                                    </span>
                                                                    <!---->
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div role="dialog" aria-labelledby="approvedStatusAccount" class="l-layer-wrap" style="display: none;"><span class="l-layer-dim"></span>
                                                            <div class="l-layer layer-approved-status-account">
                                                                <div class="l-layer_block">
                                                                    <div class="l-layer_content">
                                                                        <p id="approvedStatusAccount" tabindex="0" class="a11y-hidden">미승인 상태 계정</p>
                                                                        <p class="approved-desc">
                                                                            판매자 ID : b2pcorp은 미승인 상태의 계정입니다.<br>
                                                                            미승인 상태의 계정으로 상품등록을 하실경우 <strong class="hilite">판매중지</strong> 상태로 등록됩니다.<br>
                                                                            계정 승인이후 판매상태를 변경하세요.
                                                                        </p>
                                                                    </div> <button type="button" onclick="$(this).closest('.l-layer-wrap').hide();" class="l-layer_close_default"><span class="a11y-hidden">닫기</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!---->
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!---->
                            <tr class="item item item_product-type">
                                <th>
                                    <div class="label"><span> 상품타입 </span>
                                        <!----> <br>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="product-type">
                                                <p class="mb8"><label><input id="rdoGoodsType1" name="goods_type" type="radio" disabled="disabled" class="rdo" value="1">
                                                        <i class="fa-duotone fa-circle-check"></i><strong>일반배송 상품</strong> <span class="small1">- 택배, 우편, 퀵서비스 등 배송이 필요한 상품</span></label></p>
                                                <p><label><input id="rdoGoodsType2" name="goods_type" type="radio" disabled="disabled" class="rdo" value="2"> <strong>E쿠폰 상품 (G마켓 전용)</strong>
                                                        <i class="fa-duotone fa-circle-check"></i><span class="small1">- 모바일쿠폰, 출력쿠폰 등 배송이 필요없는 상품</span></label></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item item_used-goods-status">
                                <th>
                                    <div class="label"><span> 상품상태 </span></div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="goods-status"><label>
                                                    <input type="radio" name="rdoGoodsTypeChoice" class="rdo1">
                                                    <i class="fa-duotone fa-circle-check"></i>
                                                    신상품
                                                </label>
                                                <label>
                                                    <input type="radio" name="rdoGoodsTypeChoice" class="rdo1">
                                                    <i class="fa-duotone fa-circle-check"></i>
                                                    중고품
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item_category">
                                <th>
                                    <div class="label"><span> ESM 카테고리 </span> <em class="required-mark"><span>필수</span></em></div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="goods-category">
                                                <!---->
                                                <div class="market market--esm cols">
                                                    <!----> <em class="market-logo logo-esm"><span>ESM</span></em>
                                                    <div class="market_setting">
                                                        <div class="ui_select">
                                                            <p class="select-category-location">
                                                                <span>자동차용품 &gt; 정비관리용품 &gt; 브레이크</span>
                                                            </p>
                                                            <div class="input_grid2">
                                                                <span class="input_search select_search" disabled="disabled">
                                                                    <input type="text" placeholder="ESM 카테고리명 검색" class="border_gray search_value" disabled="disabled">
                                                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                                                </span>
                                                                <div class="input_select">

                                                                    <select class="border_gray">
                                                                        <option value="최근 카테고리 보기">최근 카테고리 보기</option>
                                                                        <option value="자동차용품 &gt; 정비관리용품 &gt; 브레이크">자동차용품 &gt; 정비관리용품 &gt; 브레이크</option>
                                                                        <option value="자동차용품 &gt; 정비관리용품 &gt; 자동차오일/첨가제 &gt; 엔진오">자동차용품 &gt; 정비관리용품 &gt; 자동차오일/첨가제 &gt; 엔진오</option>
                                                                        <option value="자동차용품 &gt; 정비관리용품 &gt; 와이퍼">자동차용품 &gt; 정비관리용품 &gt; 와이퍼</option>
                                                                        <option value="자동차용품 &gt; 카인테리어용품 &gt; 램프용품 &gt; 자동차램프용품">자동차용품 &gt; 카인테리어용품 &gt; 램프용품 &gt; 자동차램프용품</option>
                                                                        <option value="자동차용품 &gt; 정비관리용품 &gt; 자동차필터 &gt; 자동차에어컨/히터필터">자동차용품 &gt; 정비관리용품 &gt; 자동차필터 &gt; 자동차에어컨/히터필터</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="category_select_group">
                                                            <div class="input_select">

                                                                <select class="border_gray" disabled="disabled">
                                                                    <option disabled="disabled" value="">대분류</option>
                                                                    <option value="">
                                                                        식품
                                                                    </option>
                                                                    <option value="">
                                                                        리빙
                                                                    </option>
                                                                    <option value="">
                                                                        유아동
                                                                    </option>
                                                                    <option value="">
                                                                        뷰티
                                                                    </option>
                                                                    <option value="">
                                                                        의류
                                                                    </option>
                                                                    <option value="">
                                                                        패션잡화
                                                                    </option>
                                                                    <option value="">
                                                                        신발
                                                                    </option>
                                                                    <option value="">
                                                                        가전
                                                                    </option>
                                                                    <option value="">
                                                                        디지털
                                                                    </option>
                                                                    <option value="">
                                                                        컴퓨터
                                                                    </option>
                                                                    <option value="">
                                                                        문구/사무용품
                                                                    </option>
                                                                    <option value="">
                                                                        도서
                                                                    </option>
                                                                    <option value="">
                                                                        음반/DVD
                                                                    </option>
                                                                    <option value="">
                                                                        악기
                                                                    </option>
                                                                    <option value="">
                                                                        수집/종교용품
                                                                    </option>
                                                                    <option value="">
                                                                        광학기기
                                                                    </option>
                                                                    <option value="">
                                                                        원예/꽃배달
                                                                    </option>
                                                                    <option value="">
                                                                        이벤트/파티용품
                                                                    </option>
                                                                    <option value="">
                                                                        여행/티켓/e쿠폰
                                                                    </option>
                                                                    <option value="">
                                                                        반려동물용품
                                                                    </option>
                                                                    <option value="">
                                                                        스포츠/레저용품
                                                                    </option>
                                                                    <option value="">
                                                                        건강의료용품
                                                                    </option>
                                                                    <option value="">
                                                                        공구설비/자재
                                                                    </option>
                                                                    <option value="">
                                                                        자동차용품
                                                                    </option>
                                                                    <option value="">
                                                                        완구
                                                                    </option>
                                                                    <option value="">
                                                                        생활서비스
                                                                    </option>
                                                                    <option value="">
                                                                        홈인테리어/가구
                                                                    </option>
                                                                    <option value="">
                                                                        렌탈
                                                                    </option>
                                                                    <option value="">
                                                                        특판
                                                                    </option>
                                                                    <option value="">
                                                                        중고시장
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="input_select">

                                                                <select class="border_gray" disabled="disabled">
                                                                    <option disabled="disabled" value="">중분류</option>
                                                                    <option value="">
                                                                        타이어/휠
                                                                    </option>
                                                                    <option value="">
                                                                        정비관리용품
                                                                    </option>
                                                                    <option value="">
                                                                        카인테리어용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차안전용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차기기
                                                                    </option>
                                                                    <option value="">
                                                                        세차용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차DIY용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차모바일용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차키용품
                                                                    </option>
                                                                    <option value="">
                                                                        카익스테리어용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="input_select">

                                                                <select class="border_gray" disabled="disabled">
                                                                    <option disabled="disabled" value="">소분류</option>
                                                                    <option value="">
                                                                        자동차오일/첨가제
                                                                    </option>
                                                                    <option value="">
                                                                        부동액
                                                                    </option>
                                                                    <option value="">
                                                                        엔진/흡기부품
                                                                    </option>
                                                                    <option value="">
                                                                        배기부품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차전기/장치
                                                                    </option>
                                                                    <option value="">
                                                                        자동차배터리
                                                                    </option>
                                                                    <option value="">
                                                                        서스펜션
                                                                    </option>
                                                                    <option value="">
                                                                        자동차공구
                                                                    </option>
                                                                    <option value="">
                                                                        와이퍼
                                                                    </option>
                                                                    <option value="">
                                                                        기타자동차관리용품
                                                                    </option>
                                                                    <option value="">
                                                                        자동차필터
                                                                    </option>
                                                                    <option value="">
                                                                        기타자동차튜닝용품
                                                                    </option>
                                                                    <option value="">
                                                                        브레이크
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="input_select">

                                                                <select class="border_gray" disabled="disabled">
                                                                    <option disabled="disabled" value="">세분류</option>
                                                                </select>
                                                            </div>

                                                            <div class="input_select">

                                                                <select class="border_gray" disabled="disabled">
                                                                    <option disabled="disabled" value="">상세분류</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!---->
                                                <div class="market market--gmkt cols"><em class="market-logo logo-gmkt-g9"><span>G마켓</span></em>
                                                    <div class="market_setting">
                                                        <div class="select-category">
                                                            <p class="select-category-location"><span>
                                                                    자동차용품 &gt; 자동차부품/튜닝용품 &gt; 브레이크
                                                                </span></p>
                                                            <div class="ui_select">
                                                                <div class="input_search select_search">
                                                                    <input type="text" disabled="disabled" placeholder="카테고리명 검색" class="border_gray search_value">
                                                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                                                </div>

                                                                <div class="category_select_group">

                                                                    <div class="input_select">

                                                                        <select class="border_gray" disabled="disabled" style="width: 215px;">
                                                                            <option disabled="disabled" value="">대분류</option>
                                                                            <option value="">
                                                                                자동차용품
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input_select">

                                                                        <select class="border_gray" disabled="disabled" style="width: 215px;">
                                                                            <option disabled="disabled" value="">중분류</option>
                                                                            <option value="">
                                                                                자동차부품/튜닝용품
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input_select">

                                                                        <select class="border_gray" disabled="disabled" style="width: 214px;">
                                                                            <option disabled="disabled" value="">소분류</option>
                                                                            <option value="">
                                                                                브레이크
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!---->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="sectionGoodsName" class="item item_goods-name">
                                <th>
                                    <div class="label">
                                        상품명
                                        <em class="required-mark"><span>필수</span></em>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-name">
                                        <p id="goodsNameModifyNotice" class="item-notice" style="display: none;"><span class="alphanumeric">ESM</span> 상품식별코드 등록시,
                                            <strong class="item-notice-point">검색용 상품명</strong> 1회 수정 가능합니다.
                                        </p>
                                        <div class="goods-name-cols">
                                            <div id="divGoodsNames" class="goods-name-area">
                                                <div class="goods-name-item">
                                                    <label for="txtGoodsNameSearch" class="goods-name-subject"><span class="goods-name-text goods-name-text--search">검색용 상품명</span> <em class="required-mark"><span>필수</span></em></label>

                                                    <span class="input_form input_text goods-name-input">
                                                        <input disabled="disabled" id="txtGoodsNameSearch" name="txtGoodsNameSearch" placeholder="검색용 상품명은 검색 대상에 포함되며, 등록 이후 수정 불가" type="text" value="현대 그랜저IG / 국산 전차종 하드론 프리미엄 상신브레이크패드" class="border_gray placeholder-point">
                                                    </span>
                                                    <span class="byte"><span id="spnGoodsNameSearchSize" class="current">60</span>byte</span>

                                                </div>


                                                <div id="promotion-goods-name-common" class="goods-name-item"><label for="txtGoodsNamePrmt" class="goods-name-subject">
                                                        <span class="goods-name-text goods-name-text--promotion">프로모션용 상품명</span>
                                                    </label>

                                                    <div id="promotion-goods-name-common">
                                                        <span class="input_form input_text goods-name-input">
                                                            <input id="txtGoodsNamePrmt" name="txtGoodsNamePrmt" placeholder="프로모션용 상품명은 검색 대상에서 제외되며, 상시 수정 가능" type="text" value="" class="border_gray">
                                                        </span>
                                                        <span class="byte"><span id="spnGoodsNamePrmtSize" class="current">0</span>
                                                            byte
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="notice-caution" style="display:none;">
                                                    <p class="notice-caution-subject"><strong>주의사항 안내</strong></p>
                                                    <div class="notice-caution-content">
                                                        <div class="goods-name-description">
                                                            <ul class="goods-name-notice">
                                                                <li class="goods-name-notice-item">
                                                                    * 구매자에게
                                                                    <strong class="goods-name-notice-point"><span class="alphanumeric">ESM</span> 브랜드명 + 검색용 상품명 + 프로모션용 상품명
                                                                    </strong> 순으로 노출됩니다.
                                                                </li>
                                                                <li class="goods-name-notice-item">
                                                                    * 검색용 + 프로모션용 최대
                                                                    <strong class="goods-name-notice-point"><span name="spanGoodsNameMaxSize" class="alphanumeric">100byte</span>까지 입력 가능
                                                                    </strong>하며,
                                                                    <span class="alphanumeric">ESM</span>브랜드는 입력 글자 수 제한에 미포함 됩니다.
                                                                </li>
                                                                <li class="goods-name-notice-item"><strong class="goods-name-notice-point point-more">* 검색용은 검색대상에 포함되며 수정 불가합니다. 프로모션용은 검색대상에서 제외되며 수정 가능합니다.</strong> <br> (단, 등록후
                                                                    <span class="alphanumeric">10</span>일 이내
                                                                    <span class="alphanumeric">and</span> 판매이력이 없을 경우 예외적으로 검색용 수정이 가능합니다.)
                                                                </li>
                                                            </ul>
                                                            <div class="goods-name-detail">
                                                                <table summary="검색용, 프로모션용 상품명 상세 안내 입니다. 각 항목은 검색용/프로모션용 필수, 등록 후 수정, 검색대상, 길이로 구분됩니다.">
                                                                    <caption>검색용, 프로모션용 상품명 상세 안내</caption>
                                                                    <colgroup>
                                                                        <col style="width: 66px;">
                                                                        <col style="width: 34px;">
                                                                        <col style="width: 73px;">
                                                                        <col style="width: 56px;">
                                                                        <col>
                                                                    </colgroup>
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col"></th>
                                                                            <th scope="col">필수</th>
                                                                            <th scope="col">등록 후 수정</th>
                                                                            <th scope="col">검색대상</th>
                                                                            <th scope="col">길이</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">검색용</th>
                                                                            <td><strong class="goods-name-detail-point">O</strong></td>
                                                                            <td><strong class="goods-name-detail-point">X</strong></td>
                                                                            <td><strong class="goods-name-detail-point">O</strong></td>
                                                                            <td rowspan="2">
                                                                                <p class="total-byte">
                                                                                    총합
                                                                                    <br> <strong name="strongGoodsNameMaxSize" class="goods-name-detail-point alphanumeric">100byte</strong>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">프로모션용</th>
                                                                            <td>X</td>
                                                                            <td>O</td>
                                                                            <td>X</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="divGMKTGoodsNameEtc" class="goods-name-cols">
                                            <div class="global-name-area">
                                                <div class="global-name-intro"><em class="market-logo logo-gmkt"><span>G마켓</span></em>
                                                    다국어 상품명
                                                </div>
                                                <div class="goods-name-item"><label for="txtGoodsNameEng" class="goods-name-subject">영문<span class="alphanumeric">(English)</span> 상품명</label> <span class="input_form input_text goods-name-input"><input id="txtGoodsNameEng2" name="txtGoodsNameEng2" type="text" value="Hyundai/Korean/For All Model Types/Premium" class="border_gray"></span> <span class="byte"><span id="spnGoodsNameEngSize" class="current">42</span>/100byte
                                                    </span>
                                                </div>
                                                <div class="goods-name-item"><label for="txtGoodsNameChn" class="goods-name-subject">중문<span class="alphanumeric">(中文)</span> 상품명</label> <span class="input_form input_text goods-name-input"><input id="txtGoodsNameChn2" name="txtGoodsNameChn2" type="text" value="现代/韩国产/各种车/Premium" class="border_gray txt"></span> <span class="byte"><span id="spnGoodsNameChnSize" class="current">26</span>/100byte
                                                    </span></div>
                                                <div class="goods-name-item"><label for="searchForJpn" class="goods-name-subject">일문<span class="alphanumeric">(日文)</span> 상품명</label> <span class="input_form input_text goods-name-input"><input id="txtGoodsNameJpn2" name="txtGoodsNameJpn2" type="text" value="Hyundai/韓国産/全車種/プレミアム" class="border_gray txt"></span> <span class="byte"><span id="spnGoodsNameJpnSize" class="current">32</span>/100byte
                                                    </span></div>
                                                <p class="global-name-notice">* 다국어 상품명은 검색용, 프로모션용 상품명 구분없이 <span class="alphanumeric">100byte</span>까지 입력가능 합니다.</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!---->
                            <tr class="item item_goods-price">
                                <th>
                                    <div class="label"><span> 판매가격 </span> <em class="required-mark"><span>필수</span></em> <br> </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="goods-price">
                                                <div class="goods-price_type">
                                                    <!---->
                                                    <!---->
                                                    <div class="goods-price_block">
                                                        <div class="flex gap5 input_text goods-price_write">
                                                            <input name="txtGoodsPrice" type="text" disabled="disabled" value="32,300" class="border_gray">
                                                            <span class="goods-price_unit">원</span>
                                                            <span class="goods-price_unit-current">(<span>삼<b>만</b> 이천 삼백 원</span>)</span>
                                                            <!---->
                                                            <!---->
                                                            <!---->
                                                        </div>
                                                        <!---->
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                    <!---->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!---->
                            <tr class="item item_order-option">
                                <th>
                                    <div class="label"><span> 주문옵션 </span>
                                        <!----> <br>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="order-option">
                                                <div class="option_check">
                                                    <label class="input_radio option_check-item">
                                                        <input name="optionsUseSetting" type="radio" value="false">
                                                        <i class="fa-duotone fa-circle-check"></i>
                                                        주문옵션을 사용하지 않습니다.
                                                    </label>
                                                    <label class="input_radio option_check-item"><input name="optionsUseSetting" type="radio" value="true">
                                                        <i class="fa-duotone fa-circle-check"></i>
                                                        주문옵션을 사용해야합니다.
                                                    </label>
                                                </div>
                                                <div class="option_setting">
                                                    <div class="option_setting-header option_setting-header--default" use-option="true" style="z-index: 9;">
                                                        <div class="option_setting-header__controls">


                                                            <div class="input_select">

                                                                <select class="border_gray" title="주문옵션 항목1">
                                                                    <option value="">주문옵션 항목1</option>
                                                                    <option value="선택형">선택형</option>
                                                                    <option value="2개조합형">2개조합형</option>
                                                                    <option value="3개조합형">3개조합형</option>
                                                                    <option value="텍스트형">텍스트형</option>
                                                                </select>
                                                            </div>


                                                            <div class="input_select">

                                                                <select class="border_gray" title="주문옵션 항목2">
                                                                    <option value="선택안함">
                                                                        선택안함
                                                                    </option>
                                                                </select>
                                                            </div>

                                                            <div class="option_setting-header__util"><button type="button" class="bttn btn-sm btn-black button-normal button-normal--darkgray">항목선택</button></div>
                                                        </div>
                                                        <div class="option_setting-header__util" style="margin-left: 8px;"><button type="button" class="bttn btn-sm btn-green button-normal button-normal--lightgray button-excel-upload">
                                                                엑셀일괄등록
                                                            </button>
                                                            <!---->
                                                        </div>
                                                    </div>
                                                    <div class="option_setting-container" style="z-index: 8;">
                                                        <div class="add-item" style="z-index: 249;">
                                                            <div class="add-item__defalut">
                                                                <p class="option_search__select">선택형</p>
                                                                <p class="defalut-message">옵션명 추가는 +를 클릭하세요.</p>
                                                            </div>
                                                            <div class="add-item__options">
                                                                <div class="option_search"><select class="border_gray" title="옵션 선택" class="option_search__select">
                                                                        <option value="">옵션선택</option>
                                                                        <option value="">
                                                                            장착유형
                                                                        </option>
                                                                        <option class="option-direct-input" value="direct">
                                                                            직접입력
                                                                        </option>
                                                                    </select>
                                                                    <div class="option_search__direct" style="display: none;"><input type="text" title="옵션명 직접입력" placeholder="옵션명을 입력해주세요"> <button type="button" class="button-normal button-normal--blue">추천</button></div>
                                                                </div>
                                                                <!---->
                                                                <div class="option_search-controls">
                                                                    <div class="controls-option-group"><button type="button" class="btn-controls-option btn-controls-option--add"><span class="hidden">추가</span></button>
                                                                        <!---->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!---->
                                                        </div>
                                                        <!---->
                                                        <!---->
                                                        <!---->
                                                        <!---->
                                                        <!---->
                                                    </div>
                                                    <div class="option_setting-container" style="z-index: 7;">
                                                        <!---->
                                                        <!---->
                                                        <!---->
                                                        <div class="add-item" style="z-index: 170;">
                                                            <div class="add-item__defalut">
                                                                <p class="option_search__select">텍스트형</p>
                                                                <p class="defalut-message">옵션명 추가는 +를 클릭하세요.</p>
                                                            </div>
                                                            <div class="add-item__options">
                                                                <div class="option_search"><select class="border_gray" title="옵션 선택" class="option_search__select">
                                                                        <option value="">옵션 선택</option>
                                                                        <option value="">
                                                                            고객정보입력
                                                                        </option>
                                                                        <option class="option-direct-input" value="direct">
                                                                            직접입력
                                                                        </option>
                                                                    </select>
                                                                    <div class="option_search__direct" style="display: none;"><input type="text" title="옵션명 직접입력" placeholder="옵션명을 입력해주세요"> <button type="button" class="button-normal button-normal--blue">추천</button></div>
                                                                </div>
                                                                <div class="option_search-controls">
                                                                    <div class="controls-option-group"><button type="button" class="btn-controls-option btn-controls-option--add"><span class="hidden">추가</span></button>
                                                                        <!---->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!---->
                                                        <div class="add-group"><span class="add-group__desc">* 옵션값 입력 후 <strong>‘저장’</strong> 버튼을 통해 변경 사항을 그리드에 반영해주세요.</span> <button type="button" id="btnOptionsAdd" title="주문옵션 추가 저장하기" class="btn-css btn-height21 darkgray btn-add-option"><span class="btn-inner">저장</span></button></div>
                                                    </div> <button type="button" class="btn-option-modify">
                                                        옵션값 수정
                                                    </button>
                                                    <div class="option_setting-header" style="display: block;"><button type="button" data-slide="set-options" class="btn-set-option btn-set-option-modify">
                                                            일괄수정
                                                        </button>
                                                        <div class="option_setting-util">
                                                            <div class="util-item"><label><input type="checkbox">
                                                                    재고수량 설정</label> <a href="#" onclick="$(this).closest('.util-item').find('.l-layer').show(); return false;"><img src="//pics.esmplus.com//front/sell/ico_guide.gif" alt="자세히 보기"></a>
                                                                <div class="l-layer layer-stock">
                                                                    <div class="l-layer_block">
                                                                        <div class="l-layer_header">재고수량 설정안내</div>
                                                                        <div class="l-layer_content">
                                                                            <p class="stock-text"><strong class="hilite">옵션별로 재고를 각각 설정</strong>하고 싶은 경우 <br>
                                                                                재고수량 설정을 체크해서 각 재고를 설정해주시기 바랍니다.
                                                                            </p>
                                                                            <p class="stock-text">
                                                                                가격이 0원인 선택정보는 1개이상 재고가 있어야합니다. <br>(가격이 0원인 선택정보가 모두수량이 0이 되면
                                                                                본 상품이 <br>
                                                                                자동으로 품절처리가 됩니다.)
                                                                            </p>
                                                                        </div> <a href="#" onclick="$(this).closest('.l-layer').hide(); return false;" class="l-layer_close"><img src="//pics.esmplus.com/front/btn/btn_layer_close2.gif" alt="닫기"></a> <span class="l-layer_arrow-up" style="left: 73px;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="util-item util-global-item is-active"><em class="market-logo logo-gmkt"><span>G마켓 전용</span></em> <label><input type="checkbox" name="ckbOptionsSetLang">
                                                                    영/중/일문 설정</label> <a href="#" onclick="$(this).closest('.util-item').find('.l-layer.layer-global').show(); return false;"><img src="//pics.esmplus.com/front/sell/ico_guide.gif" alt="자세히 보기"></a>
                                                                <div class="l-layer layer-global">
                                                                    <div class="l-layer_block">
                                                                        <div class="l-layer_header">영/중/일문 설정</div>
                                                                        <div class="l-layer_content">
                                                                            <p class="global-text">
                                                                                G마켓을 통안 해외판매시, 편리한 판매활동에 도움을드리고자 영/중/일문 상품상세 입력이
                                                                                <br>가능해 졌습니다.
                                                                            </p>
                                                                            <p class="global-text">
                                                                                이와 더불어, 영/중/일문 상품상세에 기재된 옵션명/값과 동일한 옵션명/값을 등록하면 해당
                                                                                <br>언어별 사이트에 상품상세와 함께 노출됩니다.
                                                                            </p>
                                                                            <div class="global-info">
                                                                                <p class="global-info-notice"><strong>영/중/일문 옵션명/값 입력 시 주의사항!</strong></p>
                                                                                <ul class="item_module-list">
                                                                                    <li>
                                                                                        숫자, 영어를 구성하여 사용하길 추천 드립니다. (예:
                                                                                        <span class="ls0">A001, A002, A003...</span>)
                                                                                    </li>
                                                                                    <li>중문 옵션에는 중국어, 일문 옵션에는 일본어(히라가나,가타카나) 사용이 가능합니다.</li>
                                                                                    <li>
                                                                                        추천옵션을 사용한 경우, 영/중/일문으로 자동 번역되어 노출됩니다. <br>단, 직접입력한 값은 자동번역
                                                                                        되지 않습니다.
                                                                                    </li>
                                                                                    <li>입력한 영/중/일문 옵션은, 영/중/일문 상품상세를 입력하셔야 노출됩니다.</li>
                                                                                    <li>영/중/일문 상품상세를 입력하고, 옵션명을 따로 입력하지 않으면 국문명이 노출됩니다.</li>
                                                                                </ul>
                                                                            </div>
                                                                            <p>
                                                                                영/중/일문 옵션명은 해당 언어별 G마켓 글로벌 사이트에 노출되어, 외국인 고객의 구매에
                                                                                <br>도움이 되어 매출을 높일 수 있습니다.
                                                                            </p>
                                                                            <div class="global-btns"><a href="http://global.gmarket.co.kr/Home/GlobalGate?nation=EN" target="_blank" class="item_button"><span>영문사이트 확인하기</span></a> <a href="http://global.gmarket.co.kr/Home/GlobalGate?nation=CN" target="_blank" class="item_button"><span>중문사이트 확인하기</span></a> <a href="http://global.gmarket.co.kr/Home/GlobalGate?nation=JP" target="_blank" class="item_button"><span>일문사이트 확인하기</span></a></div>
                                                                        </div> <a href="#" onclick="$(this).closest('.l-layer').hide(); return false;" class="l-layer_close"><img src="//pics.esmplus.com/front/btn/btn_layer_close2.gif" alt="닫기"></a> <span class="l-layer_arrow-up" style="left: 83px;"></span>
                                                                    </div>
                                                                </div>
                                                                <!---->
                                                            </div> <a class="button-normal button-normal--lightgray button-download">등록된 정보 다운로드</a>
                                                        </div>
                                                    </div>
                                                    <div class="option_setting-modify"><label name="lbOptionsSoldOutIs" class="modify-item"><span class="modify-item-title">상태</span> <select class="border_gray" style="width: 65px;">
                                                                <option value="">-</option>
                                                                <option value="0">정상</option>
                                                                <option value="1">품절</option>
                                                            </select></label> <label name="lbOptionsDisplayIs" class="modify-item"><span class="modify-item-title">노출여부</span> <select class="border_gray" style="width: 65px;">
                                                                <option value="">-</option>
                                                                <option value="true">노출</option>
                                                                <option value="false">미노출</option>
                                                            </select></label> <label name="lbOptionManageCode" class="modify-item"><span class="modify-item-title">관리코드</span> <input type="text" style="width: 145px;"></label> <label class="modify-item"><span class="modify-item-title">추가금액</span> <input type="text" style="width: 115px;"></label>
                                                        <!----> <button type="button" title="주문옵션 저장하기" class="btn-css btn-height21 darkgray btn-modify"><span class="btn-inner">일괄수정 하기</span></button>
                                                    </div>
                                                    <div class="option_setting-grid">
                                                        <div class="grid-util">
                                                            <div class="grid-util__left"><span class="item-text"><label><input type="radio" name="radioOptionsUse" value="true"> 선택형</label> <label><input type="radio" name="radioOptionsUse" value="false"> 미사용</label></span></div>
                                                            <div class="grid-util__right"><a class="button-normal button-normal--gray"> 옵션 이미지 등록 </a>
                                                                <div class="tooltip"><i class="tooltip__icon"><span class="blind">옵션 대표이미지 안내</span></i>
                                                                    <p class="tooltip__text">
                                                                        2.0 주문옵션 대표 이미지 등록/수정 기능은 서비스 준비중입니다. 1.0 에서 등록한 옵션별 대표 이미지가
                                                                        옥션/G마켓 상세 페이지에서 노출될 수 있도록 서비스 개선 작업중입니다.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="grid-wrap">
                                                            <div style="position: relative;">
                                                                <div>
                                                                    <!---->
                                                                    <div id="gridListSelectOrCombi" class="grid">
                                                                        <div id="optionGridSelectOrCombi" class="x-panel x-grid-with-col-lines x-grid-with-row-lines x-panel-default x-grid" style="height:300px;">
                                                                            <div id="headercontainer-1013" class="x-grid-header-ct x-docked x-grid-header-ct-default x-docked-top x-grid-header-ct-docked-top x-grid-header-ct-default-docked-top x-box-layout-ct" style="border-width: 1px; width: 821px; left: 0px; top: 0px;">
                                                                                <div id="headercontainer-1013-innerCt" class="x-box-inner " role="presentation" style="width: 838px; height: 28px;">
                                                                                    <div id="headercontainer-1013-targetEl" style="position:absolute;width:20000px;left:0px;top:0px;height:1px">
                                                                                        <div id="gridcolumn-1045" class="x-unselectable x-column-header-checkbox x-column-header-align-left x-box-item x-column-header x-unselectable-default x-column-header-first" style="border-width: 1px; width: 24px; height: auto; left: 0px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1045-titleEl" class="x-column-header-inner" style="height: auto; padding-top: 5px;"><span id="gridcolumn-1045-textEl" class="x-column-header-text">&nbsp;</span></div>
                                                                                            <div id="gridcolumn-1045-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="rownumberer-1037" class="x-unselectable x-row-numberer x-column-header-align-center x-box-item x-column-header x-unselectable-default" style="border-width: 1px; width: 40px; height: auto; left: 24px; margin: 0px; top: 0px;">
                                                                                            <div id="rownumberer-1037-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="rownumberer-1037-textEl" class="x-column-header-text">No</span></div>
                                                                                            <div id="rownumberer-1037-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1038" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 80px; height: auto; left: 64px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1038-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1038-textEl" class="x-column-header-text">이미지</span></div>
                                                                                            <div id="gridcolumn-1038-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1039" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 130px; height: auto; left: 144px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1039-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1039-textEl" class="x-column-header-text">옵션명</span></div>
                                                                                            <div id="gridcolumn-1039-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1040" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 130px; height: auto; left: 274px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1040-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1040-textEl" class="x-column-header-text">옵션값</span></div>
                                                                                            <div id="gridcolumn-1040-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1041" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 80px; height: auto; left: 404px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1041-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1041-textEl" class="x-column-header-text">상태</span></div>
                                                                                            <div id="gridcolumn-1041-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1042" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 80px; height: auto; left: 484px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1042-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1042-textEl" class="x-column-header-text">노출여부</span></div>
                                                                                            <div id="gridcolumn-1042-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1043" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 129px; height: auto; left: 564px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1043-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1043-textEl" class="x-column-header-text">추가금</span></div>
                                                                                            <div id="gridcolumn-1043-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1044" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-last" style="border-width: 1px; width: 128px; height: auto; left: 693px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1044-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1044-textEl" class="x-column-header-text">관리코드</span></div>
                                                                                            <div id="gridcolumn-1044-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="optionGridSelectOrCombi-body" class="x-panel-body x-grid-body x-panel-body-default x-panel-body-default x-layout-fit" style="left: 0px; height: 273px; top: 27px; width: 821px;">
                                                                                <div id="gridview-1020" class="x-grid-view x-fit-item x-grid-view-default x-unselectable" style="overflow: auto; margin: 0px; width: 821px; height: 273px;" tabindex="-1">
                                                                                    <table class="x-grid-table x-grid-table-resizer" border="0" cellspacing="0" cellpadding="0" style="width:821px;">
                                                                                        <tbody>
                                                                                            <tr class="x-grid-header-row">
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1045" style="width: 24px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-rownumberer-1037" style="width: 40px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1038" style="width: 80px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1039" style="width: 130px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1040" style="width: 130px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1041" style="width: 80px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1042" style="width: 80px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1043" style="width: 129px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1044" style="width: 128px; height: 0px;"></th>
                                                                                            </tr>
                                                                                            <tr class="x-grid-row optionGridRow">
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1045  x-grid-cell-special x-grid-cell-row-checker x-grid-cell-first">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: left; ;">
                                                                                                        <div class="x-grid-row-checker">&nbsp;</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-rownumberer-1037  x-grid-cell-special ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">1</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1038   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">미등록</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1039   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>앞/뒤</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1040   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>앞 / 전차량 공용 / HP1986</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1041   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">정상</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1042   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">노출</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1043   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">0</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1044   x-grid-cell-last">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">CTK10-001A010</div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="x-grid-row optionGridRow x-grid-row-alt">
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1045  x-grid-cell-special x-grid-cell-row-checker x-grid-cell-first">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: left; ;">
                                                                                                        <div class="x-grid-row-checker">&nbsp;</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-rownumberer-1037  x-grid-cell-special ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">2</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1038   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">미등록</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1039   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>앞/뒤</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1040   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>뒤 / 풋파킹 전용 / HP1987</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1041   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">정상</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1042   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">노출</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1043   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-9,220</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1044   x-grid-cell-last">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">CTK10-001A011</div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="x-grid-row optionGridRow">
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1045  x-grid-cell-special x-grid-cell-row-checker x-grid-cell-first">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: left; ;">
                                                                                                        <div class="x-grid-row-checker">&nbsp;</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-rownumberer-1037  x-grid-cell-special ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">3</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1038   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">미등록</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1039   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>앞/뒤</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1040   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>뒤 / 전자파킹 전용 / HP1846</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1041   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">정상</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1042   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">노출</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1043   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-9,220</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1044   x-grid-cell-last">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">CTK10-001A012</div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr class="x-grid-row optionGridRow x-grid-row-alt">
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1045  x-grid-cell-special x-grid-cell-row-checker x-grid-cell-first">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: left; ;">
                                                                                                        <div class="x-grid-row-checker">&nbsp;</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-rownumberer-1037  x-grid-cell-special ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">4</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1038   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">미등록</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1039   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>장착유형</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1040   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>자택수령</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1041   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">정상</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1042   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">노출</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1043   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1044   x-grid-cell-last">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-</div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!---->
                                                            <div class="item-more"><a class="btn-item-more">
                                                                    옵션값 리스트 펼치기
                                                                </a></div>
                                                        </div>
                                                        <div class="grid-util grid-util--space-between">
                                                            <div class="grid-util__left"><a title="상품 삭제" class="item_button btn-item-delete"><span>삭제</span></a> <select class="border_gray" title="정렬순서를 선택해주세요" class="item-sorting">
                                                                    <option selected="selected">정렬순서변경</option>
                                                                    <option value="0">유형별 오름차순</option>
                                                                    <option value="1">텍스트 오름차순</option>
                                                                </select> <span class="item-change-order"><a direction="top" class="btn-change-order"><span data-value="up-top">처음 상단으로 이동</span></a> <a direction="prev" class="btn-change-order btn-change-order-prev"><span data-value="up">상단으로 이동</span></a> <a direction="next" class="btn-change-order btn-change-order-next"><span data-value="down">하단으로 이동</span></a> <a direction="bottom" class="btn-change-order btn-change-order-end"><span data-value="down-bottom">마지막 하단으로 이동</span></a></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="option_setting-grid">
                                                        <div class="grid-util">
                                                            <div class="grid-util__left"><span class="item-text"><label><input type="radio" name="radioOptionsTextUse" value="true"> 텍스트형</label> <label><input type="radio" name="radioOptionsTextUse" value="false"> 미사용</label></span></div>
                                                        </div>
                                                        <div class="grid-wrap">
                                                            <div style="position: relative;">
                                                                <div>
                                                                    <!---->
                                                                    <div id="gridListText" class="grid">
                                                                        <div id="optionGridText" class="x-panel x-grid-with-col-lines x-grid-with-row-lines x-panel-default x-grid" style="height:300px;">
                                                                            <div id="headercontainer-1024" class="x-grid-header-ct x-docked x-grid-header-ct-default x-docked-top x-grid-header-ct-docked-top x-grid-header-ct-default-docked-top x-box-layout-ct" style="border-width: 1px; width: 821px; left: 0px; top: 0px;">
                                                                                <div id="headercontainer-1024-innerCt" class="x-box-inner " role="presentation" style="width: 838px; height: 28px;">
                                                                                    <div id="headercontainer-1024-targetEl" style="position:absolute;width:20000px;left:0px;top:0px;height:1px">
                                                                                        <div id="gridcolumn-1054" class="x-unselectable x-column-header-checkbox x-column-header-align-left x-box-item x-column-header x-unselectable-default x-column-header-first" style="border-width: 1px; width: 24px; height: auto; left: 0px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1054-titleEl" class="x-column-header-inner" style="height: auto; padding-top: 5px;"><span id="gridcolumn-1054-textEl" class="x-column-header-text">&nbsp;</span></div>
                                                                                            <div id="gridcolumn-1054-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="rownumberer-1047" class="x-unselectable x-row-numberer x-column-header-align-center x-box-item x-column-header x-unselectable-default" style="border-width: 1px; width: 40px; height: auto; left: 24px; margin: 0px; top: 0px;">
                                                                                            <div id="rownumberer-1047-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="rownumberer-1047-textEl" class="x-column-header-text">No</span></div>
                                                                                            <div id="rownumberer-1047-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1048" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 130px; height: auto; left: 64px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1048-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1048-textEl" class="x-column-header-text">옵션명</span></div>
                                                                                            <div id="gridcolumn-1048-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1049" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 130px; height: auto; left: 194px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1049-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1049-textEl" class="x-column-header-text">옵션값</span></div>
                                                                                            <div id="gridcolumn-1049-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1050" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 80px; height: auto; left: 324px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1050-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1050-textEl" class="x-column-header-text">상태</span></div>
                                                                                            <div id="gridcolumn-1050-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1051" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 80px; height: auto; left: 404px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1051-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1051-textEl" class="x-column-header-text">노출여부</span></div>
                                                                                            <div id="gridcolumn-1051-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1052" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-sort-null" style="border-width: 1px; width: 169px; height: auto; left: 484px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1052-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1052-textEl" class="x-column-header-text">추가금</span></div>
                                                                                            <div id="gridcolumn-1052-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                        <div id="gridcolumn-1053" class="x-unselectable x-column-header-align-center x-box-item x-column-header x-unselectable-default x-column-header-sort-undefined x-column-header-last" style="border-width: 1px; width: 168px; height: auto; left: 653px; margin: 0px; top: 0px;">
                                                                                            <div id="gridcolumn-1053-titleEl" class="x-column-header-inner" style="height: 28px; padding-top: 8px;"><span id="gridcolumn-1053-textEl" class="x-column-header-text">관리코드</span></div>
                                                                                            <div id="gridcolumn-1053-clearEl" class="x-clear" role="presentation"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="optionGridText-body" class="x-panel-body x-grid-body x-panel-body-default x-panel-body-default x-layout-fit" style="left: 0px; height: 273px; top: 27px; width: 821px;">
                                                                                <div id="gridview-1030" class="x-grid-view x-fit-item x-grid-view-default x-unselectable" style="overflow: auto; margin: 0px; width: 821px; height: 273px;" tabindex="-1">
                                                                                    <table class="x-grid-table x-grid-table-resizer" border="0" cellspacing="0" cellpadding="0" style="width:821px;">
                                                                                        <tbody>
                                                                                            <tr class="x-grid-header-row">
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1054" style="width: 24px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-rownumberer-1047" style="width: 40px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1048" style="width: 130px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1049" style="width: 130px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1050" style="width: 80px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1051" style="width: 80px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1052" style="width: 169px; height: 0px;"></th>
                                                                                                <th class="x-grid-col-resizer-gridcolumn-1053" style="width: 168px; height: 0px;"></th>
                                                                                            </tr>
                                                                                            <tr class="x-grid-row optionGridRow">
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1054  x-grid-cell-special x-grid-cell-row-checker x-grid-cell-first">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: left; ;">
                                                                                                        <div class="x-grid-row-checker">&nbsp;</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-rownumberer-1047  x-grid-cell-special ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">1</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1048   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">
                                                                                                        <div>차량번호 차대번호</div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1049   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">(텍스트형)</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1050   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1051   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">노출</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1052   ">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-</div>
                                                                                                </td>
                                                                                                <td class=" x-grid-cell x-grid-cell-gridcolumn-1053   x-grid-cell-last">
                                                                                                    <div class="x-grid-cell-inner " style="text-align: center; ;">-</div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-more"><a class="btn-item-more">
                                                                    옵션값 리스트 펼치기
                                                                </a></div>
                                                        </div>
                                                        <div class="grid-util grid-util--space-between">
                                                            <div class="grid-util__left"><a title="상품 삭제" class="item_button btn-item-delete"><span>삭제</span></a> <select class="border_gray" title="정렬순서를 선택해주세요" class="item-sorting">
                                                                    <option selected="selected">정렬순서변경</option>
                                                                    <option value="0">유형별 오름차순</option>
                                                                    <option value="1">텍스트 오름차순</option>
                                                                </select> <span class="item-change-order"><a direction="top" class="btn-change-order"><span data-value="up-top">처음 상단으로 이동</span></a> <a direction="prev" class="btn-change-order btn-change-order-prev"><span data-value="up">상단으로 이동</span></a> <a direction="next" class="btn-change-order btn-change-order-next"><span data-value="down">하단으로 이동</span></a> <a direction="bottom" class="btn-change-order btn-change-order-end"><span data-value="down-bottom">마지막 하단으로 이동</span></a></span></div>
                                                        </div>
                                                    </div>
                                                    <!---->
                                                </div>
                                                <ul class="option_setting-notice" style="display: block;">
                                                    <!---->
                                                    <li class="option_setting-notice__item">
                                                        G마켓 복수구매할인(구매수량별 무료제공)과 주문옵션은 함께 사용이 불가합니다.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item_additions" style="display:none;">
                                <th>
                                    <div class="label"><span> 추가구성 </span>
                                        <!----> <br>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="additions">
                                                <div class="additions-check"><a href="//pics.esmplus.com/front/Manual/SellerGuide2/additions.html" target="_blank" class="button-guide">추가구성 가이드</a> <label class="additions-check-item"><input name="additionsUseSetting" type="radio" value="false">
                                                        추가구성을 사용하지 않습니다.</label> <label class="additions-check-item"><input name="additionsUseSetting" type="radio" value="true">
                                                        추가구성을 사용해야합니다.</label>
                                                    <!---->
                                                </div>
                                                <div class="additions-content">
                                                    <div class="content-add">
                                                        <div class="options-set-controls"><select class="border_gray" title="추가구성 옵션">
                                                                <option disabled="disabled" selected="selected" value="">추가구성 항목</option>
                                                                <option value="">
                                                                    항목명 직접입력
                                                                </option>
                                                            </select> <button type="button" class="button-normal button-options-add"><span class="icon-plus"></span>추가
                                                            </button> <span class="options-tip">* 사용할 항목을 선택 후 추가 버튼을 누르세요.
                                                                <strong class="hilite">(최대 <span class="num">5</span>개까지 선택가능)</strong></span></div>
                                                        <div class="options-set-btns"><button type="button" title="추가구성 저장" class="btn-css btn-height21 darkgray"><span class="btn-inner">저장</span></button></div>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item_stock-quantity" style="display:none;">
                                <th>
                                    <div class="label"><span> 재고수량 </span>
                                        <!----> <br>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div style="position: relative;">
                                        <div>
                                            <!---->
                                            <div class="stock-quantity">
                                                <div class="stock-quantity_inner">
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                    <!---->
                                                </div>
                                                <div class="stock-quantity_options">
                                                    <!---->
                                                    <!----> <span class="stock-quantity_options_tip">* 주문옵션 사용 시, 옵션 영역에서 재고 관리 가능합니다.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>

                <div id="tab02" class="tab_con">
                    <h4>노출정보</h4>
                    <table class="item-group">
                        <colgroup>
                            <col width="150">
                            <col width="*">
                            <col width="150">
                            <col width="357">
                        </colgroup>
                        <tbody>
                            <tr id="sectionGoodsImage" class="item item_goods-image">
                                <th>
                                    <div class="label">상품이미지<em class="required-mark"><span>필수</span></em></div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-image">
                                        <div id="divImgUploader">
                                            <input type="hidden" id="hdnImageUploadRegMarketType" value="2">
                                            <div id="hdivImageFiles" style="display: none;"></div>
                                            <input type="hidden" id="addImageSite" value="0">
                                            <div class="goods-image_info">
                                                <ul class="guide_list">
                                                    <li>
                                                        * 사이즈
                                                        <span class="ls0">1000x1000</span> 이상 /
                                                        <span class="ls0">2MB</span>이하 /
                                                        <span class="ls0">jpg, png</span>만 등록 가능합니다.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="s_img_registration">
                                                <ul id="ulImageArea" class="s_img_area is-active">
                                                    <li imagetype="primary" index="0" class="ibox fir on">
                                                        <p class="title"><span><strong>기본</strong>이미지</span>
                                                            <img src="https://pics.esmplus.com/front/icon/icon_compulsory.gif" alt="필수" class="ico">
                                                        </p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_iac"><br> <br> <br>
                                                                    <span class="size">1000*1000</span> <br> <span class="req">[필수등록]</span></span> <span id="notification" class="txt_over"><span class="size"></span>
                                                                    사이즈 1000x1000 이상
                                                                    <br> 2MB 이하 jpg, png만
                                                                    <br> 등록 가능합니다.
                                                                </span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span commitedurl="http%3a%2f%2fgdimg.gmarket.co.kr%2f3153099695%2fSTILL%2f600%3ftcache%3d638496544669541444" imagetype="primary" index="0" cmd="0" class="img"><img id="basicImage" src="http://gdimg.gmarket.co.kr/3153099695/STILL/600?tcache=638496544669541444" class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="0" class="ibox on">
                                                        <p class="title"><span>추가이미지1</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over">
                                                                    <span class="size"></span>
                                                                    사이즈 1000x1000 이상
                                                                    <br> 2MB 이하 jpg, png만
                                                                    <br> 등록 가능합니다.
                                                                </span>
                                                                <span class="reg_btn_full">
                                                                    <input type="file" name="btnSelectFile" cmd="reg" class="reg_file">
                                                                </span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span commitedurl="http%3a%2f%2fgdimg1.gmarket.co.kr%2fgoods_image2%2fexlarge_moreimg%2f315%2f309%2f3153099695%2f3153099695_00.jpg%3ftcache%3d638496544669541444" imagetype="additional" index="0" cmd="0" class="img"><img src="http://gdimg1.gmarket.co.kr/goods_image2/exlarge_moreimg/315/309/3153099695/3153099695_00.jpg?tcache=638496544669541444" class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="1" class="ibox on">
                                                        <p class="title"><span>추가이미지2</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over">
                                                                    <span class="size"></span>
                                                                    사이즈 1000x1000 이상
                                                                    <br> 2MB 이하 jpg, png만
                                                                    <br> 등록 가능합니다.
                                                                </span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span commitedurl="http%3a%2f%2fgdimg1.gmarket.co.kr%2fgoods_image2%2fexlarge_moreimg%2f315%2f309%2f3153099695%2f3153099695_01.jpg%3ftcache%3d638496544669541444" imagetype="additional" index="1" cmd="0" class="img"><img src="http://gdimg1.gmarket.co.kr/goods_image2/exlarge_moreimg/315/309/3153099695/3153099695_01.jpg?tcache=638496544669541444" class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="2" class="ibox on">
                                                        <p class="title"><span>추가이미지3</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size"></span>
                                                                    사이즈 1000x1000 이상
                                                                    <br> 2MB 이하 jpg, png만
                                                                    <br> 등록 가능합니다.
                                                                </span>
                                                                <span class="reg_btn_full">
                                                                    <input type="file" name="btnSelectFile" cmd="reg" class="reg_file">
                                                                </span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span commitedurl="http%3a%2f%2fgdimg1.gmarket.co.kr%2fgoods_image2%2fexlarge_moreimg%2f315%2f309%2f3153099695%2f3153099695_02.jpg%3ftcache%3d638496544669541444" imagetype="additional" index="2" cmd="0" class="img">
                                                                    <img src="http://gdimg1.gmarket.co.kr/goods_image2/exlarge_moreimg/315/309/3153099695/3153099695_02.jpg?tcache=638496544669541444" class="target">
                                                                </span>
                                                                <div class="alter">
                                                                    <span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span>
                                                                    <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="3" class="ibox ibox--first ibox--small on">
                                                        <p class="title"><span>추가이미지4</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span commitedurl="http%3a%2f%2fgdimg1.gmarket.co.kr%2fgoods_image2%2fexlarge_moreimg%2f315%2f309%2f3153099695%2f3153099695_03.jpg%3ftcache%3d638496544669541444" imagetype="additional" index="3" cmd="0" class="img">
                                                                    <img src="http://gdimg1.gmarket.co.kr/goods_image2/exlarge_moreimg/315/309/3153099695/3153099695_03.jpg?tcache=638496544669541444" class="target">
                                                                </span>
                                                                <div class="alter">
                                                                    <span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span>
                                                                    <a style="cursor: pointer;">
                                                                        <img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제">
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="4" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지5</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span imagetype="additional" index="4" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter">
                                                                    <span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span>
                                                                    <a style="cursor: pointer;">
                                                                        <img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제">
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="5" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지6</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span imagetype="additional" index="5" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="6" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지7</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span imagetype="additional" index="6" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter">
                                                                    <span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span>
                                                                    <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="7" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지8</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg">
                                                                <span class="txt_line_1"><span class="size">1000*1000</span></span>
                                                                <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="7" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="8" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지9</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를<br>권장합니다.</span>
                                                                <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span>
                                                            </form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod">
                                                                <span imagetype="additional" index="8" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="9" class="ibox ibox--first ibox--small">
                                                        <p class="title"><span>추가이미지10</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를
                                                                    <br>권장합니다.
                                                                </span> <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span></form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="9" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="10" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지11</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를
                                                                    <br>권장합니다.
                                                                </span> <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span></form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="10" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="11" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지12</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를
                                                                    <br>권장합니다.
                                                                </span> <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span></form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="11" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="12" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지13</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를
                                                                    <br>권장합니다.
                                                                </span> <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span></form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="12" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li imagetype="additional" index="13" class="ibox ibox--small">
                                                        <p class="title"><span>추가이미지14</span></p>
                                                        <div class="img_box">
                                                            <form enctype="multipart/form-data" method="post" cmd="reg"><span class="txt_line_1"><span class="size">1000*1000</span></span> <span class="txt_over"><span class="size">1000*1000</span> 이미지를
                                                                    <br>권장합니다.
                                                                </span> <span class="reg_btn_full"><input type="file" name="btnSelectFile" cmd="reg" class="reg_file"></span></form>
                                                            <form enctype="multipart/form-data" method="post" cmd="mod"><span imagetype="additional" index="13" cmd="0" class="img"><img class="target"></span>
                                                                <div class="alter"><span class="reg_btn_min reg_btn7"><input type="file" name="btnSelectFile" title="변경" cmd="mod" class="reg_file"></span> <a style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_prodreg_delete.png" alt="삭제"></a></div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p id="GoodsImageGuideBotton" class="goods-image-notice" style="display: none;">
                                                <span class="ls0">ESM</span> 상품식별코드 이미지는 이베이코리아 유한책임회사의 자산으로서 저작권법, 콘텐츠산업진흥법 등에 따라 보호를 받습니다.
                                                <br> 이 이미지들은 G마켓, 옥션,
                                                <span class="ls0">G9</span> 사이트에서만 사용 가능하며,
                                                <strong class="hilite">무단복제, 스크래핑, 전송, 배포, 변형은 법에 의해 엄격히 금지</strong>됩니다.
                                                <br> 이러한 행위 적발 시에는 민.형사상 책임과 약관에 따른 제재를 받을 수 있습니다.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item_goods-description">
                                <th>
                                    <div class="label">
                                        상품상세설명<em class="required-mark"><span>필수</span></em></div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-description">
                                        
                                        <div class="goods-description_setting">
                                            <table summary="상품상세설명 설정 입니다. 각 항목은 국문, 다국어로 구분됩니다.">
                                                <colgroup>
                                                    <col style="width: 140px;">
                                                    <col>
                                                </colgroup>
                                                <tbody>
                                                    <tr id="divDescriptionKr">
                                                        <th scope="row">
                                                            <div class="column-inner">
                                                                국문
                                                                <em class="required-mark"><span>필수</span></em>
                                                            </div>
                                                        </th>
                                                        <td class="korean_language">
                                                            <div data-v-7dc026ab="" class="korean_language-division"><a data-v-7dc026ab="" href="#" rel="noopener noreferrer" class="button-normal button-normal--editor"><span data-v-7dc026ab="" class="alphanumeric"><strong data-v-7dc026ab="">ESM</strong> Editor</span>로 수정</a> <a data-v-7dc026ab="" rel="noopener noreferrer" class="button-normal is-active"><strong data-v-7dc026ab="" class="alphanumeric">HTML</strong>로 수정</a> <span data-v-7dc026ab="" id="alertForCopy" style="display: none; color: rgb(236, 84, 1);">* 복사된 상품상세설명을 재확인해주세요.</span> <span data-v-7dc026ab="" id="storageHistory" class="storage_history" style="display: none;"><span data-v-7dc026ab="" class="date"></span> 저장</span>
                                                                <!---->
                                                            </div>
                                                            <div id="descriptionBlock" class="korean_language-division"><strong class="description_share_subject">상세설명공유</strong> <a onclick="$(this).closest('.korean_language-division').find('.layer--description_share').show(); return false;"><img src="https://pics.esmplus.com/front/sell/ico_guide.gif" alt="자세히 보기" class="icon"></a>
                                                                <div class="l-layer layer--description_share" style="display: none;">
                                                                    <div class="l-layer_block">
                                                                        <div class="l-layer_header">상세설명 공유 <span class="alphanumeric">URL</span></div>
                                                                        <div class="l-layer_content">
                                                                            <ul class="item_module-list">
                                                                                <li><span class="alphanumeric">eBay Editor</span>를 통해 편집한 상세설명을 다른 사이트에도 사용할 수 있는
                                                                                    기능입니다.
                                                                                </li>
                                                                                <li>
                                                                                    상품등록 이후 상품수정 시 [상세설명 공유]
                                                                                    <span class="module-list_point">사용 설정한 경우에만 공유URL이 제공</span>됩니다.
                                                                                </li>
                                                                                <li><span class="module-list_point">상품상세설명 수정 시 업데이트를 별도로 선택해야 공유페이지가 업데이트 됩니다.</span></li>
                                                                                <li>공유페이지 업데이트는 <span class="module-list_point">최대 5분이내</span>에 반영됩니다.</li>
                                                                            </ul>
                                                                        </div> <a onclick="$(this).closest('.l-layer').hide(); return false;" class="l-layer_close"><img src="https://pics.esmplus.com/front/btn/btn_layer_close2.gif" alt="닫기"></a> <span class="l-layer_arrow-up arrow--left" style="top: 21px;"></span>
                                                                    </div>
                                                                </div> <label class="description_share_check"><input type="radio" value="N">미사용
                                                                </label> <label class="description_share_check"><input type="radio" value="Y">사용
                                                                </label>
                                                                <!---->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="item item_goods-official-notice">
                                <th>
                                    <div class="label">
                                        상품정보고시
                                        <em class="required-mark"><span>필수</span></em>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-official-notice">
                                        <ul class="official-notice_guide">
                                            <li><span class="bullet">*</span>정보입력 시, '상세설명 참고' 등으로 표기한 경우, 반드시 실제 상품페이지 내 정보를 표기하여야 합니다.<br>
                                                불명확하거나 허위정보를 기재한 경우, 판매중지 조치가 되거나 관련법에 따라 처벌될 수 있습니다.
                                            </li>
                                        </ul>
                                        <div class="official-notice_select">
                                            <ul class="select-list">
                                                <li class="list_item list_item--template"><select id="ddlOfficialNotiTemplateList" name="ddlOfficialNotiTemplateList" class="item_value">
                                                        <option value="-1">상품정보고시 템플릿 선택</option>
                                                        <option value="202088">[자동차용품 (자동차부품 / 기타 자동차 용품 등)] 비투피</option>
                                                    </select> <a href="javascript:parent.addTab('TDM393');" id="btnGoTemplateManager" class="link">템플릿 관리로 이동 &gt;</a></li>
                                                <li class="list_item list_item--groups"><label for="ddlOfficialNotiGroup">상품의 상품군</label> <select id="ddlOfficialNotiGroup" name="ddlOfficialNotiGroup" class="item_value">
                                                        <option selected="selected" value="0">상품군을 선택하세요</option>
                                                        <option value="1">의류</option>
                                                        <option value="2">구두/신발</option>
                                                        <option value="3">가방</option>
                                                        <option value="4">패션잡화(모자/벨트/액세서리 등)</option>
                                                        <option value="5">침구류/커튼</option>
                                                        <option value="6">가구(침대/소파/싱크대/DIY제품 등)</option>
                                                        <option value="7">영상가전(TV류)</option>
                                                        <option value="8">가정용 전기제품(냉장고/세탁기/식기세척기/전자레인지 등)</option>
                                                        <option value="9">계절가전 (에어컨 / 온풍기 등)</option>
                                                        <option value="10">사무용기기(컴퓨터/노트북/프린터 등)</option>
                                                        <option value="11">광학기기 (디지털카메라 / 캠코더 등)</option>
                                                        <option value="12">소형전자(MP3/전자사전 등)</option>
                                                        <option value="13">휴대형 통신기기 (휴대폰 / 태블릿 등)</option>
                                                        <option value="14">내비게이션</option>
                                                        <option value="15">자동차용품 (자동차부품 / 기타 자동차 용품 등)</option>
                                                        <option value="16">의료기기</option>
                                                        <option value="17">주방용품</option>
                                                        <option value="18">화장품</option>
                                                        <option value="19">귀금속/보석/시계류</option>
                                                        <option value="20">농수축산물</option>
                                                        <option value="21">가공식품</option>
                                                        <option value="22">건강기능식품</option>
                                                        <option value="23">어린이제품</option>
                                                        <option value="24">악기</option>
                                                        <option value="25">스포츠 용품</option>
                                                        <option value="26">서적</option>
                                                        <option value="27">호텔/펜션 예약</option>
                                                        <option value="28">여행패키지</option>
                                                        <option value="29">항공권</option>
                                                        <option value="30">자동차 대여 서비스(렌터카)</option>
                                                        <option value="31">물품대여 서비스(정수기/비데/공기청정기 등)</option>
                                                        <option value="32">물품대여 서비스(서적/유아용품/행사용품 등)</option>
                                                        <option value="33">디지털 콘텐츠(음원/게임/인터넷강의 등)</option>
                                                        <option value="34">상품권/쿠폰</option>
                                                        <option value="35">기타 재화</option>
                                                        <option value="36">직접입력</option>
                                                        <option value="37">모바일쿠폰</option>
                                                        <option value="38">영화/공연</option>
                                                        <option value="39">기타 용역</option>
                                                        <option value="40">생활화학제품</option>
                                                        <option value="41">살생물제품</option>
                                                    </select></li>
                                            </ul>
                                        </div>
                                        <div class="official-notice_detail">
                                            <div class="official-notice_default">
                                                <table>
<!--                                                    <caption>상품정보고시 필수 입력 항목</caption>-->
                                                    <colgroup>
                                                        <col width="150">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tbody id="witeIfo">
                                                        <tr>
                                                            <th>품명 및 모델명</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-1"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>동일모델의 출시년월</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-2"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>KC 인증정보</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-3"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                                <p class="item-info">* (자동차관리법에 따른 부품자기 인증 대상 자동차부품, 전기용품 및 생활용품 안전관리법에 따른 안전인증ㆍ안전확인ㆍ공급자 적합성확인대상제품 및 전파법에 따른 적합 인증ㆍ적합등록 대상 기자재에 한함)</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>제조자/수입자</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-4"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                                <p class="item-info">* 수입품의 경우 수입자를 함께 입력, 병행수입의 경우 병행수입 여부로 대체 가능</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>제조국</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-5"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>크기</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-6"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>적용차종</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-7"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>제품사용으로 인한 위험 및 유의사항</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-11"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                                <p class="item-info">* 연료절감장치에 한함</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>품질보증기준</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-8"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>검사합격증 번호</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-12"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                                <p class="item-info">* (대기환경보전법에 따른 첨가제ㆍ촉매제에 한함)</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>A/S 책임자와 전화번호</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-9"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>주문후 예상 배송기간</th>
                                                            <td>
                                                                <div class="official-notice_desc write_info" id="15-10"> <textarea name="noti_item_value" class="border_gray _resizeHeight" cols="100" rows="1"></textarea> </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <ul class="official-notice_guide">
                                                <li><span class="bullet">*</span>상기의 정보는
                                                    <em class="text-point">전자상거래법(제13조2항) 및 공정위 상품정보제공고시</em>에 의거하여 판매회원이 스스로의 책임으로 입력하여야 하는 사항입니다.
                                                </li>
                                                <li><span class="bullet">*</span> <em class="text-point">여러 상품(주된 상품에 부수되는 상품은 제외)</em>을 추가선택으로 판매하는 경우에는 각 상품에 해당하는 정보를 모두 입력하여야 하며,
                                                    <br>제공되는 입력란의 공간이 부족한 경우에는 광고화면에 직접 입력하셔도 무방합니다.
                                                </li>
                                            </ul>
                                            <div class="official-notice_etc">
                                                <div class="notice_etc_title"><strong>기타 특이사항</strong> <span>*선택입력</span></div>
                                                <div class="notice_etc_data">
                                                    <div id="999-5" class="official-notice_desc"><textarea id="txtEtcData" name="noti_item_value" cols="100" rows="1" class="_resizeHeight" style="height: 18px;"></textarea></div>
                                                    <p class="etc-item__txt">구매, 교환, 반품, 배송, 설치 등과 관련하여 추가비용, 제한조건 등의 특이사항이 있는 경우 입력하여 주십시오.
                                                        <br> 여기에 입력한 정보는 구매자에게 이메일로 제공됩니다.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="sectionDeliveryInfo" class="item item_goods-deliveryinfo">
                                <th>
                                    <div class="label">
                                        배송정보
                                        <em class="required-mark"><span>필수</span></em>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-deliveryinfo">
                                        <div class="deliveryinfo_group" style="display: none;">
                                            <dl class="deliveryinfo_group-list">
                                                <dt>이 상품의 그룹 배송정보</dt>
                                                <dd><span id="spanGroupDeliveryInfo">일반택배배송, 묶음, 조건부 무료 <span class="num">(배송정책번호 63014860)</span></span></dd>
                                            </dl>
                                            <ul class="deliveryinfo_group-notice" style="display: none;">
                                                <li class="deliveryinfo_group-notice-item" style="display: none;">
                                                    * 본 상품은
                                                    <strong class="group_item">[<span class="c_iac">A</span>옥션 <span class="num">0</span>]</strong> <span class="group_name"></span> 그룹에 속한 상품으로 그룹의 배송정보는 위와 같습니다.
                                                </li>
                                                <li class="deliveryinfo_group-notice-item" style="display: none;">
                                                    * 본 상품은
                                                    <strong class="group_item">[<span class="c_gmkt">G</span>마켓<span class="num">0</span>]</strong> <span class="group_name"></span> 그룹에 속한 상품으로 그룹의 배송정보는 위와 같습니다.
                                                </li>
                                                <li class="deliveryinfo_group-notice-item">
                                                    * 상품의 배송정보를
                                                    <strong class="point">그룹의 배송정보와 다른 조건으로 변경할 경우 그룹에서 삭제(=그룹 내 상품에서 제외)</strong> 되므로 이점 유의하시기 바랍니다.
                                                </li>
                                            </ul>
                                            <ul class="deliveryinfo_group-notice">
                                                <li class="deliveryinfo_group-notice-item">* 본 상품은 그룹에 속하지 않은 상품으로, 위와 동일한 배송번호끼리만 그룹 생성이 가능합니다.</li>
                                                <li class="deliveryinfo_group-notice-item">* 이미 생성된 그룹에 추가할 경우도 마찬가지로 그룹의 배송조건이 위 배송번호와 동일해야 합니다.</li>
                                            </ul>
                                        </div>
                                        <table class="n_tdinboard" style="margin: 0px;">
                                            <colgroup>
                                                <col style="width: 15%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr class="first">
                                                    <th scope="row">
                                                        <div class="delivery_type_wrap">
                                                            발송정책
                                                            <em class="required-mark"><span>필수</span></em>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="manage-delivery-type"><a href="https://pics.esmplus.com/front/Manual/SellerGuide2/deliveryPolicy.html" target="_blank" class="button-guide button-delivery_type_guide">발송정책 노출혜택</a>
                                                            <div id="divTransPolicyIac" class="set-delivery-type" style="user-select: auto !important; display: none;">
                                                                <div class="delivery-type-choice"><em class="market-logo logo-iac-double"><span>옥션</span></em> <select id="transTypeChoiceIac" title="선택해주세요" style="width: 397px;"></select> <a id="btnSettingDeliveryTypeIac" class="item_button button_dark" style="cursor: pointer;"><span>관리</span></a></div>
                                                            </div>
                                                            <div id="divTransPolicyGmkt" class="set-delivery-type">
                                                                <div class="delivery-type-choice"><em class="market-logo logo-gmkt-g9"><span>G마켓</span></em> <select id="transTypeChoiceGmkt" title="선택해주세요" style="width: 397px;">
                                                                        <option option="" value="">선택하세요.</option>
                                                                        <option value="-11" transtype="A">당일발송 / 발송마감시간 11시 00분까지</option>
                                                                        <option value="-12" transtype="A">당일발송 / 발송마감시간 12시 00분까지</option>
                                                                        <option selected="selected" value="-13" transtype="A">당일발송 / 발송마감시간 13시 00분까지</option>
                                                                        <option value="-14" transtype="A">당일발송 / 발송마감시간 14시 00분까지</option>
                                                                        <option value="-15" transtype="A">당일발송 / 발송마감시간 15시 00분까지</option>
                                                                        <option value="-16" transtype="A">당일발송 / 발송마감시간 16시 00분까지</option>
                                                                        <option value="-17" transtype="A">당일발송 / 발송마감시간 17시 00분까지</option>
                                                                        <option value="-18" transtype="A">당일발송 / 발송마감시간 18시 00분까지</option>
                                                                        <option value="-102" transtype="B">순차발송 / 주문 후 2일내 발송(내일발송)</option>
                                                                        <option value="-103" transtype="B">순차발송 / 주문 후 3일내 발송</option>
                                                                        <option value="-104" transtype="B">순차발송 / 주문 후 4일내 발송</option>
                                                                        <option value="-200" transtype="C">해외발송</option>
                                                                        <option value="-300" transtype="D">요청일발송</option>
                                                                        <option value="-400" transtype="E">주문제작발송</option>
                                                                        <option value="-500" transtype="F">발송일미정</option>
                                                                    </select> <a id="btnSettingDeliveryTypeGmkt" class="item_button button_dark" style="cursor: pointer;"><span>관리</span></a></div>
                                                            </div>
                                                            <ul class="delivery-type-info">
                                                                <li class="delivery-type-info_item">* 판매고객님께서 설정하신 발송정책 기준으로 발송처리가 되지 않을 경우 페널티가 부과될 수 있으니 정확한 정보를 입력해 주시기 바랍니다.</li>
                                                                <li id="deliveryTypeRegist2PageOverseaInfoItem" class="delivery_type_info_item" style="display: none; color: rgb(37, 103, 187); font-size: 11px;">
                                                                    * 발송 정책 중 해외 발송을 선택할 경우 해외판매 여부는
                                                                    <span class="alphanumeric">‘N’</span>으로 고정되며 변경은 불가능하니 이점 참고 바랍니다.
                                                                </li>
                                                            </ul> <input type="hidden" id="hddDefaultFlag" value="false">
                                                            <p id="lblDefaultIs" class="delivery-type-warning" style="user-select: auto !important; display: none;">* 판매자님 계정에는 현재 기본 발송정책이 설정되어 있지 않습니다.
                                                                <br>[관리]버튼을 클릭하여 기본으로 사용하실 발송정책 정보를 설정해주시기 바랍니다.
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionBackwoodsDelivery" style="display: none;">
                                                    <th scope="row">
                                                        <div class="delivery_type_wrap" style="z-index: 1;">
                                                            제주/도서산간지역<br> 배송여부
                                                            <em class="required-mark"><span>필수</span></em> <a href="#" onclick="$(this).closest('.delivery_type_wrap').find('.layer_delivery_type').show(); return false;"><img src="https://pics.esmplus.com//front/sell/ico_guide.gif" alt="자세히 보기" class="guide"></a>
                                                            <div class="l-layer layer_delivery_type">
                                                                <div class="l-layer_block">
                                                                    <div class="l-layer_header">제주/도서산간지역 배송여부 안내</div>
                                                                    <div class="l-layer_content">
                                                                        <ul class="item_module-list">
                                                                            <li>불가능으로 선택 시, 해당 상품은 출하지에 도서산간 배송비가 설정되어 있더라도 제주/도서산간 지역으로 주문이 불가하도록 설정됩니다.</li>
                                                                        </ul>
                                                                    </div> <a href="#" onclick="$(this).closest('.l-layer').hide(); return false;" class="l-layer_close"><img src="https://pics.esmplus.com//front/btn/btn_layer_close2.gif" alt="닫기"></a> <span class="l-layer_arrow-up" style="left: 86px;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div><label><input checked="checked" id="rdoBackwoodsDeliveryYn" name="rdoBackwoodsDeliveryYn" type="radio" value="Y" class="rdo">
                                                                가능
                                                            </label> <label><input id="rdoBackwoodsDeliveryYn" name="rdoBackwoodsDeliveryYn" type="radio" value="N" class="rdo">
                                                                불가능
                                                            </label>
                                                            <p class="view_spn"><a id="btnBackwoodsInfo" class="btn-css btn-height21 gray"><span class="btn-inner">제주 및 도서산간 해당 지역정보</span></a></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionDeliveryWayESSEN">
                                                    <th scope="row" rowspan="2">
                                                        배송방법
                                                        <em class="required-mark"><span>필수</span></em>
                                                    </th>
                                                    <td>
                                                        <div class="cell-delivery-method"><input id="hdnCommonDeliveryWayOPTSEL" name="hdnCommonDeliveryWayOPTSEL" type="hidden" value="1"> <input id="hdnGmktDeliveryWayOPTSEL" name="hdnGmktDeliveryWayOPTSEL" type="hidden" value="1"> <strong class="n_sbtit">필수선택</strong> <label><input checked="checked" id="rdoCommonDeliveryWayOPTSEL1" name="rdoCommonDeliveryWayOPTSEL" type="radio" value="1" class="rdo">
                                                                택배/소포/등기
                                                            </label> <select id="selCommonDeliveryWayOPTSELParcelCOMP" title="택배사" class="selectType01_basic" style="width: 144px;">
                                                                <option value="100000012">CJ택배</option>
                                                                <option value="100000014">대한통운택배</option>
                                                                <option value="100000015">한진택배</option>
                                                                <option value="100000011">우체국택배</option>
                                                                <option value="100000016">롯데택배</option>
                                                                <option value="100000023">로젠택배</option>
                                                                <option value="100000010">경동택배</option>
                                                                <option value="100000055">천일택배</option>
                                                                <option value="100000090">DHL</option>
                                                                <option value="100000206">FEDEX</option>
                                                                <option value="100000054">일반우편</option>
                                                                <option value="100000060">LG전자물류</option>
                                                                <option value="100000048">삼성전자물류</option>
                                                                <option value="100000041">직접배송</option>
                                                                <option value="100000019">자체배송</option>
                                                                <option value="100000244">기타택배</option>
                                                                <option value="100000059">EMS</option>
                                                                <option value="400000021">(소형항공)우체국</option>
                                                                <option value="100000057">우리택배</option>
                                                                <option value="100000199">USPS</option>
                                                                <option value="100000200">UPS</option>
                                                                <option value="100000212">GSMNTON</option>
                                                                <option value="100000213">WarpEx</option>
                                                                <option value="100000078">성원글로벌</option>
                                                                <option value="100000205">홈플러스택배</option>
                                                                <option value="100000042">건영택배</option>
                                                                <option value="100000062">WIZWA</option>
                                                                <option value="400000011">(해외)우체국</option>
                                                                <option value="400000031">(해외)DHL</option>
                                                                <option value="400000211">(해외)DPD</option>
                                                                <option value="200000012">(G마켓)CJ택배</option>
                                                                <option value="200000017">(G마켓)편의점택배</option>
                                                                <option value="200000014">(G마켓)대한통운</option>
                                                                <option value="100000224">CJ국제특송</option>
                                                                <option value="100000225">편의점택배(GS25)</option>
                                                                <option value="100000227">합동택배</option>
                                                                <option value="100000228">롯데국제특송</option>
                                                                <option value="100000231">SLX</option>
                                                                <option value="100000232">대우전자</option>
                                                                <option value="100000233">범한판토스</option>
                                                                <option value="100000234">GPS LOGIX</option>
                                                                <option value="100000235">한의사랑택배</option>
                                                                <option value="100000236">세방택배</option>
                                                                <option value="100000238">쉽트랙</option>
                                                                <option value="100000239">ACI</option>
                                                                <option value="100000240">Gsfresh</option>
                                                                <option value="100000242">택배사미정</option>
                                                                <option value="100000245">Global Shipping2</option>
                                                                <option value="100000246">Global Shipping3</option>
                                                                <option value="100000247">Global Shipping4</option>
                                                                <option value="400000252">Global Shipping</option>
                                                                <option value="100000253">Global Shipping5</option>
                                                                <option value="100000254">롯데마트</option>
                                                                <option value="100000255">Qxpress</option>
                                                                <option value="100000256">현대글로비스</option>
                                                                <option value="100000257">부릉</option>
                                                                <option value="100000258">이마트몰</option>
                                                                <option value="100000259">투데이</option>
                                                                <option value="100000260">아르고</option>
                                                                <option value="100000261">위니온로지스</option>
                                                                <option value="100000262">한덱스</option>
                                                                <option value="100000263">TNT</option>
                                                                <option value="100000264">i-parcel</option>
                                                                <option value="100000265">대운글로벌</option>
                                                                <option value="100000266">에어보이익스프레스</option>
                                                                <option value="100000267">LineExpress</option>
                                                                <option value="100000268">GSI익스프레스</option>
                                                                <option value="100000269">ECMS익스프레스</option>
                                                                <option value="100000270">EFS</option>
                                                                <option value="100000271">시알로지텍</option>
                                                                <option value="100000272">브리지로지스</option>
                                                                <option value="100000273">Cway express</option>
                                                                <option value="100000274">ACE express</option>
                                                                <option value="100000275">스마트로지스</option>
                                                                <option value="100000276">에스더쉬핑</option>
                                                                <option value="100000277">로토스</option>
                                                                <option value="100000278">은하쉬핑</option>
                                                                <option value="100000279">유프레이트 코리아</option>
                                                                <option value="100000280">하이브시티</option>
                                                                <option value="100000281">LTL</option>
                                                                <option value="100000282">캐나다쉬핑</option>
                                                                <option value="100000283">지디에이코리아</option>
                                                                <option value="100000284">올타코리아</option>
                                                                <option value="100000285">yunda express</option>
                                                                <option value="100000286">웅지익스프레스</option>
                                                                <option value="100000287">YDH</option>
                                                                <option value="100000288">ACCcargo</option>
                                                                <option value="100000289">허싱카고코리아</option>
                                                                <option value="100000290">시노트랜스</option>
                                                                <option value="100000291">패스트박스</option>
                                                                <option value="100000292">팬스타국제특송</option>
                                                                <option value="100000293">에이씨티앤코아물류</option>
                                                                <option value="100000294">kt express</option>
                                                                <option value="100000295">ibpcorp</option>
                                                                <option value="100000296">엠티인터네셔널</option>
                                                                <option value="100000297">골드스넵스</option>
                                                                <option value="100000298">BGF포스트</option>
                                                                <option value="100000299">용마로지스</option>
                                                                <option value="100000300">원더스퀵</option>
                                                                <option value="100000301">농협택배</option>
                                                                <option value="100000302">HI택배</option>
                                                                <option value="100000303">홈픽택배</option>
                                                                <option value="100000304">KGL네트웍스</option>
                                                                <option value="100000305">2fast익스프레스</option>
                                                                <option value="100000306">GTS로지스</option>
                                                                <option value="100000307">홈이노베이션로지스</option>
                                                                <option value="100000308">자이언트</option>
                                                                <option value="100000309">우리동네택배</option>
                                                                <option value="100000310">퍼레버택배</option>
                                                                <option value="100000311">엘서비스</option>
                                                                <option value="100000312">로지스밸리택배</option>
                                                                <option value="100000313">제니엘시스템</option>
                                                                <option value="100000314">애니트랙</option>
                                                                <option value="100000315">제이로지스트</option>
                                                                <option value="100000316">두발히어로</option>
                                                                <option value="100000317">큐런</option>
                                                                <option value="100000318">프레시솔루션</option>
                                                                <option value="100000319">한샘</option>
                                                                <option value="100000320">굿투럭</option>
                                                                <option value="100000321">지니고</option>
                                                                <option value="100000322">카카오 T 당일배송</option>
                                                                <option value="100000323">노곡물류</option>
                                                                <option value="100000324">스페이시스원</option>
                                                                <option value="100000325">로지스팟</option>
                                                                <option value="100000326">DHL GlobalMail</option>
                                                                <option value="100000327">프레시메이트</option>
                                                                <option value="100000328">NK로지솔루션</option>
                                                                <option value="100000329">도도플렉스</option>
                                                                <option value="100000330">배송하기좋은날</option>
                                                                <option value="100000331">이투마스</option>
                                                                <option value="100000332">에이스물류</option>
                                                                <option value="100000333">바바바로지스</option>
                                                                <option value="100000334">롯데칠성</option>
                                                                <option value="100000335">발렉스</option>
                                                                <option value="100000336">국제익스프레스</option>
                                                                <option value="100000337">윈핸드해운항공</option>
                                                                <option value="100000338">탱고앤고</option>
                                                                <option value="100000339">SBGLS</option>
                                                                <option value="100000340">핑퐁</option>
                                                                <option value="100000341">1004홈</option>
                                                                <option value="100000342">나은물류</option>
                                                                <option value="100000343">엔티엘피스</option>
                                                                <option value="100000344">삼다수가정배송</option>
                                                                <option value="100000345">딜리래빗</option>
                                                                <option value="100000346">홈픽오늘도착</option>
                                                                <option value="100000347">대림통운</option>
                                                                <option value="100000348">로지스파트너</option>
                                                                <option value="100000349">고박스</option>
                                                                <option value="100000350">케이제이티</option>
                                                                <option value="100000351">더바오</option>
                                                                <option value="100000352">오늘회러쉬</option>
                                                                <option value="100000353">한국야구르트</option>
                                                                <option value="100000354">로지스밸리</option>
                                                                <option value="100000355">라스트마일시스템즈</option>
                                                                <option value="100000356">에이치케이홀딩스</option>
                                                                <option value="100000357">직구문</option>
                                                                <option value="100000358">큐브플로우</option>
                                                                <option value="100000359">성훈물류</option>
                                                                <option value="100000360">지비에스</option>
                                                                <option value="100000361">반품구조대</option>
                                                                <option value="100000362">화물을부탁해</option>
                                                                <option value="100000363">Global Shipping6</option>
                                                                <option value="100000364">Global Shipping7</option>
                                                                <option value="100000365">Global Shipping8</option>
                                                                <option value="100000366">Global Shipping9</option>
                                                                <option value="100000367">Global Shipping10</option>
                                                                <option value="100000368">팀프레시</option>
                                                                <option value="100000369">Global Shipping11</option>
                                                                <option value="100000370">Global Shipping12</option>
                                                                <option value="100000371">Global Shipping13</option>
                                                                <option value="100000372">Global Shipping14</option>
                                                                <option value="100000373">Global Shipping15</option>
                                                                <option value="100000374">Global Shipping16</option>
                                                                <option value="100000375">Global Shipping17</option>
                                                                <option value="100000376">Global Shipping18</option>
                                                                <option value="100000377">Global Shipping19</option>
                                                                <option value="100000378">Global Shipping20</option>
                                                                <option value="100000379">지에이치스피드</option>
                                                                <option value="100000381">쉽트랙(Ship G)</option>
                                                                <option value="100000382">딜리박스</option>
                                                                <option value="100000017">등기우편</option>
                                                                <option value="100000045">대신택배</option>
                                                                <option value="100000075">일양택배</option>
                                                            </select> <input id="hdnGmktUnifyParcelCompCode" name="hdnGmktUnifyParcelCompCode" type="hidden" value=""> <label><input id="rdoCommonDeliveryWayOPTSEL2" name="rdoCommonDeliveryWayOPTSEL" type="radio" value="2" class="rdo">
                                                                직접배송
                                                            </label></div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionDeliveryWayChoice">
                                                    <td>
                                                        <div class="cell-delivery-method"><strong class="n_sbtit">추가선택</strong> <span><label id="lblCommonQuickService"><input id="chkCommonQuickService" name="chkCommonQuickService" type="checkbox" value="true"><input name="chkCommonQuickService" type="hidden" value="false"> 퀵서비스</label></span>
                                                            <div id="divVisitTake" class="n_s_tdinboard" style="display: none;">
                                                                <table>
                                                                    <colgroup>
                                                                        <col style="width: 12%;">
                                                                        <col>
                                                                    </colgroup>
                                                                    <tbody>
                                                                        <tr class="first">
                                                                            <th scope="row"><span>방문수령</span></th>
                                                                            <td>
                                                                                <div class="delivery-method">
                                                                                    <div class="delivery-method-block"><em class="delivery-method-subject">혜택여부 :</em> <input id="hdnCommonVisitTakeTypeSEL" name="hdnCommonVisitTakeTypeSEL" type="hidden" value="0"> <span class="delivery-method-item"><label class="delivery-method-item-type"><input id="rdoCommonVisitTakeType1" name="rdoCommonVisitTakeType" type="radio" value="1" class="rdo"> 구매자 혜택없음</label></span> <span class="delivery-method-item"><label class="delivery-method-item-type"><input id="rdoCommonVisitTakeType2" name="rdoCommonVisitTakeType" type="radio" value="2" class="rdo"> 가격할인(금액환불)</label> <input disabled="disabled" id="txtCommonVisitTakePriceDcAmnt" name="txtCommonVisitTakePriceDcAmnt" title="가격할인(금액환불)을 입력해주세요" type="text" value="0" class="txt" style="width: 60px;"> <span class="unit">원</span> <label class="delivery-method-item-type"><input id="rdoCommonVisitTakeType3" name="rdoCommonVisitTakeType" type="radio" value="3" class="rdo"> 사은품</label> <input disabled="disabled" id="txtCommonVisitTakeFreeGiftName" name="txtCommonVisitTakeFreeGiftName" title="사은품을 입력해주세요" type="text" value="" class="txt" style="width: 77px;"></span></div>
                                                                                    <div class="delivery-method-block"><em class="delivery-method-subject">방문수령주소</em> <input disabled="disabled" id="txtCommonVisitTakeADDR" name="txtCommonVisitTakeADDR" title="방문수령주소를 입력해주세요" type="text" value="" class="txt txt--address"> <a id="btnVisitTakePopup" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_manage1.gif" alt="관리" class="inbtn"></a></div>
                                                                                    <div class="delivery-method-block"><em class="delivery-method-subject">방문수령연락처</em> <input disabled="disabled" id="hdnCommonVisitTakeHomeTel" name="hdnCommonVisitTakeHomeTel" type="text" value="" class="txt" style="width: 100px;"> <input disabled="disabled" id="hdnCommonVisitTakeCellPhone" name="hdnCommonVisitTakeCellPhone" type="text" value="" class="txt" style="width: 100px;"> <input id="hdnCommonVisitTakeADDRNo" name="hdnCommonVisitTakeADDRNo" type="hidden" value=""></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div id="divQuickService" class="n_s_tdinboard" style="display: none;">
                                                                <table>
                                                                    <colgroup>
                                                                        <col style="width: 12%;">
                                                                        <col>
                                                                    </colgroup>
                                                                    <tbody>
                                                                        <tr class="first">
                                                                            <th scope="row"><span>퀵서비스</span></th>
                                                                            <td>
                                                                                <div class="n_tdiin_brwrap">
                                                                                    <div class="n_tdiin_blwrap">
                                                                                        <div class="n_tdiin_trwrap">
                                                                                            <div class="n_tdiin_tlwrap_1"><span class="n_type1"><label class="fir">
                                                                                                        퀵서비스업체명 <input id="txtCommonQuickServiceCOMPName" name="txtCommonQuickServiceCOMPName" type="text" value="" class="txt" style="width: 87px;"></label> <label>
                                                                                                        연락처 <input id="txtCommonQuickServicePhone" name="txtCommonQuickServicePhone" type="text" value="" class="txt" style="width: 88px;"></label> <span class="n_titbtn"><label>배송가능지역</label> <input id="hdnCommonQuickServiceDeliveryEnableRegionNo" name="hdnCommonQuickServiceDeliveryEnableRegionNo" type="hidden" value=""> <a id="btnQuickServiceDeliveryEnable" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_set_change.gif" alt="설정/변경" class="inbtn"></a>
                                                                                                        &nbsp;<span id="spanCommonQuickServiceDeliveryEnableRegion"></span></span></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div id="GmktVisitReceiptTier" class="shipping_method_desc" style="display: none;">
                                                                <p class="shipping_method_title">장착서비스</p>
                                                                <div class="round_box">
                                                                    <div class="round_box-inner">
                                                                        <div class="round_box-inner2">
                                                                            <div class="round_box-inner3">
                                                                                <div class="shipping_method_local"><label for="LocalAddressGroup">1. 주소</label> <select id="LocalAddressGroup" class="selectType01_basic" style="width: 340px;">
                                                                                        <option>그룹 선택</option>
                                                                                        <option value="10002">한국 타이어 장착 점 주소록 </option>
                                                                                        <option value="10003">독일 타이어 </option>
                                                                                        <option value="10004">한국 타이어 </option>
                                                                                    </select> <span class="css_btn2"><a id="btnVisitReceiptTierPopup" style="cursor: pointer;">주소록 관리</a></span></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="CommonIACPost" class="n_s_tdinboard" style="display: none;">
                                                                <table>
                                                                    <colgroup>
                                                                        <col style="width: 12%;">
                                                                        <col>
                                                                    </colgroup>
                                                                    <tbody>
                                                                        <tr class="first">
                                                                            <th scope="row"><span>일반우편 </span></th>
                                                                            <td>&nbsp; <input id="hdnCommonIACPostTypeSEL" name="hdnCommonIACPostTypeSEL" type="hidden" value="0"> <label><input id="rdoCommonIACPostType1" name="rdoCommonIACPostType" type="radio" value="1" class="rdo"> 무료</label> <label class="mr"><input id="rdoCommonIACPostType2" name="rdoCommonIACPostType" type="radio" value="2" class="rdo"> 유료(선결제)</label> <input disabled="disabled" id="txtCommonIACPostPaidPrice" name="txtCommonIACPostPaidPrice" type="text" value="0" class="txt" style="width: 69px;"> 원
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div id="GmktTodayDEPAR" class="j_add_delivery_cost" style="display: none;">
                                                                <div class="j_add_delivery_guide">
                                                                    안내 : 배송관리 <strong>메뉴에서 당일 발송 확인을 위해 송장번호</strong>를 입력해주시기 바랍니다.
                                                                </div>
                                                                <div class="n_tdiin_brwrap j_exchange_lst">
                                                                    <div class="n_tdiin_blwrap">
                                                                        <div class="n_tdiin_trwrap">
                                                                            <div class="n_tdiin_tlwrap">
                                                                                <ul class="j_delivery_step">
                                                                                    <li>설정된 상품은 14시30분 이전 주문 건까지 당일 발송해야 합니다.(영업일 기준, 주말은 제외)</li>
                                                                                    <li>14시30분 이후 주문 건의 경우도 당일발송을 윈칙으로 합니다.</li>
                                                                                    <li>주말 또는 공휴일 주문의 배송은 영업 가능일에 배송해야 합니다.(예: 토요일 오후 주문은 다음 주 월요일 발송)</li>
                                                                                    <li>발송지연으로 인한 구매자 클레임 발생 시 아래 2가지 쿠폰이 구매자에게 보상됩니다.
                                                                                        <p class="present">보상 내용</p>
                                                                                        <ol>
                                                                                            <li>1. 무료 반품 쿠폰 / G마켓 부담</li>
                                                                                            <li>2. 무료 배송 쿠폰 / 판매자 부담(해당 판매자 상품에만 적용가능)</li>
                                                                                        </ol>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="agree"><label><input id="chkGmktTodayDEPARAgree" name="chkGmktTodayDEPARAgree" type="checkbox" value="true"><input name="chkGmktTodayDEPARAgree" type="hidden" value="false">당일 발송 상품에 대한 약관을 확인 하였으며, 이에 동의 합니다.</label></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionDeliveryFeeSetup">
                                                    <th scope="row">
                                                        배송비 설정<em class="required-mark"><span>필수</span></em>
                                                    </th>
                                                    <td><span class="tdtit"><strong>1. 출하지선택</strong></span> <input id="hdnShipmentPlaceNo" name="hdnShipmentPlaceNo" type="hidden" value="20293311"> <input id="hdnDefaultShipmentPlaceNo" name="hdnDefaultShipmentPlaceNo" type="hidden" value="20269292"> <select id="selShipmentPlaceNo" class="selectType01_basic" style="width: 145px; height: 19px;">
                                                            <option value="">선택하세요.</option>
                                                            <option value="20510891">HK Tech Corporation</option>
                                                            <option value="20502584">코리아브레이크</option>
                                                            <option value="20293311">바이오라이트</option>
                                                            <option value="20471356">카스트코코리아</option>
                                                            <option value="20269292">기본 출하지</option>
                                                            <option value="14565727">기본 출하지</option>
                                                        </select> <a id="btnShipmentPlacePopup" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_manage1.gif" alt="관리" class="inbtn"></a>
                                                        <ul id="DefaultShipmentPlaceTxt" class="n_deliv_set" style="user-select: auto !important; display: none;">
                                                            <li>
                                                                <p class="over_block"><em>설정된 출하지가 없습니다. [관리]버튼을 눌러 출하지 정보를 설정하신후 사용하세요.</em></p>
                                                            </li>
                                                        </ul>
                                                        <div id="SelectedShipmentPlaceTxt" class="n_deliv_set">
                                                            <ul>
                                                                <li>
                                                                    <p class="over_block"><em>선택된 주소 : </em> <span id="txtShipmentPlaceADDR" class="choice_address">경상북도 김천시 어모면 산업단지1로 46바이오라이트 (우) 39537</span></p>
                                                                    <p style="margin-left: 84px;"><span id="txtShipmentPlaceHomeTel" style="display: inline;">070-4486-0587</span>&nbsp;|&nbsp;<span id="txtShipmentPlaceCellPhone">010-5833-4843</span></p>
                                                                </li>
                                                                <li id="spanShipmentPlaceDeliveryFeeETC">
                                                                    <p class="over_block"><span id="spanShipmentPlaceDeliveryFeeJejuEtc"><em>도서산간 추가배송비 설정 : </em>제주도 및 그 부속 도서 <input disabled="disabled" id="txtShipmentPlaceDeliveryFeeJejuEtc" name="txtShipmentPlaceDeliveryFeeJejuEtc" type="text" value="" class="txt" style="width: 45px;"> 원</span> <span id="spanShipmentPlaceDeliveryFeeIslandEtc"><span class="bar">도서지방 및 기타 산간지방</span> <input disabled="disabled" id="txtShipmentPlaceDeliveryFeeIslandEtc" name="txtShipmentPlaceDeliveryFeeIslandEtc" type="text" value="" class="txt" style="width: 45px;"> 원</span></p>
                                                                </li>
                                                            </ul>
                                                            <p class="n_deliv_set__desc">* 옥션 도서산간 추가 배송비는 수량별 차등 설정이 불가하며, 주문 시 1회만 부과됩니다.</p>
                                                        </div>
                                                        <p class="select_delivery_tit"><span class="tdtit"><strong>2. 배송비 선택</strong></span> <input id="hdnDeliveryFeeTypeSEL" name="hdnDeliveryFeeTypeSEL" type="hidden" value="1"> <label><input checked="checked" id="rdoDeliveryFeeType1" name="rdoDeliveryFeeType" type="radio" value="1" class="rdo">
                                                                묶음 배송비
                                                            </label> <label><input id="rdoDeliveryFeeType2" name="rdoDeliveryFeeType" type="radio" value="2" class="rdo">
                                                                상품별 배송비
                                                            </label></p>
                                                        <p id="pDeliveryNo" class="view_spn"><a id="btnDeliveryNo" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_view_spn.gif" alt="G마켓 배송정책번호 보기"></a></p>
                                                        <div id="sectionBundleDelivery" class="select_delivery select_delivery_last">
                                                            <p class="bundle">
                                                                묶음계산방식 선택
                                                                <select id="selBundleDeliveryYNType" disabled="disabled" style="width: 220px; background-color: rgb(235, 235, 228);">
                                                                    <option value="1">배송비 중 가장 작은 값으로 부과</option>
                                                                    <option value="2">배송비 중 가장 큰값으로 부과</option>
                                                                    <option value="3">개별부과</option>
                                                                </select>
                                                            </p>
                                                            <div class="deliveryinfo_cube">
                                                                <div class="select_delivery_fee_item"><label for="selBundleDeliveryTemp" class="delivery_fee_subject">배송비 템플릿 선택</label> <input id="hdnBundleDeliveryTempNo" name="hdnBundleDeliveryTempNo" type="hidden" value="63014860"> <select id="selBundleDeliveryTemp" style="width: 513px;">
                                                                        <option value="">선택하세요.</option>
                                                                        <option value="63014860">조건부무료-100,000원 이상 무료/100,000원 미만 3000원/선결제 선택 (63014860)</option>
                                                                    </select></div>
                                                                <div id="sectionDeliveryFeeTemplate" class="select_delivery_fee_item">
                                                                    <div id="DefaultDeliveryFeeTemplateTxt" class="delivery_fee_setting" style="user-select: auto !important; display: none;">
                                                                        설정한 배송비 템플릿이 없습니다. [템플릿 신규 등록] 버튼을 눌러 설정하세요.
                                                                        <a id="btnDeliveryFeeTemplatePopup2" class="btn-css btn-height21 darkgray"><span class="btn-inner">템플릿 신규 등록</span></a>
                                                                    </div>
                                                                    <div id="SelectedDeliveryFeeTemplateTxt" class="delivery_fee_selected">
                                                                        <div class="delivery_fee_selected_info">
                                                                            <table>
                                                                                <colgroup>
                                                                                    <col style="width: 110px;">
                                                                                    <col>
                                                                                    <col style="width: 150px;">
                                                                                    <col style="width: 95px;">
                                                                                </colgroup>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">배송비 종류</th>
                                                                                        <th scope="col">배송비 조건/금액</th>
                                                                                        <th scope="col">결제여부</th>
                                                                                        <th scope="col">배송정책번호</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><span id="SelectedDeliveryFeeTemplateTxt1">조건부무료</span></td>
                                                                                        <td><strong id="SelectedDeliveryFeeTemplateTxt2" feeamount="3000">100,000원 이상 무료/100,000원 미만 3,000원</strong></td>
                                                                                        <td><span id="SelectedDeliveryFeeTemplateTxt3">선결제 선택</span></td>
                                                                                        <td><span id="SelectedDeliveryFeeTemplateTxt4" class="delivery_policy_number">63014860</span></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="delivery_fee_selected_group"><a id="btnDeliveryFeeTemplatePopup1" class="btn-css btn-height21 darkgray"><span class="btn-inner">템플릿 신규 등록</span></a> <a id="btnDeliveryFeeTemplatePopupChange" class="btn-css btn-height21 gray"><span class="btn-inner">등록한 템플릿 수정</span></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="sectionEachDelivery" class="product_delivery_cost" style="display: none;">
                                                            <table>
                                                                <colgroup>
                                                                    <col style="width: 110px;">
                                                                    <col>
                                                                    <col style="width: 130px;">
                                                                </colgroup>
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">배송비 종류</th>
                                                                        <th scope="col">배송비 금액/조건</th>
                                                                        <th scope="col">배송비 결제 여부</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody><input id="hdnQTYEachGrade" name="hdnQTYEachGrade" type="hidden" value="[{&quot;id&quot; : 0, &quot;QTYCnt1&quot;: &quot;0&quot;, &quot;QTYCnt2&quot;: &quot;0&quot;, &quot;QTYFee&quot;: &quot;0&quot;},{&quot;id&quot; : 1, &quot;QTYCnt1&quot;: &quot;0&quot;, &quot;QTYCnt2&quot;: &quot;0&quot;, &quot;QTYFee&quot;: &quot;0&quot;}]"> <input id="hdnEachDeliveryFeeTypeSEL" name="hdnEachDeliveryFeeTypeSEL" type="hidden" value="0">
                                                                    <tr>
                                                                        <td><label><input id="rdoEachDeliveryFeeType1" name="rdoEachDeliveryFeeType" type="radio" value="1">
                                                                                무료
                                                                            </label></td>
                                                                        <td colspan="2">: 0원 (판매자 부담)</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label><input id="rdoEachDeliveryFeeType2" name="rdoEachDeliveryFeeType" type="radio" value="2">
                                                                                유료
                                                                            </label></td>
                                                                        <td>: <input disabled="disabled" id="txtEachDeliveryFeePaidAmnt" name="txtEachDeliveryFeePaidAmnt" type="text" value="0" class="txt" style="width: 120px;"> 원</td>
                                                                        <td rowspan="6" class="result"><select id="selEachDeliveryFeePayYn" class="selectType01 native" style="width: 109px;">
                                                                                <option value="1" style="user-select: auto !important; display: none;">착불/선결제 가능</option>
                                                                                <option value="2">선결제만 가능</option>
                                                                                <option value="3" style="user-select: auto !important; display: none;">착불만 가능</option>
                                                                            </select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label><input id="rdoEachDeliveryFeeType3" name="rdoEachDeliveryFeeType" type="radio" value="3">
                                                                                조건부 무료
                                                                            </label></td>
                                                                        <td>
                                                                            : <input disabled="disabled" id="txtEachDeliveryFeeConditionFreeAmnt1" name="txtEachDeliveryFeeConditionFreeAmnt1" type="text" value="0" class="txt" style="width: 95px;"> 원
                                                                            <span class="bar01"><input disabled="disabled" id="txtEachDeliveryFeeConditionFreeAmnt2" name="txtEachDeliveryFeeConditionFreeAmnt2" type="text" value="0" class="txt" style="width: 95px;">
                                                                                원 이상 구매시 무료
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><label><input id="rdoEachDeliveryFeeType4" name="rdoEachDeliveryFeeType" type="radio" value="4">
                                                                                수량별 차등
                                                                            </label></td>
                                                                        <td><input id="hdnEachDeliveryFeeQTYEachGradeTypeSEL" name="hdnEachDeliveryFeeQTYEachGradeTypeSEL" type="hidden" value="0">
                                                                            <div id="sectionEachDeliveryQTYEachGrade" class="length_grade_au" style="width: 360px;">
                                                                                <table>
                                                                                    <colgroup>
                                                                                        <col>
                                                                                        <col style="width: 40%;">
                                                                                    </colgroup>
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th scope="col">수량구간 (<strong>최대5단계</strong> 구간까지 설정 가능)</th>
                                                                                            <th scope="col" class="thleft0">배송비</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="2" class="grade_list">
                                                                                                <ol id="QTYList">
                                                                                                    <li idx="0"><span class="num" style="width:192px;"><em id="emCnt2">1.</em><input datacolunm="QTYCnt2" type="text" class="txt" style="width:32px;" value="0" disabled="disabled"> 개 미만</span><span class="cost" style="width:72px;"><input datacolunm="QTYFee" type="text" class="txt" style="width:42px;" value="0" disabled="disabled"> 원</span></li>
                                                                                                    <li idx="1"><span class="num" style="width:192px;"><em id="emCnt2">2.</em><input datacolunm="QTYCnt1" type="text" disabled="disabled" class="txt" style="width:32px;" value="0"> 개 이상</span><span class="cost" style="width:72px;"><input datacolunm="QTYFee" type="text" class="txt" style="width:42px;" value="0" disabled="disabled"> 원</span><a id="btnAddListTextType2" idx="1" cmd="add" style="cursor:pointer;"><img src="https://pics.esmplus.com/front/btn/btn_add.gif" alt="추가"></a> </li>
                                                                                                </ol>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionReturnInfoSetup">
                                                    <th scope="row" class="set_recall_info">
                                                        반품 정보 설정
                                                    </th>
                                                    <td>
                                                        <table class="n_adr_tell">
                                                            <colgroup>
                                                                <col style="width: 107px;">
                                                                <col>
                                                                <col style="width: 107px;">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr class="first">
                                                                    <th scope="row"><span id="titleReturnExchangeADDR">반품/교환주소</span></th>
                                                                    <td colspan="3"><input id="hdnReturnExchangeADDRNo" name="hdnReturnExchangeADDRNo" type="hidden" value="5001968"> <input id="hdnDefaultReturnExchangeADDRNo" name="hdnDefaultReturnExchangeADDRNo" type="hidden" value=""> <input disabled="disabled" id="txtReturnExchangeADDRZipCode" name="txtReturnExchangeADDRZipCode" type="text" value="" class="txt" style="width: 43px;"> <a id="btnReturnExchangePopup" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_seller_address.gif" alt="판매자 주소록" class="inbtn"></a> <em class="market-logo logo-gmkt-g9" style="user-select: auto !important; display: none;"><span>G마켓/G9</span></em> <label class="mb" style="user-select: auto !important; display: none;"><input id="chkCommonGmktEachADDR" name="chkCommonGmktEachADDR" type="checkbox" value="true"><input name="chkCommonGmktEachADDR" type="hidden" value="false"> 교환 주소 개별 등록</label>
                                                                        <p><input disabled="disabled" id="txtReturnExchangeADDR1" name="txtReturnExchangeADDR1" type="text" value="" class="txt" style="width: 500px;"></p> <input disabled="disabled" id="txtReturnExchangeADDR2" name="txtReturnExchangeADDR2" type="text" value="" class="txt" style="width: 500px;">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <ul class="n_titline">
                                                            <li class="fir"><em id="titleReturnExchangePhone">반품/교환연락처</em>
                                                                : 휴대전화
                                                                <select id="ReturnExchangePhoneMPNo1" disabled="disabled" class="selectType01_basic" style="width: 45px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                    <option value="010">010</option>
                                                                    <option value="011">011</option>
                                                                    <option value="016">016</option>
                                                                    <option value="017">017</option>
                                                                    <option value="018">018</option>
                                                                    <option value="019">019</option>
                                                                </select>
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneMPNo2" name="txtReturnExchangePhoneMPNo2" type="text" value="" class="txt" style="width: 40px;">
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneMPNo3" name="txtReturnExchangePhoneMPNo3" type="text" value="" class="txt" style="width: 40px;">
                                                            </li>
                                                            <li><em>일반전화</em> <select id="ReturnExchangePhoneTelNo1" disabled="disabled" class="selectType01_basic" style="width: 52px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                    <option value="02">02</option>
                                                                    <option value="0303">0303</option>
                                                                    <option value="031">031</option>
                                                                    <option value="032">032</option>
                                                                    <option value="033">033</option>
                                                                    <option value="041">041</option>
                                                                    <option value="042">042</option>
                                                                    <option value="043">043</option>
                                                                    <option value="044">044</option>
                                                                    <option value="0502">0502</option>
                                                                    <option value="0504">0504</option>
                                                                    <option value="0505">0505</option>
                                                                    <option value="0506">0506</option>
                                                                    <option value="0507">0507</option>
                                                                    <option value="051">051</option>
                                                                    <option value="052">052</option>
                                                                    <option value="053">053</option>
                                                                    <option value="054">054</option>
                                                                    <option value="055">055</option>
                                                                    <option value="061">061</option>
                                                                    <option value="062">062</option>
                                                                    <option value="063">063</option>
                                                                    <option value="064">064</option>
                                                                    <option value="070">070</option>
                                                                    <option value="080">080</option>
                                                                    <option value="0130">0130</option>
                                                                    <option value="0303">0303</option>
                                                                    <option value="0502">0502</option>
                                                                    <option value="0504">0504</option>
                                                                    <option value="0505">0505</option>
                                                                    <option value="0506">0506</option>
                                                                    <option value="0507">0507</option>
                                                                    <option value="090">전국</option>
                                                                </select>
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneTelNo2" name="txtReturnExchangePhoneTelNo2" type="text" value="" class="txt" style="width: 40px;">
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneTelNo3" name="txtReturnExchangePhoneTelNo3" type="text" value="" class="txt" style="width: 40px;">
                                                            </li>
                                                        </ul>
                                                        <div id="CommonGmktEachADDR" style="display: none;">
                                                            <table id="selectExchangeADDR" class="n_adr_tell">
                                                                <colgroup>
                                                                    <col style="width: 107px;">
                                                                    <col>
                                                                </colgroup>
                                                                <tbody>
                                                                    <tr class="first">
                                                                        <th scope="row"><em class="market-logo logo-gmkt-g9"><span>G마켓/G9</span></em><br> 교환주소</th>
                                                                        <td><input id="hdnExchangeADDRNo" name="hdnExchangeADDRNo" type="hidden" value=""> <input disabled="disabled" id="txtExchangeADDRZipCode" name="txtExchangeADDRZipCode" type="text" value="" class="txt" style="width: 43px;"> <a id="btnExchangePopup" style="cursor: pointer;"><img src="https://pics.esmplus.com/front/btn/btn_seller_address.gif" alt="판매자 주소록" class="inbtn"></a>
                                                                            <p><input disabled="disabled" id="txtExchangeADDR1" name="txtExchangeADDR1" type="text" value="" class="txt" style="width: 500px;"></p> <input disabled="disabled" id="txtExchangeADDR2" name="txtExchangeADDR2" type="text" value="" class="txt" style="width: 500px;">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <ul id="selectExchangePhone" class="n_titline">
                                                                <li class="fir"><em>교환연락처</em>
                                                                    : 휴대전화
                                                                    <select id="ExchangePhoneMPNo1" disabled="disabled" class="selectType01_basic" style="width: 45px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                        <option value="010">010</option>
                                                                        <option value="011">011</option>
                                                                        <option value="016">016</option>
                                                                        <option value="017">017</option>
                                                                        <option value="018">018</option>
                                                                        <option value="019">019</option>
                                                                    </select>
                                                                    -
                                                                    <input disabled="disabled" id="txtExchangePhoneMPNo2" name="txtExchangePhoneMPNo2" type="text" value="" class="txt" style="width: 40px;">
                                                                    -
                                                                    <input disabled="disabled" id="txtExchangePhoneMPNo3" name="txtExchangePhoneMPNo3" type="text" value="" class="txt" style="width: 40px;">
                                                                </li>
                                                                <li><em>일반전화</em> <select id="ExchangePhoneTelNo1" disabled="disabled" class="selectType01_basic" style="width: 45px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                        <option value="02">02</option>
                                                                        <option value="0303">0303</option>
                                                                        <option value="031">031</option>
                                                                        <option value="032">032</option>
                                                                        <option value="033">033</option>
                                                                        <option value="041">041</option>
                                                                        <option value="042">042</option>
                                                                        <option value="043">043</option>
                                                                        <option value="044">044</option>
                                                                        <option value="0502">0502</option>
                                                                        <option value="0504">0504</option>
                                                                        <option value="0505">0505</option>
                                                                        <option value="0506">0506</option>
                                                                        <option value="0507">0507</option>
                                                                        <option value="051">051</option>
                                                                        <option value="052">052</option>
                                                                        <option value="053">053</option>
                                                                        <option value="054">054</option>
                                                                        <option value="055">055</option>
                                                                        <option value="061">061</option>
                                                                        <option value="062">062</option>
                                                                        <option value="063">063</option>
                                                                        <option value="064">064</option>
                                                                        <option value="070">070</option>
                                                                        <option value="080">080</option>
                                                                        <option value="0130">0130</option>
                                                                        <option value="0303">0303</option>
                                                                        <option value="0502">0502</option>
                                                                        <option value="0504">0504</option>
                                                                        <option value="0505">0505</option>
                                                                        <option value="0506">0506</option>
                                                                        <option value="0507">0507</option>
                                                                    </select>
                                                                    -
                                                                    <input disabled="disabled" id="txtExchangePhoneTelNo2" name="txtExchangePhoneTelNo2" type="text" value="" class="txt" style="width: 40px;">
                                                                    -
                                                                    <input disabled="disabled" id="txtExchangePhoneTelNo3" name="txtExchangePhoneTelNo3" type="text" value="" class="txt" style="width: 40px;">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <ul class="n_titline">
                                                            <li class="fir"><em>반품/교환택배사</em><span>: 발송한 택배사</span> <select id="selReturnExchangeSetupDeliveryCOMP" class="selectType01_basic" style="width: 140px; height: 19px; display: none;">
                                                                    <option value="">선택하세요</option>
                                                                    <option value="0001">우체국택배</option>
                                                                    <option value="0002">한진택배</option>
                                                                    <option value="0004">롯데택배</option>
                                                                    <option value="0005">로젠택배</option>
                                                                    <option value="0008">CJ GLS택배</option>
                                                                    <option value="0010">GTX택배</option>
                                                                    <option value="0011">이노지스택배</option>
                                                                    <option value="0012">하나로택배</option>
                                                                    <option value="0013">일양택배</option>
                                                                    <option value="0014">천일택배</option>
                                                                    <option value="0015">대신택배</option>
                                                                    <option value="0016">경동택배</option>
                                                                    <option value="0017">합동택배</option>
                                                                    <option value="0018">위니아물류</option>
                                                                    <option value="0024">편의점택배(GS25)</option>
                                                                </select></li>
                                                            <li><em>반품/교환 배송비 (편도기준)</em> <input id="txtReturnExchangeDeliveryFee" name="txtReturnExchangeDeliveryFee" type="text" value="" class="txt" style="width: 85px;"> 원
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr id="sectionDeliveryTPLInfo" class="item item_goods-deliveryinfo" style="user-select: auto !important; display: none;">
                                <th>
                                    <div class="label">
                                        배송정보
                                        <em class="required-mark"><span>필수</span></em>
                                    </div>
                                </th>
                                <td colspan="3">
                                    <div class="goods-deliveryinfo">
                                        <div class="deliveryinfo_group">
                                            <dl class="deliveryinfo_group-list">
                                                <dt>이 상품의 그룹 배송정보</dt>
                                                <dd><span id="spanGroupDeliveryTPLInfo">스마일배송</span></dd>
                                            </dl>
                                            <ul class="deliveryinfo_group-notice" style="display: none;">
                                                <li class="deliveryinfo_group-notice-item" style="display: none;">
                                                    * 본 상품은
                                                    <strong class="group_item">[<span class="c_iac">A</span>옥션 <span class="num">0</span>]</strong> <span class="group_name"></span> 그룹에 속한 상품으로 그룹의 배송정보는 위와 같습니다.
                                                </li>
                                                <li class="deliveryinfo_group-notice-item" style="display: none;">
                                                    * 본 상품은
                                                    <strong class="group_item">[<span class="c_gmkt">G</span>마켓<span class="num">0</span>]</strong> <span class="group_name"></span> 그룹에 속한 상품으로 그룹의 배송정보는 위와 같습니다.
                                                </li>
                                                <li class="deliveryinfo_group-notice-item">
                                                    * 상품의 배송정보를
                                                    <strong class="point">그룹의 배송정보와 다른 조건으로 변경할 경우 그룹에서 삭제(=그룹 내 상품에서 제외)</strong> 되므로 이점 유의하시기 바랍니다.
                                                </li>
                                            </ul>
                                            <ul class="deliveryinfo_group-notice">
                                                <li class="deliveryinfo_group-notice-item">* 본 상품은 그룹에 속하지 않은 상품으로, 위와 동일한 배송번호끼리만 그룹 생성이 가능합니다.</li>
                                                <li class="deliveryinfo_group-notice-item">* 이미 생성된 그룹에 추가할 경우도 마찬가지로 그룹의 배송조건이 위 배송번호와 동일해야 합니다.</li>
                                            </ul>
                                        </div>
                                        <table class="n_tdinboard" style="margin: 0px;">
                                            <colgroup>
                                                <col style="width: 15%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                                <tr id="sectionDeliveryTypeSetupTPL">
                                                    <th scope="row">발송정책</th>
                                                    <td>
                                                        <div class="manage-delivery-type">
                                                            <div id="divTransPolicyIacTPL" class="set-delivery-type">
                                                                <div class="delivery-type-choice"><em class="market-logo logo-iac-double"><span>옥션</span></em> <select id="transTypeChoiceIacTpl" title="선택해주세요" disabled="disabled" style="width: 397px;">
                                                                        <option value="1" transtype="G">스마일배송 / 발송마감시간 20시 00분까지</option>
                                                                    </select></div>
                                                            </div>
                                                            <div id="divTransPolicyGmktTPL" class="set-delivery-type">
                                                                <div class="delivery-type-choice"><em class="market-logo logo-gmkt-g9"><span>G마켓/G9</span></em> <select id="transTypeChoiceGmktTpl" title="선택해주세요" disabled="disabled" style="width: 397px;">
                                                                        <option value="1" transtype="G">스마일배송 / 발송마감시간 20시 00분까지</option>
                                                                    </select></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionDeliveryWaySetupTPL">
                                                    <th scope="row">배송방법</th>
                                                    <td>
                                                        <div class="ship_3pl">스마일배송 이용 상품배송</div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionDeliveryFeeSetupTPL">
                                                    <th scope="row">배송비 설정</th>
                                                    <td>
                                                        <div class="tpl-delivery-free">
                                                            <p class="delivery-free-tip">‘무료배송’ 선택 시, 고객에게 더욱 유리한 구매 조건을 제공할 수 있습니다. <a href="//efm.esmplus.com/manual/tplguide/free_shipping_intro" target="_blank">왜 <strong>‘무료배송’</strong> 이여야 할까요?</a></p>
                                                            <div class="delivery-free-content">
                                                                <div id="divDeliveryFee">
                                                                    <div class="delivery-free-set"><input id="TplDeliveryFree" name="rdoTplDelivery" type="radio" value="Free"> <label for="TplDeliveryFree" class="delivery-type">무료배송</label>
                                                                        <div class="delivery-free-info" style="display: block;">
                                                                            <dl class="delivery-free-info-list">
                                                                                <dt>배송비 :</dt>
                                                                                <dd><span class="alphanumeric">0</span>원</dd>
                                                                                <dt>묶음배송 :</dt>
                                                                                <dd>가능</dd>
                                                                            </dl> <span class="basic-delivery-fee">판매자 장바구니 기준 <span class="alphanumeric">1</span>건당 <span id="spanSellerFundingFee" class="number"></span>원</span>
                                                                        </div>
                                                                        <ul class="delivery-free-notice">
                                                                            <li class="delivery-free-notice__item">장바구니 당 발생하는 배송 비용을 판매자가 부담하는 조건으로 <strong class="hilite">'무료배송'</strong> 판매가 가능합니다.</li>
                                                                            <li class="delivery-free-notice__item">합포장 가능 상품은 장바구니 개수(결제 기준) x 판매자 부담 비용 금액으로 매월 정산 시 합산 청구됩니다.</li>
                                                                            <li class="delivery-free-notice__item">합포장 불가 상품은 발송한 송장 개수 x 판매자 부담 비용 금액으로 매월 정산 시 합산 청구됩니다.</li>
                                                                            <li class="delivery-free-notice__item">자세한 설명은 <a href="#" target="_blank" class="button-user-guide">이용가이드</a>를 참고해 주시기 바랍니다.</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="delivery-free-set"><input checked="checked" id="TplDeliveryFee" name="rdoTplDelivery" type="radio" value="Fee"> <label for="TplDeliveryFee" class="delivery-type">유료배송</label>
                                                                        <ul class="delivery-free-notice">
                                                                            <li class="delivery-free-notice__item">유료배송으로 설정 시, <strong class="hilite">구매자가 배송비 <span class="alphanumeric">3,000</span>원을 결제</strong>해야 합니다.</li>
                                                                        </ul>
                                                                        <div class="delivery-free-info" style="display: block;">
                                                                            <dl class="delivery-free-info-list">
                                                                                <dt>배송비 :</dt>
                                                                                <dd><span id="txtTPLDeliveryFee" class="alphanumeric"></span>원 (선결제)</dd>
                                                                                <dt>묶음배송 :</dt>
                                                                                <dd><span id="txtTPLDeliveryFeeType"></span></dd>
                                                                            </dl> <span class="basic-delivery-fee" style="display: none;">판매자 장바구니 기준 <span class="alphanumeric">1</span>건당 <span class="number">1,800</span>원</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="divNonDeliveryFee">
                                                                    <div class="delivery-free-set"><input type="radio" name="rdoDivNonDeliveryFee" disabled="disabled"> <label class="delivery-type">무료배송</label>
                                                                        <ul class="delivery-free-notice">
                                                                            <li class="delivery-free-notice__item">장바구니 당 발생하는 배송 비용을 판매자가 부담하는 조건으로 <strong class="hilite">'무료배송'</strong> 판매가 가능합니다.</li>
                                                                            <li class="delivery-free-notice__item">합포장 가능 상품은 장바구니 개수(결제 기준) x 판매자 부담 비용 금액으로 매월 정산 시 합산 청구됩니다.</li>
                                                                            <li class="delivery-free-notice__item">합포장 불가 상품은 발송한 송장 개수 x 판매자 부담 비용 금액으로 매월 정산 시 합산 청구됩니다.</li>
                                                                            <li class="delivery-free-notice__item">자세한 설명은 <a href="#" target="_blank" class="button-user-guide">이용가이드</a>를 참고해 주시기 바랍니다.</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="delivery-free-set"><input type="radio" name="rdoDivNonDeliveryFee" disabled="disabled"> <label class="delivery-type">유료배송</label>
                                                                        <ul class="delivery-free-notice">
                                                                            <li class="delivery-free-notice__item">유료배송으로 설정 시, <strong class="hilite">구매자가 배송비 <span class="alphanumeric">3,000</span>원을 결제</strong>해야 합니다.</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="sectionReturnInfoSetupTPL">
                                                    <th scope="row">반품 정보 설정</th>
                                                    <td>
                                                        <table class="n_adr_tell">
                                                            <colgroup>
                                                                <col style="width: 107px;">
                                                                <col>
                                                                <col style="width: 107px;">
                                                                <col>
                                                            </colgroup>
                                                            <tbody>
                                                                <tr class="first">
                                                                    <th scope="row"><span id="titleReturnExchangeADDR">반품/교환주소</span></th>
                                                                    <td colspan="3"><input id="hdnReturnExchangeADDRNo" name="hdnReturnExchangeADDRNoTPL" type="hidden" value="5001968"> <input id="hdnDefaultReturnExchangeADDRNo" name="hdnDefaultReturnExchangeADDRNoTPL" type="hidden" value=""> <input disabled="disabled" id="txtReturnExchangeADDRZipCodeTPL" name="txtReturnExchangeADDRZipCodeTPL" type="text" value="" class="txt" style="width: 43px;">
                                                                        <p><input disabled="disabled" id="txtReturnExchangeADDR1TPL" name="txtReturnExchangeADDR1TPL" type="text" value="" class="txt" style="width: 500px;"></p> <input disabled="disabled" id="txtReturnExchangeADDR2TPL" name="txtReturnExchangeADDR2TPL" type="text" value="" class="txt" style="width: 500px;">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <ul class="n_titline">
                                                            <li class="fir"><em id="titleReturnExchangePhone">반품/교환연락처</em>
                                                                : 휴대전화
                                                                <select id="ReturnExchangePhoneMPNo1TPL" disabled="disabled" class="selectType01_basic" style="width: 45px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                    <option value="010">010</option>
                                                                    <option value="011">011</option>
                                                                    <option value="016">016</option>
                                                                    <option value="017">017</option>
                                                                    <option value="018">018</option>
                                                                    <option value="019">019</option>
                                                                </select> -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneMPNo2TPL" name="txtReturnExchangePhoneMPNo2TPL" type="text" value="" class="txt" style="width: 40px;">
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneMPNo3TPL" name="txtReturnExchangePhoneMPNo3TPL" type="text" value="" class="txt" style="width: 40px;">
                                                            </li>
                                                            <li><em>일반전화</em> <select id="ReturnExchangePhoneTelNo1TPL" disabled="disabled" class="selectType01_basic" style="width: 52px; height: 19px; background-color: rgb(235, 235, 228);">
                                                                    <option value="02">02</option>
                                                                    <option value="0303">0303</option>
                                                                    <option value="031">031</option>
                                                                    <option value="032">032</option>
                                                                    <option value="033">033</option>
                                                                    <option value="041">041</option>
                                                                    <option value="042">042</option>
                                                                    <option value="043">043</option>
                                                                    <option value="044">044</option>
                                                                    <option value="0502">0502</option>
                                                                    <option value="0504">0504</option>
                                                                    <option value="0505">0505</option>
                                                                    <option value="0506">0506</option>
                                                                    <option value="0507">0507</option>
                                                                    <option value="051">051</option>
                                                                    <option value="052">052</option>
                                                                    <option value="053">053</option>
                                                                    <option value="054">054</option>
                                                                    <option value="055">055</option>
                                                                    <option value="061">061</option>
                                                                    <option value="062">062</option>
                                                                    <option value="063">063</option>
                                                                    <option value="064">064</option>
                                                                    <option value="070">070</option>
                                                                    <option value="080">080</option>
                                                                    <option value="0130">0130</option>
                                                                    <option value="0303">0303</option>
                                                                    <option value="0502">0502</option>
                                                                    <option value="0504">0504</option>
                                                                    <option value="0505">0505</option>
                                                                    <option value="0506">0506</option>
                                                                    <option value="0507">0507</option>
                                                                    <option value="090">전국</option>
                                                                </select> -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneTelNo2TPL" name="txtReturnExchangePhoneTelNo2TPL" type="text" value="" class="txt" style="width: 40px;">
                                                                -
                                                                <input disabled="disabled" id="txtReturnExchangePhoneTelNo3TPL" name="txtReturnExchangePhoneTelNo3TPL" type="text" value="" class="txt" style="width: 40px;">
                                                            </li>
                                                        </ul>
                                                        <ul class="n_titline">
                                                            <li class="fir"><em>수거택배사</em><span>: 발송한 택배사</span> <select id="selReturnExchangeSetupDeliveryCOMPTPL" class="selectType01_basic" style="width: 140px; height: 19px; display: none;">
                                                                    <option value="">선택하세요</option>
                                                                    <option value="0001">우체국택배</option>
                                                                    <option value="0002">한진택배</option>
                                                                    <option value="0003">대한통운</option>
                                                                    <option value="0004">롯데택배</option>
                                                                    <option value="0005">로젠택배</option>
                                                                    <option value="0008">CJ GLS택배</option>
                                                                    <option value="0010">GTX택배</option>
                                                                    <option value="0011">이노지스택배</option>
                                                                    <option value="0012">하나로택배</option>
                                                                    <option value="0013">일양택배</option>
                                                                    <option value="0014">천일택배</option>
                                                                    <option value="0015">대신택배</option>
                                                                    <option value="0016">경동택배</option>
                                                                    <option value="0017">합동택배</option>
                                                                    <option value="0018">위니아물류</option>
                                                                    <option value="0024">편의점택배(GS25)</option>
                                                                </select></li>
                                                            <li><em>반품/교환 배송비 (편도기준)</em> <input id="txtReturnExchangeDeliveryFeeTPL" name="txtReturnExchangeDeliveryFeeTPL" type="text" value="" class="txt" style="width: 85px;"> 원
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <!---->
                        </tbody>
                    </table>

                </div>
                <div id="tab03" class="tab_con"></div>
                <div id="tab04" class="tab_con"></div>
            </div>
        </div>
        <!--
        <div class="coming_soon">
            <p class="">내용 준비중입니다.</p>
        </div>
-->
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.write_tab_wrap > a').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('.write_tab_wrap > a').removeClass('active');
            $('.tab_con').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });

    });

</script>
<?php echo view('common/footer'); ?>
