
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "정산 관리";

//var_dump($this->data['search_all_orders']['sql']);

//kcp 카드수수료 이벤트중일때 true 아니면 false
$card_event = true;
$kcp_commission = 2.3 / 100;
$kcp_cash_back = 2.3 / 100;
$b2p_commission = 5 / 100;

// global 변수를 사용할려면 ci설정을 바꿔야하기때문에 파라미터로 대체
$function_array = array(
    "card_event" => $card_event,
    "kcp_commission" => $kcp_commission,
    "kcp_cash_back" => $kcp_cash_back,
    "b2p_commission" => $b2p_commission
);

//달의 정산금액을 확인하는
function sortMonthOrder($month,$objects,$info) {
    $card_event = $info['card_event'];
    $kcp_commission = $info['kcp_commission'];
    $kcp_cash_back = $info['kcp_cash_back'];
    $b2p_commission = $info['b2p_commission'];

    $year = date('Y');
    $start_day = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
    $end_day = date('Y-m-d', mktime(0, 0, 0, $month + 1, 0, $year));

    $start_date = new DateTime($start_day);
    $end_date = new DateTime($end_day);

    $result = 0;
    foreach ($objects as $index => $data) {
        $data_date = new DateTime($data['OrderDate']);

        if($start_date <= $data_date && $data_date <= $end_date) {
            $order = processOrder($data);


            $result += $order['b2p']['calcPrice'];

        }
    }

    return number_format($result);
}

//검색 및 현재 데이터의 총합 값
function totalOrderKey($objects,$key,$info) {
    $card_event = $info['card_event'];
    $kcp_commission = $info['kcp_commission'];
    $kcp_cash_back = $info['kcp_cash_back'];
    $b2p_commission = $info['b2p_commission'];

    $total_order = 0;
    $total_commission = 0;
    $total_calc = 0;
    foreach ($objects as $index => $data) {
        $order = processOrder($data);

        $total_order += $order['b2p']['OrderAmount'];
        $total_commission += $order['b2p']['totalCommission'];
        $total_calc += $order['b2p']['calcPrice'];
    }

    switch ($key) {
        case 'order' :
            return number_format($total_order);
        case 'commission' :
            return number_format($total_commission);
        case 'calc' :
            return number_format($total_calc);
    }
}

