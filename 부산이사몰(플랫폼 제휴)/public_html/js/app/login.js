/**
 * 로그인
 */

(function () {
    'use strict';
    const form = document.forms['login'];

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });

    function eventListeners() {
        form.addEventListener('submit', handleWebLogin);

        //sns
        document.querySelectorAll('[data-sns-type]').forEach(button => {
            button.addEventListener('click', handleSnsLogin)
        });
    }

    async function handleWebLogin(e) {
        e.preventDefault();

        const form = e.target;

        const id = utils.removeWhitespace(form.id.value);
        const password = form.password.value;

        if (!id) {
            return utils.showToast('아이디를 입력하세요.', form.id.focus());
        }

        if (!password) {
            return utils.showToast('비밀번호를 입력하세요.', form.password.focus());
        }

        const response = await API.fetchData('/api/signIn', {id, password, target: ''});

        if (response.result) {
            if (parseInt(response.mb_level, 10) === 10) {
                location.href = baseUrl + 'adm/member';
            }else {
                location.href = response.redirectURL ? response.redirectURL : baseUrl;
            }
        } else {
            const message = response.message ? response.message : '로그인에 실패했어요.';
            utils.showToast(message);
        }
    }

    //소셜 로그인
    function handleSnsLogin(e) {
        const type = e.target.dataset.snsType;
        if (type === 'naver') {
            location.href = baseUrl + `api/snsLogin/naver?ref=${document.referrer}`;
        } else {
            //utils.showAlert('서비스 준비중이에요.');
            location.href = baseUrl + `api/snsLogin/kakao?ref=${document.referrer}`;
        }
    }
})();
