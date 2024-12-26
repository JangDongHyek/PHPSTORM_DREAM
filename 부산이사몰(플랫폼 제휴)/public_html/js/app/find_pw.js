/**
 * 아이디/비밀번호 찾기
 */
(function () {
    'use strict';

    const formId = document.forms['findId'];
    const findPw = document.forms['findPw'];
    let countdown;

    document.addEventListener('DOMContentLoaded', async () => {
        eventListeners();
    });

    function eventListeners() {
        // 아이디 찾기
        formId.addEventListener('submit', handleFindById);

        // 비밀번호 변경
        findPw.addEventListener('submit', handleFindPass)
    }

    // 아이디 찾기
    async function handleFindById(e) {
        e.preventDefault();

        const formCheck = await checkFormData();
        if (!formCheck) return false;

        const formData = new FormData(formId);

        const response = await API.fetchData('/api/getUserFindId', formData);


        if (response.result) {

            if (Array.isArray(response.result) && response.result.length === 0) {
                utils.showToast('아이디가 없습니다.');
                return false;
            }

            if (response.result['del_yn'] === 'Y') {
                utils.showToast('삭제되어 있는 아이디 입니다.');
                return false;
            }

            document.querySelector('#findView').innerHTML = response.result['mb_id'];

        } else if (response.result === 0) {
            utils.showToast('아이디가 없습니다.');
            return false;
        }

    }

    // 비밀번호 변경
    async function handleFindPass(e) {
        e.preventDefault();

        const formData = new FormData(findPw);
        const response = await API.fetchData('/api/getAuthenticateUser', formData);

        if (response.result) {
            clearInterval(countdown);
            const timerElement = document.getElementById('timer');
            timerElement.innerText = '완료';

            const findView = document.getElementById('findView');

            findView.innerHTML = `
            <form name="findCheck" autocomplete="off">
                <input type="password" placeholder="비밀번호" id="input1" />
                <input type="password" placeholder="비밀번호 확인" id="input2" />
                <button type="submit" id="submitButton" class="btn btn_large btn_color">비밀번호 변경</button> 
            </form>
        `;
            // 비밀번호 변경
            document.getElementById('submitButton').onclick = handleSubmit;
        }
    }

    // 비밀번호 변경
    function handleSubmit(e) {
        e.preventDefault();

        const value1 = document.querySelector('#input1').value;
        const value2 = document.querySelector('#input2').value;
        const memberId = document.querySelector('input[name="memberId"]').value;
        if (value1 === value2) {
            const formData = new FormData();
            formData.append('mbId', memberId);
            formData.append('mbPassword', value1);

            API.fetchData('/api/updatePassword', formData)
                .then(response => {
                    console.log('Password updated successfully:', response);
                    if (response.result) {
                        utils.showAlert('비밀번호 변경 완료되었어요', () => {
                            location.href = baseUrl + '/login';//'../';
                        });
                    } else {
                        let message = '비밀번호 변경 실패했어요';
                        message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
                        utils.showAlert(message);
                    }
                })
                .catch(error => {
                    console.error('Error updating password:', error);
                });
        } else {
            utils.showToast('비밀번호가 일치하지 않습니다. 다시 입력해 주세요.');
            return false;
        }
    }

    // 휴대폰 인증 폼
    document.getElementById('authBtn').addEventListener('click', async function (event) {
        event.preventDefault();

        const formCheck = await checkSendFormData();
        if (!formCheck) return false;

        const formData = new FormData(findPw);

        const response = await API.fetchData('/api/getUserFindPass', formData);
        console.log(response);
        if (response.result) {
            document.getElementById('authNum').style.display = 'block';

            document.getElementById('phone').disabled = true;

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
        }

    });

    const validateField = (field, message) => {
        if (!field) {
            utils.showToast(message);
            return false;
        }
        return true;
    };

    async function checkSendFormData() {
        const memberId = findPw.memberId.value;
        if (!validateField(memberId, '아이디를 입력해주세요.')) return false;

        const phone = findPw.phone.value;
        if (!validateField(phone, '휴대폰 번호를 입력해주세요.')) return false;
        return true;
    }

    //폼검증
    async function checkFormData() {
        const selectedMemberType = document.querySelector('input[name="memberType"]:checked').value;

        if (selectedMemberType === 'normal') {
            const mbName = formId.mbName.value;
            if (!validateField(mbName, '이름을 입력해주세요.')) return false;

            const mbHp = formId.mbHp.value;
            if (!validateField(mbHp, '휴대폰 번호를 입력해주세요.')) return false;

        } else if (selectedMemberType === 'business') {
            const cmbName = formId.cmbName.value;
            if (!validateField(cmbName, '대표자명을 입력해주세요.')) return false;

            const bizNo = formId.bizNo.value;
            if (!validateField(bizNo, '사업자 번호를 입력해주세요.')) return false;

        } else { // 비밀번호 찾기
            const memberId = findPw.memberId.value;
            if (!validateField(memberId, '아이디를 입력해주세요.')) return false;

            const phone = findPw.phone.value;
            if (!validateField(phone, '휴대폰 번호를 입력해주세요.')) return false;
        }
        return true;
    }
})();