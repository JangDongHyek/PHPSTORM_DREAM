
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
            $OrderAmount = (int)$data['SellOrderPrice'] + (int)$data['OptionPrice'];
            $b2p_fee = $OrderAmount * $b2p_commission;
            $card_fee = (int)($data['AcntMoney'] * $kcp_commission);
            $card_payback = (int)($data['AcntMoney'] * $kcp_cash_back);
            $SettlementPrice = (int)$data['SettlementPrice'];

            $total_fee = $card_fee;

            if($card_event) $total_fee = $card_fee - $card_payback;

            $result += $SettlementPrice - $b2p_fee - $total_fee;
        }
    }

    return number_format($result);
}

function totalOrderKey($objects,$key,$info) {
    $card_event = $info['card_event'];
    $kcp_commission = $info['kcp_commission'];
    $kcp_cash_back = $info['kcp_cash_back'];
    $b2p_commission = $info['b2p_commission'];

    $total_order = 0;
    $total_commission = 0;
    $total_calc = 0;
    foreach ($objects as $index => $data) {
        $OrderAmount = (int)$data['SellOrderPrice'] + (int)$data['OptionPrice'];
        $AcntMoney = (int)$data['AcntMoney'];

        $service_fee = $OrderAmount * 0.13;
        $b2p_fee = $OrderAmount * $b2p_commission;

        $card_fee = (int)($AcntMoney * $kcp_commission);
        $card_payback = (int)($AcntMoney * $kcp_cash_back);
        $ServiceFee = (int)$data['ServiceFee'];
        $SettlementPrice = (int)$data['SettlementPrice'];
        $SellerDiscountTotalPrice = (int)$data['SellerDiscountTotalPrice'];

        $total_fee = $card_fee;
        if($card_event) $total_fee = $card_fee - $card_payback;

        $total_order += $OrderAmount;
        $total_commission += ($b2p_fee + $service_fee + $total_fee);
        $total_calc += ($SettlementPrice - $b2p_fee - $total_fee);
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
        <? for ($i=1;$i <= 12; $i++) {?>
        <div class="monthBox <?php if($this->data['month'] == $i) echo "monthBg";?>" data-action="calcMonth" data-month="<?=$i?>" onclick="changeMonth(<?=$i?>)">
            <h2><?=$i?>월</h2>
            <p><?=sortMonthOrder($i,$this->data['all_orders']['data'],$function_array)?>원</p>
        </div>
        <?}?>
    </div>
    <div class="top_text">
        <div class="wrap w100 flex">
            <?if($this->data['start_day'] && $this->data['end_day']) {?>
            <h1>정산 내역 <span class="color-blue"><?=$this->data['start_day']?> ~ <?=$this->data['end_day']?></span></h1>
            <?} else {?>
            <h1>정산 내역 <span class="color-blue"><?=$this->data['year']?>.<?=$this->data['month']?></span></h1>
            <?}?>
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
                <th>주문금액</th>
                <th>카테고리 수수료</th>
                <th>공급원가</th>
                <th>판매자할인 / 공제금</th>
                <th>KCP수수료</th>
                <?if($card_event){?>
                <th>KCP수수료(캐시백이벤트)</th>
                <?}?>
                <th>최종정산금액</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($this->data['orders']['data'] as $index => $data) {
                $data['SellerCashBackMoney'] = $data['SellerCashBackMoney'] ? (int)$data['SellerCashBackMoney'] : 0;
                $data['SellerDiscountTotalPrice'] = $data['SellerDiscountTotalPrice'] ? (int)$data['SellerDiscountTotalPrice'] : 0;
                $data['OrderAmount'] = $data['OrderAmount'] ? (int)$data['OrderAmount'] : 0;
                // 주문 금액이랑 EMS랑 안맞을때가 있어 직접 변수 생성
                $OrderAmount = (int)$data['SellOrderPrice'] + (int)$data['OptionPrice'];
                $data['SettlementPrice'] = $data['SettlementPrice'] ? (int)$data['SettlementPrice'] : 0;

                $data['DirectDiscountPrice'] = $data['DirectDiscountPrice'] ? (int)$data['DirectDiscountPrice'] : 0;
                $data['SellerFundingDiscountPrice'] = $data['SellerFundingDiscountPrice'] ? (int)$data['SellerFundingDiscountPrice'] : 0;

                $service_fee = $OrderAmount * 0.13;     // 기존 카테고리 수수료 13프로
                $b2p_fee = $OrderAmount * $b2p_commission; // b2p 수수료 5프로

                $card_fee = (int)($data['AcntMoney'] * $kcp_commission);
                $card_payback = (int)($data['AcntMoney'] * $kcp_cash_back);
                $total_fee = $card_fee;
                if($card_event) $total_fee = $card_fee - $card_payback;

                $totalDiscount = 0;
                $totalDiscount += $data['SellerDiscountPrice'] + $data['SellerCashBackMoney'];
                if($data['SiteType'] == 1) $totalDiscount += $data['DirectDiscountPrice'];
                else $totalDiscount += $data['SellerFundingDiscountPrice'];


                if($card_event) $calcPrice = $data['SettlementPrice'] - $b2p_fee;
                else $calcPrice = $data['SettlementPrice'] - $b2p_fee - $total_fee;

                
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
                <td><?=number_format($OrderAmount)?>원</td>
                <td><?=number_format($b2p_fee + $service_fee)?>원</td>
                <td><?=number_format($OrderAmount - $b2p_fee - $service_fee)?>원</td>
                <td>
                    <details>
                        <summary>총 <?=number_format($totalDiscount)?>원</summary>
                        <dl>
                            <dt>판매자할인</dt>
                            <dd>-<?=number_format($data['SellerDiscountPrice'])?></dd>
                            <?if($data['SiteType'] == '1') {?>
                            <!--옥션-->
                            <dt>쿠폰할인</dt>
                            <dd>-<?=number_format($data['DirectDiscountPrice'])?></dd>
                            <?}else {?>
                            <!--지마켓-->
                            <dt>쿠폰할인</dt>
                            <dd>-<?=number_format($data['SellerFundingDiscountPrice'])?></dd>
                            <?}?>
                            <dt>스마일캐시지급</dt>
                            <dd>-<?=number_format($data['SellerCashBackMoney'])?></dd>
                        </dl>
                    </details>
                </td>
                <td><?=number_format($card_fee)?>원</td>
                <?if($card_event){?>
                <td style="text-decoration: line-through;"><?=number_format($card_payback)?>원</td>
                <?}?>
                <td><?=number_format($calcPrice)?>원</td>
            </tr>
            <?php }?>

            <?php if($this->data['orders']['count']) {?>

            <tr class="sum">
                <td colspan="2">기간 내 합계</td>
                <td colspan="4" class="text-right">
                    <b>주문금액</b> |
                    <b><?=totalOrderKey($this->data['search_all_orders']['data'],"order",$function_array)?>원</b>
                </td>
                <td colspan="4" class="text-right">
                    <b>수수료</b> |
                    <b><?=totalOrderKey($this->data['search_all_orders']['data'],"commission",$function_array)?>원</b>
                </td>
                <td colspan="6" class="text-right">
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