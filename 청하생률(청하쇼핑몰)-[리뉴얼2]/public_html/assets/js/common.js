/**
 * 공통함수
 */
$(function () {
	// 전화번호 입력양식 공통
	const telElements = document.querySelectorAll('input.telCheck');
	telElements.forEach(input => {
		input.addEventListener('keyup', () => {
			input.value = addHyphenTel(input.value);
		})
	});

})


// AJAX POST
const fetchData = async (url, bodyData, method = "POST") => {
	let requestOptions = {
		method: method, headers: {}, body: bodyData,
	};

	if (typeof bodyData === "object" && !(bodyData instanceof FormData)) {
		requestOptions.body = JSON.stringify(bodyData);
		requestOptions.headers["Content-Type"] = "application/json";
		requestOptions.headers["X-Requested-With"] = "XMLHttpRequest";
	}

	// GET 요청시 파라미터는 queryString으로만
	if (method == "GET") requestOptions = null;

	try {
		const apiHost = (baseUrl.endsWith('/'))? baseUrl.slice(0, -1) : baseUrl;
		const response = await fetch(apiHost + url, requestOptions);
		const data = await response.json();
		// console.log(`data:\n`, data);

		if (!response.ok) {
			// response 에러 -> catch
			throw new Error('Network response was not ok');
		}

		return data;

	} catch (error) {
		console.log('fetchJSON() error:\n', error);
		// throw error;
		return {result: false, message: '서버와의 통신에 실패했습니다.'};

	} finally {
		showLoading(0);
	}
}

// AJAX page load
const fetchHtml = async (url, element, method) => {
	try {
		const apiHost = (baseUrl.endsWith('/'))? baseUrl.slice(0, -1) : baseUrl;
		const response = await fetch(apiHost + url);
		const content = await response.text();

		if (element) {
			if (method == "append") {
				// element.innerHTML = "";
				element.insertAdjacentHTML('beforeend', content);
			} else {
				element.innerHTML = content;
			}
		}

	} catch (error) {
		console.log('fetchJSON() error:\n', error);
		// throw error;
		return {result: false, message: '서버와의 통신에 실패했습니다.'};
	}
}

// // AJAX page load
// const fetchHtml = async (url, elementId) => {
//     try {
//         const response = await fetch(url);
//         const content = await response.text();
//         document.getElementById(elementId).innerHTML = content;
//
//     } catch (error) {
//         console.log('fetchJSON() error:\n', error);
//         // throw error;
//         return {result: false, message: '서버와의 통신에 실패했습니다.'};
//     }
// }

// swal 기본 스타일
const showAlert = (message, destroyEvent) => {
	swal.fire({
		html: message,
		confirmButtonText: '확인',
		didDestroy: () => {
			if (destroyEvent) destroyEvent();
		},
	});
}
// confirm
const showConfirm = (message) => {
	return Swal.fire({
		html: message,
		confirmButtonText: '확인',
		denyButtonText: '취소',
		showDenyButton: true
	});
}

// 사업자등록번호 하이픈 생성
// 4~5자리 : 면허번호
// 10자리 : 사업자번호
const addHyphenBrno = (value) => {
	const brno = value.replace(/[^0-9]/g, "");
	let formatted = '';

	// if (brno.length <= 3) {
	//     formatted = brno;
	// } else if (brno.length <= 5) {
	//     formatted = brno.slice(0, 3) + '-' + brno.slice(3);
	if (brno.length <= 5) {
		formatted = brno;
	} else {
		formatted = brno.slice(0, 3) + '-' + brno.slice(3, 5) + '-' + brno.slice(5, 10);
	}
	return formatted.slice(0, 12);
}

