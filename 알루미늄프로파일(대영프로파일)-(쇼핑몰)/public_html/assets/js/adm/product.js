/**
 * 관리자 상품 관리
 */
const searchFrm = document.searchFrm; // 검색 폼

// 검색
searchFrm.addEventListener('submit', async (e) => {
	e.preventDefault();

	// 검색어 2글자 이상
	if(e.target.stx.value.length === 1) return showAlert("검색어를 2글자 이상 입력해 주세요.");
	searchFrm.submit();
});

// 검색 필터
const searchFilter = (filter, value) => {
	searchFrm[filter].value = value;
	// searchFrm.submit();
	location.href = `?` + serializeForm(searchFrm, true);
}

// 기본배송비설정(배송비, 무료배송조건), 목록(우선순위) 입력시 콤마
document.addEventListener('keyup', (e) => {
	if (e.target && typeof e.target.name === 'string') {
		const name = e.target.name;
		if (name == 'deliveryFee' || name == 'freeShipOverAmt' || name.indexOf('price[') == 0)
			e.target.value = addCommaNumber(e.target.value + "");
	}
});


// 상품 삭제
const deleteProduct = async (idx) => {
	if (!idx) return;
	const confirmResult = await showConfirm('선택하신 상품을 삭제하시겠습니까?');
	if (confirmResult.isConfirmed !== true) return false;

	const response = await fetchData(`/apiAdmin/deleteProduct`, {idx});
	if (response.result) {
		showAlert('상품 삭제가 완료되었습니다.', () => {
			location.reload();
		});
	} else {
		showAlert(`상품 삭제에 실패했습니다.`);
	}
}

// 목록 - 일괄수정
document.querySelector('button#modifyList').addEventListener('click', async (e) => {
	e.preventDefault();

	const confirmResult = await showConfirm('목록 데이터를 일괄수정 하시겠습니까?');
	if (confirmResult.isConfirmed !== true) return false;

	const ids = document.querySelectorAll('input[name="idx[]"]');
	const listData = [];
	ids.forEach(input => {
		const idx = input.value;
		listData.push({
			idx: idx,
			shipFreeYn: document.querySelector(`[name="shipFreeYn[${idx}]"]`).value, // 우선순위
			useYn: document.querySelector(`[name="useYn[${idx}]"]`).value, // 노출상태
			order: document.querySelector(`[name="order[${idx}]"]`).value, // 우선순위
			price: document.querySelector(`[name="price[${idx}]"]`).value, // 판매가격
		});
	});

	const response = await fetchData(`/apiAdmin/updateProductList`, {listData});

	if (response.result) {
		location.reload();
	} else {
		showAlert(`일괄변경에 실패했습니다.`);
	}
});

// 기본배송비설정
const setDefaultDelivery = async (mode) => {
	const defModal = $('#defaultDeliveryModal');

	if (!mode) {
		defModal.modal();
		return false;
	}

	// 저장
	const deliveryFee = removeCommaNumber(document.querySelector('[name=deliveryFee]').value);
	const freeShipOverAmt = removeCommaNumber(document.querySelector('[name=freeShipOverAmt]').value);

	const response = await fetchData(`/apiAdmin/updateDeliveryFee`, {deliveryFee, freeShipOverAmt});
	console.log(response);
	if (response.result) {
		showAlert('저장이 완료되었습니다.', () => {
			defModal.modal('hide');
		});
	} else {
		showAlert(`저장에 실패했습니다.`, () => {
			location.reload();
		});
	}
}
