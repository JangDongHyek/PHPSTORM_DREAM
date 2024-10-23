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
			//shipFreeYn: document.querySelector(`[name="shipFreeYn[${idx}]"]`).value, // 우선순위
			useYn: document.querySelector(`[name="useYn[${idx}]"]`).value, // 노출상태
			del_yn: document.querySelector(`[name="del_yn[${idx}]"]`).value, // 삭제상태
			order: document.querySelector(`[name="order[${idx}]"]`).value, // 우선순위
			price: document.querySelector(`[name="price[${idx}]"]`).value, // 판매가격
			//agency_fee: document.querySelector(`[name="agency_fee[${idx}]"]`).value, // 에이전시 판매수수료
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
	const deliveryFee = document.querySelector('[name=deliveryFee]').value;
	const freeShipOverAmt = document.querySelector('[name=freeShipOverAmt]').value;

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

// api token설정
const setDefaultToken = async (mode) => {
	const defModal = $('#apiTokenModal');

	if (!mode) {
		defModal.modal();
		return false;
	}

	// 저장
	const apiId = document.querySelector('[name=apiId]').value;
	const apiPass = document.querySelector('[name=apiPass]').value;

	if(mode == 'ACCESS'){
		var response = await fetchData(`/apiAdmin/updateApiAccessToken`, {apiId, apiPass});
	}else{
		var response = await fetchData(`/apiAdmin/updateApiUseToken`, {apiId, apiPass});
	}

	console.log(response);
	if (response.result) {
		showAlert('저장이 완료되었습니다.', () => {
			defModal.modal('hide');
			history.go(0);
		});
	} else {
		showAlert(`저장에 실패했습니다.`, () => {
			location.reload();
		});
	}

}

// api 상품목록불러오기
const getApiProductList = async (mode) => {

	const confirmResult = await showConfirm('API 상품목록을 갱신하시겠습니까?');
	if (confirmResult.isConfirmed !== true) return false;

	$('#loadings').show();
	var response = await fetchData(`/apiAdmin/GetApiProductList`, { confirmResult,confirmResult });
	console.log(response);

	if (response.ERRCODE == 'E0000') {
		$('#loadings').fadeOut(500);
		showAlert('저장이 완료되었습니다.', () => {
			history.go(0);
		});
	}else if (response.ERRCODE == 'E0002') {
		
		//토큰에러면 한번더 실행해서 토큰업뎃하고 다시시도
		var response2 = await fetchData(`/apiAdmin/GetApiProductList`, { confirmResult,confirmResult });
		console.log(response2);
		
		if (response2.ERRCODE == 'E0000') {
			$('#loadings').fadeOut(500);
			showAlert('저장이 완료되었습니다.', () => {
				history.go(0);
			});
		}else{
			$('#loadings').fadeOut(500);
			setDefaultToken('ACCESS');
			showAlert('다시 시도해주세요.', () => {
				history.go(0);
			});
		}

	} else {
		$('#loadings').fadeOut(500);
		showAlert(`저장에 실패했습니다.` + response.ERRCODE, () => {
			$('#loadings').hide();
			location.reload();
		});
	}
}

