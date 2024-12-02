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

<form name="searchFrm" id="searchFrm" autocomplete="off" method="get">
    <div class="sch_wrap">
        <p class="tit">검색조건
            <a class="btn btn-gray btn-md male-auto" href="<?= current_url() ?>">조건초기화</a>
            <button class="btn btn-blue btn-md" onclick="">검색하기</button>
        </p>
        </p>
        <div class="box flexwrap">
            <div>
                <p>일자구분</p>
                <div class="input_date">
                    <div class="input_select w150px">
                        <select class="border_gray" name="select_date">
                            <option value="PayDate" <?=get_selected($_GET['select_date'],'PayDate')?>>입금확인일</option>
                            <option value="RevenueBaseDate" <?=get_selected($_GET['select_date'],'RevenueBaseDate')?>>매출기준일</option>
                            <option value="BuyDecisonDate" <?=get_selected($_GET['select_date'],'BuyDecisonDate')?>>구매결정일</option>
                            <option value="RefundDate" <?=get_selected($_GET['select_date'],'RefundDate')?>>환불일</option>
                            <option value="RemitDate" <?=get_selected($_GET['select_date'],'RemitDate')?>>정산완료일</option>
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
                            $sflList = ['OrderNo' => '주문번호', 'SiteGoodsNo' => '결제번호', 'SiteGoodsNo' => '상품번호' , 'cp_name' => '셀러명', 'mb_name' => '담당자', 'mb_id' => '아이디'];
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
    </div>
    <input type="hidden" name="list_sql" id="list_sql" value="<?=$_GET['list_sql']?>">
