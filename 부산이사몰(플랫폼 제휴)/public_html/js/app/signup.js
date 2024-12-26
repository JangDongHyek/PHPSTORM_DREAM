/**
 * 회원가입
 */

(function () {
    'use strict';

    const form = document.forms['signup'];
    const generalMemberRadio = document.getElementById('generalMember');
    const businessMemberRadio = document.getElementById('businessMember');
    const realtorMemberRadio = document.getElementById('realtorMember');
    const allAgreeCheckbox = document.getElementById('allAgree');
    const agreeCheckboxes = document.querySelectorAll('input[name="agree"], input[name="agree2"]');

    const btnpw = document.querySelector('#btnFindPw');

    let countdown;

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
        toggleForms();
    });

    document.getElementById('authBtn').addEventListener('click', async function (event) {
        // 기본 동작을 막아서 새로고침 방지
        event.preventDefault();
        const mbHp = document.querySelector('#mb_hp').value;
        const mbName = document.querySelector('#mb_name').value;
        const formCheck = await checkSendFormData();
        if (!formCheck) return false;

        const formData = new FormData();
        formData.append('phone', mbHp);
        formData.append('mb_name', mbName);

        const response = await API.fetchData('/api/getUserFindPass', formData);

        if (response.result) {
            document.getElementById('authNum').style.display = 'block';

            // 휴대폰 번호 입력란을 비활성화
            document.getElementById('mb_hp').readonly = true;

            // 타이머 설정 (60초)
            let timeLeft = 60;
            const timerElement = document.getElementById('timer');
            countdown = setInterval(function () {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerElement.innerText = '시간 초과';
                } else {
                    timerElement.innerText = timeLeft + '초';
                }
                timeLeft--;
            }, 1000);

        } else {
            let message = '등록되어 있는 전화번호가 있습니다';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }


    });

    function eventListeners() {
        form.addEventListener('submit', handleSignUp);

        generalMemberRadio.addEventListener('change', toggleForms);
        businessMemberRadio.addEventListener('change', toggleForms);
        realtorMemberRadio.addEventListener('change', toggleForms);

        allAgreeCheckbox.addEventListener('click', function () {
            agreeCheckboxes.forEach(function (checkbox) {
                checkbox.checked = allAgreeCheckbox.checked;
            });
        });

        agreeCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('click', function () {
                if (!checkbox.checked) {
                    allAgreeCheckbox.checked = false;
                }
            });
        });

        btnpw.addEventListener('click', autoNumber);
    }

    //인증확인
    async function autoNumber(e) {
        e.preventDefault();
        const authCode = document.querySelector('#authCode').value;
        const authYN = document.querySelector('#authYN');
        const formData = new FormData();
        formData.append('authCode', authCode);
        const response = await API.fetchData('/api/getAuthenticateUser', formData);

        if (response.result) {
            clearInterval(countdown);
            const timerElement = document.getElementById('timer');
            timerElement.innerText = '완료';
            authYN.value = 'Y';
            utils.showToast('인증이 되었습니다.')

        } else {
            authYN.value = 'N';
            utils.showToast('인증번호가 다릅니다. <br> 인증번호를 확인해주세요.');
        }
    }

    async function checkSendFormData() {
        const level = form.mb_level.value;
        const userHp = utils.addHyphenTel(form.mb_hp.value);
        if (!userHp) {
            const targetHp = level === '2' ? '연락처' : '담당자 연락처';
            utils.showToast(`${targetHp}를 입력해 주세요.`);
            return false;
        }
        return true;
    }

    async function handleSignUp(e) {
        e.preventDefault();

        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(form);
        utils.showLoading(true);

        setTimeout(async () => {
            const response = await API.fetchData('/api/signUp', formData);
            console.log(response)
            if (response.result) {
                utils.showAlert('회원가입이 완료되었어요 😊', () => {
                    location.href = baseUrl;//'../';
                });
            } else {
                let message = '회원가입에 실패했어요 😥';
                message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                utils.showAlert(message);
            }
        }, 800);
    }

    async function checkFormData() {
        const level = form.mb_level.value;

        if (level === '5') {
            const company = form.company_name.value;
            if (!company) {
                utils.showToast('회사명을 입력해 주세요.');
                return false;
            }
        }

        const userId = utils.removeWhitespace(form.mb_id.value);
        const checkId = userValidator.validateUserId(userId);

        if (!checkId.isValid) {
            utils.showToast(checkId.message, () => form.mb_id.focus());
            return false;
        }

        if (form.mb_password) {
            const pass = form.mb_password.value;
            if (pass.length < 4) {
                utils.showToast('비밀번호를 4자 이상 입력해 주세요.');
                return false;
            }
            if (pass != form.password_confirm.value) {
                utils.showToast('비밀번호와 비밀번호확인이 일치하지 않아요.');
                return false;
            }
        }

        const username = utils.removeWhitespace(form.mb_name.value);
        const targetName = level === '2' ? '이름' : '대표자명';

        if (!username) {
            utils.showToast(`${targetName}을 입력해 주세요.`);
            return false;
        } else {
            if (!userValidator.validateUserName(username)) {
                utils.showToast(`${targetName}을 올바르게 입력해 주세요. (한글)`);
                return false;
            }
        }

        const userHp = utils.addHyphenTel(form.mb_hp.value);
        if (!userHp) {
            const targetHp = level === '2' ? '연락처' : '담당자 연락처';
            utils.showToast(`${targetHp}를 입력해 주세요.`);
            return false;
        }

        const agree01 = document.getElementById('agree01');
        if (!agree01.checked) {
            utils.showToast('회원이용약관 동의 해주세요.')
            return false;
        }

        const agree02 = document.getElementById('agree02');
        if (!agree02.checked) { // 동의
            utils.showToast('개인정보처리방침에 동의 해주세요.')
            return false;
        }

        const authYN = document.querySelector('#authYN').value;
        if (authYN !== 'Y') {
            utils.showToast('인증을 해주세요.');
            return false;
        }

        return true;
    }

    function toggleForms() {
        const company_name = document.getElementById('company_name');
        const company_name01 = document.getElementById('company_name01');
        const biz_no = document.getElementById('biz_no');
        const biz_no01 = document.getElementById('biz_no01');
        const mb_name = document.getElementById('mb_name');
        const mb_name01 = document.getElementById('mb_name01');
        const mb_hp = document.getElementById('mb_hp');
        const mb_hp01 = document.getElementById('mb_hp01');

        const mb_level = document.getElementById('mb_level');

        if (document.getElementById('generalMember').checked) {
            company_name.style.display = 'none';
            company_name01.style.display = 'none';
            biz_no.style.display = 'none';
            biz_no01.style.display = 'none';

            mb_name.placeholder = '이름';
            mb_name01.innerText = '이름';

            mb_hp.placeholder = '연락처';
            mb_hp01.innerText = '연락처';

            mb_level.value = '2';
        } else if (document.getElementById('businessMember').checked) {
            company_name.style.display = 'block';
            company_name01.style.display = 'block';
            biz_no.style.display = 'block';
            biz_no01.style.display = 'block';

            company_name.placeholder = '회사명';
            company_name01.innerText = '회사명';

            mb_name.placeholder = '대표자명';
            mb_name01.innerText = '대표자명';

            mb_hp.placeholder = '담당자 연락처';
            mb_hp01.innerText = '담당자 연락처';

            mb_level.value = '5';
        } else if (document.getElementById('realtorMember').checked){
            company_name.placeholder = '부동산명';
            company_name01.innerText = '부동산명';

            mb_level.value = '8';
        }
    }

})();
