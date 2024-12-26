/**
 * 정보관리
 */
(function () {
    'use strict';

    const form = document.forms['cardNum'];
    const secession = document.querySelector('#secession');

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });


    function eventListeners() {
        //카드 등록
        form.addEventListener('submit', changeCardNum);
        secession.addEventListener('click', userSecession);
    }

    async function userSecession(e){
        e.preventDefault();

        const confirmResult = await utils.showConfirm('탈퇴 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;
        const formData  = new FormData();
        const idx = member['idx'];

        formData.append('idx', idx);
        const response = await API.fetchData('/api/userSecession', formData);

        if(response.success){
            utils.showToast('회원 탈퇴 되었습니다.',location.href = baseUrl+'/');
        }
    }

    async function changeCardNum(e){
        e.preventDefault();

        const confirmResult = await utils.showConfirm('카드를 등록 하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData  = new FormData(form);
        const cardNum00 = document.querySelector('#cardNum00').value;
        const cardNum01 = document.querySelector('#cardNum01').value;
        const cardNum02 = document.querySelector('#cardNum02').value;
        const cardNum03 = document.querySelector('#cardNum03').value;
        const cardNumber = `${cardNum00}${cardNum01}${cardNum02}${cardNum03}`;
        const mbIdx = member['idx'];
        const mbId = member['mb_id'];
        formData.append('cardNumber', cardNumber);
        formData.append('mbId', mbIdx );
        formData.append('mbIdm', mbId );
        formData.delete('orderPrice');
        formData.delete('division');

        const response = await API.fetchData('/api/changeCardNum', formData);
        console.log(response)
        if (response.success) {
            utils.showToast('등록 되었습니다.', () => {
                location.reload();
            })
        } else {
            let message = '등록에 실패 되었습니다.';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }

    }
})();