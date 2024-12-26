/**
 * 관리자 광고 결제 내역
 */
(function () {
    'use strict';


    const dataPayIdx = document.querySelectorAll('[data-pay-idx]');
    document.addEventListener('DOMContentLoaded', () => {

        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });

    function eventListeners() {

        // 결제 취소
        dataPayIdx.forEach(value => {
            value.addEventListener('click', handlePayRevoke);
        })
    }

    async function handlePayRevoke(e) {
        e.preventDefault();

        const payIdx = e.currentTarget.getAttribute('data-pay-idx');


        const confirmResult = await utils.showConfirm('결제를 취소하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        formData.append('idx', payIdx);

        const response = await API.fetchData('/api/payRevoke', formData);
        if (response) {
            utils.showAlert('취소가 완료되었어요', () => {
                location.reload();
            });
        } else {
            let message = '취고에 실패했어요';
            message += (response.message) ? `<br>(${response.message})` : `<br>잠시 후 다시 시도해 주세요.`;
            utils.showAlert(message);
        }
    }
})();