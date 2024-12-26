/**
 * 이사견적
 */
(function () {
    'use strict';

    const form = document.forms['estimate'];
    const cardform = document.forms['cardNum'];
    const hpOpen = document.querySelectorAll('[data-hp-open]');
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    document.addEventListener('DOMContentLoaded', () => {
        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();


        const mobileButtons = document.querySelectorAll(".mobileButton");
        const pcButtons = document.querySelectorAll(".pcButton");

        mobileButtons.forEach(button => {
            button.style.display = isMobile ? "inline-block" : "none";
        });

        pcButtons.forEach(button => {
            button.style.display = isMobile ? "none" : "inline-block";
        });

        eventListeners();
    });

    function eventListeners() {
        if (form) {
            form.addEventListener('submit', handleEstimateInsert);
        }

        // 카드 등록 및 결제
        if (cardform) {
            cardform.addEventListener('submit', handlePayment);
        }

        // 카드 정보 조회 and 전화 걸기
        hpOpen.forEach(value => {
            value.addEventListener('click', cardEnrolment);
        })
    }

    // 카드 등록 및 결제
    async function handlePayment(e) {
        e.preventDefault();

        const formCheck = await checkCardFormData();
        if (!formCheck) return false;

        const formData = new FormData(cardform);
        const cardNum00 = document.querySelector('#cardNum00').value;
        const cardNum01 = document.querySelector('#cardNum01').value;
        const cardNum02 = document.querySelector('#cardNum02').value;
        const cardNum03 = document.querySelector('#cardNum03').value;

        const cardNumber = `${cardNum00}${cardNum01}${cardNum02}${cardNum03}`;
        formData.append('cardNumber', cardNumber);

        utils.showLoading(true);

        const response = await API.fetchData('/api/advertsUpload', formData);
        console.log(response)

        if (response.result) {
        }
    }

    //카드 정보 조회 and 전화 걸기
    async function cardEnrolment(e) {
        e.preventDefault();
        const hp = e.currentTarget.getAttribute('data-hp-open');
        const eidx = e.currentTarget.getAttribute('data-eidx');
        //console.log(eidx)
        const formData = {
            estIdx: eidx
        };
        const hpOrderBy = await API.fetchData('/api/hpOrderByIdx', formData);

        if (!hpOrderBy) {
            const confirmResult = await utils.showConfirm('결제를 하시겠습니까?');
            if (confirmResult.isConfirmed !== true) return false;

            const response = await API.fetchData('/api/cardEnrolment');
            console.log(response)
            if (response.result['mb_id']) {
                const formData = new FormData();
                formData.append('orderPrice', hpPrice['price']);
                formData.append('division', 'hp');
                formData.append('parentId', eidx);
                formData.append('cardMm', response.result['card_exp'].slice(2)); //card_exp
                formData.append('cardYy', response.result['card_exp'].slice(0, 2)); //card_exp
                formData.append('cardPwd', response.result['card_pwd']); // card_pwd
                formData.append('idNum', response.result['idNum']); // idNum
                formData.append('cardNumber', response.result['card_num']); //card_num
                formData.append('cpTel', response.result['buyer_hp']); // buyer_hp 전화번호

                const responses = await API.fetchData('/api/advertsUpload', formData);
                if (responses.result) {
                    const telLink = `tel:${hp}`;
                    getPhoneAlert(telLink);
                    window.location.href = telLink;
                } else {
                    let message = '결제에 실패했어요';
                    message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                    utils.showAlert(responses.message);
                }

            } else {
                const eidxElement = document.querySelector('#eidx');
                if (eidxElement) {
                    eidxElement.value = eidx; // eidx 값을 설정
                }
                const paymentModal = document.querySelector('#paymentModal');
                $(paymentModal).modal('show');
            }
        } else {
            // 모바일일 때만 전화 연결 실행
            if (isMobile) {
                const telLink = `tel:${hp}`;
                window.location.href = telLink;
            }else{
                //const telLink = `tel:${hp}`;
                utils.showAlert(getPhoneAlert(hp));
            }
        }

    }
    
    //이사견적 신청
    async function handleEstimateInsert(e) {
        e.preventDefault();

        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);
        utils.showLoading(true);

        setTimeout(async () => {
            const response = await API.fetchData('/api/estimate', formData);

            if (response.result) {
                if (form.estIdx.value !== '0') {
                    utils.showAlert('이사견적 수정이 완료되었어요 😊', () => {
                        window.history.back();
                    });
                } else if (form.estIdx.value === '0') {
                    utils.showAlert('이사견적 신청이 완료되었어요 😊', () => {
                        location.href = baseUrl;
                    });
                }

            } else {
                let message = '이사견적 신청이 실패했어요 😥';
                message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                utils.showAlert(message);
            }
        },800);


    }

    async function checkFormData() {
        const moving = form.movingType.value;
        if (!moving) {
            utils.showToast('무슨 이사를 하시는지 선택해주세요.')
            return false;
        }

        const sched = form.schedDate.value;
        if (!sched) {
            utils.showToast('이사 예정일은 입력해주세요.');
            return false;
        }

        const origin = form.origin.value;
        if (!origin) {
            utils.showToast('출발지를 입력해주세요.');
            return false;
        }

        const bourne = form.bourne.value;
        if (!bourne) {
            utils.showToast('도착지를 입력해주세요.');
            return false;
        }

        const mbName = form.mbName.value;
        if (!mbName) {
            utils.showToast('고객님의 성함을 입력해주세요.');
            return false;
        }

        const mbHp = form.mbHp.value;
        if (!mbHp) {
            utils.showToast('고객님의 연락처를 입력해주세요.');
            return false;
        }

        const agree02 = document.getElementById('agree02');
        if (!agree02.checked) { // 동의
            utils.showToast('개인정보처리방침에 동의 해주세요.')
            return false;
        }

        return true;
    }

    async function checkCardFormData() {
        const cardNum00 = cardform.cardNum00.value;
        if (!cardNum00) {
            utils.showToast('카드번호 입력해주세요.', () => cardform.cardNum00.focus());
            return false;
        }

        const cardNum01 = cardform.cardNum01.value;
        if (!cardNum01) {
            utils.showToast('카드번호 입력해주세요.', () => cardform.cardNum01.focus());
            return false;
        }

        const cardNum02 = cardform.cardNum02.value;
        if (!cardNum02) {
            utils.showToast('카드번호 입력해주세요.', () => cardform.cardNum02.focus());
            return false;
        }

        const cardNum03 = cardform.cardNum03.value;
        if (!cardNum03) {
            utils.showToast('카드번호 입력해주세요.', () => cardform.cardNum03.focus());
            return false;
        }

        const card_mm = cardform.cardMm.value;
        if (!card_mm) {
            utils.showToast('유효기간을 입력해주세요.', () => cardform.cardMm.focus());
            return false;
        }

        const card_yy = cardform.cardYy.value;
        if (!card_yy) {
            utils.showToast('유효기간을 입력해주세요.', () => cardform.cardYy.focus());
            return false;
        }

        const cardPwd = cardform.cardPwd.value;
        if (!cardPwd) {
            utils.showToast('카드 비밀번호 앞 2자리를 입력해주세요.', () => cardform.cardPwd.focus());
            return false;
        }

        const card_pw = cardform.idNum.value;
        if (!card_pw) {
            utils.showToast('카드인증번호를 입력해주세요', () => cardform.cardPw.focus());
            return false;
        }
        return true;
    }
})();