function processOrder($order) {
    //데이터 재선언
    // 빈값 및 소수점 절사를 위한 데이터 재 선언
    $order['SellerCashbackMoney'] = $order['SellerCashbackMoney'] ? (int)$order['SellerCashbackMoney'] : 0;
    $order['SellerDiscountTotalPrice'] = $order['SellerDiscountTotalPrice'] ? (int)$order['SellerDiscountTotalPrice'] : 0;
    $order['OrderAmount'] = $order['OrderAmount'] ? (int)$order['OrderAmount'] : 0;
    $order['SettlementPrice'] = $order['SettlementPrice'] ? (int)$order['SettlementPrice'] : 0;
    $order['DirectDiscountPrice'] = $order['DirectDiscountPrice'] ? (int)$order['DirectDiscountPrice'] : 0;
    $order['SellerFundingDiscountPrice'] = $order['SellerFundingDiscountPrice'] ? (int)$order['SellerFundingDiscountPrice'] : 0;
    $order['DeductTaxPrice'] = $order['DeductTaxPrice'] ? (int)$order['DeductTaxPrice'] : 0;
    $order['BuyerPayAmt'] = $order['BuyerPayAmt'] ? (int)$order['BuyerPayAmt'] : 0;
    $order['ServiceFee'] = $order['ServiceFee'] ? (int)$order['ServiceFee'] : 0;
    $order['b2p_kcp_price'] = $order['b2p_kcp_price'] ? (int)$order['b2p_kcp_price'] : 0;
    $order['b2p_cp_fee_price'] = $order['b2p_cp_fee_price'] ? (int)$order['b2p_cp_fee_price'] : 0;
    $order['DeductTaxPrice'] = abs($order['DeductTaxPrice']);
    $order['TotCommission'] = abs($order['TotCommission']);



    //주문금액
    $OrderAmount = (int)$order['SellOrderPrice'] + (int)$order['OptionPrice'];
    //b2p 수수료
    $b2p_cost = $order['b2p_cost'];
    // 카테고리 수수료
    $category_fee_cost = $order['TotCommission'] - $order['DeductTaxPrice'] + $b2p_cost;
    //b2p 카드 수수료
    $b2p_kcp_price = $order['b2p_kcp_price'];
    //b2p 셀러별 카드 페이백
    $b2p_cp_fee_price = $order['b2p_cp_fee_price'];

    //판매자 할인 / 공제금
    $SellerDiscountPrice = $order['SiteType'] == 1 ? $order['SellerDiscountTotalPrice'] : $order['SellerDiscountPrice'];
    $totalDiscount = 0;
    $totalDiscount += $SellerDiscountPrice;


    // 쿠폰할인 옥션은 쿠폰할인의 값이 판매자할인에 들어옴
    if($order['SiteType'] == 1) {
        $category_fee_cost += $order['DeductTaxPrice'];
    }else {
        $category_fee_cost -= $order['SellerCashbackMoney'];;
        $totalDiscount += $order['SellerCashbackMoney'];
        $totalDiscount += $order['SellerFundingDiscountPrice'];

        $totalDiscount += $order['DeductTaxPrice'];
    }

    // 정산 예정 값
    try {
        $calcPrice = $order['SettlementPrice'] - $b2p_kcp_price + $b2p_cp_fee_price;

    }catch (Exception $e) {
        var_dump($order);
        //$calcPrice=0;
        die();
    }

    // 배송비 및 배송비 수수료 관련
    $dl_DelFeeAmt = $order['ShippingFee'];
    $dl_DelFeeCommission = $dl_DelFeeAmt * 0.033;
    $b2p_shipping_fee = $dl_DelFeeAmt * 0;

    // b2p배송비수수료 옥션이면 반올림 g마켓이면 올림
    if($order['SiteType'] == 1) {
        $b2p_shipping_fee = round($b2p_shipping_fee);
        $dl_DelFeeCommission = round($dl_DelFeeCommission);
    }else {
        $b2p_shipping_fee = ceil($b2p_shipping_fee);
        $dl_DelFeeCommission = ceil($dl_DelFeeCommission);
    }

    //부가세
    $surTax = round($order['BuyerPayAmt'] / 11);// B2P 부가세 = 고객 결제금 / 11
    $b2p_surTax = round($calcPrice / 11);// 셀러 부가세 = 정산예정금액 / 11
    $b2p_surTax = ceil($b2p_surTax);
    $refund = $surTax - $b2p_surTax;




    $totalCommission = $category_fee_cost + $totalDiscount + $dl_DelFeeCommission + $b2p_shipping_fee;
    // 정산 예정 값
    try {
        $totalCommission += ($b2p_kcp_price - $b2p_cp_fee_price);
    }catch (Exception $e) {
        //$totalCommission += 0;
        var_dump($order);
        die();
    }

    $calcPrice = ($OrderAmount + ($dl_DelFeeAmt - $dl_DelFeeCommission - $b2p_shipping_fee));
    $calcPrice -= $category_fee_cost;
    $calcPrice -= $totalDiscount;
    $calcPrice -= ($b2p_kcp_price - $b2p_cp_fee_price);

    $b2p = array(
        "OrderAmount" => $OrderAmount,                  // 주문금액
        "category_fee_cost" => $category_fee_cost,      // 카테고리 수수료
        "totalDiscount" => $totalDiscount,              // 판매자 할인금액
        "SellerDiscountPrice" => $SellerDiscountPrice,  // 쿠폰할인
        "calcPrice" => $calcPrice,                      // 정산 금액
        "dl_DelFeeAmt" => $dl_DelFeeAmt,                // 배송금액
        "dl_DelFeeCommission" => $dl_DelFeeCommission,  // 배송비 수수료
        "b2p_shipping_fee" => $b2p_shipping_fee,        // b2p 배송비 수수료
        "surTax" => $surTax,                            // 부가세
        "b2p_surTax" => $b2p_surTax,                    // b2p 부가세
        "refund" => $refund,                            // 총부가세
        "totalCommission" => $totalCommission,          // 카테고리,판매자 할인총금액,배송비수수료
    );

    $order['b2p'] = $b2p;

    return $order;
}