var getAgencyFeeIdx = 0;
// 에이전시 수수료 셋팅
const getAgencyFee = async (idx) => {

	if(!idx){
		idx = getAgencyFeeIdx;
	}else{
		getAgencyFeeIdx = idx;
	}

	const listData = [];
	const agency_fee_search_form = document.agency_fee_search_form; // 검색 폼
	const formData = new FormData(agency_fee_search_form);
	formData.append('sfl', 'agency');
	formData.append('stx', $('#agency_fee_search').val());

	const response = await fetchData(`/agency/getAgencyMember`, formData);
	const response2 = await fetchData(`/apiAdmin/getProductInfo`, {idx});


	$('#agency_fee_title').html(response2['result']['PRODUCT_NM']);

	var html = '';
	// foreach를 이용하여 테이블에 데이터 추가
	$.each(response['listData'], function(index, item) {
		var companyName = item.cn_name || item.mb_name; // 업체명이나 성명을 표시
		var mb_id = item.mb_id; // id

		// 테이블의 tbody에 데이터 추가
		html += `
        <tr>
            <td class="text_left">
                ${companyName} | ${item.mb_name}<br>
                <b>${mb_id}</b>
            </td>
            <td class="text_right">
                <div class="flex ai-c end">
                    <input type="number" name="modal_agency_fee[]" data-mb_id="${mb_id}" data-product_idx="${idx}" placeholder="정산 수수료"/>
                    %
                </div>
            </td>
        </tr>
    `;

	});

	$('#agency_fee_list').html(html);

	try {
		const response3 = await fetchData(`/agency/getAgencyFee`, { idx });
		console.log(response3);  // 응답 구조 확인용

		// 응답이 제대로 있는지 확인 후 처리
		if (response3 && response3.result && Array.isArray(response3.result.listData)) {
			// 테이블에 들어간 데이터를 대상으로 fee 값 설정
			$.each(response3.result.listData, function(index, feeItem) {
				var mb_id = feeItem.mb_id;
				var fee = feeItem.fee;

				// 해당 mb_id를 가진 input 요소를 찾아서 value 값에 fee를 넣어줌
				var inputElement = $(`input[data-mb_id="${mb_id}"]`);
				if (inputElement.length > 0) {
					inputElement.val(fee);
				}
			});
		} else {
			console.error("response3.result.listData가 올바른 배열이 아닙니다.");
		}
	} catch (error) {
		console.error("데이터를 가져오는 중 오류 발생:", error);
	}

}

// 에이전시 수수료 저장
const setAgencyFee = async () => {

	const ids = document.querySelectorAll('input[name="modal_agency_fee[]"]');
	const listData = [];
	ids.forEach(input => {
		const mbId = input.getAttribute('data-mb_id');
		const productIdx = input.getAttribute('data-product_idx');
		const agency_fee = input.value;
		listData.push({
			mb_id: mbId, // data-mb_id 값을 추가
			product_idx: productIdx, // data-product_idx 값을 추가
			fee: agency_fee, // 에이전시 판매수수료
		});
	});

	const response = await fetchData(`/agency/setAgencyFee`, {listData});

	if (response.result) {
		showAlert('저장 성공', () => {
			location.reload();
		});
	} else {
		showAlert(`일괄변경에 실패했습니다.`);
	}



}



// 에이전시 일괄 수수료 셋팅
const getAgencyFeeAll = async () => {


	const response = await fetchData(`/agency/getAgencyMember`, {});

	var html = '';
	// foreach를 이용하여 테이블에 데이터 추가
	$.each(response['listData'], function(index, item) {
		var companyName = item.cn_name || item.mb_name; // 업체명이나 성명을 표시
		var mb_id = item.mb_id; // id
		var idx = item.product_idx; // product_idx

		// 데이터를 출력하는 span 태그 구조
		html += `
        <span>
            <input type="checkbox" id="agencyId_${mb_id}" name="checkedAgencyId[]" value="${mb_id}">
            <label for="agencyId_${mb_id}">${mb_id} | ${companyName} (${item.mb_name})</label>
        </span>
    `;

	});

	$('#agency_fee_all_list').html(html);
}

// 에이전시 일괄 수수료 셋팅
const setAgencyFeeAll = async () => {
	const listData = [];
	const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
	checkboxes.forEach((checkbox) => {
		var product_idx = checkbox.value;

		// 중첩된 반복문으로 checkedAgencyId[] 배열을 순회
		const checkedAgencyIds = document.querySelectorAll('input[name="checkedAgencyId[]"]:checked');

		var modal_agency_fee_all = $('#modal_agency_fee_all').val();
		checkedAgencyIds.forEach((agencyCheckbox) => {
			var mb_id = agencyCheckbox.value; // 체크된 checkedAgencyId의 value 값

			// 체크된 항목에 대한 데이터를 배열에 추가
			listData.push({
				mb_id: mb_id, // checkedAgencyId의 value 값 (아이디)
				product_idx: product_idx,
				fee: modal_agency_fee_all,
			});
		});
	});



	const response2 = await fetchData(`/agency/setAgencyFee`, {listData});

	if (response2.result) {
		showAlert('저장 성공', () => {
			location.reload();
		});
	} else {
		showAlert(`일괄변경에 실패했습니다.`);
	}

}