// 생년월일 하이픈 생성
const addHyphenBirth = (value) => {
	const birth = value.replace(/[^0-9]/g, "");
	let formatted = '';
	if (birth.length > 4) {
		formatted += birth.substr(0, 4);
		if (birth.length < 6) {
			formatted += '-' + birth.substr(4, 2);
		} else {
			formatted += '-' + birth.substr(4, 2);
			formatted += '-' + birth.substr(6);
		}
	} else {
		formatted += birth;
	}
	return formatted.slice(0, 10);
}

// 휴대폰번호, 대표전화 하이픈 생성
const addHyphenTel = (value) => {
	if (!value) return '';
	let formatted = value.replace(/[^0-9]/g, "");
	if (formatted.length > 11) {
		return value.slice(0, 13);
	}

	let result = [];
	let restNumber = "";

	// 지역번호와 나머지 번호로 나누기
	if (formatted.startsWith("02")) {
		// 서울 02 지역번호
		result.push(formatted.substr(0, 2));
		restNumber = formatted.substring(2);
	} else if (formatted.startsWith("1")) {
		// 지역 번호가 없는 경우
		// 1xxx-yyyy
		restNumber = formatted;
	} else {
		// 나머지 3자리 지역번호
		// 0xx-yyyy-zzzz
		result.push(formatted.substr(0, 3));
		restNumber = formatted.substring(3);
	}

	if (restNumber.length === 7) {
		// 7자리만 남았을 때는 xxx-yyyy
		result.push(restNumber.substring(0, 3));
		result.push(restNumber.substring(3));
	} else {
		result.push(restNumber.substring(0, 4));
		result.push(restNumber.substring(4));
	}

	return result.filter((val) => val).join("-");
}

// 문자열 공백제거
const removeWhitespace = (str) => {
	return str ? str.replace(/\s+/g, '') : '';
}

