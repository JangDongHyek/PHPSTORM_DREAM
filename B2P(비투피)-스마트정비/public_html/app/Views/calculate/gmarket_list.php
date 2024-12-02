
<?php
echo view('common/header_adm');
echo view('common/adm_head');

if (isset($_GET['page'])) {
    echo "<script>
        window.onload = function() {
            // 특정 요소로 스크롤 이동
            var element = document.getElementById('list_1');
            if (element) {
                element.scrollIntoView({ behavior: 'auto' });
            }
        };
    </script>";
}else if (isset($_GET['page2'])) {
    echo "<script>
        window.onload = function() {
            // 특정 요소로 스크롤 이동
            var element = document.getElementById('list_2');
            if (element) {
                element.scrollIntoView({ behavior: 'auto' });
            }
        };
    </script>";
}else if (isset($_GET['page3'])) {
    echo "<script>
        window.onload = function() {
            // 특정 요소로 스크롤 이동
            var element = document.getElementById('list_3');
            if (element) {
                element.scrollIntoView({ behavior: 'auto' });
            }
        };
    </script>";
}
?>


        <?php echo view('calculate/calcu_head', $this->data); ?>

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1" onclick="location.href='<?=base_url('/calculate/gmarket')?>'">판매내역</li>
        <li class="tab-link" data-tab="tab-2" onclick="location.href='<?=base_url('/calculate/gmarket_settleNo')?>'">미정산내역</li>
    </ul>

        <div id="tab-1" class="tab-content current">
            <div class="">
                <form name="searchFrm" id="searchFrm" autocomplete="off" method="get">
                <div class="sch_wrap">
                    <p class="tit">검색조건
                        <a class="btn btn-gray btn-md male-auto" href="<?= current_url() ?>">조건초기화</a>
                        <button class="btn btn-blue btn-md" onclick="">검색하기</button>
                    </p>
                    <div class="box flexwrap">
                        <div>
                            <p>일자구분</p>
                            <div class="input_date">
                                <div class="input_select w150px">
                                    <select class="border_gray" name="select_date">
                                        <option value="PayDate" <?=get_selected($_GET['select_date'],'PayDate')?>>입금확인일</option>
                                        <option value="ShippingDate" <?=get_selected($_GET['select_date'],'ShippingDate')?>>배송일</option>
                                        <option value="ShippingCmplDate" <?=get_selected($_GET['select_date'],'ShippingCmplDate')?>>배송완료일</option>
                                        <option value="BuyDecisonDate" <?=get_selected($_GET['select_date'],'BuyDecisonDate')?>>구매결정일</option>
                                        <option value="RefundDate" <?=get_selected($_GET['select_date'],'RefundDate')?>>환불일</option>
                                        <option value="SettleExpectDate" <?=get_selected($_GET['select_date'],'SettleExpectDate')?>>정산예정일</option>
                                        <option value="RemitDate" <?=get_selected($_GET['select_date'],'RemitDate')?>>정산완료일</option>
                                        <option value="RevenueBaseDate" <?=get_selected($_GET['select_date'],'RevenueBaseDate')?>>매출기준일</option>
                                    </select>
                                </div>
                                <div class="input_select">
                                    <input type="date" name="sdt" class="border_gray" value="<?= $_GET['sdt'] ?>">
                                </div>
                                ~
                                <div class="input_select">
                                    <input type="date" name="edt" class="border_gray" value="<?= $_GET['edt'] ?>"
                                           onchange="changeInputDate(this.value)">
                                </div>
                                <div class="select flex nowrap">
                                    <?
                                    $dateRange = ['1' => '오늘', '2' => '이번주', '3' => '이번달', '4' => '지난달', '5' => '3개월'];
                                    foreach ($dateRange as $key => $val) {
                                        $checked = ($_GET['dtRange'] == $key) || (!$_GET['dtRange'] && $key == 0) ? "checked" : "";
                                        $id = "dtr{$key}";
                                        ?>
                                        <input type="radio" id="<?= $id ?>" name="dtRange"
                                               value="<?= $key ?>" <?= $checked ?> onclick="changeDateRange(this.value)"/>
                                        <label for="<?= $id ?>"><?= $val ?></label>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                        <div>
                            <p>검색하기</p>
                            <div class="flex gap5">
                                <div class="input_select">
                                    <select class="border_gray" name="sfl">
                                        <?
                                        $sflList = ['OrderNo' => '주문번호', 'SiteGoodsNo' => '결제번호',  'SiteGoodsNo' => '상품번호' , 'cp_name' => '셀러명', 'mb_name' => '담당자', 'mb_id' => '아이디'];
                                        foreach ($sflList as $key => $val) {
                                            ?>
                                            <option value="<?= $key ?>" <?= $_GET['sfl'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="input_search">
                                    <input type="text" name="stx" placeholder="검색어를 입력하세요" class="border_gray" type="search"
                                           value="<?= $_GET['stx'] ?>">
                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="list_sql" id="list_sql" value="<?=$_GET['list_sql']?>">

                </form>
                </div>

                <div class="result_wrap">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1>판매 진행별 합계내역</h1>
                        </div>
                        <h1>기간 : <?= $_GET['sdt'] ?> - <?= $_GET['edt'] ?></h1>
                        <p class="text-guide">(판매진행상태를 클릭하면 하단에 진행상태별로 합계 및 상세내역이 출력됩니다.)</p>
                    </div>
                    <div class="table">
                        <table>
                            <colgroup>
                                <col style="width:150px;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th rowspan="3" >구분</th>
                                <th rowspan="3"><a class="txt-under txt-blue" onclick="$('#list_sql').val('payDate');$('#searchFrm').submit()">입금확인</a></th>
                                <th rowspan="3"><a class="txt-under txt-blue" onclick="$('#list_sql').val('shippingDate');$('#searchFrm').submit()">발송처리</a></th>
                                <th rowspan="3"><a class="txt-under txt-blue" onclick="$('#list_sql').val('shippingCmplDate');$('#searchFrm').submit()">배송완료</a></th>
                                <th rowspan="3"><a class="txt-under txt-blue" onclick="$('#list_sql').val('shippingCmplDate');$('#searchFrm').submit()">매출기준</a></th>
                                <th colspan="3">정산예정</th>
                            </tr>
                            <tr>
                                <th colspan="2">구매결정</th>
                                <th rowspan="2"><a class="txt-under txt-blue" onclick="$('#list_sql').val('buyDecisonDateNo');$('#searchFrm').submit()">구매 미결정</a></th>
                            </tr>
                            <tr>
                                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('settleExpectDate');$('#searchFrm').submit()">정산완료</a></th>
                                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('settleExpectDateNo');$('#searchFrm').submit()">정산 미완료</a></th>
                            </tr>
                            </thead>
                            <!-- //[WPRT-1138] -->
                            <tbody>
                            <tr>
                                <td class="td_bg">체결건수</td>
                                <td><?=number_format($settle_data['payDate_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['shippingDate_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc'][0]['cnt'])?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['cnt'])?></td>
                            </tr>
                            <tr>
                                <td class="td_bg">상품판매</td>
                                <td><?=number_format($settle_data['payDate_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingDate_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc'][0]['BuyerPayAmt_total'])?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['BuyerPayAmt_total'])?></td>

                            </tr>
                            <tr>
                                <td class="td_bg">배송비</td>
                                <td><?=number_format($settle_data['payDate_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingDate_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc2']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc2']['dl_DelFeeAmt_total'])?></td>

                            </tr>
                            <tr>
                                <td class="td_bg">구매자부담/환급금</td>
                                <td><?=number_format($settle_data['payDate_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingDate_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc3']['dl_DelFeeAmt_total'])?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc3']['dl_DelFeeAmt_total'])?></td>
                            </tr>
                            <tr>
                                <td class="td_bg">정산대상</td>
                                <td><?=number_format((int)$settle_data['payDate_etc'][0]['SettlementPrice_total'] + $settle_data['payDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['payDate_etc2']['dl_DelFeeAmt_total'] - $settle_data['payDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['shippingDate_etc'][0]['SettlementPrice_total'] + $settle_data['shippingDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['shippingDate_etc2']['dl_DelFeeAmt_total'] - $settle_data['shippingDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['shippingCmplDate_etc'][0]['SettlementPrice_total'] + $settle_data['shippingCmplDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['shippingCmplDate_etc2']['dl_DelFeeAmt_total']  - $settle_data['shippingCmplDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['shippingCmplDate_etc'][0]['SettlementPrice_total'] + $settle_data['shippingCmplDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['shippingCmplDate_etc2']['dl_DelFeeAmt_total'] - $settle_data['shippingCmplDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['settleExpectDate_etc'][0]['SettlementPrice_total'] + $settle_data['settleExpectDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['settleExpectDate_etc2']['dl_DelFeeAmt_total'] - $settle_data['settleExpectDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['settleExpectDateNo_etc'][0]['SettlementPrice_total'] + $settle_data['settleExpectDateNo_etc3']['dl_DelFeeAmt_total'] + $settle_data['settleExpectDateNo_etc2']['dl_DelFeeAmt_total'] - $settle_data['settleExpectDateNo_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format((int)$settle_data['buyDecisonDateNo_etc'][0]['SettlementPrice_total'] + $settle_data['buyDecisonDateNo_etc3']['dl_DelFeeAmt_total'] + $settle_data['buyDecisonDateNo_etc2']['dl_DelFeeAmt_total'] - $settle_data['buyDecisonDateNo_etc'][0]['dl_DelFeeCommission_total'])?></td>

                            </tr>
                            <tr>
                                <td class="td_bg">서비스이용료</td>
                                <td><?=number_format($settle_data['payDate_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['shippingDate_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc'][0]['ServiceFee_total']*-1)?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['ServiceFee_total']*-1)?></td>

                            </tr>
                            <tr>
                                <td class="td_bg">서비스이용료<br>(선결제 배송비)</td>
                                <td><?=number_format($settle_data['payDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['shippingDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['shippingCmplDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['settleExpectDateNo_etc'][0]['dl_DelFeeCommission_total'])?></td>
                                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['dl_DelFeeCommission_total'])?></td>

                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="result_wrap" id="list_1">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1><?=$title_name?> 상품판매 상세내역 | 검색결과 <span class="color-blue"><?=number_format($settle_data['total_count'])?>개</span>
                                <button class="btn btn-blue btn-mini" type="button"
                                        onclick="location.href='<?= base_url('/calculate/gmarketListExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
                                    엑셀 다운
                                </button>
                            </h1>
                        </div>
                        <p class="text-guide">(주문번호를 클릭 하면 결제금액 상세정보를 확인할 수 있습니다.)</p>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>주문번호</th>
                                <th>상품번호</th>
                                <th>상품명</th>
                                <th>셀러명</th>
                                <th>고객명</th>
                                <th>주문일</th>
                                <th>입금확인일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>정산예정일</th>
                                <th>정산완료일</th>
                                <th>주문수량</th>
                                <th>판매가격</th>
                                <th>필수선택상품금액</th>
                                <th>추가구성상품금액</th>
                                <th>G마켓 상품별/구매자 쿠폰 할인</th>
                                <th>판매자 상품별 할인</th>
                                <th>고객결제금(구. 구매대금)</th>
                                <th>판매자 정산요청가(구. 공급원가)</th>
                                <th>필수 + 추가선택정산요청가</th>
                                <th>공제/환급금</th>
                                <th>공제/환급금(서비스이용료 미포함)</th>
                                <th>판매자 최종정산금</th>
                                <th>기본이용료</th>
                                <th>기본이용료 감면</th>
                                <th>서비스이용료</th>
                                <th>카테고리 기본이용료</th>
                                <th>카테고리 기본이용료율</th>
                                <th>KCP수수료</th>
                                <th>KCP수수료(캐시백이벤트)</th>
                                <th>판매자 분담 G마켓 구매자 쿠폰 할인</th>
                                <th>판매자 분담 G마켓 상품별 할인</th>
                                <th>해외배송비</th>
                                <th>결제방식</th>
                                <th>보류사유</th>
                                <th>과세구분</th>
                                <th>비고</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($settle_data['list'] as $row): ?>
                                <?php
                                    $B2P_Goods = 0;
                                    $B2P_GoodsCost = 0; //B2P 판매자 정산요청가
                                    $B2P_Option = 0;
                                    $B2P_OptionCost = 0; //B2P 옵션상품 정산요청가
                                    $B2P_SettlementPrice = 0; //B2P 판매자 최종정산금
                                    $B2P_TotCommission = 0; //B2P 기본 서비스 이용료
                                    $B2P_ServiceFee = 0; //B2P 서비스이용료

                                    //1 옥션 2지마켓
                                    $category_fee_cost = abs($row['TotCommission']) + abs($row['b2p_cost']);
                                    if($row['SiteType'] == 1) {

                                    }else {
                                        $category_fee_cost -= abs($row['SellerCashbackMoney']);
                                        $category_fee_cost -= abs($row['DeductTaxPrice']);
                                    }

                                    $B2P_Goods = ($row['OrderUnitPrice']*1 * abs($row['OrderQty'])); //판매자 정산요청가
                                    $B2P_GoodsCost = round($B2P_Goods - $category_fee_cost); //B2P 판매자 정산요청가

                                    $B2P_Option = ($row['OptSelPrice']*1 + $row['OptAddPrice']*1); //옵션상품 정산요청가
                                    //$B2P_OptionCost = round($B2P_Option * ( 1 - $row['category_fee']/100 )); //B2P 옵션상품 정산요청가
                                    $B2P_OptionCost = round($B2P_Option - $category_fee_cost); //B2P 옵션상품 정산요청가

                                    $B2P_GoodsCost_fee = ($B2P_Goods * ( $row['category_fee']/100 )); //B2P 판매자 정산요청가 수수료율
                                    $B2P_OptionCost_fee = ($B2P_Option * ( $row['category_fee']/100 )); //B2P 옵션상품 정산요청가 수수료율

                                    //$B2P_TotCommission = $B2P_GoodsCost_fee + $B2P_OptionCost_fee  + abs($row['SellerPcsFee']) ; //B2P 기본 서비스 이용료
                                    $B2P_TotCommission = $category_fee_cost  + abs($row['SellerPcsFee']) ; //B2P 기본 서비스 이용료
                                    $B2P_TotCommission = ($B2P_TotCommission);

                                    $B2P_SettlementPrice = $B2P_Goods + $B2P_Option - abs($B2P_TotCommission)
                                    - abs($row['SellerDiscountPrice1']) - abs($row['SellerCashbackMoney']) - abs($row['SellerFundingDiscountPrice'])
                                    ; //B2P 판매자 최종정산금
                                    $B2P_SettlementPrice = ($B2P_SettlementPrice);

                                ?>
                            <tr>
                                <td title="장바구니번호"><?=$row['PackNo']?></td>
                                <td title="주문번호"><a data-toggle="modal" data-target="#orderSheetModal"><?=$row['ContrNo']?></a></td>
                                <td title="상품번호"><?=$row['SiteGoodsNo']?></td>
                                <td title="상품명"><?=$row['GoodsName']?></td>
                                <td title="셀러명"><?=$row['cp_name']?></td>
                                <td title="고객명"><?=$row['BuyerName']?></td>
                                <td title="주문일"><?=get_dateformat($row['OrderDate'],'Y-m-d H:i:s')?></td>
                                <td title="입금확인일"><?=get_dateformat($row['PayDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송일"><?=get_dateformat($row['ShippingDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송완료일"><?=get_dateformat($row['ShippingCmplDate'],'Y-m-d H:i:s')?></td>
                                <td title="환불일"><?=get_dateformat($row['RefundDate'],'Y-m-d H:i:s')?></td>
                                <td title="구매결정일"><?=get_dateformat($row['BuyDecisonDate'],'Y-m-d H:i:s')?></td>
                                <td title="정산방식">
                                    <?php
                                    $SettleTypeMap = ['A' => '계좌','B' => '판매예치금','C' => '판매예치금선차감','D' => '조기정산예치금','S' => '스마일캐시'];
                                    ?>
                                    <?= $SettleTypeMap[$row['SettleType']] ?>
                                </td>
                                <td title="정산예정일"><?=get_dateformat($row['SettleExpectDate'],'Y-m-d H:i:s')?></td>
                                <td title="정산완료일"><?=get_dateformat($row['RemitDate'],'Y-m-d H:i:s')?></td>
                                <td title="주문수량"><?=$row['OrderQty']?></td>
                                <td title="판매가격"><?=number_format($row['OrderUnitPrice']*1 * abs($row['OrderQty']))?></td>
                                <td title="필수선택상품금액"><?=number_format($row['OptSelPrice']*1)?></td>
                                <td title="추가구성상품금액"><?=number_format($row['OptAddPrice']*1)?></td>

                                <td title="G마켓 상품별/구매자 쿠폰 할인"><?=number_format((int)($row['FeeDiscountPrice']*-1))?></td>
                                <td title="판매자 상품별 할인"><?=number_format(((int)$row['SellerDiscountPrice1']*1 + (int)$row['SellerDiscountPrice2'])*-1)?></td>
                                <td title="고객결제금(구. 구매대금)"><?=number_format($row['BuyerPayAmt']*1)?></td>
                                <td title="판매자 정산요청가(구. 공급원가)<?=number_format($row['GoodsCost']*1)?>">
                                    <?=number_format($B2P_GoodsCost*1)?>
                                </td>
                                <td title="필수/추가구성정산요청가<?=number_format($row['OptionCost']*1)?>">
                                    <?=number_format($B2P_OptionCost*1)?>
                                </td>
                                <td title="공제/환급금"><?=number_format($row['OutsidePrice']*1)?></td>
                                <td title="공제/환급금(서비스이용료 미포함)"><?=number_format((int)$row['SellerCashbackMoney']*-1)?></td>
                                <td title="판매자 최종정산금<?=number_format($row['SettlementPrice']*1)?>">
                                    <?=number_format(round($B2P_SettlementPrice)*1)?>
                                </td>
                                <td title="기본이용료<?=number_format($row['TotCommission']*1)?>">
                                    <?=number_format($B2P_TotCommission)?>
                                </td>
                                <td title="기본이용료 감면"><?=number_format($row['FeeDiscountPrice']*-1)?></td>
                                <td title="서비스이용료">
                                    <?=number_format($B2P_TotCommission - abs($row['FeeDiscountPrice']) - abs($row['SellerCashbackMoney']))?>
                                </td>
                                <td title="카테고리 기본이용료"><?=number_format($category_fee_cost)?></td>
                                <td title="카테고리 기본이용료율"><?=($row['category_fee']*1)?>%</td>
                                <td title="kcp셀러별 수수료<?=$row['b2p_cp_fee']?>"><?=number_format(floor($B2P_SettlementPrice * $row['b2p_cp_fee']/100))?></td>
                                <td title="kcp이벤트 수수료" style="text-decoration: line-through"><?=number_format(floor($B2P_SettlementPrice * $row['b2p_kcp_fee']/100))?></td>
                                <td title="판매자 분담 G마켓 구매자 쿠폰 할인"><?=number_format((int)$row['SellerFundingDiscountPrice'])?></td>
                                <td title="판매자 분담 G마켓 상품별 할인">0</td>
                                <td title="해외배송비"><?=number_format($row['DelFeeOverseaAmt']*1)?></th>
                                <td title="결제방식">결제방식</td>
                                <td title="정산보류사유">
                                    <?php
                                    // 정산보류사유 매핑 배열
                                    $SettleExceptMap = [
                                        '1991-01-01' => '장기미배송',
                                        '1988-01-01' => '정산서류 미제출',
                                        '1998-01-01' => '지급보류(정산중지)',
                                        '1999-01-01' => '취소/반품진행',
                                        '1997-01-01' => '이벤트경품',
                                        '1990-12-31' => '배송중취소',
                                        '1999-01-01' => '환불미결정',
                                        '1993-01-01' => '미수취신고',
                                        '1992-01-01' => '벤더',
                                        '1800-01-01' => '일반미정산'
                                    ];

                                    // datetime 포맷을 Y-m-d 형식으로 변환
                                    $settleExceptDate = date('Y-m-d', strtotime($row['SettleExceptName']));
                                    ?>
                                    <?= isset($SettleExceptMap[$settleExceptDate]) ? $SettleExceptMap[$settleExceptDate] : $row['SettleExceptName']; ?>
                                </td>
                                <td title="과세구분">
                                    <?php
                                    $TaxTypeMap = ['0' => '과세','1' => '면세','2' => '영세','8' => '영세','9' => '영세'];
                                    ?>
                                    <?= $TaxTypeMap[$row['TaxYn']] ?>
                                </td>
                                <td title="비고"></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo createPagination($page, $settle_data['total_count'], $settle_data['items_per_page'], getCurrentUrl()); ?>
                </div><!--상품판매 상세내역-->
                <div class="result_wrap" id="list_2">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1><?=$title_name?> 배송비 상세내역 | 검색결과 <span class="color-blue"><?=$settle_data['total_count2']?>개</span>
                                <button class="btn btn-blue btn-mini" type="button"
                                        onclick="location.href='<?= base_url('/calculate/gmarketDeliveryFeeExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
                                    엑셀다운
                                </button>
                            </h1>
                        </div>
                        <p class="text-guide">(대표주문번호 및 대표상품명은 배송완료 후 보여집니다.)</p>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>대표주문번호</th>
                                <th>대표상품번호</th>
                                <th>대표상품명</th>
                                <th>셀러명</th>
                                <th>고객명</th>
                                <th>체결일</th>
                                <th>입금확인일</th>
                                <th>매출기준일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>배송비</th>
                                <th>서비스이용료(선결제배송비)</th>
                                <th>배송비정산금액</th>
                                <th>정산예정일</th>
                                <th>배송비상세</th>
                                <th>매출주문번호</th>
                                <th>정산완료일</th>
                                <th>결제방식</th>
                                <th>배송비타입</th>
                                <th>송장번호</th>
                                <th>배송비유형</th>
                                <th>추가배송비종류</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($settle_data['list2'] as $row): ?>
                             <tr>
                                <td title="장바구니번호"><?=$row['PackNo']?></td>
                                <td title="대표주문번호"><?=$row['ContrNo']?></td>
                                <td title="대표상품번호"><?=$row['SiteGoodsNo']?></td>
                                <td title="대표상품명"><?=$row['GoodsName']?></td>
                                 <td title="셀러명"><?=$row['cp_name']?></td>
                                 <td title="고객명"><?=$row['BuyerName']?></td>
                                <td title="체결일"><?=get_dateformat($row['OrderDate'],'Y-m-d H:i:s')?></td>
                                <td title="입금확인일"><?=get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                                <td title="매출기준일"><?=get_dateformat($row['RevenueBaseDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송일"><?=get_dateformat($row['ShippingDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송완료일"><?=get_dateformat($row['ShippingCmplDate'],'Y-m-d H:i:s')?></td>
                                <td title="환불일"><?=get_dateformat($row['dl_RefundDate'],'Y-m-d H:i:s')?></td>
                                <td title="구매결정일"><?=get_dateformat($row['BuyDecisonDate'],'Y-m-d H:i:s')?></td>
                                <td title="정산방식">
                                    <?php
                                    $DelFeePayWay = ['A' => '계좌송금','B' => '판매자예치금','S' => '스마일캐시'];
                                    ?>
                                    <?= $DelFeePayWay[$row['DelFeePayWay']] ?>
                                </td>
                                <td title="배송비"><?=number_format($row['dl_DelFeeAmt'])?></td>
                                <td title="서비스이용료(선결제배송비)"><?=number_format($row['dl_DelFeeAmt']* 0.033)?></td>
                                <td title="배송비정산금액"><?=number_format($row['dl_DelFeeAmt'] * 1 - $row['dl_DelFeeAmt']* 0.033)?></td>
                                <td title="정산예정일"><?=$row['SettleExpectDate'] == "0000-00-00 00:00:00" ? $row['SettleExceptName'] : get_dateformat($row['SettleExpectDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송비상세">배송비상세</td>
                                <td title="매출주문번호"><?=$row['ContrNo']?></td>
                                <td title="정산완료일"><?=get_dateformat($row['RemitDate'],'Y-m-d H:i:s')?></td>
                                <td title="결제방식">결제방식</td>
                                <td title="배송비타입">배송비타입</td>
                                <td title="송장번호"><?=$row['NoSongjang']?></td>
                                <td title="배송비유형">배송비유형</td>
                                <td title="추가배송비종류">추가배송비종류</td>
                                <td title="보류사유"><?=$row['SettleExceptName']?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo createPagination2($page2, $settle_data['total_count2'], $settle_data['items_per_page2'], getCurrentUrl()); ?>
                </div><!--배송비 상세내역-->
                <div class="result_wrap" id="list_3">
                    <div class="top_text">
                        <div class="wrap w100 flex">
                            <h1>구매자 부담/환급금 상세내역 | 검색결과 <span class="color-blue"><?=$settle_data['total_count3']?>개</span>
                                <button class="btn btn-blue btn-mini" type="button"
                                        onclick="location.href='<?= base_url('/calculate/gmarketRefundExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
                                    엑셀다운
                                </button>
                            </h1>
                        </div>
                        <br>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th>장바구니번호</th>
                                <th>대표주문번호</th>
                                <th>대표상품번호</th>
                                <th>대표상품명</th>
                                <th>고객명</th>
                                <th>체결일</th>
                                <th>입금확인일</th>
                                <th>매출기준일</th>
                                <th>배송일</th>
                                <th>배송완료일</th>
                                <th>환불일</th>
                                <th>구매결정일</th>
                                <th>정산방식</th>
                                <th>배송비</th>
                                <th>서비스이용료(선결제배송비)</th>
                                <th>배송비정산금액</th>
                                <th>정산예정일</th>
                                <th>배송비상세</th>
                                <th>매출주문번호</th>
                                <th>정산완료일</th>
                                <th>결제방식</th>
                                <th>배송비타입</th>
                                <th>송장번호</th>
                                <th>배송비유형</th>
                                <th>추가배송비종류</th>
                                <th>보류사유</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($settle_data['list3'] as $row): ?>
                            <tr>
                                <td title="장바구니번호"><?=$row['PackNo']?></td>
                                <td title="대표주문번호"><?=$row['ContrNo']?></td>
                                <td title="대표상품번호"><?=$row['SiteGoodsNo']?></td>
                                <td title="대표상품명"><?=$row['GoodsName']?></td>
                                <td title="고객명"><?=$row['BuyerName']?></td>
                                <td title="체결일"><?=get_dateformat($row['OrderDate'],'Y-m-d H:i:s')?></td>
                                <td title="입금확인일"><?=get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                                <td title="매출기준일"><?=get_dateformat($row['RevenueBaseDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송일"><?=get_dateformat($row['ShippingDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송완료일"><?=get_dateformat($row['ShippingCmplDate'],'Y-m-d H:i:s')?></td>
                                <td title="환불일"><?=get_dateformat($row['dl_RefundDate'],'Y-m-d H:i:s')?></td>
                                <td title="구매결정일"><?=get_dateformat($row['BuyDecisonDate'],'Y-m-d H:i:s')?></td>
                                <td title="정산방식">
                                    <?php
                                    $DelFeePayWay = ['A' => '계좌송금','B' => '판매자예치금','S' => '스마일캐시'];
                                    ?>
                                    <?= $DelFeePayWay[$row['DelFeePayWay']] ?>
                                </td>
                                <td title="배송비"><?=number_format($row['dl_DelFeeAmt'])?></td>
                                <td title="서비스이용료(선결제배송비)"><?=number_format($row['dl_DelFeeAmt']* 0.033)?></td>
                                <td title="배송비정산금액"><?=number_format($row['dl_DelFeeAmt'] * 1 - $row['dl_DelFeeAmt']* 0.033)?></td>
                                <td title="정산예정일"><?=get_dateformat($row['SettleExpectDate'],'Y-m-d H:i:s')?></td>
                                <td title="배송비상세">배송비상세</td>
                                <td title="매출주문번호"><?=$row['ContrNo']?></td>
                                <td title="정산완료일"><?=get_dateformat($row['RemitDate'],'Y-m-d H:i:s')?></td>
                                <td title="결제방식">결제방식</td>
                                <td title="배송비타입">배송비타입</td>
                                <td title="송장번호"><?=$row['NoSongjang']?></td>
                                <td title="배송비유형">배송비유형</td>
                                <td title="추가배송비종류">추가배송비종류</td>
                                <td title="보류사유">보류사유</td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo createPagination3($page3, $settle_data['total_count3'], $settle_data['items_per_page3'], getCurrentUrl()); ?>
                </div><!--구매자 부담/환급금 상세내역-->

            </div>
        </div><!--tab-->




<?php
echo view('common/adm_tail');
echo view('common/footer');
?>