<?php
include_once APPPATH.'libraries/Jl.php';
include_once APPPATH.'libraries/JlModel.php';

// 주어진 날짜에서 년도만 추출
$startYear = (int)date("Y", strtotime($minDate));

// 현재 날짜의 년도 추출
$currentYear = (int)date("Y");

if (!$minDate) {

    $startYear = $currentYear;
}

$bs_agency_fee = new JlModel(array("table" => "bs_agency_fee"));
?>
<!--에이전시 정산 목록-->
<section class="member" id="account">
    <form name="searchFrm" autocomplete="off">
        <div class="panel">
            <p>총 <span class="green"><?= $paging['totalCount'] ?></span>개 </p>
            <div>
                <select name="sfl">
                    <?
                    //$sflList = ['oName' => '주문자명', 'ordNo'=>'주문번호', 'rId'=> '주문자아이디', 'rName'=>'받는사람명', 'cName' => '한의원명', 'item'=>'상품명'];
                    $sflList = ['oName' => '주문자명', 'rId' => '주문자아이디', 'item' => '상품명'];
                    foreach ($sflList as $key => $val) {
                        ?>
                        <option value="<?= $key ?>" <?= $_GET['sfl'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                    <? } ?>
                </select>
                <input class="search-bar" name="stx" type="search" value="<?= $_GET['stx'] ?>" placeholder="검색어를 입력하세요">
                <button type="submit" class="btn_search"><i class="fa-light fa-magnifying-glass"></i></button>
            </div>

            <span>
                <button type="button" class="btn btn_blue" onclick="window.open('<?=base_url('/excel/downloadAgency')?>')">엑셀 다운</button>
            </span>
        </div>
        <div class="box">
            <div class="tagbox">
                <div>
                    <p><strong>조회</strong></p>
                </div>
                <div>
                    <select name="year" id="year"
                            onchange="searchFilter('year',this.value);searchFilter('month',$('#month').val(''));">
                        <option value="">년도</option>
                        <?php for ($year = $startYear; $year <= $currentYear; $year++) { ?>
                            <option value="<?= $year ?>" <?= $year == $_GET['year'] ? 'selected' : '' ?>><?= $year ?>년
                            </option>
                        <?php } ?>
                    </select>
                    <select name="month" id="month"
                            onchange="if($('#year').val()){searchFilter('month',this.value)}else{ this.value = ''; }">
                        <option value="" <?= $_GET['month'] == '' ? 'selected' : '' ?>>월</option>
                        <?php for ($month = 1; $month <= 12; $month++) { ?>
                            <option value="<?= $month ?>" <?= $month == $_GET['month'] ? 'selected' : '' ?>><?= $month ?>
                                월
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <p><strong>업체명</strong></p>
                </div>

                <div id="agency_filter_list">
                    <input type="hidden" id="mb_id" name="mb_id">
                    <p><a><span class="tag <?= $_GET['mb_id'] == '' ? 'active' : '' ?>"
                                onclick="searchFilter('mb_id','')">전체</span></a></p>

                    <?php foreach ($agencyMember as $memberList) { ?>
                        <p><a><span class="tag <?= $_GET['mb_id'] == $memberList ? 'active' : '' ?>"
                                    onclick="searchFilter('mb_id','<?= $memberList ?>')"><?= $memberList ?></span></a>
                        </p>
                    <?php } ?>

                </div>
            </div>
    </form>
    <div class="boxline">
        <div class="table adm pc">
            <table>
                <colgroup>
                    <!--
                    <col width="60px">
                    -->
                    <col width="70px">
                    <col width="100px">
                    <col width="400px">
                    <col width="auto">
                    <col width="auto">
                </colgroup>
                <thead>
                <tr>
                    <!--
                    <th><input type="checkbox" onclick="selectAllCheckbox(this, 'checkIdx')"></th>
                    -->
                    <th>No.</th>
                    <th>주문일</th>
                    <th>주문 업체 (대표자명)</th>
                    <th>주문상품</th>
                    <th>주문가격</th>
                    <th>총 주문금액</th>
                    <th>정산 수수료</th>
                    <th>총 정산금액</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $totalPrice = 0;
                $agency_fee_totalPrice = 0;
                foreach ($listData as $list3) {
                    $totalPrice += $list3['order_price'] * 1;
                    //$agency_fee_totalPrice += $list3['agency_fee2'] * 1;
                }
                ?>
                <tr class="total">
                    <td></td>
                    <td colspan="2"><strong>합계</strong></td>
                    <td>
                        <?php
                        if ($_GET['year']) {
                            echo $_GET['year'].'년';
                        }
                        if ($_GET['month']) {
                            echo $_GET['month'] < 10 ? ' 0' . $_GET['month'].'월' : ' ' . $_GET['month'].'월';
                        }
                        ?>
                    </td>
                    <td colspan="2" class="text_right txt_blue txt_bold"><?= number_format($totalPrice) ?>원</td>
                    <td colspan="3" class="text_right txt_blue txt_bold">
                        <span id="agency_total"><?= number_format($agency_fee_totalPrice, 1) ?>원</span>
                    </td>
                </tr>


                <?php
                $paging['listNo2'] = $paging['listNo'];
                foreach ($listData as $list) {
                    // 상품명
                    $prodName = getOrderProductName($list['prod_name']);
                    $orderData = $list['orderData'];
                    $orderItemData = $list['orderItemData'];
                    $memberInfo = $list['member_info'];
                    $idx = $list['idx'];
                    $agency_fee_arr = explode('|', $orderData['agency_fee']);

                    ?>
                    <tr>
                        <!--
                        <td><input type="checkbox" name="checkIdx" value="<?= $list['idx'] ?>"></td>
                        -->
                        <td><?= $paging['listNo'] ?></td>
                        <td><?= replaceDateFormat($list['reg_date']) ?></td>
                        <th class="text_left"><span class="icon line"><?= $memberInfo['mb_id'] ?></span>
                            <?= $memberInfo['mb_name'] ?> (<?= $memberInfo['rep_name'] ?>)
                        </th>


                        <td class="item text_left">
                            <?php foreach ($orderItemData as $orderItem) { ?>
                                <p><?= $orderItem['item_name'] ?><span><?= $orderItem['item_cnt'] ?>개</span></p>
                            <?php } ?>
                        </td>

                        <td class="item text_left">
                            <?php foreach ($orderItemData as $orderItem) { ?>
                                <p><?= number_format($orderItem['item_price'] * $orderItem['item_cnt']) ?>원</p>
                            <?php } ?>
                        </td>

                        <td class="text_right price"><?= number_format($list['order_price']) ?>원</td>

                        <td class="item text_left">
                            <? $order_total_price = 0;?>
                            <?php foreach ($orderItemData as $orderItem) {
                                $bs_agency_fee->where('product_idx',$orderItem['product_idx']);
                                $bs_agency_fee->where('mb_id',$member['mb_id']);
                                $agency_data = $bs_agency_fee->get();
                                if($agency_data['count']) {
                                    $ad = $agency_data['data'][0];
                                    $percent = $ad['fee'];
                                    $price = ($orderItem['item_price'] * $orderItem['item_cnt']) * ($percent / 100);
                                }else {
                                    $percent = 0;
                                    $price = 0;
                                }

                                $agency_fee_totalPrice += $price;

                                $order_total_price += $price;
                                ?>
                                <p><?=$percent?>%
                                    <span><?=number_format($price)?>원 </span>
                                </p>
                            <?php } ?>
                        </td>
                        <td class="text_right price">
                            <?=number_format($order_total_price)?>원
                        </td>
                    </tr>
                    <?php
                    $paging['listNo']--;

                }
                ?>


                </tbody>
            </table>
        </div>
        <div class="mobile">
            <ul class="mobile_list">

                <li class="all_total">
                    <p>합계</p>
                    <p class="number">
                        <span>
                        <?php
                        if ($_GET['year']) {
                            echo $_GET['year'].'년';
                        }
                        if ($_GET['month']) {
                            echo $_GET['month'] < 10 ? ' 0' . $_GET['month'].'월' : ' ' . $_GET['month'].'월';
                        }
                        ?>
                        </span>
                        <b>주문합계</b><?= number_format($totalPrice) ?>원<br>
                        <b>정산합계</b><?= number_format($agency_fee_totalPrice, 1) ?>원
                    </p>
                </li>

                <?php
                $isFirst = true;  // 첫 번째 항목인지 여부를 확인하기 위한 변수
                foreach ($listData as $list2) {

                    $orderData2 = $list2['orderData'];
                    $orderItemData2 = $list2['orderItemData'];
                    $agency_fee_arr2 = explode('|', $orderData2['agency_fee']);
                    ?>


                    <li>
                        <div>
                            <p class="no">
                                <!--
                                <input type="checkbox" name="checkIdx" value="<?= $list2['idx'] ?>">
                                -->
                                <span
                                        class="count">No. <?= $paging['listNo2'] ?></span><span
                                        class="date"><?= replaceDateFormat($list2['reg_date']) ?></span></p>
                            <p class="info">
                                <span class="icon line"><?= $memberInfo['mb_id'] ?></span>
                                <span class="company"><?= $memberInfo['mb_name'] ?></span>
                                <span class="ceo"><?= $memberInfo['rep_name'] ?></span>
                            </p>
                            <p class="txt_bold text_right total txt_blue">주문금액
                                | <?= number_format($list2['order_price']) ?>원</p>
                            <p class="txt_bold text_right total txt_blue">정산합계
                                | <?= $list2['agency_fee2'] ? number_format($list2['agency_fee2'], 1) : 0 ?>원</p>
                            <button type="button" class="btn btn_line2 w100" data-toggle="collapse"
                                    data-target="#m_list<?= $list2['idx'] ?>"
                                    aria-expanded="true" aria-controls="m_list<?= $list2['idx'] ?>">주문내역
                            </button>
                            <div id="m_list<?= $list2['idx'] ?>" class="collapse <?= $isFirst ? 'in' : '' ?> list ">
                                <!--첫번째 펼침 제공 클래스 in-->
                                <h6>주문상품</h6>
                                <?php $count3 = 0; ?>
                                <?php foreach ($orderItemData2 as $orderItem2) { ?>
                                    <p class="item"><?= $orderItem2['item_name'] ?>
                                        <span><?= $orderItem2['item_cnt'] ?>개</span></p>
                                    <p><b>주문가격 | <?= number_format($orderItem2['item_price']) ?>원</b></p>
                                    <p><b>정산 수수료 <?= $agency_fee_arr2[$count3] ? $agency_fee_arr2[$count3] : 0 ?>%
                                            | <?= number_format($orderItem2['item_price'] * ($agency_fee_arr2[$count3] / 100), 1) ?>
                                            원</b></p>
                                    <?php $count3++; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <?php
                    $paging['listNo2']--;
                    $isFirst = false;  // 첫 번째 이후에는 false로 설정
                }
                ?>


            </ul>
        </div>
    </div>
    <? include_once VIEWPATH . 'component/pagination.php'; // 페이징?>
</section>

<?php
$jl = new Jl();
$jl->jsLoad();
?>

<script>
    let agency_total = <?=$agency_fee_totalPrice?>;
    document.getElementById('agency_total').innerHTML = agency_total.format() + "원";

    const searchFrm = document.searchFrm; // 검색 폼

    // 검색
    searchFrm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 검색어 2글자 이상
        if (e.target.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");
        searchFrm.submit();
    });

    // 검색 필터
    const searchFilter = (filter, value) => {
        searchFrm[filter].value = value;
        searchFrm.submit();
    }
</script>
