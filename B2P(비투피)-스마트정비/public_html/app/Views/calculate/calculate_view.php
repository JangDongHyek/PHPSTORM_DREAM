
<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "정산 관리";

//var_dump($this->data['all_orders']['sql']);

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
        <button class="btn btn-blue btn-md" onclick="searchData()">검색하기</button>
        <button class="btn btn-black btn-md" type="button" onclick="downExcel();">엑셀 다운로드</button>
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
                        <option value="OrderNo" <?if($this->data['search_key'] == "OrderNo") echo "selected"?>>주문번호</option>
                        <option value="mb_id" <?if($this->data['search_key'] == "mb_id") echo "selected"?>>판매자ID</option>
                        <?php if($this->data['member']['mb_id'] == 'lets080' || $this->data['member']['mb_id'] == 'admin') {?>
                        <option value="cp_name" <?if($this->data['search_key'] == "cp_name") echo "selected"?>>회사명</option>
                        <option value="mb_name" <?if($this->data['search_key'] == "mb_name") echo "selected"?>>담당자</option>
                        <?php } ?>
                        <option value="PayNo" <?if($this->data['search_key'] == "PayNo") echo "selected"?>>결제번호</option>
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
    <div class="table flex nowrap">
        <table class="sticky" id="leftTable">
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
                    <?php if($this->data['member']['mb_id'] == 'lets080' || $this->data['member']['mb_id'] == 'admin') {?>
                    <th>회사명</th>
                    <th>담당자</th>
                    <?php } ?>
                    <th>주문번호</th>
                    <th>구매자명(아이디)</th>
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

                    <?php if($this->data['member']['mb_id'] == 'lets080' || $this->data['member']['mb_id'] == 'admin') {?>
                    <td><?=$data['cp_name']?></td>
                    <td><?=$data['mb_name']?></td>
                    <?php } ?>
                    <!--                <td><a data-toggle="modal" data-target="#orderSheetModal">--><?//=$data['OrderNo']?><!--</a></td>-->
                    <td><a><?=$data['OrderNo']?></a></td>
                    <td><?=$data['BuyerName']?> (<?=$data['BuyerId']?>)</td>
                </tr>
            <?php }?>
            <?php if($this->data['orders']['count']) {?>

                <tr class="sum">
                    <td colspan="8">기간 내 합계</td>
                </tr>
            <?php }else {?>
                <tr>
                    <td colspan="6" class="empty">
                        데이터가 없습니다.
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <table id="rightTable">
            <thead>
            <tr>
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
                    <td><?=$data['GoodsName']?></td>
                    <td>카드결제</td>
                    <td class="text_right"><?=number_format($order['b2p']['OrderAmount'])?>원</td>
                    <td class="text_right"><?=number_format($order['b2p']['category_fee_cost'])?>원</td>
                    <td class="text_right"><?=number_format($order['OrderAmount']  - $order['b2p']['category_fee_cost'])?>원</td>
                    <td class="text_right">
                        <details>
                            <summary>총 <?=number_format($order['b2p']['totalDiscount'])?>원</summary>
                            <dl>
                                <dt>판매자할인<?=$data['SiteType'] == '1' ? '/쿠폰비' : ''?></dt>
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
                            <summary>총 <?=number_format($order['b2p']['new_b2p_kcp_price'] - $order['b2p']['new_b2p_cp_fee_price'])?>원</summary>
                            <dl>
                                <dt>KCP수수료</dt>
                                <dd><?=number_format($order['b2p']['new_b2p_kcp_price'])?>원</dd>
                                <dt>KCP수수료(캐시백이벤트)</dt>
                                <dd style="text-decoration: line-through"><?=number_format($order['b2p']['new_b2p_cp_fee_price'])?>원</dd>
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
                    <td colspan="2" class="text-right">
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
    function syncRowHeights() {
        const leftRows = document.querySelectorAll('#leftTable tbody tr');
        const rightRows = document.querySelectorAll('#rightTable tbody tr');

        // 각 테이블의 행 수에 따라 동일한 높이 설정
        for (let i = 0; i < Math.min(leftRows.length, rightRows.length); i++) {
            const leftRow = leftRows[i];
            const rightRow = rightRows[i];

            // 기존 높이를 초기화
            leftRow.style.height = 'auto';
            rightRow.style.height = 'auto';

            // 각 행의 높이를 비교하여 더 큰 값으로 설정
            const maxHeight = Math.max(leftRow.offsetHeight, rightRow.offsetHeight);
            leftRow.style.height = `${maxHeight}px`;
            rightRow.style.height = `${maxHeight}px`;
        }
    }

    // 초기 높이 동기화 및 details 클릭 시 높이 동기화
    syncRowHeights();
    document.querySelectorAll('#rightTable details').forEach(detail => {
        detail.addEventListener('toggle', syncRowHeights);
    });

    // 창 크기가 변경될 때 높이 다시 동기화
    window.addEventListener('resize', syncRowHeights);


    // 모든 details 요소에 이벤트 리스너 추가
    document.querySelectorAll('tr').forEach(tr => {
        const detailsList = tr.querySelectorAll('details');

        // 각 details 요소에 이벤트 리스너 설정
        detailsList.forEach(details => {
            details.addEventListener('toggle', () => {
                // 현재 열린 상태를 다른 details에도 반영
                const isOpen = details.open;
                detailsList.forEach(otherDetails => {
                    otherDetails.open = isOpen;
                });
            });
        });
    });
</script>
<script>
    let last = <?=$this->data['last']?>;
    let page = <?=$this->data['page']?>;
    let month = <?=$this->data['month']?>;
    let start_day = "<?=$this->data['start_day']?>";
    let end_day = "<?=$this->data['end_day']?>";
    let search_key = "<?=$this->data['search_key']?>";
    let search_value = "<?=$this->data['search_value']?>";

    function downExcel() {
        let obj = getUrlParams()
        let addUrl = getUrlQuery(obj);
        window.location.href = "calculate/calcExcelDown?" + addUrl;
    }

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

    function getUrlQuery(obj) {
        return Object.keys(obj)
            .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(obj[key])}`)
            .join('&');
    }

    function getUrlParams() {
        // URLSearchParams를 사용하여 쿼리 스트링을 처리
        const params = new URLSearchParams(window.location.search);
        const paramsObject = {};

        // URLSearchParams의 모든 키-값 쌍을 객체에 추가
        params.forEach((value, key) => {
            paramsObject[key] = value;
        });

        return paramsObject;
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