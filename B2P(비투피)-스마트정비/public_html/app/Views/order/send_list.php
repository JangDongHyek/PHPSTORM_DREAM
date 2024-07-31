<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "주문 관리";

?>


<?php echo view('order/order_head', $this->data); ?>

    <div class="today_wrap">
        <div class="flex jc-sb">
            <p>발송처리 대기</p>
            <h1><span class="color-blue"><?= number_format((int)$order_data['total_count']) ?></span>건</h1>
        </div>
        <div class="flex jc-sb">
            <p>발송마감 임박</p>
            <i>발송마감일이 오늘까지에요!</i>
            <h1><span class="color-blue"><?= number_format((int)$order_data['send_count']) ?></span>건</h1>
        </div>
        <div class="flex jc-sb">
            <p>발송지연 주문</p>
            <i>발송마감일이 이미 지났어요.</i>
            <h1><span class="color-blue"><?= number_format((int)$order_data['send_delay_count']) ?></span>건</h1>
        </div>
    </div>

    <form name="searchFrm" id="searchFrm" autocomplete="off" method="get">
        <div class="sch_wrap">
            <p class="tit">검색조건
                <a class="btn btn-gray btn-md male-auto"
                   href="<?= current_url() ?>">조건초기화</a>
                <button class="btn btn-blue btn-md" onclick="">검색하기</button>
            </p>
            <div class="box flexwrap">
                <div>
                    <p>검색하기</p>
                    <div class="flex gap5">
                        <div class="input_select">
                            <select class="border_gray" name="sfl">
                                <?
                                $sflList = ['OrderNo' => '주문번호', 'SiteGoodsNo' => '상품번호', 'BuyerName' => '구매자명', 'BuyerID' => '구매자ID', 'GoodsName' => '상품명'];
                                foreach ($sflList as $key => $val) {
                                    ?>
                                    <option value="<?= $key ?>" <?= $_GET['sfl'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                        <div class="input_search">
                            <input type="text" name="stx" placeholder="검색어를 입력하세요" class="border_gray"
                                   type="search"
                                   value="<?= $_GET['stx'] ?>">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
                <div>
                    <p>주문일</p>
                    <div class="input_date">
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
                                       value="<?= $key ?>" <?= $checked ?>
                                       onclick="changeDateRange(this.value)"/>
                                <label for="<?= $id ?>"><?= $val ?></label>
                            <? } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="result_wrap">
            <div class="top_text">
                <div class="wrap w100 flex">
                    <h1>기간 : <?= $_GET['sdt'] ?> - <?= $_GET['edt'] ?> | <span
                                class="color-blue">검색결과 <?= number_format((int)$order_data['items_per_page']) ?>개</span>
                        / 총 <?= number_format((int)$order_data['total_count']) ?>개</h1>
                    <div class="input_select2 male-auto">
                        <select name="items_per_page" onchange="$('#searchFrm').submit()">
                            <option value="10" <?= $_GET['items_per_page'] == '' || $_GET['items_per_page'] == '10' ? 'selected' : '' ?>>
                                10개씩 보기
                            </option>
                            <option value="20" <?= $_GET['items_per_page'] == '20' ? 'selected' : '' ?>>20개씩 보기
                            </option>
                            <option value="30" <?= $_GET['items_per_page'] == '30' ? 'selected' : '' ?>>30개씩 보기
                            </option>
                        </select>
                    </div>
                </div>

    </form>
    <div class="wrap w100 flex">
        <button type="button" class="btn btn-blue btn-mini" onclick="orderSend_modal()">발송처리</button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderDelayModal">
            발송예정일입력/지연예고
        </button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderSendListModal">
            발송정보일괄등록
        </button>
        <form name="OrderPrintForm" action="<?= base_url() ?>order/OrderPrint" target="_blank" id="OrderPrintForm"
              autocomplete="off" method="post">
            <input type="hidden" name="OrderPrint_idx" id="OrderPrint_idx">
            <button type="button" class="btn btn-white btn-mini" onclick="orderPrint_modal()">발주서출력</button>
        </form>
        <form name="OrderLabelPrintForm" action="<?= base_url() ?>order/OrderLabelPrint" target="_blank"
              id="OrderLabelPrintForm" autocomplete="off" method="get"
              onsubmit="window.open('<?= base_url() ?>order/OrderLabelPrint','OrderLabelPrintForm','width=1000,height=800');">
            <input type="hidden" name="OrderLabelPrint_idx" id="OrderLabelPrint_idx">
            <button type="button" class="btn btn-white btn-mini" onclick="orderLabelPrint_modal()">라벨인쇄</button>
        </form>
        <button type="button" class="btn btn-white btn-mini" onclick="orderAmount_modal()">정산예정금액보기</button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderCancelModal">판매취소
        </button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderUserModal">주문자
            정보수정
        </button>
    </div>
    <br>
    <div class="wrap w100 flex ">
        <div class="input_select">

            <select class="border_gray" id="companyNo">
                <option value="">선택</option>
                <? foreach ($delivery_company_list as $index => $data): ?>
                    <option value="<?= $data['code'] ?>"
                            data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <button type="button" class="btn btn-white btn-md" onclick="setCompanyNo()">저장</button>
    </div>
    </div>
    <div class="table flex nowrap">
        <table class="sticky">
            <colgroup>
                <col width="50px">
                <col width="150px">
                <col width="150px">
                <col width="150px">
                <col width="150px">
            </colgroup>
            <thead>
            <tr>
                <th><input id="all_check" name="all_check" type="checkbox"/></th>
                <th>아이디</th>
                <th>주문일자(결제확인전)</th>
                <th>주문번호</th>
                <th>수령인명</th>
                <th>구매자명</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order_data['list'] as $row): ?>
                <tr>
                    <td><input type="checkbox" name="idx[]" value="<?= $row['idx'] ?>"></td>
                    <td alt="구분">
                        <?php if ($row['SiteType'] == 1): ?>
                            <div class="box__flag box__flag--auction"><span class="for-a11y">옥션</span></div>
                        <?php else: ?>
                            <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div>
                        <?php endif ?>
                        <?php
                        $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
                        ?>
                        <?= $OrderStatus[$row['OrderStatus']] ?>


                        <!-- 주문옵션, 추가구성에 맞춰서 br해주는곳 -->
                        <?php
                        $data_br = 0;
                        $data_br2 = 0;
                        $data_br_result = 0;
                        ?>
                        <?php if ($row['ItemOptionSelectList']): ?>
                            <?php
                            $data_length = json_decode($row['ItemOptionSelectList']);
                            $data_br = count($data_length);
                            ?>
                        <?php endif ?>

                        <?php if ($row['ItemOptionAdditionList']): ?>
                            <?php
                            $data_length2 = json_decode($row['ItemOptionAdditionList']);
                            $data_br2 = count($data_length2);
                            ?>
                        <?php endif ?>
                        <?php
                        $data_br > $data_br2 ? $data_br_result = $data_br : $data_br_result = $data_br2;
                        for ($i = 0; $i < $data_br_result; $i++) {
                            // echo '</br>';
                        }
                        ?>
                    </td>
                    <td alt="주문날짜"><?= $row['OrderDate'] ?></td>
                    <td alt="주문번호"><a onclick="orderNo_modal('<?= $row['idx'] ?>')"
                                      id="OrderNo<?= $row['idx'] ?>"><?= $row['OrderNo'] ?></a></td>
                    <td alt="수령인명"><?= $row['BuyerName'] ?></td>
                    <td alt="구매자명"><?= $row['ReceiverName'] ?></td>
                </tr>
            <?php endforeach ?>

            <!--
            <tr>
                <td><input type="checkbox"></td>
                <td>아이디 <div class="box__flag box__flag--gmarket"><span class="for-a11y">G마켓</span></div></td>
                <td>주문일자</td>
                <td><a data-toggle="modal" data-target="#orderSheetModal">주문번호</a></td>
                <td>수령인명</td>
                <td>구매자명</td>
            </tr>
            -->
            </tbody>
        </table>
        <table>
            <thead>
            <tr>
                <th>발송마감일</th>
                <th>발송예정일</th>
                <th>택배사명</th>
                <th>송장번호</th>
                <th>상품번호</th>
                <th>상품명</th>
                <th>수량</th>
                <th>주문옵션</th>
                <th>추가구성</th>
                <th>사은품</th>
                <th>사은품 관리코드</th>
                <th>덤</th>
                <th>덤 관리코드</th>
                <th>판매단가</th>
                <td>판매금액</td>
                <th>판매자 관리코드</th>
                <th>수령인 휴대폰</th>
                <th>수령인 전화번호</th>
                <th>우편번호</th>
                <th>주소</th>
                <th>배송시 요구사항</th>
                <th>배송비</th>
                <th>배송비 금액</th>
                <th>배송번호</th>
                <td>배송지연사유</td>
                <th>SKU번호 및 수량</th>
                <th>구매자ID</th>
                <th>구매자 휴대폰</th>
                <th>구매자 전화번호</th>
                <th>장바구니번호(결제번호)</th>
                <th>결제완료일</th>
                <th>주문확인일자</th>
                <th>발송예정일</th>
                <th>정산예정금액</th>
                <th>서비스이용료</th>
                <th>판매자쿠폰할인</th>
                <th>구매쿠폰적용금액</th>
                <th>(옥션)우수회원할인</th>
                <th>복수구매할인</th>
                <th>스마일캐시적립</th>
                <th>판매자북캐시적립</th>
                <th>제휴사명</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($this->data['order_data']['list'] as $row) { ?>
                <tr>

                    <td alt="발송마감일"><?= $row['TransDueDate'] ?></td>
                    <td alt="발송예정일"><?= $row['ShippingExpectedDate'] != '0000-00-00' ? $row['ShippingExpectedDate'] : '' ?></td>
                    <td alt="택배사명">
                        <select class="border_gray" id="companyNo<?= $row['idx'] ?>"
                                style="width: 200px;">
                            <option value="">선택</option>
                            <? foreach ($delivery_company_list as $index => $data): ?>
                                <option value="<?= $data['code'] ?>"
                                        data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                            <? endforeach; ?>
                        </select>
                    </td>
                    <td alt="송장번호"><input type="text" class="border_gray w150px" id="NoSongjang<?= $row['idx'] ?>"
                                          value="<?= $row['NoSongjang'] ?>"></td>

                    <td alt="상품번호"><a
                                onclick="openSiteGoodsNo('<?= $row['SiteType'] ?>','<?= $row['SiteGoodsNo'] ?>');"><?= $row['SiteGoodsNo'] ?></a>
                    </td>
                    <td alt="상품명"><?= $row['GoodsName'] ?></td>
                    <td alt="수량"><?= $row['ContrAmount'] ?></td>
                    <td alt="주문옵션">
                        <?php if ($row['ItemOptionSelectList']): ?>
                            <?php $data2 = json_decode($row['ItemOptionSelectList']); ?>
                            <?php $data2_count = 1; ?>
                            <?php foreach ($data2 as $ItemOptionSelectList): ?>
                                <?= $ItemOptionSelectList->ItemOptionValue ? ' ' . $data2_count . '.' . $ItemOptionSelectList->ItemOptionValue . '/' : '' ?>
                                <?= $ItemOptionSelectList->ItemOptionOrderCnt ? $ItemOptionSelectList->ItemOptionOrderCnt . '/' : '' ?>
                                <?= $ItemOptionSelectList->ItemOptionCode ? $ItemOptionSelectList->ItemOptionCode : '' ?>
                                <?= '</br>' ?>
                                <?php $data2_count++ ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </td>
                    <td alt="추가구성">
                        <?php if ($row['ItemOptionAdditionList']): ?>
                            <?php $data3 = json_decode($row['ItemOptionAdditionList']); ?>
                            <?php $data3_count = 1; ?>
                            <?php foreach ($data3 as $ItemOptionAdditionList): ?>
                                <?= $ItemOptionAdditionList->ItemOptionValue ? ' ' . $data3_count . '.' . $ItemOptionAdditionList->ItemOptionValue . '/' : '' ?>
                                <?= $ItemOptionAdditionList->ItemOptionOrderCnt ? $ItemOptionAdditionList->ItemOptionOrderCnt . '/' : '' ?>
                                <?= $ItemOptionAdditionList->ItemOptionCode ? $ItemOptionAdditionList->ItemOptionCode : '' ?>
                                <?= '</br>' ?>
                                <?php $data3_count++ ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </td>
                    <td alt="사은품"><?= $row['FreeGift'] ?></td>
                    <td alt="사은품 관리코드"><?= $row['FreeGiftCode'] ?></td>
                    <td alt="덤"><?= $row['Bonus'] ?></td>
                    <td alt="덤 관리코드"><?= $row['BonusCode'] ?></td>
                    <td alt="판매단가"><?= number_format((int)$row['SalePrice']) ?></td>
                    <td alt="판매금액"><?= number_format((int)$row['OrderAmount']) ?></td>
                    <td alt="판매자 관리코드"><?= $row['OutGoodsNo'] ?></td>
                    <td alt="수령인 휴대폰"><?= $row['HpNo'] ?></td>
                    <td alt="수령인 전화번호"><?= $row['TelNo'] ?></td>
                    <td alt="우편번호"><?= $row['ZipCode'] ?></td>
                    <td alt="주소"><?= $row['DelFullAddress'] ?></td>
                    <td alt="배송시 요구사항"><?= $row['DelMemo'] ?></td>
                    <td alt="배송비"><?= number_format((int)$row['ShippingFee']) ?></td>
                    <td alt="배송비 금액"><?= number_format((int)$row['BackwoodsAddDeliveryFee']) ?>
                        /<?= number_format((int)$row['JejuAddDeliveryFee']) ?></td>
                    <td alt="배송번호"><input type="text" class="border_gray w150px"></td>
                    <td alt="배송지연사유"><input type="text" class="border_gray w150px"></td>
                    <td alt="SKU번호 및 수량"><?= $row['SKUNo'] ?></td>
                    <td alt="구매자ID"><?= $row['BuyerID'] ?></td>
                    <td alt="구매자 휴대폰"><?= $row['BuyerMobileTel'] ?></td>
                    <td alt="구매자 전화번호"><?= $row['BuyerTel'] ?></td>
                    <td alt="장바구니번호(결제번호)"><?= $row['PayNo'] ?></td>
                    <td alt="결제완료일"><?= $row['PayDate'] ?></td>
                    <td alt="주문확인일자"><?= $row['OrderConfirmDate'] ?></td>
                    <td alt="발송예정일"><?= $row['TransDueDate'] ?></td>
                    <td alt="정산예정금액"><?= number_format((int)$row['SettlementPrice']) ?></td>
                    <td alt="서비스이용료"><?= number_format((int)$row['ServiceFee']) ?></td>
                    <td alt="판매자쿠폰할인"><?= number_format((int)$row['SellerDiscountPrice']) ?></td>
                    <td alt="구매쿠폰적용금액"><?= number_format((int)$row['DirectDiscountPrice']) ?></td>
                    <td alt="(옥션)우수회원할인"><?= number_format((int)$row['GreatMembDcAmnt']) ?></td>
                    <td alt="복수구매할인"><?= number_format((int)$row['MultiBuyDcAmnt']) ?></td>
                    <td alt="스마일캐시적립"><?= number_format((int)$row['SellerCashBackMoney']) ?></td>
                    <td alt="판매자북캐시적립">-</td>
                    <td alt="제휴사명">-</td>
                </tr>
            <?php } ?>

            <!--
            <tr>
                <td>발송정책</td>

                <td>주문상태</td>
                <td>발송마감일</td>
                <td>
                    <div class="input_select w150px">

                        <select class="border_gray">
                            <option value="nomal">택배사</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="text" class="border_gray w150px">
                </td>
                <td><a href="">상품번호</a></td>
                <td>상품명</td>
                <td>수량</td>
                <td>주문옵션</td>
                <td>추가구성</td>
                <td>사은품</td>
                <td>사은품 관리코드</td>
                <td>덤</td>
                <td>덤 관리코드</td>
                <td>판매단가</td>
                <td>판매금액</td>
                <td>판매자 관리코드</td>
                <td>판매자 상세관리코드</td>
                <td>수령인 휴대폰</td>
                <td>수령인 전화번호</td>
                <td>우편번호</td>
                <td>주소</td>
                <td>배송시 요구사항</td>
                <td>배송비</td>
                <td>배송비 금액</td>
                <td>배송번호</td>
                <td>배송지연사유</td>
                <td>수령인 통관번호</td>
                <td>SKU번호 및 수량</td>
                <td>구매자ID</td>
                <td>구매자 휴대폰</td>
                <td>구매자 전화번호</td>
                <td>판매방식</td>
                <td>주문종류</td>
                <td>장바구니번호(결제번호)</td>
                <td>결제완료일</td>
                <td>주문확인일자</td>
                <td>발송예정일</td>
                <td>정산예정금액</td>
                <td>서비스이용료</td>
                <td>판매자쿠폰할인</td>
                <td>구매쿠폰적용금액</td>
                <td>(옥션)우수회원할인</td>
                <td>복수구매할인</td>
                <td>스마일캐시적립</td>
                <td>판매자북캐시적립</td>
                <td>제휴사명</td>
            </tr>
            -->
            </tbody>
        </table>
    </div>

<?php echo createPagination($page, $order_data['total_count'], $order_data['items_per_page'], getCurrentUrl()); ?>

    </div>


<?php echo view('order/order_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>