?>


<?php echo view('calculate/calcu_head', $this->data); ?>
<?php
//echo var_dump($this->data['orders']['data']);
//var_dump(totalMonthOrder(8,$this->data['orders']['data']));
//echo $this->data['orders']['sql'];
//echo 1;
?>
<div class="sch_wrap">
    <p class="tit">검색조건
        <a class="btn btn-gray btn-md male-auto" href="/calculate" >조건초기화</a>
        <button class="btn btn-blue btn-md" onclick="searchData()">검색하기</button></p>
    </p>
    <div class="box flexwrap">
        <div>
            <p>일자구분</p>
            <div class="input_date">
                <!--                <div class="input_select w150px">-->
                <!--                    <select class="border_gray">-->
                <!--                        <option value="D1" selected="">입금확인일</option>-->
                <!--                        <option value="D3">매출기준일</option>-->
                <!--                        <option value="D7">구매결정일</option>-->
                <!--                        <option value="D4">환불일</option>-->
                <!--                        <option value="D6">정산완료일</option>-->
                <!--                    </select>-->
                <!--                </div>-->
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray" id="start_day" name="start_day" <?if($this->data['start_day']) echo "value='{$this->data['start_day']}'"?>>
                </div>
                ~
                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray" id="end_day" name="end_day" <?if($this->data['end_day']) echo "value='{$this->data['end_day']}'"?>>
                </div>
                <div class="select flex nowrap">
                    <input type="radio" id="date1" name="date" value="">
                    <label for="date1" onclick="changeDay(0)">오늘</label>
                    <input type="radio" id="date2" name="date" value="">
                    <label for="date2" onclick="changeDay(7)">일주일</label>
                    <input type="radio" id="date3" name="date" value="">
                    <label for="date3" onclick="changeDay(30)">한달</label>
                    <input type="radio" id="date4" name="date" value="">
                    <label for="date4" onclick="changeDay(90)">3개월</label>
                </div>
            </div>
        </div>

        <div>
            <p>검색하기</p>
            <div class="flex gap5">
                <div class="input_select">
                    <select class="border_gray" id="search_key">
                        <option value="mb_id" <?if($this->data['search_key'] == "mb_id") echo "selected"?>>판매자ID</option>
                        <option value="PayNo" <?if($this->data['search_key'] == "PayNo") echo "selected"?>>결제번호</option>
                        <option value="OrderNo" <?if($this->data['search_key'] == "OrderNo") echo "selected"?>>주문번호</option>
                        <option value="SiteGoodsNo" <?if($this->data['search_key'] == "SiteGoodsNo") echo "selected"?>>상품번호</option>
                    </select>
                </div>
                <div class="input_search">
                    <input type="text" placeholder="검색어를 입력하세요" class="border_gray" id="search_value" value="<?=$this->data['search_value']?>">
                    <button onclick="searchData()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
        <div>
            <p>판매처</p>
            <div class="input_select">
                <select class="border_gray" id="SiteType">
                    <option value="">전체</option>
                    <option value="2" <?=$this->data['SiteType'] == '2' ? 'selected' : ''?>>G마켓</option>
                    <option value="1" <?=$this->data['SiteType'] == '1' ? 'selected' : ''?>>옥션</option>
                </select>
            </div>
        </div>
    </div>
</div>



