/**
 * 주문서
 */
const orderFrm = document.order;

// 주소검색 팝업열기
orderFrm.ordAddr.addEventListener('click', (e) => {
	e.preventDefault();
	const formNames = ['ordAddr', 'ordZcode', 'ordAddrDetail'];
	openDaumAddress(formNames);
});
orderFrm.ordAddr.addEventListener('keydown', (e) => {
	e.preventDefault();
	const formNames = ['ordAddr', 'ordZcode', 'ordAddrDetail'];
	openDaumAddress(formNames);
});
orderFrm.recAddr.addEventListener('click', (e) => {
	e.preventDefault();
	orderFrm.recAddr.value = "";
	orderFrm.recAddrDetail.value = "";
	orderFrm.recZcode.value = "";
	const formNames = ['recAddr', 'recZcode', 'recAddrDetail'];
	openDaumAddress(formNames);
});
orderFrm.recAddr.addEventListener('keydown', (e) => {
	e.preventDefault();
	const formNames = ['recAddr', 'recZcode', 'recAddrDetail'];
	openDaumAddress(formNames);
});

// 받는사람-주문자정보와 동일
document.querySelector('#sameInfo').addEventListener('click', (e) => {
	if (e.target.checked) {
		orderFrm.recName.value = orderFrm.ordName.value;
		orderFrm.recAddr.value = orderFrm.ordAddr.value;
		orderFrm.recAddrDetail.value = orderFrm.ordAddrDetail.value;
		orderFrm.recZcode.value = orderFrm.ordZcode.value;
		orderFrm.recTel.value = orderFrm.ordTel.value;
		getSendCost2();
		//63365
	} else {
		initDeliInfo();
	}
});
// 받는사람-초기화
const initDeliInfo = () => {
	orderFrm.recName.value = "";
	orderFrm.recAddr.value = "";
	orderFrm.recAddrDetail.value = "";
	orderFrm.recZcode.value = "";
	orderFrm.recTel.value = "";
	orderFrm.sameInfo.checked = false;
}

const getSendCost2 = async () => {
	// 추가배송비 가져오기
	const formData = new FormData(orderFrm);
	const sendcost2 = await fetchData('/api/addSendCost2', formData);
	console.log(sendcost2);
	if(sendcost2.result){
		$('#deliveryFee2_box1').show();
		$('#deliveryFee2_box2').show();
		$('#deliveryFee2_cost_txt').text(addCommaNumber(sendcost2.delivery_fee2));
		orderFrm.totalPrice.value = orderFrm.totalPrice_old.value*1 + sendcost2.delivery_fee2*1;
		showAlert('추가배송비<br>' + addCommaNumber(sendcost2.delivery_fee2));
	}else{
		$('#deliveryFee2_box1').hide();
		$('#deliveryFee2_box2').hide();
		$('#deliveryFee2_cost_txt').text(0);
		orderFrm.totalPrice.value = orderFrm.totalPrice_old.value*1;
	}

	$('#totalPrice_txt').html(addCommaNumber(orderFrm.totalPrice.value) + '원');
}
// 결제수단 변경시
const changePayMethod = (value) => {
	if (!value) return;
	const wrap = document.querySelector('#cash_info_wrap');
	if (value === 'CASH') wrap.style.display = 'block';
	else wrap.style.display = 'none';
}

// 발행목록 선택변경 (1:계산서,2:현금영수증,3:미발행)
const changeIssueType = (value) => {
	const selectTab = document.querySelector(`#issue_tab${value}`);
	document.querySelectorAll('#issue_tab1, #issue_tab2, #issue_tab3').forEach(tab => {
		tab.style.display = 'none';
	});
	selectTab.style.display = "block";
}

// 현금영수증 발급분류 선택변경 (1:개인, 2:사업자)
const changeCashReceiptType = (select) => {
	const value = select.value;
	const authNum = select.options[select.selectedIndex].getAttribute('data-num'); // 휴대폰번호or사업자번호
	const labelElement = document.querySelector('#labelReceiptAuth');

	if (value == "1") labelElement.innerHTML = '발급휴대폰번호';
	else labelElement.innerHTML = '발급사업자번호';
	document.querySelector('input[name=cashReceiptAuthNum]').value = authNum;
}

// 결제하기 폼검사
const productOrderSubmit = async () => {
	// 필드 검사
	const fields = [
		{ field: orderFrm.ordName, message: '주문자 성함을 입력해 주세요.' },
		{ field: orderFrm.ordAddr, message: '주문자 기본주소를 입력해 주세요.' },
		{ field: orderFrm.ordTel, message: '주문자 전화번호를 입력해 주세요.' },
		{ field: orderFrm.recName, message: '받는사람 성함을 입력해 주세요.' },
		{ field: orderFrm.recAddr, message: '받는사람 기본주소를 입력해 주세요.' },
		{ field: orderFrm.recAddrDetail, message: '받는사람 상세주소를 입력해 주세요.' },
		{ field: orderFrm.recTel, message: '받는사람 전화번호를 입력해 주세요.' },
	];
	// 결제정보-현금결제 필드 검사
	if (orderFrm.payMethod.value == 'CASH') {
		if (orderFrm.cashIssueType.value == '1') { // 계산서
			fields.push({ field: orderFrm.invoiceBizNum, message: '계산서 선택시 사업자번호를 입력해 주세요.'});
			fields.push({ field: orderFrm.invoiceEmail, message: '계산서 선택시 이메일을 입력해 주세요.' });
			fields.push({ field: orderFrm.invoiceRepName, message: '계산서 선택시 대표자명을 입력해 주세요.' });
		} else if (orderFrm.cashIssueType.value == '2') { // 현금영수증
			fields.push({ field: orderFrm.cashReceiptAuthNum, message: '현금영수증 선택시 발급번호를 입력해 주세요.'});
		}
	}

	for (const { field, message } of fields) {
		if (field.value == '') {
			return showAlert(message, () => { field.focus() });
		}
	}

	const confirmResult = await showConfirm('결제하시겠습니까?');
	if (confirmResult.isConfirmed !== true) return false;

	// 결제전 주문서 등록
	const formData = new FormData(orderFrm);

	//추가배송비 wc
	const sendcost2 = await fetchData('/api/addSendCost2', formData);
	if(sendcost2.result){
		//showAlert('추가배송비<br>' + addCommaNumber(sendcost2.delivery_fee2));
	}


	const response = await fetchData('/api/addProductOrder', formData);
	console.log(response);
	if (!response.result) {
		showAlert('주문서 등록에 실패했습니다.<br>잠시 후 다시 시도해 주세요.');
		return false;
	}

	const orderNo = response.orderNo;

	// 결제수단별 처리
	switch (response.payMethod) {
		case "CASH" :   // 현금결제,포인트결제,월말결제 - 주문배송관리 이동
		case "POINT" :
		case "CREDIT" :
			showAlert('주문이 완료되었습니다.', () => {
				history.replaceState({data: 'replaceState'}, '', `${baseUrl}/paymentSuccess?no=${orderNo}`);
				location.reload();
			});
			break;

		case "CARD" :   // 카드결제,가상계좌 - PG 실행
		case "VBANK" :
			const payData = {
				'payMethod': response.payMethod,
				'goodsName': '상품주문', //response.itemName,
				'amt': orderFrm.totalPrice.value,
				'moid': orderNo,
				'mallReserved': '',
			};
			executePayment(payData);
			break;
	}

	return false;
}