</form>

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
                <col width="200px">
            </colgroup>
            <thead>
            <tr>
                <th>구분</th>
                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('payDate');$('#searchFrm').submit()">입금확인</a></th>
                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('revenueBaseDate');$('#searchFrm').submit()">매출기준</a></th>
                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('buyDecisonDateNo');$('#searchFrm').submit()">구매 미결정</a></th>
                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('buyDecisonDate');$('#searchFrm').submit()">구매 결정</a></th>
                <th><a class="txt-under txt-blue" onclick="$('#list_sql').val('settleExpectDate');$('#searchFrm').submit()">정산완료</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>주문건수</td>
                <td><?=number_format($settle_data['payDate_etc'][0]['cnt'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc'][0]['cnt'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['cnt'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc'][0]['cnt'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['cnt'])?></td>
            </tr>
            <tr>
                <td>상품판매</td>
                <td><?=number_format($settle_data['payDate_etc'][0]['BuyerPayAmt_total'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc'][0]['BuyerPayAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['BuyerPayAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc'][0]['BuyerPayAmt_total'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['BuyerPayAmt_total'])?></td>
            </tr>
            <tr>
                <td>배송비</td>
                <td><?=number_format($settle_data['payDate_etc2']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc2']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc2']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc2']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc2']['dl_DelFeeAmt_total'])?></td>
            </tr>
            <tr>
                <td>취소위약금/환불금차감</td>
                <td><?=number_format($settle_data['payDate_etc3']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc3']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc3']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc3']['dl_DelFeeAmt_total'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc3']['dl_DelFeeAmt_total'])?></td>
            </tr>
            <tr>
                <td>정산대상<?=$settle_data['buyDecisonDateNo_etc2'][0]['dl_DelFeeAmt_total']?></td>
                <td><?=number_format($settle_data['payDate_etc'][0]['SettlementPrice_total'] + $settle_data['payDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['payDate_etc2']['dl_DelFeeAmt_total'] - 0)?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc'][0]['SettlementPrice_total'] + $settle_data['revenueBaseDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['revenueBaseDate_etc2']['dl_DelFeeAmt_total'] - 0)?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['SettlementPrice_total'] + $settle_data['buyDecisonDateNo_etc3']['dl_DelFeeAmt_total'] + $settle_data['buyDecisonDateNo_etc2']['dl_DelFeeAmt_total'] - 0)?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc'][0]['SettlementPrice_total'] + $settle_data['buyDecisonDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['buyDecisonDate_etc2']['dl_DelFeeAmt_total'] - 0)?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['SettlementPrice_total'] + $settle_data['settleExpectDate_etc3']['dl_DelFeeAmt_total'] + $settle_data['settleExpectDate_etc2']['dl_DelFeeAmt_total'] - 0)?></td>
            </tr>
            <tr>
                <td>서비스이용료</td>
                <td><?=number_format($settle_data['payDate_etc'][0]['ServiceFee_total'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc'][0]['ServiceFee_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc'][0]['ServiceFee_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc'][0]['ServiceFee_total'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc'][0]['ServiceFee_total'])?></td>
            </tr>
            <tr>
                <td>서비스이용료(선결제배송비)</td>
                <td><?=number_format($settle_data['payDate_etc2']['dl_DelFeeCommission_total'])?></td>
                <td><?=number_format($settle_data['revenueBaseDate_etc2']['dl_DelFeeCommission_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDateNo_etc2']['dl_DelFeeCommission_total'])?></td>
                <td><?=number_format($settle_data['buyDecisonDate_etc2']['dl_DelFeeCommission_total'])?></td>
                <td><?=number_format($settle_data['settleExpectDate_etc2']['dl_DelFeeCommission_total'])?></td>
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
                        onclick="location.href='<?= base_url('/calculate/auctionListExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
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
                <th>결제번호</th>
                <th>주문번호</th>
                <th>상품번호</th>
                <th>상품명</th>
                <th>셀러명</th>
                <th>고객ID</th>
                <th>주문일</th>
                <th>입금확인일</th>
                <th>발송일</th>
                <th>배송완료일</th>
                <th>환불일</th>
                <th>매출기준일</th>
                <th>구매결정일</th>
                <th>정산방식</th>
                <th>정산예정일</th>
                <th>정산완료일</th>
                <th>주문수량</th>
                <th>상품 판매가</th>
                <th>옵션상품 판매가</th>
                <th>옥션 상품별/구매자 쿠폰 할인</th>
                <th>판매자 할인</th>
                <th>결제금액</th>
                <th>판매자 정산요청가</th>
                <th>옵션상품 정산요청가</th>
                <th>공제/환급금</th>
                <th>판매자 최종정산금</th>
                <th>기본 서비스 이용료</th>
                <th>기본이용료 감면</th>
                <th>서비스이용료</th>
                <th>카테고리 기본이용료</th>
                <th>카테고리 기본이용료율</th>
                <th>KCP수수료</th>
                <th>KCP수수료(캐시백이벤트)</th>
                <th>판매자 분담 옥션 구매자 쿠폰 할인</th>
                <th>판매자 분담 옥션 상품별 할인</th>
                <th>과세구분</th>
                <th>묶음배송번호</th>
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
                    $B2P_OptionCost = ($B2P_Option - $category_fee_cost); //B2P 옵션상품 정산요청가

                    $B2P_GoodsCost_fee = ($B2P_Goods * ( $row['category_fee']/100 )); //B2P 판매자 정산요청가 수수료율
                    $B2P_OptionCost_fee = ($B2P_Option * ( $row['category_fee']/100 )); //B2P 옵션상품 정산요청가 수수료율

                    //B2P_TotCommission = $B2P_GoodsCost_fee + $B2P_OptionCost_fee + $row['DeductTaxPrice'] + abs($row['SellerPcsFee']) ; //B2P 기본 서비스 이용료
                    $B2P_TotCommission = $category_fee_cost + abs($row['OutsidePrice']) + abs($row['SellerPcsFee']); //B2P 기본 서비스 이용료
                    $B2P_TotCommission = ($B2P_TotCommission);

                    $B2P_SettlementPrice = $B2P_Goods + $B2P_Option - abs(round($B2P_TotCommission)) - abs($row['OutsidePrice']); //B2P 판매자 최종정산금
                    //$B2P_SettlementPrice = $B2P_GoodsCost - $B2P_TotCommission; //B2P 판매자 최종정산금
                    $B2P_SettlementPrice = ($B2P_SettlementPrice);

                    $B2P_ServiceFee = $B2P_GoodsCost_fee + $B2P_OptionCost_fee - abs($row['FeeDiscountPrice']) + abs($row['DeductTaxPrice']); //B2P 서비스이용료
                    $B2P_ServiceFee = ($B2P_ServiceFee);
                ?>
            <tr>
                <td title="결제번호"><?=$row['PackNo']?></td>
                <td title="주문번호"><a data-toggle="modal" data-target="#orderSheetModal"><?=$row['ContrNo']?></a></td>
                <td title="상품번호"><?=$row['SiteGoodsNo']?></td>
                <td title="상품명"><?=$row['GoodsName']?></td>
                <td title="셀러명"><?=$row['cp_name']?></td>
                <td title="고객ID"><?=$row['BuyerId']?></td>
                <td title="주문일"><?=get_dateformat($row['OrderDate'],'Y-m-d H:i:s')?></td>
                <td title="입금확인일"><?=get_dateformat($row['PayDate'],'Y-m-d H:i:s')?></td>
                <td title="발송일"><?=get_dateformat($row['ShippingDate'],'Y-m-d H:i:s')?></td>
                <td title="배송완료일"><?=get_dateformat($row['ShippingCmplDate'],'Y-m-d H:i:s')?></td>
                <td title="환불일"><?=get_dateformat($row['RefundDate'],'Y-m-d H:i:s')?></td>
                <td title="매출기준일"><?=get_dateformat($row['RevenueBaseDate'],'Y-m-d H:i:s')?></td>
                <td title="구매결정일"><?=get_dateformat($row['BuyDecisonDate'],'Y-m-d H:i:s')?></td>
                <td title="정산방식">
                    <?php
                    $SettleTypeMap = ['A' => '계좌','B' => '판매예치금','C' => '판매예치금선차감','D' => '조기정산예치금','S' => '스마일캐시'];
                    ?>
                    계좌송금
                </td>
                <td title="정산예정일"><?=get_dateformat($row['SettleExpectDate'],'Y-m-d H:i:s')?></td>
                <td title="정산완료일"><?=get_dateformat($row['RemitDate'],'Y-m-d H:i:s')?></td>
                <td title="주문수량"><?=$row['OrderQty']?></td>
                <td title="상품 판매가"><?=number_format((int)$row['OrderUnitPrice']*1 * abs($row['OrderQty']))?></td>
                <td title="옵션상품 판매가"><?=number_format((int)$row['OptionPrice']*1)?></td>
                <td title="옥션 상품별/구매자 쿠폰 할인"><?=number_format((int)$row['FeeDiscountPrice']*1)?></td>
                <td title="판매자 할인"><?=number_format((int)$row['SellerDiscountTotalPrice']*1)?></td>
                <td title="결제금액"><?=number_format((int)$row['BuyerPayAmt']*1)?></td>
                <td title="판매자 정산요청가 <?=number_format((int)$row['GoodsCost']*1)?>">
                    <?=number_format((int)round($B2P_GoodsCost))?>
                </td>
                <td title="옵션상품 정산요청가 <?=number_format((int)$row['OptionCost']*1)?>">
                    <?=number_format((int)round($B2P_OptionCost))?>
                </td>
                <td title="공제/환급금"><?=number_format((int)$row['DeductNontaxPrice']*1)?></td>
                <td title="판매자 최종정산금<?=number_format((int)$row['SettlementPrice']*1)?>">
                    <?=number_format(round($B2P_SettlementPrice))?>
                </td>
                <td title="기본 서비스 이용료<?=number_format((int)$row['TotCommission']*1)?>">
                    <?=number_format((int)round($B2P_TotCommission))?>
                </td>
                <td title="기본이용료 감면"><?=number_format((int)$row['FeeDiscountPrice']*1)?></td>
                <td title="서비스이용료<?=number_format((int)$row['ServiceFee']*1)?>">
                    <?=number_format((int)round($B2P_ServiceFee)*1)?>
                </td>
                <td title="카테고리 기본이용료"><?=number_format($row['category_fee_cost']*1)?></td>
                <td title="카테고리 기본이용료율"><?=($row['category_fee']*1)?>%</td>
                <td title="kcp셀러별 수수료<?=$row['b2p_cp_fee']?>"><?=number_format(floor($B2P_SettlementPrice * $row['b2p_cp_fee']/100))?></td>
                <td title="kcp이벤트 수수료" style="text-decoration: line-through"><?=number_format($B2P_SettlementPrice * $row['b2p_kcp_fee']/100)?></td>
                <td title="판매자 분담 옥션 구매자 쿠폰 할인"><?=number_format((int)$row['SellerDiscountTotalPrice']*1)?></td>
                <td title="판매자 분담 옥션 상품별 할인">0</td>
                <td title="과세구분">
                    <?php
                    $TaxTypeMap = ['0' => '과세','1' => '면세','2' => '영세','8' => '영세','9' => '영세'];
                    ?>
                    <?= $TaxTypeMap[$row['TaxYn']] ?>
                </td>
                <td title="묶음배송번호"><?=$row['GroupNo']?></td>
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
                        onclick="location.href='<?= base_url('/calculate/auctionDeliveryFeeExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
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
                <th>결제번호</th>
                <th>묶음배송번호</th>
                <th>셀러명</th>
                <th>고객ID</th>
                <th>배송비 결제일</th>
                <th>상품대금 입금확인일</th>
                <th>환불일</th>
                <th>매출기준일</th>
                <th>정산방식</th>
                <th>정산완료일</th>
                <th>배송비</th>
                <th>배송수수료</th>
                <th>배송비 정산액</th>
                <th>배송비종류</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($settle_data['list2'] as $row): ?>
            <tr>
                <td title="결제번호"><?=$row['PackNo']?></td>
                <td title="묶음배송번호"><?=$row['dl_DeliveryGroupNo'] ? $row['dl_DeliveryGroupNo'] : $row['GroupNo']?></td>
                <td title="셀러명"><?=$row['cp_name']?></td>
                <td title="고객ID"><?=$row['BuyerId'] ? $row['BuyerId'] : $row['dl_BuyerId']?></td>
                <td title="배송비 결제일"><?=get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                <td title="상품대금 입금확인일"><?=$row['OrderDate'] <> '' ? get_dateformat($row['OrderDate'],'Y-m-d H:i:s') : get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                <td title="환불일"><?=get_dateformat($row['RefundDate'],'Y-m-d H:i:s')?></td>
                <td title="매출기준일"><?=get_dateformat($row['dl_RevenueDate'],'Y-m-d H:i:s')?></td>
                <td title="정산방식">
                    <?php
                    $SettleTypeMap = ['A' => '계좌송금','B' => '판매자예치금','S' => '스마일캐시'];
                    ?>
                    계좌송금
                </td>
                <td title="정산완료일"><?=get_dateformat($row['dl_RemitDate'],'Y-m-d H:i:s')?></td>
                <td title="배송비"><?=number_format($row['dl_DelFeeAmt'])?></td>
                <td title="배송수수료"><?=number_format($row['dl_DelFeeAmt']* 0.033)?></td>
                <td title="배송비 정산액"><?=number_format($row['dl_DelFeeAmt']*1 - $row['dl_DelFeeAmt']* 0.033)?></td>
                <td title="배송비종류">
                    <?php
                    $DelFeeTypeMap = [
                        '10' => '원배송비',
                        '20' => '추가배송비',
                        '30' => '(G)사용한원배송비환불금차감',
                        '40' => '반품배송비',
                        '50' => '추가반품배송비',
                        '60' => '무료반품배송비',
                        '70' => '교환배송비'
                    ];
                    ?>
                    <?= $DelFeeTypeMap[$row['dl_DelFeeType']] ?? '' ?>
                </td>
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
            <h1><?=$title_name?> 취소위약금 및 환불금차감 배송비 상세내역 | 검색결과 <span class="color-blue"><?=$settle_data['total_count3']?>개</span>
                <button class="btn btn-blue btn-mini" type="button"
                        onclick="location.href='<?= base_url('/calculate/auctionRefundExcelDown') . '?' . $_SERVER['QUERY_STRING'] ?>'">
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
                <th>결제번호</th>
                <th>주문번호</th>
                <th>묶음배송번호</th>
                <th>고객ID</th>
                <th>환불일</th>
                <th>매출기준일</th>
                <th>정산방식</th>
                <th>정산완료일</th>
                <th>금액</th>
                <th>배송수수료</th>
                <th>배송비 정산액</th>
                <th>종류</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($settle_data['list3'] as $row): ?>
                <tr>
                    <td title="결제번호"><?=$row['PackNo']?></td>
                    <td title="묶음배송번호"><?=$row['dl_DeliveryGroupNo'] ? $row['dl_DeliveryGroupNo'] : $row['GroupNo']?></td>
                    <td title="고객ID"><?=$row['BuyerId'] ? $row['BuyerId'] : $row['dl_BuyerId']?></td>
                    <td title="배송비 결제일"><?=get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                    <td title="상품대금 입금확인일"><?=$row['OrderDate'] <> '' ? get_dateformat($row['OrderDate'],'Y-m-d H:i:s') : get_dateformat($row['dl_PayDate'],'Y-m-d H:i:s')?></td>
                    <td title="환불일"><?=get_dateformat($row['RefundDate'],'Y-m-d H:i:s')?></td>
                    <td title="매출기준일"><?=get_dateformat($row['dl_RevenueDate'],'Y-m-d H:i:s')?></td>
                    <td title="정산방식">
                        <?php
                        $SettleTypeMap = ['A' => '계좌송금','B' => '판매자예치금','S' => '스마일캐시'];
                        ?>
                        계좌송금
                    </td>
                    <td title="정산완료일"><?=get_dateformat($row['dl_RemitDate'],'Y-m-d H:i:s')?></td>
                    <td title="배송비"><?=number_format($row['dl_DelFeeAmt'])?></td>
                    <td title="배송수수료"><?=number_format($row['dl_DelFeeCommission'])?></td>
                    <td title="배송비 정산액"><?=number_format($row['dl_DelFeeAmt']*1 - $row['dl_DelFeeCommission']*1)?></td>
                    <td title="배송비종류">
                        <?php
                        $DelFeeTypeMap = [
                            '10' => '원배송비',
                            '20' => '추가배송비',
                            '30' => '(G)사용한원배송비환불금차감',
                            '40' => '반품배송비',
                            '50' => '추가반품배송비',
                            '60' => '무료반품배송비',
                            '70' => '교환배송비'
                        ];
                        ?>
                        <?= $DelFeeTypeMap[$row['dl_DelFeeType']] ?? '' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo createPagination3($page3, $settle_data['total_count3'], $settle_data['items_per_page3'], getCurrentUrl()); ?>
</div><!--취소위약금 및 환불금차감 배송비 상세내역-->

<?php
echo view('common/adm_tail');
echo view('common/footer');
?>