<div class="result_wrap">
    <div class="box_gray">
        <?php for ($i=1;$i <= 12; $i++) {?>
            <div class="monthBox <?php if($this->data['month'] == $i) echo "monthBg";?>" data-action="calcMonth" data-month="<?=$i?>" onclick="changeMonth(<?=$i?>)">
                <h2><?=$i?>월</h2>
                <p><?=sortMonthOrder($i,$this->data['all_orders']['data'],$function_array)?>원</p>
            </div>
        <?}?>
    </div>
    <div class="top_text">
        <div class="wrap w100 flex">
            <?php if($this->data['start_day'] && $this->data['end_day']) {?>
                <h1>정산 내역 <span class="color-blue"><?=$this->data['start_day']?> ~ <?=$this->data['end_day']?></span></h1>
            <?php } else {?>
                <h1>정산 내역 <span class="color-blue"><?=$this->data['year']?>.<?=$this->data['month']?></span></h1>
            <?php }?>
        </div>
    </div>
    <div class="table">
        <table>
            <colgroup>
                <col style="width: 50px;">
                <col style="width: ;">
                <col style="width: 50px;">
            </colgroup>
            <thead>
            <tr>
                <th>No.</th>
                <th>판매일자</th>
                <th>구분</th>
                <th>판매자코드/거래처명</th>
                <th>주문번호</th>
                <th>구매자명(아이디)</th>
                <th>상품명</th>
                <th>결제방식</th>
                <th>판매금액</th>
                <th>카테고리 수수료</th>
                <th>공급원가</th>
                <th>판매자할인 / 공제금</th>
                <th>KCP수수료</th>
                <th>배송비</th>
                <?php if(false){?>
                <th>부가세</th>
                <?php } ?>
                <th>최종정산금액</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($this->data['orders']['data'] as $index => $data) {
                $order = processOrder($data);
                ?>
                <tr>
                    <td><?=$data['data_page_no']?></td>
                    <td><?=$data['OrderDate']?></td>
                    <td>
                        <div class="box__flag box__flag--<?=$data['SiteType'] == "1" ? "auction" : "gmarket" ?>"></div>
                    </td>
                    <td><?=$data['OutGoodsNo']?></td>
                    <!--                <td><a data-toggle="modal" data-target="#orderSheetModal">--><?//=$data['OrderNo']?><!--</a></td>-->
                    <td><a><?=$data['OrderNo']?></a></td>
                    <td><?=$data['BuyerName']?> (<?=$data['BuyerID']?>)</td>
                    <td><?=$data['GoodsName']?></td>
                    <td>카드결제</td>
                    <td class="text_right"><?=number_format($order['b2p']['OrderAmount'])?>원</td>
                    <td class="text_right"><?=number_format($order['b2p']['category_fee_cost'])?>원</td>
                    <td class="text_right"><?=number_format($order['OrderAmount']  - $order['b2p']['category_fee_cost'])?>원</td>
                    <td class="text_right">
                        <details>
                            <summary>총 <?=number_format($order['b2p']['totalDiscount'])?>원</summary>
                            <dl>
                                <dt>판매자할인/쿠폰비</dt>
                                <dd>-<?=number_format($order['b2p']['SellerDiscountPrice'] + $order['DeductTaxPrice'])?>원</dd>

                                <?if($data['SiteType'] == '2' ) {?>
                                    <!--지마켓-->
                                    <dt>쿠폰할인</dt>
                                    <dd>-<?=number_format($order['SellerFundingDiscountPrice'])?>원</dd>
                                <?}else {?>
                                    
                                <?}?>
                                <dt>스마일캐시지급</dt>
                                <dd>-<?=number_format($order['SellerCashbackMoney'])?>원</dd>
                            </dl>
                        </details>
                    </td>
                    <td class="text_right">
                        <details>
                            <summary>총 <?=number_format($order['b2p_kcp_price'] - $order['b2p_cp_fee_price'])?>원</summary>
                            <dl>
                                <dt>KCP수수료</dt>
                                <dd><?=number_format($order['b2p_kcp_price'])?>원</dd>
                                <dt>KCP수수료(캐시백이벤트)</dt>
                                <dd style="text-decoration: line-through"><?=number_format($order['b2p_cp_fee_price'])?>원</dd>
                            </dl>
                        </details>
                    </td>
                    <td class="text_right">
                        <details>
                            <summary>총 <?=number_format($order['b2p']['dl_DelFeeAmt'] - $order['b2p']['dl_DelFeeCommission'] + $order['b2p']['b2p_shipping_fee'])?>원</summary>
                            <dl>
                                <dt>배송비</dt>
                                <dd><?=number_format($order['b2p']['dl_DelFeeAmt'])?>원</dd>
                                <dt>배송비수수료</dt>
                                <dd><?=number_format($order['b2p']['dl_DelFeeCommission'] + $order['b2p']['b2p_shipping_fee'])?>원</dd>
                            </dl>
                        </details>
                    </td>
                    <?php if(false){?>
                    <td class="text_right">
                        <details>
                            <summary>총 <?=number_format($order['b2p']['surTax'] + $order['b2p']['b2p_surTax'])?>원</summary>
                            <dl>
                                <dt>B2P부가세</dt>
                                <dd><?=number_format($order['b2p']['surTax'])?>원</dd>
                                <dt>셀러부가세</dt>
                                <dd><?=number_format($order['b2p']['b2p_surTax'])?>원</dd>
                                <dt>차액</dt>
                                <dd><?=number_format($order['b2p']['refund'])?>원</dd>
                            </dl>
                        </details>
                    </td>
                    <?php } ?>
                    <td class="text_right"><?=number_format($order['b2p']['calcPrice'])?>원</td>
                </tr>
            <?php }?>

            <?php if($this->data['orders']['count']) {?>

                <tr class="sum">
                    <td colspan="3">기간 내 합계</td>
                    <td colspan="5" class="text-right">
                        <b>주문금액</b> |
                        <b><?=totalOrderKey($this->data['search_all_orders']['data'],"order",$function_array)?>원</b>
                    </td>
                    <td colspan="5" class="text-right">
                        <b>수수료</b> |
                        <b><?=totalOrderKey($this->data['search_all_orders']['data'],"commission",$function_array)?>원</b>
                    </td>
                    <td colspan="7" class="text-right">
                        <b>정산금액</b> |
                        <b><?=totalOrderKey($this->data['search_all_orders']['data'],"calc",$function_array)?>원</b>
                    </td>
                </tr>
            <?php }else {?>
                <tr>
                    <td colspan="99" class="empty">
                        데이터가 없습니다.
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>



    <?php echo createPagination($this->data['page'], $this->data['orders']['count'], $this->data['limit'], getCurrentUrl()); ?>

</div>

<script>
    let last = <?=$this->data['last']?>;
    let page = <?=$this->data['page']?>;
    let month = <?=$this->data['month']?>;
    let start_day = "<?=$this->data['start_day']?>";
    let end_day = "<?=$this->data['end_day']?>";
    let search_key = "<?=$this->data['search_key']?>";
    let search_value = "<?=$this->data['search_value']?>";

    function getSelectData(select_day) {
        // 현재 날짜 가져오기
        const today = new Date();

        const pastDate = new Date(today.getTime() - parseInt(select_day) * 24 * 60 * 60 * 1000);

        // 연도, 월, 일 가져오기
        const year = pastDate.getFullYear();
        const month = String(pastDate.getMonth() + 1).padStart(2, '0'); // 월은 0부터 시작하므로 +1
        const day = String(pastDate.getDate()).padStart(2, '0');

        // YYYY-MM-DD 형식으로 반환
        return `${year}-${month}-${day}`;
    }

    function changeDay(select_day) {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // 월은 0부터 시작하므로 +1
        const day = String(today.getDate()).padStart(2, '0');

        let end_day = `${year}-${month}-${day}`;
        let start_day = getSelectData(select_day);

        let object = {
            end_day : end_day,
            start_day : start_day,
            search_key : $('#search_key').val(),
            search_value : $('#search_value').val(),
            SiteType : $('#SiteType').val()
        }

        objectHref(object);
    }

    function objectHref(object) {
        let url = "?";
        Object.keys(object).forEach(function (key) {
            url += `${key}=${object[key]}&`;
        });

        window.location.href = url;
    }

    function searchData() {
        let object = {
            start_day : $('#start_day').val(),
            end_day : $('#end_day').val(),
            search_key : $('#search_key').val(),
            search_value : $('#search_value').val(),
            SiteType : $('#SiteType').val()
        }

        objectHref(object)
    }

    function changeMonth(m) {
        let obj = {
            search_key : $('#search_key').val(),
            search_value : $('#search_value').val(),
            SiteType : $('#SiteType').val(),
            month : m
        }
        objectHref(obj)
    }

    function changePage(p) {
        if(p > last) return false;
        if(p < 1) return false;

        let object = {
            page : p,
            month : month,
            start_day : start_day,
            end_day : end_day,
            search_key : search_key,
            search_value : search_value
        }

        objectHref(object)
    }
</script>

<?php echo view('order/order_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>