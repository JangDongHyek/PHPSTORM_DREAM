<?php
echo view('common/header_adm');
echo view('common/adm_head');
$header_name = "주문 관리";
?>


<?php echo view('order/order_head', $this->data); ?>

    <div class="state_wrap">
        <div class="w25 flex gap5">
            <p>전체누적</p>
            <h1><span class="color-blue"><?= number_format((int)$order_data['total_count']) ?></span>건</h1>
        </div>
        <div class="grid grid3 w100">
            <p>배송중 <span class="color-blue"><?= number_format((int)$order_data['deliver_count']) ?></span>건</p>
            <p>배송완료 <span class="color-blue"><?= number_format((int)$order_data['deliver_complete_count']) ?></span>건</p>
            <p>미수령신고 <span class="color-blue"><?= number_format((int)$order_data['deliver_error_count']) ?></span>건</p>
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
                            <input type="text" name="stx" placeholder="검색어를 입력하세요" class="border_gray" type="search"
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
                                       value="<?= $key ?>" <?= $checked ?> onclick="changeDateRange(this.value)"/>
                                <label for="<?= $id ?>"><?= $val ?></label>
                            <? } ?>

                        </div>
                    </div>
                </div>
                <div>
                    <p>배송구분</p>
                    <div class="input_select">
                        <select class="border_gray" name="OrderStatus" onchange="this.form.submit()">
                            <option value="0" <?= $_GET['OrderStatus'] == 0 || $_GET['OrderStatus'] == '' ? 'selected' : '' ?>>전체</option>
                            <option value="3" <?= $_GET['OrderStatus'] == 3 ? 'selected' : '' ?>>배송중</option>
                            <option value="4" <?= $_GET['OrderStatus'] == 4 ? 'selected' : '' ?>>배송완료</option>
                            <option value="6" <?= $_GET['OrderStatus'] == 6 ? 'selected' : '' ?>>미수령신고</option>
                        </select>
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
        <button type="button" class="btn btn-white btn-mini" onclick="orderDeliEdit_modal()">
            배송정보수정
        </button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderDeliCancelModal">
            미수령신고 철회요청
        </button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderDeliReModal">판매자
            직접반품신청
        </button>
        <button type="button" class="btn btn-white btn-mini" data-toggle="modal" data-target="#orderDeliChangeModal">판매자
            직접교환신청
        </button>
        <button type="button" class="btn btn-white btn-mini" onclick="orderAmount_modal()">정산예정금액보기</button>
        </button>
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
                <th>구분</th>
                <th>발송일자</th>
                <th>배송상태</th>
                <th>주문번호</th>
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
                            echo '</br>';
                        }
                        ?>
                    </td>
                    <td alt="발송일자"><?= $row['TransDate'] ?></td>
                    <td alt="배송상태">
                        <?php
                        $OrderStatus = [1 => '신규주문', 2 => '발송대기중', 3 => '배송중', 4 => '배송완료', 5 => '구매결정완료'];
                        ?>
                        <?= $OrderStatus[$row['OrderStatus']] ?>
                    </td>
                    <td alt="주문번호"><a onclick="orderNo_modal('<?= $row['idx'] ?>')"><?= $row['OrderNo'] ?></a></td>
                    <td alt="구매자명"><?= $row['BuyerName'] ?></td>

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <table>
            <thead>
            <tr>

                <th>구매자ID</th>
                <th>수령인명</th>
                <th>택배사명(발송방법)</th>
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
                <th>구매자 휴대폰</th>
                <th>구매자 전화번호</th>
                <th>수령인 휴대폰</th>
                <th>수령인 전화번호</th>
                <th>우편번호</th>
                <th>주소</th>
                <th>배송시 요구사항</th>
                <th>배송비</th>
                <th>배송비 금액</th>
                <td>배송지연사유</td>
                <th>SKU번호 및 수량</th>
                <th>상품미수령 신고일자</th>
                <th>상품미수령 신고사유</th>
                <th>상품미수령 상세사유</th>
                <th>상품미수령 철회일자</th>
                <th>상품미수령 이의제기일자</th>
                <th>재배송 택배사명</th>
                <th>재배송 운송장번호</th>
                <th>재배송 우편번호</th>
                <th>재배송 주소</th>
                <th>장바구니번호(결제번호)</th>
                <th>결제완료일</th>
                <th>주문일자(결제확인전)</th>
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
                    <td alt="구매자ID"><?= $row['BuyerID'] ?></td>
                    <td alt="수령인명"><?= $row['ReceiverName'] ?></td>
                    <td alt="택배사명(발송방법)"><?= $row['TakbaeName'] ?>
                        <?php
                        $TransType = ['A' => '당일발송', 'B' => '순차발송', 'C' => '해외발송', 'D' => '요청일발송', 'E' => '주문제작발송', 'F' => '발송일미정'];
                        ?>
                        (<?= array_key_exists($row['TransType'], $TransType) ? $TransType[$row['TransType']] : '스마일배송' ?>
                        )
                    </td>
                    <td alt="송장번호"><?= $row['NoSongjang'] ?></td>
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
                    <td alt="구매자 휴대폰"><?= $row['BuyerMobileTel'] ?></td>
                    <td alt="구매자 전화번호"><?= $row['BuyerTel'] ?></td>
                    <td alt="수령인 휴대폰"><?= $row['HpNo'] ?></td>
                    <td alt="수령인 전화번호"><?= $row['TelNo'] ?></td>
                    <td alt="우편번호"><?= $row['ZipCode'] ?></td>
                    <td alt="주소"><?= $row['DelFullAddress'] ?></td>

                    <td alt="배송시 요구사항"><?= $row['DelMemo'] ?></td>
                    <td alt="배송비"><?= number_format((int)$row['ShippingFee']) ?></td>
                    <td alt="배송비 금액"><?= number_format((int)$row['BackwoodsAddDeliveryFee']) ?>
                        /<?= number_format((int)$row['JejuAddDeliveryFee']) ?></td>

                    <td alt="배송지연사유"><?= $row['ReasonDetail'] ?></td>
                    <td alt="SKU번호 및 수량"><?= $row['SKUNo'] ?></td>
                    <td alt="상품미수령 신고일자"><?= $row[''] ?></td>
                    <td alt="상품미수령 신고사유"><?= $row[''] ?></td>
                    <td alt="상품미수령 상세사유"><?= $row[''] ?></td>
                    <td alt="상품미수령 철회일자"><?= $row[''] ?></td>
                    <td alt="상품미수령 이의제기일자"><?= $row[''] ?></td>
                    <td alt="재배송 택배사명"><?= $row[''] ?></td>
                    <td alt="재배송 운송장번호"><?= $row[''] ?></td>
                    <td alt="재배송 우편번호"><?= $row[''] ?></td>
                    <td alt="재배송 주소"><?= $row[''] ?></td>
                    <td alt="장바구니번호(결제번호)"><?= $row['PayNo'] ?></td>
                    <td alt="결제완료일"><?= $row['PayDate'] ?></td>
                    <td alt="주문일자(결제확인전)"><?= $row['OrderDate'] ?></td>
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
            </tbody>
        </table>
    </div>
    </div>
<?php echo createPagination($page, $order_data['total_count'], $order_data['items_per_page'], getCurrentUrl()); ?>


<?php echo view('order/order_modal', $this->data); ?>
<?php
echo view('common/adm_tail');
echo view('common/footer');
?>