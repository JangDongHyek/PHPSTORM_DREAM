/**
 * 관리자 광고신청
 */
(function () {
    'use strict';

    const form = document.forms['adverts'];

    // 광고 지역
    const areaSi = document.querySelector('select[name="areaSi"]');
    //프리미엄 지역
    const areaSi2 = document.querySelector('select[name="areaSi2"]');
    //메인 노출 상품
    const mainAd = document.querySelector('#main_ad');
    //메인 노출 상단
    const mainTop = document.querySelector('#main_top_list');
    //메인 노출 하단
    const mainBottom = document.querySelector('#main_bottom_list');
    //할인
    const discountCheckbox = document.querySelector('#discount');
    let areaGuCount = 0;
    let preCount = 0;
    const cardCh = document.querySelector('#cardNum');
    document.addEventListener('DOMContentLoaded', async () => {
        eventListeners();
        // 광고 지역
        await changeArea({value: areaSi.value}, '#areaGu', 'areaGu');
        //프리미엄 지역역
        await changeArea({value: areaSi2.value}, '#areaGu1', 'preArea');
        //광고 신청
        updateCheckedDistricts('areaGu');
        //프리미엄 지역광고
        updateCheckedDistricts('preArea');

    });

    //광고 신청
    document.addEventListener('click', (e) => {
        if (e.target.name == 'areaGu[]') {
            //광고 신청
            updateCheckedDistricts('areaGu');
        } else if (e.target.name == 'preArea[]') {
            //프리미엄 지역광고
            updateCheckedDistricts('preArea');
        }
    });

    function eventListeners() {
        // 등록 결제
        form.addEventListener('submit', handleSubmit);

        // 지역선택
        areaSi.addEventListener('change', async (e) => {
            await changeArea(e.target, '#areaGu', 'areaGu');
        })
        // 지역선택
        areaSi2.addEventListener('change', async (e) => {
            await changeArea(e.target, '#areaGu1', 'preArea');
        })

        // 선택 상품 계산
        if (discountCheckbox) {
            discountCheckbox.addEventListener('change', function () {
                totalPrice();
            });
        } else {
            totalPrice();
        }

        mainTop.addEventListener('change', function () {
            let sun = Number(adPrice['mainTop']);
            if (this.checked) {
                document.querySelector('input[name="mainTopPrice"]').value = sun
            } else {
                document.querySelector('input[name="mainTopPrice"]').value = 0;
            }
            totalPrice();
        });

        mainBottom.addEventListener('change', function () {
            let sun = Number(adPrice['mainBottom']);
            if (this.checked) {
                document.querySelector('input[name="mainBottomPrice"]').value = sun
            } else {
                document.querySelector('input[name="mainBottomPrice"]').value = 0;
            }
            totalPrice();
        })

        // 결제 정보 변경
        cardCh.addEventListener('click', changeCardNum);
    }

    //결제 정보 변경
    async function changeCardNum(e) {
        e.preventDefault();

        const confirmResult = await utils.showConfirm('결제 정보 수정 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;
        const formData = new FormData();
        const cardNum00 = document.querySelector('#cardNum00').value;
        const cardNum01 = document.querySelector('#cardNum01').value;
        const cardNum02 = document.querySelector('#cardNum02').value;
        const cardNum03 = document.querySelector('#cardNum03').value;

        const cardMm = document.querySelector('#cardMm').value; // 유효기간 월
        const cardYy = document.querySelector('#cardYy').value; // 유효기간 년
        const cardPwd = document.querySelector('#cardPwd').value; // 비밀번호 앞 2자리
        const idNum = document.querySelector('#idNum').value; // 카드 인증번호
        const cardIdx = document.querySelector('#cardIdx').value; // card.idx
        const MbIdx = document.querySelector('#cardMbIdx').value; // card.idx

        const cardNumber = `${cardNum00}${cardNum01}${cardNum02}${cardNum03}`;
        formData.append('cardNumber', cardNumber);
        formData.append('cardMm', cardMm);
        formData.append('cardYy', cardYy);
        formData.append('cardPwd', cardPwd);
        formData.append('idNum', idNum);
        formData.append('idx', cardIdx);
        formData.append('mbId', MbIdx);

        utils.showLoading(true);

        const response = await API.fetchData('/api/changeCardNum', formData);
        if (response.success) {
            utils.showToast('수정 되었습니다.', () => {
                location.reload();
            })
        } else {
            let message = '수정에 실패 되었습니다.';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }
    }

    // 선택 상픔
    function updateCheckedDistricts(key) {
        let sun = (key === 'areaGu') ? Number(adPrice['basic']) : 0;
        let extraCount = 0;

        const checkedDistricts = document.querySelectorAll(`input[name="${key}[]"]:checked`);
        const checkedValues = Array.from(checkedDistricts).map(checkbox => checkbox.value);

        if (key === 'areaGu') {
            areaGuCount = checkedDistricts.length;
            if (checkedDistricts.length > 3) {
                extraCount = checkedDistricts.length - 3;
                sun += extraCount * Number(adPrice['add']);
            }
        } else if (key === 'preArea') {
            preCount = checkedDistricts.length;
            extraCount = checkedDistricts.length;
            sun += extraCount * Number(adPrice['premium']);

        }

        if (key === 'areaGu') {

            document.querySelector('#basicPrice').textContent = utils.addCommaNumber(sun);
            document.querySelector('input[name="basicPrice"]').value = sun;
            document.querySelector('input[name="areaGu"]').value = checkedValues.join(', ');

            const additionalAreaSpan = document.querySelector('#basicPriceSpan'); // 추가 지역을 표시할 span 요소

            if (extraCount > 0) {
                additionalAreaSpan.style.display = 'block'; // 보이게 설정
                additionalAreaSpan.innerHTML = `<i class="fa-duotone fa-circle-plus"></i> 추가 지역 ${extraCount}개 (+${utils.addCommaNumber(extraCount * Number(adPrice['add']))}원)`; // 내용 업데이트
            } else {
                additionalAreaSpan.style.display = 'none'; // 숨기기
            }
        } else if (key === 'preArea') {
            document.querySelector('#prePrice').textContent = utils.addCommaNumber(sun);
            document.querySelector('input[name="prePrice"]').value = sun;
            document.querySelector('input[name="preArea"]').value = checkedValues.join(', ');

            const additionalAreaSpan = document.querySelector('#prePriceSpan');

            if (extraCount > 0) {
                additionalAreaSpan.style.display = 'block';
                additionalAreaSpan.innerHTML = `<i class="fa-duotone fa-circle-plus"></i> 지역 ${extraCount}개 (+${utils.addCommaNumber(extraCount * Number(adPrice['premium']))}원)`; // 내용 업데이트
            } else {
                additionalAreaSpan.style.display = 'none';
            }
        }
        totalPrice();
    }

    // 선택 상품 계산
    function totalPrice() {
        let discountValue = 1;
        if (discountCheckbox && discountCheckbox.checked) {
            discountValue = discountCheckbox.value;
            document.querySelector('#noSale').style.display = 'inline-block';
        } else {
            document.querySelector('#noSale').style.display = 'none';
        }

        const basicPrice = Number(document.querySelector('input[name="basicPrice"]').value) || 0;
        const prePrice = Number(document.querySelector('input[name="prePrice"]').value) || 0;
        const mainPrice = Number(document.querySelector('input[name="mainPrice"]').value) || 0;
        const mainTopPrice = Number(document.querySelector('input[name="mainTopPrice"]').value) || 0;
        const mainBottomPrice = Number(document.querySelector('input[name="mainBottomPrice"]').value) || 0;

        document.querySelector('#mainPrice').textContent = utils.addCommaNumber(mainTopPrice + mainBottomPrice);
        document.querySelector('input[name="mainPrice"]').value = mainTopPrice + mainBottomPrice;
        const totalPrice = basicPrice + prePrice + mainTopPrice + mainBottomPrice;
        const sale = totalPrice * discountValue;
        document.querySelector('#total').textContent = utils.addCommaNumber(totalPrice);
        document.querySelector('#sale').textContent = utils.addCommaNumber(sale);

        document.querySelector('input[name="orderPrice"]').value = sale;  <!--주문 금액-->
        document.querySelector('input[name="discount"]').value = sale; <!--할인가격-->
        document.querySelector('input[name="totalAmt"]').value = totalPrice;<!--총가격-->

    }


    // 지역선택
    //siElement: 지역(시) , areaGu: div 아이디값  , name 구분
    async function changeArea(siElement, areaGu, pre) {
        const si = siElement.value;
        const districtsContainer = document.querySelector(areaGu); // 체크박스가 들어갈 컨테이너

        // 구가 없는 경우 (예: 세종)
        /*if (si === '세종') {
            guElement.classList.add('hide');
            districtsContainer.innerHTML = ''; // 체크박스 초기화
            return;
        }*/

        //guElement.classList.remove('hide');

        // 선택한 지역에 대한 구 목록을 가져옴
        const guList = await API.fetchData('/api/searchArea', {si});
        districtsContainer.innerHTML = '';

        const hiddenInput = document.querySelector(`input[name="${pre}"]`);
        const selectedAreas = hiddenInput && hiddenInput.value ? hiddenInput.value.split(',').map(area => area.trim()) : []; // 각 요소의 공백 제거

        if (guList && typeof guList === 'object') {
            for (const key in guList) {
                const value = guList[key];
                const checkboxId = `${si.toLowerCase()}_${value.toLowerCase()}`; // id 생성
                const isChecked = selectedAreas.includes(value.trim()) ? 'checked' : ''; // 선택 여부 확인

                const checkboxHTML = `
            <div>
                <input type="checkbox" id="${checkboxId}_${pre}" name="${pre}[]" value="${value}"  ${isChecked}>
                <label for="${checkboxId}_${pre}">${value}</label>
            </div>`;
                districtsContainer.innerHTML += checkboxHTML; // 체크박스 추가
            }
        }
    }

    // 데이터 저장 및 결제
    async function handleSubmit(e) {
        e.preventDefault();

        const formCheck = checkFormData();
        if (!formCheck) return false;

        const confirmResult = await utils.showConfirm('결제 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData(form);
        const cardNum00 = document.querySelector('#cardNum00').value;
        const cardNum01 = document.querySelector('#cardNum01').value;
        const cardNum02 = document.querySelector('#cardNum02').value;
        const cardNum03 = document.querySelector('#cardNum03').value;
        const MbIdx = document.querySelector('#cardMbIdx').value; // card.idx

        const addPrice = document.querySelector('input[name="addPrice"]').value;
        const cardNumber = `${cardNum00}${cardNum01}${cardNum02}${cardNum03}`;
        formData.append('cardNumber', cardNumber);

        if (addPrice) {
            formData.append('orderPrice',utils.removeCommaNumber(addPrice))
        }
        formData.append('mb_idx', MbIdx);

        utils.showLoading(true);

        const response = await API.fetchData('/api/advertsUpload', formData);

        if (response.result) {
            utils.showToast('결제 되었습니다.', () => {
                location.href = baseUrl + 'adm/adPayment';
            })
        } else {
            let message = '결제에 실패 되었습니다.';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }
    }

    // 폼 검증
    function checkFormData() {
        const company = form.companyName.value; // 업체명
        if (!company) {
            utils.showToast('업체명을 입력해주세요.', () => form.companyName.focus());
            return false;
        }

        const cpTel = form.cpTel.value;
        if (!cpTel) {
            utils.showToast('연락처를 입력해주세요.', () => form.cpTel.focus());
            return false;
        }

        if (areaGuCount < 3) {
            utils.showToast('광고지역 3개 선택해주세요.');
            return false;
        }

        const cardNum00 = form.cardNum00.value;
        if (!cardNum00) {
            utils.showToast('카드번호 입력해주세요.', () => form.cardNum00.focus());
            return false;
        }

        const cardNum01 = form.cardNum01.value;
        if (!cardNum01) {
            utils.showToast('카드번호 입력해주세요.', () => form.cardNum01.focus());
            return false;
        }

        const cardNum02 = form.cardNum02.value;
        if (!cardNum02) {
            utils.showToast('카드번호 입력해주세요.', () => form.cardNum02.focus());
            return false;
        }

        const cardNum03 = form.cardNum03.value;
        if (!cardNum03) {
            utils.showToast('카드번호 입력해주세요.', () => form.cardNum03.focus());
            return false;
        }

        const card_mm = form.cardMm.value;
        if (!card_mm) {
            utils.showToast('유효기간을 입력해주세요.', () => form.cardMm.focus());
            return false;
        }

        const card_yy = form.cardYy.value;
        if (!card_yy) {
            utils.showToast('유효기간을 입력해주세요.', () => form.cardYy.focus());
            return false;
        }

        const cardPwd = form.cardPwd.value;
        if (!cardPwd) {
            utils.showToast('카드 비밀번호 앞 2자리를 입력해주세요.', () => form.cardPwd.focus());
            return false;
        }

        const card_pw = form.idNum.value;
        if (!card_pw) {
            utils.showToast('카드인증번호를 입력해주세요', () => form.cardPw.focus());
            return false;
        }
        return true;
    }

})();