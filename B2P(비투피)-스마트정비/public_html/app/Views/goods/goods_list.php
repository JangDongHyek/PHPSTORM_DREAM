
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "제품 현황";

alert($msg);
?>


<div class="goods">

    <?php echo view('goods/goods_head', $this->data); ?>
        <!--0624 새작업-->

        <div class="ad_wrap">
            <div class="flex jc-sb">
                <p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> 포커스 (유료광고 검토필요)</p>
                <h1>종료 7일전 <span class="color-blue">0건</span> | 전체 0건</h1>
            </div>
            <div class="flex jc-sb">
                <p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> 포커스플러스</p>
                <h1>종료 7일전 <span class="color-blue">0건</span> | 전체 0건</h1>
            </div>
            <div class="flex jc-sb">
                <p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> 프리미엄</p>
                <h1>종료 7일전 <span class="color-blue">0건</span> | 전체 0건</h1>
            </div>
            <div class="flex jc-sb">
                <p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> 프리미엄플러스</p>
                <h1>종료 7일전 <span class="color-blue">0건</span> | 전체 0건</h1>
            </div>
        </div>

        <div class="state_wrap">
            <div class="flex gap5 flexwrap w25">
                <h1>전체 <b><span class="color-blue"><?=number_format($goods_data['allCount_gmkt']+$goods_data['allCount_iac'])?></span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b><?=number_format($goods_data['allCount_gmkt'])?></b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b><?=number_format($goods_data['allCount_iac'])?></b>건</p></li>
                </ul>
            </div>
            <div class="flex gap5 flexwrap w25">
                <h1>재고 10개 이하 <b><span class="color-blue"><?=number_format($goods_data['stockCount_gmkt']+$goods_data['stockCount_iac'])?></span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b><?=number_format($goods_data['stockCount_gmkt'])?></b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b><?=number_format($goods_data['stockCount_iac'])?></b>건</p></li>
                </ul>
            </div>
            <div class="flex gap5 flexwrap w25">
                <h1>판매 종료 7일 <b><span class="color-blue"><?=number_format($goods_data['sevenDay_gmkt']+$goods_data['sevenDay_iac'])?></span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b><?=number_format($goods_data['sevenDay_gmkt'])?></b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b><?=number_format($goods_data['sevenDay_iac'])?></b>건</p></li>
                </ul>
            </div>
            <div class="flex gap5 flexwrap w25">
                <h1>판매중 <b><span class="color-blue"><?=number_format($goods_data['sellCount_gmkt']+$goods_data['sellCount_iac'])?></span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b><?=number_format($goods_data['sellCount_gmkt'])?></b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b><?=number_format($goods_data['sellCount_iac'])?></b>건</p></li>
                </ul>
            </div>
<!--            <div class="flex gap5 flexwrap">
                <h1>판매불가(불가능) <b><span class="color-blue">10</span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b>10</b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b>10</b>건</p></li>
                </ul>
            </div>-->
            <div class="flex gap5 flexwrap w25">
                <h1>판매중지 <b><span class="color-blue"><?=number_format($goods_data['endSellCount_gmkt']+$goods_data['endSellCount_iac'])?></span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b><?=number_format($goods_data['endSellCount_gmkt'])?></b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b><?=number_format($goods_data['endSellCount_iac'])?></b>건</p></li>
                </ul>
            </div>
            <!--<div class="flex gap5 flexwrap">
                <h1>SKU품절(무슨기능?) <b><span class="color-blue">10</span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b>10</b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b>10</b>건</p></li>
                </ul>
            </div>-->
