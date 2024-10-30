<? /*-- Modal 샘플
<div class="modal fade" id="" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Label">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> */ ?>
<?php
//택배사 배송코드가져오기
$delivery_company_list = get_delivery_company_list();
$delivery_company_list_AC = get_delivery_company_list_AC();
?>
<script>

    var delivery_company_list = '<option value="">선택</option>';
    <? foreach ($delivery_company_list as $index => $data): ?>
    delivery_company_list += '<option value="<?= $data['code'] ?>" data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>';
    <? endforeach; ?>

    var delivery_company_list_AC = '<option value="">선택</option>';
    <? foreach ($delivery_company_list_AC as $index => $data): ?>
    delivery_company_list_AC += '<option value="<?= $data['code'] ?>" data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>';
    <? endforeach; ?>

    let selectedValues = [];

    // all_check 체크박스를 클릭하면 나머지 체크박스를 모두 선택 또는 해제
    $("#all_check").click(function () {
        if (this.checked) {
            $("input[name='idx[]']").each(function () {
                this.checked = true;
                selectedValues.push($(this).val());
            });
        } else {
            $("input[name='idx[]']").each(function () {
                this.checked = false;
            });
            selectedValues = [];
        }
    });

    // 개별 체크박스를 클릭하면 해당 체크박스의 value를 배열에 추가 또는 제거
    $("input[name='idx[]']").click(function () {
        if (this.checked) {
            selectedValues.push($(this).val());
        } else {
            const index = selectedValues.indexOf($(this).val());
            if (index > -1) {
                selectedValues.splice(index, 1);
            }
        }
    });


    const orderCheck_modal = async () => {

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var response = await fetchData(`/order/OrderCheck`, {idx});
            //console.log(response);

            if (!response['api_data']['orderNo']) {
                code_html += '';
            } else {
                code_html += '[' + response['api_data']['orderNo'] + ']';
            }

            if (response['body']['Message'] == 'Success') {
                code_html += '발송처리 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "판매처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        Swal.fire({
            title: "판매처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 주문확인 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //정산예정금액보기
    const orderAmount_modal = async () => {


        const defModal = $('#orderAmountModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        //for문
        var code_html = '';

        var OrderAmount_total = 0;
        var ServiceFee_total = 0;
        var KCPServiceFee_total = 0;
        var KCPServiceFeeEvent_total = 0;
        var CostPrice_total = 0;
        var SellerDiscountPrice_total = 0;
        var SettlementPrice_total = 0;

        //배송비
        var dl_DelFeeAmt_total = 0;
        var dl_DelFeeCommission_total = 0;
        // 부가세
        var surTax_total = 0;
        var b2p_surTax_total = 0;
        var refund_total = 0;

        // kcp 수수료 이벤트 진행중 true
        var card_event = true;
        let kcp_commission = 2.3 / 100;
        let kcp_cashback = 2.3 / 100;
        let b2p_commission = 5 / 100;

        for (var i = 0; i < listData.length; i++) {
            var calc = null;
            var idx = listData[i]['idx'];
            var response = await fetchData(`/order/GetOrder`, {idx});

            var OrderNo = response['result']['OrderNo'];
            var response2 = await fetchData(`/order/GetCalc/${OrderNo}`);
            var calc_data = null;
            if (response2.count) calc_data = response2['data'][0];

            let style = calc_data ? "" : "class='color-red';";

            // 판매금액
            var OrderAmount = calc_data ? calc_data['SellOrderPrice'] + calc_data['OptionPrice'] : response['result']['OrderAmount']

            // 카테고리 이용료
            let ServiceFee = 0;
            if (response['result']['SiteType'] == '1') ServiceFee = response['result']['BasicServiceFee'];
            else ServiceFee = response['result']['ServiceFee'];
            if (calc_data) {
                ServiceFee = calc_data['TotCommission'];
                ServiceFee = ServiceFee - calc_data['DeductTaxPrice'];  // 토탈 카테고리 이용료에 기타이용료 를 뺸후 판매자 할인공제에 더한다
            }

            // b2p 수수료
            var b2p_fee = OrderAmount * b2p_commission;            // b2p
            b2p_fee = Math.ceil(b2p_fee);


            // 카드 수수료
            var BuyerPayAmt = response['result']['AcntMoney']; //구매자 결제금액
            var KCPServiceFee = BuyerPayAmt * kcp_commission // 카드 수수료
            var KCPPayBack = BuyerPayAmt * kcp_cashback // 카드 페이백
            KCPServiceFee = Math.floor(KCPServiceFee); //소수점 버림
            KCPPayBack = Math.floor(KCPPayBack); //소수점 버림
            var total_fee = KCPServiceFee;
            if (card_event) total_fee = KCPServiceFee - KCPPayBack;// 자체 수수료 (판매금액의 5퍼센트)


            // 판매자 할인/공제금 정산데이터 없을때
            let totalDiscount = 0;
            let SellerDiscountPrice = response['result']['SellerDiscountPrice'] ? response['result']['SellerDiscountPrice'] : 0;
            let SellerCashbackMoney = response['result']['SellerCashbackMoney'] ? response['result']['SellerCashbackMoney'] : 0;
            let DirectDiscountPrice = response['result']['DirectDiscountPrice'] ? response['result']['DirectDiscountPrice'] : 0;
            let SellerFundingDiscountPrice = response['result']['SellerFundingDiscountPrice'] ? response['result']['SellerFundingDiscountPrice'] : 0;

            console.log(`ServiceFee : ${ServiceFee}`);
            console.log(`SellerCashbackMoney : ${SellerCashbackMoney}`);

            totalDiscount += parseInt(SellerDiscountPrice);
            totalDiscount += parseInt(SellerCashbackMoney);
            if (response['result']['SiteType'] == '1') totalDiscount += parseInt(DirectDiscountPrice); // 옥션
            else totalDiscount += parseInt(SellerFundingDiscountPrice); // 지마켓

            let OutsidePrice = Math.abs(response['result']['OutsidePrice']) // 판매자할인 / 공제금 토탈값

            //if (totalDiscount != OutsidePrice) {
            //    let rest = OutsidePrice - totalDiscount
            //    totalDiscount += rest;
            //}

            // 판매자할인 / 공제금 정산데이터있을때
            if(calc_data) {
                totalDiscount = 0;
                SellerDiscountPrice = response['result']['SiteType'] == '1' ? calc_data['SellerDiscountTotalPrice'] : response['result']['SellerDiscountPrice'];
                console.log(`SellerDiscountPrice : ${SellerDiscountPrice}`);
                totalDiscount += parseInt(SellerDiscountPrice)

                if(response['result']['SiteType'] == '2') {
                    totalDiscount += parseInt(SellerCashbackMoney);
                    totalDiscount += parseInt(SellerFundingDiscountPrice);
                }

                totalDiscount += parseInt(calc_data['DeductTaxPrice']) * -1;
            }



            //배송비 수수료 정산데이터 없을때
            let dl_DelFeeAmt = parseInt(response['result']['ShippingFee']);
            let dl_DelFeeCommission = dl_DelFeeAmt * 0.033;
            let b2p_shipping_fee = dl_DelFeeAmt * 0.03;

            //배송비 수수료 정산데이터 있을떄
            // 장바구니로 한번에 계산했을시 정산은 두개의 데이터에 배송비가 오고 주문쪽은 한개쪽에 제대로 붙기때문에 주문데이터로만 이용
            //if(calc_data) {
            //    dl_DelFeeAmt = calc_data['dl_DelFeeAmt'];
            //    dl_DelFeeCommission = calc_data['dl_DelFeeCommission'];
            //    b2p_shipping_fee = dl_DelFeeAmt * 0.03;
            //}

            // b2p배송비수수료 옥션이면 반올림 g마켓이면 올림
            if (response['result']['SiteType'] == '1') {
                b2p_shipping_fee = Math.round(b2p_shipping_fee);
                dl_DelFeeCommission = Math.round(dl_DelFeeCommission);
            }else {
                b2p_shipping_fee = Math.ceil(b2p_shipping_fee);
                dl_DelFeeCommission = Math.ceil(dl_DelFeeCommission);
            }


            // 부가세
            let surTax = OrderAmount * 0.1;
            let b2p_surTax = surTax * 0.05; // 부가세 / (b2p수수료)
            b2p_surTax = Math.ceil(b2p_surTax) // b2p 부가세 올림처리
            let refund = surTax - b2p_surTax;


            var SettlementPrice = calc_data ? calc_data['SettlementPrice'] : response['result']['SettlementPrice']

            //부가적인 설정
            totalDiscount = totalDiscount * -1;     // 음수화
            if (ServiceFee > 0) ServiceFee = ServiceFee * -1;    // 정산데이터가없을경우 양수로 오기때문에 양수일때 음수화
            if (KCPServiceFee > 0) KCPServiceFee = KCPServiceFee * -1;    // 정산데이터가없을경우 양수로 오기때문에 양수일때 음수화

            ServiceFee = ServiceFee + parseInt(SellerCashbackMoney); // 음수일테니 플러스해서 빼기 처리
            ServiceFee = ServiceFee - b2p_fee;
            let CostPrice = OrderAmount - (ServiceFee * -1);
            SettlementPrice = SettlementPrice - b2p_fee - total_fee - dl_DelFeeCommission - b2p_shipping_fee - b2p_surTax;


            code_html += `<tr ${style}>`;
            code_html += '<td>' + response['result']['OrderNo'] + '</td>'; // 주문번호
            code_html += '<td>' + response['result']['GoodsName'] + '</td>'; // 상품명
            code_html += '<td>' + AddComma(OrderAmount) + '</td>';  // 판매금액
            code_html += '<td>' + AddComma(ServiceFee) + '</td>';   // 기본 서비스 이용료
            code_html += '<td>' + AddComma(CostPrice) + '</td>';    // 공급원가
            //code_html += '<td>' + '-' + '</td>';
            code_html += '<td>' + AddComma(totalDiscount) + '</td>';    // 판매자할인/공제금
            code_html += '<td>' + AddComma(BuyerPayAmt) + '</td>';      // 고객 결제 금액
            code_html += '<td>' + AddComma(KCPServiceFee) + '</td>';    // kcp 수수료
            code_html += '<td>' + AddComma(KCPPayBack) + '</td>'; // kcp 캐시백
            code_html += '<td>' + AddComma(total_fee) + '</td>';    // kcp 합계

            code_html += '<td>' + AddComma(dl_DelFeeAmt) + '</td>';     // 배송비
            code_html += '<td>' + AddComma(dl_DelFeeCommission + b2p_shipping_fee) + '</td>';   // 배송비 수수료

            code_html += '<td>' + AddComma(surTax) + '</td>';     // 부가세
            code_html += '<td>' + AddComma(b2p_surTax) + '</td>';     // b2p부가세
            code_html += '<td>' + AddComma(refund) + '</td>';     // 환급금

            code_html += '<td>' + AddComma(SettlementPrice) + '</td>';  //정산금액
            //code_html += response['body']['Message'] + '<br>';
            code_html += '</tr>';

            OrderAmount_total += (OrderAmount) * 1;
            ServiceFee_total += (ServiceFee) * 1;
            KCPServiceFee_total += (KCPServiceFee) * 1;
            KCPServiceFeeEvent_total += (KCPPayBack) * 1;
            CostPrice_total += (CostPrice) * 1;
            SellerDiscountPrice_total += (totalDiscount) * 1;
            SettlementPrice_total += (SettlementPrice) * 1;

            dl_DelFeeAmt_total += dl_DelFeeAmt;
            dl_DelFeeCommission_total += (dl_DelFeeCommission + b2p_shipping_fee)

            surTax_total += (surTax);
            b2p_surTax_total += (b2p_surTax);
            refund_total += (refund);

        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "정산예정금액보기",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        $('#orderAmountModal_list').html(code_html);
        $('#modal_OrderAmount_total').html(AddComma(OrderAmount_total));
        $('#modal_ServiceFee_total').html(AddComma(ServiceFee_total));
        $('#modal_KCPServiceFee_total').html(AddComma(KCPServiceFee_total));
        $('#modal_CostPrice_total').html(AddComma(CostPrice_total));
        $('#modal_SellerDiscountPrice_total').html(AddComma(SellerDiscountPrice_total));
        $('#modal_SettlementPrice_total').html(AddComma(SettlementPrice_total));

        $('#modal_dl_DelFeeAmt_total').html(AddComma(dl_DelFeeAmt_total));
        $('#modal_dl_DelFeeCommission_total').html(AddComma(dl_DelFeeCommission_total));

        $('#modal_surTax_total').html(AddComma(surTax_total));
        $('#modal_b2p_surTax_total').html(AddComma(b2p_surTax_total));
        $('#modal_refund_total').html(AddComma(refund_total));

        if (card_event) {
            $('#modal_KCPServiceFeeEvent_total').html(AddComma(KCPServiceFeeEvent_total));
        } else {
            $('#kcp_event_th').remove();
            $('#kcp_event_td').remove();
            $('#modal_KCPServiceFeeEvent_p').remove();
        }
        defModal.modal();

    }


    const orderDelay_modal = async (check) => {

        const defModal = $('#orderDelayModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "발송예정일",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        if (check) {
            defModal.modal();
            return false;
        }

        if (!$('#orderDelay_ShippingExpectedDate').val()) {
            Swal.fire({
                title: "발송예정일",
                html: `
            <div class="text_form">
                <p>발송예정일을 입력해주세요.</p>
            </div>
              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        //for문
        var code_html = '';

        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];

            var data_arr =
                {
                    idx: idx,
                    ShippingExpectedDate: $('#orderDelay_ShippingExpectedDate').val(),
                    ReasonType: $('#orderDelay_ReasonType').val(),
                    ReasonDetail: $('#orderDelay_ReasonDetail').val()
                };


            //console.log(data_arr);
            var response = await fetchData(`/order/OrderShippingExpectedDate`, {data_arr});
            //console.log(response);
            code_html += '[' + response['api_data']['orderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '발송예정일 등록 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }


        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "발송예정일",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        Swal.fire({
            title: "발송예정일",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 발송예정일이 등록 되었습니다.</p>
            </div>
            <div class="text_form">
                   <p>` + code_html + `</p>
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    const setCompanyNo = async () => {
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            $('#companyNo' + idx).val($('#companyNo').val());
            $('#companyNo_AC' + idx).val($('#companyNo_AC').val());
        }
    }

    //발송처리
    const orderSend_modal = async () => {
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        //송장번호 입력안된거 막아주기
        for (var j = 0; j < listData.length; j++) {
            var idx = listData[j]['idx'];
            if (!$('#NoSongjang' + idx).val() || (!$('#companyNo' + idx).val() && !$('#companyNo_AC' + idx).val())) {
                Swal.fire({
                    title: "발송처리",
                    html: `
            <div class="text_form">
                <p>운송장번호가 없습니다.</p>
            </div>


              `,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText: `확인`,
                    //        cancelButtonText: ``,

                    closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
                });
                return false;
            }
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];

            if ($('#companyNo' + idx).val()) {
                var TakbaeName = $('#companyNo' + idx).find("option:selected").data("name");
                var companyNo = $('#companyNo' + idx).val();
            } else {
                var TakbaeName = $('#companyNo_AC' + idx).find("option:selected").data("name");
                var companyNo = $('#companyNo_AC' + idx).val();
            }
            //var TakbaeName = $('#companyNo' + idx).data('name');
            var data_arr =
                {
                    idx: idx,
                    companyNo: companyNo,
                    NoSongjang: $('#NoSongjang' + idx).val(),
                    TakbaeName: TakbaeName
                };


            //console.log(data_arr);

            if ($('#NoSongjang' + idx).val()) {

                // 신규주문일수도 있으니 주문확인 한번하고 발송처리해줌
                var response2 = await fetchData(`/order/OrderCheck`, {idx});
                console.log(response2);

                var response = await fetchData(`/order/OrderSend`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['orderNo'] + ']';

                if (response['body']['Message'] == 'Success') {
                    code_html += '발송처리 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }

            } else {
                code_html += '[' + $('#OrderNo' + idx).html() + ']';
                code_html += '운송장번호가 없습니다.<br>';
            }

        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "발송처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        Swal.fire({
            title: "발송처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 발송처리 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });


    }

    //미수령신고 철회요청
    const orderClaimRelease_modal = async () => {

        const defModal = $('#orderDeliCancelModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        if (listData.length <= 0) {
            Swal.fire({
                title: "미수령신고 철회요청",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        var idx = listData[0]['idx'];
        if ($('#SiteType' + idx).val() == 1) {
            $('#OrderClaimRelease_DeliveryCompCode').html(delivery_company_list_AC);
        } else {
            $('#OrderClaimRelease_DeliveryCompCode').html(delivery_company_list);
        }

        if ($("input[name='OrderClaimRelease_ClaimCancelType']:checked").val() == 1) {
            if (!$('#OrderClaimRelease_DeliveryCompCode').val()) {
                Swal.fire({
                    text: "택배사를 선택해주세요."
                });
                return false;
            }
            if (!$('#OrderClaimRelease_InvoiceNo').val()) {
                Swal.fire({
                    text: "운송장번호를 입력해주세요."
                });
                return false;
            }
        }

        if ($("input[name='OrderClaimRelease_ClaimCancelType']:checked").val() == 2) {
            if (!$('#OrderClaimRelease_CancelComment').val()) {
                Swal.fire({
                    text: "철회요청 메세지를 입력해주세요."
                });
                return false;
            }
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];


            var data_arr =
                {
                    idx: idx,
                    DeliveryCompCode: $('#OrderClaimRelease_DeliveryCompCode').val(),
                    InvoiceNo: $('#OrderClaimRelease_InvoiceNo').val(),
                    ClaimCancelType: $("input[name='OrderClaimRelease_ClaimCancelType']:checked").val(),
                    CancelComment: $("#OrderClaimRelease_CancelComment").val()
                };
            var response = await fetchData(`/order/OrderClaimRelease`, {data_arr});
            //console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '미수령신고 철회요청 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '미수령신고 철회요청 성공' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        Swal.fire({
            title: "미수령신고 철회요청",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 미수령신고 철회요청 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    const orderCancelCheckConfirm_modal = async () => {
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        Swal.fire({
            title: "취소처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건을 취소처리 하시겠습니까?</p>
            </div>
              `,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `확인`,
            cancelButtonText: `취소`,
            closeOnClickOutside: true,
            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {

            if (result.isConfirmed) {
                orderCancelCheck_modal();
            } else {
                return false;
            }

        });

    }
    const orderCancelCheck_modal = async () => {

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var response = await fetchData(`/order/OrderCancelCheck`, {idx});
            //console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '취소처리 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "취소처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        Swal.fire({
            title: "취소처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 취소처리 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    const orderCancelSoldOut_modal = async (check) => {

        const defModal = $('#orderCancelModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "판매취소",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        if (check) {
            $('#cancelSoldOutCnt').html(listData.length);
            defModal.modal();
            return false;
        }


        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var data_arr =
                {
                    idx: idx,
                    cancelSoldOutReason: $('#cancelSoldOutReason').val()
                };

            console.log(data_arr);
            var response = await fetchData(`/order/OrderCancelSoldOut`, {data_arr});
            //console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '판매취소 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        Swal.fire({
            title: "판매취소",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 판매취소 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //반품처리
    const orderReturnCheck_modal = async (check) => {

        const defModal = $('#orderReturnModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "반품처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "반품처리",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_return_list',

                };
            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});

            console.log(response);
            if (response.result) {
                var data = response.result;
                $('#returnModal_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#returnModal_OrderNo').html(data.OrderNo);
                $('#returnModal_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',\'' + data.SiteGoodsNo + '\')');
                $('#returnModal_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#returnModal_SalePrice').html(data.SalePrice);
                $('#returnModal_ContrAmount').html(data.ContrAmount);

                var option = JSON.parse(data.ItemOptionSelectList);
                var option_html = '';
                //console.log(option);
                option_html += '<ul>';
                for (var i = 0; i < option.length; i++) {
                    option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                    option_html += '</br>';
                }
                option_html += '</ul>';
                $('#returnModal_ItemOptionSelectList').html(option_html);

                var Addition = JSON.parse(data.ItemOptionAdditionList);
                var Addition_html = '';
                Addition_html += '<ul>';
                for (var j = 0; j < Addition.length; j++) {
                    Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                    Addition_html += '</br>';
                }
                Addition_html += '</ul>';
                $('#returnModal_ItemOptionAdditionList').html(Addition_html);
                $('#returnModal_BuyerName').html(data.BuyerName);
                $('#returnModal_ReceiverName').html(data.ReceiverName);
                $('#returnModal_BuyerMobileTel').html(data.BuyerMobileTel);
                $('#returnModal_HpNo').html(data.HpNo);
                $('#returnModal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
                $('#returnModal_TakbaeName').html(data.TakbaeName);
                $('#returnModal_NoSongjang').html(data.NoSongjang);

                var return_ReasonCode = {
                    0: '[기타] : 선택없음',
                    1: '[구매자귀책] : 단순변심',
                    2: '[구매자귀책] : 사이즈/색상 등 옵션 변경',
                    3: '[판매자귀책] : 오배송',
                    4: '[판매자귀책] : 상품불량',
                    5: '[판매자귀책] : 판매자요청',
                };
                $('#returnModal_return_ReasonDetail').html(return_ReasonCode[data.return_ReasonCode] + '<br>' + data.return_ReasonDetail);

                $('#returnModal_return_ReturnShippingFee').html(AddComma(data.return_ReturnShippingFee));
                console.log(data);
                var return_ReturnShippingFeeWay = {
                    0: '없음',
                    1: '지금결제함(카드결제, 핸드폰결제등)',
                    2: '환불금 차감 대기',
                    3: '판매자 직접 결제',
                    4: '상품에 동봉함',
                    5: '스마일캐시 결제',
                    6: '기타'
                };
                $('#returnModal_return_ReturnShippingFeeWay').html(return_ReturnShippingFeeWay[data.return_ReturnShippingFeeWay]);


                $('#returnModal_return_AddReturnShippingFee').html(AddComma(data.return_AddReturnShippingFee));
                $('#returnModal_return_AddReturnShippingFeeWay').html(return_ReturnShippingFeeWay[data.return_AddReturnShippingFeeWay]);


                /*
                $('#modal_FreeGift').html(data.FreeGift);
                data.OrderAmount = AddComma(data.OrderAmount);
                $('#modal_OrderAmount').html(data.OrderAmount);
                data.ShippingFee = AddComma(data.ShippingFee);
                $('#modal_ShippingFee').html(data.ShippingFee);
                //$('#modal_TransType').html(data.TransType);
                $('#modal_BuyerId').html(data.BuyerId);


                $('#modal_BuyerTel').html(data.BuyerTel);

                $('#modal_TelNo').html(data.TelNo);

                $('#modal_DelMemo').html(data.DelMemo);
                 */
                defModal.modal();
            }
            return false;
        }

        // 241004 반품상품받으셨읍니까 에서  환불보류설정 예가 아니면 뜨게 wc
        // 241008 둘다 아니오이면 오류뜨게 wc
        if ($('#returnModal_return_radoi1_2').is(':checked') && $('#returnModal_return_radoi2_2').is(':checked')) {
            Swal.fire({
                title: "반품처리",
                html: `
            <div class="text_form">
                <p>반품 처리 중 오류가 발생했습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnModal_return_radoi1_2').focus();
            });
            return false;
        }

        if ($('#returnModal_ResendInfo_HoldReason').val() == 2 && $('#returnModal_ReturnShippingFee').val() < 1000) {
            Swal.fire({
                title: "반품처리",
                html: `
            <div class="text_form">
                <p>추가반품배송비를 1000원 이상 입력해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnModal_ReturnShippingFee').focus();
            });
            return false;
        }

        //for문
        var code_html = '';
        var code_title = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            if ($('#returnModal_return_radoi2_1').is(":checked")) {
                var data_arr =
                    {
                        idx: idx,
                        HoldReason: $('#returnModal_ResendInfo_HoldReason').val(),
                        HoldReasonDetail: $('#returnModal_ResendInfo_HoldReasonDetail').val(),
                        ReturnShippingFee: $('#returnModal_ReturnShippingFee').val(),
                    };

                var response = await fetchData(`/order/OrderReturnHold`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['OrderNo'] + ']';
                code_title = '환불보류';
                if (response['body']['Message'] == 'Success') {
                    code_html += '환불보류 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }

            } else if ($('#returnModal_return_radoi1_1').is(":checked")) {

                var response = await fetchData(`/order/OrderReturnCheck`, {idx});
                //console.log(response);
                code_html += '[' + response['api_data']['OrderNo'] + ']';
                code_title = '반품처리';
                if (response['body']['Message'] == 'Success') {
                    code_html += '반품처리 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }
            }
        }


        Swal.fire({
            title: "반품처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 ` + code_title + ` 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //반품처리 (환불보류된건) 환불승인
    const orderReturnCheck2_modal = async (check) => {

        const defModal = $('#orderReturnModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "반품처리 환불승인",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "반품처리 환불승인",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (!$('#returnModal_return_radoi1_1').is(':checked')) {
            Swal.fire({
                title: "반품처리 환불승인",
                html: `
            <div class="text_form">
                <p>환불 승인을 동의하셔야 진행가능합니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnModal_return_radoi1_1').focus();
            });
            return false;
        }

        //for문
        var code_html = '';
        var code_title = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var response = await fetchData(`/order/OrderReturnCheck`, {idx});
            //console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';
            code_title = '반품처리 환불승인';
            if (response['body']['Message'] == 'Success') {
                code_html += '반품,환불처리 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        Swal.fire({
            title: "반품처리 환불승인",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 ` + code_title + ` 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //판매자 직접반품신청
    const orderReturnSelf_modal = async (check, returnSelfModal_OrderReturnCheck = false) => {

        const defModal = $('#orderDeliReModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        if (listData.length <= 0) {
            Swal.fire({
                title: "판매자 직접반품신청",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_exchange_list',

                };
            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});
            //console.log(response);
            if (response.result) {
                var data = response.result;
                $('#returnSelfModal_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#returnSelfModal_OrderNo').html(data.OrderNo);
                $('#returnSelfModal_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',\'' + data.SiteGoodsNo + '\')');
                $('#returnSelfModal_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#returnSelfModal_SalePrice').html(data.SalePrice);
                $('#returnSelfModal_ContrAmount').html(data.ContrAmount);

                var option = JSON.parse(data.ItemOptionSelectList);
                var option_html = '';
                //console.log(option);
                option_html += '<ul>';
                for (var i = 0; i < option.length; i++) {
                    option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                    option_html += '</br>';
                }
                option_html += '</ul>';
                $('#returnSelfModal_ItemOptionSelectList').html(option_html);

                var Addition = JSON.parse(data.ItemOptionAdditionList);
                var Addition_html = '';
                Addition_html += '<ul>';
                for (var j = 0; j < Addition.length; j++) {
                    Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                    Addition_html += '</br>';
                }
                Addition_html += '</ul>';
                $('#returnSelfModal_ItemOptionAdditionList').html(Addition_html);
                $('#returnSelfModal_BuyerName').html(data.BuyerName);
                $('#returnSelfModal_ReceiverName').html(data.ReceiverName);
                $('#returnSelfModal_BuyerMobileTel').html(data.BuyerMobileTel);
                $('#returnSelfModal_HpNo').html(data.HpNo);
                $('#returnSelfModal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
                $('#returnSelfModal_TakbaeName').html(data.TakbaeName);
                $('#returnSelfModal_NoSongjang').html(data.NoSongjang);


                /*
                $('#modal_FreeGift').html(data.FreeGift);
                data.OrderAmount = AddComma(data.OrderAmount);
                $('#modal_OrderAmount').html(data.OrderAmount);
                data.ShippingFee = AddComma(data.ShippingFee);
                $('#modal_ShippingFee').html(data.ShippingFee);
                //$('#modal_TransType').html(data.TransType);
                $('#modal_BuyerId').html(data.BuyerId);


                $('#modal_BuyerTel').html(data.BuyerTel);

                $('#modal_TelNo').html(data.TelNo);

                $('#modal_DelMemo').html(data.DelMemo);
                 */
                defModal.modal();
            }
            return false;
        }

        if (!$('#returnSelfModal_GoodsStatus').val()) {
            Swal.fire({
                title: "판매자 직접반품신청",
                html: `
            <div class="text_form">
                <p>상품상태를 선택해주세요.</p>
            </div>

              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnSelfModal_GoodsStatus').focus();
            });
            return false;
        }

        if (!$('#returnSelfModal_DeliveryCompName').val()) {
            Swal.fire({
                title: "판매자 직접반품신청",
                html: `
            <div class="text_form">
                <p>택배사명을 선택해주세요.</p>
            </div>

              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnSelfModal_DeliveryCompName').focus();
            });
            return false;
        }


        if (!$('#returnSelfModal_InvoiceNo').val() && !$('#returnSelfModal_deliNone').is(":checked")) {
            Swal.fire({
                title: "판매자 직접반품신청",
                html: `
            <div class="text_form">
                <p>운송장 번호를 입력해주세요.</p>
            </div>

              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#returnSelfModal_InvoiceNo').focus();
            });
            return false;
        }


        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var data_arr =
                {
                    idx: idx,
                    reason: $('#returnSelfModal_ReasonCode').val(),
                    itemStatus: $('#returnSelfModal_GoodsStatus').val(),
                    alreadySent: $("input[name='returnSelfModal_PickupInfoStatus']:checked").val(),
                    returnSelfModal_OrderReturnCheck: returnSelfModal_OrderReturnCheck
                };

            data_arr['pickupCompCode'] = $('#returnSelfModal_DeliveryCompName').val();
            data_arr['invoiceNo'] = $('#returnSelfModal_InvoiceNo').val();

            var response = await fetchData(`/order/OrderReturnSelf`, {data_arr});
            //console.log(response);
            code_html += '[' + response['api_data']['orderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '판매자 직접반품신청 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        Swal.fire({
            title: "판매자 직접반품신청",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 판매자 직접반품신청 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //옥션 거래완료 후 환불처리
    const orderAfterRemittanceBySeller_modal = async () => {

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var response = await fetchData(`/order/OrderAfterRemittanceBySeller`, {idx});
            //console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '거래완료 후 환불 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        if (listData.length <= 0) {
            Swal.fire({
                title: "거래완료 후 환불",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }
        Swal.fire({
            title: "거래완료 후 환불",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 취소처리 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //반품건 교환전환 API
    const orderReturnExchange_modal = async (check) => {

        const defModal = $('#orderReExchangeModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        if (listData.length <= 0) {
            Swal.fire({
                title: "반품건 교환전환",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "반품건 교환전환",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_return_list',

                };

            if ($('#SiteType' + idx).val() == 1) {
                $('#ReturnExchange_ResendInfo_DeliveryCompName').html(delivery_company_list_AC);
            } else {
                $('#ReturnExchange_ResendInfo_DeliveryCompName').html(delivery_company_list);
            }

            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});
            console.log(response);
            if (response.result) {
                var data = response.result;
                $('#ReturnExchange_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#ReturnExchange_OrderNo').html(data.OrderNo);
                $('#ReturnExchange_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',' + data.SiteGoodsNo + ')');
                $('#ReturnExchange_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#ReturnExchange_SalePrice').html(data.SalePrice);
                $('#ReturnExchange_ContrAmount').html(data.ContrAmount);
                $('#ReturnExchange_BuyerName').html(data.BuyerName);
                $('#ReturnExchange_return_ReturnShippingFee').html(AddComma(data.return_ReturnShippingFee));

                var return_ReasonCode = {
                    0: '[기타] : 선택없음',
                    1: '[구매자귀책] : 단순변심',
                    2: '[구매자귀책] : 사이즈/색상 등 옵션 변경',
                    3: '[판매자귀책] : 오배송',
                    4: '[판매자귀책] : 상품불량',
                    5: '[판매자귀책] : 판매자요청',
                };
                $('#ReturnExchange_return_ReasonDetail').html(return_ReasonCode[data.return_ReasonCode] + '<br>' + data.return_ReasonDetail);

                var return_AddReturnShippingFeeWay = {
                    0: '없음',
                    1: '지금결제함(카드결제, 핸드폰결제등)',
                    2: '환불금 차감 대기',
                    3: '판매자 직접 결제',
                    4: '상품에 동봉함',
                    5: '스마일캐시 결제',
                    6: '기타'
                };
                $('#ReturnExchange_return_AddReturnShippingFeeWay').html(return_AddReturnShippingFeeWay[data.return_ReturnShippingFeeWay]);
                defModal.modal();
            }
            return false;
        }


        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var data_arr =
                {
                    idx: idx,
                    DeliveryCompCode: $('#ReturnExchange_ResendInfo_DeliveryCompName').val(),
                    InvoiceNo: $('#ReturnExchange_ResendInfo_InvoiceNo').val(),
                };
            var response = await fetchData(`/order/OrderReturnExchange`, {data_arr});
            console.log(response);
            code_html += '[' + response['api_data']['OrderNo'] + ']';

            if (response['body']['Message'] == 'Success') {
                code_html += '반품건 교환전환 성공<br>';
            } else if (response['body']['Message'] == null) {
                code_html += '결과값이 없습니다.' + '<br>';
            } else {
                code_html += response['body']['Message'] + '<br>';
            }
        }


        Swal.fire({
            title: "반품건 교환전환",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 반품건 교환전환 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //교환건 반품전환 API
    const orderExchangeReturn_modal = async (check) => {

        const defModal = $('#orderExReturnModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });


        if (listData.length <= 0) {
            Swal.fire({
                title: "교환건 반품전환",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "교환건 반품전환",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            if ($('#SiteType' + idx).val() == 1) {
                $('#ExchangeReturn_ResendInfo_DeliveryCompName').html(delivery_company_list_AC);
            } else {
                $('#ExchangeReturn_ResendInfo_DeliveryCompName').html(delivery_company_list);
            }
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_exchange_list',

                };

            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});
            //console.log(response);
            if (response.result) {
                var data = response.result;
                $('#ExchangeReturn_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#ExchangeReturn_OrderNo').html(data.OrderNo);
                $('#ExchangeReturn_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',' + data.SiteGoodsNo + ')');
                $('#ExchangeReturn_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#ExchangeReturn_SalePrice').html(data.SalePrice);
                $('#ExchangeReturn_ContrAmount').html(data.ContrAmount);
                $('#ExchangeReturn_BuyerName').html(data.BuyerName);

                var exchange_ReasonCode = {
                    0: '[기타] : 선택없음',
                    1: '[구매자귀책] : 단순변심',
                    2: '[구매자귀책] : 사이즈/색상 등 옵션 변경',
                    3: '[판매자귀책] : 오배송',
                    4: '[판매자귀책] : 상품불량',
                    5: '[판매자귀책] : 판매자요청',
                };

                if (!data.exchange_ResonDetail) {
                    data.exchange_ResonDetail = '';
                }
                $('#ExchangeReturn_exchange_ReasonDetail').html(exchange_ReasonCode[data.exchange_ReasonCode] + '<br>' + data.exchange_ResonDetail);

                var exchange_ExchangeShippingFeeWay = {
                    0: '없음',
                    1: '지금결제함(카드결제, 핸드폰결제등)',
                    2: '환불금 차감 대기',
                    3: '판매자 직접 결제',
                    4: '상품에 동봉함',
                    5: '스마일캐시 결제',
                    6: '기타'
                };
                $('#ExchangeReturn_exchange_ExchangeShippingFeeWay').html(exchange_ExchangeShippingFeeWay[data.exchange_ExchangeShippingFeeWay]);
                $('#ExchangeReturn_exchange_ExchangeShippingFee').html(AddComma(data.exchange_ExchangeShippingFee));
                defModal.modal();
            }
            return false;
        }

        if (!$('#ExchangeReturn_return_radio1_Y').is(':checked')) {
            Swal.fire({
                title: "교환건 반품전환",
                html: `
            <div class="text_form">
                <p>교환상품을 받으셔야 진행가능합니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#ExchangeReturn_return_radoi1_1').focus();
            });
            return false;
        }

        if (!$('#ExchangeReturn_return_radio2_Y').is(':checked')) {
            Swal.fire({
                title: "교환건 반품전환",
                html: `
            <div class="text_form">
                <p>교환상품 반품처리를 선택해야 진행가능합니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#ExchangeReturn_return_radoi2_1').focus();
            });
            return false;
        }


        //for문
        var code_html = '';
        var code_title = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];

            if ($('#ExchangeReturn_return_radio_refund_Y').is(":checked")) {
                var data_arr =
                    {
                        idx: idx,
                        DeliveryCompCode: $('#ExchangeReturn_ResendInfo_DeliveryCompName').val(),
                        InvoiceNo: $('#ExchangeReturn_ResendInfo_InvoiceNo').val(),
                    };
                var response = await fetchData(`/order/OrderExchangeReturn`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['OrderNo'] + ']';

                code_title = '교환건 반품전환';
                if (response['body']['Message'] == 'Success') {
                    code_html += '교환건 반품전환 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }
            }

            if ($('#ExchangeReturn_return_radio_refund_N').is(":checked")) {
                var data_arr =
                    {
                        idx: idx,
                        HoldReason: $('#ExchangeReturn_ResendInfo_HoldReason').val(),
                        HoldReasonDetail: $('#ExchangeReturn_ResendInfo_HoldReasonDetail').val(),
                        ReturnShippingFee: $('#ExchangeReturn_ReturnShippingFee').val(),
                    };

                var response = await fetchData(`/order/OrderReturnHold`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['OrderNo'] + ']';
                code_title += '환불보류<br>';
                if (response['body']['Message'] == 'Success') {
                    code_html += '환불보류 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }

            }
        }


        Swal.fire({
            title: "교환건 반품전환",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 교환건 반품전환 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    // 주문번호 상세 모달
    const orderNo_modal = async (idx) => {

        const defModal = $('#orderSheetModal');

        if (!idx) {
            Swal.fire({
                text: "주문 코드가 없습니다.",
            });
            return false;
        }

        var response = await fetchData(`/order/GetOrder`, {idx});
        console.log(response);
        var response2 = await fetchData(`/order/OrderDeliProgress`, {idx});
        //console.log(response2);
        if (response.result) {
            var data = response.result;
            $('#modal_SiteGoodsNo').html(data.SiteGoodsNo);
            $('#modal_OrderNo').html(data.OrderNo);

            if (data.order_b2pAutoCar) {
                $('#modal_GoodsName').html('(' + data.carNo + ',' + data.repairName + ',' + data.carName + ')' + '<br>' + data.GoodsName);
            } else {
                $('#modal_GoodsName').html(data.GoodsName);
            }
            $('#modal_ContrAmount').html(data.ContrAmount);

            var option = JSON.parse(data.ItemOptionSelectList);
            var option_html = '';
            //console.log(option);
            for (var i = 0; i < option.length; i++) {
                option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                option_html += '</br>';
            }
            $('#modal_ItemOptionSelectList').html(option_html);

            var Addition = JSON.parse(data.ItemOptionAdditionList);
            var Addition_html = '';
            for (var j = 0; j < Addition.length; j++) {
                Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                Addition_html += '</br>';
            }
            $('#modal_ItemOptionAdditionList').html(Addition_html);
            $('#modal_FreeGift').html(data.FreeGift);
            data.OrderAmount = AddComma(data.OrderAmount);
            $('#modal_OrderAmount').html(data.OrderAmount);
            data.ShippingFee = AddComma(data.ShippingFee);
            $('#modal_ShippingFee').html(data.ShippingFee);
            //$('#modal_TransType').html(data.TransType);
            $('#modal_BuyerId').html(data.BuyerId);
            $('#modal_BuyerName').html(data.BuyerName);
            $('#modal_BuyerMobileTel').html(data.BuyerMobileTel);
            $('#modal_BuyerTel').html(data.BuyerTel);
            $('#modal_ReceiverName').html(data.ReceiverName);
            $('#modal_HpNo').html(data.HpNo);
            $('#modal_TelNo').html(data.TelNo);

            if (data.order_b2pAutoDelFullAddress) {
                $('#modal_DelFullAddress').html('(' + data.order_b2pZip + ')' + data.order_b2pAutoDelFullAddress);
            } else {
                $('#modal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
            }

            $('#modal_DelMemo').html(data.DelMemo);
            defModal.modal();
        }

        if (response2.body.Data) {

            var progress_data = response2.body.Data;
            var progress_html = '';
            for (var k = 0; k < progress_data.length; k++) {

                progress_html += '<tr name="SiteGoodsNo">';
                progress_html += '<td>';
                progress_html += progress_data[k]['EscrowType'];
                progress_html += '</td>';
                progress_html += '<td>';
                var date = formatDateTime(new Date(progress_data[k]['EscrowDt']));
                progress_html += date;
                progress_html += '</td>';

                progress_html += '<td>';
                if (progress_data[k]['TrackingUrl'] != null) {
                    //progress_html += progress_data[k]['TrackingUrl'];
                    progress_html += '<button type="button" class="btn btn-white btn-mini" onclick="window.open(\'' + progress_data[k]['TrackingUrl'] + '\')">상품위치확인</button>';
                }
                progress_html += '</td>';

                progress_html += '</tr>';
            }

            //console.log(progress_data);
            $('#deli_progress').html(progress_html);
        }
    }

    // 주문번호 상세 모달
    const orderNo2_modal = async (OrderNo) => {

        const defModal = $('#orderSheetModal');

        if (!OrderNo) {
            Swal.fire({
                text: "주문 코드가 없습니다.",
            });
            return false;
        }

        var response = await fetchData(`/order/GetOrder2`, {OrderNo});
        //console.log(response);
        var idx = response.idx;
        var response2 = await fetchData(`/order/OrderDeliProgress`, {idx});
        //console.log(response2);
        if (response.result) {
            var data = response.result;
            $('#modal_SiteGoodsNo').html(data.SiteGoodsNo);
            $('#modal_OrderNo').html(data.OrderNo);

            if (data.order_b2pAutoCar) {
                $('#modal_GoodsName').html('(' + data.carNo + ',' + data.repairName + ',' + data.carName + ')' + '<br>' + data.GoodsName);
            } else {
                $('#modal_GoodsName').html(data.GoodsName);
            }
            $('#modal_ContrAmount').html(data.ContrAmount);

            var option = JSON.parse(data.ItemOptionSelectList);
            var option_html = '';
            //console.log(option);
            for (var i = 0; i < option.length; i++) {
                option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                option_html += '</br>';
            }
            $('#modal_ItemOptionSelectList').html(option_html);

            var Addition = JSON.parse(data.ItemOptionAdditionList);
            var Addition_html = '';
            for (var j = 0; j < Addition.length; j++) {
                Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                Addition_html += '</br>';
            }
            $('#modal_ItemOptionAdditionList').html(Addition_html);
            $('#modal_FreeGift').html(data.FreeGift);
            data.OrderAmount = AddComma(data.OrderAmount);
            $('#modal_OrderAmount').html(data.OrderAmount);
            data.ShippingFee = AddComma(data.ShippingFee);
            $('#modal_ShippingFee').html(data.ShippingFee);
            //$('#modal_TransType').html(data.TransType);
            $('#modal_BuyerId').html(data.BuyerId);
            $('#modal_BuyerName').html(data.BuyerName);
            $('#modal_BuyerMobileTel').html(data.BuyerMobileTel);
            $('#modal_BuyerTel').html(data.BuyerTel);
            $('#modal_ReceiverName').html(data.ReceiverName);
            $('#modal_HpNo').html(data.HpNo);
            $('#modal_TelNo').html(data.TelNo);

            if (data.order_b2pAutoDelFullAddress) {
                $('#modal_DelFullAddress').html('(' + data.order_b2pZip + ')' + data.order_b2pAutoDelFullAddress);
            } else {
                $('#modal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
            }

            $('#modal_DelMemo').html(data.DelMemo);
            defModal.modal();
        }

        if (response2.body.Data) {

            var progress_data = response2.body.Data;
            var progress_html = '';
            for (var k = 0; k < progress_data.length; k++) {

                progress_html += '<tr name="SiteGoodsNo">';
                progress_html += '<td>';
                progress_html += progress_data[k]['EscrowType'];
                progress_html += '</td>';
                progress_html += '<td>';
                var date = formatDateTime(new Date(progress_data[k]['EscrowDt']));
                progress_html += date;
                progress_html += '</td>';

                progress_html += '<td>';
                if (progress_data[k]['TrackingUrl'] != null) {
                    //progress_html += progress_data[k]['TrackingUrl'];
                    progress_html += '<button type="button" class="btn btn-white btn-mini" onclick="window.open(\'' + progress_data[k]['TrackingUrl'] + '\')">상품위치확인</button>';
                }
                progress_html += '</td>';

                progress_html += '</tr>';
            }

            //console.log(progress_data);
            $('#deli_progress').html(progress_html);
        }
    }

    const orderPrint_modal = async () => {

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        var listData_result = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push(idx);
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "발주서 출력",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        listData_result = listData.join(',');
        $('#OrderPrint_idx').val(listData_result);
        $('#OrderPrintForm').submit();
    }
    const orderLabelPrint_modal = async () => {

        const defModal = $('#orderLabelModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        var listData_result = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push(idx);
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "라벨인쇄",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }


        listData_result = listData.join(',');
        //$('#OrderLabelPrint_idx').val(listData_result);

        var popup = window.open('<?=base_url()?>/order/OrderLabelPrint?OrderLabelPrint_idx=' + listData_result, '라벨인쇄', 'width=960px,height=850px,scrollbars=yes');
        //$('#OrderLabelPrintForm').submit();
    }

    //발송정보일괄등록 업로드
    function uploadSendExcel() {

        if ($('#selOrderNoCell').val() == $('#selDeliveryCompCell').val()) {
            alert('주문번호행과 택배사행을 다르게 설정해주세요.');
            return false;
        }

        if ($('#selDeliveryCompCell').val() == $('#selInvoiceCell').val()) {
            alert('택배사행과 운송장/등기번호행을 다르게 설정해주세요.');
            return false;
        }

        if ($('#selOrderNoCell').val() == $('#selInvoiceCell').val()) {
            alert('주문번호행과 운송장/등기번호행을 다르게 설정해주세요.');
            return false;
        }

        if (!$('#OrderSendExcelFile').val()) {
            alert('파일을 선택해주세요.');
            $('#FileuploadName').focus();
            return false;
        }

        window.open("", "OrderSendExcelUploadForm", "status=no,scrollbars=no,resizable=no,top=100,left=100,width=790,height=550");
        //만약 submit() 통해 띄운 팝업 페이지에 팝업 옵션을 주고 싶다면 이런식으로 옵션을 지정한다.
        //팝업에 옵션이 필요 없다면 이부분은 생략 가능하다.

        var url = "<?= base_url('order/OrderSendExcelUpload') ?>";
        OrderSendExcelUploadForm.action = url;

        //팝업으로 띄울 페이지 주소를 액션으로 지정
        OrderSendExcelUploadForm.target = "OrderSendExcelUploadForm";
        //서브밋을 날릴 타겟 설정, 만약 window.open을 통해 팝업 옵션을 주는 경우 window.open에서 사용할 타겟 이름과 이부분의
        //타겟 이름이 동일해야한다.
        //타겟이름은 다른 곳에 지정된 타겟 이름과 겹치지 않게 자유롭게 지정한다. 예) NoticePop
        OrderSendExcelUploadForm.submit();
    }

    const orderDeliEdit_modal = async () => {

        const defModal = $('#orderDeliEditModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "배송정보수정",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "배송정보수정",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        var idx = listData[0]['idx'];
        var response_order = await fetchData(`/order/GetOrder`, {idx});

        if ($('#SiteType' + idx).val() == 1) {
            $('#orderDeliEdit_companyNo').html(delivery_company_list_AC);
        } else {
            $('#orderDeliEdit_companyNo').html(delivery_company_list);
        }

        if (response_order.result) {
            var data = response_order.result;
            //console.log(data);

            $('#orderDeliEdit_TakbaeName').html(data.TakbaeName);
            $('#orderDeliEdit_NoSongjang').html(data.NoSongjang);
            defModal.modal();
        }

        if (!$('#orderDeliEdit_InvoiceNo').val()) {
            return false;
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var TakbaeName = $('#orderDeliEdit_companyNo').find("option:selected").data("name");
            //var TakbaeName = $('#companyNo' + idx).data('name');
            var data_arr =
                {
                    idx: idx,
                    companyNo: $('#orderDeliEdit_companyNo').val(),
                    NoSongjang: $('#orderDeliEdit_InvoiceNo').val(),
                    TakbaeName: TakbaeName
                };

            console.log(data_arr);

            if ($('#orderDeliEdit_InvoiceNo').val()) {
                var response = await fetchData(`/order/OrderDeliEdit`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['orderNo'] + ']';

                if (response['body']['Message'] == 'Success') {
                    code_html += '배송정보 수정 성공';
                } else if (response['body']['Message'] == null) {
                    code_html += '데이터가 없습니다.';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }
            } else {
                code_html += '[' + $('#OrderNo' + idx).html() + ']';
                code_html += '송장번호가 없습니다.<br>';
            }

        }


        Swal.fire({
            title: "배송정보수정",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 배송정보수정 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    const orderDeliProgress_modal = async () => {

        const defModal = $('#orderDeliEditModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "배송정보수정",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        var idx = listData[0]['idx'];
        var response_order = await fetchData(`/order/GetOrder`, {idx});

        if (response_order.result) {
            var data = response_order.result;
            //console.log(data);
            $('#orderDeliEdit_TakbaeName').html(data.TakbaeName);
            $('#orderDeliEdit_NoSongjang').html(data.NoSongjang);
            defModal.modal();
        }

        if (!$('#orderDeliEdit_InvoiceNo').val()) {
            return false;
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var TakbaeName = $('#orderDeliEdit_companyNo').find("option:selected").data("name");
            //var TakbaeName = $('#companyNo' + idx).data('name');
            var data_arr =
                {
                    idx: idx,
                    companyNo: $('#orderDeliEdit_companyNo').val(),
                    NoSongjang: $('#orderDeliEdit_InvoiceNo').val(),
                    TakbaeName: TakbaeName
                };

            console.log(data_arr);

            if ($('#orderDeliEdit_InvoiceNo').val()) {
                var response = await fetchData(`/order/OrderDeliEdit`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['orderNo'] + ']';
                code_html += response['body']['Message'] + '<br>';
            } else {
                code_html += '[' + $('#OrderNo' + idx).html() + ']';
                code_html += '송장번호가 없습니다.<br>';
            }

        }


        Swal.fire({
            title: "배송정보수정",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 배송정보수정 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //반품관리 수거택배 정보수정
    const orderReturnDeliEdit_modal = async (check) => {

        const defModal = $('#orderReturnDeliEditModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "반품 수거택배 정보수정",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "반품 수거택배 정보수정",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        var idx = listData[0]['idx'];
        if ($('#SiteType' + idx).val() == 1) {
            $('#orderReturnDeliEdit_companyNo').html(delivery_company_list_AC);
        } else {
            $('#orderReturnDeliEdit_companyNo').html(delivery_company_list);
        }

        var response_order = await fetchData(`/order/GetOrder`, {idx});

        if (response_order.result) {
            var data = response_order.result;
            //console.log(data);
            $('#orderReturnDeliEdit_TakbaeName').html(data.TakbaeName);
            $('#orderReturnDeliEdit_NoSongjang').html(data.NoSongjang);
        }

        if (check) {
            defModal.modal();
            return false;
        }

        if (!$('#orderReturnDeliEdit_InvoiceNo').val()) {
            return false;
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            //var TakbaeName = $('#orderReturnDeliEdit_companyNo').find("option:selected").data("name");
            var TakbaeName = $('#orderReturnDeliEdit_takbaeName_input').val();
            var companyNo = $('#orderReturnDeliEdit_companyNo_input').val();
            //var TakbaeName = $('#companyNo' + idx).data('name');
            var data_arr =
                {
                    idx: idx,
                    companyNo: companyNo,
                    NoSongjang: $('#orderReturnDeliEdit_InvoiceNo').val(),
                    TakbaeName: TakbaeName
                };

            console.log(data_arr);

            if ($('#orderReturnDeliEdit_InvoiceNo').val()) {
                var response = await fetchData(`/order/OrderReturnDeliEdit`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['orderNo'] + ']';

                if (response['body']['Message'] == 'Success') {
                    code_html += '반품 수거택배 수정 성공';
                } else if (response['body']['Message'] == null) {
                    code_html += '데이터가 없습니다.';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }
            } else {
                code_html += '[' + $('#OrderNo' + idx).html() + ']';
                code_html += '송장번호가 없습니다.<br>';
            }

        }


        Swal.fire({
            title: "반품 수거택배 정보수정",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 반품 수거택배 수정 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //교환재발송 배송완료
    const orderExchangeReDeliComplete_modal = async (idx) => {

        if (!idx) {
            Swal.fire({
                title: "교환재발송 배송완료",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }


        var code_html = '';
        var response = await fetchData(`/order/OrderExchangeReDeliComplete`, {idx});
        console.log(response);
        code_html += '[' + response['api_data']['orderNo'] + ']';

        if (response['body']['Message'] == 'Success') {
            code_html += '교환재발송 배송완료';
        } else if (response['body']['Message'] == null) {
            code_html += '데이터가 없습니다.';
        } else {
            code_html += response['body']['Message'] + '<br>';
        }

        Swal.fire({
            title: "교환재발송 배송완료",
            html: `
            <div class="text_form">
                <p>교환재발송 배송완료 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });


    }

    const orderExchangeHoldRelease_modal = async (idx) => {

        if (!idx) {
            Swal.fire({
                title: "교환보류해제",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }


        var code_html = '';
        var response = await fetchData(`/order/OrderExchangeHoldRelease`, {idx});
        console.log(response);
        code_html += '[' + response['api_data']['orderNo'] + ']';

        if (response['body']['Message'] == 'Success') {
            code_html += '교환보류해제 성공';
        } else if (response['body']['Message'] == null) {
            code_html += '데이터가 없습니다.';
        } else {
            code_html += response['body']['Message'] + '<br>';
        }

        Swal.fire({
            title: "교환보류해제",
            html: `
            <div class="text_form">
                <p>교환보류해제 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });


    }

    const orderExchangeDeliEdit_modal = async (check) => {

        const defModal = $('#orderExchangeDeliEditModal');

        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "교환 수거택배 정보수정",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "교환 수거택배 정보수정",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        var idx = listData[0]['idx'];
        if ($('#SiteType' + idx).val() == 1) {
            $('#orderExchangeDeliEdit_companyNo2').html(delivery_company_list_AC);
        } else {
            $('#orderExchangeDeliEdit_companyNo2').html(delivery_company_list);
        }
        var response_order = await fetchData(`/order/GetOrder`, {idx});

        if (response_order.result) {
            var data = response_order.result;
            //console.log(data);
            $('#orderExchangeDeliEdit_TakbaeName').html(data.TakbaeName);
            $('#orderExchangeDeliEdit_NoSongjang').html(data.NoSongjang);

            if (check) {
                defModal.modal();
                return false;
            }
        }


        if (!$('#orderExchangeDeliEdit_InvoiceNo').val()) {
            Swal.fire({
                title: "교환 수거택배 정보수정",
                html: `
            <div class="text_form">
                <p>운송장번호가 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        }

        //for문
        var code_html = '';
        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];

            //var TakbaeName = $('#orderExchangeDeliEdit_companyNo2').find("option:selected").data("name");
            var TakbaeName = $('#orderExchangeDeliEdit_takbaeName_input').val();
            var companyNo = $('#orderExchangeDeliEdit_companyNo_input').val();
            var data_arr =
                {
                    idx: idx,
                    companyNo: companyNo,
                    NoSongjang: $('#orderExchangeDeliEdit_InvoiceNo').val(),
                    TakbaeName: TakbaeName
                };

            console.log(data_arr);

            if ($('#orderExchangeDeliEdit_InvoiceNo').val()) {
                var response = await fetchData(`/order/OrderExchangeDeliEdit`, {data_arr});
                console.log(response);
                code_html += '[' + response['api_data']['orderNo'] + ']';

                if (response['body']['Message'] == 'Success') {
                    code_html += '교환 수거택배 수정 성공';
                } else if (response['body']['Message'] == null) {
                    code_html += '데이터가 없습니다.';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }
            } else {
                code_html += '[' + $('#OrderNo' + idx).html() + ']';
                code_html += '송장번호가 없습니다.<br>';
            }

        }


        Swal.fire({
            title: "교환 수거택배 정보수정",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 교환 수거택배 수정 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            //history.go(0);
        });
    }


    //교환처리
    const orderExchange_modal = async (check) => {

        const defModal = $('#orderExchangeModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            if ($('#SiteType' + idx).val() == 1) {
                $('#exchangeModal_ResendInfo_DeliveryCompName').html(delivery_company_list_AC);
            } else {
                $('#exchangeModal_ResendInfo_DeliveryCompName').html(delivery_company_list);
            }
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_exchange_list',

                };
            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});
            console.log(response);
            if (response.result) {
                var data = response.result;
                $('#exchangeModal_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#exchangeModal_OrderNo').html(data.OrderNo);
                $('#exchangeModal_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',\'' + data.SiteGoodsNo + '\')');
                $('#exchangeModal_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#exchangeModal_SalePrice').html(data.SalePrice);
                $('#exchangeModal_ContrAmount').html(data.ContrAmount);

                var option = JSON.parse(data.ItemOptionSelectList);
                var option_html = '';
                //console.log(option);
                option_html += '<ul>';
                for (var i = 0; i < option.length; i++) {
                    option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                    option_html += '</br>';
                }
                option_html += '</ul>';
                $('#exchangeModal_ItemOptionSelectList').html(option_html);

                var Addition = JSON.parse(data.ItemOptionAdditionList);
                var Addition_html = '';
                Addition_html += '<ul>';
                for (var j = 0; j < Addition.length; j++) {
                    Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                    Addition_html += '</br>';
                }
                Addition_html += '</ul>';
                $('#exchangeModal_ItemOptionAdditionList').html(Addition_html);
                $('#exchangeModal_BuyerName').html(data.BuyerName);
                $('#exchangeModal_ReceiverName').html(data.ReceiverName);
                $('#exchangeModal_BuyerMobileTel').html(data.BuyerMobileTel);
                $('#exchangeModal_HpNo').html(data.HpNo);
                $('#exchangeModal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
                $('#exchangeModal_TakbaeName').html(data.TakbaeName);
                $('#exchangeModal_NoSongjang').html(data.NoSongjang);

                var exchange_ReasonCode = {
                    0: '[기타] : 선택없음',
                    1: '[구매자귀책] : 단순변심',
                    2: '[구매자귀책] : 사이즈/색상 등 옵션 변경',
                    3: '[판매자귀책] : 오배송',
                    4: '[판매자귀책] : 상품불량',
                    5: '[판매자귀책] : 판매자요청',
                };
                $('#exchangeModal_exchange_ReasonDetail').html(exchange_ReasonCode[data.exchange_ReasonCode] + '<br>' + data.exchange_ReasonDetail);

                var exchange_ExchangeShippingFeeWay = {
                    0: '없음',
                    1: '지금결제함(카드결제, 핸드폰결제등)',
                    2: '환불금 차감 대기',
                    3: '판매자 직접 결제',
                    4: '상품에 동봉함',
                    5: '스마일캐시 결제',
                    6: '기타'
                };
                $('#exchangeModal_exchange_ExchangeShippingFeeWay').html(exchange_ExchangeShippingFeeWay[data.exchange_ExchangeShippingFeeWay]);
                $('#exchangeModal_exchange_ExchangeShippingFee').html(AddComma(data.exchange_ExchangeShippingFee));


                /*
                $('#modal_FreeGift').html(data.FreeGift);
                data.OrderAmount = AddComma(data.OrderAmount);
                $('#modal_OrderAmount').html(data.OrderAmount);
                data.ShippingFee = AddComma(data.ShippingFee);
                $('#modal_ShippingFee').html(data.ShippingFee);
                //$('#modal_TransType').html(data.TransType);
                $('#modal_BuyerId').html(data.BuyerId);


                $('#modal_BuyerTel').html(data.BuyerTel);

                $('#modal_TelNo').html(data.TelNo);

                $('#modal_DelMemo').html(data.DelMemo);
                 */
                defModal.modal();
            }
            return false;
        }

        if (!$('#exchangeModal_return_radoi1_1').is(':checked')) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>교환상품을 받으셔야 진행가능합니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#exchangeModal_return_radoi1_1').focus();
            });
            return false;
        }

        if ($('#exchangeModal_return_radoi2_1').is(":checked") && (!$('#exchangeModal_ResendInfo_InvoiceNo').val() || !$('#exchangeModal_ResendInfo_DeliveryCompName').val())) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>택배사 선택 및 운송장번호를 입력해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#exchangeModal_ResendInfo_InvoiceNo').focus();
            });
            return false;
        }

        /*
        if ($('#exchangeModal_return_radoi4_1').is(":checked") && (!$('#exchangeModal_HoldReason').val() || !$('#exchangeModal_ResendExpectDate').val())) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>예상재발송일을 입력해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#exchangeModal_ResendExpectDate').focus();
            });
            return false;
        }
*/

        //for문
        var code_html = '';
        var code_html2 = '';
        var code_html3 = '';

        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var data_arr = '';

            //교환 수거완료
            if ($('#exchangeModal_return_radoi1_1').is(":checked")) {

                var response = await fetchData(`/order/OrderExchangeDeliComplete`, {idx});
                console.log(response);
                code_html += '[' + response['api_data']['OrderNo'] + ' 교환 수거 ]';
                if (response['body']['Message'] == 'Success') {
                    code_html += '교환 수거 성공<br>';
                } else if (response['body']['Message'] == null) {
                    code_html += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html += response['body']['Message'] + '<br>';
                }

            }

            //교환 재발송
            if ($('#exchangeModal_return_radoi2_1').is(":checked")) {
                var data_arr =
                    {
                        idx: idx,
                        companyNo: $('#exchangeModal_ResendInfo_DeliveryCompName').val(),
                        NoSongjang: $('#exchangeModal_ResendInfo_InvoiceNo').val(),
                    };

                var response2 = await fetchData(`/order/OrderExchangeReDeliEdit`, {data_arr});
                console.log(response2);
                code_html2 += '[' + response2['api_data']['OrderNo'] + ' 교환 재발송 ]';
                if (response2['body']['Message'] == 'Success') {
                    code_html2 += '교환 재발송 성공<br>';
                } else if (response2['body']['Message'] == null) {
                    code_html2 += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html2 += response2['body']['Message'] + '<br>';
                }
            }

            //교환보류
            if ($('#exchangeModal_return_radoi4_1').is(":checked")) {
                var data_arr =
                    {
                        idx: idx,
                        HoldReason: $('#exchangeModal_HoldReason').val(),
                        ResendExpectDate: $('#exchangeModal_ResendExpectDate').val(),
                    };

                var response3 = await fetchData(`/order/OrderExchangeHold`, {data_arr});
                console.log(response3);
                code_html3 += '[' + response3['api_data']['OrderNo'] + ' 교환 보류 ]';

                if (response3['body']['Message'] == 'Success') {
                    code_html3 += '교환 재발송 성공<br>';
                } else if (response3['body']['Message'] == null) {
                    code_html3 += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html3 += response3['body']['Message'] + '<br>';
                }
            }
        }


        Swal.fire({
            title: "교환처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 교환처리 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + ` ` + code_html2 + ` ` + code_html3 + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    //교환처리 보류해제 + 재발송처리
    const orderExchange2_modal = async (check) => {

        const defModal = $('#orderExchangeModal');
        const ids = document.querySelectorAll('input[name="idx[]"]:checked');
        const listData = [];
        ids.forEach(input => {
            const idx = input.value;
            listData.push({
                idx: idx,
            });
        });

        if (listData.length <= 0) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>선택된 주문이 없습니다.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            return false;
        } else if (listData.length > 1) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>하나의 주문만 선택해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            });
            $("input:checkbox[name='idx[]']").prop("checked", false);
            $("input:checkbox[name='all_check']").prop("checked", false);
            return false;
        }

        if (check) {
            var idx = listData[0].idx;
            var data_arr =
                {
                    idx: idx,
                    join_table: 'order_exchange_list',

                };
            var response = await fetchData(`/order/GetJoinOrder`, {data_arr});
            console.log(response);
            if (response.result) {
                var data = response.result;
                $('#exchangeModal_SiteGoodsNo').html(data.SiteGoodsNo);
                $('#exchangeModal_OrderNo').html(data.OrderNo);
                $('#exchangeModal_GoodsName').attr('onclick', ' openSiteGoodsNo(' + data.SiteType + ',\'' + data.SiteGoodsNo + '\')');
                $('#exchangeModal_GoodsName').html(data.GoodsName);
                data.SalePrice = AddComma(data.SalePrice);
                $('#exchangeModal_SalePrice').html(data.SalePrice);
                $('#exchangeModal_ContrAmount').html(data.ContrAmount);

                var option = JSON.parse(data.ItemOptionSelectList);
                var option_html = '';
                //console.log(option);
                option_html += '<ul>';
                for (var i = 0; i < option.length; i++) {
                    option_html += option[i]['ItemOptionValue'] + ' ' + option[i]['ItemOptionOrderCnt'] + ' ' + option[i]['ItemOptionCode'];
                    option_html += '</br>';
                }
                option_html += '</ul>';
                $('#exchangeModal_ItemOptionSelectList').html(option_html);

                var Addition = JSON.parse(data.ItemOptionAdditionList);
                var Addition_html = '';
                Addition_html += '<ul>';
                for (var j = 0; j < Addition.length; j++) {
                    Addition_html += Addition[j]['ItemOptionValue'] + ' ' + Addition[j]['ItemOptionOrderCnt'] + ' ' + Addition[j]['ItemOptionCode'];
                    Addition_html += '</br>';
                }
                Addition_html += '</ul>';
                $('#exchangeModal_ItemOptionAdditionList').html(Addition_html);
                $('#exchangeModal_BuyerName').html(data.BuyerName);
                $('#exchangeModal_ReceiverName').html(data.ReceiverName);
                $('#exchangeModal_BuyerMobileTel').html(data.BuyerMobileTel);
                $('#exchangeModal_HpNo').html(data.HpNo);
                $('#exchangeModal_DelFullAddress').html('(' + data.ZipCode + ')' + data.DelFullAddress);
                $('#exchangeModal_TakbaeName').html(data.TakbaeName);
                $('#exchangeModal_NoSongjang').html(data.NoSongjang);

                var exchange_ReasonCode = {
                    0: '[기타] : 선택없음',
                    1: '[구매자귀책] : 단순변심',
                    2: '[구매자귀책] : 사이즈/색상 등 옵션 변경',
                    3: '[판매자귀책] : 오배송',
                    4: '[판매자귀책] : 상품불량',
                    5: '[판매자귀책] : 판매자요청',
                };
                $('#exchangeModal_exchange_ReasonDetail').html(exchange_ReasonCode[data.exchange_ReasonCode] + '<br>' + data.exchange_ReasonDetail);

                var exchange_ExchangeShippingFeeWay = {
                    0: '없음',
                    1: '지금결제함(카드결제, 핸드폰결제등)',
                    2: '환불금 차감 대기',
                    3: '판매자 직접 결제',
                    4: '상품에 동봉함',
                    5: '스마일캐시 결제',
                    6: '기타'
                };
                $('#exchangeModal_exchange_ExchangeShippingFeeWay').html(exchange_ExchangeShippingFeeWay[data.exchange_ExchangeShippingFeeWay]);
                $('#exchangeModal_exchange_ExchangeShippingFee').html(AddComma(data.exchange_ExchangeShippingFee));


                /*
                $('#modal_FreeGift').html(data.FreeGift);
                data.OrderAmount = AddComma(data.OrderAmount);
                $('#modal_OrderAmount').html(data.OrderAmount);
                data.ShippingFee = AddComma(data.ShippingFee);
                $('#modal_ShippingFee').html(data.ShippingFee);
                //$('#modal_TransType').html(data.TransType);
                $('#modal_BuyerId').html(data.BuyerId);


                $('#modal_BuyerTel').html(data.BuyerTel);

                $('#modal_TelNo').html(data.TelNo);

                $('#modal_DelMemo').html(data.DelMemo);
                 */
                defModal.modal();
            }
            return false;
        }


        if ((!$('#exchangeModal_ResendInfo_InvoiceNo').val() || !$('#exchangeModal_ResendInfo_DeliveryCompName').val())) {
            Swal.fire({
                title: "교환처리",
                html: `
            <div class="text_form">
                <p>택배사 선택 및 운송장번호를 입력해주세요.</p>
            </div>


              `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `확인`,
                //        cancelButtonText: ``,

                closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
            }).then(result => {
                $('#exchangeModal_ResendInfo_InvoiceNo').focus();
            });
            return false;
        }


        //for문
        var code_html = '';
        var code_html2 = '';
        var code_html3 = '';

        for (var i = 0; i < listData.length; i++) {
            var idx = listData[i]['idx'];
            var data_arr = '';


            //교환보류 해제
            if (1) {
                var response3 = await fetchData(`/order/OrderExchangeHoldRelease`, {idx});
                console.log(response3);
                code_html3 += '[' + response3['api_data']['OrderNo'] + ' 교환 보류 ]';
                if (response3['body']['Message'] == 'Success') {
                    code_html3 += '교환보류해제 성공<br>';
                } else if (response3['body']['Message'] == null) {
                    code_html3 += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html3 += response3['body']['Message'] + '<br>';
                }
            }

            //교환 재발송
            if (1) {
                var data_arr =
                    {
                        idx: idx,
                        companyNo: $('#exchangeModal_ResendInfo_DeliveryCompName').val(),
                        NoSongjang: $('#exchangeModal_ResendInfo_InvoiceNo').val(),
                    };
                var response2 = await fetchData(`/order/OrderExchangeReDeliEdit`, {data_arr});
                console.log(response2);
                code_html2 += '[' + response2['api_data']['OrderNo'] + ' 교환 재발송 ]';
                if (response2['body']['Message'] == 'Success') {
                    code_html2 += '교환 재발송 성공<br>';
                } else if (response2['body']['Message'] == null) {
                    code_html2 += '결과값이 없습니다.' + '<br>';
                } else {
                    code_html2 += response2['body']['Message'] + '<br>';
                }
            }


        }


        Swal.fire({
            title: "교환처리",
            html: `
            <div class="text_form">
                <p>선택 <span class="txt-blue">` + listData.length + `</span>건이 교환처리 되었습니다.</p>
            </div>
            <div class="text_form">
                   ` + code_html + ` ` + code_html2 + `
             </div>

              `,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: `확인`,
            //        cancelButtonText: ``,

            closeButtonHtml: '<i class="fa-light fa-xmark"></i>닫기'
        }).then(result => {
            history.go(0);
        });
    }

    // 특정 id를 숨기고 내부 필드 초기화하는 함수
    function hideAndResetElement(id) {
        let element = $('#' + id);

        element.hide(); // 요소 숨김

        // 요소 안에 있는 input 타입의 필드 초기화
        element.find('input[type="text"], input[type="number"], input[type="date"]').val(''); // 텍스트, 숫자, 날짜 필드 초기화
        element.find('input[type="radio"]').prop('checked', false); // 라디오 버튼 초기화
        element.find('select').prop('selectedIndex', 0); // 셀렉트박스 초기화
    }


</script>
<!-- 직접반품신청 -->
<div class="modal fade" id="orderDeliReModal" tabindex="-1" aria-labelledby="orderDeliReModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDeliReModalLabel">판매자 직접반품신청</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="table">
                        <table>
                            <caption>주문정보</caption>
                            <tbody>
                            <tr>
                                <th>상품번호/주문번호</th>
                                <td colspan="3"><span id="returnSelfModal_SiteGoodsNo"></span> / <span
                                            id="returnSelfModal_OrderNo"></span></td>
                            </tr>
                            <tr>
                                <th>상품명</th>
                                <td colspan="3">
                                    <a id="returnSelfModal_GoodsName"></a><br>
                                    <div class="detailview">
                                        <div class="dveiw" id="returnSelfModal_ItemOptionSelectList">
                                            <ul>
                                            </ul>
                                        </div>
                                        <div class="dveiw" id="returnSelfModal_ItemOptionAdditionList">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>금액/개수</th>
                                <td colspan="3"><span id="returnSelfModal_SalePrice"></span> 원 / <span
                                            id="returnSelfModal_ContrAmount"></span> 개
                                </td>
                            </tr>
                            <tr>
                                <th>구매자명/수령인명</th>
                                <td><span id="returnSelfModal_BuyerName"></span> / <span
                                            id="returnSelfModal_ReceiverName"></span></td>
                                <th>연락처</th>
                                <td><span id="returnSelfModal_BuyerMobileTel"></span> / <span
                                            id="returnSelfModal_HpNo"></span></td>
                            </tr>
                            <tr>
                                <th>주소</th>
                                <td colspan="3" id="returnSelfModal_DelFullAddress"></td>
                            </tr>
                            <tr>
                                <th>발송택배사</th>
                                <td id="returnSelfModal_TakbaeName"></td>
                                <th>송장번호</th>
                                <td id="returnSelfModal_NoSongjang"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table">
                        <table>
                            <caption>판매자입력</caption>
                            <tbody>
                            <tr>
                                <th>반품사유</th>
                                <td>
                                    <select id="returnSelfModal_ReasonCode" name="ReturnReasonCode" class="border_gray">
                                        <option value="NC" who="B" selected="selected">구매자변심</option>
                                        <option value="BG" who="B">사이즈, 색상등 선택사항 변경</option>
                                        <option value="OG" who="S">색상등 다른 상품 잘못 배송</option>
                                        <option value="DD" who="S">상품이 도착하지 않고 있음</option>
                                        <option value="RG" who="S">상품 파손/훼손</option>
                                    </select>
                                </td>
                                <th>상품상태</th>
                                <td>
                                    <select id="returnSelfModal_GoodsStatus" name="ReturnProdState" class="border_gray">
                                        <option value="0">== 선택하세요 ==</option>
                                        <option value="OP" selected="selected">개봉후 미사용</option>
                                        <option value="NP">미개봉</option>
                                        <option value="UP">개봉후 사용</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">고객님이 상품을 이미 보내셨습니까?</th>
                                <td colspan="2">
                                    <div class="select">
                                        <input type="radio" class="rdo" id="returnSelfModal_PickupInfoStatus1"
                                               name="returnSelfModal_PickupInfoStatus" value="1"
                                               checked="checked"> <label
                                                for="returnSelfModal_PickupInfoStatus1">예</label>
                                        <input type="radio" class="rdo" id="returnSelfModal_PickupInfoStatus2"
                                               name="returnSelfModal_PickupInfoStatus" value="0"
                                        > <label for="returnSelfModal_PickupInfoStatus2">아니요</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p class="guide">* 발송택배사가 CJ택배, 한진택배, 우체국택배, 롯데택배, 로젠택배 인 경우만 해당 택배사로 수거요청
                                        가능합니다.<br></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table">
                        <table>
                            <caption>판매자입력</caption>
                            <tbody>
                            <tr class="input_y">
                                <th>택배사명</th>
                                <td>
                                    <?php
                                    $delivery_company_list = get_delivery_company_list();
                                    ?>
                                    <select class="border_gray" id="returnSelfModal_DeliveryCompName">
                                        <option value="">선택</option>
                                        <? foreach ($delivery_company_list as $index => $data): ?>
                                            <option value="<?= $data['code'] ?>"
                                                    data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                        <? endforeach; ?>
                                    </select>
                                    <!--
                                    <br><span>
                                        <input type="checkbox" id="returnSelfModal_deliNone" ><label for="returnSelfModal_deliNone">송장번호 기재하지 않습니다.</label>
                                    </span>
                                    -->
                                </td>
                                <th>운송장 번호</th>
                                <td>
                                    <input class="border_gray" id="returnSelfModal_InvoiceNo" name="invoiceNo"
                                           type="text"
                                           value="" placeholder="송장번호/등기번호 입력하세요">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="orderReturnSelf_modal(false,true)">바로환불
                </button>
                <button type="button" class="btn btn-primary" onclick="orderReturnSelf_modal()">신청</button>
            </div>
        </div>
    </div>
</div>
<!-- 직접교환신청 -->
<div class="modal fade" id="orderDeliChangeModal" tabindex="-1" aria-labelledby="orderDeliChangeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDeliChangeModalLabel">판매자 직접교환신청</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="table">
                        <table>
                            <caption>주문정보</caption>
                            <tbody>
                            <tr>
                                <th>상품번호/주문번호</th>
                                <td>3120210083 / 4154145528</td>
                                <th>선물주문여부</th>
                                <td>N</td>
                            </tr>
                            <tr>
                                <th>상품명</th>
                                <td colspan="3">
                                    <a>기아 쏘렌토MQ4 / 국산 전차종 하드론 프리미엄 상신브레이크패드</a><br>
                                    <div class="detailview">
                                        <div class="dveiw" id="detailView1">
                                            <ul>
                                                앞/뒤:앞 / 20년1월 이후 / HP4464/1개, 장착유형:자택수령/1개, 차량번호 차대번호:12345/1개
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>금액/개수</th>
                                <td colspan="3">28,120 원 / 1 개</td>
                            </tr>
                            <tr>
                                <th>구매자명/수령인명</th>
                                <td>김해리 / 김해리</td>
                                <th>연락처</th>
                                <td>010-5833-4843 / 010-5833-4843</td>
                            </tr>
                            <tr>
                                <th>주소</th>
                                <td colspan="3">서울특별시 영등포구 국제금융로6길 33 맨하탄빌딩 1115호</td>
                            </tr>
                            <tr>
                                <th>발송택배사</th>
                                <td>경동택배</td>
                                <th>송장번호</th>
                                <td>567891</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>교환사유</th>
                                <td>
                                    <select id="ReturnReasonCode" name="ReturnReasonCode" class="border_gray">
                                        <option value="1" who="B">구매자가 사이즈, 색상등을 잘못 선택함</option>
                                        <option value="2" who="S">상품 파손/훼손</option>
                                        <option value="3" who="S">색상등 다른 상품 잘못 배송됨</option>
                                    </select>
                                </td>
                                <th>상품상태</th>
                                <td>
                                    <select id="ReturnProdState" name="ReturnProdState" class="border_gray">
                                        <option value="0">== 선택하세요 ==</option>
                                        <option value="1" selected="selected">개봉후 미사용</option>
                                        <option value="2">미개봉</option>
                                        <option value="3">개봉후 사용</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">고객님이 상품을 이미 보내셨습니까?</th>
                                <td colspan="2">
                                    <div class="select">
                                        <input type="radio" class="rdo" id="SendYN1" name="SendYN" value="Y"
                                               checked="checked"> <label>예</label>
                                        <input type="radio" class="rdo" id="SendYN2" name="SendYN" value="N"
                                               disabled="disabled"> <label>아니요</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p class="guide">* 발송택배사가 CJ택배, 한진택배, 우체국택배, 롯데택배, 로젠택배 인 경우만 해당 택배사로 수거요청
                                        가능합니다.<br></p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table">
                        <table>
                            <caption>판매자입력</caption>
                            <tbody>
                            <tr class="input_y">
                                <th>택배사명</th>
                                <td>
                                    <select class="border_gray" id="deliveryComp" name="deliveryComp">
                                        <option value="10013^CJ택배^N">CJ택배</option>
                                        <option value="10001^대한통운^N">대한통운</option>
                                        <option value="10007^한진택배^N">한진택배</option>
                                        <option value="10005^우체국택배^N">우체국택배</option>
                                        <option value="10008^롯데택배^N">롯데택배</option>
                                        <option value="10003^로젠택배^N">로젠택배</option>
                                        <option value="10016^경동택배^N">경동택배</option>
                                        <option value="10183^1004홈^N">1004홈</option>
                                        <option value="10147^2fast익스프레스^N">2fast익스프레스</option>
                                        <option value="10050^건영택배^N">건영택배</option>
                                        <option value="10191^고박스^N">고박스</option>
                                        <option value="10139^골드스넵스^N">골드스넵스</option>
                                        <option value="10178^국제익스프레스^N">국제익스프레스</option>
                                        <option value="10162^굿투럭^N">굿투럭</option>
                                        <option value="10034^기타택배^N">기타택배</option>
                                        <option value="10184^나은물류^N">나은물류</option>
                                        <option value="10165^노곡물류^N">노곡물류</option>
                                        <option value="10143^농협택배^N">농협택배</option>
                                        <option value="10189^대림통운^N">대림통운</option>
                                        <option value="10014^대신택배^N">대신택배</option>
                                        <option value="10078^대우전자^N">대우전자</option>
                                        <option value="10107^대운글로벌^N">대운글로벌</option>
                                        <option value="10193^더바오^N">더바오</option>
                                        <option value="10171^도도플렉스^N">도도플렉스</option>
                                        <option value="10158^두발히어로^N">두발히어로</option>
                                        <option value="10006^등기우편^N">등기우편</option>
                                        <option value="10187^딜리래빗^N">딜리래빗</option>
                                        <option value="10224^딜리박스^N">딜리박스</option>
                                        <option value="10197^라스트마일시스템즈^N">라스트마일시스템즈</option>
                                        <option value="10196^로지스밸리^N">로지스밸리</option>
                                        <option value="10154^로지스밸리택배^N">로지스밸리택배</option>
                                        <option value="10190^로지스파트너^N">로지스파트너</option>
                                        <option value="10167^로지스팟^N">로지스팟</option>
                                        <option value="10119^로토스^N">로토스</option>
                                        <option value="10075^롯데국제특송^N">롯데국제특송</option>
                                        <option value="10096^롯데마트^N">롯데마트</option>
                                        <option value="10176^롯데칠성^N">롯데칠성</option>
                                        <option value="10175^바바바로지스^N">바바바로지스</option>
                                        <option value="10203^반품구조대^N">반품구조대</option>
                                        <option value="10177^발렉스^N">발렉스</option>
                                        <option value="10035^방문수령^N">방문수령</option>
                                        <option value="10172^배송하기좋은날^N">배송하기좋은날</option>
                                        <option value="10079^범한판토스^N">범한판토스</option>
                                        <option value="10099^부릉^N">부릉</option>
                                        <option value="10114^브리지로지스^N">브리지로지스</option>
                                        <option value="10186^삼다수가정배송^N">삼다수가정배송</option>
                                        <option value="10028^삼성전자물류^N">삼성전자물류</option>
                                        <option value="10045^성원글로벌^N">성원글로벌</option>
                                        <option value="10201^성훈물류^N">성훈물류</option>
                                        <option value="10082^세방택배^N">세방택배</option>
                                        <option value="10084^쉽트랙^N">쉽트랙</option>
                                        <option value="10223^쉽트랙(Ship G)^N">쉽트랙(Ship G)</option>
                                        <option value="10117^스마트로지스^N">스마트로지스</option>
                                        <option value="10166^스페이시스원^N">스페이시스원</option>
                                        <option value="10132^시노트랜스^N">시노트랜스</option>
                                        <option value="10113^시알로지텍^N">시알로지텍</option>
                                        <option value="10102^아르고^N">아르고</option>
                                        <option value="10156^애니트랙^N">애니트랙</option>
                                        <option value="10118^에스더쉬핑^N">에스더쉬핑</option>
                                        <option value="10108^에어보이익스프레스^N">에어보이익스프레스</option>
                                        <option value="10174^에이스물류^N">에이스물류</option>
                                        <option value="10135^에이씨티앤코아물류^N">에이씨티앤코아물류</option>
                                        <option value="10198^에이치케이홀딩스^N">에이치케이홀딩스</option>
                                        <option value="10185^엔티엘피스^N">엔티엘피스</option>
                                        <option value="10153^엘서비스^N">엘서비스</option>
                                        <option value="10138^엠티인터네셔널^N">엠티인터네셔널</option>
                                        <option value="10194^오늘회러쉬^N">오늘회러쉬</option>
                                        <option value="10126^올타코리아^N">올타코리아</option>
                                        <option value="10141^용마로지스^N">용마로지스</option>
                                        <option value="10151^우리동네택배^N">우리동네택배</option>
                                        <option value="10039^우리택배^N">우리택배</option>
                                        <option value="10128^웅지익스프레스^N">웅지익스프레스</option>
                                        <option value="10142^원더스퀵^N">원더스퀵</option>
                                        <option value="10103^위니온로지스^N">위니온로지스</option>
                                        <option value="10179^윈핸드해운항공^N">윈핸드해운항공</option>
                                        <option value="10121^유프레이트 코리아^N">유프레이트 코리아</option>
                                        <option value="10120^은하쉬핑^N">은하쉬핑</option>
                                        <option value="10100^이마트몰^N">이마트몰</option>
                                        <option value="10173^이투마스^N">이투마스</option>
                                        <option value="10024^일반우편^N">일반우편</option>
                                        <option value="10015^일양택배^N">일양택배</option>
                                        <option value="10150^자이언트^N">자이언트</option>
                                        <option value="10032^자체배송^N">자체배송</option>
                                        <option value="10155^제니엘시스템^N">제니엘시스템</option>
                                        <option value="10157^제이로지스트^N">제이로지스트</option>
                                        <option value="10163^지니고^N">지니고</option>
                                        <option value="10125^지디에이코리아^N">지디에이코리아</option>
                                        <option value="10202^지비에스^N">지비에스</option>
                                        <option value="10221^지에이치스피드^N">지에이치스피드</option>
                                        <option value="10199^직구문^N">직구문</option>
                                        <option value="10031^직접배송^N">직접배송</option>
                                        <option value="10017^천일택배^N">천일택배</option>
                                        <option value="10164^카카오 T 당일배송^N">카카오 T 당일배송</option>
                                        <option value="10124^캐나다쉬핑^N">캐나다쉬핑</option>
                                        <option value="10192^케이제이티^N">케이제이티</option>
                                        <option value="10025^퀵서비스^N">퀵서비스</option>
                                        <option value="10159^큐런^N">큐런</option>
                                        <option value="10200^큐브플로우^N">큐브플로우</option>
                                        <option value="10089^택배사미정^N">택배사미정</option>
                                        <option value="10180^탱고앤고^N">탱고앤고</option>
                                        <option value="10101^투데이^N">투데이</option>
                                        <option value="10225^티에스지로지스^N">티에스지로지스</option>
                                        <option value="10210^팀프레시^N">팀프레시</option>
                                        <option value="10133^패스트박스^N">패스트박스</option>
                                        <option value="10134^팬스타국제특송^N">팬스타국제특송</option>
                                        <option value="10152^퍼레버택배^N">퍼레버택배</option>
                                        <option value="10073^편의점택배(GS25)^N">편의점택배(GS25)</option>
                                        <option value="10169^프레시메이트^N">프레시메이트</option>
                                        <option value="10160^프레시솔루션^N">프레시솔루션</option>
                                        <option value="10182^핑퐁^N">핑퐁</option>
                                        <option value="10122^하이브시티^N">하이브시티</option>
                                        <option value="10195^한국야구르트^N">한국야구르트</option>
                                        <option value="10104^한덱스^N">한덱스</option>
                                        <option value="10161^한샘^N">한샘</option>
                                        <option value="10081^한의사랑택배^N">한의사랑택배</option>
                                        <option value="10074^합동택배^N">합동택배</option>
                                        <option value="10131^허싱카고코리아^N">허싱카고코리아</option>
                                        <option value="10098^현대글로비스^N">현대글로비스</option>
                                        <option value="10149^홈이노베이션로지스^N">홈이노베이션로지스</option>
                                        <option value="10048^홈플러스택배^N">홈플러스택배</option>
                                        <option value="10188^홈픽오늘도착^N">홈픽오늘도착</option>
                                        <option value="10145^홈픽택배^N">홈픽택배</option>
                                        <option value="10204^화물을부탁해^N">화물을부탁해</option>
                                        <option value="10130^ACCcargo^N">ACCcargo</option>
                                        <option value="10116^ACE express^N">ACE express</option>
                                        <option value="10085^ACI^N">ACI</option>
                                        <option value="10140^BGF포스트^N">BGF포스트</option>
                                        <option value="10072^CJ국제특송^N">CJ국제특송</option>
                                        <option value="10115^Cway express^N">Cway express</option>
                                        <option value="10022^DHL^N">DHL</option>
                                        <option value="10168^DHL GlobalMail^N">DHL GlobalMail</option>
                                        <option value="10111^ECMS익스프레스^N">ECMS익스프레스</option>
                                        <option value="10112^EFS^N">EFS</option>
                                        <option value="10036^EMS^N">EMS</option>
                                        <option value="10023^FEDEX^N">FEDEX</option>
                                        <option value="10094^Global Shipping^N">Global Shipping</option>
                                        <option value="10209^Global Shipping10^N">Global Shipping10</option>
                                        <option value="10211^Global Shipping11^N">Global Shipping11</option>
                                        <option value="10212^Global Shipping12^N">Global Shipping12</option>
                                        <option value="10213^Global Shipping13^N">Global Shipping13</option>
                                        <option value="10214^Global Shipping14^N">Global Shipping14</option>
                                        <option value="10215^Global Shipping15^N">Global Shipping15</option>
                                        <option value="10216^Global Shipping16^N">Global Shipping16</option>
                                        <option value="10217^Global Shipping17^N">Global Shipping17</option>
                                        <option value="10218^Global Shipping18^N">Global Shipping18</option>
                                        <option value="10219^Global Shipping19^N">Global Shipping19</option>
                                        <option value="10091^Global Shipping2^N">Global Shipping2</option>
                                        <option value="10220^Global Shipping20^N">Global Shipping20</option>
                                        <option value="10092^Global Shipping3^N">Global Shipping3</option>
                                        <option value="10093^Global Shipping4^N">Global Shipping4</option>
                                        <option value="10095^Global Shipping5^N">Global Shipping5</option>
                                        <option value="10205^Global Shipping6^N">Global Shipping6</option>
                                        <option value="10206^Global Shipping7^N">Global Shipping7</option>
                                        <option value="10207^Global Shipping8^N">Global Shipping8</option>
                                        <option value="10208^Global Shipping9^N">Global Shipping9</option>
                                        <option value="10080^GPS LOGIX^N">GPS LOGIX</option>
                                        <option value="10086^Gsfresh^N">Gsfresh</option>
                                        <option value="10110^GSI익스프레스^N">GSI익스프레스</option>
                                        <option value="10043^GSMNTON^N">GSMNTON</option>
                                        <option value="10148^GTS로지스^N">GTS로지스</option>
                                        <option value="10144^HI택배^N">HI택배</option>
                                        <option value="10137^ibpcorp^N">ibpcorp</option>
                                        <option value="10106^i-parcel^N">i-parcel</option>
                                        <option value="10146^KGL네트웍스^N">KGL네트웍스</option>
                                        <option value="10136^kt express^N">kt express</option>
                                        <option value="10027^LG전자물류^N">LG전자물류</option>
                                        <option value="10109^LineExpress^N">LineExpress</option>
                                        <option value="10123^LTL^N">LTL</option>
                                        <option value="10170^NK로지솔루션^N">NK로지솔루션</option>
                                        <option value="10226^ocs^N">ocs</option>
                                        <option value="10097^Qxpress^N">Qxpress</option>
                                        <option value="10181^SBGLS^N">SBGLS</option>
                                        <option value="10077^SLX^N">SLX</option>
                                        <option value="10105^TNT^N">TNT</option>
                                        <option value="10042^UPS^N">UPS</option>
                                        <option value="10041^USPS^N">USPS</option>
                                        <option value="10044^WarpEx^N">WarpEx</option>
                                        <option value="10051^WIZWA^N">WIZWA</option>
                                        <option value="10129^YDH^N">YDH</option>
                                        <option value="10127^yunda express^N">yunda express</option>
                                    </select>
                                    <p class="ignore_prod_num">
                                        <input type="checkbox" name="IgnoreInvoiceNo" value="Y" id="ignore_prod_num">
                                        <label for="ignore_prod_num">송장번호 기재하지 않습니다</label>
                                    </p>
                                </td>
                                <th>운송장 번호</th>
                                <td>
                                    <input class="border_gray" id="invoiceNo" name="invoiceNo" type="text"
                                           value="송장번호/등기번호 입력하세요">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary">신청</button>
            </div>
        </div>
    </div>
</div>
<!-- 배송정보수정 -->
<div class="modal fade" id="orderDeliEditModal" tabindex="-1" aria-labelledby="orderDeliEditModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDeliEditModalLabel">배송정보수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h2 class="popstit">현재 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td id="orderDeliEdit_TakbaeName">경동택배</td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td id="orderDeliEdit_NoSongjang">567891</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="popstit">수정 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td>
                                    <div class="input_select">

                                        <select class="border_gray" id="orderDeliEdit_companyNo"
                                                style="width: 200px;">
                                            <option value="">선택</option>
                                            <?php
                                            $delivery_company_list = get_delivery_company_list();
                                            ?>
                                            <? foreach ($delivery_company_list as $index => $data): ?>
                                                <option value="<?= $data['code'] ?>"
                                                        data-name="<?= $data['name'] ?>"><?= $data['name'] ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td><input type="text" class="border_gray" id="orderDeliEdit_InvoiceNo"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderDeliEdit_modal()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 미수령신고 철회요청 -->
<div class="modal fade" id="orderDeliCancelModal" tabindex="-1" aria-labelledby="orderDeliCancelModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDeliCancelModalLabel">미수령신고 철회요청</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h2 class="popstit">수정 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <div class="select gap10 nowrap">
                                    <input type="radio" class="rdo" id="OrderClaimRelease_ClaimCancelType1"
                                           name="OrderClaimRelease_ClaimCancelType" value="1" checked>
                                    <label class="btn" for="OrderClaimRelease_ClaimCancelType1">송장번호 재입력</label>
                                    <input type="radio" class="rdo" id="OrderClaimRelease_ClaimCancelType2"
                                           name="OrderClaimRelease_ClaimCancelType" value="2">
                                    <label class="btn" for="OrderClaimRelease_ClaimCancelType2">철회요청 메세지입력</label>
                                </div>
                                <br>
                            </tr>
                            <tr>
                                <th>택배사명</th>
                                <td>
                                    <div class="input_select">
                                        <select class="border_gray" id="OrderClaimRelease_DeliveryCompCode"
                                                name="selDeliveryComp">
                                            <option value="">선택</option>
                                            <? foreach ($delivery_company_list as $index => $data): ?>
                                                <option value="<?= $data['code'] ?>"
                                                        data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td><input id="OrderClaimRelease_InvoiceNo" type="text" class="border_gray"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="popstit">철회요청 메세지 입력</h2>
                    <textarea class="border_gray" id="OrderClaimRelease_CancelComment"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderClaimRelease_modal()">요청</button>
            </div>
        </div>
    </div>
</div>
<!-- 라벨인쇄 -->
<div class="modal fade" id="orderLabelModal" tabindex="-1" aria-labelledby="orderLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderLabelModalLabel">라벨인쇄</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <dl class="label_choice grid grid4">
                        <dt><strong>수신인 전화번호</strong></dt>
                        <dd class="select">
                            <input type="radio" class="rdo" name="phone_number" checked="checked" value="x"
                                   onclick="$('.phone_number_show').hide()">
                            <label>표시안함</label>
                            <input type="radio" class="rdo" name="phone_number" value="o"
                                   onclick="$('.phone_number_show').show()"> <label>표시함</label>
                        </dd>
                        <dt><strong>구매자 ID</strong></dt>
                        <dd class="select">
                            <input type="radio" class="rdo" name="buyer_id" checked="checked" value="x"
                                   onclick="$('.buyer_id_show').hide()">
                            <label>표시안함</label>
                            <input type="radio" class="rdo" name="buyer_id" value="o"
                                   onclick="$('.buyer_id_show').show()"> <label>표시함</label>
                        </dd>
                    </dl>

                    <div id="print_label_list">

                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="print2()">인쇄</button>
            </div>
        </div>
    </div>
</div>
<!-- 발송정보일괄등록 -->
<div class="modal fade" id="orderSendListModal" tabindex="-1" aria-labelledby="orderSendListModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderSendListModalLabel">발송정보일괄등록</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="OrderSendExcelUploadForm" name="OrderSendExcelUploadForm"
                  action="<?= base_url('order/OrderSendExcelUpload') ?>" target="_blank" method="post"
                  enctype="multipart/form-data">
                <div class="modal-body">
                    <div>
                        <ul class="guide">
                            <li>* 발송정보는 <strong>1회 최대 500건 (750kb) 까지</strong> 일괄업로드가 가능합니다.</li>
                            <li>* 파일 업로드시 정확한 주문정보가 아닐경우 업로드에 실패하며, 이와 같은 경우에는 발송처리를 다시 시도해 주셔야합니다.</li>
                            <li>* <strong>업로드 실패후 재 시도시 이전에 업로드하신 모든 주문건을 다시 업로드 해주셔야 합니다.</strong></li>
                            <li>* 컴퓨터 성능에 따라 다량의 주문건을 한꺼번에 등록시 일시적인 오류가 발생할 수 있습니다.</li>
                            <li>* 운송장/등기번호가 기입된 엑셀파일에서 <strong>주문번호/택배사/운송장등기번호가</strong> 있는 엑셀열을 선택하세요</li>
                            <li>* 엑셀 파일은 파일형식 xls 파일만 업로드가 가능합니다.</li>
                            <li>* 엑셀 파일 문서를 닫으신 후 등록하세요</li>
                            <li>* 메모리를 많이 사용하는 프로그램 등을 종료하고 등록해주시기 바랍니다.</li>
                        </ul>
                        <div class="table">
                            <table>
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col>
                                    <col style="width: 25%;">
                                    <col>
                                </colgroup>
                                <tbody>
                                <tr>

                                    <th>
                                        주문번호
                                    </th>
                                    <td colspan="3">
                                        <div class="input_select">
                                            <select id="selOrderNoCell" name="selOrderNoCell" class="border_gray">
                                                <option value="" selected="selected">-선택-</option>
                                                <option value="A">A열</option>
                                                <option value="B">B열</option>
                                                <option value="C">C열</option>
                                                <option value="D">D열</option>
                                                <option value="E">E열</option>
                                                <option value="F">F열</option>
                                                <option value="G">G열</option>
                                                <option value="H">H열</option>
                                                <option value="I">I열</option>
                                                <option value="J">J열</option>
                                                <option value="K">K열</option>
                                                <option value="L">L열</option>
                                                <option value="M">M열</option>
                                                <option value="N">N열</option>
                                                <option value="O">O열</option>
                                                <option value="P">P열</option>
                                                <option value="Q">Q열</option>
                                                <option value="R">R열</option>
                                                <option value="S">S열</option>
                                                <option value="T">T열</option>
                                                <option value="U">U열</option>
                                                <option value="V">V열</option>
                                                <option value="W">W열</option>
                                                <option value="X">X열</option>
                                                <option value="Y">Y열</option>
                                                <option value="Z">Z열</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        택배사
                                    </th>
                                    <td>
                                        <div class="input_select">

                                            <select id="selDeliveryCompCell" name="selDeliveryCompCell"
                                                    class="border_gray">
                                                <option value="" selected="selected">-선택-</option>
                                                <option value="A">A열</option>
                                                <option value="B">B열</option>
                                                <option value="C">C열</option>
                                                <option value="D">D열</option>
                                                <option value="E">E열</option>
                                                <option value="F">F열</option>
                                                <option value="G">G열</option>
                                                <option value="H">H열</option>
                                                <option value="I">I열</option>
                                                <option value="J">J열</option>
                                                <option value="K">K열</option>
                                                <option value="L">L열</option>
                                                <option value="M">M열</option>
                                                <option value="N">N열</option>
                                                <option value="O">O열</option>
                                                <option value="P">P열</option>
                                                <option value="Q">Q열</option>
                                                <option value="R">R열</option>
                                                <option value="S">S열</option>
                                                <option value="T">T열</option>
                                                <option value="U">U열</option>
                                                <option value="V">V열</option>
                                                <option value="W">W열</option>
                                                <option value="X">X열</option>
                                                <option value="Y">Y열</option>
                                                <option value="Z">Z열</option>
                                            </select>
                                        </div>
                                    </td>
                                    <th>
                                        운송장/등기번호
                                    </th>
                                    <td>

                                        <div class="input_select">

                                            <select id="selInvoiceCell" name="selInvoiceCell" class="border_gray">
                                                <option value="" selected="selected">-선택-</option>
                                                <option value="A">A열</option>
                                                <option value="B">B열</option>
                                                <option value="C">C열</option>
                                                <option value="D">D열</option>
                                                <option value="E">E열</option>
                                                <option value="F">F열</option>
                                                <option value="G">G열</option>
                                                <option value="H">H열</option>
                                                <option value="I">I열</option>
                                                <option value="J">J열</option>
                                                <option value="K">K열</option>
                                                <option value="L">L열</option>
                                                <option value="M">M열</option>
                                                <option value="N">N열</option>
                                                <option value="O">O열</option>
                                                <option value="P">P열</option>
                                                <option value="Q">Q열</option>
                                                <option value="R">R열</option>
                                                <option value="S">S열</option>
                                                <option value="T">T열</option>
                                                <option value="U">U열</option>
                                                <option value="V">V열</option>
                                                <option value="W">W열</option>
                                                <option value="X">X열</option>
                                                <option value="Y">Y열</option>
                                                <option value="Z">Z열</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="n_invoice_case">
                            <p class="guide">예) D열-주문번호, C열-택배사, H열 – 운송장번호 D, C, H 선택</p>
                            <img src="https://pics.esmplus.com/front/data/img_ivcase.gif" class="w100">
                        </div>
                        <br>
                        <h2 class="popstit">
                            저장문서 가져오기
                        </h2>
                        <div class="flex">
                            <input type="file" id="OrderSendExcelFile" name="OrderSendExcelFile" accept=".xls,.xlsx"
                                   style="display:none"
                                   onchange="$('#FileuploadName').val(this.value.split('\\').reverse()[0])">
                            <input id="FileuploadName" type="text" class="border_gray" readonly
                                   onclick="$('#OrderSendExcelFile').click()">
                            <label for="OrderSendExcelFile" class="btn btn-gray btn-md w100px">파일 선택</label>
                        </div>
                        <br>
                        <ul class="guide">
                            <li>* 엑셀 2010 파일형식인 xlsx 파일은 지원하지 않습니다.</li>
                            <li>* 엑셀 2010 사용자분들은 <strong>엑셀 97-2003 파일형식인 xls</strong>로 저장 후 업로드해 주세요.</li>
                            <li>* 엑셀2010에서 업로드 하실 엑셀파일을 저장하실 경우 파일 메뉴의 ‘다른이름으로 저장’을 선택하고 하단 파일형식을 ‘Excel 97 - 2003
                                통합문서’로
                                선택한 후 저장해주세요.
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="uploadSendExcel()">등록</button>
            </div>
        </div>
    </div>
</div>
<!-- 주문자정보수정 -->
<div class="modal fade" id="orderUserModal" tabindex="-1" aria-labelledby="orderUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderUserModalLabel">주문자정보수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="popstit">
                    현재 주문자 정보
                </h2>
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>수령인명</th>
                            <td colspan="3">정승원</td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td>010-2963-2494</td>
                            <th>휴대폰 번호</th>
                            <td>010-2963-2494</td>
                        </tr>
                        <tr>
                            <th>주소</th>
                            <td colspan="3">충청남도 아산시 배미로 7-2<br>102호 제이에스원카</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="popstit">
                    수정 주문자 정보
                </h2>
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>수령인명</th>
                            <td><input id="txtRcverNm" type="text" class="border_gray"></td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td>
                                <div class="flex gap5">
                                    <div class="input_select w50">

                                        <select id="selHt1" class="border_gray">
                                            <option value="02" selected="selected">02</option>
                                            <option value="031">031</option>
                                            <option value="032">032</option>
                                            <option value="033">033</option>
                                            <option value="041">041</option>
                                            <option value="042">042</option>
                                            <option value="043">043</option>
                                            <option value="044">044</option>
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
                                            <option value="0503">0503</option>
                                            <option value="0505">0505</option>
                                        </select>
                                    </div>
                                    -
                                    <input id="txtHt2" type="text" class="border_gray w25">
                                    -
                                    <input id="txtHt3" type="text" class="border_gray w25">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>휴대폰 번호</th>
                            <td>
                                <div class="flex gap5">
                                    <div class="input_select w50">

                                        <select id="selCp1" class="border_gray">
                                            <option value="010" selected="selected">010</option>
                                            <option value="011">011</option>
                                            <option value="016">016</option>
                                            <option value="017">017</option>
                                            <option value="018">018</option>
                                            <option value="019">019</option>
                                        </select>
                                    </div>
                                    -
                                    <input id="txtCp2" type="text" class="border_gray w25">
                                    -
                                    <input id="txtCp3" type="text" class="border_gray w25">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>주소입력</th>
                            <td class="n_adress">
                                <input id="txtZipCode" readonly="readonly" type="text" class="border_gray">

                                <button id="searchPost" class="btn btn-gray btn-mini w100">우편번호 찾기</button>
                                <div>
                                    <input id="txtAd1" readonly="readonly" type="text" class="border_gray">
                                    <input id="txtAd2" type="text" class="border_gray">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>
<!-- 정산예정금액보기 -->
<div class="modal fade" id="orderAmountModal" tabindex="-1" aria-labelledby="orderAmountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderAmountModalLabel">정산예정금액보기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th rowspan="2">주문번호</th>
                            <th rowspan="2">상품명</th>
                            <th rowspan="2">판매금액</th>
                            <th rowspan="2">기본서비스이용료</th>
                            <th rowspan="2">공급원가</th>
                            <th rowspan="2">판매자할인/공제금</th>
                            <th rowspan="2">고객 결제금액</th>
                            <th colspan="3">KCP수수료</th>
                            <th colspan="2">배송비</th>
                            <th colspan="3">부가세금처리</th>
                            <th rowspan="2">정산예정금액</th>
                        </tr>
                        <tr>
                            <th>수수료</th>
                            <th>캐시백</th>
                            <th>합계</th>
                            <th>배송비</th>
                            <th>배송비수수료</th>
                            <th>부가세10%</th>
                            <th>B2P부가세</th>
                            <th>환급금</th>
                        </tr>
                        </thead>
                        <tbody id="orderAmountModal_list">
                        <tr>
                            <td>주문번호</td>
                            <td>상품명</td>
                            <td>판매금액</td>
                            <td>기본서비스이용료</td>
                            <td>공급원가</td>
                            <td>판매자할인/공제금</td>
                            <td>고객 결제금액</td>
                            <td>수수료</td>
                            <td id="kcp_event_td">캐시백</td>
                            <td>합계</td>
                            <td>배송비</td>
                            <td>배송비수수료</td>
                            <td>부가세10%</td>
                            <td>B2P부가세</td>
                            <th>환급금</th>
                            <td>정산예정금액</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex ai-c jc-sb box_whiteline">
                    <h2 class="popstit">
                        총 합계
                    </h2>
                    <p>판매금액 <br><span class="color-blue" id="modal_OrderAmount_total">0</span>원</p>
                    <p>수수료 <br><span class="color-blue" id="modal_ServiceFee_total">0</span>원</p>
                    <p>KCP수수료 <br><span class="color-blue" id="modal_KCPServiceFee_total">0</span>원</p>
                    <p id="modal_KCPServiceFeeEvent_p">KCP수수료(캐시백이벤트) <br><span class="color-blue"
                                                                                id="modal_KCPServiceFeeEvent_total">0</span>원
                    </p>
                    <p>공급원가 <br><span class="color-blue" id="modal_CostPrice_total">0</span>원</p>
                    <p>판매자할인 <br><span class="color-blue" id="modal_SellerDiscountPrice_total">0</span>원</p>
                    <p>배송비 <br><span class="color-blue" id="modal_dl_DelFeeAmt_total">0</span>원</p>
                    <p>배송비수수료 <br><span class="color-blue" id="modal_dl_DelFeeCommission_total">0</span>원</p>
                    <p>부가세 <br><span class="color-blue" id="modal_surTax_total">0</span>원</p>
                    <p>B2P부가세 <br><span class="color-blue" id="modal_b2p_surTax_total">0</span>원</p>
                    <p>환급금 <br><span class="color-blue" id="modal_refund_total">0</span>원</p>
                    <p>정산예정금액 <br><span class="color-blue" id="modal_SettlementPrice_total">0</span>원</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 발송예정일 -->
<div class="modal fade" id="orderDelayModal" tabindex="-1" aria-labelledby="orderDelayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDelayModalLabel">발송예정일</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="popstit">
                    발송예정일 입력
                </h2>

                <div class="input_select">
                    <!--i class="fa-duotone fa-calendar"></i-->
                    <input type="date" class="border_gray" id="orderDelay_ShippingExpectedDate">
                </div>
                <br>
                <h2 class="popstit">
                    사유입력
                </h2>
                <div class="input_select">

                    <select class="border_gray" id="orderDelay_ReasonType">
                        <option value="1">상품준비중(재고부족)</option>
                        <option value="2">고객요청</option>
                        <option value="3">기타</option>
                    </select>
                </div>
                <textarea class="border_gray" id="orderDelay_ReasonDetail"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="orderDelay_modal()">확인
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>
<!-- 판매취소 -->
<div class="modal fade" id="orderCancelModal" tabindex="-1" aria-labelledby="orderCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderCancelModalLabel">판매취소</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="popstit text-center">
                    판매를 취소하는 경우 페널티가 부여됩니다.
                    <br>
                    선택 <span class="txt-blue" id="cancelSoldOutCnt">0</span>건을 취소하시겠습니까?
                </h2>
                <br>
                <h2 class="popstit">
                    판매 취소 사유
                </h2>
                <div class="input_select">

                    <select class="border_gray" id="cancelSoldOutReason">
                        <option value="재고가 부족함">재고가 부족함</option>
                        <option value="상품에 하자가 생겨서 판매불가">상품에 하자가 생겨서 판매불가</option>
                        <option value=기타 사유
                        ">기타 사유</option>
                        <option value="해당 선택/옵션 정보만 품절처리">해당 선택/옵션 정보만 품절처리</option>
                        <option value="해당 상품 품절처리">해당 상품 품절처리</option>
                        <option value="구매의사 취소">구매의사 취소</option>
                        <option value="선택사항 변경">선택사항 변경</option>
                        <option value="배송지연 7일이상">배송지연 7일이상</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderCancelSoldOut_modal()">확인</button>
            </div>
        </div>
    </div>
</div>
<!-- 구매정보 -->
<div class="modal fade" id="orderSheetModal" tabindex="-1" aria-labelledby="orderSheetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderSheetModalLabel">구매정보</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="orderSheet">
                    <h2 class="popstit">
                        주문정보
                    </h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>
                                    상품번호
                                </th>
                                <td id="modal_SiteGoodsNo">
                                    3119927870
                                </td>
                                <th>
                                    주문번호
                                </th>
                                <td id="modal_OrderNo">
                                    4154498584
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    상품명
                                </th>
                                <td colspan="3" id="modal_GoodsName">
                                    현대 아반떼 CN7 / 국산 전차종 하드론 프리미엄 상신브레이크패드
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    수량
                                </th>
                                <td colspan="3" id="modal_ContrAmount">
                                    1 개
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    주문옵션
                                </th>
                                <td id="modal_ItemOptionSelectList">
                                    앞/뒤:뒤 / 전자파킹 전용 / HP4463/-11120원/1개, 장착유형:자택수령/1개, 차량번호 차대번호:kmhlt41fgmu201007/1개
                                </td>
                                <th>
                                    추가구성
                                </th>
                                <td id="modal_ItemOptionAdditionList">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    사은품
                                </th>
                                <td colspan="3" id="modal_FreeGift">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    구매금액
                                </th>
                                <td colspan="3">
                                    <strong id="modal_OrderAmount">23,080</strong>
                                    원
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    배송비
                                </th>
                                <td id="modal_ShippingFee" colspan="3">
                                    3,000
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="popstit">
                        구매자정보
                    </h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>
                                    구매자ID
                                </th>
                                <td id="modal_BuyerId">
                                    f4pantom
                                </td>
                                <th>
                                    구매자이름
                                </th>
                                <td id="modal_BuyerName">
                                    정승원
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    연락처1
                                </th>
                                <td id="modal_BuyerMobileTel">
                                    010-2963-2494
                                </td>
                                <th>
                                    연락처2
                                </th>
                                <td id="modal_BuyerTel">
                                    041-545-9355
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="popstit">
                        배송지정보
                    </h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>
                                    상품수령인
                                </th>
                                <td colspan="3" id="modal_ReceiverName">
                                    정승원
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    연락처1
                                </th>
                                <td id="modal_HpNo">
                                    010-2963-2494
                                </td>
                                <th>
                                    연락처2
                                </th>
                                <td id="modal_TelNo">
                                    010-2963-2494
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    배송지주소
                                </th>
                                <td colspan="3" id="modal_DelFullAddress">
                                    (31529)
                                    <br>
                                    충청남도 아산시 배미로 7-2 102호 제이에스원카
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    배송 요청사항
                                </th>
                                <td colspan="3" id="modal_DelMemo">
                                    배송 전 연락바랍니다.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="popstit">
                        배송 진행 정보
                    </h2>
                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th scope="col">
                                    처리일시
                                </th>
                                <th scope="col">
                                    처리구분
                                </th>
                                <th scope="col">
                                    상세보기
                                </th>
                            </tr>
                            </thead>
                            <tbody id="deli_progress">

                            <tr name="SiteGoodsNo">

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 반품처리 -->
<div class="modal fade" id="orderReturnModal" tabindex="-1" aria-labelledby="orderReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderReturnModalLabel">반품처리</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>상품번호/주문번호</th>
                            <td><span id="returnModal_SiteGoodsNo"></span> / <span id="returnModal_OrderNo"></span></td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td id="returnModal_GoodsName"></td>
                        </tr>
                        <tr>
                            <th>금액/개수</th>
                            <td><span id="returnModal_SalePrice"></span>원 / <span id="returnModal_ContrAmount"></span>개
                            </td>
                        </tr>
                        <tr>
                            <th>구매자명</th>
                            <td id="returnModal_BuyerName"></td>
                        </tr>
                        <tr>
                            <th>반품사유</th>
                            <td id="returnModal_return_ReasonDetail"></td>
                        </tr>
                        <tr>
                            <th rowspan="2">반품배송비</th>
                            <td><span id="returnModal_return_ReturnShippingFee">0</span>원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | <span id="returnModal_return_ReturnShippingFeeWay">없음</span></td>
                        </tr>

                        <tr>
                            <th rowspan="2">추가반품비</th>
                            <td><span id="returnModal_return_AddReturnShippingFee">0</span>원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | <span id="returnModal_return_AddReturnShippingFeeWay">없음</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>


                <?php if ($_GET['list_sql'] == 'return_hold_count'){ ?>
                <div class="box_white2">
                    <p><strong>현재 환불 보류가 설정되어있습니다 / 보류를 해제하고 바로 환불 승인을 하겠습니다</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="returnModal_return_radoi1" id="returnModal_return_radoi1_1"
                               value="o"
                               onclick="">
                        <label for="returnModal_return_radoi1_1">예</label>


                        <input type="radio" class="" name="returnModal_return_radoi1" id="returnModal_return_radoi1_2"
                               value="x"
                               onclick="$('#returnModal_return_radoi2').show();$('#returnModal_return_radoi2_hide').focus()"">
                        <label for="returnModal_return_radoi1_2">아니요</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderReturnCheck2_modal()">확인</button>
            </div>

            <?php }else{ ?>

            <div class="box_white2">
                <p><strong>반품상품을 받으셨습니까?</strong></p>
                <div class="select">
                    <input type="radio" class="" name="returnModal_return_radoi1" id="returnModal_return_radoi1_1"
                           value="o"
                           onclick="$('#returnModal_return_radoi2').show();$('#returnModal_return_radoi2_hide').focus()">
                    <label for="returnModal_return_radoi1_1">예</label>
                    <!--
                    <input type="radio" class="" name="returnModal_return_radoi1" id="returnModal_return_radoi1_2"
                           value="x"
                           onclick="$('#returnModal_return_radoi2').hide();$('#returnModal_return_radoi3').hide();$('input[name=\'returnModal_return_radoi2\']').prop('checked', false);">
                    <label for="returnModal_return_radoi1_2">아니요</label>
                    -->

                    <input type="radio" class="" name="returnModal_return_radoi1" id="returnModal_return_radoi1_2"
                           value="x"
                           onclick="$('#returnModal_return_radoi2').show();$('#returnModal_return_radoi2_hide').focus()"">
                    <label for="returnModal_return_radoi1_2">아니요</label>
                </div>
            </div>
            <br>
            <div class="box_white2" id="returnModal_return_radoi2" style="display: none">
                <p><strong>환불보류설정을 하시겠습니까?</strong></p>
                <div class="select">
                    <input type="radio" class="" name="returnModal_return_radoi2" id="returnModal_return_radoi2_1"
                           value="o"
                           onclick="$('#returnModal_return_radoi3').show();$('#returnModal_ResendInfo_HoldReasonDetail').focus()">
                    <label for="returnModal_return_radoi2_1">예</label>
                    <input type="radio" class="" name="returnModal_return_radoi2" id="returnModal_return_radoi2_2"
                           value="x"
                           onclick="$('#returnModal_return_radoi3').hide();$('#returnModal_ResendInfo_HoldReasonDetail').val('');$('#returnModal_ReturnShippingFee').val('')">
                    <label for="returnModal_return_radoi2_2">아니요</label>
                    <input type="text" id="returnModal_return_radoi2_hide" readonly
                           style="width: 0px;height: 0px;border: none">
                </div>
            </div>

            <div class="box_white table" id="returnModal_return_radoi3" style="display: none">
                <table>
                    <tbody>
                    <!-- 날짜 보내는 api없음
                    <tr>
                        <td>재발송일자</td>
                        <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                    </tr>
                    -->
                    <tr>
                        <td>보류사유</td>
                        <td>
                            <select id="returnModal_ResendInfo_HoldReason">
                                <option value="0">기타유보사유</option>
                                <option value="2">추가반품비청구(기타반품비)</option>
                                <option value="4">반품미입고</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>보류상세사유</td>
                        <td><input type="text" class="border_gray" id="returnModal_ResendInfo_HoldReasonDetail"/>
                        </td>
                    </tr>
                    <tr>
                        <td>추가반품배송비</td>
                        <td><input type="number" class="border_gray" id="returnModal_ReturnShippingFee" value="0"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary" onclick="orderReturnCheck_modal()">확인</button>
        </div>
        <?php } ?>

    </div>
</div>
</div>
<!-- 반품건 교환처리 -->
<div class="modal fade" id="orderReExchangeModal" tabindex="-1" aria-labelledby="orderReExchangeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderReExchangeModalLabel">반품건 교환처리</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>상품번호/주문번호</th>
                            <td><span id="ReturnExchange_SiteGoodsNo"></span> / <span
                                        id="ReturnExchange_OrderNo"></span></td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td id="ReturnExchange_GoodsName"></td>
                        </tr>
                        <tr>
                            <th>금액/개수</th>
                            <td><span id="ReturnExchange_SalePrice"></span>원 / <span
                                        id="ReturnExchange_ContrAmount"></span>개
                            </td>
                        </tr>
                        <tr>
                            <th>구매자명</th>
                            <td id="ReturnExchange_BuyerName"></td>
                        </tr>
                        <tr>
                            <th>반품사유</th>
                            <td id="ReturnExchange_return_ReasonDetail"></td>
                        </tr>
                        <tr>
                            <th rowspan="2">반품배송비</th>
                            <td><span id="ReturnExchange_return_ReturnShippingFee">0</span>원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | <span id="ReturnExchange_return_AddReturnShippingFeeWay"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p class="guide">
                    반품건을 교환으로 전환시 반품배송비는 구매고객에게 환불됩니다.<br>
                    교환배송비등 추가비용은 구매고객님과 합의하시기 바랍니다.
                </p>
                <br>

                <div class="box_white2">
                    <p><strong>상품을 받으셨습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="ReturnExchange_return_radoi1"
                               id="ReturnExchange_return_radoi1_1" value="o"
                               onclick="$('#ReturnExchange_return_radoi2').show();$('#ReturnExchange_return_radoi2_hide').focus()">
                        <label for="ReturnExchange_return_radoi1_1">예</label>
                        <input type="radio" class="" name="ReturnExchange_return_radoi1"
                               id="ReturnExchange_return_radoi1_2" checked="checked" value="x"
                               onclick="$('#ReturnExchange_return_radoi2').hide();$('#ReturnExchange_return_radoi2_2').click()">
                        <label for="ReturnExchange_return_radoi1_2">아니요</label>
                    </div>
                </div>
                <br>
                <div class="box_white2" id="ReturnExchange_return_radoi2" style="display: none">
                    <p><strong>반품상품을 교환처리하시겠습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="ReturnExchange_return_radoi2"
                               id="ReturnExchange_return_radoi2_1" value="o"
                               onclick="$('#ReturnExchange_return_radoi3').show();$('#ReturnExchange_ResendInfo_InvoiceNo').focus()">
                        <label for="ReturnExchange_return_radoi2_1">예</label>
                        <input type="radio" class="" name="ReturnExchange_return_radoi2"
                               id="ReturnExchange_return_radoi2_2" checked="checked" value="x"
                               onclick="$('#ReturnExchange_return_radoi3').hide();$('#ReturnExchange_ResendInfo_InvoiceNo').val('')">
                        <label for="ReturnExchange_return_radoi2_2">아니요</label>
                        <input type="text" id="ReturnExchange_return_radoi2_hide" readonly
                               style="width: 0px;height: 0px;border: none">
                    </div>
                </div>

                <div class="box_white table" id="ReturnExchange_return_radoi3" style="display: none">
                    <p>반품신청건을 교환처리 하기 위해서는 교환발송 정보를 입력하여주시기 바랍니다.</p>
                    <table>
                        <tbody>
                        <!-- 날짜 보내는 api없음
                        <tr>
                            <td>재발송일자</td>
                            <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                        </tr>
                        -->
                        <tr>
                            <td>택배사명</td>
                            <td>
                                <select id="ReturnExchange_ResendInfo_DeliveryCompName">
                                    <option value="">선택</option>
                                    <? foreach ($delivery_company_list as $index => $data): ?>
                                        <option value="<?= $data['code'] ?>"
                                                data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>운송장 번호</td>
                            <td><input type="text" class="border_gray" id="ReturnExchange_ResendInfo_InvoiceNo"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderReturnExchange_modal()">확인</button>
            </div>
        </div>
    </div>
</div>
<!-- 반품관리 수거택배 정보수정 -->
<div class="modal fade" id="orderReturnDeliEditModal" tabindex="-1" aria-labelledby="orderReturnDeliEditModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderReturnDeliEditModalLabel">반품관리 수거택배 정보수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h2 class="popstit">현재 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td id="orderReturnDeliEdit_TakbaeName">경동택배</td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td id="orderReturnDeliEdit_NoSongjang">567891</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="popstit">수정 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td>
                                    <div class="input_select">

                                        <select class="border_gray" id="orderReturnDeliEdit_companyNo"
                                                style="width: 200px;" onchange="$('#orderReturnDeliEdit_companyNo_input').val(this.value);$('#orderReturnDeliEdit_takbaeName_input').val($('#orderReturnDeliEdit_companyNo option:selected').data('name'))">
                                        </select>

                                        <input type="hidden" id="orderReturnDeliEdit_companyNo_input">
                                        <input type="hidden" id="orderReturnDeliEdit_takbaeName_input">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td><input type="text" class="border_gray" id="orderReturnDeliEdit_InvoiceNo"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderReturnDeliEdit_modal()">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 보상요청 -->
<div class="modal fade" id="orderRewardModal" tabindex="-1" aria-labelledby="orderRewardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderRewardModalLabel">보상요청</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>상품번호/주문번호</th>
                            <td>상품번호/주문번호</td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td>상품명</td>
                        </tr>
                        <tr>
                            <th>금액/개수</th>
                            <td>원/개</td>
                        </tr>
                        <tr>
                            <th>구매자명</th>
                            <td>구매자명</td>
                        </tr>
                        <tr>
                            <th>반품사유</th>
                            <td>반품사유</td>
                        </tr>
                        <tr>
                            <th rowspan="2">반품배송비</th>
                            <td>0원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | Y</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p>보상요청 내역</p>
                <div class="box_white table">
                    <table>
                        <tbody>
                        <tr>
                            <td>보상요청 사유선택</td>
                            <td>
                                <select>
                                    <option>사유선택</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>반품배송비</td>
                            <td>
                                <div class="input_unit">
                                    <input type="text" id="" name="" placeholder="입력해주세요." class="border_gray"
                                           value="0">원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>원가보상비</td>
                            <td>
                                <div class="input_unit">
                                    <input type="text" id="" name="" placeholder="입력해주세요." class="border_gray"
                                           value="0">원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>총 합계</td>
                            <td>
                                <div class="input_unit">
                                    <input type="text" id="" name="" placeholder="입력해주세요." class="border_gray"
                                           value="0">원
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary">확인</button>
            </div>
        </div>
    </div>
</div>

<!-- 교환처리 -->
<div class="modal fade" id="orderExchangeModal" tabindex="-1" aria-labelledby="orderExchangeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderExchangeModalLabel">교환처리</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>상품번호/주문번호</th>
                            <td><span id="exchangeModal_SiteGoodsNo"></span> / <span id="exchangeModal_OrderNo"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td id="exchangeModal_GoodsName"></td>
                        </tr>
                        <tr>
                            <th>금액/개수</th>
                            <td><span id="exchangeModal_SalePrice"></span>원 / <span
                                        id="exchangeModal_ContrAmount"></span>개
                            </td>
                        </tr>
                        <tr>
                            <th>구매자명</th>
                            <td id="exchangeModal_BuyerName"></td>
                        </tr>
                        <tr>
                            <th>교환사유</th>
                            <td id="exchangeModal_exchange_ReasonDetail"></td>
                        </tr>
                        <tr>
                            <th rowspan="2">교환배송비</th>
                            <td><span id="exchangeModal_exchange_ExchangeShippingFee">0</span>원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | <span id="exchangeModal_exchange_ExchangeShippingFeeWay">없음</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <?php if ($_GET['list_sql'] == 'exchange_hold_count'){ ?>

                <div class="box_white2" id="exchangeModal_return_radoi2">
                    <p><strong>보류를 해제하고 바로 재발송 하겠습니다.</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="exchangeModal_return_radoi2"
                               id="exchangeModal_return_radoi2_1" value="o" checked="checked">
                        <label for="exchangeModal_return_radoi2_1">예</label>
                    </div>
                </div>

                <div class="box_white table" id="exchangeModal_return_radoi3">
                    <p>교환재발송 처리 위해서는 교환발송 정보를 입력하여주시기 바랍니다.</p>
                    <table>
                        <tbody>
                        <!-- 날짜 보내는 api없음
                        <tr>
                            <td>재발송일자</td>
                            <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                        </tr>
                        -->
                        <tr>
                            <td>택배사명</td>
                            <td>
                                <select id="exchangeModal_ResendInfo_DeliveryCompName">
                                    <option value="">선택</option>
                                    <? foreach ($delivery_company_list as $index => $data): ?>
                                        <option value="<?= $data['code'] ?>"
                                                data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>운송장 번호</td>
                            <td><input type="text" class="border_gray" id="exchangeModal_ResendInfo_InvoiceNo"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderExchange2_modal()">확인</button>
            </div>

            <?php }else{ ?>
            <div class="box_white2">
                <p><strong>교환상품을 받으셨습니까?</strong></p>
                <div class="select">
                    <input type="radio" class="" name="exchangeModal_return_radoi1"
                           id="exchangeModal_return_radoi1_1" value="o"
                           onclick="$('#exchangeModal_return_radoi2').show();$('#exchangeModal_return_radoi2_hide').focus();$('#exchangeModal_return_radoi4_box').hide();$('input[name=exchangeModal_return_radoi2]').prop('checked',false)">
                    <label for="exchangeModal_return_radoi1_1">예</label>
                    <input type="radio" class="" name="exchangeModal_return_radoi1"
                           id="exchangeModal_return_radoi1_2" value="x"
                           onclick="$('#exchangeModal_return_radoi2').hide();$('#exchangeModal_return_radoi4_box').show();$('input[name=exchangeModal_return_radoi2]').prop('checked',false);$('#exchangeModal_return_radoi2_2').click();$('#exchangeModal_return_radoi4_2').click();$('input[name=exchangeModal_return_radoi4]').prop('checked',false)">
                    <label for="exchangeModal_return_radoi1_2">아니요</label>
                </div>
            </div>
            <br>
            <div class="box_white2" id="exchangeModal_return_radoi2" style="display: none">
                <p><strong>교환 재발송 하시겠습니까?</strong></p>
                <div class="select">
                    <input type="radio" class="" name="exchangeModal_return_radoi2"
                           id="exchangeModal_return_radoi2_1" value="o"
                           onclick="$('#exchangeModal_return_radoi3').show();$('#exchangeModal_ResendInfo_InvoiceNo').focus();$('#exchangeModal_return_radoi4_box').hide();$('input[name=exchangeModal_return_radoi4]').prop('checked',false)">
                    <label for="exchangeModal_return_radoi2_1">예</label>
                    <input type="radio" class="" name="exchangeModal_return_radoi2"
                           id="exchangeModal_return_radoi2_2" value="x"
                           onclick="$('#exchangeModal_return_radoi3').hide();$('#exchangeModal_ResendInfo_InvoiceNo').val('');$('#exchangeModal_return_radoi4_2').click();$('#exchangeModal_return_radoi4_box').show();$('input[name=exchangeModal_return_radoi4]').prop('checked',false)">
                    <label for="exchangeModal_return_radoi2_2">아니요</label>
                    <input type="text" id="exchangeModal_return_radoi2_hide" readonly
                           style="width: 0px;height: 0px;border: none">
                </div>
            </div>

            <div class="box_white table" id="exchangeModal_return_radoi3" style="display: none">
                <p>교환재발송 처리 위해서는 교환발송 정보를 입력하여주시기 바랍니다.</p>
                <table>
                    <tbody>
                    <!-- 날짜 보내는 api없음
                    <tr>
                        <td>재발송일자</td>
                        <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                    </tr>
                    -->
                    <tr>
                        <td>택배사명</td>
                        <td>
                            <select id="exchangeModal_ResendInfo_DeliveryCompName">
                                <option value="">선택</option>
                                <? foreach ($delivery_company_list as $index => $data): ?>
                                    <option value="<?= $data['code'] ?>"
                                            data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                <? endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>운송장 번호</td>
                        <td><input type="text" class="border_gray" id="exchangeModal_ResendInfo_InvoiceNo"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div id="exchangeModal_return_radoi4_box" style="display: none">
                <div class="box_white2">
                    <p><strong>교환보류 설정하시겠습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="exchangeModal_return_radoi4"
                               id="exchangeModal_return_radoi4_1" value="o"
                               onclick="$('#exchangeModal_return_radoi4').show();$('#exchangeModal_ResendExpectDate').focus()">
                        <label for="exchangeModal_return_radoi4_1">예</label>
                        <input type="radio" class="" name="exchangeModal_return_radoi4"
                               id="exchangeModal_return_radoi4_2" value="x"
                               onclick="$('#exchangeModal_return_radoi4').hide()"> <label
                                for="exchangeModal_return_radoi4_2">아니요</label>
                    </div>
                </div>
                <!-- 보류 시-->
                <div class="box_white" id="exchangeModal_return_radoi4" style="display: none">
                    <p>교환보류설정</p>
                    <select id="exchangeModal_HoldReason">
                        <option value="0">기타유보사유</option>
                        <option value="1">교환배송비청구</option>
                        <option value="4">교환입고미확인</option>
                    </select>
                    <p style="display: none">예상재발송일</p>
                    <input type="date" name="exchangeModal_ResendExpectDate" id="exchangeModal_ResendExpectDate"
                           class="border_gray" style="display: none">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary" onclick="orderExchange_modal()">확인</button>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<!-- 교환건 반품처리 -->
<div class="modal fade" id="orderExReturnModal" tabindex="-1" aria-labelledby="orderExReturnModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderExReturnModalLabel">교환건 반품처리</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table">
                    <table>
                        <tbody>
                        <tr>
                            <th>상품번호/주문번호</th>
                            <td><span id="ExchangeReturn_SiteGoodsNo"></span> / <span
                                        id="ExchangeReturn_OrderNo"></span></td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td id="ExchangeReturn_GoodsName"></td>
                        </tr>
                        <tr>
                            <th>금액/개수</th>
                            <td><span id="ExchangeReturn_SalePrice"></span>원 / <span
                                        id="ExchangeReturn_ContrAmount"></span>개
                            </td>
                        </tr>
                        <tr>
                            <th>구매자명</th>
                            <td id="ExchangeReturn_BuyerName"></td>
                        </tr>
                        <tr>
                            <th>교환사유</th>
                            <td id="ExchangeReturn_exchange_ReasonDetail"></td>
                        </tr>
                        <tr>
                            <th rowspan="2">교환배송비</th>
                            <td><span id="ExchangeReturn_exchange_ExchangeShippingFee">0</span>원</td>
                        </tr>
                        <tr>
                            <td>결제여부 | <span id="ExchangeReturn_exchange_ExchangeShippingFeeWay"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <p class="guide">
                    교환건을 반품으로 전환시 교환배송비는 구매고객에게 환불됩니다.<br>
                    교환배송비등 추가비용은 구매고객님과 합의하시기 바랍니다.
                </p>
                <br>

                <div class="box_white2">
                    <p><strong>상품을 받으셨습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="ExchangeReturn_return_radio1"
                               id="ExchangeReturn_return_radio1_Y" value="o">
                        <label for="ExchangeReturn_return_radio1_Y">예</label>
                        <input type="radio" class="" name="ExchangeReturn_return_radio1"
                               id="ExchangeReturn_return_radio1_N" checked="checked" value="x">
                        <label for="ExchangeReturn_return_radio1_N">아니요</label>
                    </div>
                </div>
                <br>
                <div class="box_white2" id="ExchangeReturn_return_radio2" style="display: none">
                    <p><strong>교환상품을 반품처리하시겠습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="ExchangeReturn_return_radio2"
                               id="ExchangeReturn_return_radio2_Y" value="o"
                               onclick="">
                        <label for="ExchangeReturn_return_radio2_Y">예</label>
                        <input type="radio" class="" name="ExchangeReturn_return_radio2"
                               id="ExchangeReturn_return_radio2_N" checked="checked" value="x"
                               onclick="">
                        <label for="ExchangeReturn_return_radio2_N">아니요</label>
                        <input type="text" id="ExchangeReturn_return_radoi2_hide" readonly
                               style="width: 0px;height: 0px;border: none">
                    </div>
                </div>

                <br>
                <div class="box_white2" id="ExchangeReturn_return_radio_refund" style="display: none">
                    <p><strong>환불승인을 하시겠습니까?</strong></p>
                    <div class="select">
                        <input type="radio" class="" name="ExchangeReturn_return_radio_refund"
                               id="ExchangeReturn_return_radio_refund_Y" value="o"
                               onclick="">
                        <label for="ExchangeReturn_return_radio_refund_Y">예</label>
                        <input type="radio" class="" name="ExchangeReturn_return_radio_refund"
                               id="ExchangeReturn_return_radio_refund_N" value="x"
                               onclick="">
                        <label for="ExchangeReturn_return_radio_refund_N">아니요</label>
                        <input type="text" id="ExchangeReturn_return_radio_refund_hide" readonly
                               style="width: 0px;height: 0px;border: none">
                    </div>
                </div>

                <div class="box_white table" id="ExchangeReturn_return_radio3" style="display: none">
                    <p><strong>반품전환시 이미 결제되었던 교환배송비는 반품배송비로 전환되지 않습니다. 구매자와 반품배송비에 대해 합의 후 처리하시기 바랍니다.</strong></p>
                    <p>교환신청건을 반품처리 하기 위해서는 반품발송 정보를 입력하여주시기 바랍니다.</p>
                    <table>
                        <tbody>
                        <!-- 날짜 보내는 api없음
                        <tr>
                            <td>재발송일자</td>
                            <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                        </tr>
                        -->
                        <tr>
                            <td>택배사명</td>
                            <td>
                                <select id="ExchangeReturn_ResendInfo_DeliveryCompName">
                                    <option value="">선택</option>
                                    <? foreach ($delivery_company_list as $index => $data): ?>
                                        <option value="<?= $data['code'] ?>"
                                                data-name="<?= $data['name'] ?>" <?= get_selected($shippingArr['companyNo'], $data['code']) ?>><?= $data['name'] ?></option>
                                    <? endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>운송장 번호</td>
                            <td><input type="text" class="border_gray" id="ExchangeReturn_ResendInfo_InvoiceNo"/></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box_white table" id="ExchangeReturn_return_radio3_refund" style="display: none">
                    <table>
                        <tbody>
                        <!-- 날짜 보내는 api없음
                        <tr>
                            <td>재발송일자</td>
                            <td><input type="date" class="border_gray" id="ReturnExchange_ResendInfo_ResendDate"/></td>
                        </tr>
                        -->
                        <tr>
                            <td>보류사유</td>
                            <td>
                                <select id="ExchangeReturn_ResendInfo_HoldReason">
                                    <option value="0">기타유보사유</option>
                                    <option value="2">추가반품비청구(기타반품비)</option>
                                    <option value="4">반품미입고</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>보류상세사유</td>
                            <td><input type="text" class="border_gray" id="ExchangeReturn_ResendInfo_HoldReasonDetail"/>
                            </td>
                        </tr>
                        <tr>
                            <td>추가반품배송비</td>
                            <td><input type="number" class="border_gray" id="ExchangeReturn_ReturnShippingFee"
                                       value="0"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderExchangeReturn_modal()">확인</button>
            </div>


            <script>
                $(document).ready(function () {

                    $('#ExchangeReturn_return_radio1_Y').on('click', function () {
                        $('#ExchangeReturn_return_radio2').show();
                        $('#ExchangeReturn_return_radoi2_hide').focus();
                    });

                    $('#ExchangeReturn_return_radio1_N').on('click', function () {
                        hideAndResetElement('ExchangeReturn_return_radio2');
                        hideAndResetElement('ExchangeReturn_return_radio_refund');
                        hideAndResetElement('ExchangeReturn_return_radio3_refund');
                        hideAndResetElement('ExchangeReturn_return_radio3');
                    });

                    $('#ExchangeReturn_return_radio2_Y').on('click', function () {
                        $('#ExchangeReturn_return_radio_refund').show();
                        $('#ExchangeReturn_return_radio_refund_hide').focus();
                    });

                    $('#ExchangeReturn_return_radio2_N').on('click', function () {
                        hideAndResetElement('ExchangeReturn_return_radio_refund');
                        hideAndResetElement('ExchangeReturn_return_radio3_refund');
                        hideAndResetElement('ExchangeReturn_return_radio3');
                    });

                    $('#ExchangeReturn_return_radio_refund_Y').on('click', function () {
                        $('#ExchangeReturn_return_radio3').show();
                        $('#ExchangeReturn_ResendInfo_InvoiceNo').focus();
                        hideAndResetElement('ExchangeReturn_return_radio3_refund');
                    });

                    $('#ExchangeReturn_return_radio_refund_N').on('click', function () {
                        $('#ExchangeReturn_return_radio3_refund').show();
                        $('#ExchangeReturn_ReturnShippingFee').focus();
                        hideAndResetElement('ExchangeReturn_return_radio3');
                    });
                });
            </script>
        </div>
    </div>
</div>
<!-- 교환관리 수거택배 정보수정 -->
<div class="modal fade" id="orderExchangeDeliEditModal" tabindex="-1" aria-labelledby="orderExchangeDeliEditModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderExchangeDeliEditModalLabel">교환관리 수거택배 정보수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <h2 class="popstit">현재 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td id="orderExchangeDeliEdit_TakbaeName">경동택배</td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td id="orderExchangeDeliEdit_NoSongjang">567891</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h2 class="popstit">수정 배송 정보</h2>
                    <div class="table">
                        <table>
                            <tbody>
                            <tr>
                                <th>택배사명</th>
                                <td>
                                    <div class="input_select">

                                        <select class="border_gray" id="orderExchangeDeliEdit_companyNo2"
                                                style="width: 200px;"
                                                onchange="$('#orderExchangeDeliEdit_companyNo_input').val(this.value);$('#orderExchangeDeliEdit_takbaeName_input').val($('#orderExchangeDeliEdit_companyNo2 option:selected').data('name'))">
                                        </select>

                                        <input type="hidden" id="orderExchangeDeliEdit_companyNo_input">
                                        <input type="hidden" id="orderExchangeDeliEdit_takbaeName_input">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>운송장번호</th>
                                <td><input type="text" class="border_gray" id="orderExchangeDeliEdit_InvoiceNo"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" onclick="orderExchangeDeliEdit_modal()">수정</button>
            </div>
        </div>
    </div>
</div>



