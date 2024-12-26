/**
 * 관리자 광고 신청 관리
 */
(function () {
    'use strict';

    const checkAll = document.querySelector('#checkAll');
    const nextPayAt = document.querySelector('#nextPayAt');
    //결제일
    const nextPayAtData = document.querySelectorAll('input[name="nextPayAt"]');
    //결제 상태
    const status = document.querySelectorAll('select[name="status"]');

    document.addEventListener('DOMContentLoaded', () => {
        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });

    function eventListeners() {
        // 체크 박스
        checkAll.addEventListener('click', utils.checkboxes);
        //관리자 광고 신청 관리 결제일 변경
        nextPayAt.addEventListener('click', nextPayAtChange);

        // 결제일 변경시 체크
        nextPayAtData.forEach(nextPay => {
            nextPay.addEventListener('change', toggleCheckbox);
        });
    }

    // 결제일 변경시 체크
    function toggleCheckbox(e) {
        const row = e.target.closest('tr');
        const check = row.querySelector('input[type="checkbox"]');
        check.checked = !!e.target.value;
    }

    //관리자 광고 신청 관리 결제일 변경
    async function nextPayAtChange(e){
        e.preventDefault();

        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');

        if (checkedBoxes.length === 0) {
            utils.showToast('최소 한 개 이상의 선택해야 합니다.')
            return false;
        }

        const confirmResult = await utils.showConfirm('선택 항목을 수정하시겠습니까?');
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        const memberIds = Array.from(checkedBoxes).map(box => box.value);

        memberIds.forEach((id) => {
            const nextPayAtInput = document.querySelector(`input[name="nextPayAt"][data-idx="${id}"]`);
            if (nextPayAtInput) {
                const nextPayAtValue = nextPayAtInput.value;
                formData.append('nextPayAt[]', nextPayAtValue); // nextPayAt 값 추가
            }
            formData.append('idx[]', id); // 'idx[]'로 배열 형태로 추가

            const statusSelect = document.querySelector(`select[name="status"][data-idx="${id}"]`);
            if (statusSelect) {
                const statusValue = statusSelect.value;
                formData.append('status[]', statusValue); // status 값 추가
            }
        });

        const response = await API.fetchData('/api/nextPayAtChange', formData);

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
})();