<!--            <div class="flex gap5 flexwrap">
                <h1>노출 제한(불가능) <b><span class="color-blue">10</span>건</b></h1>
                <ul>
                    <li><p><span class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></span> <b>10</b>건</p></li>
                    <li><p><span class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></span> <b>10</b>건</p></li>
                </ul>
            </div>-->
        </div>

        <form>
            <div class="sch_wrap">
                <p class="tit flex gap5">검색결과
                    <a class="btn btn-gray btn-md male-auto" href="<?=base_url('goods/')?>?" >조건초기화</a>
                    <button class="btn btn-blue btn-md" onclick="">검색하기</button>
                </p>
                <div class="box gap10">
                    <div class="sch01 w49">
                        <p>검색하기</p>
                        <div class="input_select">
                            <select class="border_gray" id="sf_no" name="sf_no">
                                <option value="goods_no" <?= get_selected($sf_no, "goods_no")?>>상품번호/마스터상품번호</option>
                            </select>
                        </div>

                        <div class="input_search">
                            <input type="text" placeholder="복수 상품 검색시 쉼표(,)로 구부하여 입력하세요" class="border_gray w100" id="st_no" name="st_no" value="<?=$st_no?>">
                        </div>
                    </div>
                    <div class="sch01 w49">
                        <p>검색어</p>
                        <div class="input_select">
                            <select class="border_gray" id="sf_name" name="sf_name">
                                <option value="goods_name" <?php echo get_selected($sf, "goods_name_kor"); ?>>상품명</option>
                            </select>
                        </div>

                        <div class="input_search">
                            <input type="text" placeholder="상품명을 입력하세요." class="border_gray" id="st_name" name="st_name" value="<?=$st_name?>">
                        </div>
                    </div>
                    <div class="w49">
                        <script>
                            $(document).ready(function(){
                                $('#sellState_all').change(function(){
                                    var isChecked = $(this).is(':checked');
                                    $('#sellState_t, #sellState_f, #sellState_s').prop('checked', isChecked);
                                });

                                $('#sellState_t, #sellState_f, #sellState_s').change(function(){
                                    if($('#sellState_t').is(':checked') || $('#sellState_f').is(':checked') || $('#sellState_s').is(':checked')) {
                                        $('#sellState_all').prop('checked', false);
                                    } else {
                                        $('#sellState_all').prop('checked', true);
                                    }
                                });
                            });
                        </script>
                        <p>판매상태</p>
                        <div class="input_radio">
                            <?php
                            // 변수가 설정되어 있고 해당 값이 'T'인지 확인하여 체크박스 상태를 설정합니다.
                            $isCheckedT = isset($sellState_t) && $sellState_t === 'T' ? 'checked' : '';
                            $isCheckedF = isset($sellState_f) && $sellState_f === 'T' ? 'checked' : '';
                            $isCheckedS = isset($sellState_s) && $sellState_s === 'T' ? 'checked' : '';

                            // 모든 체크박스가 체크되어 있거나 하나도 체크되어 있지 않은 경우 '전체'를 체크합니다.
                            if (($isCheckedT && $isCheckedF && $isCheckedS) || (!$isCheckedT && !$isCheckedF && !$isCheckedS)) {
                                $isCheckedAll = 'checked';
                                if (!$isCheckedT && !$isCheckedF && !$isCheckedS) {
                                    // '전체'만 체크되어 있을 경우, 모든 개별 체크박스도 체크 상태로 설정합니다.
                                    $isCheckedT = $isCheckedF = $isCheckedS = 'checked';
                                }
                            } else {
                                $isCheckedAll = '';
                            }
                            ?>
                            <input type="checkbox" id="sellState_all" name="sellState_all" value="T" <?= $isCheckedAll ?>>
                            <label for="sellState_all">전체</label>
                            <input type="checkbox" id="sellState_t" name="sellState_t" value="T" <?= $isCheckedT ?>>
                            <label for="sellState_t">판매가능</label>
                            <!--<input type="checkbox" id="sellState_f" name="sellState_f" value="T" <?/*= $isCheckedF */?>>
                            <label for="sellState_f">판매불가</label>-->
                            <input type="checkbox" id="sellState_s" name="sellState_s" value="T" <?= $isCheckedS ?>>
                            <label for="sellState_s">판매중지</label>
                            <!--<input type="checkbox" id="" name="" value="T">
                            <label for="">
                                SKU품절
                            </label>-->
                            <!--<input type="checkbox" id="" name="" value="T">
                            <label for="">
                                등록대기
                            </label>-->
                        </div>
                    </div>
                    <div class="w49">
                        <p>카테고리</p>

                        <div class="input_select">
                            <select class="border_gray" id="esm_category_code" name="esm_category_code">
                                <option value="" <?=get_selected($esm_category_code, "")?>>전체</option>
                                <?
                                    foreach ($esm_category_list as $i => $item) { ?>
                                        <option value="<?=$item['code']?>" <?=get_selected($item['code'], $esm_category_code)?>><?=$item['name']?></option>
                                    <?}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="sch01 w100">
                        <script>
                            $(document).ready(function() {
                                // 날짜 입력 변경 감지
                                $('#start_date, #end_date').change(function() {
                                    // 사용자가 날짜를 직접 입력하면 모든 라디오 버튼 선택 해제
                                    $('input[name="dtRange"]').prop('checked', false);
                                });

                                $('input[name="dtRange"]').change(function() {
                                    var selectedRange = $(this).val();
                                    var today = new Date();
                                    var startDate, endDate;

                                    function formatDate(date) {
                                        var d = new Date(date),
                                            month = '' + (d.getMonth() + 1),
                                            day = '' + d.getDate(),
                                            year = d.getFullYear();
                                        if (month.length < 2) month = '0' + month;
                                        if (day.length < 2) day = '0' + day;
                                        return [year, month, day].join('-');
                                    }

                                    switch(selectedRange) {
                                        case '1': // 오늘
                                            startDate = endDate = formatDate(today);
                                            break;
                                        case '2': // 1주일
                                            endDate = formatDate(today);
                                            today.setDate(today.getDate() - 7);
                                            startDate = formatDate(today);
                                            break;
                                        case '3': // 1개월
                                            endDate = formatDate(today);
                                            today.setMonth(today.getMonth() - 1);
                                            startDate = formatDate(today);
                                            break;
                                        case '4': // 3개월
                                            endDate = formatDate(today);
                                            today.setMonth(today.getMonth() - 3);
                                            startDate = formatDate(today);
                                            break;
                                        case '5': // 6개월
                                            endDate = formatDate(today);
                                            today.setMonth(today.getMonth() - 6);
                                            startDate = formatDate(today);
                                            break;
                                        case '6': // 1년
                                            endDate = formatDate(today);
                                            today.setFullYear(today.getFullYear() - 1);
                                            startDate = formatDate(today);
                                            break;
                                        case '7': // 전체
                                            startDate = endDate = '';
                                            break;
                                    }

                                    $('#start_date').val(startDate);
                                    $('#end_date').val(endDate);
                                });

                                // 페이지 로드 시 초기 값 설정
                                if ($('#start_date').val() || $('#end_date').val()) {
                                    // 날짜가 입력되어 있으면 라디오 버튼 선택 해제
                                    $('input[name="dtRange"]').prop('checked', false);
                                } else {
                                    // 날짜 입력이 없으면 "전체" 선택
                                    $('input[name="dtRange"][value="7"]').prop('checked', true).trigger('change');
                                }
                            });
                        </script>


                        <p>기간</p>
                        <div class="input_select">
                            <select class="border_gray" id="sf_date" name="sf_date">
                                <option value="1" <?=get_selected($sf_date,"1")?>>상품등록일</option>
                                <option value="2" <?=get_selected($sf_date,"2")?>>판매종료일</option>
                                <option value="3" <?=get_selected($sf_date,"3")?>>최종수정일조회</option>
                            </select>
                        </div>

                        <div class="input_date">
                            <div class="select flex nowrap">
                                <?
                                $dateRange = ['1' => '오늘', '2' => '1주일', '3' => '1개월', '4' => '3개월', '5' => '6개월', '6' => '1년', '7' => '전체'];
                                foreach ($dateRange as $key => $val) {
                                    $checked = ($_GET['dtRange'] == $key) || (!isset($_GET['dtRange']) && $key == '7') ? "checked" : "";
                                    $id = "dtr{$key}";
                                    ?>
                                    <input type="radio" id="<?= $id ?>" name="dtRange" value="<?= $key ?>" <?= $checked ?>/>
                                    <label for="<?= $id ?>"><?= $val ?></label>
                                <? } ?>
                            </div>

                            <div class="input_select">
                                <input type="date" id="start_date" name="start_date" class="border_gray" value="<?=$start_date?>">
                            </div>
                            ~
                            <div class="input_select">
                                <input type="date" id="end_date" name="end_date" class="border_gray" value="<?=$end_date?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>        <!-- 기본검색 -->

            <div class="sch_wrap">
                <p class="tit">상세검색
                    <input type="checkbox" id="schMore" name="" value="T" style="display: none">
                    <label for="schMore" class="btn btn-blue btn-mini">보기</label>
                </p>
                <div class="box v2 gap10">

                    <div class="input_select">
                        <select class="border_gray" id="sf_sellDate" name="sf_sellDate">
                            <option value="" <?=get_selected($sf_sellDate,"")?>>판매기간</option>
                            <option value="3" <?=get_selected($sf_sellDate,"3")?>>3일 이내</option>
                            <option value="7" <?=get_selected($sf_sellDate,"7")?>>7일 이내</option>
                            <option value="15" <?=get_selected($sf_sellDate,"15")?>>15일 이내</option>
                            <option value="30" <?=get_selected($sf_sellDate,"30")?>>30일 이내</option>
                        </select>
                    </div>
                    <div class="input_select">
                        <select class="border_gray" id="sf_stock" name="sf_stock">
                            <option value="" <?=get_selected($sf_stock,"")?>>재고</option>
                            <option value="0" <?=get_selected($sf_stock,"0")?>>없음</option>
                            <option value="10" <?=get_selected($sf_stock,"10")?>>10개 이하</option>
                            <option value="50" <?=get_selected($sf_stock,"50")?>>50개 이하</option>
                            <option value="100" <?=get_selected($sf_stock,"100")?>>100개 이하</option>
                        </select>
                    </div>
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>스마일배송</option>
                            <option>사용</option>
                            <option>미사용</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf_useCatalogue" name="sf_useCatalogue">
                            <option value="" <?/*=get_selected($sf_useCatalogue,"")*/?>>카달로그</option>
                            <option value="T" <?/*=get_selected($sf_useCatalogue,"T")*/?>>등록</option>
                            <option value="F" <?/*=get_selected($sf_useCatalogue,"F")*/?>>미등록</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>선물하기 여부</option>
                            <option>등록</option>
                            <option>미등록</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>Shop 카테고리</option>
                            <option>등록</option>
                            <option>미등록</option>
                        </select>
                    </div>-->
                    <div class="input_select">
                        <select class="border_gray" id="sf_useOption" name="sf_useOption">
                            <option value="" <?=get_selected($sf_useOption,"")?>>옵션</option>
                            <option value="T" <?=get_selected($sf_useOption,"T")?>>사용</option>
                            <option value="F" <?=get_selected($sf_useOption,"F")?>>미사용</option>
                        </select>
                    </div>

                    <div class="input_select">
                        <select class="border_gray" id="sf_useSale" name="sf_useSale">
                            <option value="" <?=get_selected($sf_useSale,"")?>>할인</option>
                            <option value="T" <?=get_selected($sf_useSale,"T")?>>등록</option>
                            <option value="F" <?=get_selected($sf_useSale,"F")?>>미등록</option>
                        </select>
                    </div>
                    <div class="input_select">
                        <select class="border_gray" id="sf_shippingType" name="sf_shippingType">
                            <option value="" <?=get_selected($sf_shippingType,"")?>>배송비</option>
                            <option value="1" <?=get_selected($sf_shippingType,"1")?>>무료</option>
                            <option value="2" <?=get_selected($sf_shippingType,"2")?>>유료</option>
                            <option value="3" <?=get_selected($sf_shippingType,"3")?>>조건부무료</option>
                        </select>
                    </div>
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>출고지</option>
                            <option>대표 기본 출하지</option>
                        </select>
                    </div>-->
                    <div class="input_select">
                        <select class="border_gray" id="sf_policyNo" name="sf_policyNo">
                            <option value="">발송정책</option>
                            <?
                            foreach ($dispatch_policy_data as $index => $data){ ?>
                                <option value="<?="{$data['gmarket_reg_no']},{$data['auction_reg_no']}"?>" <?=get_selected($sf_policyNo, "{$data['gmarket_reg_no']},{$data['auction_reg_no']}")?>><?=$data['dispatch_policy']." > ".$data['dispatch_info']?></option>
                            <?}
                            ?>
                        </select>
                    </div>
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>설치상품</option>
                            <option>설정</option>
                            <option>미설정</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>스마일배송 배송비</option>
                            <option>유료</option>
                            <option>무료</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>G 포커스</option>
                            <option>적용</option>
                            <option>미적용</option>
                            <option>종료 3일전</option>
                            <option>종료 7일전</option>
                            <option>종료 15일전</option>
                            <option>종료 30일전</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>G 포커스 플러스</option>
                            <option>적용</option>
                            <option>미적용</option>
                            <option>종료 3일전</option>
                            <option>종료 7일전</option>
                            <option>종료 15일전</option>
                            <option>종료 30일전</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>A 프리미엄</option>
                            <option>적용</option>
                            <option>미적용</option>
                            <option>종료 3일전</option>
                            <option>종료 7일전</option>
                            <option>종료 15일전</option>
                            <option>종료 30일전</option>
                        </select>
                    </div>-->
                    <!--<div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option>A 프리미엄 플러스</option>
                            <option>적용</option>
                            <option>미적용</option>
                            <option>종료 3일전</option>
                            <option>종료 7일전</option>
                            <option>종료 15일전</option>
                            <option>종료 30일전</option>
                        </select>
                    </div>-->
                </div>
            </div>        <!-- 상세검색 -->
        </form>



        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1>총 <?=number_format($goods_data['total_count'])?>개</h1>
                    <a href="<?=base_url('goods/goods_form')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
                <div class="wrap w100 flex">
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsStateModal()">판매 상태 일괄 변경</button>
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsPeriodModal()">판매 기간 일괄 변경</button>
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsPriceModal()">판매가 설정</button>
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsDcModal()" ">할인 설정</button>
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsStockModal()">재고 변경</button>
                    <button type="button" class="btn btn-white btn-mini" data-toggle="modal" onclick="goodsDeliveryModal()">배송정보 변경</button>
                    <!--<button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#">부가서비스 설정</button>-->
                    <input type="checkbox" id="goodsEdit" style="display: none">
                    <label for="goodsEdit" class="btn btn-white btn-mini">기타정보 수정
                        <ul>
                            <li data-toggle="modal" onclick="goodsPromoModal()">프로모션문구</li>
                            <li data-toggle="modal" onclick="goodsMaxModal()">최대구매수량</li>
                            <li data-toggle="modal" onclick="goodsBenefitModal()">사은품</li>
                            <li data-toggle="modal" onclick="goodsDonateModal()">후원/나눔쇼핑</li>
                            <li data-toggle="modal" onclick="goodsMoreModal()" >덤</li>
                            <li data-toggle="modal" onclick="goodsCompareModal()">포털가격비교사이트</li>
                            <li data-toggle="modal" onclick="goodsSmileModal()">판매자지급 스마일캐시</li>
                        </ul>
                    </label>
                    <!--<button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#">그룹생성</button>-->
                    <button type="button" class="btn btn-gray btn-mini" onclick="goodsDeleteModal()">선택 삭제</button>
                </div>
            </div>
            <div class="table"> <!-- 목록 -->
                <table>
                    <thead>
                        <tr>
                            <th><input id="all_check" name="all_check" type="checkbox"/></th>
                            <th>수정</th>
                            <th>마스터상품번호</th>
                            <th>상품번호</th>
                            <th>이미지</th>
                            <th>상품명</th>
                            <th>판매상태</th>
                            <th>판매가</th>
                            <th>판매종료일(잔여일)</th>
                            <th>재고수량</th>
                            <th>카테고리</th>
                            <th>발송정책</th>
                            <th>출고(하)지</th>
                            <th>묶음배송정책 번호</th>
                            <th>최종 변경일</th>
                            <th>최초 등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?
                    $goods_list = $goods_data['list'];
                    if(count($goods_list) == 0){ ?>
                        <tr>
                            <td colspan="99">
                                데이터가 없습니다.
                            </td>
                        </tr>
                    <? } else {
                        foreach ($goods_list as $index => $data){
                            // 판매여부 확인
                            $gmkt_no = "-";
                            if(!empty($data['gmkt_no'])){
                                $gmkt_no = "<a target='_blank' href='https://item.gmarket.co.kr/Item?goodscode=".$data['gmkt_no']."'>".$data['gmkt_no']."</a>";
                            }
                            $iac_no = "-";
                            if(!empty($data['iac_no'])){
                                $iac_no = "<a target='_blank' href='http://itempage3.auction.co.kr/DetailView.aspx?ItemNo=".$data['iac_no']."&frm3=V2'>".$data['iac_no']."</a>";
                            }

                            $sell_gmkt_state = "판매중지";
                            if($data['isSell_gmkt'] == 'T' && $gmkt_no != "-"){
                                $sell_gmkt_state = "<a target='_blank' href='https://item.gmarket.co.kr/Item?goodscode=".$data['gmkt_no']."'>판매중</a>";
                            }

                            $sell_iac_state = "판매중지";
                            if($data['isSell_iac'] == 'T' && $iac_no != "-"){
                                $sell_iac_state = "<a target='_blank' href='http://itempage3.auction.co.kr/DetailView.aspx?ItemNo=".$data['iac_no']."&frm3=V2'>판매중</a>";
                            }

                            // 재고확인
                            $recommendedOpts = json_decode($data['recommendedOpts'], true);
                            if($recommendedOpts['isStockManage'] == true){
                                $stock = "옵션재고";
                            } else {
                                $stock_gmkt = empty($data['stock_gmkt']) ? 99999 : $data['stock_gmkt'];
                                $stock_iac = empty($data['stock_iac']) ? 99999 : $data['stock_iac'];
                                $stock = min($stock_gmkt, $stock_iac);
                                $stock = number_format($stock);
                            }
                            
                            // 판매남은일자 확인
                            $interval = "9999-12-31";
                            $daysLeft = "-";
                            if($data['endSellDate'] != "9999-12-31"){
                                $futureDate = new DateTime($data['endSellDate']);
                                $today = new DateTime();
                                $formattedDate = $futureDate->format('Y-m-d');
                                $interval = $today->diff($futureDate);
                                // 남은 일수 가져오기
                                $daysLeft = $interval->days;
                            }

                            
                            // 5분이 지났는지 확인
                            $current_time = new DateTime();
                            $registration_time = new DateTime($data['reg_date']);
                            $registration_time->add(new DateInterval('PT5M'));

                            $edit_chekbox = "5분 후";
                            $edit_url = "수정가능";
                            if ($current_time > $registration_time) {
                                $edit_chekbox = "<input type=\"checkbox\" name=\"goods_checkbox[]\" value=\"{$data['goods_no']}\"/>";
                                $edit_url = "<a href='".base_url("goods/goods_form?w=u&idx={$data['idx']}&goods_no={$data['goods_no']}")."' class='btn btn-sm btn-skyblue'>수정</a>";
                            }

                            // 가격
                            $price = number_format($data['price']);

                            // 카테고리
                            $cate_name = get_esm_category($data['catCode_esm'])[0]['name'];

                            // 이미지
                            $img = json_decode($data['images'], true);

                            // 발송정책
                            $dispatchPolicyNo = empty($data['dispatchPolicyNo_gmkt']) ? $data['dispatchPolicyNo_iac'] : $data['dispatchPolicyNo_gmkt'];
                            $dispatchPolicyText = "";


                            if(!empty($dispatchPolicyNo)){
                                $dispatchPolicyText = get_dispatch_policies_str($dispatchPolicyNo);
                            }
                            // 출고지
                            $sql = "SELECT * FROM `places_list` where `placeNo` = '{$data['placeNo']}'";
                            $places_row = sql_fetch($sql);

                            $esm_url = $data['goods_no'];
                            if($member['mb_level'] >= 9){
                                $esm_url = "<a href='https://www.esmplus.com/Home/v2/goods-edit?seq={$data['goods_no']}' class='btn btn-sm btn-skyblue' target='_blank'>{$data['goods_no']}</a>";
                            }

                            ?>
                            <tr>
                                <td><?=$edit_chekbox?></td>
                                <td><?=$edit_url?></td>
                                <td><?=$esm_url?></td>
                                <td><?="<span class='box__flag box__flag--gmarket'></span> ".$gmkt_no."<br><span class='box__flag box__flag--auction'></span> ".$iac_no?></td>
                                <td><div class="thumb" style="background: url(<?=$img['basicImgURL']?>)"></div> </td>
                                <td><?=$data['goodsName_kor']?></td>
                                <td><?="<span class='box__flag box__flag--gmarket'></span> ".$sell_gmkt_state."<br><span class='box__flag box__flag--auction'></span> ".$sell_iac_state?></td>
                                <td><?=$price?></td>
                                <td><?="{$formattedDate}({$daysLeft})"?></td>
                                <td><?=$stock?></td>
                                <td><?=$cate_name?></td>
                                <td><?=$dispatchPolicyText?></td>
                                <td><?=$places_row['placeName']?></td>
                                <td><?=$data['bundleNo']?></td>
                                <td><?=$data['edit_date']?></td>
                                <td><?=$data['reg_date']?></td>
                            </tr>
                        <?}?>
                    <?}?>

                    </tbody>
                </table>
            </div> <!-- 목록 -->
            <?php echo createPagination($page, $goods_data['total_count'], $goods_data['items_per_page'], getCurrentUrl()); ?>
        </div>

        
        <!--0624 새작업 끝 -->


        <?/*div class="sch_wrap">
            <p class="tit">검색결과 <button class="btn btn-blue btn-mini" onclick="location.reload(true);">초기화</button></p>
            <div class="box">
                <div class="sch01">
                    <p>검색하기</p>
                    <div class="input_select">
                        <select class="border_gray" id="sf" name="sf">
                            <option value="addrName" <?php echo get_selected($sf, "goods_name_kor"); ?>>상품명</option>
                        </select>
                    </div>

                    <div class="input_search">
                        <input type="text" placeholder="검색어를 입력하세요" class="border_gray" id="st" name="st" value="<?=$st?>">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
        </div*/?>
    <?/*
        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap">
                    <h1>총 <?=number_format($goods_data['total_count'])?>개</h1>
                </div>

                <div class="wrap">
                    <!--<a href="<?= base_url('excel/download/' . base64_encode('b2p_goods.xlsx')) ?>" class="btn btn-write gray">
                        <i class="fa-regular fa-plus color-gray"></i> 엑셀다운로드
                    </a>

                    <button type="button" onclick="uploadExcel()" class="btn btn-write gray2">
                        <i class="fa-regular fa-plus color-gray"></i> 엑셀업로드
                    </button>

                    <form id="uploadExcelForm" action="<?= base_url('excel/upload') ?>" method="post" enctype="multipart/form-data" style="display: none;">
                        <input type="file" id="excelFileInput" name="excelFileInput" accept=".xls,.xlsx">
                        <input type="hidden" name="excelType" id="excelType" value="goodsExcel">
                    </form>-->


                    <a href="<?=base_url('goods/goods_form')?>" class="btn btn-write">
                        <i class="fa-regular fa-plus color-blue"></i> 등록하기
                    </a>
                </div>
            </div>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th width='100px'>편집</th>
                        <th>상품번호</th>
                        <th>지마켓 등록번호</th>
                        <th>옥션 등록번호</th>
                        <th>상품명</th>
                        <th>판매상태</th>
                        <th>추가할 예정</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?
                        $goods_list = $goods_data['list'];
                        if(count($goods_list) == 0){ ?>
                            <tr>
                                <td colspan="99">
                                    데이터가 없습니다.
                                </td>
                            </tr>
                        <? } else {
                            foreach ($goods_list as $index => $data){
                                $sell_gmkt_state = "지마켓 : 판매중지";
                                if($data['isSell_gmkt'] == 'T'){
                                    $sell_gmkt_state = "<a target='_blank' href='https://item.gmarket.co.kr/Item?goodscode=".$data['gmkt_no']."'>지마켓 : 판매중</a>";
                                }

                                $sell_iac_state = "옥션 : 판매중지";
                                if($data['isSell_iac'] == 'T'){
                                    $sell_iac_state = "<a target='_blank' href='http://itempage3.auction.co.kr/DetailView.aspx?ItemNo=".$data['iac_no']."&frm3=V2'>옥션 : 판매중</a>";
                                }
                                $gmkt_no = "-";
                                if(!empty($data['gmkt_no'])){
                                    $gmkt_no = "<a target='_blank' href='https://item.gmarket.co.kr/Item?goodscode=".$data['gmkt_no']."'>".$data['gmkt_no']."</a>";
                                }

                                $iac_no = "-";
                                if(!empty($data['iac_no'])){
                                    $iac_no = "<a target='_blank' href='http://itempage3.auction.co.kr/DetailView.aspx?ItemNo=".$data['iac_no']."&frm3=V2'>".$data['iac_no']."</a>";
                                }

                                // 5분이 지났는지 확인
                                $current_time = new DateTime();
                                $registration_time = new DateTime($data['reg_date']);
                                $registration_time->add(new DateInterval('PT5M'));

                                $edit_url = "5분후 수정가능";
                                if ($current_time > $registration_time) {
                                    $edit_url = "<a href='".base_url("goods/goods_form?w=u&idx={$data['idx']}&goods_no={$data['goods_no']}")."' class='btn btn-sm btn-skyblue'>수정</a>";
                                }

                                ?>
                                <tr>
                                    <td>
                                        <?=$edit_url?>
                                    </td>
                                    <td><?=$data['goods_no']?></td>
                                    <td><?=$gmkt_no?></td>
                                    <td><?=$iac_no?></td>
                                    <td><?=$data['goodsName_kor']?></td>
                                    <td><?=$sell_gmkt_state."<br>".$sell_iac_state?></td>
                                    <td>현재 임시 화면입니다.</td>
                                </tr>
                            <?}?>
                        <?}?>

                    </tbody>
                </table>
            </div>

            <?php echo createPagination($page, $goods_data['total_count'], $goods_data['items_per_page'], getCurrentUrl()); ?>
        </div>
    */?>

</div>
<script>
    let isAjaxIng = false;
</script>

<?php echo view('goods/goods_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>