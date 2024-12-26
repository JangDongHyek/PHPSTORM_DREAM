(function () {
    'use strict';

    const modifyEsti = document.querySelectorAll('#modifyEsti');
    const checkAll = document.querySelector('#checkAll');
    const estimateState = document.querySelector('#estimateState')

    document.addEventListener('DOMContentLoaded', () => {
        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();

        eventListeners();
    });

    function eventListeners() {
        //전체 체크박스
        checkAll.addEventListener('click', utils.checkboxes);

        // 견적 수정페이지 이동
        modifyEsti.forEach(item => {
            item.addEventListener('click', function () {
                const idx = this.getAttribute('data-idx');
                if (idx) {
                    window.location.href = baseUrl + `estimateForm?idx=${idx}`;
                }
            })
        })

        // 상태 변경
        estimateState.addEventListener('click', () => {
            handleChangeAuth('Y');
        });

    }

    async function handleChangeAuth(authValue) {
        const checkedBoxes = document.querySelectorAll('input[name="check"]:checked');
        let text = '선택 항목을 계약완료 하시겠습니까?';
        if (checkedBoxes.length === 0) {
            utils.showToast('최소 한 개 이상을 선택해야 합니다.')
            return false;
        }

        const confirmResult = await utils.showConfirm(text);
        if (confirmResult.isConfirmed !== true) return false;

        const formData = new FormData();
        const estIdx = Array.from(checkedBoxes).map(box => box.value);

        estIdx.forEach((id) => {
            formData.append('idx[]', id);
        });
        formData.append('auth', authValue);

        const response = await API.fetchData('/api/estimateAuth', formData);
        console.log(response)
        if (response['success'] === true) {
            utils.showToast('완료 했습니다', () => location.reload());
        }

    }

})();