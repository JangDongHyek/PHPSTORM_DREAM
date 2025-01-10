/**
 * 공통함수
 */
// AJAX POST, GET
async function fetchData(url, bodyData, method = "POST") {
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
        const response = await fetch(url, requestOptions);
        const data = await response.json();

        if (!response.ok) {
            // response 에러 -> catch
            throw new Error('Network response was not ok');
        }

        return data;

    } catch (error) {
        // console.log('fetchJSON() error:\n', error);
        // throw error;
        return {result: false, message: '서버와의 통신에 실패했습니다.'};

    } finally {
        showLoading(0);
    }
}

// AJAX HTML page load
async function fetchHtml(url, element, method) {
    const fetchResult = {result: false, message: '서버와의 통신에 실패했습니다.'};
    try {
        const httpResponse = await fetch(url);
        if (!httpResponse.ok) {
            throw new Error(`HTTP error! status: ${httpResponse.status}`);
        }
        const content = await httpResponse.text();

        if (element && content) {
            if (method === "append") {
                element.insertAdjacentHTML('beforeend', content);
            } else {
                element.innerHTML = content;
            }
            fetchResult.result = true;
            fetchResult.message = '성공적으로 처리되었습니다.';
        }

    } catch (error) {
        console.log('fetchJSON() error:\n', error);
        // throw error;
    }
    return fetchResult;
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

// AJAX Excel
async function fetchExcel(url, fileName) {
    try {
        showLoading(true);

        if (!fileName) fileName = '엑셀다운';

        // 파일 다운로드 요청
        const response = await fetch(url);
        if (!response.ok) throw new Error('서버와의 통신에 실패했습니다.');

        const blob = await response.blob();
        const downloadUrl = URL.createObjectURL(blob);

        const a = document.createElement("a");
        a.href = downloadUrl;
        a.download = `${fileName}.xlsx`;
        document.body.appendChild(a);
        a.click();

        URL.revokeObjectURL(downloadUrl);
        document.body.removeChild(a);

        setTimeout(() => {
            showLoading(0);
        }, 500);

    } catch (error) {
        showLoading(0);
        showError(error);

    } finally {
        //
    }
}

// swal 기본 스타일
function showAlert(message, destroyEvent, timer) {
    if (timer == undefined) timer = 0;

    swal.fire({
        html: message,
        confirmButtonText: '확인',
        timer: (timer > 0)? timer : 0,
        timerProgressBar: (timer > 0)? true : false,
        didDestroy: () => {
            if (destroyEvent) destroyEvent();
        }
    });
}

// confirm
function showConfirm(message) {
    return Swal.fire({
        html: message,
        confirmButtonText: '확인',
        denyButtonText: '취소',
        showDenyButton: true
    });
}

// toast 팝업
function showToast(message, callback = null, duration = 1200) {
    if (!message) return;

    const toast = document.getElementById("toast");
    if (!toast) return;

    toast.classList.add("show");
    toast.innerHTML = message;

    ConfigModule.setToastStatus(true);

    setTimeout(function() {
        toast.classList.remove("show");
        if (typeof callback === 'function') {
            callback();
        }
        ConfigModule.setToastStatus(false);

    }, duration);
}

// 공통 error
function showError(html, isRefresh, destroyEvent) {
    Swal.fire({
        icon: 'error',
        title: '요청 작업 실패',
        html: html? html : '서버에 일시적인 오류가 발생했어요.<br>잠시 후 다시 시도해 주세요.',
        confirmButtonText: '확인',
        // showCancelButton: true,
        // cancelButtonText: '닫기',
        timer: 3000,
        timerProgressBar: true,
        didDestroy: () => {
            if (destroyEvent) destroyEvent();
            else if (isRefresh) location.reload();
        },
    });
}

/**
 * 사업자등록번호 하이픈 생성
 * @param value: 4~5자리 = 면허번호, 10자리 = 사업자번호
 * @returns {string}
 */
function addHyphenBrno(value) {
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
function addHyphenBirth(value) {
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
function addHyphenTel(value) {
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
function removeWhitespace(str) {
    return str ? str.replace(/\s+/g, '') : '';
}

// 숫자 천단위 콤마
function addCommaNumber(value, allowNegative = false) {
    const number = numberChk(value, allowNegative);

    if (allowNegative) {
        if (number == '') return '';
        else number.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }

    return number == "0" ? "0" : number.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

// 숫자 콤마 제거
function removeCommaNumber(value) {
    return Number(value.replace(/,/gi, ''));
}

// 숫자만 입력 (음수 허용 true)
function numberChk(value, allowNegative = false) {
    if (!value) value = '0';
    let minusSign = '';
    if (allowNegative && value.startsWith('-')) minusSign = '-';

    let numberPattern = "\\d"; // 기본: 숫자만 허용
    const regex = new RegExp(`[^${numberPattern}]`, "g");
    const numberStr = value.toString().replace(regex, "");

    return (numberStr == '0')? numberStr : minusSign + numberStr;
}

// 숫자형 반환 (음수 허용 true)
function toNumber(value, allowNegative = false) {
    const num = parseInt(numberChk(value, allowNegative), 10);
    return isNaN(num) ? 0 : num;
}

// 소수점 - 숫자 천단위 콤마
function addCommaDecimal(value) {
    value = decimalChk(value);
    return value.toString().replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// 소수점 - 숫자/콤마/소수점 입력
function decimalChk(value) {
    value = value.toString().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');

    // 소수점 2번째 자리까지
    let regExp = /^\d*.?\d{0,2}$/;
    if (!regExp.test(value)) {
        value = isNaN(value) ? 0 : Number(value).toFixed(2)
    }

    return value;
}

// 체크박스 전체선택
// onclick="selectAllCheckbox(this, 'checkIdx')"
function selectAllCheckbox(element, name) {
    const checkboxes = document.querySelectorAll(`input[name="${name}"]`);
    checkboxes.forEach((checkbox) => {
        if (!checkbox.disabled)
            checkbox.checked = element.checked;
    });
}

// 체크박스 선택값 리턴
function selectCheckBoxValues(name) {
    let arr = [];
    const checkboxes = document.querySelectorAll(`input[name="${name}"]:checked`);
    checkboxes.forEach((checkbox) => {
        arr.push(checkbox.value);
    });
    return arr;
}

// Date to YYYY-mm-dd 포맷변환
function formatDate(date) {
    let year = date.getFullYear();
    let month = ('0' + (date.getMonth() + 1)).slice(-2);

    let day = ('0' + date.getDate()).slice(-2);
    return `${year}-${month}-${day}`;
}

// 날짜기간 생성
function getStartAndEndDate(rangeType) {
    let returnDateRange = {start: '', end: ''};
    const today = new Date();
    const now = dayjs();

    switch (rangeType.toString()) {
        case "1" : // 오늘
        case "now" :
            returnDateRange.start = formatDate(today);
            returnDateRange.end = formatDate(today);
            break;

        case "2" : // 이번주
        case "week" :
            let firstDay = today.getDate() - today.getDay() + 1;
            // let lastDay = firstDay + 6;
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
        case "month" :
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

// 팝업 생성
function createPopup(url, name, width = 700, height = 500) {
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

/**
 * 폼 초기화
 * @param name: form name
 * @param except: 초기화 제외 hidden name (array)
 */
function clearForm(name, except) {
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
async function commonActionDelete(fetchURL, idx) {
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

    const confirmResult = await showConfirm('삭제하시겠습니까?');
    if (confirmResult.isConfirmed !== true) {
        return false;
    }

    const response = await fetchData(`${fetchURL}`, {idxArr});
    if (response.result) {
        showAlert(`삭제가 완료되었습니다.`, () => {
            location.reload();
        });
    } else {
        let message = response.message ? response.message : `삭제에 실패하였습니다.`;
        showError(message);
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
async function commonActionRegister(fetchURL, formData, gubun, url, isAlert) {
    const response = await fetchData(`${fetchURL}`, formData);
    if (response.result) {
        if (isAlert == false) { // alert 패스
            if (url) location.replace(url);
            else location.reload();
        } else {
            showAlert(`${gubun}이 완료되었습니다.`, () => {
                if (url) location.replace(url);
                else location.reload();
            });
        }
    } else {
        let message = response.message ? response.message : `${gubun}에 실패했습니다.`;
        showError(message);
    }
}

/**
 * 엑셀다운로드
 * @param target: 엑셀구분(메뉴명..)
 */
async function commonExcelDownload(target) {
    let parameter = (location.search ? location.search + '&' : '?') + `excel=${target}`;

    if (target == 'pxOrderTracking' || target == 'pxOrderProductTracking') {
        // 주문배송관리 체크된 항목 추가
        const idxArr = Array.from(document.querySelectorAll('input[name="checkIdx"]:checked'))
            .map(checkbox => checkbox.value);

        if (idxArr.length > 0) {
            parameter += `&idxArr=${encodeURIComponent(idxArr.join(','))}`;
        }
    }

    location.href = `/excel/download${parameter}`;
}

/**
 * 엑셀업로드 (공통)
 * @param input: 파일업로드 element
 * @param target: 엑셀구분(메뉴명..)
 */
async function commonExcelUpload(input, target) {
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
        showError(message);
        showLoading(0);
    }
}

// formData to JSON 객체 변환
function formToJson(form) {
    const formData = new FormData(form);
    const json = {};

    for (const [key, value] of formData.entries()) {
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
function serializeForm(form, skipEmptyValue = false) {
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
function showLoading(show) {
    let loading = document.getElementById("loading");
    if (loading) loading.style.display = (show) ? "block" : "none";
}

/**
 * fetchHtml 페이징
 * @param page: 현재페이지
 * @param formName: 검색 form
 * @param modalFunc: 실행 function
 */
function fetchHtmlPaging(page, formName, modalFunc) {
    if (!page || !modalFunc) return;
    if (formName && document[formName]) document[formName].page.value = page;

    console.log(page, formName, modalFunc);
    modalFunc();
}

// 계정 전환
async function changeAccount(curAdmin, mb_id, name) {
    const existingForm = document.getElementById("changeForm");
    if (existingForm) {
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

// 쿠키 저장
function setCookie(name, value, hours) {
    const date = new Date();
    date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
    //date.setTime(date.getTime() + (minutes*60*1000)); // 분
    document.cookie = `${name}=${value};expires=` + date.toUTCString() + ';path=/';
}

// 쿠키 조회
function getCookie(name) {
    const value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return value ? value[2] : null;
}

// 이미지 유효성 검사
function validateImgFile(file, maxSizeMB = 5) {
    const maxByte = maxSizeMB * 1024 * 1024;

    if (file.size > maxByte) {
        showAlert(`${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`);
        return false;
    }

    // 이미지 체크
    const regExt = /(.*?)\.(jpg|jpeg|png)$/;
    if (!regExt.test((file.name).toLowerCase())) {
        alert("올바른 형식의 이미지만 등록이 가능합니다.");
        return false;
    }

    return true;
}

// get 파라미터 가져오기
function getQueryParam(paramName) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(paramName);
}

// 결제요청시 TID 생성
function apprDtmJs() {
    const now = new Date();
    const year = now.getFullYear().toString().substr(-2);
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const millis = String(now.getMilliseconds()).padStart(3, '0');

    return year + month + day + hours + minutes + seconds + millis.substr(0, 2);
}

// 시작일이 종료일보다 큰지 체크
function isStartDateAfterEndDate(startDate, endDate) {
    return dayjs(startDate).isAfter(dayjs(endDate));
}

// 타이머
const timerBundle = {
    // 카운터 남은시간 포맷 (N일 NN:NN:NN)
    formatTimeLeft: (timeLeft, type) => {
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        let formatted = days > 0 ? `${days}일 ` : '';
        formatted += `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (type == 'd-day') {
            formatted = `D-${days} `;
            formatted += `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        } else if (type == 'json') {
            formatted = {day: days, time: `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`};
        }

        return formatted;
    },
    // 공구 타이머 시작
    start: (elementId, endDateStr, timerType) => {
        const countElement = document.querySelector(`#${elementId}`);
        if (!countElement) return;

        const targetDate = new Date(`${endDateStr}T23:59:59`).getTime();

        const intervalId = setInterval(() => {
            const now = new Date().getTime(); // 현재 시간
            const timeLeft = targetDate - now; // 남은 시간 계산

            if (timeLeft <= 0) {
                clearInterval(intervalId); // 타이머 종료
                countElement.innerHTML = '할인 혜택 종료';

            } else {
                const res = timerBundle.formatTimeLeft(timeLeft, timerType);
                if (timerType == 'json') {
                    countElement.innerHTML = `<div class="days">D-${res.day}</div><div class="time">${res.time}</div>`;
                } else {
                    countElement.innerHTML = res;
                }

            }
        }, 1000); // 매초마다 체크

        setTimeout(() => {
            countElement.classList.remove('hide');
        }, 1000);
    },
}

// 주문취소 팝업
function openOrderCancelPop(target, id) {
    createPopup(`/payment/orderCancel/${target}/${id}`, '주문취소', 600, 600);
}

// 배송조회 팝업
function openTracking(detId) {
    createPopup(`/deliTracking/${detId}`, '배송조회', 450, 600);
}

// 동적 스크립트 호출
function loadScript(src, callback) {
    const randomStr = Math.random().toString(16).substr(2, 8);
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = src + `?${randomStr}`;

    // 로드 완료
    script.onload = () => {
        if (callback) callback();
    };

    script.onerror = () => {
        console.error(`${src} 로드 실패`);
    };

    document.head.appendChild(script);
}

// 공지, 뉴스 슬라이드
function slideItems(elementId) {
    const elements = document.querySelectorAll(elementId);
    // if (!elements) return;

    elements.forEach(elementList => {
        const links = elementList.querySelectorAll('a.item'); // a 클래스 필수
        let currentIndex = -1;

        links.forEach((link, index) => {
            if (!link.classList.contains('hide')) {
                currentIndex = index;
            }
        });

        if (links.length === 0) return;

        if (currentIndex !== -1) links[currentIndex].classList.add('hide');
        currentIndex = (currentIndex + 1) % links.length;
        links[currentIndex].classList.remove('hide');
    });
}

// 공지 닫기
function toggleNotice() {
    const view = document.getElementById('notiView');
    if (view.classList.contains('hide')) {
        view.classList.remove('hide');
    } else {
        view.classList.add('hide');
    }
    // if(view.style.display === 'none') {
    //     view.style.display = 'block';
    // }else {
    //     view.style.display = 'none';
    // }
}

// 직원 알림톡 호출
async function empReqAlimTalk(reqType) {
    const json = {};
    if (reqType == 'pointCharge') {
        const confirmResult = await showConfirm('원장님께 <strong>포인트 충전요청 알림톡</strong>을<br> 발송하시겠어요?');
        if (confirmResult.isConfirmed !== true) return false;

    } else {
        return false;
    }

    showLoading(true);
    const response = await fetchData(`/api/alimTalk/${reqType}`, json);

    if (response.result) {
        showAlert('알림톡이 발송되었어요.');
    } else {
        const message = response.message ? response.message : `알림톡 발송에 실패했어요.<br>잠시 후 다시 시도해 주세요.`;
        showError(message);
    }
}