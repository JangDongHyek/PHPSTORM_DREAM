(function () {
    'use strict';

    const checkAll = document.querySelector('#checkAll');
    const approve = document.querySelector('#approve');
    const revoke = document.querySelector('#revoke');

    const serviceStates = document.querySelectorAll('select[name="serviceState"]');

    const estimate = document.querySelector('#estimate');

    document.addEventListener('DOMContentLoaded', () => {

        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });

    function eventListeners() {
        //체크박스 선택
        checkAll.addEventListener('click', utils.checkboxes);
        //승인
        approve.addEventListener('click', () => {
            handleChangeAuth('Y');
        });
        //승인 취소
        revoke.addEventListener('click', () => {
            handleChangeAuth('N');
        });
        //견적상태 변경시 선택
        serviceStates.forEach(serviceState => {
            serviceState.addEventListener('change', toggleCheckbox);
        });
        //이사견적 상태 변경
        estimate.addEventListener('click', handleEstimateClick);

    }

    //이사견적 상태 변경
    async function handleEstimateClick() {
        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');
        const idxValues = [];
        const authValues = [];

        checkedBoxes.forEach(box => {
            const row = box.closest('tr');
            const idxValue = box.value;
            const serviceState = row.querySelector('select[name="serviceState"]');

            idxValues.push(idxValue);
            if (serviceState) {
                authValues.push(serviceState.value);
            }
        });

        if (idxValues.length === 0) {
            utils.showToast('최소 한 개 이상을 선택해야 합니다.');
            return;
        }

        const formData = new FormData();
        idxValues.forEach((id, index) => {
            formData.append('idx[]', id);
            formData.append('auth[]', authValues[index]);
        });

        const response = await API.fetchData('/api/estimateAuth', formData);

        if (response['success'] === true) {
            utils.showToast('완료 했습니다', () => location.reload());
        }

    }

    // 견적 상태 변경시 체크
    function toggleCheckbox(e) {
        const row = e.target.closest('tr');
        const check = row.querySelector('input[type="checkbox"]');
        check.checked = !!e.target.value;
    }

    // 승인 / 취고
    async function handleChangeAuth(authValue) {
        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');
        let text = '';
        if (checkedBoxes.length === 0) {
            utils.showToast('최소 한 개 이상을 선택해야 합니다.')
            return false;
        }

        if (authValue === 'N') {
            text = '선택 항목을 승인 취소 하시겠습니까?';
        } else if (authValue === 'Y') {
            text = '선택 항목을 승인 하시겠습니까?';
        }

        const confirmResult = await utils.showConfirm(text);
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        const memberIds = Array.from(checkedBoxes).map(box => box.value);

        memberIds.forEach((id) => {
            formData.append('idx[]', id); // 'idx[]'로 배열 형태로 추가
        });
        formData.append('auth', authValue);

        const response = await API.fetchData('/api/changeAuth', formData);
        console.log(response)
        if (response['success'] === true) {
            utils.showToast('완료 했습니다', () => location.reload());
        }
    }
})()