// 숫자 천단위 콤마
const addCommaNumber = (value, isNegative) => {
	let minusSign = '';
	if (typeof value === 'string' && isNegative === true) { // 음수표현
		if (value.startsWith('-')) minusSign = '-';
	}
	value = numberChk(value);
	if (value.startsWith('0') && value.length > 1) value = value.slice(1);
	return value == 0 ? "0" : minusSign + value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// 숫자 콤마 제거
const removeCommaNumber = (value) => {
	return Number(value.replace(/,/gi, ''));
}

// 숫자만 입력
const numberChk = (value) => {
	if (!value) value = '';
	return value.toString().replace(/[^(\d)]/g, "");
}

// 숫자형 반환
const toNumber = (value) => {
	const num = parseInt(numberChk(value));
	return isNaN(num) ? 0 : num;
}

// 소수점 - 숫자 천단위 콤마
const addCommaDecimal = (value) => {
	value = decimalChk(value);
	return value.toString().replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// 소수점 - 숫자/콤마/소수점 입력
const decimalChk = (value) => {
	value = value.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

	// 소수점 2번째 자리까지
	let regExp = /^\d*.?\d{0,2}$/;
	if(!regExp.test(value)) {
		value = isNaN(value) ? 0 : Number(value).toFixed(2)
	}

	return value;
}

// 체크박스 전체선택
// onclick="selectAllCheckbox(this, 'checkIdx')"
const selectAllCheckbox = (element, name) => {
	const checkboxes = document.querySelectorAll(`input[name="${name}"]`);
	checkboxes.forEach((checkbox) => {
		if (!checkbox.disabled)
			checkbox.checked = element.checked;
	});
}

// Date to YYYY-mm-dd 포맷변환
function formatDate(date) {
	let year = date.getFullYear();
	let month = ('0' + (date.getMonth() + 1)).slice(-2);
	let day = ('0' + date.getDate()).slice(-2);
	return `${year}-${month}-${day}`;
}

// 날짜기간 생성
const getStartAndEndDate = (rangeType) => {
	let returnDateRange = {start: '', end: ''};
	const today = new Date();
	const now = dayjs();

	switch (rangeType.toString()) {
		case "1" : // 오늘
			returnDateRange.start = formatDate(today);
			returnDateRange.end = formatDate(today);
			break;

		case "2" : // 이번주
			let firstDay = today.getDate() - today.getDay() + 1;
			let lastDay = firstDay + 6;
			let firstDate = new Date(today.setDate(firstDay));
			// let lastDate = new Date(today.setDate(lastDay));
			// returnDateRange.start = formatDate(firstDate);
			// returnDateRange.end = formatDate(lastDate);
			let firstDateFormat = formatDate(firstDate);
			let lastDate = dayjs(firstDateFormat).add(6, 'day');
			let lastDateFormat = lastDate.format('YYYY-MM-DD');
			returnDateRange.start = firstDateFormat;
			returnDateRange.end = lastDateFormat;
			break;

		case "3" : // 이번달
			let thisMonthFirstDay = new Date(today.getFullYear(), today.getMonth(), 1);
			let thisMonthLastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
			returnDateRange.start = formatDate(thisMonthFirstDay);
			returnDateRange.end = formatDate(thisMonthLastDay);
			break;

		case "4" : // 지난달
			let lastMonthFirstDay = new Date(today.getFullYear(), today.getMonth() - 1, 1);
			let lastMonthLastDay = new Date(today.getFullYear(), today.getMonth(), 0);
			returnDateRange.start = formatDate(lastMonthFirstDay);
			returnDateRange.end = formatDate(lastMonthLastDay);
			break;
	}

	return returnDateRange;
}

// (상단 검색 공통) 기간선택
const changeDateRange = (value) => {
	const searchFrm = document.searchFrm;
	if (searchFrm) {
		const dateList = getStartAndEndDate(value);
		searchFrm.sdt.value = dateList.start;
		searchFrm.edt.value = dateList.end;
		showLoading(1);
		searchFrm.dispatchEvent(new Event('submit'));
	}
}
// (상단 검색 공통) 날짜선택
const changeInputDate = (value) => {
	const searchFrm = document.searchFrm;
	if (searchFrm) {
		const radios = document.querySelectorAll('[name=dtRange]');
		radios.forEach(radio => {
			radio.checked = false;
		});
		searchFrm.dispatchEvent(new Event('submit'));
	}
}

// 팝업 생성
const createPopup = (url, name, width = 700, height = 500) => {
	const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	const screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
	const left = (screenWidth / 2) - (width / 2);
	const top = (screenHeight / 2) - (height / 2);
	const options = `width=${width},height=${height},left=${left},top=${top},scrollbars=yes,resizable=yes`;
	const popup = window.open(url, name, options);

	if (window.focus) {
		popup.focus();
	}
}

// 환자과거처방 팝업열기
const openPatientHistoryPopup = (pateintIdx) => {
	if (!pateintIdx) {
		showAlert('환자를 선택하세요.');
		return false;
	}
	createPopup(`/patientHistory?idx=${pateintIdx}`, '과거처방내역', 700, 1000);
}

// 결제정보 팝업열기
const openPaymentInfoPopup = (paymentIdx) => {
	if (!paymentIdx) {
		showAlert('결제정보를 불러오는데 실패했습니다.');
		return false;
	}
	createPopup(`/api/paymentInfo/${paymentIdx}`, '결제정보 상세보기');
}

/**
 * 폼 초기화
 * @param name: form name
 * @param except: 초기화 제외 hidden name (array)
 */
const clearForm = (name, except) => {
	const form = document.querySelector(`form[name="${name}"]`);
	form.reset();

	const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
	hiddenInputs.forEach(input => {
		if (except) {
			if (!except.includes(input.name)) input.value = '';
		} else {
			input.value = '';
		}
	});
}

/**
 * 삭제/선택삭제 (공통)
 * @param fetchURL: API URL
 * @param idx: 삭제 idx
 * (선택삭제 시 checkbox name check)
 */
const commonActionDelete = async (fetchURL, idx) => {
	const idxArr = [];

	if (idx) {
		// 삭제
		idxArr.push(idx);
	} else {
		// 선택삭제
		const checkboxes = document.querySelectorAll('input[name="checkIdx"]:checked');
		checkboxes.forEach((checkbox) => {
			idxArr.push(checkbox.value);
		});
	}

	if (idxArr.length == 0) {
		showAlert(`삭제할 항목을 선택하세요.`);
		return false;
	}
	// console.log(idxArr);

	const confirmResult = await showConfirm('삭제하시겠습니까?');
	if (confirmResult.isConfirmed !== true) {
		return false;
	}

	const response = await fetchData(`${fetchURL}`, {idxArr});
	// console.log(response);
	if (response.result) {
		showAlert(`삭제가 완료되었습니다.`, () => {
			location.reload();
		});
	} else {
		let message = response.message ? response.message : `삭제에 실패하였습니다.`;
		showAlert(message);
	}
}

/**
 * 등록 (공통)
 * @param fetchURL: API URL
 * @param formData: formData
 * @param gubun: 등록/수정
 * @param url: 등록/수정 후 이동 url
 * @param isAlert: 알림창여부
 */
const commonActionRegister = async (fetchURL, formData, gubun, url, isAlert) => {
	const response = await fetchData(`${fetchURL}`, formData);
	// console.log(response);
	if (response.result) {
		if (isAlert == false) { // alert 패스
			location.reload();
		} else {
			showAlert(`${gubun} 완료되었습니다.`, () => {
				if (url) location.replace(url);
				else location.reload();
			});
		}
	} else {
		let message = response.message ? response.message : `${gubun}에 실패했습니다.`;
		showAlert(message);
	}
}

/**
 * 엑셀다운로드
 * @param target: 엑셀구분(메뉴명..)
 */
const commonExcelDownload = async (target) => {
	const parameter = (location.search ? location.search + '&' : '?') + `excel=${target}`;
	console.log(parameter);
	location.href = baseUrl + `excel/download${parameter}`;
}

/**
 * 엑셀업로드 (공통)
 * @param input: 파일업로드 element
 * @param target: 엑셀구분(메뉴명..)
 */
const commonExcelUpload = async (input, target) => {
	showLoading(1);

	const file = input.files[0];
	const formData = new FormData();
	formData.append('uploaded_file', file);
	formData.append('target', target);

	const response = await fetchData('/excel/upload', formData);
	if (response.result) {
		showAlert(`엑셀업로드가 완료되었습니다.`, () => {
			location.reload();
		});
	} else {
		let message = `엑셀업로드에 실패했습니다.`;
		showAlert(message);
		showLoading(0);
	}
}

// formData를 JSON 객체로 변환
const formToJson = (form) => {
	const formData = new FormData(form);
	const json = {};

	for (const [key, value] of formData.entries()) {
		// const inputElement = form.querySelector(`[name="${key}"]`);
		// if (inputElement && inputElement.type === 'checkbox') {
		//     if (inputElement.checked) {
		//         json[key] = json[key] || [];
		//         json[key].push(value);
		//     }
		// } else {
		//     json[key] = value;
		// }
		const inputElements = Array.from(form.querySelectorAll(`[name="${key}"]`));
		const firstElement = inputElements[0];

		if (firstElement && firstElement.type === 'checkbox') {
			if (!json[key]) {
				json[key] = [];
				inputElements.forEach((element) => {
					if (element.checked) {
						json[key].push(element.value);
					}
				});
			}
		} else {
			json[key] = value;
		}
	}

	return json;
}

// queryString 생성
const serializeForm = (form, skipEmptyValue = false) => {
	const formData = new FormData(form);
	const queryArr = [];

	for (const [name, value] of formData.entries()) {
		if (!skipEmptyValue) {
			queryArr.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
		} else {
			if (value !== "") queryArr.push(`${encodeURIComponent(name)}=${encodeURIComponent(value)}`);
		}
	}

	return queryArr.join('&');
}

/**
 * 로딩
 * @param show: 1(show) / 0(hide)
 */
const showLoading = (show) => {
	let loading = document.getElementById("loading");
	if (loading) loading.style.display = (show) ? "block" : "none";
}

/**
 * fetchHtml 페이징
 * @param page: 현재페이지
 * @param modalFrm: 검색 form
 * @param modalFunc: 실행 function
 */
const fetchHtmlPaging = (page, modalFrm, modalFunc) => {
	if (!page || !modalFunc) return;
	modalFrm.page.value = page;
	modalFunc();
}

// SMS문자발송 팝업
const sendSMS = () => {
	const url = `/sendSms`;
	createPopup(url, 'SMS 발송', 800, 580);
}

// 계정 전환
const changeAccount = async (curAdmin, mb_id, name) => {
	const existingForm = document.getElementById("changeForm");
	if(existingForm) {
		document.body.removeChild(existingForm);
	}

	if (curAdmin == 'Y') {
		const confirmResult = await showConfirm(`<strong>${name}(${mb_id})</strong><br/>전환하시겠습니까?`);
		if (confirmResult.isConfirmed !== true) return false;
	}

	const form = document.createElement("form");
	form.setAttribute("id", "changeForm");
	form.setAttribute("method", "post");
	form.setAttribute("action", "/api/changeMemberAccount");

	const input1 = document.createElement("input");
	input1.setAttribute("type", "hidden");
	input1.setAttribute("name", "mb_id");
	input1.setAttribute("value", mb_id);
	form.appendChild(input1);

	const input2 = document.createElement("input");
	input2.setAttribute("type", "hidden");
	input2.setAttribute("name", "curAdmin");
	input2.setAttribute("value", curAdmin);
	form.appendChild(input2);

	document.body.appendChild(form);
	form.submit();
}

// 쿠키 굽기
const setCookie = (name, value, hours) => {
	const date = new Date();
	date.setTime(date.getTime() + (hours*60*60*1000));
	//date.setTime(date.getTime() + (minutes*60*1000)); // 분
	document.cookie = `${name}=${value};expires=` + date.toUTCString() + ';path=/';
}

// 쿠키 가져오기
const getCookie = (name) => {
	const value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
	return value? value[2] : null;
}

// 검색필터 그룹 전체선택
const selectAllGroup = () => {
	const searchFrm = document.searchFrm;
	if (typeof searchFrm == 'undefined') return;

	const groups = searchFrm.querySelectorAll('[name=group]');
	const isAnyCheckboxUnchecked = Array.from(groups).some(input => !input.checked);

	groups.forEach(input => {
		input.checked = isAnyCheckboxUnchecked;
	});
	searchFrm.dispatchEvent(new Event('submit'));
}

/**
 * 스마트택배 API
 * @param courier: 택배사코드
 * @param trackingNo: 운송장번호
 */
const smartTracker = (courier, trackingNo) => {
	const trackingFrm = document.trackingFrm;
	trackingFrm.t_code.value = courier;
	trackingFrm.t_invoice.value = trackingNo;
	// trackingFrm.target = "_blank";
	// trackingFrm.submit();

	createPopup('', 'smartTracker', 500, 800);
	trackingFrm.target = 'smartTracker';
	trackingFrm.submit();
}

// 쇼핑몰 헤더, 사이드 약재검색
const mallCommonSearch = (f) => {
	if (f.hstx && f.hstx.value.length === 1) {
		showAlert("검색어를 2글자 이상 입력해 주세요.");
	} else {
		location.href = `${baseUrl}medicinal?hstx=${f.hstx.value}`;
	}

	return false;
}

// 이메일 양식 체크
const isValidEmail = (email) => {
	let pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	return pattern.test(email);
}

function maxLengthCheck(object){ if (object.value.length > object.maxLength){ object.value = object.value.slice(0, object.maxLength); }}